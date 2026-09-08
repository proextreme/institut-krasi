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
