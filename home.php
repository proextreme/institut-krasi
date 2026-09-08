<?php
/* Template Name: Home */
get_header();

$hero_btn = bi_field( 'hero_btn' );
$why_btn  = bi_field( 'why_btn' );
$svc_btn  = bi_field( 'services_btn' );
$req_btn  = bi_field( 'requests_btn' );
?>
<main class="home">
<section class="hero" id="hero" aria-label="Нам довіряють">
			<div class="container hero_inner">
				<div class="hero_left">
					<div class="hero_content">
						<h1 class="hero_title font_heading"><?php bi_text( 'hero_title', 'Нам довіряють красу та здоров’я з 1949 року' ); ?></h1>

						<div class="hero_text">
							<p class="hero_lead">
								<span class="hero_lead_brand"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span><?php bi_text( 'hero_lead', '— один із найвідоміших центрів дерматології та естетичної медицини в Україні.' ); ?>
							</p>
							<div class="hero_desc">
								<?php
								bi_wysiwyg(
									'hero_desc',
									'<p>Ми поєднуємо багаторічний медичний досвід, сучасні методи лікування та індивідуальний підхід до кожного пацієнта.</p><p>Наші лікарі допомагають вирішувати дерматологічні проблеми, зберігати здоров’я шкіри та підтримувати природну красу.</p>'
								);
								?>
							</div>
						</div>
					</div>

					<a class="btn btn_main hero_btn" href="<?php echo esc_url( is_array( $hero_btn ) ? $hero_btn['url'] : '#consult' ); ?>"><?php echo esc_html( is_array( $hero_btn ) && ! empty( $hero_btn['title'] ) ? $hero_btn['title'] : 'Записатися на консультацію' ); ?></a>

					<div class="hero_bottom">
						<div class="hero_line" aria-hidden="true" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/hero_line.svg' ) ); ?>');"></div>
						<ul class="hero_stats">
							<li class="hero_stat hero_stat_years">
								<span class="hero_stat_value"><?php bi_text( 'hero_stat_1_value', '75 +' ); ?></span>
								<span class="hero_stat_label"><?php bi_text( 'hero_stat_1_label', 'років досвіду' ); ?></span>
							</li>
						<li class="hero_stat hero_stat_license">
							<span class="hero_stat_license_text"><?php echo wp_kses_post( bi_field( 'hero_stat_license', 'Ліцензія&nbsp;МОЗ<br>України' ) ); ?></span>
						</li>
							<li class="hero_stat hero_stat_clients">
								<span class="hero_stat_value"><?php bi_text( 'hero_stat_2_value', '1000+' ); ?></span>
								<span class="hero_stat_label"><?php bi_text( 'hero_stat_2_label', 'клієнтів щороку' ); ?></span>
							</li>
						</ul>
					</div>
				</div>

				<div class="hero_media" aria-hidden="true">
					<span
						class="hero_media_bg"
						style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/hero_glow.webp' ) ); ?>');"
					></span>
				</div>
			</div>
		</section>

		<section class="why" id="about" aria-label="Чому обирають">
			<div class="why_head">
				<div class="container why_head_inner">
					<h2 class="why_title font_heading"><?php echo wp_kses_post( bi_field( 'why_title', 'Чому обирають<br>Інститут краси' ) ); ?></h2>
					<p class="why_intro"><?php bi_text( 'why_intro', 'Поєднання багаторічного медичного досвіду, сучасних технологій та уважного ставлення до кожного пацієнта.' ); ?></p>
				</div>
			</div>

			<div
				class="why_body"
				style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/why_body_bg.webp' ) ); ?>');"
			>
				<div class="why_media" aria-hidden="true">
					<picture class="why_media_picture">
						<?php
						bi_image(
							'why_image',
							'images/why_clinic_mob.webp',
							'large',
							array(
								'class'    => 'why_media_img',
								'alt'      => '',
								'width'    => '780',
								'height'   => '560',
								'decoding' => 'async',
								'loading'  => 'lazy',
							)
						);
						?>
					</picture>
				</div>

				<div
					class="why_panel"
					style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/why_panel_bg.webp' ) ); ?>');"
				>
					<div class="why_panel_inner">
						<h3 class="why_subtitle"><?php bi_text( 'why_subtitle', 'Досвід з 1949 року' ); ?></h3>
						<p class="why_lead"><?php bi_text( 'why_lead', 'ІНСТИТУТ КРАСИ — це понад 77 років досвіду, довіра пацієнтів з усієї України та поєднання перевірених підходів із сучасними технологіями.' ); ?></p>
						<ul class="why_list">
							<?php
							$why_list = bi_field( 'why_list' );
							if ( $why_list ) {
								foreach ( preg_split( '/\r\n|\r|\n/', $why_list ) as $why_item ) {
									$why_item = trim( $why_item );
									if ( '' !== $why_item ) {
										printf( '<li class="why_list_item">%s</li>', esc_html( $why_item ) );
									}
								}
							} else {
								?>
								<li class="why_list_item">Лікарі вищої категорії з досвідом понад 20 років</li>
								<li class="why_list_item">Безпечне середовище та стерильність приміщень</li>
								<li class="why_list_item">Комфорт і сервіс, що допомагають почуватися спокійно</li>
								<li class="why_list_item">Сучасні технології для ефективних та безпечних процедур</li>
								<?php
							}
							?>
						</ul>
						<p class="why_note"><?php bi_text( 'why_note', 'Запрошуємо вас на онлайн-екскурсію, щоб познайомитися з нашим інститутом ближче та побачити його зсередини.' ); ?></p>
						<a class="btn btn_brown why_btn" href="<?php echo esc_url( is_array( $why_btn ) ? $why_btn['url'] : '#about' ); ?>">
							<span class="btn_text"><?php echo esc_html( is_array( $why_btn ) && ! empty( $why_btn['title'] ) ? $why_btn['title'] : 'Про нас' ); ?></span>
							<span class="btn_icon btn_icon_arrow" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>');" aria-hidden="true"></span>
						</a>
					</div>
				</div>
			</div>
		</section>

		<section class="requests" id="requests" aria-label="Запити з якими до нас звертаються">
			<div class="container requests_inner">
				<div class="requests_head">
					<h2 class="requests_title font_heading"><?php echo wp_kses_post( bi_field( 'requests_title', 'Запити з якими<br>до нас звертаються' ) ); ?></h2>
					<div class="requests_head_aside">
						<p class="requests_intro"><?php bi_text( 'requests_intro', 'Наші спеціалісти допомагають діагностувати та лікувати широкий спектр дерматологічних і естетичних проблем.' ); ?></p>
						<a class="btn btn_blue requests_all" href="<?php echo esc_url( is_array( $req_btn ) ? $req_btn['url'] : '#requests' ); ?>">
							<span class="btn_text"><?php echo esc_html( is_array( $req_btn ) && ! empty( $req_btn['title'] ) ? $req_btn['title'] : 'Всі послуги' ); ?></span>
							<span class="btn_icon btn_icon_arrow" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>');" aria-hidden="true"></span>
						</a>
					</div>
				</div>

				<?php
				$requests = beauty_institute_home_query( 'requests_items', 'bi_problem', 8 );
				if ( $requests ) :
					$req_shapes = array(
						array( 'requests_card_short', 'requests_card_cut_br' ),
						array( 'requests_card_tall', 'requests_card_cut_tr' ),
						array( 'requests_card_tall', 'requests_card_cut_bl' ),
						array( 'requests_card_short', 'requests_card_cut_tl' ),
					);
					?>
					<div class="requests_slider" data-requests-slider>
						<div class="requests_viewport">
							<div class="requests_track">
								<?php
								foreach ( array_chunk( $requests, 2 ) as $pair ) :
									?>
									<div class="requests_slide">
										<?php
										foreach ( $pair as $i => $problem_id ) :
											$shape = $req_shapes[ ( $i ) % 2 ];
											$img   = get_post_thumbnail_id( $problem_id );
											$src   = $img ? wp_get_attachment_image_url( $img, 'medium_large' ) : beauty_institute_asset( 'images/request_1.webp' );
											?>
											<a class="requests_card <?php echo esc_attr( $shape[0] . ' ' . $shape[1] ); ?>" href="<?php echo esc_url( get_permalink( $problem_id ) ); ?>" style="--card-photo: url('<?php echo esc_url( $src ); ?>');">
												<img class="requests_card_img" src="<?php echo esc_url( $src ); ?>" alt="" width="300" height="300" loading="lazy" decoding="async">
												<span class="requests_card_panel">
													<span class="requests_card_name"><?php echo esc_html( get_the_title( $problem_id ) ); ?></span>
													<span class="requests_card_arrow" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>');" aria-hidden="true"></span>
												</span>
											</a>
										<?php endforeach; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</div>

						<div class="requests_controls">
							<div class="requests_dots" data-requests-dots role="tablist" aria-label="Слайди запитів"></div>
							<button class="requests_next" type="button" data-requests-next aria-label="Наступний слайд">
								<span class="requests_next_icon" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right_nav.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right_nav.svg' ) ); ?>');" aria-hidden="true"></span>
							</button>
						</div>
					</div>
				<?php else : ?>
				<div class="requests_slider" data-requests-slider>
					<div class="requests_viewport">
						<div class="requests_track">
							<div class="requests_slide">
								<a class="requests_card requests_card_short requests_card_cut_br" href="#" style="--card-photo: url('../images/request_1.webp');">
									<img class="requests_card_img" src="/wp-content/themes/beauty-institute/assets/images/request_1.webp" alt="" width="300" height="258" loading="lazy" decoding="async">
									<span class="requests_card_panel">
										<span class="requests_card_name">Новоутворення на шкірі</span>
										<span class="requests_card_arrow" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');" aria-hidden="true"></span>
									</span>
								</a>
								<a class="requests_card requests_card_tall requests_card_cut_tr" href="#" style="--card-photo: url('../images/request_5.webp');">
									<img class="requests_card_img" src="/wp-content/themes/beauty-institute/assets/images/request_5.webp" alt="" width="300" height="366" loading="lazy" decoding="async">
									<span class="requests_card_panel">
										<span class="requests_card_name">Вікові зміни шкіри</span>
										<span class="requests_card_arrow" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');" aria-hidden="true"></span>
									</span>
								</a>
							</div>

							<div class="requests_slide">
								<a class="requests_card requests_card_tall requests_card_cut_bl" href="#" style="--card-photo: url('../images/request_2.webp');">
									<img class="requests_card_img" src="/wp-content/themes/beauty-institute/assets/images/request_2.webp" alt="" width="300" height="366" loading="lazy" decoding="async">
									<span class="requests_card_panel">
										<span class="requests_card_name">Себорейний дерматит</span>
										<span class="requests_card_arrow" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');" aria-hidden="true"></span>
									</span>
								</a>
								<a class="requests_card requests_card_short requests_card_cut_tl" href="#" style="--card-photo: url('../images/request_6.webp');">
									<img class="requests_card_img" src="/wp-content/themes/beauty-institute/assets/images/request_6.webp" alt="" width="300" height="258" loading="lazy" decoding="async">
									<span class="requests_card_panel">
										<span class="requests_card_name">Випадіння волосся</span>
										<span class="requests_card_arrow" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');" aria-hidden="true"></span>
									</span>
								</a>
							</div>

							<div class="requests_slide">
								<a class="requests_card requests_card_short requests_card_cut_br" href="#" style="--card-photo: url('../images/request_3.webp');">
									<img class="requests_card_img" src="/wp-content/themes/beauty-institute/assets/images/request_3.webp" alt="" width="300" height="258" loading="lazy" decoding="async">
									<span class="requests_card_panel">
										<span class="requests_card_name">Рубці</span>
										<span class="requests_card_arrow" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');" aria-hidden="true"></span>
									</span>
								</a>
								<a class="requests_card requests_card_tall requests_card_cut_tr" href="#" style="--card-photo: url('../images/request_7.webp');">
									<img class="requests_card_img" src="/wp-content/themes/beauty-institute/assets/images/request_7.webp" alt="" width="300" height="366" loading="lazy" decoding="async">
									<span class="requests_card_panel">
										<span class="requests_card_name">Розацеа</span>
										<span class="requests_card_arrow" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');" aria-hidden="true"></span>
									</span>
								</a>
							</div>

							<div class="requests_slide">
								<a class="requests_card requests_card_tall requests_card_cut_bl" href="#" style="--card-photo: url('../images/request_4.webp');">
									<img class="requests_card_img" src="/wp-content/themes/beauty-institute/assets/images/request_4.webp" alt="" width="300" height="366" loading="lazy" decoding="async">
									<span class="requests_card_panel">
										<span class="requests_card_name">Пігментація шкіри</span>
										<span class="requests_card_arrow" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');" aria-hidden="true"></span>
									</span>
								</a>
								<a class="requests_card requests_card_short requests_card_cut_tl" href="#" style="--card-photo: url('../images/request_8.webp');">
									<img class="requests_card_img" src="/wp-content/themes/beauty-institute/assets/images/request_8.webp" alt="" width="300" height="258" loading="lazy" decoding="async">
									<span class="requests_card_panel">
										<span class="requests_card_name">Акне (вугрова хвороба)</span>
										<span class="requests_card_arrow" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');" aria-hidden="true"></span>
									</span>
								</a>
							</div>
						</div>
					</div>

					<div class="requests_controls">
						<div class="requests_dots" data-requests-dots role="tablist" aria-label="Слайди запитів"></div>
						<button class="requests_next" type="button" data-requests-next aria-label="Наступний слайд">
							<span class="requests_next_icon" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right_nav.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right_nav.svg');" aria-hidden="true"></span>
						</button>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</section>

		<div class="edge_art edge_art_right" aria-hidden="true">
			<span
				class="edge_art_bg"
				style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/right_edge_img.webp' ) ); ?>');"
			></span>
		</div>

		<section class="services" id="services" aria-label="Медичні та естетичні послуги">
			<div class="container services_head">
				<h2 class="services_title font_heading"><?php echo wp_kses_post( bi_field( 'services_title', '<span class="services_title_line">Медичні та естетичні</span><br>послуги' ) ); ?></h2>
				<div class="services_head_aside">
					<p class="services_intro"><?php bi_text( 'services_intro', 'Ми пропонуємо комплексні рішення для здоров’я та краси шкіри.' ); ?></p>
					<a class="btn btn_blue services_all" href="<?php echo esc_url( is_array( $svc_btn ) ? $svc_btn['url'] : '#services' ); ?>">
						<span class="btn_text"><?php echo esc_html( is_array( $svc_btn ) && ! empty( $svc_btn['title'] ) ? $svc_btn['title'] : 'Всі послуги' ); ?></span>
						<span class="btn_icon btn_icon_arrow" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>');" aria-hidden="true"></span>
					</a>
				</div>
			</div>

			<div
				class="services_body"
				style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/med_ta_estet_bg.webp' ) ); ?>');"
			>
				<div class="services_cols">
					<div
						class="services_media"
						aria-hidden="true"
						style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/med_ta_estet_mob_bg.webp' ) ); ?>');"
					></div>
					<div
						class="services_panel"
						style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/med_ta_estet_right_body_mob_bg.webp' ) ); ?>');"
					>
						<div class="services_panel_inner">
							<?php
							$service_terms = beauty_institute_home_service_terms();
							if ( $service_terms ) :
								foreach ( $service_terms as $term ) :
									$svc_desc = function_exists( 'get_field' ) ? (string) get_field( 'short_description', 'term_' . $term->term_id ) : '';
									?>
									<a class="services_item" href="<?php echo esc_url( get_term_link( $term ) ); ?>">
										<span class="services_item_text">
											<span class="services_item_title"><?php echo esc_html( $term->name ); ?></span>
											<?php if ( '' !== $svc_desc ) : ?>
												<span class="services_item_desc"><?php echo esc_html( $svc_desc ); ?></span>
											<?php elseif ( $term->description ) : ?>
												<span class="services_item_desc"><?php echo esc_html( $term->description ); ?></span>
											<?php endif; ?>
										</span>
										<span class="services_item_arrow" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>');" aria-hidden="true"></span>
									</a>
									<?php
								endforeach;
							else :
								?>
							<a class="services_item" href="#">
								<span class="services_item_text">
									<span class="services_item_title">Видалення новоутворень</span>
									<span class="services_item_desc">Діагностика та безпечне видалення шкірних утворень.</span>
								</span>
								<span class="services_item_arrow" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');" aria-hidden="true"></span>
							</a>
							<a class="services_item" href="#">
								<span class="services_item_text">
									<span class="services_item_title">Ін’єкційна косметологія</span>
									<span class="services_item_desc">Методи омолодження та корекції вікових змін.</span>
								</span>
								<span class="services_item_arrow" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');" aria-hidden="true"></span>
							</a>
							<a class="services_item" href="#">
								<span class="services_item_text">
									<span class="services_item_title">Естетична хірургія</span>
									<span class="services_item_desc">Хірургічна корекція зовнішності з урахуванням особливостей.</span>
								</span>
								<span class="services_item_arrow" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');" aria-hidden="true"></span>
							</a>
							<a class="services_item" href="#">
								<span class="services_item_text">
									<span class="services_item_title">Апаратна косметологія</span>
									<span class="services_item_desc">Сучасні технології для покращення стану шкіри.</span>
								</span>
								<span class="services_item_arrow" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');" aria-hidden="true"></span>
							</a>
							<a class="services_item" href="#">
								<span class="services_item_text">
									<span class="services_item_title">Доглядові процедури</span>
									<span class="services_item_desc">Комплексні процедури для підтримки здоров’я та краси шкіри.</span>
								</span>
								<span class="services_item_arrow" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');" aria-hidden="true"></span>
							</a>
							<a class="services_item" href="#">
								<span class="services_item_text">
									<span class="services_item_title">Стоматологія</span>
									<span class="services_item_desc">Сучасна стоматологія для здорової та впевненої посмішки.</span>
								</span>
								<span class="services_item_arrow" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');" aria-hidden="true"></span>
							</a>
								<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="doctors" id="doctors" aria-label="Консультації спеціалістів">
			<div class="container doctors_head">
				<h2 class="doctors_title font_heading"><?php echo wp_kses_post( bi_field( 'doctors_title', 'Консультації<br>спеціалістів' ) ); ?></h2>
				<div class="doctors_head_aside">
					<p class="doctors_intro"><?php bi_text( 'doctors_intro', 'Правильна діагностика — основа ефективного лікування.' ); ?></p>
				</div>
			</div>

			<div class="container doctors_slider" data-doctors-slider>
				<div class="doctors_viewport">
					<div class="doctors_track">
						<?php
						$doctors = beauty_institute_home_query( 'doctors_items', 'bi_doctor', 8 );
						if ( $doctors ) :
							foreach ( $doctors as $index => $doctor_id ) :
								$d_img  = get_post_thumbnail_id( $doctor_id );
								$d_src  = $d_img ? wp_get_attachment_image_url( $d_img, 'medium_large' ) : beauty_institute_asset( 'images/doctor_1.webp' );
								$d_role = function_exists( 'get_field' ) ? (string) get_field( 'role', $doctor_id ) : '';
								$d_desc = function_exists( 'get_field' ) ? (string) get_field( 'card_description', $doctor_id ) : '';
								?>
								<div class="doctors_slide<?php echo ( $index % 2 ) ? ' doctors_slide_rev' : ''; ?>">
									<div class="doctors_photo">
										<img class="doctors_photo_img" src="<?php echo esc_url( $d_src ); ?>" alt="<?php echo esc_attr( get_the_title( $doctor_id ) ); ?>" width="300" height="366" loading="lazy" decoding="async">
									</div>
									<a class="doctors_card" href="<?php echo esc_url( get_permalink( $doctor_id ) ); ?>">
										<span class="doctors_card_text">
											<span class="doctors_card_title"><?php echo esc_html( '' !== $d_role ? $d_role : get_the_title( $doctor_id ) ); ?></span>
											<?php if ( '' !== $d_desc ) : ?>
												<span class="doctors_card_desc"><?php echo esc_html( $d_desc ); ?></span>
											<?php endif; ?>
										</span>
										<span class="doctors_card_btn" aria-hidden="true">
											<span class="doctors_card_btn_icon" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>');"></span>
										</span>
									</a>
								</div>
							<?php endforeach; ?>
						<?php else : ?>
						<div class="doctors_slide">
							<div class="doctors_photo">
								<img class="doctors_photo_img" src="/wp-content/themes/beauty-institute/assets/images/doctor_1.webp" alt="" width="300" height="366" loading="lazy" decoding="async">
							</div>
							<a class="doctors_card" href="#">
								<span class="doctors_card_text">
									<span class="doctors_card_title">Дерматолог</span>
									<span class="doctors_card_desc">Діагностика та лікування захворювань шкіри.</span>
								</span>
								<span class="doctors_card_btn" aria-hidden="true">
									<span class="doctors_card_btn_icon" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');"></span>
								</span>
							</a>
						</div>

						<div class="doctors_slide doctors_slide_rev">
							<div class="doctors_photo">
								<img class="doctors_photo_img" src="/wp-content/themes/beauty-institute/assets/images/doctor_2.webp" alt="" width="300" height="366" loading="lazy" decoding="async">
							</div>
							<a class="doctors_card" href="#">
								<span class="doctors_card_text">
									<span class="doctors_card_title">Хірург-онколог</span>
									<span class="doctors_card_desc">Оцінка новоутворень та медичні рекомендації.</span>
								</span>
								<span class="doctors_card_btn" aria-hidden="true">
									<span class="doctors_card_btn_icon" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');"></span>
								</span>
							</a>
						</div>

						<div class="doctors_slide">
							<div class="doctors_photo">
								<img class="doctors_photo_img" src="/wp-content/themes/beauty-institute/assets/images/doctor_3.webp" alt="" width="300" height="366" loading="lazy" decoding="async">
							</div>
							<a class="doctors_card" href="#">
								<span class="doctors_card_text">
									<span class="doctors_card_title">Естетичний хірург</span>
									<span class="doctors_card_desc">Професійна оцінка можливостей естетичної корекції.</span>
								</span>
								<span class="doctors_card_btn" aria-hidden="true">
									<span class="doctors_card_btn_icon" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');"></span>
								</span>
							</a>
						</div>

						<div class="doctors_slide doctors_slide_rev">
							<div class="doctors_photo">
								<img class="doctors_photo_img" src="/wp-content/themes/beauty-institute/assets/images/doctor_4.webp" alt="" width="300" height="366" loading="lazy" decoding="async">
							</div>
							<a class="doctors_card" href="#">
								<span class="doctors_card_text">
									<span class="doctors_card_title">Косметологи</span>
									<span class="doctors_card_desc">Підбір ефективних процедур для догляду за шкірою.</span>
								</span>
								<span class="doctors_card_btn" aria-hidden="true">
									<span class="doctors_card_btn_icon" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');"></span>
								</span>
							</a>
						</div>

						<div class="doctors_slide">
							<div class="doctors_photo">
								<img class="doctors_photo_img" src="/wp-content/themes/beauty-institute/assets/images/doctor_4.webp" alt="" width="300" height="366" loading="lazy" decoding="async">
							</div>
							<a class="doctors_card" href="#">
								<span class="doctors_card_text">
									<span class="doctors_card_title">Косметологи</span>
									<span class="doctors_card_desc">Підбір ефективних процедур для догляду за шкірою.</span>
								</span>
								<span class="doctors_card_btn" aria-hidden="true">
									<span class="doctors_card_btn_icon" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');"></span>
								</span>
							</a>
						</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="doctors_controls">
					<div class="doctors_dots" data-doctors-dots role="tablist" aria-label="Слайди спеціалістів"></div>
					<button class="doctors_next" type="button" data-doctors-next aria-label="Наступний слайд">
						<span class="doctors_next_icon" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right_nav.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right_nav.svg' ) ); ?>');" aria-hidden="true"></span>
					</button>
				</div>
			</div>
		</section>

		<div class="edge_art edge_art_left" aria-hidden="true">
			<span
				class="edge_art_bg"
				style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/left_edge_img.webp' ) ); ?>');"
			></span>
		</div>

		<section class="results" id="results" aria-label="До та після">
			<div class="container results_head">
				<h2 class="results_title font_heading"><?php bi_text( 'results_title', 'До та після' ); ?></h2>
				<div class="results_head_aside">
					<p class="results_intro"><?php bi_text( 'results_intro', 'Наші результати підкреслюють ваші індивідуальні риси.' ); ?></p>
				</div>
			</div>

			<div class="container results_slider" data-results-slider>
				<div class="results_viewport">
					<div class="results_track">
						<?php
						$results = beauty_institute_home_query( 'results_items', 'bi_result', 12 );
						if ( $results ) :
							foreach ( $results as $result_id ) :
								$r_img = get_post_thumbnail_id( $result_id );
								$r_src = $r_img ? wp_get_attachment_image_url( $r_img, 'medium_large' ) : beauty_institute_asset( 'images/before_after_1.webp' );
								?>
								<div class="results_slide">
									<div class="results_photo">
										<img class="results_photo_img" src="<?php echo esc_url( $r_src ); ?>" alt="<?php echo esc_attr( get_the_title( $result_id ) ); ?>" width="300" height="355" loading="lazy" decoding="async">
									</div>
								</div>
							<?php endforeach; ?>
						<?php else : ?>
						<div class="results_slide">
							<div class="results_photo">
								<img class="results_photo_img" src="/wp-content/themes/beauty-institute/assets/images/before_after_1.webp" alt="" width="300" height="355" loading="lazy" decoding="async">
							</div>
						</div>

						<div class="results_slide">
							<div class="results_photo">
								<img class="results_photo_img" src="/wp-content/themes/beauty-institute/assets/images/before_after_2.webp" alt="" width="300" height="355" loading="lazy" decoding="async">
							</div>
						</div>

						<div class="results_slide">
							<div class="results_photo">
								<img class="results_photo_img" src="/wp-content/themes/beauty-institute/assets/images/before_after_3.webp" alt="" width="300" height="355" loading="lazy" decoding="async">
							</div>
						</div>

						<div class="results_slide">
							<div class="results_photo">
								<img class="results_photo_img" src="/wp-content/themes/beauty-institute/assets/images/before_after_4.webp" alt="" width="300" height="355" loading="lazy" decoding="async">
							</div>
						</div>

						<div class="results_slide">
							<div class="results_photo">
								<img class="results_photo_img" src="/wp-content/themes/beauty-institute/assets/images/before_after_5.webp" alt="" width="300" height="355" loading="lazy" decoding="async">
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="results_controls">
					<div class="results_dots" data-results-dots role="tablist" aria-label="Слайди до та після"></div>
					<button class="results_next" type="button" data-results-next aria-label="Наступний слайд">
						<span class="results_next_icon" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right_nav.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right_nav.svg' ) ); ?>');" aria-hidden="true"></span>
					</button>
				</div>
			</div>
		</section>

		<?php
		beauty_institute_find_section();
		beauty_institute_consult_section();
		?>
</main>
<?php
get_footer();
