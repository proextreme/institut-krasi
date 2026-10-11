<?php
/**
 * TEMPORARY one-time seed — remove this file (and its require in functions.php)
 * after it has run (option bi_problem_rozatsea_seeded).
 *
 * Fills the "Розацеа" Запит record so it works as a ready reference page:
 *   1. values come from the "Що ми вирішуємо" page (template sho_vyrishuemo.php);
 *   2. gaps are filled from the Figma "Що ми вирішуємо — Розацеа" copy;
 *   3. images the page does not have (it uses theme fallbacks) are added to
 *      the media library from the theme assets.
 * Fields the editor already filled on the record are never overwritten.
 *
 * @package beauty-institute
 */

/**
 * Add a theme asset from assets/images/sho_vyrishuemo/ to the media library once.
 *
 * @param string $file File name inside that folder.
 * @return int Attachment ID, or 0.
 */
function bi_seed_attach_theme_image( $file ) {
	$existing = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'meta_key'       => '_bi_seed_src', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'     => $file, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
		)
	);
	if ( $existing ) {
		return (int) $existing[0];
	}

	$src = get_template_directory() . '/assets/images/sho_vyrishuemo/' . $file;
	if ( ! is_readable( $src ) ) {
		return 0;
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$upload = wp_upload_bits( 'rozatsea-' . $file, null, file_get_contents( $src ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	if ( ! empty( $upload['error'] ) ) {
		return 0;
	}

	$attachment_id = wp_insert_attachment(
		array(
			'post_mime_type' => 'image/webp',
			'post_title'     => sanitize_file_name( pathinfo( $file, PATHINFO_FILENAME ) ),
			'post_status'    => 'inherit',
		),
		$upload['file']
	);
	if ( is_wp_error( $attachment_id ) || ! $attachment_id ) {
		return 0;
	}

	wp_update_attachment_metadata( $attachment_id, wp_generate_attachment_metadata( $attachment_id, $upload['file'] ) );
	update_post_meta( $attachment_id, '_bi_seed_src', $file );

	return (int) $attachment_id;
}

/**
 * Copy the "Що ми вирішуємо" content into the "Розацеа" Запит record.
 */
function bi_seed_problem_rozatsea() {
	if ( get_option( 'bi_problem_rozatsea_seeded' ) || ! function_exists( 'update_field' ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$target = get_page_by_path( 'rozatsea', OBJECT, 'bi_problem' );
	$source = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => array( 'publish', 'private', 'draft' ),
			'posts_per_page' => 1,
			'meta_key'       => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'     => 'sho_vyrishuemo.php', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
			'fields'         => 'ids',
			'no_found_rows'  => true,
		)
	);

	if ( ! $target || ! $source ) {
		return; // Nothing to seed yet — try again on the next admin request.
	}

	$target_id = (int) $target->ID;
	$source_id = (int) $source[0];

	// Field name => field key suffix of group_bi_problem_page.
	$map = array(
		'hero_title'         => 'pp_hero_title',
		'hero_text'          => 'pp_hero_text',
		'hero_bg'            => 'pp_hero_bg',
		'hero_bg_mobile'     => 'pp_hero_bg_mob',
		'intro_title'        => 'pp_intro_title',
		'intro_text'         => 'pp_intro_text',
		'intro_image'        => 'pp_intro_image',
		'types_title'        => 'pp_types_title',
		'types_lead'         => 'pp_types_lead',
		'causes_title'       => 'pp_causes_title',
		'causes_list'        => 'pp_causes_list',
		'symptoms_title'     => 'pp_symptoms_title',
		'symptoms_list'      => 'pp_symptoms_list',
		'stages_title'       => 'pp_stages_title',
		'stages_list'        => 'pp_stages_list',
		'note_title'         => 'pp_note_title',
		'note_text'          => 'pp_note_text',
		'treatment_title'    => 'pp_tr_title',
		'treatment_text'     => 'pp_tr_text',
		'treatment_image'    => 'pp_tr_image',
		'treatment_label'    => 'pp_tr_label',
		'treatment_services' => 'pp_tr_services',
		'doctors_title'      => 'pp_doctors_title',
		'doctors_subtitle'   => 'pp_doctors_subtitle',
		'doctors'            => 'pp_doctors',
		'results_title'      => 'pp_results_title',
		'results_intro'      => 'pp_results_intro',
	);
	for ( $i = 1; $i <= 4; $i++ ) {
		$map[ "type_{$i}_image" ] = "pp_type_{$i}_image";
		$map[ "type_{$i}_title" ] = "pp_type_{$i}_title";
		$map[ "type_{$i}_text" ]  = "pp_type_{$i}_text";
	}
	for ( $i = 1; $i <= 3; $i++ ) {
		$map[ "review_{$i}_topic" ] = "pp_rev_{$i}_topic";
		$map[ "review_{$i}_name" ]  = "pp_rev_{$i}_name";
		$map[ "review_{$i}_photo" ] = "pp_rev_{$i}_photo";
		$map[ "review_{$i}_text" ]  = "pp_rev_{$i}_text";
	}
	for ( $i = 1; $i <= 6; $i++ ) {
		$map[ "result_{$i}" ] = "pp_result_{$i}";
	}

	// Copy from the Figma "Що ми вирішуємо — Розацеа" layout, used where the page has no value.
	$defaults = array(
		'hero_title'         => 'Розацеа — запальне<br>захворювання шкіри',
		'hero_text'          => 'Хронічне запалення шкіри обличчя з почервонінням, судинними сіточками та висипом. Піддається ефективному лікуванню під наглядом лікаря.',
		'intro_title'        => 'Розацеа — хронічне запалення центральної частини обличчя',
		'intro_text'         => '<p>Розацеа — це запальне захворювання шкіри, яке переважно вражає щоки, ніс, підборіддя та лоб. Має хвилеподібний перебіг: загострення чергуються з ремісіями. Захворювання найчастіше зустрічається у жінок зі світлою шкірою віком від 30 до 50 років, але може виникнути в будь-якому віці.</p><p>На жаль, розацеа часто плутають з акне або алергічним почервонінням — і роками лікують неправильно. Тільки лікар-дерматолог може поставити точний діагноз та призначити ефективну терапію.</p>',
		'types_title'        => 'Типи розацеа',
		'types_lead'         => 'У кожного з видів є своя градація ступенів тяжкості.',
		'type_1_title'       => 'Еритематозно-телеангіектатична',
		'type_1_text'        => 'Стійке почервоніння та розширені судинні сіточки. Відчуття жару та поколювання на шкірі.',
		'type_2_title'       => 'Папуло-пустульозна',
		'type_2_text'        => 'Папули та пустули на тлі стійкого почервоніння. Найчастіше плутають з акне.',
		'type_3_title'       => 'Фіматозна (Ринофіма)',
		'type_3_text'        => 'Потовщення шкіри носа та щік, нерівна поверхня. Частіше у чоловіків.',
		'type_4_title'       => 'Очна (Офтальморозацеа)',
		'type_4_text'        => 'Почервоніння, сухість і подразнення очей. Потребує консультації офтальмолога.',
		'causes_title'       => 'Причини та тригери',
		'causes_list'        => "Генетична схильність | Розацеа часто передається у спадок. Якщо хтось із батьків мав це захворювання — ризик вищий.\nУФ-випромінювання | Надмірне перебування на сонці є одним із найпоширеніших тригерів загострення розацеа.\nПерепади температури | Різкий холод, вітер, гаряча їжа, сауна та гарячий душ провокують почервоніння.\nДемодекоз та мікробіом | Надмірне розмноження кліща демодекс та порушення мікробіому шкіри пов'язані з розацеа.",
		'symptoms_title'     => 'Симптоми',
		'symptoms_list'      => "Стійке почервоніння центральної частини обличчя, яке не зникає після усунення подразника\nВидимі розширені кровоносні судини (телеангіектазії, або «судинні зірочки»)\nПапули та пустули, схожі на вугрі, без комедонів\nВідчуття жару, печіння або поколювання на шкірі\nУщільнення шкіри в ділянці носа (ринофіма) — в запущених випадках",
		'stages_title'       => 'Стадії розвитку',
		'stages_list'        => "Припливи | Минущі напади почервоніння, які самостійно проходять\nСтійка еритема | Постійне почервоніння, перші судинні сіточки\nЗапальні елементи | Папули та пустули, відчуття жару і набряк\nРинофіма | Потовщення і деформація шкіри носа",
		'note_title'         => 'Важливо знати!',
		'note_text'          => 'Розацеа не лікується самостійно і з часом прогресує. Чим раніше звернутися до лікаря — тим простіше контролювати захворювання і зберегти зовнішній вигляд шкіри.',
		'treatment_title'    => 'Лікування починається з діагнозу',
		'treatment_text'     => '<p>В Інституті Краси лікування розацеа завжди починається з консультації лікаря-дерматолога. Лікар встановлює тип і стадію захворювання, виявляє тригери та підбирає індивідуальну програму терапії.</p><p>В залежності від стадії та типу розацеа, ми поєднуємо медикаментозне лікування з апаратними та догляд-процедурами.</p>',
		'treatment_label'    => 'Послуги, які ми радимо:',
		'treatment_services' => "Консультація дерматолога | Огляд, встановлення діагнозу, виявлення тригерів. Лікар визначить тип розацеа і призначить лікування.\nФотоомолодження (IPL) | Ефективне видалення судинних сіточок та зменшення почервоніння за допомогою імпульсного світла.\nМікрострумова терапія (Zemits) | Зменшує запалення, покращує мікроциркуляцію та відновлює бар'єрну функцію шкіри при розацеа.\nМедикаментозна терапія | Призначення топічних і системних препаратів — метронідазолу, азелаїнової кислоти, антибіотиків за показаннями.",
		'doctors_title'      => 'Лікарі',
		'doctors_subtitle'   => 'Наші дерматологи ведуть прийом щоденно. Консультація включає огляд, постановку діагнозу та призначення індивідуального плану лікування.',
		'review_1_topic'     => 'Позбулася постійного почервоніння',
		'review_1_name'      => 'Олена',
		'review_1_text'      => 'Довгий час я не могла зрозуміти, чому шкіра на щоках постійно червоніє, а звичайні засоби для чутливої шкіри не допомагають. Після консультації мені діагностували розацеа та підібрали індивідуальну програму лікування. Зараз моя шкіра виглядає значно спокійнішою та здоровішою. Дуже вдячна лікарю за професійний підхід.',
		'results_title'      => 'До та після',
		'results_intro'      => 'Наші результати підкреслюють ваші індивідуальні риси.',
	);

	// Theme assets used when the page has no image of its own.
	$image_defaults = array(
		'hero_bg'         => 'hero_bg.webp',
		'hero_bg_mobile'  => 'hero_bg_mob.webp',
		'intro_image'     => 'rozatsea_khronichne.webp',
		'treatment_image' => 'likuvannya_pochynaietsya.webp',
		'type_1_image'    => '01.webp',
		'type_2_image'    => '01_1.webp',
		'type_3_image'    => '01_2.webp',
		'type_4_image'    => '01_3.webp',
	);

	// The page's hero text is the generic "pick a request" intro, not this request's.
	$design_only = array( 'hero_text' );

	$is_empty = static function ( $value ) {
		return null === $value || '' === $value || false === $value || array() === $value || 0 === $value || '0' === $value;
	};

	foreach ( $map as $name => $suffix ) {
		if ( ! $is_empty( get_field( $name, $target_id, false ) ) ) {
			continue; // Already filled on the record — never overwrite.
		}

		$value = in_array( $name, $design_only, true ) ? '' : get_field( $name, $source_id, false );

		if ( $is_empty( $value ) && isset( $defaults[ $name ] ) ) {
			$value = $defaults[ $name ];
		}
		if ( $is_empty( $value ) && isset( $image_defaults[ $name ] ) ) {
			$value = bi_seed_attach_theme_image( $image_defaults[ $name ] );
		}
		if ( $is_empty( $value ) ) {
			continue;
		}

		update_field( 'field_bi_' . $suffix, $value, $target_id );
	}

	update_option( 'bi_problem_rozatsea_seeded', 1 );
}
add_action( 'admin_init', 'bi_seed_problem_rozatsea' );
