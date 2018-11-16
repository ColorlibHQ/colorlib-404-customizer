<?php $cnfp_options = get_option( 'cnfp_settings' ); ?>
<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h3 id="colorlib_404_customizer_page_heading"><?php echo wp_kses_post( $cnfp_options['colorlib_404_customizer_page_heading'] ); ?></h3>
            <h1><span>4</span><span>0</span><span>4</span></h1>
        </div>
        <h2 id="colorlib_404_customizer_content"><?php echo wp_kses_post( $cnfp_options['colorlib_404_customizer_content'] ); ?></h2>
    </div>
    <p style="position:absolute;bottom:0;">404 Page Template designed by <a href="https://colorlib.com/">Colorlib.</p>
</div>
