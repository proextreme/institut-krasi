<?php
/**
 * Custom post types.
 *
 * "Block-only" content (reviews, before/after, FAQ) is registered with
 * public => false: it is editable in wp-admin but has no front-end single
 * page or archive — templates pull it in with WP_Query / get_posts().
 *
 * @package beauty-institute
 */

// Bump this when a post type slug / rewrite changes to trigger a one-time flush.
define( 'BEAUTY_INSTITUTE_REWRITE_VERSION', '2026-09-08-2' );

/**
 * Register theme post types.
 */
function beauty_institute_register_post_types() {

	// Лікарі — has its own single page (single-bi_doctor.php) and a list page.
	register_post_type(
		'bi_doctor',
		array(
			'labels'        => array(
				'name'               => __( 'Лікарі', 'beauty-institute' ),
				'singular_name'      => __( 'Лікар', 'beauty-institute' ),
				'add_new'            => __( 'Додати лікаря', 'beauty-institute' ),
				'add_new_item'       => __( 'Додати лікаря', 'beauty-institute' ),
				'edit_item'          => __( 'Редагувати лікаря', 'beauty-institute' ),
				'new_item'           => __( 'Новий лікар', 'beauty-institute' ),
				'view_item'          => __( 'Переглянути лікаря', 'beauty-institute' ),
				'search_items'       => __( 'Шукати лікарів', 'beauty-institute' ),
				'not_found'          => __( 'Лікарів не знайдено', 'beauty-institute' ),
				'all_items'          => __( 'Всі лікарі', 'beauty-institute' ),
				'menu_name'          => __( 'Лікарі', 'beauty-institute' ),
			),
			'public'        => true,
			'has_archive'   => false,
			'menu_icon'     => 'dashicons-businessperson',
			'menu_position' => 21,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'rewrite'       => array( 'slug' => 'likar', 'with_front' => false ),
			'show_in_rest'  => true,
		)
	);

	// Апаратні процедури (Zemits) — block-only, shown on the Zemits page.
	register_post_type(
		'bi_device',
		array(
			'labels'        => array(
				'name'          => __( 'Процедури Zemits', 'beauty-institute' ),
				'singular_name' => __( 'Процедура', 'beauty-institute' ),
				'add_new_item'  => __( 'Додати процедуру', 'beauty-institute' ),
				'edit_item'     => __( 'Редагувати процедуру', 'beauty-institute' ),
				'all_items'     => __( 'Всі процедури', 'beauty-institute' ),
				'menu_name'     => __( 'Процедури Zemits', 'beauty-institute' ),
			),
			'public'        => false,
			'show_ui'       => true,
			'show_in_menu'  => true,
			'has_archive'   => false,
			'menu_icon'     => 'dashicons-superhero',
			'menu_position' => 22,
			'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
			'rewrite'       => false,
			'query_var'     => false,
		)
	);

	// Запити / «Що ми вирішуємо» — has a listing page; single pages optional.
	register_post_type(
		'bi_problem',
		array(
			'labels'        => array(
				'name'          => __( 'Запити (Що вирішуємо)', 'beauty-institute' ),
				'singular_name' => __( 'Запит', 'beauty-institute' ),
				'add_new_item'  => __( 'Додати запит', 'beauty-institute' ),
				'edit_item'     => __( 'Редагувати запит', 'beauty-institute' ),
				'all_items'     => __( 'Всі запити', 'beauty-institute' ),
				'menu_name'     => __( 'Запити', 'beauty-institute' ),
			),
			'public'        => true,
			'has_archive'   => false,
			'menu_icon'     => 'dashicons-sos',
			'menu_position' => 23,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'rewrite'       => array( 'slug' => 'zapyt', 'with_front' => false ),
			'show_in_rest'  => true,
		)
	);

	// Відгуки — block only.
	register_post_type(
		'bi_review',
		array(
			'labels'        => array(
				'name'          => __( 'Відгуки', 'beauty-institute' ),
				'singular_name' => __( 'Відгук', 'beauty-institute' ),
				'add_new_item'  => __( 'Додати відгук', 'beauty-institute' ),
				'edit_item'     => __( 'Редагувати відгук', 'beauty-institute' ),
				'all_items'     => __( 'Всі відгуки', 'beauty-institute' ),
				'menu_name'     => __( 'Відгуки', 'beauty-institute' ),
			),
			'public'        => false,
			'show_ui'       => true,
			'show_in_menu'  => true,
			'menu_icon'     => 'dashicons-format-quote',
			'menu_position' => 24,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'has_archive'   => false,
			'rewrite'       => false,
			'query_var'     => false,
		)
	);

	// До та після — block only.
	register_post_type(
		'bi_result',
		array(
			'labels'        => array(
				'name'          => __( 'До та після', 'beauty-institute' ),
				'singular_name' => __( 'Результат', 'beauty-institute' ),
				'add_new_item'  => __( 'Додати результат', 'beauty-institute' ),
				'edit_item'     => __( 'Редагувати результат', 'beauty-institute' ),
				'all_items'     => __( 'Всі результати', 'beauty-institute' ),
				'menu_name'     => __( 'До та після', 'beauty-institute' ),
			),
			'public'        => false,
			'show_ui'       => true,
			'show_in_menu'  => true,
			'menu_icon'     => 'dashicons-images-alt2',
			'menu_position' => 25,
			'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
			'has_archive'   => false,
			'rewrite'       => false,
			'query_var'     => false,
		)
	);

	// FAQ — block only, grouped per page via the bi_faq_group taxonomy.
	register_post_type(
		'bi_faq',
		array(
			'labels'        => array(
				'name'          => __( 'Питання (FAQ)', 'beauty-institute' ),
				'singular_name' => __( 'Питання', 'beauty-institute' ),
				'add_new_item'  => __( 'Додати питання', 'beauty-institute' ),
				'edit_item'     => __( 'Редагувати питання', 'beauty-institute' ),
				'all_items'     => __( 'Всі питання', 'beauty-institute' ),
				'menu_name'     => __( 'FAQ', 'beauty-institute' ),
			),
			'public'        => false,
			'show_ui'       => true,
			'show_in_menu'  => true,
			'menu_icon'     => 'dashicons-editor-help',
			'menu_position' => 26,
			'supports'      => array( 'title', 'page-attributes' ),
			'has_archive'   => false,
			'rewrite'       => false,
			'query_var'     => false,
		)
	);
}
add_action( 'init', 'beauty_institute_register_post_types' );

