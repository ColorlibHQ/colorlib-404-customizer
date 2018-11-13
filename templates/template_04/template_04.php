<?php do_action( 'cnfp_header', 'template_04' ); ?>

</head>

<body>

<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>Oops!</h1>
            <h2>404 - The Page can't be found</h2>
        </div>
        <a href="#">Go TO Homepage</a>
    </div>
</div>
<?php if ( is_customize_preview() ) {
	wp_footer();
} ?>

