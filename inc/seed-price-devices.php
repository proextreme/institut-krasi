<?php
/**
 * One-time content seed for the "Технології" (Zemits) price list (temporary).
 *
 * Source: client-provided aparate.csv. Fills price_devices only if it is
 * currently empty. Runs once (bi_price_devices_seeded). Removed in a
 * follow-up change.
 *
 * @package beauty-institute
 */

add_action(
	'init',
	function () {
		if ( get_option( 'bi_price_devices_seeded' ) ) {
			return;
		}
		if ( ! function_exists( 'update_field' ) ) {
			return;
		}

		$page = get_posts(
			array(
				'post_type'      => 'page',
				'post_status'    => array( 'publish', 'private', 'draft' ),
				'posts_per_page' => 1,
				'fields'         => 'ids',
				'meta_key'       => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
				'meta_value'     => 'vartist-poslug.php', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
			)
		);
		if ( ! $page ) {
			return;
		}
		$pid = (int) $page[0];

		if ( ! get_field( 'price_devices', $pid ) ) {
			$text = <<<'PRICE'
# ZEMITS
Hydro Diamond догляд для проблемної шкіри (акне/постакне) | 3 500 грн | 8001 | 90 хв
Hydro Diamond догляд глибоке зволоження | 4 000 грн | 8002 | 90 хв
Hydro Diamond догляд anti-age (з мікронідлінгом) | 4 500 грн | 8003 | 90 хв
Hydro Diamond догляд зменшення набряків (з мікрострумами) | 5 000 грн | 8004 | 90 хв
Hydro Diamond догляд ліфтинг (з RF) | 5 000 грн | 8005 | 90 хв
Безголковий RF (Обличчя+шия+декольте) | 4 000 грн | 8006 | 90 хв
Безголковий RF (Обличчя+шия) | 2 500 грн | 8007 | 90 хв
Безголковий RF (Обличчя) | 2 000 грн | 8008 | 60 хв
Мікротоки | 2 000 грн | 8009 | 60 хв
PRICE;
			update_field( 'price_devices', $text, $pid );
		}

		update_option( 'bi_price_devices_seeded', 1 );
	},
	100
);
