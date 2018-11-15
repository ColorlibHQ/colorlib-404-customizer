<?php $cnfp_options = get_option( 'cnfp_settings' ); ?>
<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>404</h1>
        </div>
        <h2 id="colorlib_404_customizer_page_heading"><?php echo $cnfp_options['colorlib_404_customizer_page_heading']; ?></h2>
        <form class="notfound-search">
            <input type="text" placeholder="<?php echo esc_attr__( 'Search...', 'colorlib-404-customizer' ); ?>">
            <button type="button"><?php echo esc_html__( 'Search', 'colorlib-404-customizer' ); ?></button>
        </form>
        <a href="<?php echo get_home_url(); ?>"><span class="arrow"></span><span
                    id="colorlib_404_customizer_button_text"><?php echo $cnfp_options['colorlib_404_customizer_button_text']; ?></span></a>
    </div>
</div>


