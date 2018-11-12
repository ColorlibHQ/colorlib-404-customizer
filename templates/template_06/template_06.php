<?php do_action( 'cnfp_header', 'template_06' ); ?>

</head>

<body>

<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>404</h1>
            <h2>Page not found</h2>
        </div>
        <a href="#">Homepage</a>
    </div>
</div>
<?php if ( is_preview() ) {
	wp_footer();
} ?>
