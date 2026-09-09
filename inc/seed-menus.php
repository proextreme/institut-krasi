<?php
/**
 * One-time seed for nav menus + header/footer settings (temporary).
 *
 * Runs once (guarded by bi_menus_seeded). Never overwrites a setting that
 * already has a value, and never reassigns a menu location that is already set.
 * Removed in a follow-up change.
 *
 * @package beauty-institute
 */

add_action(
	'init',
	function () {
		if ( get_option( 'bi_menus_seeded' ) ) {
			return;
		}
		if ( ! function_exists( 'update_field' ) ) {
			return;
		}

		$locations = get_theme_mod( 'nav_menu_locations', array() );

		/**
		 * Create a menu with flat items if it does not exist, and assign it
		 * to a location when that location is empty.
		 *
		 * @param string $name     Menu name.
		 * @param string $location Theme location.
		 * @param array  $items    List of array( 'label', 'url', optional 'children' => array( array('label','url') ) ).
		 */
		$make_menu = function ( $name, $location, $items ) use ( &$locations ) {
			$menu = wp_get_nav_menu_object( $name );
			if ( $menu ) {
				$menu_id = (int) $menu->term_id;
			} else {
				$menu_id = wp_create_nav_menu( $name );
				if ( is_wp_error( $menu_id ) ) {
					return;
				}
				foreach ( $items as $item ) {
					$parent_id = wp_update_nav_menu_item(
						$menu_id,
						0,
						array(
							'menu-item-title'   => $item['label'],
							'menu-item-url'     => $item['url'],
							'menu-item-status'  => 'publish',
							'menu-item-type'    => 'custom',
						)
					);
					if ( ! empty( $item['children'] ) && ! is_wp_error( $parent_id ) ) {
						foreach ( $item['children'] as $child ) {
							wp_update_nav_menu_item(
								$menu_id,
								0,
								array(
									'menu-item-title'     => $child['label'],
									'menu-item-url'       => $child['url'],
									'menu-item-status'    => 'publish',
									'menu-item-type'      => 'custom',
									'menu-item-parent-id' => $parent_id,
								)
							);
						}
					}
				}
			}

			if ( empty( $locations[ $location ] ) ) {
				$locations[ $location ] = $menu_id;
			}
		};

		$make_menu(
			'Головне меню',
			'menu-1',
			array(
				array( 'label' => 'Про нас', 'url' => home_url( '/pro-nas/' ) ),
				array( 'label' => 'Послуги', 'url' => home_url( '/poslugi/' ) ),
				array( 'label' => 'Прайс', 'url' => home_url( '/prays/' ) ),
				array( 'label' => 'Лікарі', 'url' => home_url( '/likari/' ) ),
				array( 'label' => 'Відгуки', 'url' => home_url( '/vidguki/' ) ),
				array(
					'label'    => 'Технології',
					'url'      => home_url( '/aparati-zemits/' ),
					'children' => array(
						array( 'label' => 'Апарати Zemits', 'url' => home_url( '/aparati-zemits/' ) ),
						array( 'label' => 'Що ми вирішуємо', 'url' => home_url( '/scho-mi-virishuyemo/' ) ),
					),
				),
				array( 'label' => 'Контакти', 'url' => home_url( '/kontakti/' ) ),
			)
		);

		$make_menu(
			'Підвал — Послуги',
			'footer-1',
			array(
				array( 'label' => 'Видалення новоутворень', 'url' => home_url( '/poslugi/' ) ),
				array( 'label' => 'Ін’єкційна косметологія', 'url' => home_url( '/poslugi/' ) ),
				array( 'label' => 'Пластична хірургія', 'url' => home_url( '/poslugi/' ) ),
				array( 'label' => 'Апаратна косметологія', 'url' => home_url( '/poslugi/' ) ),
				array( 'label' => 'Доглядові процедури', 'url' => home_url( '/poslugi/' ) ),
			)
		);

		$make_menu(
			'Підвал — Що ми вирішуємо',
			'footer-2',
			array(
				array( 'label' => 'Новоутворення на шкірі', 'url' => '#' ),
				array( 'label' => 'Розацеа', 'url' => '#' ),
				array( 'label' => 'Акне (вугрова хвороба)', 'url' => '#' ),
				array( 'label' => 'Пігментація шкіри', 'url' => '#' ),
				array( 'label' => 'Рубці', 'url' => '#' ),
				array( 'label' => 'Випадіння волосся', 'url' => '#' ),
				array( 'label' => 'Себорейний дерматит', 'url' => '#' ),
				array( 'label' => 'Вікові зміни шкіри', 'url' => '#' ),
			)
		);

		$make_menu(
			'Підвал — Про інститут',
			'footer-3',
			array(
				array( 'label' => 'Про нас', 'url' => home_url( '/pro-nas/' ) ),
				array( 'label' => 'Лікарі', 'url' => home_url( '/likari/' ) ),
				array( 'label' => 'Ціни', 'url' => home_url( '/prays/' ) ),
				array( 'label' => 'Корисна інформація', 'url' => '#' ),
				array( 'label' => 'Контакти', 'url' => home_url( '/kontakti/' ) ),
			)
		);

		set_theme_mod( 'nav_menu_locations', $locations );

		// --- Settings (only fill empty fields) ---------------------------
		$settings_id = function_exists( 'bi_settings_page_id' ) ? bi_settings_page_id() : 0;

		if ( ! $settings_id ) {
			$settings_id = wp_insert_post(
				array(
					'post_type'   => 'page',
					'post_status' => 'private',
					'post_title'  => 'Налаштування сайту',
					'post_name'   => 'nalashtuvannya-sajtu',
				)
			);
			if ( $settings_id && ! is_wp_error( $settings_id ) ) {
				update_post_meta( $settings_id, '_wp_page_template', 'page-settings.php' );
			} else {
				$settings_id = 0;
			}
		}

		if ( $settings_id ) {
			$link = function ( $title, $url ) {
				return array( 'title' => $title, 'url' => $url, 'target' => '' );
			};

			$defaults = array(
				'header_cta'          => $link( 'Консультація', home_url( '/#consult' ) ),
				'phone_1'             => '+38 098 510 15 51',
				'phone_2'             => '+38 095 510 15 51',
				'email'               => '22872120@ukr.net',
				'address_locality'    => 'м. Київ',
				'address_region'      => 'Україна, м. Київ, 01024',
				'address_street'      => 'вул. Чикаленка Євгена, буд. 20, приміщення №49',
				'edrpou'              => '22872120',
				'work_hours'          => 'Щодня з 9:00 до 21:00',
				'map_embed'           => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2540.7894765006495!2d30.51458497713916!3d50.445021871591116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4ce57ca29633d%3A0xbb7585b5becfb7e1!2z0IbQvdGB0YLQuNGC0YPRgiDQmtGA0LDRgdC4!5e0!3m2!1sru!2sua!4v1786569008133!5m2!1sru!2sua',
				'social_instagram'    => '#',
				'social_threads'      => '#',
				'social_facebook'     => '#',
				'social_youtube'      => '#',
				'social_meta'         => '#',
				'social_whatsapp'     => '#',
				'social_messenger'    => '#',
				'social_telegram'     => '#',
				'footer_slogan'       => 'Традиції медицини та сучасні технології краси',
				'footer_col_1_title'  => 'Послуги',
				'footer_col_2_title'  => 'Що ми вирішуємо?',
				'footer_col_3_title'  => 'Про ІНСТИТУТ КРАСИ',
				'footer_terms_link'   => $link( 'Умови використання', '#' ),
				'footer_privacy_link' => $link( 'Політика конфіденційності', '#' ),
				'footer_copy_name'    => 'ІНСТИТУТ КРАСИ',
				'consult_form_shortcode' => '',
			);

			foreach ( $defaults as $key => $value ) {
				if ( '' === $value ) {
					continue;
				}
				$current = get_field( $key, $settings_id );
				if ( empty( $current ) ) {
					update_field( $key, $value, $settings_id );
				}
			}
		}

		update_option( 'bi_menus_seeded', 1 );
	},
	20
);
