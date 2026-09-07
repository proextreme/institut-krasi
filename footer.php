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
					<div class="footer_col is_open">
						<button class="footer_col_toggle" type="button" aria-expanded="true">
							<span class="footer_col_title"><?php esc_html_e( 'Послуги', 'beauty-institute' ); ?></span>
							<span class="footer_col_arrow" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_accordion.svg' ) ); ?>');" aria-hidden="true"></span>
						</button>
						<ul class="footer_col_list">
							<li class="footer_col_item">
								<a class="footer_col_link" href="<?php echo esc_url( home_url( '/poslugi/' ) ); ?>"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Видалення новоутворень', 'beauty-institute' ); ?></a>
							</li>
							<li class="footer_col_item">
								<a class="footer_col_link" href="<?php echo esc_url( home_url( '/poslugi/' ) ); ?>"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Ін’єкційна косметологія', 'beauty-institute' ); ?></a>
							</li>
							<li class="footer_col_item">
								<a class="footer_col_link" href="<?php echo esc_url( home_url( '/poslugi/' ) ); ?>"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Пластична хірургія', 'beauty-institute' ); ?></a>
							</li>
							<li class="footer_col_item">
								<a class="footer_col_link" href="<?php echo esc_url( home_url( '/poslugi/' ) ); ?>"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Апаратна косметологія', 'beauty-institute' ); ?></a>
							</li>
							<li class="footer_col_item">
								<a class="footer_col_link" href="<?php echo esc_url( home_url( '/poslugi/' ) ); ?>"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Доглядові процедури', 'beauty-institute' ); ?></a>
							</li>
						</ul>
					</div>

					<div class="footer_col">
						<button class="footer_col_toggle" type="button" aria-expanded="false">
							<span class="footer_col_title"><?php esc_html_e( 'Що ми вирішуємо?', 'beauty-institute' ); ?></span>
							<span class="footer_col_arrow" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_accordion.svg' ) ); ?>');" aria-hidden="true"></span>
						</button>
						<ul class="footer_col_list">
							<li class="footer_col_item">
								<a class="footer_col_link" href="#"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Новоутворення на шкірі', 'beauty-institute' ); ?></a>
							</li>
							<li class="footer_col_item">
								<a class="footer_col_link" href="#"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Розацеа', 'beauty-institute' ); ?></a>
							</li>
							<li class="footer_col_item">
								<a class="footer_col_link" href="#"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Акне (вугрова хвороба)', 'beauty-institute' ); ?></a>
							</li>
							<li class="footer_col_item">
								<a class="footer_col_link" href="#"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Пігментація шкіри', 'beauty-institute' ); ?></a>
							</li>
							<li class="footer_col_item">
								<a class="footer_col_link" href="#"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Рубці', 'beauty-institute' ); ?></a>
							</li>
							<li class="footer_col_item">
								<a class="footer_col_link" href="#"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Випадіння волосся', 'beauty-institute' ); ?></a>
							</li>
							<li class="footer_col_item">
								<a class="footer_col_link" href="#"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Себорейний дерматит', 'beauty-institute' ); ?></a>
							</li>
							<li class="footer_col_item">
								<a class="footer_col_link" href="#"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Вікові зміни шкіри', 'beauty-institute' ); ?></a>
							</li>
						</ul>
					</div>

					<div class="footer_col">
						<button class="footer_col_toggle" type="button" aria-expanded="false">
							<span class="footer_col_title"><?php esc_html_e( 'Про ІНСТИТУТ КРАСИ', 'beauty-institute' ); ?></span>
							<span class="footer_col_arrow" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_accordion.svg' ) ); ?>');" aria-hidden="true"></span>
						</button>
						<ul class="footer_col_list">
							<li class="footer_col_item">
								<a class="footer_col_link" href="<?php echo esc_url( home_url( '/pro-nas/' ) ); ?>"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Про нас', 'beauty-institute' ); ?></a>
							</li>
							<li class="footer_col_item">
								<a class="footer_col_link" href="<?php echo esc_url( home_url( '/#doctors' ) ); ?>"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Лікарі', 'beauty-institute' ); ?></a>
							</li>
							<li class="footer_col_item">
								<a class="footer_col_link" href="<?php echo esc_url( home_url( '/#price' ) ); ?>"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Ціни', 'beauty-institute' ); ?></a>
							</li>
							<li class="footer_col_item">
								<a class="footer_col_link" href="#"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Корисна інформація', 'beauty-institute' ); ?></a>
							</li>
							<li class="footer_col_item">
								<a class="footer_col_link" href="<?php echo esc_url( home_url( '/#contacts' ) ); ?>"><span class="footer_col_chevron" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chevron.svg' ) ); ?>');" aria-hidden="true"></span><?php esc_html_e( 'Контакти', 'beauty-institute' ); ?></a>
							</li>
						</ul>

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
							<!-- <li class="footer_socials_item">
								<a class="footer_socials_link" href="#" target="_blank" rel="noopener noreferrer" aria-label="Threads" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/threads_footer.svg' ) ); ?>');"></a>
							</li> 
							
							
							<li class="footer_socials_item">
								<a class="footer_socials_link" href="#" target="_blank" rel="noopener noreferrer" aria-label="Meta" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/meta_footer.svg' ) ); ?>');"></a>
							</li>
							<li class="footer_socials_item">
								<a class="footer_socials_link" href="#" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/whatsapp_footer.svg' ) ); ?>');"></a>
							</li>
							<li class="footer_socials_item">
								<a class="footer_socials_link" href="#" target="_blank" rel="noopener noreferrer" aria-label="Messenger" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/fb_mess_footer.svg' ) ); ?>');"></a>
							</li>
							<li class="footer_socials_item">
								<a class="footer_socials_link" href="#" target="_blank" rel="noopener noreferrer" aria-label="Telegram" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/telegram_footer.svg' ) ); ?>');"></a>
							</li>-->
						</ul>
					</div>
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
