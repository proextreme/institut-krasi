<?php
/**
 * ACF field groups, registered in code so they travel with the theme
 * and stay under version control. Editors change values, not definitions.
 *
 * Field-group keys use the group_bi_* prefix to avoid clashing with any
 * groups created through the ACF admin UI.
 *
 * @package beauty-institute
 */

/**
 * Small helper to keep field definitions terse.
 *
 * @param string $key   Unique field key suffix.
 * @param string $label Admin label.
 * @param string $name  Field name used in templates.
 * @param string $type  ACF field type.
 * @param array  $args  Extra field args.
 * @return array
 */
function bi_acf_field( $key, $label, $name, $type = 'text', $args = array() ) {
	return array_merge(
		array(
			'key'   => 'field_bi_' . $key,
			'label' => $label,
			'name'  => $name,
			'type'  => $type,
		),
		$args
	);
}

/**
 * Register all theme field groups.
 */
function beauty_institute_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	beauty_institute_acf_group_settings();
	beauty_institute_acf_group_home();
	beauty_institute_acf_group_contact();
	beauty_institute_acf_group_about();
	beauty_institute_acf_group_doctor();
	beauty_institute_acf_group_problem();
	beauty_institute_acf_group_review();
	beauty_institute_acf_group_reviews_page();
	beauty_institute_acf_group_result();
	beauty_institute_acf_group_faq();
	beauty_institute_acf_group_device();
	beauty_institute_acf_group_zemits();
}
add_action( 'acf/include_fields', 'beauty_institute_register_acf_fields' );

/**
 * Location helper: one rule, post type equals.
 *
 * @param string $post_type Post type slug.
 * @return array
 */
function bi_acf_location_post_type( $post_type ) {
	return array(
		array(
			array(
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => $post_type,
			),
		),
	);
}

/**
 * Лікар — profile fields.
 */
function beauty_institute_acf_group_doctor() {
	$certs = array(
		bi_acf_field( 'doc_certs_intro', __( 'Опис блоку сертифікатів', 'beauty-institute' ), 'certs_intro', 'text' ),
	);
	for ( $i = 1; $i <= 6; $i++ ) {
		$certs[] = bi_acf_field( "doc_cert_{$i}_label", sprintf( __( 'Сертифікат %d — назва', 'beauty-institute' ), $i ), "cert_{$i}_label", 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
		$certs[] = bi_acf_field( "doc_cert_{$i}_year", sprintf( __( 'Сертифікат %d — рік', 'beauty-institute' ), $i ), "cert_{$i}_year", 'text', array( 'wrapper' => array( 'width' => '20' ) ) );
		$certs[] = bi_acf_field( "doc_cert_{$i}_file", sprintf( __( 'Сертифікат %d — файл', 'beauty-institute' ), $i ), "cert_{$i}_file", 'file', array( 'return_format' => 'url', 'wrapper' => array( 'width' => '30' ) ) );
	}

	acf_add_local_field_group(
		array(
			'key'      => 'group_bi_doctor',
			'title'    => __( 'Дані лікаря', 'beauty-institute' ),
			'fields'   => array_merge(
				array(
					bi_acf_field( 'doc_tab_main', __( 'Основне', 'beauty-institute' ), '', 'tab' ),
					bi_acf_field( 'doc_photo', __( 'Фото', 'beauty-institute' ), 'photo', 'image', array( 'return_format' => 'id', 'preview_size' => 'medium' ) ),
					bi_acf_field( 'doc_short_name', __( 'Коротке імʼя (для тегів у відгуках)', 'beauty-institute' ), 'short_name', 'text', array( 'placeholder' => 'Трембач О.М.' ) ),
					bi_acf_field( 'doc_position', __( 'Посада / регалії', 'beauty-institute' ), 'position', 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),
					bi_acf_field( 'doc_since', __( 'Стаж (рядок під посадою)', 'beauty-institute' ), 'since', 'text', array( 'placeholder' => 'Працює в косметології з 2012 року.' ) ),
					bi_acf_field( 'doc_bio', __( 'Біографія', 'beauty-institute' ), 'bio', 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),

					bi_acf_field( 'doc_tab_card', __( 'Картка (список / головна)', 'beauty-institute' ), '', 'tab' ),
					bi_acf_field( 'doc_role', __( 'Спеціалізація — напис над ФІО у списку лікарів', 'beauty-institute' ), 'role', 'text', array( 'placeholder' => 'Естетичний хірург' ) ),
					bi_acf_field( 'doc_card_description', __( 'Короткий опис — під підписом у картці на головній', 'beauty-institute' ), 'card_description', 'text', array( 'placeholder' => 'Професійна оцінка можливостей естетичної корекції.' ) ),

					bi_acf_field( 'doc_tab_lists', __( 'Списки', 'beauty-institute' ), '', 'tab' ),
					bi_acf_field( 'doc_specialization_list', __( 'Спеціалізація (по одному пункту на рядок)', 'beauty-institute' ), 'specialization_list', 'textarea', array( 'rows' => 6 ) ),
					bi_acf_field( 'doc_services_list', __( 'Послуги (по одному пункту на рядок)', 'beauty-institute' ), 'services_list', 'textarea', array( 'rows' => 8 ) ),

					bi_acf_field( 'doc_tab_certs', __( 'Сертифікати', 'beauty-institute' ), '', 'tab' ),
				),
				$certs
			),
			'location' => bi_acf_location_post_type( 'bi_doctor' ),
			'active'   => true,
		)
	);
}

/**
 * Запит («Що ми вирішуємо») — card + page fields.
 */
function beauty_institute_acf_group_problem() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_bi_problem',
			'title'    => __( 'Дані запиту', 'beauty-institute' ),
			'fields'   => array(
				bi_acf_field( 'prob_card_image', __( 'Зображення картки', 'beauty-institute' ), 'card_image', 'image', array( 'return_format' => 'id', 'preview_size' => 'medium', 'instructions' => __( 'Якщо порожньо — береться головне зображення запису.', 'beauty-institute' ) ) ),
				bi_acf_field( 'prob_lead', __( 'Короткий опис', 'beauty-institute' ), 'lead', 'textarea', array( 'rows' => 3 ) ),
			),
			'location' => bi_acf_location_post_type( 'bi_problem' ),
			'active'   => true,
		)
	);
}

