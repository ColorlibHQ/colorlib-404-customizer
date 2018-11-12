<?php
$ccsm_options      = get_option( 'ccsm_settings' );
$counterActivation = $ccsm_options['colorlib_coming_soon_timer_activation'];
$template          = $ccsm_options['colorlib_coming_soon_template_selection'];
$counter           = $ccsm_options['colorlib_coming_soon_timer_option'];
$dates             = ccsm_counter_dates( $counter );
do_action( 'ccsm_header', 'template_07' );

?>
<style>
    <?php if( $counterActivation != '1' ){ ?>
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
<div class="bg-img1 size1 overlay1"
     style="background-image: url('<?php echo ( $ccsm_options['colorlib_coming_soon_background_image'] ) ? $ccsm_options['colorlib_coming_soon_background_image'] : CCSM_URL . 'templates/' . $template.'/images/bg01.jpg'; ?>');">
    <div class="size1 p-l-15 p-r-15 p-t-30 p-b-50">
        <div class="flex-w flex-sb-m p-l-75 p-r-60 p-b-165 respon1">
            <div class="wrappic1 m-r-30 m-t-10 m-b-10">
				<?php if ( $ccsm_options['colorlib_coming_soon_plugin_logo'] ) {
					?>
                    <a href="#"><img src="<?php echo $ccsm_options['colorlib_coming_soon_plugin_logo']; ?>"
                                     alt="LOGO"></a>
					<?php
				}
				?>
            </div>
            <div class="flex-w m-t-10 m-b-10">
				<?php if ( $ccsm_options['colorlib_coming_soon_social_facebook'] ) {
					?>
                    <a href="<?php echo $ccsm_options['colorlib_coming_soon_social_facebook']; ?>"
                       id="colorlib_coming_soon_social_facebook"
                       class="size4 flex-c-m how-social trans-04 m-r-5 m-b-3 m-t-3">
                        <i class="fa fa-facebook"></i>
                    </a>
					<?php
				}
				if ( $ccsm_options['colorlib_coming_soon_social_twitter'] ) {
					?>
                    <a href="<?php echo $ccsm_options['colorlib_coming_soon_social_twitter']; ?>"
                       id="colorlib_coming_soon_social_twitter"
                       class="size4 flex-c-m how-social trans-04 m-r-5 m-b-3 m-t-3">
                        <i class="fa fa-twitter"></i>
                    </a>
					<?php
				}
				if ( $ccsm_options['colorlib_coming_soon_social_youtube'] ) {
					?>
                    <a href="<?php echo $ccsm_options['colorlib_coming_soon_social_youtube']; ?>"
                       id="colorlib_coming_soon_social_youtube"
                       class="size4 flex-c-m how-social trans-04 m-r-5 m-b-3 m-t-3">
                        <i class="fa fa-youtube-play"></i>
                    </a>
					<?php
				}
				if ( $ccsm_options['colorlib_coming_soon_social_email'] ) {
					?>
                    <a href="mailto:<?php echo $ccsm_options['colorlib_coming_soon_social_email']; ?>"
                       id="colorlib_coming_soon_social_email"
                       class="size4 flex-c-m how-social trans-04 m-r-5 m-b-3 m-t-3">
                        <i class="fa fa-envelope"></i>
                    </a>
					<?php
				}
				if ( $ccsm_options['colorlib_coming_soon_social_pinterest'] ) {
					?>
                    <a href="<?php echo $ccsm_options['colorlib_coming_soon_social_pinterest']; ?>"
                       id="colorlib_coming_soon_social_pinterest"
                       class="size4 flex-c-m how-social trans-04 m-r-5 m-b-3 m-t-3">
                        <i class="fa fa-pinterest"></i>
                    </a>
					<?php
				}
				if ( $ccsm_options['colorlib_coming_soon_social_instagram'] ) {
					?>
                    <a href="<?php echo $ccsm_options['colorlib_coming_soon_social_instagram']; ?>"
                       id="colorlib_coming_soon_social_instagram"
                       class="size4 flex-c-m how-social trans-04 m-r-5 m-b-3 m-t-3">
                        <i class="fa fa-instagram"></i>
                    </a>
					<?php
				}
				?>

            </div>
        </div>

        <div class="wsize1 m-lr-auto">
            <p class="txt-center l1-txt1 p-b-60" id="colorlib_coming_soon_page_heading">
				<?php echo $ccsm_options['colorlib_coming_soon_page_heading']; ?>
            </p>

            <form class="w-full flex-w flex-c-m validate-form">

                <div class="wrap-input100 validate-input m-b-20"
                     data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100 placeholder0 m1-txt1" type="text" name="email"
                           placeholder="Email Address">
                    <span class="focus-input100"></span>
                </div>


                <button class="flex-c-m size3 m1-txt2 how-btn1 trans-04 m-b-20">
					<?php echo _e( 'Subscribe', 'colorlib-coming-soon' ); ?>
                </button>
            </form>

            <p class="txt-center s1-txt1 p-t-5">
				<?php echo $ccsm_options['colorlib_coming_soon_page_footer']; ?>
            </p>
        </div>


        <div class="flex-w flex-c-m cd100 wsize1 m-lr-auto p-t-116">
            <div class="flex-col-c-m size2 bor1 m-l-10 m-r-10 m-b-15">
                <span class="l1-txt3 p-b-9 days"><?php echo $dates['template']['days']; ?></span>
                <span class="s1-txt2"><?php echo _e( 'Days', 'colorlib-coming-soon' ); ?></span>
            </div>

            <div class="flex-col-c-m size2 bor1 m-l-10 m-r-10 m-b-15">
                <span class="l1-txt3 p-b-9 hours"><?php echo $dates['template']['hours']; ?></span>
                <span class="s1-txt2"><?php echo _e( 'Hours', 'colorlib-coming-soon' ); ?></span>
            </div>

            <div class="flex-col-c-m size2 bor1 m-l-10 m-r-10 m-b-15">
                <span class="l1-txt3 p-b-9 minutes"><?php echo $dates['template']['minutes']; ?></span>
                <span class="s1-txt2"><?php echo _e( 'Minutes', 'colorlib-coming-soon' ); ?></span>
            </div>

            <div class="flex-col-c-m size2 bor1 m-l-10 m-r-10 m-b-15">
                <span class="l1-txt3 p-b-9 seconds"><?php echo $dates['template']['seconds']; ?></span>
                <span class="s1-txt2"><?php echo _e( 'Seconds', 'colorlib-coming-soon' ); ?></span>
            </div>
        </div>
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