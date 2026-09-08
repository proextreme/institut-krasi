<?php
/**
 * Reusable front-end sections shared by several templates
 * ("Як нас знайти" and "Запис на консультацію").
 *
 * @package beauty-institute
 */

/**
 * Value resolution for shared sections: current page field, then a global
 * setting with the same name, then a hard-coded default.
 *
 * @param string $selector Field name.
 * @param string $default  Default value.
 * @return string
 */
function bi_section_value( $selector, $default = '' ) {
	$value = bi_field( $selector, '' );
	if ( '' !== $value ) {
		return $value;
	}

	$value = bi_option( $selector, '' );
	if ( '' !== $value ) {
		return $value;
	}

	return $default;
}

/**
 * Render the contact rows used inside "Як нас знайти" and the contact page.
 */
function beauty_institute_contact_rows() {
	$region = bi_option( 'address_region', 'Україна, м. Київ, 01024' );
	$street = bi_option( 'address_street', 'вул. Чикаленка Євгена, буд. 20, приміщення №49' );
	$email  = bi_option( 'email', '22872120@ukr.net' );
	$edrpou = bi_option( 'edrpou', '22872120' );
	$phones = array_filter( array( bi_option( 'phone_1', '+38 098 510 15 51' ), bi_option( 'phone_2', '+38 095 510 15 51' ) ) );
	?>
	<ul class="find_contacts">
		<li class="find_contact">
			<span class="find_contact_icon" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_location_find.svg' ) ); ?>');" aria-hidden="true"></span>
			<span class="find_contact_body">
				<span class="find_contact_label"><?php echo esc_html( $region ); ?></span>
				<span class="find_contact_value"><?php echo wp_kses_post( $street ); ?></span>
			</span>
		</li>
		<?php if ( $phones ) : ?>
		<li class="find_contact">
			<span class="find_contact_icon" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_sms_find.svg' ) ); ?>');" aria-hidden="true"></span>
			<span class="find_contact_body">
				<span class="find_contact_label"><?php esc_html_e( 'Телефон', 'beauty-institute' ); ?></span>
				<span class="find_contact_value">
					<?php foreach ( $phones as $phone ) : ?>
						<a href="tel:<?php echo esc_attr( preg_replace( '/[^\d+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
					<?php endforeach; ?>
				</span>
			</span>
		</li>
		<?php endif; ?>
		<?php if ( $email ) : ?>
		<li class="find_contact">
			<span class="find_contact_icon" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_call_find.svg' ) ); ?>');" aria-hidden="true"></span>
			<span class="find_contact_body">
				<span class="find_contact_label">E-mail</span>
				<span class="find_contact_value"><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></span>
			</span>
		</li>
		<?php endif; ?>
		<?php if ( $edrpou ) : ?>
		<li class="find_contact">
			<span class="find_contact_icon" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_edrpou_find.svg' ) ); ?>');" aria-hidden="true"></span>
			<span class="find_contact_body">
				<span class="find_contact_label"><?php esc_html_e( 'код ЄРДПОУ', 'beauty-institute' ); ?></span>
				<span class="find_contact_value"><?php echo esc_html( $edrpou ); ?></span>
			</span>
		</li>
		<?php endif; ?>
	</ul>
	<?php
}

/**
 * Render the Google Maps embed from Site Settings.
 */
function beauty_institute_map_embed() {
	$map = (string) bi_option( 'map_embed', '' );

	if ( false !== strpos( $map, '<iframe' ) ) {
		echo wp_kses(
			$map,
			array(
				'iframe' => array(
					'src'             => true,
					'width'           => true,
					'height'          => true,
					'style'           => true,
					'class'           => true,
					'allowfullscreen' => true,
					'loading'         => true,
					'referrerpolicy'  => true,
					'title'           => true,
					'frameborder'     => true,
				),
			)
		);
		return;
	}

	$src = $map
		? $map
		: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2540.7894765006495!2d30.51458497713916!3d50.445021871591116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4ce57ca29633d%3A0xbb7585b5becfb7e1!2z0IbQvdGB0YLQuNGC0YPRgiDQmtGA0LDRgdC4!5e0!3m2!1sru!2sua!4v1786569008133!5m2!1sru!2sua';
	?>
	<iframe
		class="find_map_frame"
		src="<?php echo esc_url( $src ); ?>"
		title="<?php esc_attr_e( 'Інститут краси на карті', 'beauty-institute' ); ?>"
		width="100%"
		height="450"
		style="border:0;"
		allowfullscreen=""
		loading="lazy"
		referrerpolicy="strict-origin-when-cross-origin"
	></iframe>
	<?php
}

