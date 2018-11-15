<?php $cnfp_options = get_option( 'cnfp_settings' ); ?>
<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>4<span>0</span>4</h1>
        </div>
        <h2 id="colorlib_404_customizer_page_heading"><?php echo $cnfp_options['colorlib_404_customizer_page_heading'] ?></h2>
        <form class="notfound-search">
            <input type="text" placeholder="<?php esc_attr__( 'Search...', 'colorlib-404-customizer' ); ?>">
            <button type="button"><span></span></button>
        </form>
    </div>
</div>
