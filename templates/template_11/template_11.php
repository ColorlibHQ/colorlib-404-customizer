<?php do_action( 'cnfp_header', 'template_11' ); ?>
<?php $cnfp_options = get_option( 'cnfp_settings' ); ?>
</head>

<body>

<div id="notfound">
    <div class="notfound-bg"></div>
    <div class="notfound">
        <div class="notfound-404">
            <h1>404</h1>
        </div>
        <h2 id="colorlib_404_customizer_page_heading"><?php echo $cnfp_options['colrolib_404_customizer_page_heading'] ?></h2>
        <form class="notfound-search">
            <input type="text" placeholder="<?php echo esc_html__( 'Search...', 'colorlib-404-customizer' ); ?>">
            <button type="button"><?php echo esc_html__( 'Search', 'colorlib-404-customizer' ); ?></button>
        </form>
        <div class="notfound-social">
			<?php
			if ( $cnfp_options['colorlib_404_customizer_social_facebook'] ) {
				?>
                <a href="<?php echo $cnfp_options['colorlib_404_customizer_social_facebook'] ?>"
                   id="colorlib_404_customizer_social_facebook"><i class="fa fa-facebook"></i></a>
				<?php
			}
			if ( $cnfp_options['colorlib_404_customizer_social_twitter'] ) {
				?>
                <a href="<?php echo $cnfp_options['colorlib_404_customizer_social_twitter']; ?>"
                   id="colorlib_404_customizer_social_twitter"><i class="fa fa-twitter"></i></a>
				<?php
			}
			if ( $cnfp_options['colorlib_404_customizer_social_pinterest'] ) {
				?>
                <a href="<?php echo $cnfp_options['colorlib_404_customizer_social_pinterest']; ?>"
                   id="colorlib_404_customizer_social_pinterest"><i class="fa fa-pinterest"></i></a>
				<?php
			}
			if ( $cnfp_options['colorlib_404_customizer_social_google'] ) {
				?>
                <a href="<?php echo $cnfp_options['colorlib_404_customizer_social_google']; ?>"
                   id="colorlib_404_customizer_social_google"><i class="fa fa-google-plus"></i></a>
				<?php
			}
			?>


        </div>
        <a href="<?php echo get_home_url(); ?>"
           id="colorlib_404_customizer_button_text"><?php echo $cnfp_options['colorlib_404_customizer_button_text']; ?></a>
    </div>
</div>
<?php if ( is_customize_preview() ) {
	wp_footer();
} ?>

