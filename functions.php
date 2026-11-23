<?php
/**
 * Storefront Child theme functions.
 */

defined( 'ABSPATH' ) || exit;

// GA4 measurement ID (public identifier, not a secret).
define( 'NORTHLINE_GA4_ID', 'G-LV9GQ3R9J7' );

/**
 * Print the official Google tag (GA4) in the <head> of every front-end page.
 * Skipped for logged-in admins so their own visits don't skew the reports.
 */
function northline_google_tag() {
	if ( current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( NORTHLINE_GA4_ID ); ?>"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', '<?php echo esc_js( NORTHLINE_GA4_ID ); ?>');
	</script>
	<?php
}
add_action( 'wp_head', 'northline_google_tag', 1 );

/**
 * Meta description for search results.
 * Products use their short description; every other page uses the site tagline.
 */
function northline_meta_description() {
	if ( function_exists( 'is_product' ) && is_product() ) {
		$text = get_the_excerpt();
	} else {
		$text = get_bloginfo( 'description' );
	}
	$text = wp_trim_words( wp_strip_all_tags( $text ), 30, '' );
	if ( $text ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( $text ) );
	}
}
add_action( 'wp_head', 'northline_meta_description', 1 );
