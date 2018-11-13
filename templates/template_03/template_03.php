<?php do_action( 'cnfp_header', 'template_03' ); ?>
<?php $cnfp_options = get_option( 'cnfp_settings' ); ?>

</head>

<body>

<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h3 id="colorlib_404_customizer_page_heading"><?php echo $cnfp_options['colorlib_404_customizer_page_heading'] ; ?></h3>
            <h1><span>4</span><span>0</span><span>4</span></h1>
        </div>
        <h2 id="colorlib_404_customizer_content"><?php echo $cnfp_options['colorlib_404_customizer_content']; ?></h2>
    </div>
</div>
<?php if ( is_customize_preview() ) {
	wp_footer();
} ?>