/**
 * Відгук — block-only content (text or video).
 */
function beauty_institute_acf_group_review() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_bi_review',
			'title'    => __( 'Дані відгуку', 'beauty-institute' ),
			'fields'   => array(
				bi_acf_field(
					'rev_is_video',
					__( 'Це відеовідгук', 'beauty-institute' ),
					'is_video',
					'true_false',
					array( 'ui' => 1, 'instructions' => __( 'Увімкніть для відео. Текстові та відео-відгуки показуються в різних блоках.', 'beauty-institute' ) )
				),
				bi_acf_field( 'rev_author', __( 'Ім’я автора', 'beauty-institute' ), 'author_name', 'text' ),
				bi_acf_field( 'rev_title', __( 'Заголовок відгуку', 'beauty-institute' ), 'title', 'text', array( 'placeholder' => 'Турбота та професіоналізм' ) ),
				bi_acf_field( 'rev_service', __( 'Послуга / процедура (тег)', 'beauty-institute' ), 'service', 'text', array( 'placeholder' => 'Консультація косметолога' ) ),
				bi_acf_field(
					'rev_doctors',
					__( 'Лікарі (теги + звʼязок зі сторінкою лікаря)', 'beauty-institute' ),
					'doctors',
					'relationship',
					array( 'post_type' => array( 'bi_doctor' ), 'return_format' => 'id', 'filters' => array( 'search' ) )
				),
				bi_acf_field(
					'rev_text',
					__( 'Текст відгуку', 'beauty-institute' ),
					'text',
					'textarea',
					array( 'rows' => 6, 'conditional_logic' => array( array( array( 'field' => 'field_bi_rev_is_video', 'operator' => '!=', 'value' => '1' ) ) ) )
				),
				bi_acf_field(
					'rev_photo',
					__( 'Фото автора', 'beauty-institute' ),
					'photo',
					'image',
					array( 'return_format' => 'id', 'preview_size' => 'thumbnail', 'conditional_logic' => array( array( array( 'field' => 'field_bi_rev_is_video', 'operator' => '!=', 'value' => '1' ) ) ) )
				),
				bi_acf_field(
					'rev_video_url',
					__( 'Посилання на YouTube-відео', 'beauty-institute' ),
					'video_url',
					'url',
					array( 'conditional_logic' => array( array( array( 'field' => 'field_bi_rev_is_video', 'operator' => '==', 'value' => '1' ) ) ) )
				),
				bi_acf_field(
					'rev_video_poster',
					__( 'Обкладинка відео', 'beauty-institute' ),
					'video_poster',
					'image',
					array( 'return_format' => 'id', 'preview_size' => 'medium', 'conditional_logic' => array( array( array( 'field' => 'field_bi_rev_is_video', 'operator' => '==', 'value' => '1' ) ) ) )
				),
			),
			'location' => bi_acf_location_post_type( 'bi_review' ),
			'active'   => true,
		)
	);
}

/**
 * Сторінка «Відгуки».
 */
function beauty_institute_acf_group_reviews_page() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_bi_reviews_page',
			'title'    => __( 'Сторінка «Відгуки»', 'beauty-institute' ),
			'fields'   => array(
				bi_acf_field( 'revp_hero_desc', __( 'Вступний текст', 'beauty-institute' ), 'hero_desc', 'textarea', array( 'rows' => 4 ) ),
				bi_acf_field( 'revp_videos_title', __( 'Відеовідгуки — заголовок', 'beauty-institute' ), 'videos_title', 'text', array( 'placeholder' => 'Відеовідгуки' ) ),
				bi_acf_field( 'revp_videos_text', __( 'Відеовідгуки — текст', 'beauty-institute' ), 'videos_text', 'textarea', array( 'rows' => 3 ) ),
				bi_acf_field( 'revp_consult_title', __( 'Блок запису — заголовок', 'beauty-institute' ), 'consult_title', 'text', array( 'placeholder' => 'Ваша думка важлива' ) ),
				bi_acf_field( 'revp_consult_desktop', __( 'Блок запису — текст (десктоп)', 'beauty-institute' ), 'consult_intro_desktop', 'textarea', array( 'rows' => 2 ) ),
				bi_acf_field( 'revp_consult_mobile', __( 'Блок запису — текст (мобільний)', 'beauty-institute' ), 'consult_intro_mobile', 'textarea', array( 'rows' => 2 ) ),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'reviews.php',
					),
				),
			),
			'active'   => true,
		)
	);
}

/**
 * Питання (FAQ) — question is the post title.
 */
