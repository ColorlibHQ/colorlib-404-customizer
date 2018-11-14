<?php $cnfp_options = get_option( 'cnfp_settings' ); ?>
<div id="notfound">
    <div class="notfound">
        <div class="notfound-404"></div>
        <h1>404</h1>
        <h2 id="colorlib_404_customizer_page_heading"><?php echo $cnfp_options['colorlib_404_customizer_page_heading']; ?></h2>
        <p id="colorlib_404_customizer_content"><?php echo $cnfp_options['colorlib_404_customizer_content']; ?></p>
        <a href="<?php echo get_home_url(); ?>" id="colorlib_404_customizer_button_text"><?php echo $cnfp_options['colorlib_404_customizer_button_text']; ?></a>
    </div>
</div>