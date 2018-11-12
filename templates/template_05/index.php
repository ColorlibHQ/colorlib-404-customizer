<?php do_action( 'cnfp_header', 'template_05' ); ?>

</head>

<body>

<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>404</h1>
        </div>
        <h2>Oops, The Page you are looking for can't be found!</h2>
        <form class="notfound-search">
            <input type="text" placeholder="Search...">
            <button type="button">Search</button>
        </form>
        <a href="#"><span class="arrow"></span>Go Back</a>
    </div>
</div>
<?php if ( is_preview() ) {
	wp_footer();
} ?>

