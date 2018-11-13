<?php $cnfp_options = get_option( 'cnfp_settings' ); ?>
<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>4<span>0</span>4</h1>
        </div>
        <p id="colorlib_404_customizer_page_heading"><?php echo $cnfp_options['colorlib_404_customizer_page_heading']; ?></p>
        <a href="<?php echo get_home_url(); ?>"
           id="colorlib_404_customizer_button_text"><?php echo $cnfp_options['colorlib_404_customizer_button_text'] ?></a>
    </div>
</div>

