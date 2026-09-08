<?php
/**
 * Content helpers for ACF-driven templates.
 *
 * Every helper degrades gracefully when ACF is disabled or a field is empty,
 * so templates can be wired to fields while the static fallback markup stays
 * visible until an editor fills the field in on the live site.
 *
 * @package beauty-institute
 */

/**
 * Get an ACF field value with a fallback.
 *
 * @param string $selector Field name / key.
 * @param mixed  $fallback Value to return when the field is empty or ACF is off.
 * @param mixed  $post_id  Optional post ID (defaults to current post).
 * @return mixed
 */
function bi_field( $selector, $fallback = '', $post_id = false ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $fallback;
	}

	$value = get_field( $selector, $post_id );

	if ( null === $value || '' === $value || false === $value || array() === $value ) {
		return $fallback;
	}

	return $value;
}

/**
 * Echo an ACF text value, escaped, with a fallback.
 *
 * @param string $selector Field name / key.
 * @param string $fallback Fallback text (already in its final, human form).
 * @param mixed  $post_id  Optional post ID.
 */
function bi_text( $selector, $fallback = '', $post_id = false ) {
	echo esc_html( bi_field( $selector, $fallback, $post_id ) );
}

/**
 * Echo an ACF rich-text / multiline value, with a fallback.
 *
 * Used for fields where the editor may enter several paragraphs. WYSIWYG
 * fields arrive pre-formatted; plain textareas are run through wpautop().
 *
 * @param string $selector Field name / key.
 * @param string $fallback Fallback HTML.
 * @param mixed  $post_id  Optional post ID.
 */
function bi_wysiwyg( $selector, $fallback = '', $post_id = false ) {
	$value = bi_field( $selector, '', $post_id );

	if ( '' === $value ) {
		echo wp_kses_post( $fallback );
		return;
	}

	if ( false === strpos( $value, '<' ) ) {
		$value = wpautop( $value );
	}

	echo wp_kses_post( $value );
}

/**
 * Resolve an ACF image field to an attachment ID.
 *
 * Accepts the field whether its return format is ID, array or URL.
 *
 * @param mixed $value ACF image field value.
 * @return int Attachment ID, or 0.
 */
function bi_image_id( $value ) {
	if ( is_numeric( $value ) ) {
		return (int) $value;
	}

	if ( is_array( $value ) && isset( $value['ID'] ) ) {
		return (int) $value['ID'];
	}

	if ( is_string( $value ) && '' !== $value ) {
		return (int) attachment_url_to_postid( $value );
	}

	return 0;
}

/**
 * Echo an <img> for an ACF image field, or fall back to a theme asset.
 *
 * @param string $selector       Field name / key.
 * @param string $fallback_asset Path inside /assets used when the field is empty.
 * @param string $size           Image size for the ACF image.
 * @param array  $attr           Extra <img> attributes (class, alt, width...).
 * @param mixed  $post_id        Optional post ID.
 */
function bi_image( $selector, $fallback_asset = '', $size = 'large', $attr = array(), $post_id = false ) {
	$id = bi_image_id( bi_field( $selector, '', $post_id ) );

	if ( $id ) {
		echo wp_get_attachment_image( $id, $size, false, $attr );
		return;
	}

	if ( '' === $fallback_asset ) {
		return;
	}

	$attr_html = '';
	foreach ( $attr as $key => $val ) {
		$attr_html .= sprintf( ' %s="%s"', esc_attr( $key ), esc_attr( $val ) );
	}

	printf(
		'<img src="%s"%s>',
		esc_url( beauty_institute_asset( $fallback_asset ) ),
		$attr_html // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built from esc_attr() above.
	);
}

/**
 * Echo a URL for an ACF image field (for use in CSS background-image, etc.).
 *
 * @param string $selector       Field name / key.
 * @param string $fallback_asset Path inside /assets used when the field is empty.
 * @param string $size           Image size.
 * @param mixed  $post_id        Optional post ID.
 */
function bi_image_url( $selector, $fallback_asset = '', $size = 'large', $post_id = false ) {
	$id = bi_image_id( bi_field( $selector, '', $post_id ) );

	if ( $id ) {
		$src = wp_get_attachment_image_url( $id, $size );
		if ( $src ) {
			echo esc_url( $src );
			return;
		}
	}

	if ( '' !== $fallback_asset ) {
		echo esc_url( beauty_institute_asset( $fallback_asset ) );
	}
}

/**
 * ID of the "Налаштування сайту" page (the free-ACF stand-in for an options page).
 *
 * The page is identified by its page template (page-settings.php) so the lookup
 * is environment independent. Result is cached for the request.
 *
 * @return int Page ID, or 0 when the settings page does not exist yet.
 */
function bi_settings_page_id() {
	static $cache = null;

	if ( null !== $cache ) {
		return $cache;
	}

	$cache = 0;

	$found = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => array( 'publish', 'private', 'draft' ),
			'posts_per_page' => 1,
			'meta_key'       => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'     => 'page-settings.php', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
			'fields'         => 'ids',
			'no_found_rows'  => true,
		)
	);

	if ( $found ) {
		$cache = (int) $found[0];
	}

	return $cache;
}

/**
 * Get a global setting from the "Налаштування сайту" page.
 *
 * @param string $selector Field name / key on the settings page.
 * @param mixed  $fallback Fallback value.
 * @return mixed
 */
function bi_option( $selector, $fallback = '' ) {
	$page_id = bi_settings_page_id();

	if ( ! $page_id ) {
		return $fallback;
	}

	return bi_field( $selector, $fallback, $page_id );
}

/**
 * Echo an escaped global setting.
 *
 * @param string $selector Field name / key.
 * @param string $fallback Fallback text.
 */
