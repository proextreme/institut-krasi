<?php
/**
 * One-time content seed for text reviews (temporary).
 *
 * Source: client-provided Figma mockup for the "Відгуки" page.
 * Creates bi_review posts only if none exist yet. Runs once
 * (bi_reviews_text_seeded). Removed in a follow-up change.
 *
 * @package beauty-institute
 */

/**
 * Find a doctor post by its ACF "short_name" field (e.g. "Трембач О.М.").
 *
 * @param string $short_name Short name to match.
 * @return int Doctor post ID, or 0 if not found.
 */
function bi_seed_find_doctor_by_short_name( $short_name ) {
	$found = get_posts(
		array(
			'post_type'      => 'bi_doctor',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'meta_key'       => 'short_name', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'     => $short_name, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
		)
	);

	return $found ? (int) $found[0] : 0;
}

add_action(
	'init',
	function () {
		if ( get_option( 'bi_reviews_text_seeded' ) ) {
			return;
		}
		if ( ! function_exists( 'update_field' ) ) {
			return;
		}

		$existing = get_posts(
			array(
				'post_type'      => 'bi_review',
				'post_status'    => array( 'publish', 'draft', 'private' ),
				'posts_per_page' => 1,
				'fields'         => 'ids',
				'no_found_rows'  => true,
			)
		);
		if ( $existing ) {
			update_option( 'bi_reviews_text_seeded', 1 );
			return;
		}

		$reviews = array(
			array(
				'author'  => 'Олена Боднар',
				'title'   => 'Турбота та професіоналізм',
				'service' => 'Консультація косметолога',
				'doctors' => array( 'Трембач О.М.' ),
				'text'    => 'Приємний, ввічливий і дуже уважний лікар – Трембач Олександр Михайлович. Мій страх від хворобливих процедур завжди перемикає на веселий жарт і підіймає настрій. Ціни дуже приємні і порівнянні з іншими медичними центрами. Велике дякую Інституту краси та лікареві за добрі руки та професіоналізм на вищому рівні',
			),
			array(
				'author'  => 'Тетяна Горлушко',
				'title'   => 'Результат після першої процедури',
				'service' => 'Гідродаймонд (Zemits)',
				'doctors' => array( 'Трембач І.О.' ),
				'text'    => 'Я шокована результатами доглядових процедур на апаратах Zemits, у захваті від процедури Гідродаймонд, шкіра стала настільки чистою та підтягнутою, вирівнявся рельєф, зникли всі неприємні плями. Процедуру робила лікар – Трембач Інна Олександрівна, результат отримала після першого разу + максимальне розслаблення протягом всієї процедури, мені дуже сподобалось!',
			),
			array(
				'author'  => 'Ірина Крутко',
				'title'   => 'Уважні лікарі та чудовий результат',
				'service' => 'Видалення бородавок і папілом',
				'doctors' => array( 'Наконечна К.М.', 'Вовчук Д.І.' ),
				'text'    => 'Якщо у вас є необхідність видалити бородавки та папіломи, то рекомендую чудових лікарів: Наконечну Катерину Миколаївну та Вовчук Дарину Іванівну, справді лікарі вищої категорії, уважні, спокійні та доброзичливі. Катерина Миколаївна розповість і історію виникнення, і перебіг процедури, і подальший догляд і звісно відповість на всі хвилюючі запитання. Результат – чисті і доглянуті ніжки! Я дуже задоволена!',
			),
			array(
				'author'  => 'Валентина Анопрієнко',
				'title'   => 'Оновлений простір краси та комфорту',
				'service' => 'Загальний огляд інституту',
				'doctors' => array(),
				'text'    => 'На новому місці Інститут краси став ще кращий, нові кабінети, свіжий ремонт, атмосфера чистоти та затишку і звісно професіоналізм лікарів на вищому рівні! Всім однозначно рекомендую відвідати оновлений Інститут і отримати задоволення від цього сервісу та випити запашної кави!',
			),
			array(
				'author'  => 'Софія Михайленко',
				'title'   => 'Лікар, якому довіряють роками',
				'service' => 'Кругова підтяжка обличчя',
				'doctors' => array( 'Трембач О.М.' ),
				'text'    => 'Я так довго чекала відкриття Інституту краси і нарешті після довгої перерви це відбулося! Після того, як я зробила круговую підтяжку вже давно, я не мала бажання шукати інше місце для корекції вікових змін та обслуговуватись у іншого лікаря. Нарешті прийшла Трембач Олександр Михайлович і знов попала на прийом до нього, зробила ще одну хірургічну операцію і сто процентів залишилась задоволена результатом. Реабілітація пройшла швидко і практично безболісно. Він найкращий хірург в Україні! Дякую, я дуже Вам вдячна!',
			),
			array(
				'author'  => 'Олена Мельник',
				'title'   => 'Лікар, якому довіряють роками',
				'service' => 'Стоматологія',
				'doctors' => array(),
				'text'    => 'Мені дуже подобається стоматологія в Інституті краси. Пломби, які мені тут поставили дуже давно, до цих пір тримаються! Зробила професійну чистку зубів, лікар уважно вислухав всі мої побажання та зробив все без болю, дискомфорту та поспіху! Сучасне обладнання, новий ремонт, стерилізація, все на вищому рівні!',
			),
		);

		foreach ( $reviews as $order => $review ) {
			$post_id = wp_insert_post(
				array(
					'post_type'   => 'bi_review',
					'post_status' => 'publish',
					'post_title'  => $review['author'] . ' — ' . $review['title'],
					'menu_order'  => $order,
				)
			);
			if ( ! $post_id || is_wp_error( $post_id ) ) {
				continue;
			}

			update_field( 'is_video', 0, $post_id );
			update_field( 'author_name', $review['author'], $post_id );
			update_field( 'title', $review['title'], $post_id );
			update_field( 'service', $review['service'], $post_id );
			update_field( 'text', $review['text'], $post_id );

			$doctor_ids = array();
			foreach ( $review['doctors'] as $short_name ) {
				$doctor_id = bi_seed_find_doctor_by_short_name( $short_name );
				if ( $doctor_id ) {
					$doctor_ids[] = $doctor_id;
				}
			}
			if ( $doctor_ids ) {
				update_field( 'doctors', $doctor_ids, $post_id );
			}
		}

		update_option( 'bi_reviews_text_seeded', 1 );
	},
	100
);
