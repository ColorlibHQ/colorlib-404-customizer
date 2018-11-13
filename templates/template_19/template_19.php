<?php do_action( 'cnfp_header', 'template_18' ); ?>
<?php $cnfp_options = get_option( 'cnfp_settings' ); ?>

</head>

<body>

<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>404</h1>
        </div>
        <h2 id="colorlib_404_customizer_page_heading"><?php echo $cnfp_options['colorlib_404_customizer_page_heading']; ?></h2>
        <p id="colorlib_404_customizer_content"><?php echo $cnfp_options['colorlib_404_customizer_content'] ?><a
                    href="<?php echo get_home_url(); ?>"
                    id="colorlib_404_customizer_button_text"><?php echo $cnfp_options['colorlib_404_customizer_button_text']; ?></a>
        </p>
        <div class="notfound-social">
			<?php
			if ( $cnfp_options['colorlib_404_customizer_social_facebook'] ) {
				?>
                <a href="<?php echo $cnfp_options['colorlib_404_customizer_social_facebook']; ?>"
                   id="colorlib_404_customizer_social_facebook"><i class="fa fa-facebook"></i></a>

				<?php
			}
			if ( $cnfp_options['colorlib_404_customizer_social_twitter'] ) {
				?>
                <a href="<?php echo $cnfp_options['colorlib_404_customizer_social_twitter'] ?>"
                   id="colorlib_404_customizer_social_twitter"><i
                            class="fa fa-twitter"></i></a>
				<?php
			}
			if ( $cnfp_options['colorlib_404_customizer_social_pinterest'] ) {
				?>
                <a href="<?php echo $cnfp_options['colorlib_404_customizer_social_pinterest'] ?>"
                   id="colorlib_404_customizer_social_pinterest"><i
                            class="fa fa-pinterest"></i></a>
				<?php
			}
			if ( $cnfp_options['colorlib_404_customizer_social_google'] ) {
				?>
                <a href="<?php echo $cnfp_options['colorlib_404_customizer_social_google'] ?>"
                   id="colorlib_404_customizer_social_google"><i
                            class="fa fa-google-plus"></i></a>
				<?php
			}
			?>
        </div>
    </div>
</div>
<?php if ( is_customize_preview() ) {
	wp_footer();
} ?>
