<?php $cnfp_options = get_option( 'cnfp_settings' ); ?>
<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>404</h1>
            <h2 id="colorlib_404_customizer_page_heading"><?php echo wp_kses_post( $cnfp_options['colorlib_404_customizer_page_heading'] ); ?></h2>
        </div>
        <a href="<?php echo get_home_url(); ?>"
           id="colorlib_404_customizer_button_text"><?php echo wp_kses_post( $cnfp_options['colorlib_404_customizer_button_text'] ); ?></a>
    </div>
</div>
