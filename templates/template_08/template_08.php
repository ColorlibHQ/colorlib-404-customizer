<?php
$ccsm_options      = get_option( 'ccsm_settings' );
$counterActivation = $ccsm_options['colorlib_coming_soon_timer_activation'];
$template          = $ccsm_options['colorlib_coming_soon_template_selection'];
$counter           = $ccsm_options['colorlib_coming_soon_timer_option'];
$dates             = ccsm_counter_dates( $counter );
do_action( 'ccsm_header', 'template_08' );

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

<div class="bg-img1 overlay1 size1 flex-w flex-c-m p-t-55 p-b-55 p-l-15 p-r-15"
     style="background-image: url('<?php echo ( $ccsm_options['colorlib_coming_soon_background_image'] ) ? $ccsm_options['colorlib_coming_soon_background_image'] : CCSM_URL . 'templates/' . $template . '/images/bg01.jpg'; ?>');">
    <div class="wsize1">
        <p class="txt-center p-b-23">
            <i class="zmdi zmdi-card-giftcard cl0 fs-60"></i>
        </p>

        <h3 class="l1-txt1 txt-center p-b-22" id="colorlib_coming_soon_page_heading">
			<?php echo $ccsm_options['colorlib_coming_soon_page_heading']; ?>
        </h3>

        <p class="txt-center m2-txt1 p-b-67">
			<?php echo $ccsm_options['colorlib_coming_soon_page_content']; ?>
        </p>

        <div class="flex-w flex-sa-m cd100 bor1 p-t-42 p-b-22 p-l-50 p-r-50 respon1">
            <div class="flex-col-c-m wsize2 m-b-20">
                <span class="l1-txt2 p-b-4 days"><?php echo $dates['template']['days']; ?></span>
                <span class="m2-txt2"><?php echo _e( 'Days', 'colorlib-coming-soon' ); ?></span>
            </div>

            <span class="l1-txt2 p-b-22">:</span>

            <div class="flex-col-c-m wsize2 m-b-20">
                <span class="l1-txt2 p-b-4 hours"><?php echo $dates['template']['hours']; ?></span>
                <span class="m2-txt2"><?php echo _e( 'Hours', 'colorlib-coming-soon' ); ?></span>
            </div>

            <span class="l1-txt2 p-b-22 respon2">:</span>

            <div class="flex-col-c-m wsize2 m-b-20">
                <span class="l1-txt2 p-b-4 minutes"><?php echo $dates['template']['minutes']; ?></span>
                <span class="m2-txt2"><?php echo _e( 'Minutes', 'colorlib-coming-soon' ); ?></span>
            </div>

            <span class="l1-txt2 p-b-22">:</span>

            <div class="flex-col-c-m wsize2 m-b-20">
                <span class="l1-txt2 p-b-4 seconds"><?php echo $dates['template']['seconds']; ?></span>
                <span class="m2-txt2"><?php echo _e( 'Seconds', 'colorlib-coming-soon' ); ?></span>
            </div>
        </div>

        <form class="flex-w flex-c-m contact100-form validate-form p-t-70">
            <div class="wrap-input100 validate-input where1" data-validate="Email is required: ex@abc.xyz">
                <input class="s1-txt1 placeholder0 input100" type="text" name="email" placeholder="Email Address">
                <span class="focus-input100"></span>
            </div>

            <button class="flex-c-m s1-txt1 size2 how-btn trans-04 where1">
				<?php echo _e( 'Notify Me', 'colorlib-coming-soon' ); ?>
            </button>
        </form>
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