<?php do_action( 'cnfp_header', 'template_04' ); ?>
<?php $cnfp_options = get_option( 'cnfp_settings' ); ?>

</head>

<body>

<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1 id="colorlib_404_customizer_page_heading"><?php echo $cnfp_options['colorlib_404_customizer_page_heading']; ?></h1>
            <h2 id="colorlib_404_customizer_content"><?php echo $cnfp_options['colorlib_404_customizer_content'] ?></h2>
        </div>
        <a href="<?php echo get_home_url(); ?>"
           id="colorlib_404_customizer_button_text"><?php echo $cnfp_options['colorlib_404_customizer_button_text'] ?></a>
    </div>
</div>
<?php if ( is_customize_preview() ) {
	wp_footer();
} ?>