function bi_option_text( $selector, $fallback = '' ) {
	echo esc_html( bi_option( $selector, $fallback ) );
}

/**
 * Short display name for a doctor ("Трембач О.М."), falling back to the title.
 *
 * @param int $id Doctor post ID.
 * @return string
 */
function beauty_institute_doctor_short_name( $id ) {
	$short = function_exists( 'get_field' ) ? (string) get_field( 'short_name', $id ) : '';

	return '' !== $short ? $short : get_the_title( $id );
}

/**
 * Extract a YouTube video ID from a URL or bare ID.
 *
 * @param string $value URL or ID.
 * @return string 11-char video ID, or ''.
 */
function beauty_institute_youtube_id( $value ) {
	$value = trim( (string) $value );

	if ( '' === $value ) {
		return '';
	}

	if ( preg_match( '~^[A-Za-z0-9_-]{11}$~', $value ) ) {
		return $value;
	}

	if ( preg_match( '~(?:youtu\.be/|v=|/embed/|/shorts/|/live/)([A-Za-z0-9_-]{11})~', $value, $m ) ) {
		return $m[1];
	}

	return '';
}

/**
 * Render the "Запис на консультацію" form.
 *
 * Uses the Contact Form 7 shortcode from Site Settings (or a per-call
 * override); falls back to the static markup so the block never disappears.
 *
 * @param string $shortcode Optional shortcode overriding the global one.
 */
function beauty_institute_consult_form( $shortcode = '' ) {
	if ( '' === $shortcode ) {
		$shortcode = (string) bi_option( 'consult_form_shortcode', '' );
	}

	if ( '' !== $shortcode ) {
		echo do_shortcode( $shortcode );
		return;
	}
	?>
	<form action="/#wpcf7-f72-o1" method="post" class="wpcf7-form consult_form init" aria-label="Контактна форма" novalidate="novalidate" data-status="init">
		<p>
			<label> Ім’я</label><br>
			<span class="wpcf7-form-control-wrap" data-name="your-name"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text" autocomplete="name" aria-invalid="false" value="" type="text" name="your-name" placeholder="Вкажіть як до вас звертатися"></span>
		</p>
		<p>
			<label> Телефон</label><br>
			<span class="wpcf7-form-control-wrap" data-name="your-phone"><input size="40" maxlength="15" class="wpcf7-form-control wpcf7-tel wpcf7-text" autocomplete="tel" inputmode="numeric" aria-invalid="false" value="" type="tel" name="your-phone" placeholder="Вкажіть свій номер телефону"></span>
		</p>
		<p>
			<label> Послуга</label><br>
			<span class="wpcf7-form-control-wrap" data-name="your-service"><select class="wpcf7-form-control wpcf7-select" aria-invalid="false" name="your-service"><option value="">Оберіть послугу</option><option value="novoutvorennya">Видалення новоутворень</option><option value="injection">Ін’єкційна косметологія</option><option value="surgery">Естетична хірургія</option><option value="hardware">Апаратна косметологія</option><option value="care">Доглядові процедури</option><option value="stomatology">Стоматологія</option></select></span>
		</p>
		<p>
			<input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit" value="Відправити"><span class="wpcf7-spinner"></span>
		</p>
	</form>
	<?php
}

/**
 * Resolve a "pick items, or fall back to latest" list for a home-page section.
 *
 * Reads an ACF relationship field on the current post; when empty, returns the
 * most recent published posts of the given type.
 *
 * @param string $selector  ACF relationship field name.
 * @param string $post_type Post type to fall back to.
 * @param int    $limit     Max items for the fallback query.
 * @return int[] Ordered list of post IDs (may be empty).
 */
function beauty_institute_home_query( $selector, $post_type, $limit = 8 ) {
	$picked = bi_field( $selector, array() );

	if ( is_array( $picked ) && $picked ) {
		return array_map(
			static function ( $item ) {
				return is_object( $item ) ? (int) $item->ID : (int) $item;
			},
			$picked
		);
	}

	return get_posts(
		array(
			'post_type'        => $post_type,
			'post_status'      => 'publish',
			'posts_per_page'   => $limit,
			'orderby'          => array(
				'menu_order' => 'ASC',
				'date'       => 'DESC',
			),
			'fields'           => 'ids',
			'no_found_rows'    => true,
			'suppress_filters' => false,
		)
	);
}

/**
 * Service categories to show on the home page.
 *
 * Uses the "services_items" ACF taxonomy field; when empty, falls back to the
 * child terms of the "Послуги" category.
 *
 * @return WP_Term[] Ordered list of terms (may be empty).
 */
function beauty_institute_home_service_terms() {
	$ids = bi_field( 'services_items', array() );

	if ( is_array( $ids ) && $ids ) {
		$terms = get_terms(
			array(
				'taxonomy'   => 'category',
				'include'    => array_map( 'intval', $ids ),
				'orderby'    => 'include',
				'hide_empty' => false,
			)
		);

		return is_wp_error( $terms ) ? array() : $terms;
	}

	$parent = get_term_by( 'slug', 'poslugi', 'category' );

	if ( ! $parent ) {
		return array();
	}

	$terms = get_terms(
		array(
			'taxonomy'   => 'category',
			'parent'     => $parent->term_id,
			'hide_empty' => false,
			'orderby'    => 'name',
		)
	);

	if ( is_wp_error( $terms ) ) {
		return array();
	}

	/*
	 * The design has room for ~6 service tiles. Until the "Послуги" tree is
	 * built out, keep the static fallback rather than showing one lonely term.
	 */
	return ( count( $terms ) >= 3 ) ? $terms : array();
}
