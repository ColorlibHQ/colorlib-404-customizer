# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

A WordPress plugin (not a static template) that replaces the theme's 404 page with one of 20 bundled designs, all configured through the WordPress Live Customizer. Published on wordpress.org under the slug `colorlib-404-customizer`. All PHP prefixes use `cnfp_` / `CNFP_`.

Note: the global instructions about Bootstrap 5 / jQuery-removal template upgrades do **not** apply here — this repo is a plugin. The front end already ships zero JavaScript; only the Customizer control frame still uses jQuery, because `wp.customize` hands out jQuery objects.

Targets WordPress 6.0+ and PHP 7.4+, verified against PHP 8.5.

## Commands

```bash
npm install                  # installs the Grunt toolchain

npm run textdomain           # verify all i18n calls use the 'colorlib-404-customizer' domain
npm run i18n                 # checktextdomain + regenerate languages/colorlib-404-customizer.pot
npm run lint                 # php -l across the tree
npm run build                # the release archive -> colorlib-404-customizer.zip
```

`npm run build` stages into `build/`, minifies the staged CSS **in place** under the original
filenames, zips, then deletes `build/`. Minifying the staged copy rather than the sources is
deliberate: the plugin enqueues `style.css`, never `style.min.css`, so the old task's `.min.css`
output was never loaded by anything — and it only covered the two admin stylesheets, not the 20
template stylesheets visitors actually download.

`package.json` carries an `overrides` entry pinning `adm-zip` to `^0.6.0`. `grunt-contrib-compress@2`
depends on `^0.5.1`, which carries a high-severity advisory; npm's suggested fix is a downgrade to
`grunt-contrib-compress@1`, which pulls `iltorb`, a native module that no longer builds on current
Node. Overriding forward keeps `npm audit` clean without that.

There is no test suite in the repo. Verification is manual: activate the plugin in a WordPress install and open **Appearance → Customize → Colorlib 404 Customizer Settings**.

For logic changes, a stub-WordPress smoke test is worth rebuilding — define the ~50 WP functions the plugin calls, escalate `E_ALL` to exceptions, then load the plugin and render all 20 templates. That catches undefined-key regressions and asset-loading mistakes that linting cannot.

## Architecture

### Request flow for a 404

`colorlib-404-customizer.php` hooks `template_redirect` (via `cnfp_skip_redirect_on_login`, which bails on `wp-login.php`). `cnfp_is_404_request()` decides whether to take over: it requires the activation toggle, and accepts either a real `is_404()` or the Customizer preview, which previews the *home* URL carrying `?colorlib-404-customization=true` — so `is_404()` is false there. Any code that gates on "are we rendering a 404" must use this helper, not `is_404()` alone.

On a match it includes [includes/colorlib-template.php](includes/colorlib-template.php) and calls `exit()`, short-circuiting the theme.

`colorlib-template.php` branches on the `colorlib_404_customizer_enable_header_footer` option, and **the two modes have separate asset entry points**:

| Aspect | Standalone (default) | Theme header/footer |
| --- | --- | --- |
| Document | plugin emits its own `<html>`/`<head>` | `get_header()` / `get_footer()` |
| Stylesheets | `cnfp_header` action → `wp_print_styles()` | `wp_enqueue_scripts` → `wp_enqueue_style()` |
| Inline overrides | `cnfp_inline_style()` called directly | `wp_head` at priority 10 |
| Theme CSS | stripped in preview by `cnfp_remove_all_styles_preview()` | left alone |

`cnfp_style_enqueue()` serves both and picks its behaviour from `current_action()`; the guard `if ( $standalone === cnfp_use_theme_header_footer() ) return;` is what keeps each mode to exactly one entry point. Two things this arrangement is deliberately fixing, so don't undo them:

- Enqueuing on `wp_head` is **too late** — core prints styles at `wp_head` priority 8, so assets would land in the footer.
- Before 1.1.0 the enqueue callback was unguarded on `wp_head`, which shipped the 404 stylesheet, its webfonts and jQuery on *every page of the site*.

### Settings storage

All settings live in a **single serialized option**, `cnfp_settings` (an array). Customizer settings are registered as `cnfp_settings[colorlib_404_customizer_*]` with `'type' => 'option'`.

Read settings through `cnfp_get_option()` / `cnfp_get_options()`, never `get_option('cnfp_settings')` directly — the accessor backfills from `cnfp_default_options()`, which is what keeps templates free of undefined-key warnings. `cnfp_default_options()` is also the seed on activation, so **a new setting must be added there** or existing installs get an empty string instead of your default.

`cnfp_get_options()` is deliberately *not* memoized: the Customizer previews changes by filtering `option_cnfp_settings`, and a request-lifetime cache would serve stale values into the preview.

