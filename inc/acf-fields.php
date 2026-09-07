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
	beauty_institute_acf_group_doctor();
	beauty_institute_acf_group_problem();
	beauty_institute_acf_group_review();
	beauty_institute_acf_group_result();
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
					bi_acf_field( 'doc_position', __( 'Посада / регалії', 'beauty-institute' ), 'position', 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),
					bi_acf_field( 'doc_since', __( 'Стаж (рядок під посадою)', 'beauty-institute' ), 'since', 'text', array( 'placeholder' => 'Працює в косметології з 2012 року.' ) ),
					bi_acf_field( 'doc_bio', __( 'Біографія', 'beauty-institute' ), 'bio', 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),

					bi_acf_field( 'doc_tab_card', __( 'Картка (список / головна)', 'beauty-institute' ), '', 'tab' ),
					bi_acf_field( 'doc_role', __( 'Спеціалізація (короткий підпис у картці)', 'beauty-institute' ), 'role', 'text', array( 'placeholder' => 'Дерматолог' ) ),
					bi_acf_field( 'doc_card_description', __( 'Опис у картці на головній', 'beauty-institute' ), 'card_description', 'text' ),

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
 * Відгук — block-only content.
 */
function beauty_institute_acf_group_review() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_bi_review',
			'title'    => __( 'Дані відгуку', 'beauty-institute' ),
			'fields'   => array(
				bi_acf_field( 'rev_author', __( 'Ім’я автора', 'beauty-institute' ), 'author_name', 'text' ),
				bi_acf_field( 'rev_topic', __( 'Тема / послуга', 'beauty-institute' ), 'topic', 'text' ),
				bi_acf_field( 'rev_text', __( 'Текст відгуку', 'beauty-institute' ), 'text', 'textarea', array( 'rows' => 6 ) ),
				bi_acf_field( 'rev_photo', __( 'Фото автора', 'beauty-institute' ), 'photo', 'image', array( 'return_format' => 'id', 'preview_size' => 'thumbnail' ) ),
				bi_acf_field( 'rev_video', __( 'Посилання на відеовідгук (YouTube)', 'beauty-institute' ), 'video_url', 'url' ),
				bi_acf_field(
					'rev_doctor',
					__( 'Лікар', 'beauty-institute' ),
					'doctor',
					'post_object',
					array( 'post_type' => array( 'bi_doctor' ), 'return_format' => 'id', 'allow_null' => 1 )
				),
			),
			'location' => bi_acf_location_post_type( 'bi_review' ),
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
				bi_acf_field( 'address_locality', __( 'Місто (напівжирне)', 'beauty-institute' ), 'address_locality', 'text', array( 'placeholder' => 'м. Київ' ) ),
				bi_acf_field( 'address_street', __( 'Адреса (вулиця, будинок)', 'beauty-institute' ), 'address_street', 'text' ),
				bi_acf_field( 'address_note', __( 'Уточнення (приміщення, індекс)', 'beauty-institute' ), 'address_note', 'text' ),
				bi_acf_field( 'edrpou', __( 'Код ЄДРПОУ', 'beauty-institute' ), 'edrpou', 'text' ),

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