/**
 * Render the whole "Як нас знайти" section.
 */
function beauty_institute_find_section() {
	?>
	<section class="find" id="find" aria-label="Як нас знайти">
		<div class="container find_inner">
			<div class="find_content">
				<h2 class="find_title font_heading"><?php echo esc_html( bi_field( 'find_title', __( 'Як нас знайти', 'beauty-institute' ) ) ); ?></h2>

				<div class="find_text">
					<?php
					bi_wysiwyg(
						'find_text',
						'<p>ІНСТИТУТ КРАСИ працює з 1949 року і є одним із найвідоміших центрів естетичної медицини. За роки роботи нам довірили своє здоров’я тисячі пацієнтів.</p><p>Наші лікарі поєднують професійний досвід, сучасні технології та уважне ставлення до кожного пацієнта.</p>'
					);
					?>
				</div>

				<?php beauty_institute_contact_rows(); ?>
			</div>

			<div class="find_map">
				<?php beauty_institute_map_embed(); ?>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Render one "Результати, яким довіряють" grid panel (5-cell asymmetric grid).
 *
 * @param int[] $ids       Result post IDs (uses up to 5).
 * @param bool  $is_active Whether this panel is the visible one.
 * @param string $panel_id DOM id.
 * @param string $tab_id   Matching tab id.
 * @param string $slug     data-* slug.
 */
function beauty_institute_results_panel( $ids, $is_active, $panel_id, $tab_id, $slug ) {
	$slots = array( 'a', 'b', 'c', 'd', 'e' );
	$imgs  = array();
	foreach ( array_slice( $ids, 0, 5 ) as $index => $id ) {
		$att = bi_image_id( function_exists( 'get_field' ) ? get_field( 'image', $id ) : '' );
		if ( ! $att ) {
			$att = get_post_thumbnail_id( $id );
		}
		$imgs[ $slots[ $index ] ] = $att ? wp_get_attachment_image_url( $att, 'large' ) : beauty_institute_asset( 'images/rezultaty_yakym.webp' );
	}
	// Pad to 5 with demo images so the grid keeps its shape.
	foreach ( $slots as $n => $slot ) {
		if ( empty( $imgs[ $slot ] ) ) {
			$imgs[ $slot ] = beauty_institute_asset( 'images/rezultaty_yakym' . ( $n ? '_' . $n : '' ) . '.webp' );
		}
	}
	?>
	<div class="rezultaty_yakym_panel<?php echo $is_active ? ' is_active' : ''; ?>" id="<?php echo esc_attr( $panel_id ); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr( $tab_id ); ?>" data-rezultaty-panel="<?php echo esc_attr( $slug ); ?>" aria-hidden="<?php echo $is_active ? 'false' : 'true'; ?>">
		<div class="rezultaty_yakym_grid">
			<div class="rezultaty_yakym_row rezultaty_yakym_row_top">
				<?php foreach ( array( 'a', 'b', 'c' ) as $slot ) : ?>
					<figure class="rezultaty_yakym_item rezultaty_yakym_item_<?php echo esc_attr( $slot ); ?>">
						<img class="rezultaty_yakym_img" src="<?php echo esc_url( $imgs[ $slot ] ); ?>" alt="" width="500" height="550" loading="lazy" decoding="async">
					</figure>
				<?php endforeach; ?>
			</div>
			<div class="rezultaty_yakym_row rezultaty_yakym_row_bottom">
				<?php foreach ( array( 'd', 'e' ) as $slot ) : ?>
					<figure class="rezultaty_yakym_item rezultaty_yakym_item_<?php echo esc_attr( $slot ); ?>">
						<img class="rezultaty_yakym_img" src="<?php echo esc_url( $imgs[ $slot ] ); ?>" alt="" width="700" height="550" loading="lazy" decoding="async">
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Render the whole "Результати, яким довіряють" tabbed section.
 *
 * @param string $title Section heading.
 * @param string $text  Section intro.
 */
function beauty_institute_results_tabs( $title = '', $text = '' ) {
	$title = $title ? $title : __( 'Результати, яким довіряють', 'beauty-institute' );
	$text  = $text ? $text : 'Реальні результати наших пацієнтів після лікування та естетичних процедур. Ми працюємо делікатно, щоб підкреслити природну красу без зайвого втручання.';

	$all = get_posts(
		array(
			'post_type'      => 'bi_result',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
		)
	);

	$panels = array();
	if ( $all ) {
		$panels[] = array( 'slug' => 'all', 'name' => __( 'Усі роботи', 'beauty-institute' ), 'ids' => $all );

		$terms = get_terms( array( 'taxonomy' => 'bi_result_cat', 'hide_empty' => true ) );
		foreach ( is_wp_error( $terms ) ? array() : $terms as $term ) {
			$ids = get_posts(
				array(
					'post_type'      => 'bi_result',
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'fields'         => 'ids',
					'no_found_rows'  => true,
					'tax_query'      => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
						array( 'taxonomy' => 'bi_result_cat', 'field' => 'term_id', 'terms' => $term->term_id ),
					),
				)
			);
			if ( $ids ) {
				$panels[] = array( 'slug' => $term->slug, 'name' => $term->name, 'ids' => $ids );
			}
		}
	} else {
		// No results entered yet — one demo panel with the design's tab labels.
		$panels[] = array( 'slug' => 'skin', 'name' => __( 'Лікування шкіри', 'beauty-institute' ), 'ids' => array() );
	}

	$active_index = ( count( $panels ) > 1 ) ? 1 : 0;
	?>
	<section class="rezultaty_yakym" data-rezultaty-tabs>
		<div class="container rezultaty_yakym_top">
			<div class="rezultaty_yakym_intro">
				<h2 class="rezultaty_yakym_title font_heading"><?php echo esc_html( $title ); ?></h2>
				<p class="rezultaty_yakym_text"><?php echo esc_html( $text ); ?></p>
			</div>
			<?php if ( count( $panels ) > 1 ) : ?>
			<div class="rezultaty_yakym_tabs" role="tablist" aria-label="Категорії робіт">
				<?php foreach ( $panels as $i => $panel ) : ?>
					<button
						class="rezultaty_yakym_tab<?php echo $i === $active_index ? ' is_active' : ''; ?>"
						type="button" role="tab"
						id="rezultaty-tab-<?php echo esc_attr( $panel['slug'] ); ?>"
						aria-selected="<?php echo $i === $active_index ? 'true' : 'false'; ?>"
						aria-controls="rezultaty-panel-<?php echo esc_attr( $panel['slug'] ); ?>"
						data-rezultaty-tab="<?php echo esc_attr( $panel['slug'] ); ?>"
						tabindex="<?php echo $i === $active_index ? '0' : '-1'; ?>"
					><?php echo esc_html( $panel['name'] ); ?></button>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>
		<div class="rezultaty_yakym_panels">
			<?php
			foreach ( $panels as $i => $panel ) {
				beauty_institute_results_panel(
					$panel['ids'],
					$i === $active_index,
					'rezultaty-panel-' . $panel['slug'],
					'rezultaty-tab-' . $panel['slug'],
					$panel['slug']
				);
			}
			?>
		</div>
	</section>
	<?php
}

/**
 * Render one apparatus-procedure block (box_type_1 / box_type_2).
 *
 * @param int $id    bi_device post ID.
 * @param int $index Zero-based position (drives the "auto" layout).
 */
function beauty_institute_device_block( $id, $index ) {
	$title    = get_the_title( $id );
	$device   = (string) get_field( 'device_name', $id );
	$duration = (string) get_field( 'duration', $id );
	$text     = (string) get_field( 'text', $id );
	$benefits = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) get_field( 'benefits', $id ) ) ) );

	$photo_id = bi_image_id( get_field( 'photo', $id ) );
	if ( ! $photo_id ) {
		$photo_id = get_post_thumbnail_id( $id );
	}
	$photo = $photo_id ? wp_get_attachment_image_url( $photo_id, 'large' ) : beauty_institute_asset( 'images/zemits/mikrostrumova_terapiya.webp' );

	$yt        = beauty_institute_youtube_id( (string) get_field( 'video_url', $id ) );
	$poster_id = bi_image_id( get_field( 'video_poster', $id ) );
	$poster    = $poster_id ? wp_get_attachment_image_url( $poster_id, 'large' ) : $photo;

	$layout = (string) get_field( 'layout', $id );
	if ( '' === $layout ) {
		$layout = ( $index % 2 === 0 ) ? 'type_1' : 'type_2';
	}

	$cta   = esc_url( home_url( '/#consult' ) );
	$icon1 = beauty_institute_asset( 'images/zemits/mikrostrumova_terapiya_3.svg' );
	$icon2 = beauty_institute_asset( 'images/zemits/kompleksnyi_dohlyad_2.svg' );
	$clock = beauty_institute_asset( 'images/zemits/clock.svg' );

	if ( 'type_2' === $layout ) :
		?>
		<section class="box_type_2<?php echo $yt ? '' : ' box_type_2_bez_video'; ?>" aria-label="<?php echo esc_attr( $title ); ?>">
			<div class="container box_type_2_inner">
				<div class="box_type_2_head">
					<div class="box_type_2_heading">
						<h2 class="box_type_2_title font_heading"><?php echo esc_html( $title ); ?></h2>
						<?php if ( $device ) : ?><p class="box_type_2_device"><?php echo esc_html( $device ); ?></p><?php endif; ?>
					</div>
					<?php if ( $duration ) : ?>
					<p class="box_type_2_time">
						<img class="box_type_2_time_icon" src="<?php echo esc_url( $clock ); ?>" alt="" width="24" height="24" decoding="async" aria-hidden="true">
						<span><?php echo esc_html( $duration ); ?></span>
					</p>
					<?php endif; ?>
				</div>

				<div class="box_type_2_content">
					<div class="box_type_2_body">
						<?php if ( $text ) : ?><p class="box_type_2_text"><?php echo esc_html( $text ); ?></p><?php endif; ?>
						<?php if ( $benefits ) : ?>
						<ul class="box_type_2_list">
							<?php foreach ( $benefits as $b ) : ?>
								<li class="box_type_2_item">
									<img class="box_type_2_item_icon" src="<?php echo esc_url( $icon2 ); ?>" alt="" width="10" height="10" decoding="async" aria-hidden="true">
									<span class="box_type_2_item_text"><?php echo esc_html( $b ); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
						<a class="box_type_2_btn" href="<?php echo $cta; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
							<span class="box_type_2_btn_text"><?php esc_html_e( 'Записатись', 'beauty-institute' ); ?></span>
							<span class="box_type_2_btn_icon" aria-hidden="true"></span>
						</a>
					</div>

					<?php if ( $yt ) : ?>
					<button type="button" class="box_type_2_media box_type_2_video" data-video-open data-youtube-id="<?php echo esc_attr( $yt ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Дивитися відео: %s', 'beauty-institute' ), $title ) ); ?>">
						<img class="box_type_2_img" src="<?php echo esc_url( $poster ); ?>" alt="" width="620" height="468" loading="lazy" decoding="async">
						<span class="box_type_2_play" aria-hidden="true">
							<img class="box_type_2_play_icon" src="<?php echo esc_url( beauty_institute_asset( 'images/zemits/kompleksnyi_dohlyad_7.svg' ) ); ?>" alt="" width="19" height="20" decoding="async">
						</span>
						<span class="box_type_2_caption">
							<span class="box_type_2_caption_title"><?php echo esc_html( $title ); ?></span>
							<?php if ( $device ) : ?><span class="box_type_2_caption_device"><?php echo esc_html( $device ); ?></span><?php endif; ?>
						</span>
					</button>
					<?php else : ?>
					<div class="box_type_2_media box_type_2_photo">
						<img class="box_type_2_img" src="<?php echo esc_url( $photo ); ?>" alt="" width="620" height="468" loading="lazy" decoding="async">
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php beauty_institute_video_modal( $title ); ?>
		</section>
		<?php
	else :
		?>
		<section class="box_type_1" aria-label="<?php echo esc_attr( $title ); ?>">
			<div class="container box_type_1_inner">
				<div class="box_type_1_head">
					<div class="box_type_1_heading">
						<h2 class="box_type_1_title font_heading"><?php echo esc_html( $title ); ?></h2>
						<div class="box_type_1_meta">
							<?php if ( $device ) : ?><p class="box_type_1_device"><?php echo esc_html( $device ); ?></p><?php endif; ?>
							<?php if ( $duration ) : ?>
							<p class="box_type_1_time">
								<img class="box_type_1_time_icon" src="<?php echo esc_url( $clock ); ?>" alt="" width="24" height="24" decoding="async" aria-hidden="true">
								<span><?php echo esc_html( $duration ); ?></span>
							</p>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<div class="box_type_1_media">
					<div class="box_type_1_photo">
						<img class="box_type_1_img" src="<?php echo esc_url( $photo ); ?>" alt="" width="620" height="478" loading="lazy" decoding="async">
					</div>

					<?php if ( $yt ) : ?>
					<button type="button" class="box_type_1_video" data-video-open data-youtube-id="<?php echo esc_attr( $yt ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Дивитися відео: %s', 'beauty-institute' ), $title ) ); ?>">
						<img class="box_type_1_img" src="<?php echo esc_url( $poster ); ?>" alt="" width="620" height="478" loading="lazy" decoding="async">
						<span class="box_type_1_play" aria-hidden="true">
							<img class="box_type_1_play_icon" src="<?php echo esc_url( beauty_institute_asset( 'images/zemits/mikrostrumova_terapiya_2.svg' ) ); ?>" alt="" width="19" height="20" decoding="async">
						</span>
						<span class="box_type_1_caption">
							<span class="box_type_1_caption_title"><?php echo esc_html( $title ); ?></span>
							<?php if ( $device ) : ?><span class="box_type_1_caption_device"><?php echo esc_html( $device ); ?></span><?php endif; ?>
						</span>
					</button>
					<?php endif; ?>
				</div>

				<div class="box_type_1_body">
					<?php if ( $text ) : ?><p class="box_type_1_text"><?php echo esc_html( $text ); ?></p><?php endif; ?>
					<?php if ( $benefits ) : ?>
					<ul class="box_type_1_list">
						<?php foreach ( $benefits as $b ) : ?>
							<li class="box_type_1_item">
								<img class="box_type_1_item_icon" src="<?php echo esc_url( $icon1 ); ?>" alt="" width="10" height="10" decoding="async" aria-hidden="true">
								<span class="box_type_1_item_text"><?php echo esc_html( $b ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				</div>

				<a class="box_type_1_btn" href="<?php echo $cta; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
					<span class="box_type_1_btn_text"><?php esc_html_e( 'Записатись', 'beauty-institute' ); ?></span>
					<span class="box_type_1_btn_icon" aria-hidden="true"></span>
				</a>
			</div>
			<?php beauty_institute_video_modal( $title ); ?>
		</section>
		<?php
	endif;
}