### The template registry

[includes/cnfp-templates.php](includes/cnfp-templates.php) is the single source of truth, replacing seven parallel arrays that used to live in the main plugin file. Each entry carries `fonts` (Google Font family specs) and `supports` (`content`, `button`, `social`, `contact`, `background_color`).

The file must stay loadable at any hook — **no `__()` calls in it**. Translated labels are built at point of use in the Customizer (`sprintf( __( 'Template %d' ), $n )`). Putting translation calls there would re-introduce the early-translation bug from issue #30.

Adding `template_NN` means: one registry entry, plus `templates/template_NN/template_NN.php`, `css/style.css` and `template_NN.png`. The stylesheet path, thumbnail path and Customizer choice list are all derived by convention.

`cnfp_template_supports()` reads the registry; `cnfp_template_has_*()` are thin back-compat wrappers, kept because they are referenced as `active_callback` **strings** and may be used by third-party snippets.

### Security invariants

- **`cnfp_get_template()` is the only way to resolve a template slug.** The value is interpolated into an `include` path and into asset URLs; the function validates against the registry and falls back to `template_01`. `cnfp_sanitize_template()` wraps it as the setting's sanitize callback.
- **Custom CSS and colours are sanitised twice** — on save and again on output — because stored values predate the current callbacks. `cnfp_sanitize_css()` strips tags and angle brackets so nothing can close the `<style>` element; `cnfp_sanitize_color()` matches a strict pattern rather than using `sanitize_hex_color()`, which lives in the Customizer class file and is not reliably loaded on the front end.
- Background repeat/size are re-validated against `cnfp_background_choices()` at output time.

### Live-preview contract

Heading, content and button text use `postMessage` transport plus a selective-refresh partial, both keyed on a DOM **id equal to the setting key**. [assets/js/customizer-preview.js](assets/js/customizer-preview.js) swaps `#<setting_key>`'s innerHTML. A template that misspells one of these ids silently loses live preview — that was the bug in template 16 before 1.1.0.

Social settings use plain `refresh` transport: their value is an `href`, not element content, so a full preview refresh is the correct behaviour.

### Icons

[includes/cnfp-icons.php](includes/cnfp-icons.php) holds path data for the six social icons, rendered by `cnfp_get_icon()`. Five outlines were extracted from the Font Awesome 4.7 SVG font the plugin used to ship, so they render identically to before; they are Y-up (units-per-em 1792, ascent 1536) and carry `flip => true`, which applies `translate(0,1536) scale(1,-1)`. The X mark is authored on a normal 24x24 grid with `flip => false`.

Sizing comes from [assets/css/social-icons.css](assets/css/social-icons.css), loaded only for templates that declare `social` support. It switches the anchors to `inline-flex` centring (the templates' own `line-height` centring only worked for a text glyph) and ships `.screen-reader-text`, because the standalone document has no theme stylesheet to provide it.

## WordPress.org listing assets

`.wordpress-org/` is a **mirror of the SVN `/assets/` directory** — the listing images, not plugin
files. The Grunt build excludes the folder and the deploy action syncs it to SVN.

It must stay a complete mirror. The deploy action rsyncs this directory with `--delete`, so
anything live but missing here gets removed from the listing. That is why `icon-256x256.jpg` and
`banner-772x250.jpg` are committed even though nothing in this repo generated them: they are the
original illustrated artwork that has been on the listing since 2018, and dropping them from this
folder would delete them from the directory on the next deploy.

`screenshot-1.png` … `screenshot-7.png` are 1280x960 captures. Their numbering must stay in step
with the captions under `== Screenshots ==` in `readme.txt`.

Two things learned from shooting the screenshots, worth repeating if they are ever redone:

- Use a **short heading**. Several designs (template 4 especially) set the heading at a very large
  size and a long string overflows the layout.
- The Customizer's edit pencils sit on top of the previewed text. Inject
  `.customize-partial-edit-shortcut { display: none }` into the preview frame before capturing.

## Release conventions

The version string lives in four places and must be kept in sync: the plugin header, the `CNFP_VERSION` constant (used for asset cache-busting), `package.json`, and `readme.txt` (`Stable tag:` plus a new `== Changelog ==` entry). Bump `Tested up to:` in both the plugin header and `readme.txt`.

`readme.txt` is the wordpress.org readme — the canonical changelog lives there; there is no CHANGELOG.md.

## Open upstream issues

Both open issues at github.com/ColorlibHQ/colorlib-404-customizer are addressed in 1.1.0 (#30 textdomain timing, #28 the missing `exit` after `wp_safe_redirect`) but were not closed on GitHub.
