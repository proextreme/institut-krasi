<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package beauty-institute
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

	<header class="header">
		<div class="container header_inner">
			<a class="header_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img class="header_logo_img header_logo_img_desktop" src="<?php echo esc_url( beauty_institute_asset( 'images/logo.svg' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="292" height="54">
				<img class="header_logo_img header_logo_img_mobile" src="<?php echo esc_url( beauty_institute_asset( 'images/logo_mobile.svg' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="184" height="34">
			</a>

			<div class="header_right">
				<nav class="header_nav" aria-label="<?php esc_attr_e( 'Головне меню', 'beauty-institute' ); ?>">
					<?php
					if ( has_nav_menu( 'menu-1' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_class'     => 'header_nav_list',
								'container'      => false,
								'fallback_cb'    => false,
								'depth'          => 2,
							)
						);
					} else {
						?>
						<ul class="header_nav_list">
							<li class="header_nav_item"><a class="header_nav_link" href="<?php echo esc_url( home_url( '/pro-nas/' ) ); ?>"><?php esc_html_e( 'Про нас', 'beauty-institute' ); ?></a></li>
							<li class="header_nav_item"><a class="header_nav_link" href="<?php echo esc_url( home_url( '/poslugi/' ) ); ?>"><?php esc_html_e( 'Послуги', 'beauty-institute' ); ?></a></li>
							<li class="header_nav_item"><a class="header_nav_link" href="<?php echo esc_url( home_url( '/prays' ) ); ?>"><?php esc_html_e( 'Прайс', 'beauty-institute' ); ?></a></li>
							<li class="header_nav_item"><a class="header_nav_link" href="<?php echo esc_url( home_url( '/likari' ) ); ?>"><?php esc_html_e( 'Лікарі', 'beauty-institute' ); ?></a></li>
							<li class="header_nav_item"><a class="header_nav_link" href="<?php echo esc_url( home_url( '/vidguki' ) ); ?>"><?php esc_html_e( 'Відгуки', 'beauty-institute' ); ?></a></li>
							<li class="header_nav_item header_nav_item_has_dropdown">
								<a class="header_nav_link" href="<?php echo esc_url( home_url( '/#devices' ) ); ?>" aria-haspopup="true"><?php esc_html_e( 'Технології', 'beauty-institute' ); ?></a>
								<ul class="header_nav_dropdown">
									<li class="header_nav_dropdown_item">
										<a class="header_nav_dropdown_link" href="<?php echo esc_url( home_url( '/aparati-zemits/' ) ); ?>"><?php esc_html_e( 'Апарати Zemits', 'beauty-institute' ); ?></a>
									</li>
									
								</ul>
							</li>
							<li class="header_nav_item"><a class="header_nav_link" href="<?php echo esc_url( home_url( '/kontakti' ) ); ?>"><?php esc_html_e( 'Контакти', 'beauty-institute' ); ?></a></li>
						</ul>
						<?php
					}
					?>
				</nav>

				<div class="header_actions">
					<a class="btn btn_consultation" href="<?php echo esc_url( home_url( '/#consult' ) ); ?>">
						<span class="btn_icon" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chat.svg' ) ); ?>');" aria-hidden="true"></span>
						<span class="btn_text"><?php esc_html_e( 'Консультація', 'beauty-institute' ); ?></span>
					</a>

					<button class="header_burger" type="button" aria-label="<?php esc_attr_e( 'Відкрити меню', 'beauty-institute' ); ?>" aria-expanded="false" aria-controls="mobile-menu">
						<span class="header_burger_icon" aria-hidden="true"></span>
					</button>
				</div>
			</div>
		</div>
	</header>

	<div class="mobile_menu_backdrop" id="mobile-menu-backdrop" aria-hidden="true"></div>

	<div class="mobile_menu" id="mobile-menu" aria-hidden="true">
		<span class="mobile_menu_decor" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/menu_decor.webp' ) ); ?>');" aria-hidden="true"></span>

		<button class="mobile_menu_close" type="button" aria-label="<?php esc_attr_e( 'Закрити меню', 'beauty-institute' ); ?>">
			<span class="mobile_menu_close_icon" aria-hidden="true"></span>
		</button>

		<div class="mobile_menu_content">
			<a class="mobile_menu_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img class="mobile_menu_logo_img" src="<?php echo esc_url( beauty_institute_asset( 'images/logo_menu.svg' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="184" height="34">
			</a>

			<nav class="mobile_menu_nav" aria-label="<?php esc_attr_e( 'Мобільне меню', 'beauty-institute' ); ?>">
				<ul class="mobile_menu_list">
					<li class="mobile_menu_item"><a class="mobile_menu_link" href="<?php echo esc_url( home_url( '/pro-nas/' ) ); ?>"><?php esc_html_e( 'Про нас', 'beauty-institute' ); ?></a></li>
					<li class="mobile_menu_item"><a class="mobile_menu_link" href="<?php echo esc_url( home_url( '/poslugi/' ) ); ?>"><?php esc_html_e( 'Послуги', 'beauty-institute' ); ?></a></li>
					<li class="mobile_menu_item"><a class="mobile_menu_link" href="<?php echo esc_url( home_url( '/prays' ) ); ?>"><?php esc_html_e( 'Прайс', 'beauty-institute' ); ?></a></li>
					<li class="mobile_menu_item"><a class="mobile_menu_link" href="<?php echo esc_url( home_url( '/likari' ) ); ?>"><?php esc_html_e( 'Лікарі', 'beauty-institute' ); ?></a></li>
					<li class="mobile_menu_item"><a class="mobile_menu_link" href="<?php echo esc_url( home_url( '/vidguki' ) ); ?>"><?php esc_html_e( 'Відгуки', 'beauty-institute' ); ?></a></li>
					<li class="mobile_menu_item"><a class="mobile_menu_link" href="<?php echo esc_url( home_url( '/#devices' ) ); ?>"><?php esc_html_e( 'Технології', 'beauty-institute' ); ?></a></li>
					<li class="mobile_menu_item"><a class="mobile_menu_link" href="<?php echo esc_url( home_url( '/kontakti' ) ); ?>"><?php esc_html_e( 'Контакти', 'beauty-institute' ); ?></a></li>
				</ul>
			</nav>

			<a class="btn btn_consultation btn_consultation_menu" href="<?php echo esc_url( home_url( '/#consult' ) ); ?>">
				<span class="btn_icon" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/icon_chat_white.svg' ) ); ?>');" aria-hidden="true"></span>
				<span class="btn_text"><?php esc_html_e( 'Консультація', 'beauty-institute' ); ?></span>
			</a>

			<div class="mobile_menu_divider" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/menu_divider.svg' ) ); ?>');" aria-hidden="true"></div>

			<ul class="mobile_menu_socials">
				<li class="mobile_menu_socials_item">
					<a class="mobile_menu_socials_link" href="#" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
						<span class="mobile_menu_socials_icon" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/instagram_menu.svg' ) ); ?>');" aria-hidden="true"></span>
					</a>
				</li>
				<li class="mobile_menu_socials_item">
					<a class="mobile_menu_socials_link" href="#" target="_blank" rel="noopener noreferrer" aria-label="Threads">
						<span class="mobile_menu_socials_icon" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/threads_menu.svg' ) ); ?>');" aria-hidden="true"></span>
					</a>
				</li>
				<li class="mobile_menu_socials_item">
					<a class="mobile_menu_socials_link" href="#" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
						<span class="mobile_menu_socials_icon" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/fb_menu.svg' ) ); ?>');" aria-hidden="true"></span>
					</a>
				</li>
				<li class="mobile_menu_socials_item">
					<a class="mobile_menu_socials_link" href="#" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
						<span class="mobile_menu_socials_icon" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/youtube_menu.svg' ) ); ?>');" aria-hidden="true"></span>
					</a>
				</li>
				<li class="mobile_menu_socials_item">
					<a class="mobile_menu_socials_link" href="#" target="_blank" rel="noopener noreferrer" aria-label="Meta">
						<span class="mobile_menu_socials_icon" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/meta_menu.svg' ) ); ?>');" aria-hidden="true"></span>
					</a>
				</li>
				<li class="mobile_menu_socials_item">
					<a class="mobile_menu_socials_link" href="#" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
						<span class="mobile_menu_socials_icon" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/whatsapp_menu.svg' ) ); ?>');" aria-hidden="true"></span>
					</a>
				</li>
				<li class="mobile_menu_socials_item">
					<a class="mobile_menu_socials_link" href="#" target="_blank" rel="noopener noreferrer" aria-label="Messenger">
						<span class="mobile_menu_socials_icon" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/fb_mess_menu.svg' ) ); ?>');" aria-hidden="true"></span>
					</a>
				</li>
				<li class="mobile_menu_socials_item">
					<a class="mobile_menu_socials_link" href="#" target="_blank" rel="noopener noreferrer" aria-label="Telegram">
						<span class="mobile_menu_socials_icon" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/telegram_menu.svg' ) ); ?>');" aria-hidden="true"></span>
					</a>
				</li>
			</ul>
		</div>
	</div>

	<main class="page" id="primary">