function beauty_institute_acf_group_faq() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_bi_faq',
			'title'    => __( 'Відповідь', 'beauty-institute' ),
			'fields'   => array(
				bi_acf_field( 'faq_answer', __( 'Відповідь', 'beauty-institute' ), 'answer', 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),
			),
			'location' => bi_acf_location_post_type( 'bi_faq' ),
			'active'   => true,
		)
	);
}

/**
 * Апаратна процедура (Zemits).
 */
function beauty_institute_acf_group_device() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_bi_device',
			'title'    => __( 'Дані процедури', 'beauty-institute' ),
			'fields'   => array(
				bi_acf_field( 'dev_device_name', __( 'Апарат', 'beauty-institute' ), 'device_name', 'text', array( 'placeholder' => 'Zemits Adrinox 2.0', 'wrapper' => array( 'width' => '60' ) ) ),
				bi_acf_field( 'dev_duration', __( 'Тривалість', 'beauty-institute' ), 'duration', 'text', array( 'placeholder' => '45–60 хв', 'wrapper' => array( 'width' => '40' ) ) ),
				bi_acf_field( 'dev_photo', __( 'Фото процедури', 'beauty-institute' ), 'photo', 'image', array( 'return_format' => 'id', 'preview_size' => 'medium' ) ),
				bi_acf_field( 'dev_text', __( 'Опис', 'beauty-institute' ), 'text', 'textarea', array( 'rows' => 4 ) ),
				bi_acf_field( 'dev_benefits', __( 'Переваги (по одній на рядок)', 'beauty-institute' ), 'benefits', 'textarea', array( 'rows' => 4 ) ),
				bi_acf_field( 'dev_video_url', __( 'YouTube-відео (необовʼязково)', 'beauty-institute' ), 'video_url', 'url' ),
				bi_acf_field(
					'dev_video_poster',
					__( 'Обкладинка відео', 'beauty-institute' ),
					'video_poster',
					'image',
					array( 'return_format' => 'id', 'preview_size' => 'medium', 'conditional_logic' => array( array( array( 'field' => 'field_bi_dev_video_url', 'operator' => '!=', 'value' => '' ) ) ) )
				),
				bi_acf_field(
					'dev_layout',
					__( 'Розташування блоку', 'beauty-institute' ),
					'layout',
					'select',
					array(
						'choices'      => array(
							''       => __( 'Авто (через один)', 'beauty-institute' ),
							'type_1' => __( 'Фото зверху', 'beauty-institute' ),
							'type_2' => __( 'Текст ліворуч', 'beauty-institute' ),
						),
						'allow_null'   => 0,
						'instructions' => __( '«Авто» чергує блоки: 1-й, 3-й — фото зверху; 2-й, 4-й — текст ліворуч.', 'beauty-institute' ),
					)
				),
			),
			'location' => bi_acf_location_post_type( 'bi_device' ),
			'active'   => true,
		)
	);
}

/**
 * Сторінка «Апарати Zemits».
 */
function beauty_institute_acf_group_zemits() {
	$zones = array();
	for ( $i = 1; $i <= 4; $i++ ) {
		$zones[] = bi_acf_field( "zem_zone_{$i}_title", sprintf( __( 'Зона %d — назва', 'beauty-institute' ), $i ), "zone_{$i}_title", 'text', array( 'wrapper' => array( 'width' => '40' ) ) );
		$zones[] = bi_acf_field( "zem_zone_{$i}_desc", sprintf( __( 'Зона %d — опис', 'beauty-institute' ), $i ), "zone_{$i}_desc", 'text', array( 'wrapper' => array( 'width' => '60' ) ) );
	}

	acf_add_local_field_group(
		array(
			'key'      => 'group_bi_zemits',
			'title'    => __( 'Сторінка «Апарати Zemits»', 'beauty-institute' ),
			'fields'   => array_merge(
				array(
					bi_acf_field( 'zem_tab_hero', __( 'Hero', 'beauty-institute' ), '', 'tab' ),
					bi_acf_field( 'zem_hero_title', __( 'Заголовок', 'beauty-institute' ), 'hero_title', 'text', array( 'instructions' => __( 'Можна <br>.', 'beauty-institute' ) ) ),
					bi_acf_field( 'zem_hero_desc', __( 'Підзаголовок', 'beauty-institute' ), 'hero_desc', 'text' ),
					bi_acf_field( 'zem_hero_btn', __( 'Кнопка', 'beauty-institute' ), 'hero_btn', 'link' ),
					bi_acf_field( 'zem_hero_bg', __( 'Фон (десктоп)', 'beauty-institute' ), 'hero_bg', 'image', array( 'return_format' => 'id', 'preview_size' => 'medium' ) ),
					bi_acf_field( 'zem_hero_bg_mob', __( 'Фон (мобільний)', 'beauty-institute' ), 'hero_bg_mobile', 'image', array( 'return_format' => 'id', 'preview_size' => 'medium' ) ),
					bi_acf_field( 'zem_hero_feats', __( 'Плашки (по одній на рядок)', 'beauty-institute' ), 'hero_feats', 'textarea', array( 'rows' => 3 ) ),

					bi_acf_field( 'zem_tab_faq', __( 'FAQ', 'beauty-institute' ), '', 'tab' ),
					bi_acf_field( 'zem_faq_title', __( 'Заголовок', 'beauty-institute' ), 'faq_title', 'text', array( 'placeholder' => 'Усе, що ви хотіли запитати' ) ),
					bi_acf_field(
						'zem_faq_group',
						__( 'Група питань', 'beauty-institute' ),
						'faq_group',
						'taxonomy',
						array( 'taxonomy' => 'bi_faq_group', 'field_type' => 'select', 'add_term' => 1, 'save_terms' => 0, 'load_terms' => 0, 'return_format' => 'id', 'allow_null' => 1, 'instructions' => __( 'Порожньо — усі питання розділу FAQ.', 'beauty-institute' ) )
					),

					bi_acf_field( 'zem_tab_zones', __( 'Зони обробки', 'beauty-institute' ), '', 'tab' ),
					bi_acf_field( 'zem_zones_title', __( 'Заголовок', 'beauty-institute' ), 'zones_title', 'text', array( 'placeholder' => 'Зони обробки апаратами Zemits:' ) ),
					bi_acf_field( 'zem_zones_photo', __( 'Фото', 'beauty-institute' ), 'zones_photo', 'image', array( 'return_format' => 'id', 'preview_size' => 'thumbnail' ) ),
				),
				$zones,
				array(
					bi_acf_field( 'zem_tab_consult', __( 'Запис', 'beauty-institute' ), '', 'tab' ),
					bi_acf_field( 'zem_consult_title', __( 'Заголовок', 'beauty-institute' ), 'consult_title', 'text', array( 'placeholder' => 'Записатись на прийом' ) ),
					bi_acf_field( 'zem_consult_desktop', __( 'Текст (десктоп)', 'beauty-institute' ), 'consult_intro_desktop', 'textarea', array( 'rows' => 3 ) ),
					bi_acf_field( 'zem_consult_mobile', __( 'Текст (мобільний)', 'beauty-institute' ), 'consult_intro_mobile', 'textarea', array( 'rows' => 2 ) ),
				)
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'zemits.php',
					),
				),
			),
			'active'   => true,
		)
	);
}

