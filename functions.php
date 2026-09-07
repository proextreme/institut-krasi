<?php
/**
 * beauty-institute functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package beauty-institute
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}


## добавляем опции для acf
//if( function_exists('acf_add_options_page') ) {
    //acf_add_options_page();
//}

## старый вид страницы виджетов
add_filter( 'use_widgets_block_editor', '__return_false' );

## Отключает Гутенберг (новый редактор блоков в WordPress).
if( 'disable_gutenberg' ){
  add_filter( 'use_block_editor_for_post_type', '__return_false', 100 );

// Move the Privacy Policy help notice back under the title field.
  add_action( 'admin_init', function(){
    remove_action( 'admin_notices', [ 'WP_Privacy_Policy_Content', 'notice' ] );
    add_action( 'edit_form_after_title', [ 'WP_Privacy_Policy_Content', 'notice' ] );
  } );
}

## Разрешаем загрузку ico файла
add_filter( 'wp_check_filetype_and_ext', 'check_filetype_fix_mime_type_ico', 10, 5 );
function check_filetype_fix_mime_type_ico( $data, $file, $filename, $mimes, $real_mime = '' ){
  if( '.ico' === strtolower( substr($filename, -4) ) ){

    $data['ext']  = 'ico';
    $data['type'] = 'image/x-icon';
  }
  return $data;
}

## Разрешаем загрузку svg файла 1 часть
function allow_svg_upload($mimes) {
    if (current_user_can('administrator')) {
        $mimes['svg'] = 'image/svg+xml';
        $mimes['svgz'] = 'image/svg+xml';
    }
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload');

## Разрешаем загрузку svg файла 2 часть
function fix_svg_check($data, $file, $filename, $mimes) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($ext === 'svg') {
        $data['ext'] = 'svg';
        $data['type'] = 'image/svg+xml';
    }
    return $data;
}
add_filter('wp_check_filetype_and_ext', 'fix_svg_check', 10, 4);

## Подключаем файл переводов polylang
//require get_template_directory() . '/inc/translations.php';

## Транслитерация слага страниц, записей, рубрик
function transliterate_slug($string) {
    // Получаем тип записи
    $post_type = get_post_type();

    // Если это группа полей ACF, возвращаем оригинальный слаг без изменений
    if ($post_type === 'acf-field-group') {
        return $string; // Никаких изменений слага для ACF поля
    }

    // Декодируем URL-кодировку
    $decoded_string = urldecode($string);

    // Массивы для транслитерации
    $cyrillic = [
        'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',
        'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
        'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п',
        'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',
        'Є', 'І', 'Ї', 'Ґ', 'є', 'і', 'ї', 'ґ'
    ];
    $latin = [
        'A', 'B', 'V', 'G', 'D', 'E', 'E', 'ZH', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P',
        'R', 'S', 'T', 'U', 'F', 'KH', 'TS', 'CH', 'SH', 'SCH', '', 'Y', '', 'E', 'YU', 'YA',
        'a', 'b', 'v', 'g', 'd', 'e', 'e', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
        'r', 's', 't', 'u', 'f', 'kh', 'ts', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'yu', 'ya',
        'Ye', 'I', 'Yi', 'G', 'ye', 'i', 'yi', 'g'
    ];

    // Замена кириллицы на латиницу
    $string = str_replace($cyrillic, $latin, $decoded_string);

    // Приведение строки к ASCII
    $ascii_string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);

    // Удаление недопустимых символов
    $sanitized_string = preg_replace('~[^A-Za-z0-9\-]~u', '-', $ascii_string);

    // Удаление лишних дефисов
    $cleaned_string = preg_replace('~-+~', '-', $sanitized_string);

    // Удаление дефисов с начала и конца строки
    $final_string = strtolower(trim($cleaned_string, '-'));

    return $final_string;
}

add_filter('sanitize_title', 'transliterate_slug', 999, 1);

##  автозаполнение атрибута href у ссылок с номером телефона
add_action('wp_footer', function () {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.tel').forEach(function (telElement) {
            var telNumber = telElement.textContent.replace(/\D/g, ''); // Извлекаем только цифры
            if (telNumber.startsWith('38')) {
                telNumber = telNumber.substring(2); // Убираем "38" в начале строки
            }
            telNumber = 'tel:+38' + telNumber; // Добавляем "tel:+38" в начале строки
            var nearestAnchor = telElement.closest('a'); // Находим ближайший тег "a"
            if (nearestAnchor) {
                nearestAnchor.setAttribute('href', telNumber); // Устанавливаем значение атрибута "href"
            }
        });
    });
    </script>
    <?
});


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function beauty_institute_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on beauty-institute, use a find and replace
		* to change 'beauty-institute' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'beauty-institute', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'beauty-institute' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'beauty_institute_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'beauty_institute_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function beauty_institute_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'beauty_institute_content_width', 640 );
}
add_action( 'after_setup_theme', 'beauty_institute_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function beauty_institute_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'beauty-institute' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'beauty-institute' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'beauty_institute_widgets_init' );

/**
 * Theme asset URI helper.
 *
 * @param string $path Relative path inside /assets.
 * @return string Absolute URI.
 */
