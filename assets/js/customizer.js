/**
 * Customizer control-frame behaviour.
 *
 * Three jobs: turn the plain textareas into TinyMCE editors, point the preview at
 * the 404 view while the panel is open, and drive the theme-picker-style template
 * section.
 *
 * @package Colorlib_404_Customizer
 */

( function ( api ) {
	'use strict';

	var TEMPLATE_SETTING = 'cnfp_settings[colorlib_404_customizer_select_template]';

	/**
	 * Upgrade one of the plugin's textareas to a small TinyMCE editor.
	 *
	 * @param {HTMLTextAreaElement} textarea The control's textarea.
	 */
	function initEditor( textarea ) {
		if ( ! window.wp || ! window.wp.editor || ! window.wp.editor.initialize ) {
			return;
		}

		window.wp.editor.initialize( textarea.id, {
			tinymce: {
				wpautop: true,
				browser_spellcheck: true,
				mediaButtons: false,
				wp_autoresize_on: true,
				toolbar1: 'bold,italic,link,strikethrough',
				setup: function ( editor ) {
					// TinyMCE only fires `change` on blur or a new undo level;
					// `keyup` keeps the preview in step while typing.
					editor.on( 'change keyup', function () {
						editor.save();

						// The customizer listens for `change` on the textarea;
						// a native event reaches its jQuery handler just fine.
						textarea.dispatchEvent( new Event( 'change', { bubbles: true } ) );
					} );
				}
			},
			quicktags: true
		} );
	}

	/**
	 * Show the 404 view in the preview for as long as the panel is open.
	 */
	function bindPreviewUrl() {
		if ( ! window.CNFPurls ) {
			return;
		}

		api.panel( 'colorlib_404_customizer_panel', function ( panel ) {
			panel.expanded.bind( function ( isExpanding ) {
				var url = isExpanding
					? window.CNFPurls.siteurl + '?colorlib-404-customization=true'
					: window.CNFPurls.siteurl;

				api.previewer.previewUrl.set( url );
			} );
		} );
	}

	window.addEventListener( 'load', bindPreviewUrl );

	/*
	 * Each editor starts from its own control, the first time its section opens.
	 * Scanning the document on `load` (as before) found nothing: the customizer
	 * embeds control markup later than that. Waiting for the section also keeps
	 * TinyMCE from measuring itself inside a hidden container.
	 */
	api.controlConstructor['cnfp-editor'] = api.Control.extend( {
		ready: function () {
			var control = this,
				textarea = control.container[ 0 ].querySelector( 'textarea.js-cnfp-editor' );

			if ( ! textarea ) {
				return;
			}

			api.section( control.section(), function ( section ) {
				function start( isExpanded ) {
					if ( isExpanded ) {
						section.expanded.unbind( start );
						initEditor( textarea );
					}
				}

				section.expanded.bind( start );
				start( section.expanded() );
			} );
		}
	} );

	/*
	 * The template chooser mirrors core's theme browser: a collapsed summary row
	 * with a Change button that slides out a full-height section.
	 */
	api.sectionConstructor['cnfp-templates-section'] = api.OuterSection.extend( {
		attachEvents: function () {
			var section = this,
				container = section.container[ 0 ],
				head = section.headContainer[ 0 ],
				toggle = head.querySelector( 'button.change-theme' );

			if ( toggle ) {
				toggle.addEventListener( 'click', function () {
					if ( section.expanded() ) {
						section.collapse();
					} else {
						section.expand();
					}
				} );
			}

			container.querySelectorAll( '.customize-section-back' ).forEach( function ( button ) {
				button.addEventListener( 'click', function ( event ) {
					event.preventDefault();
					section.collapse();
				} );

				button.addEventListener( 'keydown', function ( event ) {
					if ( 13 !== event.which && 32 !== event.which ) {
						return;
					}

					event.preventDefault();
					section.collapse();
				} );
			} );
		},

		// Always selectable, regardless of which controls are currently active.
		isContextuallyActive: function () {
			return true;
		},

		changeLabel: function ( template ) {
			var label = this.headContainer[ 0 ].querySelector( '.cnfp-active_template' );

			if ( label ) {
				label.textContent = template.replace( /_/g, ' ' );
			}
		}
	} );

	api.controlConstructor['cnfp-templates'] = api.Control.extend( {
		ready: function () {
			var control = this;

			control.container[ 0 ].addEventListener( 'change', function ( event ) {
				if ( event.target.matches( 'input[type="radio"]' ) ) {
					control.setting( event.target.value );
				}
			} );
		}
	} );

	api.bind( 'ready', function () {
		api( TEMPLATE_SETTING, function ( setting ) {
			setting.bind( function ( template ) {
				var section = api.section( api.control( TEMPLATE_SETTING ).section() );

				if ( section && section.changeLabel ) {
					section.changeLabel( template );
				}
			} );
		} );
	} );
} )( wp.customize );