/**
 * Register theme taxonomies.
 */
function beauty_institute_register_taxonomies() {

	// Groups FAQ items so a page can show only its own set.
	register_taxonomy(
		'bi_faq_group',
		array( 'bi_faq' ),
		array(
			'labels'            => array(
				'name'          => __( 'Групи FAQ', 'beauty-institute' ),
				'singular_name' => __( 'Група FAQ', 'beauty-institute' ),
				'menu_name'     => __( 'Групи FAQ', 'beauty-institute' ),
			),
			'public'            => false,
			'show_ui'           => true,
			'show_admin_column' => true,
			'hierarchical'      => true,
			'rewrite'           => false,
			'query_var'         => false,
		)
	);

	// Doctor specialties — drives the tabs on the "Лікарі" page.
	register_taxonomy(
		'bi_specialty',
		array( 'bi_doctor' ),
		array(
			'labels'            => array(
				'name'          => __( 'Спеціальності', 'beauty-institute' ),
				'singular_name' => __( 'Спеціальність', 'beauty-institute' ),
				'menu_name'     => __( 'Спеціальності', 'beauty-institute' ),
				'add_new_item'  => __( 'Додати спеціальність', 'beauty-institute' ),
			),
			'public'            => false,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'hierarchical'      => true,
			'rewrite'           => false,
			'query_var'         => false,
		)
	);

	// Optional category for before/after results (e.g. "Ін'єкційна косметологія").
	register_taxonomy(
		'bi_result_cat',
		array( 'bi_result' ),
		array(
			'labels'            => array(
				'name'          => __( 'Категорії результатів', 'beauty-institute' ),
				'singular_name' => __( 'Категорія результату', 'beauty-institute' ),
				'menu_name'     => __( 'Категорії', 'beauty-institute' ),
			),
			'public'            => false,
			'show_ui'           => true,
			'show_admin_column' => true,
			'hierarchical'      => true,
			'rewrite'           => false,
			'query_var'         => false,
		)
	);
}
add_action( 'init', 'beauty_institute_register_taxonomies' );

/**
 * Flush rewrite rules once after the post types are first registered.
 */
function beauty_institute_maybe_flush_rewrite() {
	if ( get_option( 'beauty_institute_rewrite_flushed' ) === BEAUTY_INSTITUTE_REWRITE_VERSION ) {
		return;
	}

	beauty_institute_register_post_types();
	beauty_institute_register_taxonomies();
	flush_rewrite_rules( false );

	// Seed the default doctor specialties once.
	$default_specialties = array(
		'Дерматологи',
		'Хірурги',
		'Косметологи',
		'Стоматологи',
		'Інші лікарі',
	);
	foreach ( $default_specialties as $specialty ) {
		if ( ! term_exists( $specialty, 'bi_specialty' ) ) {
			wp_insert_term( $specialty, 'bi_specialty' );
		}
	}

	$default_result_cats = array(
		'Лікування шкіри',
		'Ін’єкційна косметологія',
		'Трихологія',
		'Естетичний хірург',
	);
	foreach ( $default_result_cats as $cat ) {
		if ( ! term_exists( $cat, 'bi_result_cat' ) ) {
			wp_insert_term( $cat, 'bi_result_cat' );
		}
	}

	update_option( 'beauty_institute_rewrite_flushed', BEAUTY_INSTITUTE_REWRITE_VERSION );
}
add_action( 'init', 'beauty_institute_maybe_flush_rewrite', 99 );
