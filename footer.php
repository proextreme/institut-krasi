<?php
/**
 * The template for displaying the footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package beauty-institute
 */
?>
	</main>

	<footer class="footer" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/footer_bg.webp' ) ); ?>');">
		<div class="container footer_inner">
			<div class="footer_top">
				<div class="footer_brand">
					<a class="footer_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img class="footer_logo_img footer_logo_img_desktop" src="<?php echo esc_url( beauty_institute_asset( 'images/logo_footer.svg' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="292" height="54">
						<img class="footer_logo_img footer_logo_img_mobile" src="<?php echo esc_url( beauty_institute_asset( 'images/logo_footer_mobile.svg' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="184" height="34">
					</a>
					<p class="footer_slogan"><?php bi_option_text( 'footer_slogan', 'Традиції медицини та сучасні технології краси' ); ?></p>
					<div class="footer_contacts">
						<p class="footer_contacts_item"><strong><?php bi_option_text( 'address_locality', 'м. Київ' ); ?></strong> <?php echo wp_kses_post( bi_option( 'address_street', 'вул. Євгена Чикаленка, 20А' ) ); ?></p>
						<p class="footer_contacts_item">
							<strong><?php esc_html_e( 'Телефон:', 'beauty-institute' ); ?></strong>
							<?php
							$footer_phone_1 = bi_option( 'phone_1', '+38-098-510-15-51' );
							$footer_phone_2 = bi_option( 'phone_2', '+38-095-510-15-51' );
							if ( $footer_phone_1 ) {
								printf( '<a href="tel:%s">%s</a> ', esc_attr( preg_replace( '/[^\d+]/', '', $footer_phone_1 ) ), esc_html( $footer_phone_1 ) );
							}
							if ( $footer_phone_2 ) {
								printf( '<a href="tel:%s">%s</a>', esc_attr( preg_replace( '/[^\d+]/', '', $footer_phone_2 ) ), esc_html( $footer_phone_2 ) );
							}
							?>
						</p>
						<?php $footer_email = bi_option( 'email', '22872120@ukr.net' ); ?>
						<p class="footer_contacts_item"><strong>E-mail:</strong> <a href="mailto:<?php echo esc_attr( $footer_email ); ?>"><?php echo esc_html( $footer_email ); ?></a></p>
					</div>
				</div>

				<div class="footer_cols">
					<?php
					$footer_columns = array(
						array(
							'title'    => bi_option( 'footer_col_1_title', 'Послуги' ),
							'location' => 'footer-1',
							'open'     => true,
							'fallback' => array(
								array( 'label' => 'Видалення новоутворень', 'url' => home_url( '/poslugi/' ) ),
								array( 'label' => 'Ін’єкційна косметологія', 'url' => home_url( '/poslugi/' ) ),
								array( 'label' => 'Пластична хірургія', 'url' => home_url( '/poslugi/' ) ),
								array( 'label' => 'Апаратна косметологія', 'url' => home_url( '/poslugi/' ) ),
								array( 'label' => 'Доглядові процедури', 'url' => home_url( '/poslugi/' ) ),
							),
						),
						array(
							'title'    => bi_option( 'footer_col_2_title', 'Що ми вирішуємо?' ),
							'location' => 'footer-2',
							'open'     => false,
							'fallback' => array(
								array( 'label' => 'Новоутворення на шкірі', 'url' => '#' ),
								array( 'label' => 'Розацеа', 'url' => '#' ),
								array( 'label' => 'Акне (вугрова хвороба)', 'url' => '#' ),
								array( 'label' => 'Пігментація шкіри', 'url' => '#' ),
								array( 'label' => 'Рубці', 'url' => '#' ),
								array( 'label' => 'Випадіння волосся', 'url' => '#' ),
								array( 'label' => 'Себорейний дерматит', 'url' => '#' ),
								array( 'label' => 'Вікові зміни шкіри', 'url' => '#' ),
							),
						),
						array(
							'title'    => bi_option( 'footer_col_3_title', 'Про ІНСТИТУТ КРАСИ' ),
							'location' => 'footer-3',
							'open'     => false,
							'fallback' => array(
								array( 'label' => 'Про нас', 'url' => home_url( '/pro-nas/' ) ),
								array( 'label' => 'Лікарі', 'url' => home_url( '/likari/' ) ),
								array( 'label' => 'Ціни', 'url' => home_url( '/prays/' ) ),
								array( 'label' => 'Корисна інформація', 'url' => '#' ),
								array( 'label' => 'Контакти', 'url' => home_url( '/kontakti/' ) ),
							),
						),
					);
					foreach ( $footer_columns as $col_index => $col ) :
						?>
						<div class="footer_col<?php echo $col['open'] ? ' is_open' : ''; ?>">
							<button class="footer_col_toggle" type="button" aria-expanded="<?php echo $col['open'] ? 'true' : 'false'; ?>">
								<span class="footer_col_title"><?php echo esc_html( $col['title'] ); ?></span>
								<span class="footer_col_arrow" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_accordion.svg' ) ); ?>');" aria-hidden="true"></span>
							</button>
							<?php beauty_institute_footer_menu( $col['location'], $col['fallback'] ); ?>
							<?php if ( 2 === $col_index ) : ?>

							<ul class="footer_socials">
							<?php
							$footer_socials = array(
								'social_instagram' => array( 'Instagram', 'images/instagram_footer.svg' ),
								'social_facebook'  => array( 'Facebook', 'images/fb_footer.svg' ),
								'social_youtube'   => array( 'YouTube', 'images/youtube_footer.svg' ),
							);
							foreach ( $footer_socials as $key => $meta ) :
								$url = bi_option( $key );
								if ( ! $url ) {
									continue;
								}
								?>
								<li class="footer_socials_item">
									<a class="footer_socials_link" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $meta[0] ); ?>" style="background-image: url('<?php echo esc_url( beauty_institute_asset( $meta[1] ) ); ?>');"></a>
								</li>
							<?php endforeach; ?>
							</ul>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="footer_bottom">
				<div class="footer_legal">
					<?php
					$footer_terms   = bi_option( 'footer_terms_link' );
					$footer_privacy = bi_option( 'footer_privacy_link' );
					?>
					<a class="footer_legal_link" href="<?php echo esc_url( is_array( $footer_terms ) && ! empty( $footer_terms['url'] ) ? $footer_terms['url'] : '#' ); ?>"><?php echo esc_html( is_array( $footer_terms ) && ! empty( $footer_terms['title'] ) ? $footer_terms['title'] : __( 'Умови використання', 'beauty-institute' ) ); ?></a>
					<a class="footer_legal_link" href="<?php echo esc_url( is_array( $footer_privacy ) && ! empty( $footer_privacy['url'] ) ? $footer_privacy['url'] : '#' ); ?>"><?php echo esc_html( is_array( $footer_privacy ) && ! empty( $footer_privacy['title'] ) ? $footer_privacy['title'] : __( 'Політика конфіденційності', 'beauty-institute' ) ); ?></a>
				</div>
				<p class="footer_copy">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bi_option_text( 'footer_copy_name', 'ІНСТИТУТ КРАСИ' ); ?></p>
			</div>
		</div>
	</footer>

<?php wp_footer(); ?>
</body>
</html>
