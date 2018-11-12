<?php
$ccsm_options      = get_option( 'ccsm_settings' );
$counterActivation = $ccsm_options['colorlib_coming_soon_timer_activation'];
$template          = $ccsm_options['colorlib_coming_soon_template_selection'];
$counter           = $ccsm_options['colorlib_coming_soon_timer_option'];
$dates             = ccsm_counter_dates( $counter );
do_action( 'ccsm_header', 'template_04' );

?>
<style>
    <?php if( $counterActivation != '1'){ ?>
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
    }?>
    <?php echo $ccsm_options['colorlib_coming_soon_page_custom_css']; ?>
</style>
</head>
<body>

<div class="bg-g1 size1 flex-w flex-col-c-sb p-l-15 p-r-15 p-t-55 p-b-35 respon1">
    <span></span>
    <div class="flex-col-c p-t-50 p-b-50">
        <h3 class="l1-txt1 txt-center p-b-10" id="colorlib_coming_soon_page_heading">
			<?php echo $ccsm_options['colorlib_coming_soon_page_heading']; ?>
        </h3>

        <p class="txt-center l1-txt2 p-b-60" id="colorlib_coming_soon_page_content">
			<?php echo $ccsm_options['colorlib_coming_soon_page_content']; ?>
        </p>

        <div class="flex-w flex-c cd100 p-b-82">
            <div class="flex-col-c-m size2 how-countdown">
                <span class="l1-txt3 p-b-9 days"><?php echo $dates['template']['days']; ?></span>
                <span class="s1-txt1"><?php echo _e( 'Days', 'colorlib-coming-soon' ); ?></span>
            </div>

            <div class="flex-col-c-m size2 how-countdown">
                <span class="l1-txt3 p-b-9 hours"><?php echo $dates['template']['hours']; ?></span>
                <span class="s1-txt1"><?php echo _e( 'Hours', 'colorlib-coming-soon' ); ?></span>
            </div>

            <div class="flex-col-c-m size2 how-countdown">
                <span class="l1-txt3 p-b-9 minutes"><?php echo $dates['template']['minutes']; ?></span>
                <span class="s1-txt1"><?php echo _e( 'Minutes', 'colorlib-coming-soon' ); ?></span>
            </div>

            <div class="flex-col-c-m size2 how-countdown">
                <span class="l1-txt3 p-b-9 seconds"><?php echo $dates['template']['days']; ?></span>
                <span class="s1-txt1"><?php echo _e( 'Seconds', 'colorlib-coming-soon' ); ?></span>
            </div>
        </div>

        <button class="flex-c-m s1-txt2 size3 how-btn" data-toggle="modal" data-target="#subscribe"
                id="colorlib_coming_soon_page_footer">
			<?php echo $ccsm_options['colorlib_coming_soon_page_footer']; ?>
        </button>
    </div>

    <span class="s1-txt3 txt-center">
			@ 2017 Coming Soon Template. Designed by Colorlib
		</span>

</div>

<!-- Modal Login -->
<div class="modal fade" id="subscribe" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" data-dismiss="modal">
        <div class="modal-subscribe where1-parent bg0 bor2 size4 p-t-54 p-b-100 p-l-15 p-r-15">
            <button class="btn-close-modal how-btn2 fs-26 where1 trans-04">
                <i class="zmdi zmdi-close"></i>
            </button>

            <div class="wsize1 m-lr-auto">
                <h3 class="m1-txt1 txt-center p-b-36">
                    <span class="bor1 p-b-6"><?php echo _e( 'Subscribe', 'colorlib-coming-soon' ); ?></span>
                </h3>

                <p class="m1-txt2 txt-center p-b-40">
					<?php echo _e( 'Follow us for update now!', 'colorlib-coming-soon' ); ?>
                </p>

                <form class="contact100-form validate-form">
                    <div class="wrap-input100 m-b-10 validate-input" data-validate="Name is required">
                        <input class="s1-txt4 placeholder0 input100" type="text" name="name" placeholder="Name">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 m-b-20 validate-input" data-validate="Email is required: ex@abc.xyz">
                        <input class="s1-txt4 placeholder0 input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="w-full">
                        <button class="flex-c-m s1-txt2 size5 how-btn1 trans-04">
                            Get Updates
                        </button>
                    </div>
                </form>

                <p class="s1-txt5 txt-center wsize2 m-lr-auto p-t-20">
                    And don’t worry, we hate spam too! You can unsubcribe at anytime.
                </p>
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