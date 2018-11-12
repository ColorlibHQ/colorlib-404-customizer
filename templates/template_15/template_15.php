<?php
$ccsm_options      = get_option( 'ccsm_settings' );
$counterActivation = $ccsm_options['colorlib_coming_soon_timer_activation'];
$template          = $ccsm_options['colorlib_coming_soon_template_selection'];
$counter           = $ccsm_options['colorlib_coming_soon_timer_option'];
$dates             = ccsm_counter_dates( $counter );
do_action( 'ccsm_header', 'template_15' );

?>
<style>
    <?php if( $counterActivation != '1' ) { ?>
    .cd100 {
        display: none !important;
    }

    <?php }
    if($ccsm_options['colorlib_coming_soon_text_color']){
        ?>
    p, h1, h2, h3, h4, span, li {
        color: <?php echo $ccsm_options['colorlib_coming_soon_text_color']; ?> !important;
    }

    <?php
    } ?>
    <?php echo $ccsm_options['colorlib_coming_soon_page_custom_css']; ?>
</style>
</head>
<body>

<div class="simpleslide100">
    <div class="simpleslide100-item bg-img1"
         style="background-image: url('<?php echo ( $ccsm_options['colorlib_coming_soon_background_image'] ) ? $ccsm_options['colorlib_coming_soon_background_image'] : CCSM_URL . 'templates/' . $template . '/images/bg01.jpg'; ?>');"></div>
    <div class="simpleslide100-item bg-img1"
         style="background-image: url('<?php echo ( $ccsm_options['colorlib_coming_soon_background_image'] ) ? $ccsm_options['colorlib_coming_soon_background_image'] : CCSM_URL . 'templates/' . $template . '/images/bg02.jpg'; ?>');"></div>
    <div class="simpleslide100-item bg-img1"
         style="background-image: url('<?php echo ( $ccsm_options['colorlib_coming_soon_background_image'] ) ? $ccsm_options['colorlib_coming_soon_background_image'] : CCSM_URL . 'templates/' . $template . '/images/bg03.jpg'; ?>');"></div>
    <div class="simpleslide100-item bg-img1"
         style="background-image: url('<?php echo ( $ccsm_options['colorlib_coming_soon_background_image'] ) ? $ccsm_options['colorlib_coming_soon_background_image'] : CCSM_URL . 'templates/' . $template . '/images/bg04.jpg'; ?>');"></div>
</div>

<div class="bg-img1 size1 overlay1 p-b-35 p-l-15 p-r-15"
     style="background-image: url('<?php echo ( $ccsm_options['colorlib_coming_soon_background_image'] ) ? $ccsm_options['colorlib_coming_soon_background_image'] : CCSM_URL . 'templates/' . $template . '/images/bg01.jpg'; ?>');">
    <div class="flex-col-c p-t-160 p-b-215 respon1">
        <div class="wrappic1">
			<?php if ( $ccsm_options['colorlib_coming_soon_plugin_logo'] ) {
				?>
                <a href="#"><img src="<?php echo $ccsm_options['colorlib_coming_soon_plugin_logo']; ?>"
                                 alt="LOGO"></a>
				<?php
			}
			?>
        </div>

        <h3 class="l1-txt1 txt-center p-t-30 p-b-100" id="colorlib_coming_soon_page_heading">
			<?php echo $ccsm_options['colorlib_coming_soon_page_heading']; ?>
        </h3>

        <div class="cd100"></div>

    </div>

    <!--  -->
    <div class="flex-w flex-c-m p-b-35">
		<?php
		if ( $ccsm_options['colorlib_coming_soon_social_facebook'] ) {
			?>
            <a href="<?php echo $ccsm_options['colorlib_coming_soon_social_facebook']; ?>"
               id="colorlib_coming_soon_social_facebook" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
                <i class="fa fa-facebook"></i>
            </a>
			<?php
		}
		if ( $ccsm_options['colorlib_coming_soon_social_twitter'] ) {
			?>
            <a href="<?php echo $ccsm_options['colorlib_coming_soon_social_twitter']; ?>"
               id="colorlib_coming_soon_social_twitter" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
                <i class="fa fa-twitter"></i>
            </a>
			<?php
		}
		if ( $ccsm_options['colorlib_coming_soon_social_youtube'] ) {
			?>
            <a href="<?php echo $ccsm_options['colorlib_coming_soon_social_youtube']; ?>"
               id="colorlib_coming_soon_social_youtube" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
                <i class="fa fa-youtube-play"></i>
            </a>
			<?php
		}
		if ( $ccsm_options['colorlib_coming_soon_social_email'] ) {
			?>
            <a href="mailto:<?php echo $ccsm_options['colorlib_coming_soon_social_email']; ?>"
               id="colorlib_coming_soon_social_email" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
                <i class="fa fa-envelope"></i>
            </a>
			<?php
		}
		if ( $ccsm_options['colorlib_coming_soon_social_pinterest'] ) {
			?>
            <a href="<?php echo $ccsm_options['colorlib_coming_soon_social_pinterest']; ?>"
               id="colorlib_coming_soon_social_pinterest" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
                <i class="fa fa-pinterest"></i>
            </a>
			<?php
		}
		if ( $ccsm_options['colorlib_coming_soon_social_instagram'] ) {
			?>
            <a href="<?php echo $ccsm_options['colorlib_coming_soon_social_instagram']; ?>"
               id="colorlib_coming_soon_social_instagram" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
                <i class="fa fa-instagram"></i>
            </a>
			<?php
		}
		?>


    </div>
</div>
<?php
if ( is_customize_preview() ) {
	?>
    <div style="display:none !important;">
		<?php
		wp_footer();
		?>
    </div>
	<?php
}
?>
<?php if ( $counterActivation == '1' ) { ?>
    <script>
        jQuery('.cd100').countdown100({
            /*Set Endtime here*/
            /*Endtime must be > current time*/
            endtimeYear: <?php echo $dates['script']['year']; ?>,
            endtimeMonth: <?php echo $dates['script']['month']; ?>,
            endtimeDate: <?php echo $dates['script']['day']; ?>,
            endtimeHours: <?php echo $dates['script']['hour']; ?>,
            endtimeMinutes: <?php echo $dates['script']['minute']; ?>,
            endtimeSeconds: <?php echo $dates['script']['second']; ?>,
            timeZone: ""
            // ex:  timeZone: "America/New_York"
            //go to " http://momentjs.com/timezone/ " to get timezone
        });
    </script>
<?php } ?>
<script>
    jQuery('.js-tilt').tilt({
        scale: 1.1
    })
</script>