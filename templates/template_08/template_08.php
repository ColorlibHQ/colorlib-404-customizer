<?php do_action( 'cnfp_header', 'template_08' ); ?>

</head>

<body>

<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>4<span>0</span>4</h1>
        </div>
        <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
        <a href="#">home page</a>
    </div>
</div>
<?php if ( is_customize_preview() ) {
	wp_footer();
} ?>
