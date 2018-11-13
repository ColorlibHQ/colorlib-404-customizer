<?php do_action( 'cnfp_header', 'template_13' ); ?>
<?php $cnfp_options = get_option( 'cnfp_settings' ); ?>

</head>

<body>

<div id="notfound">
    <div class="notfound">
        <div>
            <div class="notfound-404">
                <h1>!</h1>
            </div>
            <h2>Error<br>404</h2>
        </div>
        <p id="colorlib_404_customizer_content"><?php echo $cnfp_options['colorlib_404_customizer_content'] ?>
            <a href="<?php echo get_home_url(); ?>"
               id="colorlib_404_customizer_button_text"><?php echo $cnfp_options['colorlib_404_customizer_button_text'] ?></a>
        </p>
    </div>
</div>
<?php if ( is_customize_preview() ) {
	wp_footer();
} ?>

