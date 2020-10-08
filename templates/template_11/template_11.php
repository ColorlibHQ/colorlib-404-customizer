<?php $cnfp_options = get_option( 'cnfp_settings' ); ?>
<div id="colorlib-notfound">
    <div class="colorlib-notfound-bg"></div>
    <div class="colorlib-notfound">
        <div class="colorlib-notfound-404">
            <h1>404</h1>
        </div>
        <h2 id="colorlib_404_customizer_page_heading"><?php echo wp_kses_post( $cnfp_options['colorlib_404_customizer_page_heading'] ); ?></h2>
        <form class="colorlib-notfound-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search"
              method="get">
            <input type="search" placeholder="<?php echo esc_attr__( 'Search...', 'colorlib-404-customizer' ); ?>"
                   name="s" class="colorlib-input">
            <button type="submit"><?php echo esc_html__( 'Search', 'colorlib-404-customizer' ); ?></button>
        </form>
        <div class="colorlib-notfound-social">
			<?php
			if ( $cnfp_options['colorlib_404_customizer_social_facebook'] ) {
				?>
                <a href="<?php echo esc_url( $cnfp_options['colorlib_404_customizer_social_facebook'] ); ?>"
                   id="colorlib_404_customizer_social_facebook"><i class="fa fa-facebook"></i></a>
				<?php
			}
			if ( $cnfp_options['colorlib_404_customizer_social_twitter'] ) {
				?>
                <a href="<?php echo esc_url( $cnfp_options['colorlib_404_customizer_social_twitter'] ); ?>"
                   id="colorlib_404_customizer_social_twitter"><i class="fa fa-twitter"></i></a>
				<?php
			}
			if ( $cnfp_options['colorlib_404_customizer_social_pinterest'] ) {
				?>
                <a href="<?php echo esc_url( $cnfp_options['colorlib_404_customizer_social_pinterest'] ); ?>"
                   id="colorlib_404_customizer_social_pinterest"><i class="fa fa-pinterest"></i></a>
				<?php
			}
			if ( $cnfp_options['colorlib_404_customizer_social_email'] ) {
				?>
                <a href="mailto:<?php echo esc_html( antispambot( $cnfp_options['colorlib_404_customizer_social_email'] ) ); ?>"
                   id="colorlib_404_customizer_social_email"><i class="fa fa-envelope"></i></a>
				<?php
			}
			if ( $cnfp_options['colorlib_404_customizer_social_youtube'] ) {
				?>
                <a href="<?php echo esc_url( $cnfp_options['colorlib_404_customizer_social_youtube'] ); ?>"
                   id="colorlib_404_customizer_social_youtube"><i class="fa fa-youtube"></i></a>
				<?php
			}
			if ( $cnfp_options['colorlib_404_customizer_social_instagram'] ) {
				?>
                <a href="<?php echo esc_url( $cnfp_options['colorlib_404_customizer_social_instagram'] ); ?>"
                   id="colorlib_404_customizer_social_instagram"><i class="fa fa-instagram"></i></a>
				<?php
			}
			?>
        </div>
        <a href="<?php echo esc_url(get_home_url()); ?>"
           id="colorlib_404_customizer_button_text"><?php echo wp_kses_post( $cnfp_options['colorlib_404_customizer_button_text'] ); ?></a>
    </div>
    <p class="colorlib-copyright"><span><?php _e( '404 Page Template designed by','colorlib-404-customizer' ); ?></span> <a href="https://colorlib.com/" target="_blank">Colorlib.</a></p>
</div>


