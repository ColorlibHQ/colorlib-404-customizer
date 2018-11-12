<?php do_action( 'cnfp_header', 'template_10' ); ?>

</head>

<body>

<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>Oops!</h1>
        </div>
        <h2>404 - Page not found</h2>
        <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
        <a href="#">Go To Homepage</a>
    </div>
</div>
<?php if ( is_preview() ) {
	wp_footer();
} ?>

