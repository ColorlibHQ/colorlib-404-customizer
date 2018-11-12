<?php do_action( 'cnfp_header', 'template_01' ); ?>
</head>
<body>
<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>404</h1>
        </div>
        <h2>Oops! This Page Could Not Be Found</h2>
        <p>Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily
            unavailable</p>
        <a href="<?php echo get_home_url(); ?>">Go To Homepage</a>
    </div>
</div>
<?php if ( is_preview() ) {
	wp_footer();
} ?>