function beauty_institute_asset( $path ) {
	return trailingslashit( get_template_directory_uri() ) . 'assets/' . ltrim( $path, '/' );
}

/**
 * Enqueue scripts and styles.
 */
function beauty_institute_scripts() {
	$theme_uri = get_template_directory_uri();
	$theme_dir = get_template_directory();

	// Keep style.css only for WP theme metadata; real styles live in assets/css.
	wp_enqueue_style(
		'beauty-institute-style',
		get_stylesheet_uri(),
		array(),
		_S_VERSION
	);

	$fonts_ver = file_exists( $theme_dir . '/assets/css/fonts.css' )
		? (string) filemtime( $theme_dir . '/assets/css/fonts.css' )
		: _S_VERSION;
	$main_ver  = file_exists( $theme_dir . '/assets/css/style.css' )
		? (string) filemtime( $theme_dir . '/assets/css/style.css' )
		: _S_VERSION;
	$js_ver    = file_exists( $theme_dir . '/assets/js/main.js' )
		? (string) filemtime( $theme_dir . '/assets/js/main.js' )
		: _S_VERSION;

	wp_enqueue_style(
		'beauty-institute-fonts',
		$theme_uri . '/assets/css/fonts.css',
		array(),
		$fonts_ver
	);

	wp_enqueue_style(
		'beauty-institute-main',
		$theme_uri . '/assets/css/style.css',
		array( 'beauty-institute-fonts' ),
		$main_ver
	);

	wp_enqueue_script(
		'beauty-institute-main',
		$theme_uri . '/assets/js/main.js',
		array(),
		$js_ver,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'beauty_institute_scripts' );

/**
 * Preload critical fonts.
 */
function beauty_institute_preload_fonts() {
	$fonts = array(
		'fonts/manrope/static/manrope_light.ttf',
		'fonts/manrope/static/manrope_medium.ttf',
		'fonts/lora/static/lora_regular.ttf',
	);

	foreach ( $fonts as $font ) {
		printf(
			'<link rel="preload" href="%1$s" as="font" type="font/ttf" crossorigin>' . "\n",
			esc_url( beauty_institute_asset( $font ) )
		);
	}
}
add_action( 'wp_head', 'beauty_institute_preload_fonts', 1 );

/**
 * Nav menu item CSS classes → BEM for header.
 *
 * @param string[] $classes Menu item classes.
 * @param WP_Post  $item    Menu item object.
 * @param stdClass $args    wp_nav_menu() arguments.
 * @param int      $depth   Menu depth.
 * @return string[]
 */
function beauty_institute_nav_menu_css_class( $classes, $item, $args, $depth = 0 ) {
	if ( isset( $args->theme_location ) && 'menu-1' !== $args->theme_location ) {
		return $classes;
	}

	if ( $depth > 0 ) {
		$classes[] = 'header_nav_dropdown_item';
		return $classes;
	}

	$classes[] = 'header_nav_item';

	if ( in_array( 'menu-item-has-children', $classes, true ) ) {
		$classes[] = 'header_nav_item_has_dropdown';
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'beauty_institute_nav_menu_css_class', 10, 4 );

/**
 * Nav menu submenu CSS classes → BEM for header dropdown.
 *
 * @param string[] $classes Submenu classes.
 * @param stdClass $args    wp_nav_menu() arguments.
 * @return string[]
 */
function beauty_institute_nav_menu_submenu_css_class( $classes, $args ) {
	if ( isset( $args->theme_location ) && 'menu-1' === $args->theme_location ) {
		$classes[] = 'header_nav_dropdown';
	}

	return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'beauty_institute_nav_menu_submenu_css_class', 10, 2 );

/**
 * Nav menu link attributes → BEM for header.
 *
 * @param array    $atts  Link attributes.
 * @param WP_Post  $item  Menu item object.
 * @param stdClass $args  wp_nav_menu() arguments.
 * @param int      $depth Menu depth.
 * @return array
 */
function beauty_institute_nav_menu_link_attributes( $atts, $item, $args, $depth = 0 ) {
	$class = ( $depth > 0 ) ? 'header_nav_dropdown_link' : 'header_nav_link';
	$atts['class'] = isset( $atts['class'] ) ? $atts['class'] . ' ' . $class : $class;

	if ( 0 === (int) $depth && ! empty( $args->walker ) && ! empty( $args->walker->has_children ) ) {
		$atts['aria-haspopup'] = 'true';
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'beauty_institute_nav_menu_link_attributes', 10, 4 );

/**
 * Add dropdown links under "Апарати" in the primary header menu.
 *
 * @param array    $items Menu items.
 * @param stdClass $args  wp_nav_menu() arguments.
 * @return array
 */
function beauty_institute_header_aparati_dropdown_items( $items, $args ) {
	if ( ! isset( $args->theme_location ) || 'menu-1' !== $args->theme_location ) {
		return $items;
	}

	$parent_id = 0;

	foreach ( $items as $item ) {
		if ( (int) $item->menu_item_parent !== 0 ) {
			continue;
		}

		$title = isset( $item->title ) ? wp_strip_all_tags( html_entity_decode( $item->title, ENT_QUOTES, 'UTF-8' ) ) : '';
		$url   = isset( $item->url ) ? (string) $item->url : '';

		if ( false !== mb_stripos( $title, 'Апарати' ) || false !== strpos( $url, '#devices' ) ) {
			$parent_id = (int) $item->ID;
			break;
		}
	}

	if ( ! $parent_id ) {
		return $items;
	}

	foreach ( $items as $item ) {
		if ( (int) $item->menu_item_parent === $parent_id ) {
			return $items;
		}
	}

	$children = array(
		array(
			'title' => __( 'Апарати Zemits', 'beauty-institute' ),
			'url'   => home_url( '/aparati-zemits/' ),
		),
		array(
			'title' => __( 'Що ми вирішуємо', 'beauty-institute' ),
			'url'   => home_url( '/scho-mi-virishuyemo/' ),
		),
	);

	$fake_id = PHP_INT_MAX;

	foreach ( $children as $index => $child ) {
		$items[] = (object) array(
			'ID'                    => $fake_id - $index,
			'db_id'                 => $fake_id - $index,
			'title'                 => $child['title'],
			'url'                   => $child['url'],
			'menu_item_parent'      => $parent_id,
			'object_id'             => $fake_id - $index,
			'object'                => 'custom',
			'type'                  => 'custom',
			'type_label'            => '',
			'classes'               => array(),
			'menu_order'            => $index + 1,
			'target'                => '',
			'attr_title'            => '',
			'description'           => '',
			'xfn'                   => '',
			'status'                => 'publish',
			'current'               => false,
			'current_item_ancestor' => false,
			'current_item_parent'   => false,
		);
	}

	return $items;
}
add_filter( 'wp_nav_menu_objects', 'beauty_institute_header_aparati_dropdown_items', 10, 2 );

/**
 * Content helpers for ACF-driven templates.
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Custom post types and taxonomies.
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * ACF field groups (registered in code).
 */
require get_template_directory() . '/inc/acf-fields.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