/**
 * Результат «До та після» — block-only content.
 */
function beauty_institute_acf_group_result() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_bi_result',
			'title'    => __( 'Дані результату', 'beauty-institute' ),
			'fields'   => array(
				bi_acf_field( 'res_image', __( 'Зображення «до / після»', 'beauty-institute' ), 'image', 'image', array( 'return_format' => 'id', 'preview_size' => 'medium', 'instructions' => __( 'Якщо порожньо — береться головне зображення запису.', 'beauty-institute' ) ) ),
				bi_acf_field( 'res_procedure', __( 'Процедура / підпис', 'beauty-institute' ), 'procedure', 'text' ),
			),
			'location' => bi_acf_location_post_type( 'bi_result' ),
			'active'   => true,
		)
	);
}

/**
 * Контакти page group (location: the Contact page template).
 */
function beauty_institute_acf_group_contact() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_bi_contact',
			'title'    => __( 'Сторінка «Контакти»', 'beauty-institute' ),
			'fields'   => array(
				bi_acf_field( 'contact_hero_title', __( 'Заголовок', 'beauty-institute' ), 'hero_title', 'text', array( 'placeholder' => 'Наші контакти' ) ),
				bi_acf_field( 'contact_hero_bg', __( 'Фонове зображення (десктоп)', 'beauty-institute' ), 'hero_bg', 'image', array( 'return_format' => 'id', 'preview_size' => 'medium' ) ),
				bi_acf_field( 'contact_hero_bg_mobile', __( 'Фонове зображення (мобільний)', 'beauty-institute' ), 'hero_bg_mobile', 'image', array( 'return_format' => 'id', 'preview_size' => 'medium' ) ),
				bi_acf_field( 'contact_feats', __( 'Плашки під заголовком (по одній на рядок)', 'beauty-institute' ), 'hero_feats', 'textarea', array( 'rows' => 3, 'instructions' => __( 'Порожньо — показується графік роботи з налаштувань сайту.', 'beauty-institute' ) ) ),
				bi_acf_field( 'contact_find_title', __( 'Блок «Як нас знайти» — заголовок', 'beauty-institute' ), 'find_title', 'text', array( 'placeholder' => 'Як нас знайти' ) ),
				bi_acf_field( 'contact_find_text', __( 'Блок «Як нас знайти» — текст', 'beauty-institute' ), 'find_text', 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'contact.php',
					),
				),
			),
			'active'   => true,
		)
	);
}

/**
 * Сторінка «Про нас».
 */