/**
 * Output a single YouTube modal shell (used once per video block).
 *
 * @param string $label Accessible label.
 */
function beauty_institute_video_modal( $label = 'Відео' ) {
	?>
	<div class="videovidhuky_modal" data-video-modal hidden>
		<div class="videovidhuky_modal_backdrop" data-video-modal-close tabindex="-1"></div>
		<div class="videovidhuky_modal_dialog" role="dialog" aria-modal="true" aria-label="<?php echo esc_attr( $label ); ?>">
			<button type="button" class="videovidhuky_modal_close" data-video-modal-close aria-label="Закрити відео"></button>
			<div class="videovidhuky_modal_frame">
				<iframe class="videovidhuky_modal_iframe" data-video-iframe title="<?php echo esc_attr( $label ); ?>" src="" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Render the "Усе, що ви хотіли запитати" FAQ accordion (use_shcho).
 *
 * @param string $title    Section heading.
 * @param int    $group_id Optional bi_faq_group term ID to filter by.
 */
function beauty_institute_faq_section( $title = '', $group_id = 0 ) {
	$title = $title ? $title : __( 'Усе, що ви хотіли запитати', 'beauty-institute' );

	$args = array(
		'post_type'      => 'bi_faq',
		'post_status'    => 'publish',
		'posts_per_page' => 20,
		'fields'         => 'ids',
		'no_found_rows'  => true,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
	);
	if ( $group_id ) {
		$args['tax_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
			array( 'taxonomy' => 'bi_faq_group', 'field' => 'term_id', 'terms' => (int) $group_id ),
		);
	}
	$faqs = get_posts( $args );

	$icon = beauty_institute_asset( 'images/child_cat/use_shcho.svg' );
	?>
	<section class="use_shcho" aria-label="Усе, що ви хотіли запитати">
		<span class="use_shcho_bg" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/zemits/bg.webp' ) ); ?>');" aria-hidden="true"></span>

		<div class="container use_shcho_inner">
			<div class="use_shcho_panel">
				<h2 class="use_shcho_title"><?php echo esc_html( $title ); ?></h2>

				<div class="use_shcho_list">
					<?php
					if ( $faqs ) {
						foreach ( $faqs as $i => $faq_id ) {
							$open = ( 0 === $i );
							?>
							<div class="use_shcho_item<?php echo $open ? ' is_open' : ''; ?>">
								<button class="use_shcho_toggle" type="button" aria-expanded="<?php echo $open ? 'true' : 'false'; ?>">
									<span class="use_shcho_question"><?php echo esc_html( get_the_title( $faq_id ) ); ?></span>
									<span class="use_shcho_icon" style="background-image: url('<?php echo esc_url( $icon ); ?>');" aria-hidden="true"></span>
								</button>
								<div class="use_shcho_answer">
									<div class="use_shcho_answer_inner">
										<?php echo wp_kses_post( (string) get_field( 'answer', $faq_id ) ); ?>
									</div>
								</div>
							</div>
							<?php
						}
					} else {
						$demo = array(
							array( 'Чому нам довіряють?', '<p class="use_shcho_answer_text">Пацієнти звертаються до нас, тому що є багато позитивних відгуків, працюють досвідчені лікарі, а наш медичний центр має позитивну репутацію.</p>' ),
							array( 'Яка кваліфікація у наших спеціалістів?', '<p class="use_shcho_answer_text">Наші лікарі мають вищу категорію, постійно підвищують кваліфікацію та проходять навчання за сучасними методиками.</p>' ),
							array( 'Чи сучасне у нас обладнання?', '<p class="use_shcho_answer_text">Ми працюємо на сертифікованих американських апаратах Zemits та інших сучасних системах.</p>' ),
						);
						foreach ( $demo as $i => $d ) {
							$open = ( 0 === $i );
							?>
							<div class="use_shcho_item<?php echo $open ? ' is_open' : ''; ?>">
								<button class="use_shcho_toggle" type="button" aria-expanded="<?php echo $open ? 'true' : 'false'; ?>">
									<span class="use_shcho_question"><?php echo esc_html( $d[0] ); ?></span>
									<span class="use_shcho_icon" style="background-image: url('<?php echo esc_url( $icon ); ?>');" aria-hidden="true"></span>
								</button>
								<div class="use_shcho_answer">
									<div class="use_shcho_answer_inner"><?php echo wp_kses_post( $d[1] ); ?></div>
								</div>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Render the whole "Запис на консультацію" section.
 */
function beauty_institute_consult_section() {
	?>
	<section class="consult" id="consult" aria-label="Запис на консультацію">
		<div
			class="consult_media"
			aria-hidden="true"
			style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/zapys_img_mob.webp' ) ); ?>');"
		></div>

		<div class="container consult_container">
			<div
				class="consult_box"
				style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/zapys_bg.webp' ) ); ?>');"
			>
				<div class="consult_form_col">
					<h2 class="consult_title font_heading"><?php echo esc_html( bi_section_value( 'consult_title', __( 'Запис на консультацію', 'beauty-institute' ) ) ); ?></h2>
					<p class="consult_intro consult_intro_desktop"><?php echo esc_html( bi_section_value( 'consult_intro_desktop', 'Ми завжди раді відповісти на всі хвилюючі вас питання і зробити все можливе для поліпшення вашого здоров’я і зовнішнього вигляду' ) ); ?></p>
					<p class="consult_intro consult_intro_mobile"><?php echo esc_html( bi_section_value( 'consult_intro_mobile', 'Допоможемо визначити проблему та підібрати лікування.' ) ); ?></p>

					<?php beauty_institute_consult_form( bi_field( 'consult_form' ) ); ?>
				</div>

				<div class="consult_visual" aria-hidden="true"></div>
			</div>
		</div>
	</section>
	<?php
}
