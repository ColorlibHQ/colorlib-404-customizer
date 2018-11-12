<?php do_action( 'cnfp_header', 'template_16' ); ?>

</head>

<body>

<div id="notfound">
    <div class="notfound-bg"></div>
    <div class="notfound">
        <div class="notfound-404">
            <h1>404</h1>
        </div>
        <h2>we are sorry, but the page you requested was not found</h2>
        <a href="#" class="home-btn">Go Home</a>
        <a href="#" class="contact-btn">Contact us</a>
        <div class="notfound-social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-pinterest"></i></a>
            <a href="#"><i class="fa fa-google-plus"></i></a>
        </div>
    </div>
</div>
<?php if ( is_preview() ) {
	wp_footer();
} ?>

