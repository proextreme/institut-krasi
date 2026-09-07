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
					<p class="footer_slogan"><?php esc_html_e( 'Традиції медицини та сучасні технології краси', 'beauty-institute' ); ?></p>
					<div class="footer_contacts">
						<p class="footer_contacts_item"><strong><?php esc_html_e( 'м. Київ', 'beauty-institute' ); ?></strong> <?php esc_html_e( 'вул. Євгена Чикаленка, 20А', 'beauty-institute' ); ?></p>
						<p class="footer_contacts_item"><strong><?php esc_html_e( 'Телефон:', 'beauty-institute' ); ?></strong> <a href="tel:+380985101551">+38-098-510-15-51</a> <a href="tel:+380955101551">+38-095-510-15-51</a></p>
						<p class="footer_contacts_item"><strong>E-mail:</strong> <a href="mailto:22872120@ukr.net">22872120@ukr.net</a></p>
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
							<li class="footer_socials_item">
								<a class="footer_socials_link" href="#" target="_blank" rel="noopener noreferrer" aria-label="Instagram" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/instagram_footer.svg' ) ); ?>');"></a>
							</li>
							<li class="footer_socials_item">
								<a class="footer_socials_link" href="#" target="_blank" rel="noopener noreferrer" aria-label="Facebook" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/fb_footer.svg' ) ); ?>');"></a>
							</li>
							<li class="footer_socials_item">
								<a class="footer_socials_link" href="#" target="_blank" rel="noopener noreferrer" aria-label="YouTube" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/youtube_footer.svg' ) ); ?>');"></a>
							</li>
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
					<a class="footer_legal_link" href="#"><?php esc_html_e( 'Умови використання', 'beauty-institute' ); ?></a>
					<a class="footer_legal_link" href="#"><?php esc_html_e( 'Політика конфіденційності', 'beauty-institute' ); ?></a>
				</div>
				<p class="footer_copy">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php esc_html_e( 'ІНСТИТУТ КРАСИ', 'beauty-institute' ); ?></p>
			</div>
		</div>
	</footer>

<?php wp_footer(); ?>
</body>
</html>