function beauty_institute_acf_group_about() {
	$img = function ( $key, $label ) {
		return bi_acf_field( $key, $label, str_replace( 'ab_', '', $key ), 'image', array( 'return_format' => 'id', 'preview_size' => 'thumbnail', 'wrapper' => array( 'width' => '25' ) ) );
	};

	$about_cards = array();
	for ( $i = 1; $i <= 6; $i++ ) {
		$about_cards[] = bi_acf_field( "ab_card_{$i}_title", sprintf( __( 'Картка %d — заголовок', 'beauty-institute' ), $i ), "card_{$i}_title", 'text' );
		$about_cards[] = bi_acf_field( "ab_card_{$i}_text", sprintf( __( 'Картка %d — текст', 'beauty-institute' ), $i ), "card_{$i}_text", 'textarea', array( 'rows' => 3 ) );
	}

	$certs = array();
	for ( $i = 1; $i <= 6; $i++ ) {
		$certs[] = bi_acf_field( "ab_cert_{$i}_image", sprintf( __( 'Сертифікат %d — зображення', 'beauty-institute' ), $i ), "cert_{$i}_image", 'image', array( 'return_format' => 'id', 'preview_size' => 'thumbnail', 'wrapper' => array( 'width' => '25' ) ) );
		$certs[] = bi_acf_field( "ab_cert_{$i}_name", sprintf( __( 'Сертифікат %d — назва', 'beauty-institute' ), $i ), "cert_{$i}_name", 'text', array( 'wrapper' => array( 'width' => '35' ) ) );
		$certs[] = bi_acf_field( "ab_cert_{$i}_year", sprintf( __( 'Сертифікат %d — рік', 'beauty-institute' ), $i ), "cert_{$i}_year", 'text', array( 'wrapper' => array( 'width' => '15' ) ) );
		$certs[] = bi_acf_field( "ab_cert_{$i}_link", sprintf( __( 'Сертифікат %d — файл/посилання', 'beauty-institute' ), $i ), "cert_{$i}_link", 'file', array( 'return_format' => 'url', 'wrapper' => array( 'width' => '25' ) ) );
	}

	acf_add_local_field_group(
		array(
			'key'      => 'group_bi_about',
			'title'    => __( 'Сторінка «Про нас»', 'beauty-institute' ),
			'fields'   => array_merge(
				array(
					bi_acf_field( 'ab_tab_hero', __( 'Hero', 'beauty-institute' ), '', 'tab' ),
					bi_acf_field( 'ab_hero_title', __( 'Заголовок', 'beauty-institute' ), 'hero_title', 'text', array( 'instructions' => __( 'Можна використати <br> для переносу.', 'beauty-institute' ) ) ),
					bi_acf_field( 'ab_hero_text', __( 'Підзаголовок', 'beauty-institute' ), 'hero_text', 'text' ),
					$img( 'ab_hero_img_1', __( 'Галерея 1', 'beauty-institute' ) ),
					$img( 'ab_hero_img_2', __( 'Галерея 2', 'beauty-institute' ) ),
					$img( 'ab_hero_img_3', __( 'Галерея 3', 'beauty-institute' ) ),
					$img( 'ab_hero_img_4', __( 'Галерея 4', 'beauty-institute' ) ),

					bi_acf_field( 'ab_tab_tour', __( '3D-екскурсія', 'beauty-institute' ), '', 'tab' ),
					bi_acf_field( 'ab_tour_title', __( 'Заголовок', 'beauty-institute' ), 'tour_title', 'text' ),
					bi_acf_field( 'ab_tour_text', __( 'Текст', 'beauty-institute' ), 'tour_text', 'textarea', array( 'rows' => 2 ) ),
					bi_acf_field( 'ab_tour_poster', __( 'Постер відео', 'beauty-institute' ), 'tour_poster', 'image', array( 'return_format' => 'id', 'preview_size' => 'medium' ) ),
					bi_acf_field( 'ab_tour_youtube', __( 'YouTube ID відео', 'beauty-institute' ), 'tour_youtube_id', 'text', array( 'placeholder' => 'rAx1qYtXI28' ) ),

					bi_acf_field( 'ab_tab_work', __( 'Ми працюємо', 'beauty-institute' ), '', 'tab' ),
					bi_acf_field( 'ab_stat_1_num', __( 'Показник 1 — число', 'beauty-institute' ), 'stat_1_number', 'text', array( 'wrapper' => array( 'width' => '25' ), 'placeholder' => '75' ) ),
					bi_acf_field( 'ab_stat_1_txt', __( 'Показник 1 — підпис', 'beauty-institute' ), 'stat_1_text', 'text', array( 'wrapper' => array( 'width' => '25' ), 'placeholder' => 'років досвіду' ) ),
					bi_acf_field( 'ab_stat_2_num', __( 'Показник 2 — число', 'beauty-institute' ), 'stat_2_number', 'text', array( 'wrapper' => array( 'width' => '25' ), 'placeholder' => '23' ) ),
					bi_acf_field( 'ab_stat_2_txt', __( 'Показник 2 — підпис', 'beauty-institute' ), 'stat_2_text', 'text', array( 'wrapper' => array( 'width' => '25' ), 'placeholder' => 'видів косметологічних послуг' ) ),
					bi_acf_field( 'ab_work_img_1', __( 'Зображення 1', 'beauty-institute' ), 'work_image_1', 'image', array( 'return_format' => 'id', 'preview_size' => 'thumbnail', 'wrapper' => array( 'width' => '50' ) ) ),
					bi_acf_field( 'ab_work_img_2', __( 'Зображення 2', 'beauty-institute' ), 'work_image_2', 'image', array( 'return_format' => 'id', 'preview_size' => 'thumbnail', 'wrapper' => array( 'width' => '50' ) ) ),
					bi_acf_field( 'ab_quote_text', __( 'Цитата', 'beauty-institute' ), 'quote_text', 'textarea', array( 'rows' => 3 ) ),
					bi_acf_field( 'ab_quote_author', __( 'Автор цитати', 'beauty-institute' ), 'quote_author', 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
					bi_acf_field( 'ab_quote_role', __( 'Посада автора', 'beauty-institute' ), 'quote_role', 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),

					bi_acf_field( 'ab_tab_about', __( 'Про інститут', 'beauty-institute' ), '', 'tab' ),
					bi_acf_field( 'ab_about_title', __( 'Заголовок', 'beauty-institute' ), 'about_title', 'text' ),
					bi_acf_field( 'ab_about_lead', __( 'Лід 1', 'beauty-institute' ), 'about_lead', 'textarea', array( 'rows' => 3 ) ),
					bi_acf_field( 'ab_about_sub', __( 'Лід 2', 'beauty-institute' ), 'about_sub', 'textarea', array( 'rows' => 3 ) ),
					bi_acf_field( 'ab_about_image', __( 'Зображення', 'beauty-institute' ), 'about_image', 'image', array( 'return_format' => 'id', 'preview_size' => 'medium' ) ),
				),
				$about_cards,
				array(
					bi_acf_field( 'ab_tab_doctors', __( 'Наші лікарі', 'beauty-institute' ), '', 'tab' ),
					bi_acf_field( 'ab_doctors_title', __( 'Заголовок', 'beauty-institute' ), 'doctors_title', 'text' ),
					bi_acf_field( 'ab_doctors_list', __( 'Список (по одному пункту на рядок)', 'beauty-institute' ), 'doctors_list', 'textarea', array( 'rows' => 5 ) ),
					bi_acf_field( 'ab_doctors_btn', __( 'Кнопка', 'beauty-institute' ), 'doctors_btn', 'link' ),
					bi_acf_field( 'ab_doctors_img_1', __( 'Фото 1', 'beauty-institute' ), 'doctors_image_1', 'image', array( 'return_format' => 'id', 'preview_size' => 'thumbnail', 'wrapper' => array( 'width' => '50' ) ) ),
					bi_acf_field( 'ab_doctors_img_2', __( 'Фото 2', 'beauty-institute' ), 'doctors_image_2', 'image', array( 'return_format' => 'id', 'preview_size' => 'thumbnail', 'wrapper' => array( 'width' => '50' ) ) ),

					bi_acf_field( 'ab_tab_results', __( 'Результати', 'beauty-institute' ), '', 'tab' ),
					bi_acf_field( 'ab_results_title', __( 'Заголовок', 'beauty-institute' ), 'results_title', 'text' ),
					bi_acf_field( 'ab_results_text', __( 'Текст', 'beauty-institute' ), 'results_text', 'textarea', array( 'rows' => 3 ) ),
					bi_acf_field( 'ab_results_note', __( 'Джерело', 'beauty-institute' ), '', 'message', array( 'message' => __( 'Роботи беруться з розділу «До та після». Вкладки — це «Категорії результатів».', 'beauty-institute' ) ) ),

					bi_acf_field( 'ab_tab_certs', __( 'Сертифікати', 'beauty-institute' ), '', 'tab' ),
					bi_acf_field( 'ab_certs_title', __( 'Заголовок', 'beauty-institute' ), 'certs_title', 'text' ),
				),
				$certs,
				array(
					bi_acf_field( 'ab_tab_find', __( 'Як нас знайти', 'beauty-institute' ), '', 'tab' ),
					bi_acf_field( 'ab_find_title', __( 'Заголовок', 'beauty-institute' ), 'find_title', 'text' ),
					bi_acf_field( 'ab_find_text', __( 'Текст', 'beauty-institute' ), 'find_text', 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),
				)
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'about-us.php',
					),
				),
			),
			'active'   => true,
		)
	);
}

