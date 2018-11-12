<?php
$ccsm_options      = get_option( 'ccsm_settings' );
$counterActivation = $ccsm_options['colorlib_coming_soon_timer_activation'];
$template          = $ccsm_options['colorlib_coming_soon_template_selection'];
$counter           = $ccsm_options['colorlib_coming_soon_timer_option'];
$dates             = ccsm_counter_dates( $counter );
do_action( 'ccsm_header', 'template_10' );

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
</div>

<div class="size1 overlay1">
    <!--  -->
    <div class="w-full flex-w flex-sb-m p-l-65 p-r-80 p-t-22 p-b-185 p-lr-15-sm respon8">
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
            <a href="#" class="size2 m1-txt1 flex-c-m how-btn1 trans-04">
				<?php echo _e( 'Sign Up', 'colorlib-coming-soon' ); ?>
            </a>
        </div>
    </div>

    <!--  -->
    <div class="flex-sb flex-row-rev where3-parent p-l-58 p-r-46 respon2">
        <!--  -->
        <div class="where3 wsize2 respon1">
            <h3 class="l1-txt2 p-b-30 respon6 respon7" id="colorlib_coming_soon_page_heading">
				<?php echo $ccsm_options['colorlib_coming_soon_page_heading']; ?>
            </h3>

            <p class="m2-txt1 respon6" id="colorlib_coming_soon_page_content">
				<?php echo $ccsm_options['colorlib_coming_soon_page_content']; ?>
            </p>

            <form class="contact100-form validate-form p-t-55 w-full">
                <div class="wrap-input100 validate-input m-lr-auto-lg" data-validate="Email is required: ex@abc.xyz">
                    <input class="s2-txt1 placeholder0 input100 trans-04" type="text" name="email"
                           placeholder="Email Address">

                    <button class="flex-c-m ab-t-r size4 s1-txt1 hov1 trans-04">
                        <i class="fa fa-paper-plane fs-15 cl0"></i>
                    </button>
                </div>
            </form>
        </div>

        <!--  -->
        <div class="flex-w flex-col cd100 p-t-34 respon3">
            <div class="flex-col wsize1 m-b-40 respon4">
                <span class="l1-txt1 p-b-30 days"><?php echo $dates['template']['days']; ?></span>
                <span class="s1-txt1"><?php echo _e( 'Days', 'colorlib-coming-soon' ); ?></span>
            </div>

            <div class="flex-col wsize1 m-b-40 respon4">
                <span class="l1-txt1 p-b-30 hours"><?php echo $dates['template']['hours']; ?></span>
                <span class="s1-txt1"><?php echo _e( 'Hours', 'colorlib-coming-soon' ); ?></span>
            </div>

            <div class="flex-col wsize1 m-b-40 respon4">
                <span class="l1-txt1 p-b-30 minutes"><?php echo $dates['template']['minutes']; ?></span>
                <span class="s1-txt1"><?php echo _e( 'Minutes', 'colorlib-coming-soon' ); ?></span>
            </div>

            <div class="flex-col wsize1 m-b-40 respon4">
                <span class="l1-txt1 p-b-30 seconds"><?php echo $dates['template']['seconds']; ?></span>
                <span class="s1-txt1"><?php echo _e( 'Seconds', 'colorlib-coming-soon' ); ?></span>
            </div>
        </div>

        <!--  -->
        <div class="flex-w flex-col where2 respon5">
			<?php
			if ( $ccsm_options['colorlib_coming_soon_social_facebook'] ) {
				?>
                <a href="<?php echo $ccsm_options['colorlib_coming_soon_social_facebook']; ?>"
                   id="colorlib_coming_soon_social_facebook"
                   class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
                    <i class="fa fa-facebook-official"></i>
                </a>
				<?php
			}
			if ( $ccsm_options['colorlib_coming_soon_social_twitter'] ) {
				?>
                <a href="<?php echo $ccsm_options['colorlib_coming_soon_social_twitter']; ?>"
                   id="colorlib_coming_soon_social_twitter"
                   class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
                    <i class="fa fa-twitter-square"></i>
                </a>
				<?php
			}
			if ( $ccsm_options['colorlib_coming_soon_social_pinterest'] ) {
				?>
                <a href="<?php echo $ccsm_options['colorlib_coming_soon_social_pinterest']; ?>"
                   id="colorlib_coming_soon_social_pinterest"
                   class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
                    <i class="fa fa-pinterest-square"></i>
                </a>
				<?php
			}
			if ( $ccsm_options['colorlib_coming_soon_social_email'] ) {
				?>
                <a href="mailto:<?php echo $ccsm_options['colorlib_coming_soon_social_email']; ?>"
                   id="colorlib_coming_soon_social_email"
                   class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
                    <i class="fa fa-envelope-square"></i>
                </a>
				<?php
			}
			if ( $ccsm_options['colorlib_coming_soon_social_youtube'] ) {
				?>
                <a href="mailto:<?php echo $ccsm_options['colorlib_coming_soon_social_youtube']; ?>"
                   id="colorlib_coming_soon_social_youtube"
                   class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
                    <i class="fa fa-youtube-square"></i>
                </a>
				<?php
			}
			if ( $ccsm_options['colorlib_coming_soon_social_instagram'] ) {
				?>
                <a href="mailto:<?php echo $ccsm_options['colorlib_coming_soon_social_instagram']; ?>"
                   id="colorlib_coming_soon_social_instagram"
                   class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
                    <i class="fa fa-instagram"></i>
                </a>
				<?php
			}
			?>


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