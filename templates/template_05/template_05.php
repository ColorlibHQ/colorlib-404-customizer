<?php
$ccsm_options      = get_option( 'ccsm_settings' );
$counterActivation = $ccsm_options['colorlib_coming_soon_timer_activation'];
$template          = $ccsm_options['colorlib_coming_soon_template_selection'];
$counter           = $ccsm_options['colorlib_coming_soon_timer_option'];
$dates             = ccsm_counter_dates( $counter );
do_action( 'ccsm_header', 'template_05' );

?>
<style>
    <?php if($counterActivation != '1'){ ?>
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

<div class="bg-g1 size1 flex-w flex-col-c-sb p-l-15 p-r-15 p-b-30">
    <div class="flex-w flex-c cd100 wsize1 bor1">
        <div class="flex-col-c-m size2 bg0 bor2">
            <span class="l1-txt3 p-b-7 days"><?php echo $dates['template']['days']; ?></span>
            <span class="s1-txt1"><?php echo _e( 'Days', 'colorlib-coming-soon' ); ?></span>
        </div>

        <div class="flex-col-c-m size2 bg0 bor2">
            <span class="l1-txt3 p-b-7 hours"><?php echo $dates['template']['hours']; ?></span>
            <span class="s1-txt1"><?php echo _e( 'Hours', 'colorlib-coming-soon' ); ?></span>
        </div>

        <div class="flex-col-c-m size2 bg0 bor2">
            <span class="l1-txt3 p-b-7 minutes"><?php echo $dates['template']['minutes']; ?></span>
            <span class="s1-txt1"><?php echo _e( 'Minutes', 'colorlib-coming-soon' ); ?></span>
        </div>

        <div class="flex-col-c-m size2 bg0">
            <span class="l1-txt3 p-b-7 seconds"><?php echo $dates['template']['seconds']; ?></span>
            <span class="s1-txt1"><?php echo _e( 'Seconds', 'colorlib-coming-soon' ); ?></span>
        </div>
    </div>


    <div class="flex-col-c w-full p-t-50 p-b-80">
        <h3 class="l1-txt1 txt-center p-b-10" id="colorlib_coming_soon_page_heading">
			<?php echo $ccsm_options['colorlib_coming_soon_page_heading']; ?>
        </h3>

        <p class="txt-center l1-txt2 p-b-43 wsize2" id="colorlib_coming_soon_page_content">
			<?php echo $ccsm_options['colorlib_coming_soon_page_content']; ?>
        </p>

        <form class="flex-w flex-c-m w-full contact100-form validate-form">
            <div class="wrap-input100 validate-input where1" data-validate="Name is required">
                <input class="s1-txt3 placeholder0 input100" type="text" name="name" placeholder="Name">
            </div>

            <div class="wrap-input100 validate-input where1" data-validate="Email is required: ex@abc.xyz">
                <input class="s1-txt3 placeholder0 input100" type="text" name="email" placeholder="Email">
            </div>

            <button class="flex-c-m s1-txt4 size3 how-btn trans-04 where1">
				<?php echo _e( 'Get Updates', 'colorlib-coming-soon' ); ?>
            </button>

        </form>
    </div>

    <span class="s1-txt2 txt-center">
			@ 2017 Coming Soon Template. Designed by Colorlib
		</span>

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