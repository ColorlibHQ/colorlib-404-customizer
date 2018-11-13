<?php do_action( 'cnfp_header', 'template_18' ); ?>

</head>

<body>

<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>404</h1>
        </div>
        <h2>Oops! Nothing was found</h2>
        <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a
                    href="#">Return to homepage</a></p>
        <div class="notfound-social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-pinterest"></i></a>
            <a href="#"><i class="fa fa-google-plus"></i></a>
        </div>
    </div>
</div>
<?php if ( is_customize_preview() ) {
	wp_footer();
} ?>
