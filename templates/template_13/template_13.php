<?php $cnfp_options = get_option( 'cnfp_settings' ); ?>
<div id="notfound">
    <div class="notfound">
        <div>
            <div class="notfound-404">
                <h1>!</h1>
            </div>
            <h2>Error<br>404</h2>
        </div>
        <p id="colorlib_404_customizer_content"><?php echo wp_kses_post( $cnfp_options['colorlib_404_customizer_content'] ); ?>
            <a href="<?php echo esc_url(get_home_url()); ?>"
               id="colorlib_404_customizer_button_text"><?php echo wp_kses_post( $cnfp_options['colorlib_404_customizer_button_text'] ); ?></a>
        </p>
    </div>
</div>

