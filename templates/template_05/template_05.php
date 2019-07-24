<?php $cnfp_options = get_option( 'cnfp_settings' ); ?>
<div id="colorlib-notfound">
    <div class="colorlib-notfound">
        <div class="colorlib-notfound-404">
            <h1>404</h1>
        </div>
        <h2 id="colorlib_404_customizer_page_heading"><?php echo wp_kses_post( $cnfp_options['colorlib_404_customizer_page_heading'] ); ?></h2>
        <form class="colorlib-notfound-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search"
              method="get">
            <input type="search" placeholder="<?php echo esc_attr__( 'Search...', 'colorlib-404-customizer' ); ?>"
                   value="<?php echo get_search_query(); ?>" name="s">
            <button type="submit"><?php echo esc_html__( 'Search', 'colorlib-404-customizer' ); ?></button>
        </form>
        <a href="<?php echo esc_url(get_home_url()); ?>"><span class="arrow"></span><span
                    id="colorlib_404_customizer_button_text"><?php echo wp_kses_post( $cnfp_options['colorlib_404_customizer_button_text'] ); ?></span></a>
    </div>
    <p class="colorlib-copyright""><span><?php _e('404 Page Template designed by','colorlib-404-customizer'); ?></span> <a href="https://colorlib.com/" target="_blank">Colorlib.</a></p>
</div>


