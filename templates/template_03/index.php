<?php do_action( 'cnfp_header', 'template_03' ); ?>

</head>

<body>

<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h3>Oops! Page not found</h3>
            <h1><span>4</span><span>0</span><span>4</span></h1>
        </div>
        <h2>we are sorry, but the page you requested was not found</h2>
    </div>
</div>
<?php if ( is_preview() ) {
	wp_footer();
} ?>