/**
 * Global "Налаштування сайту" group (free-ACF stand-in for an options page).
 */
function beauty_institute_acf_group_settings() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_bi_settings',
			'title'    => __( 'Налаштування сайту', 'beauty-institute' ),
			'fields'   => array(
				bi_acf_field( 'set_tab_contacts', __( 'Контакти', 'beauty-institute' ), '', 'tab' ),
				bi_acf_field( 'phone_1', __( 'Телефон 1', 'beauty-institute' ), 'phone_1', 'text' ),
				bi_acf_field( 'phone_2', __( 'Телефон 2', 'beauty-institute' ), 'phone_2', 'text' ),
				bi_acf_field( 'email', 'E-mail', 'email', 'text' ),
				bi_acf_field( 'address_locality', __( 'Місто (напівжирне, для підвалу)', 'beauty-institute' ), 'address_locality', 'text', array( 'placeholder' => 'м. Київ' ) ),
				bi_acf_field( 'address_region', __( 'Регіон / індекс (підпис у блоці «Як нас знайти»)', 'beauty-institute' ), 'address_region', 'text', array( 'placeholder' => 'Україна, м. Київ, 01024' ) ),
				bi_acf_field( 'address_street', __( 'Адреса (вулиця, будинок, приміщення)', 'beauty-institute' ), 'address_street', 'text', array( 'placeholder' => 'вул. Чикаленка Євгена, буд. 20, приміщення №49' ) ),
				bi_acf_field( 'edrpou', __( 'Код ЄДРПОУ', 'beauty-institute' ), 'edrpou', 'text' ),
				bi_acf_field( 'work_hours', __( 'Графік роботи', 'beauty-institute' ), 'work_hours', 'text', array( 'placeholder' => 'Щодня з 9:00 до 21:00' ) ),

				bi_acf_field( 'set_tab_social', __( 'Соцмережі', 'beauty-institute' ), '', 'tab' ),
				bi_acf_field( 'social_instagram', 'Instagram', 'social_instagram', 'url' ),
				bi_acf_field( 'social_facebook', 'Facebook', 'social_facebook', 'url' ),
				bi_acf_field( 'social_youtube', 'YouTube', 'social_youtube', 'url' ),
				bi_acf_field( 'social_threads', 'Threads', 'social_threads', 'url' ),
				bi_acf_field( 'social_telegram', 'Telegram', 'social_telegram', 'url' ),
				bi_acf_field( 'social_whatsapp', 'WhatsApp', 'social_whatsapp', 'url' ),
				bi_acf_field( 'social_messenger', 'Messenger', 'social_messenger', 'url' ),

				bi_acf_field( 'set_tab_map', __( 'Карта', 'beauty-institute' ), '', 'tab' ),
				bi_acf_field(
					'map_embed',
					__( 'Google Maps — код <iframe> або посилання embed', 'beauty-institute' ),
					'map_embed',
					'textarea',
					array( 'rows' => 4 )
				),

				bi_acf_field( 'set_tab_forms', __( 'Форми', 'beauty-institute' ), '', 'tab' ),
				bi_acf_field(
					'consult_form_shortcode',
					__( 'Шорткод форми «Запис на консультацію» (Contact Form 7)', 'beauty-institute' ),
					'consult_form_shortcode',
					'text',
					array(
						'placeholder'  => '[contact-form-7 id="123" title="Консультація"]',
						'instructions' => __( 'Використовується у блоках запису на всіх сторінках.', 'beauty-institute' ),
					)
				),
				bi_acf_field( 'consult_title', __( 'Блок запису — заголовок', 'beauty-institute' ), 'consult_title', 'text', array( 'placeholder' => 'Запис на консультацію' ) ),
				bi_acf_field( 'consult_intro_desktop', __( 'Блок запису — текст (десктоп)', 'beauty-institute' ), 'consult_intro_desktop', 'textarea', array( 'rows' => 3 ) ),
				bi_acf_field( 'consult_intro_mobile', __( 'Блок запису — текст (мобільний)', 'beauty-institute' ), 'consult_intro_mobile', 'textarea', array( 'rows' => 2 ) ),

				bi_acf_field( 'set_tab_footer', __( 'Підвал', 'beauty-institute' ), '', 'tab' ),
				bi_acf_field( 'footer_slogan', __( 'Слоган у підвалі', 'beauty-institute' ), 'footer_slogan', 'text' ),
				bi_acf_field( 'footer_terms_link', __( 'Посилання «Умови використання»', 'beauty-institute' ), 'footer_terms_link', 'link' ),
				bi_acf_field( 'footer_privacy_link', __( 'Посилання «Політика конфіденційності»', 'beauty-institute' ), 'footer_privacy_link', 'link' ),
				bi_acf_field( 'footer_copy_name', __( 'Назва в копірайті', 'beauty-institute' ), 'footer_copy_name', 'text', array( 'placeholder' => 'ІНСТИТУТ КРАСИ' ) ),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-settings.php',
					),
				),
			),
			'menu_order' => 0,
			'active'     => true,
		)
	);
}

