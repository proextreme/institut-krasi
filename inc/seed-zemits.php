<?php
/**
 * One-time content seed for the "Апарати Zemits" page.
 *
 * Temporary: runs once (guarded by the bi_zemits_seeded option), then this
 * file is removed in a follow-up change. Attachment IDs are the images
 * uploaded to this site's media library.
 *
 * @package beauty-institute
 */

add_action(
	'init',
	function () {
		if ( get_option( 'bi_zemits_seeded' ) ) {
			return;
		}
		if ( ! function_exists( 'update_field' ) ) {
			return;
		}

		$page_id = 33; // "Апарати Zemits".
		if ( 'page' !== get_post_type( $page_id ) ) {
			return;
		}

		// --- Procedures -------------------------------------------------------
		$procedures = array(
			array(
				'title'    => 'Мікрострумова терапія',
				'fields'   => array(
					'device_name' => 'Апарат: Zemits Adrinox 2.0',
					'duration'    => '45–60 хв',
					'photo'       => 71,
					'video_poster' => 72,
					'text'        => 'Безболісна процедура стимуляції м’язів і шкіри слабкими електричними імпульсами. Природне омолодження без операцій та ін’єкцій.',
					'benefits'    => "Підтяжка контуру обличчя\nПідвищення тонусу та еластичності\nЗміцнення м’язів обличчя та шиї\nВідновлення пружності шкіри",
				),
			),
			array(
				'title'  => 'Анти-ейдж ліфтинг',
				'fields' => array(
					'device_name' => 'Апарат: Zemits Adrinox 2.0',
					'duration'    => '60 хв',
					'photo'       => 73,
					'text'        => 'Комплексна програма омолодження для корекції вікових змін шкіри: розгладження зморшок, відновлення чіткості овалу, повернення молодості без хірургічного втручання.',
					'benefits'    => "Розгладження дрібних і середніх зморшок\nЧіткий овал обличчя\nВидимий результат після 1 сеансу",
				),
			),
			array(
				'title'  => 'Гідродаймонд — насичення киснем',
				'fields' => array(
					'device_name'  => 'Апарат: VERSTAND HD PRO',
					'duration'     => '40–50 хв',
					'photo'        => 74,
					'video_poster' => 75,
					'text'         => 'Апаратне очищення шкіри з одночасним насиченням киснем і активними сироватками. Процедура повертає сяяння, вирівнює рельєф і зволожує шкіру в глибоких шарах.',
					'benefits'     => "Миттєвий блиск і чистота\nВирівнювання рельєфу та плям\nГлибоке зволоження",
				),
			),
			array(
				'title'  => 'Комплексний догляд за всіма зонами',
				'fields' => array(
					'device_name' => 'Апарат: VERSTAND HD PRO',
					'duration'    => '90 хв',
					'photo'       => 76,
					'text'        => 'Омолоджувальний догляд не лише для обличчя, але й для шиї, декольте, рук і навіть шкіри голови. Повне відновлення в одному сеансі.',
					'benefits'    => "Обличчя, шия, декольте\nРуки та плечі\nШкіра голови",
				),
			),
		);

		foreach ( $procedures as $order => $proc ) {
			$existing = get_posts( array( "post_type" => "bi_device", "post_status" => "any", "title" => $proc["title"], "fields" => "ids", "posts_per_page" => 1 ) );
			if ( $existing ) {
				continue;
			}
			$id = wp_insert_post(
				array(
					'post_type'   => 'bi_device',
					'post_status' => 'publish',
					'post_title'  => $proc['title'],
					'menu_order'  => $order + 1,
				)
			);
			if ( $id && ! is_wp_error( $id ) ) {
				foreach ( $proc['fields'] as $key => $value ) {
					update_field( $key, $value, $id );
				}
			}
		}

		// --- FAQ ------------------------------------------------------------
		$faqs = array(
			array(
				'Чому нам довіряють?',
				'<p>Це найважливіший критерій. Пацієнти звертаються до нас, тому що:</p><ul><li>є багато позитивних відгуків;</li><li>працюють досвідчені лікарі;</li><li>наш медичний центр має позитивну репутацію.</li></ul>',
			),
			array(
				'Яка кваліфікація у наших спеціалістів?',
				'<p>Наші лікарі мають вищу категорію та багаторічний досвід, регулярно підвищують кваліфікацію на профільних курсах і міжнародних конференціях.</p>',
			),
			array(
				'Чи можна рекомендувати наших лікарів?',
				'<p>Так. Більшість пацієнтів приходять до нас за рекомендацією, а наші спеціалісти мають багато позитивних відгуків.</p>',
			),
			array(
				'Де ми розташовані?',
				'<p>Інститут краси розташований у центрі Києва, на вул. Чикаленка Євгена, 20. Точну адресу та карту дивіться в розділі «Контакти».</p>',
			),
			array(
				'На якому рівні якість сервісу?',
				'<p>Ми приділяємо увагу кожній деталі: комфортні кабінети, дотримання стерильності, уважне ставлення та супровід на всіх етапах.</p>',
			),
			array(
				'Чи сучасне у нас обладнання?',
				'<p>Так. Ми працюємо на сертифікованих американських апаратах Zemits та інших сучасних системах, що регулярно проходять технічне обслуговування.</p>',
			),
		);

		foreach ( $faqs as $order => $faq ) {
			$existing = get_posts( array( 'post_type' => 'bi_faq', 'post_status' => 'any', 'title' => $faq[0], 'fields' => 'ids', 'posts_per_page' => 1 ) );
			if ( $existing ) {
				continue;
			}
			$id = wp_insert_post(
				array(
					'post_type'   => 'bi_faq',
					'post_status' => 'publish',
					'post_title'  => $faq[0],
					'menu_order'  => $order + 1,
				)
			);
			if ( $id && ! is_wp_error( $id ) ) {
				update_field( 'answer', $faq[1], $id );
			}
		}

		// --- Page fields --------------------------------------------------
		$page_fields = array(
			'hero_title'            => 'Апаратна косметологія<br>на обладнанні Zemits',
			'hero_desc'             => 'Косметологічні процедури на сертифікованих американських апаратах Zemits',
			'hero_bg'               => 69,
			'hero_bg_mobile'        => 70,
			'hero_feats'            => "2 апарати Zemits\n5+ видів процедур\nСША виробник",
			'faq_title'             => 'Усе, що ви хотіли запитати',
			'zones_title'           => 'Зони обробки апаратами Zemits:',
			'zones_photo'           => 77,
			'zone_1_title'          => 'Обличчя',
			'zone_1_desc'           => 'Зволоження, ліфтинг, очищення',
			'zone_2_title'          => 'Шия і декольте',
			'zone_2_desc'           => 'Ревіталізація, підтяжка',
			'zone_3_title'          => 'Руки',
			'zone_3_desc'           => 'Омолодження, зволоження',
			'zone_4_title'          => 'Очі і губи',
			'zone_4_desc'           => 'DermeBoost, делікатний догляд',
			'consult_title'         => 'Записатись на прийом',
			'consult_intro_desktop' => 'Не знаєте, яка процедура підійде саме вам? Запишіться на консультацію лікаря-косметолога і ми підберемо програму під ваш тип шкіри.',
			'consult_intro_mobile'  => 'Підберемо програму під ваш тип шкіри.',
		);
		foreach ( $page_fields as $key => $value ) {
			update_field( $key, $value, $page_id );
		}

		update_option( 'bi_zemits_seeded', 1 );
	},
	100
);
