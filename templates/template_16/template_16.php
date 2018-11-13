<?php do_action( 'cnfp_header', 'template_16' ); ?>
<?php $cnfp_options = get_option( 'cnfp_settings' ); ?>

</head>

<body>

<div id="notfound">
    <div class="notfound-bg"></div>
    <div class="notfound">
        <div class="notfound-404">
            <h1>404</h1>
        </div>
        <h2 id="colorlib_404_customizer_page_heading"><?php echo $cnfp_options['colorlib_404_customizer_page_heading']; ?></h2>
        <a href="<?php echo get_home_url(); ?>" class="home-btn"
           id="colorlib_404_customizer_buton_text"><?php echo $cnfp_options['colorlib_404_customizer_button_text']; ?></a>
        <!-- TODO what is up with this? -->
        <a href="#" class="contact-btn">Contact us</a>
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
			if ( $cnfp_options['colorlib_404_customizer_social_email'] ) {
				?>
                <a href="mailto:<?php echo $cnfp_options['colorlib_404_customizer_social_email'] ?>"
                   id="colorlib_404_customizer_social_email"><i class="fa fa-envelope"></i></a>
				<?php
			}
			if ( $cnfp_options['colorlib_404_customizer_social_youtube'] ) {
				?>
                <a href="<?php echo $cnfp_options['colorlib_404_customizer_social_youtube'] ?>"
                   id="colorlib_404_customizer_social_youtube"><i class="fa fa-youtube"></i></a>
				<?php
			}
			if ( $cnfp_options['colorlib_404_customizer_social_instagram'] ) {
				?>
                <a href="<?php echo $cnfp_options['colorlib_404_customizer_social_instagram'] ?>"
                   id="colorlib_404_customizer_social_instagram"><i class="fa fa-instagram"></i></a>
				<?php
			}
			?>
        </div>
    </div>
</div>
<?php if ( is_customize_preview() ) {
	wp_footer();
} ?>