/**
 * Home page group (location: the "Home" page template).
 */
function beauty_institute_acf_group_home() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_bi_home',
			'title'    => __( 'Головна сторінка', 'beauty-institute' ),
			'fields'   => array(

				bi_acf_field( 'home_tab_hero', __( 'Hero', 'beauty-institute' ), '', 'tab' ),
				bi_acf_field( 'hero_title', __( 'Заголовок', 'beauty-institute' ), 'hero_title', 'text' ),
				bi_acf_field( 'hero_lead', __( 'Ліди (перший абзац)', 'beauty-institute' ), 'hero_lead', 'textarea', array( 'rows' => 3 ) ),
				bi_acf_field( 'hero_desc', __( 'Опис (кілька абзаців)', 'beauty-institute' ), 'hero_desc', 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),
				bi_acf_field( 'hero_btn', __( 'Кнопка', 'beauty-institute' ), 'hero_btn', 'link' ),
				bi_acf_field( 'hero_stat_1_value', __( 'Показник 1 — значення', 'beauty-institute' ), 'hero_stat_1_value', 'text', array( 'placeholder' => '75 +' ) ),
				bi_acf_field( 'hero_stat_1_label', __( 'Показник 1 — підпис', 'beauty-institute' ), 'hero_stat_1_label', 'text', array( 'placeholder' => 'років досвіду' ) ),
				bi_acf_field( 'hero_stat_license', __( 'Показник 2 — текст ліцензії', 'beauty-institute' ), 'hero_stat_license', 'text', array( 'placeholder' => 'Ліцензія МОЗ України' ) ),
				bi_acf_field( 'hero_stat_2_value', __( 'Показник 3 — значення', 'beauty-institute' ), 'hero_stat_2_value', 'text', array( 'placeholder' => '1000+' ) ),
				bi_acf_field( 'hero_stat_2_label', __( 'Показник 3 — підпис', 'beauty-institute' ), 'hero_stat_2_label', 'text', array( 'placeholder' => 'клієнтів щороку' ) ),

				bi_acf_field( 'home_tab_why', __( 'Чому обирають', 'beauty-institute' ), '', 'tab' ),
				bi_acf_field( 'why_title', __( 'Заголовок', 'beauty-institute' ), 'why_title', 'text' ),
				bi_acf_field( 'why_intro', __( 'Вступ', 'beauty-institute' ), 'why_intro', 'textarea', array( 'rows' => 2 ) ),
				bi_acf_field( 'why_image', __( 'Фото клініки', 'beauty-institute' ), 'why_image', 'image', array( 'return_format' => 'id', 'preview_size' => 'medium' ) ),
				bi_acf_field( 'why_subtitle', __( 'Підзаголовок панелі', 'beauty-institute' ), 'why_subtitle', 'text' ),
				bi_acf_field( 'why_lead', __( 'Текст панелі', 'beauty-institute' ), 'why_lead', 'textarea', array( 'rows' => 3 ) ),
				bi_acf_field( 'why_list', __( 'Список переваг (по одному на рядок)', 'beauty-institute' ), 'why_list', 'textarea', array( 'rows' => 5 ) ),
				bi_acf_field( 'why_note', __( 'Примітка під списком', 'beauty-institute' ), 'why_note', 'textarea', array( 'rows' => 2 ) ),
				bi_acf_field( 'why_btn', __( 'Кнопка', 'beauty-institute' ), 'why_btn', 'link' ),

				bi_acf_field( 'home_tab_services', __( 'Послуги', 'beauty-institute' ), '', 'tab' ),
				bi_acf_field( 'services_title', __( 'Заголовок', 'beauty-institute' ), 'services_title', 'text' ),
				bi_acf_field( 'services_intro', __( 'Вступ', 'beauty-institute' ), 'services_intro', 'textarea', array( 'rows' => 2 ) ),
				bi_acf_field( 'services_btn', __( 'Кнопка «Всі послуги»', 'beauty-institute' ), 'services_btn', 'link' ),
				bi_acf_field(
					'services_items',
					__( 'Які послуги показувати (рубрики зі сторінки «Послуги»)', 'beauty-institute' ),
					'services_items',
					'taxonomy',
					array(
						'taxonomy'     => 'category',
						'field_type'   => 'multi_select',
						'add_term'     => 0,
						'save_terms'   => 0,
						'load_terms'   => 0,
						'return_format' => 'id',
						'instructions' => __( 'Порожньо — показуються дочірні рубрики «Послуги».', 'beauty-institute' ),
					)
				),

				bi_acf_field( 'home_tab_requests', __( 'Запити', 'beauty-institute' ), '', 'tab' ),
				bi_acf_field( 'requests_title', __( 'Заголовок', 'beauty-institute' ), 'requests_title', 'text' ),
				bi_acf_field( 'requests_intro', __( 'Вступ', 'beauty-institute' ), 'requests_intro', 'textarea', array( 'rows' => 2 ) ),
				bi_acf_field( 'requests_btn', __( 'Кнопка «Всі послуги»', 'beauty-institute' ), 'requests_btn', 'link' ),
				bi_acf_field(
					'requests_items',
					__( 'Які запити показувати', 'beauty-institute' ),
					'requests_items',
					'relationship',
					array(
						'post_type'     => array( 'bi_problem' ),
						'return_format' => 'id',
						'instructions'  => __( 'Порожньо — показуються останні додані запити.', 'beauty-institute' ),
					)
				),

				bi_acf_field( 'home_tab_doctors', __( 'Спеціалісти', 'beauty-institute' ), '', 'tab' ),
				bi_acf_field( 'doctors_title', __( 'Заголовок', 'beauty-institute' ), 'doctors_title', 'text' ),
				bi_acf_field( 'doctors_intro', __( 'Вступ', 'beauty-institute' ), 'doctors_intro', 'textarea', array( 'rows' => 2 ) ),
				bi_acf_field(
					'doctors_items',
					__( 'Яких лікарів показувати', 'beauty-institute' ),
					'doctors_items',
					'relationship',
					array(
						'post_type'     => array( 'bi_doctor' ),
						'return_format' => 'id',
						'instructions'  => __( 'Порожньо — показуються останні додані лікарі.', 'beauty-institute' ),
					)
				),

				bi_acf_field( 'home_tab_results', __( 'До та після', 'beauty-institute' ), '', 'tab' ),
				bi_acf_field( 'results_title', __( 'Заголовок', 'beauty-institute' ), 'results_title', 'text' ),
				bi_acf_field( 'results_intro', __( 'Вступ', 'beauty-institute' ), 'results_intro', 'textarea', array( 'rows' => 2 ) ),
				bi_acf_field(
					'results_items',
					__( 'Які результати показувати', 'beauty-institute' ),
					'results_items',
					'relationship',
					array(
						'post_type'     => array( 'bi_result' ),
						'return_format' => 'id',
						'instructions'  => __( 'Порожньо — показуються останні додані результати.', 'beauty-institute' ),
					)
				),

				bi_acf_field( 'home_tab_find', __( 'Як нас знайти', 'beauty-institute' ), '', 'tab' ),
				bi_acf_field( 'find_title', __( 'Заголовок', 'beauty-institute' ), 'find_title', 'text' ),
				bi_acf_field( 'find_text', __( 'Текст', 'beauty-institute' ), 'find_text', 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),

				bi_acf_field( 'home_tab_consult', __( 'Запис на консультацію', 'beauty-institute' ), '', 'tab' ),
				bi_acf_field( 'consult_title', __( 'Заголовок', 'beauty-institute' ), 'consult_title', 'text' ),
				bi_acf_field( 'consult_intro_desktop', __( 'Вступ (десктоп)', 'beauty-institute' ), 'consult_intro_desktop', 'textarea', array( 'rows' => 3 ) ),
				bi_acf_field( 'consult_intro_mobile', __( 'Вступ (мобільний)', 'beauty-institute' ), 'consult_intro_mobile', 'textarea', array( 'rows' => 2 ) ),
				bi_acf_field( 'consult_form', __( 'Шорткод форми Contact Form 7', 'beauty-institute' ), 'consult_form', 'text', array( 'placeholder' => '[contact-form-7 id="..."]' ) ),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'home.php',
					),
				),
			),
			'menu_order' => 0,
			'active'     => true,
		)
	);
}
