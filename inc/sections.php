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
