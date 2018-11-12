<?php do_action( 'cnfp_header', 'template_13' ); ?>

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
        <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a
                    href="#">Back to homepage</a></p>
    </div>
</div>
<?php if ( is_preview() ) {
	wp_footer();
} ?>

