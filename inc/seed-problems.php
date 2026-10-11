<?php
/**
 * TEMPORARY one-time seed — remove this file, inc/seed-problems-data.json,
 * the images in assets/images/problems/ (after they are in the media
 * library) and the require in functions.php once it has run
 * (option bi_problems_seeded).
 *
 * Fills six "Запити" records from the client's "Тексти - Що ми вирішуємо"
 * document and the Figma "Що ми вирішуємо" frames. A record is processed
 * once; a field the editor already filled is never overwritten.
 *
 * @package beauty-institute
 */

/**
 * Add a file from assets/images/problems/ to the media library once.
 *
 * Thumbnails are not generated on purpose: this runs inside a normal admin
 * request and must stay fast. The theme falls back to the full image.
 *
 * @param string $relative Path inside assets/images/problems/.
 * @return int Attachment ID, or 0.
 */
function bi_seed_problems_attach( $relative ) {
	$existing = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'meta_key'       => '_bi_seed_src', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'     => 'problems/' . $relative, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
		)
	);
	if ( $existing ) {
		return (int) $existing[0];
	}

	$src = get_template_directory() . '/assets/images/problems/' . $relative;
	if ( ! is_readable( $src ) ) {
		return 0;
	}

	$upload = wp_upload_bits( str_replace( '/', '-', $relative ), null, file_get_contents( $src ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	if ( ! empty( $upload['error'] ) ) {
		return 0;
	}

	$type          = wp_check_filetype( $upload['file'] );
	$attachment_id = wp_insert_attachment(
		array(
			'post_mime_type' => $type['type'] ? $type['type'] : 'image/jpeg',
			'post_title'     => sanitize_file_name( pathinfo( $relative, PATHINFO_FILENAME ) ),
			'post_status'    => 'inherit',
		),
		$upload['file']
	);
	if ( is_wp_error( $attachment_id ) || ! $attachment_id ) {
		return 0;
	}

	$size = @getimagesize( $upload['file'] ); // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged
	wp_update_attachment_metadata(
		$attachment_id,
		array(
			'width'  => $size ? (int) $size[0] : 0,
			'height' => $size ? (int) $size[1] : 0,
			'file'   => _wp_relative_upload_path( $upload['file'] ),
			'sizes'  => array(),
		)
	);
	update_post_meta( $attachment_id, '_bi_seed_src', 'problems/' . $relative );

	return (int) $attachment_id;
}

/**
 * Fill the "Запити" records with the client's texts and images.
 */
function bi_seed_problems() {
	if ( ! function_exists( 'update_field' ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$done = (array) get_option( 'bi_problems_seeded', array() );

	$file = get_template_directory() . '/inc/seed-problems-data.json';
	if ( ! is_readable( $file ) ) {
		return;
	}
	$data = json_decode( (string) file_get_contents( $file ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	if ( ! is_array( $data ) ) {
		return;
	}

	// Field name => field key suffix in group_bi_problem_page.
	$map = array(
		'hero_title'            => 'pp_hero_title',
		'hero_text'             => 'pp_hero_text',
		'hero_bg'               => 'pp_hero_bg',
		'hero_bg_mobile'        => 'pp_hero_bg_mob',
		'intro_title'           => 'pp_intro_title',
		'intro_text'            => 'pp_intro_text',
		'intro_image'           => 'pp_intro_image',
		'types_title'           => 'pp_types_title',
		'types_lead'            => 'pp_types_lead',
		'causes_title'          => 'pp_causes_title',
		'causes_lead'           => 'pp_causes_lead',
		'causes_list'           => 'pp_causes_list',
		'symptoms_title'        => 'pp_symptoms_title',
		'symptoms_lead'         => 'pp_symptoms_lead',
		'symptoms_list'         => 'pp_symptoms_list',
		'stages_title'          => 'pp_stages_title',
		'stages_lead'           => 'pp_stages_lead',
		'stages_list'           => 'pp_stages_list',
		'note_title'            => 'pp_note_title',
		'note_text'             => 'pp_note_text',
		'treatment_title'       => 'pp_tr_title',
		'treatment_text'        => 'pp_tr_text',
		'treatment_image'       => 'pp_tr_image',
		'treatment_label'       => 'pp_tr_label',
		'treatment_services'    => 'pp_tr_services',
		'consult_intro_desktop' => 'pp_consult_intro',
		'consult_intro_mobile'  => 'pp_consult_intro_mob',
		'result_1'              => 'pp_result_1',
		'result_2'              => 'pp_result_2',
		'review_1_text'         => 'pp_rev_1_text',
	);
	for ( $i = 1; $i <= 4; $i++ ) {
		$map[ "type_{$i}_image" ] = "pp_type_{$i}_image";
		$map[ "type_{$i}_title" ] = "pp_type_{$i}_title";
		$map[ "type_{$i}_text" ]  = "pp_type_{$i}_text";
	}

	foreach ( $data as $slug => $record ) {
		if ( in_array( $slug, $done, true ) ) {
			continue;
		}

		$post = get_page_by_path( $slug, OBJECT, 'bi_problem' );
		if ( ! $post ) {
			continue; // Record not created yet — retried on the next admin request.
		}

		$post_id = (int) $post->ID;
		$values  = (array) $record['fields'];

		foreach ( (array) $record['images'] as $name => $relative ) {
			$values[ $name ] = array( 'image' => $slug . '/' . $relative );
		}

		$failed = false;

		foreach ( $values as $name => $value ) {
			if ( ! isset( $map[ $name ] ) ) {
				continue;
			}

			$current = get_field( $name, $post_id, false );
			if ( ! ( null === $current || '' === $current || false === $current || array() === $current || 0 === $current || '0' === $current ) ) {
				continue; // Already filled by an editor.
			}

			if ( is_array( $value ) && isset( $value['image'] ) ) {
				$value = bi_seed_problems_attach( $value['image'] );
				if ( ! $value ) {
					$failed = true; // Try this record again next time.
					continue;
				}
			}

			update_field( 'field_bi_' . $map[ $name ], $value, $post_id );
		}

		if ( ! $failed ) {
			$done[] = $slug;
			update_option( 'bi_problems_seeded', $done );
		}
	}
}
add_action( 'admin_init', 'bi_seed_problems' );
