<?php
/**
 * Storefront Child theme functions.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Print the official Google tag (GA4) in the <head> of every front-end page.
 * Each site sets its own ID in wp-config.php: define( 'SITE_GA4_ID', 'G-XXXXXXX' );
 * Only loads on production, and not for logged-in admins, so test visits
 * on local or staging never reach the client's reports.
 */
function northline_google_tag() {
	if ( ! defined( 'SITE_GA4_ID' ) || 'production' !== wp_get_environment_type() || current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( SITE_GA4_ID ); ?>"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', '<?php echo esc_js( SITE_GA4_ID ); ?>');
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

/**
 * Let WooCommerce's "Hold stock" job also cancel unpaid orders from the block
 * checkout. By default it only cancels orders created by the classic checkout,
 * so abandoned block-checkout orders stayed "Pending payment" forever.
 */
function northline_cancel_unpaid_block_checkout_orders( $cancel, $order ) {
	return $cancel || 'store-api' === $order->get_created_via();
}
add_filter( 'woocommerce_cancel_unpaid_order', 'northline_cancel_unpaid_block_checkout_orders', 10, 2 );
