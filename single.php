<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package beauty-institute
 */

get_header();
?>
<main class="single">
	<section class="iniektsiina_kosmetolohiya">
		<span
			class="iniektsiina_kosmetolohiya_bg iniektsiina_kosmetolohiya_bg_mob"
			style="background-image: url('/wp-content/themes/beauty-institute/assets/images/single/vydalennya_novoutvoren_mob.webp');"
			aria-hidden="true"
		></span>
		<span
			class="iniektsiina_kosmetolohiya_bg iniektsiina_kosmetolohiya_bg_desk"
			style="background-image: url('/wp-content/themes/beauty-institute/assets/images/single/vydalennya_novoutvoren.webp');"
			aria-hidden="true"
		></span>

		<nav class="breadcrumbs" aria-label="Хлібні крихти">
			<div class="container breadcrumbs_inner">
				<?php if ( function_exists( 'yoast_breadcrumb' ) ) {
					yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
				} ?>
			</div>
		</nav>

		<div class="container iniektsiina_kosmetolohiya_inner">
			<div class="iniektsiina_kosmetolohiya_top">
				<div class="iniektsiina_kosmetolohiya_text">
					<h1 class="iniektsiina_kosmetolohiya_title font_heading">Видалення новоутворень</h1>
					<p class="iniektsiina_kosmetolohiya_desc">Безпечно. Швидко. Без рубців. 
                    З попередньою дерматоскопічною діагностикою.</p>
				</div>

				<div class="iniektsiina_kosmetolohiya_actions">
					<a class="btn btn_main iniektsiina_kosmetolohiya_btn" href="/#consult">
						<span class="btn_text">Записатися</span>
					</a>
					<a class="btn iniektsiina_kosmetolohiya_btn_price" href="#">
						<span class="btn_text">Прайс</span>
						<span class="btn_icon btn_icon_arrow" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right.svg');" aria-hidden="true"></span>
					</a>
				</div>
			</div>

			<ul class="iniektsiina_kosmetolohiya_feats">
				<li class="iniektsiina_kosmetolohiya_feat">
					<span class="iniektsiina_kosmetolohiya_feat_icon iniektsiina_kosmetolohiya_feat_icon_clock" aria-hidden="true"></span>
					<span class="iniektsiina_kosmetolohiya_feat_text">15–40 хвилин</span>
				</li>
				<li class="iniektsiina_kosmetolohiya_feat">
					<img class="iniektsiina_kosmetolohiya_feat_icon" src="/wp-content/themes/beauty-institute/assets/images/child_cat/iniektsiina_kosmetolohiya_6.svg" alt="" width="24" height="24" decoding="async" aria-hidden="true">
					<span class="iniektsiina_kosmetolohiya_feat_text">Місцева анестезія</span>
				</li>
				<li class="iniektsiina_kosmetolohiya_feat">
					<img class="iniektsiina_kosmetolohiya_feat_icon" src="/wp-content/themes/beauty-institute/assets/images/single/calendar.svg" alt="" width="24" height="24" decoding="async" aria-hidden="true">
					<span class="iniektsiina_kosmetolohiya_feat_text">Відновлення 3–14 днів</span>
				</li>
			</ul>
		</div>
	</section>

	<section class="pro_posluhu">
		<div class="container pro_posluhu_inner">
			<div class="pro_posluhu_lead">
				<p class="pro_posluhu_lead_title">Родимка, що змінила форму? Папілома, яка натирає? Бородавка, що турбує?</p>
				<p class="pro_posluhu_lead_text">В ІНСТИТУТІ КРАСИ ми виконуємо видалення доброякісних новоутворень шкіри з попередньою дерматоскопічною діагностикою — щоб ви були впевнені в безпеці та результаті.</p>
			</div>

			<div class="pro_posluhu_row">
				<div class="pro_posluhu_content">
					<h2 class="pro_posluhu_title font_heading">Шкіра є найбільшим органом людського організму, тому будь-які зміни на її поверхні заслуговують на увагу</h2>
					<p class="pro_posluhu_text">Невуси (родимки), папіломи, бородавки та інші новоутворення шкіри часто сприймаються лише як косметичний дефект, однак у багатьох випадках вони можуть стати причиною фізичного дискомфорту або навіть сигналом про розвиток патологічних процесів.</p>
					<p class="pro_posluhu_text">Саме тому лікарі рекомендують регулярно контролювати стан новоутворень та своєчасно видаляти ті з них, які піддаються постійній травматизації, швидко ростуть, змінюють форму, колір або структуру.</p>
					<p class="pro_posluhu_text">Особливої уваги потребують утворення, що розташовані на шиї, обличчі, волосистій частині голови, в пахвових западинах, паховій ділянці та інших місцях, де вони можуть постійно контактувати з одягом, прикрасами чи бритвою.</p>
				</div>

				<div
					class="pro_posluhu_media"
					style="background-image: url('/wp-content/themes/beauty-institute/assets/images/single/01.webp');"
					role="img"
					aria-label="Дерматоскопічний огляд новоутворення"
				></div>
			</div>

			<p class="pro_posluhu_text">Важливо розуміти, що навіть доброякісні новоутворення можуть запалюватися, кровоточити, інфікуватися та викликати хронічний дискомфорт. Крім того, деякі злоякісні захворювання шкіри на ранніх стадіях можуть зовні нагадувати звичайну родимку або папілому. Саме тому перед видаленням необхідний огляд лікаря та дерматоскопія — сучасний метод діагностики, який дозволяє оцінити структуру утворення без пошкодження шкіри.</p>

			<div class="koly_varto">
				<h2 class="koly_varto_title">Коли варто звернутися до лікаря?</h2>

				<div class="koly_varto_list">
					<article class="koly_varto_card">
						<p class="koly_varto_card_text">Новоутворення почало збільшуватися в розмірах</p>
					</article>
					<article class="koly_varto_card">
						<p class="koly_varto_card_text">Змінився колір або з'явилося кілька відтінків</p>
					</article>
					<article class="koly_varto_card">
						<p class="koly_varto_card_text">Краї стали нерівними чи нечіткими</p>
					</article>
					<article class="koly_varto_card">
						<p class="koly_varto_card_text">З'явилися свербіж, біль або печіння</p>
					</article>
					<article class="koly_varto_card">
						<p class="koly_varto_card_text">Новоутворення почало кровоточити чи покриватися кірочками</p>
					</article>
					<article class="koly_varto_card">
						<p class="koly_varto_card_text">Утворення постійно травмується одягом або під час гоління</p>
					</article>
					<article class="koly_varto_card">
						<p class="koly_varto_card_text">З'явилися нові пігментні утворення у дорослому віці</p>
					</article>
				</div>

				<p class="pro_posluhu_text">Сучасна медицина дозволяє видаляти новоутворення швидко, безпечно та з мінімальним періодом відновлення. А в окремих випадках після видалення матеріал може бути направлений на гістологічне дослідження, що дає можливість остаточно підтвердити його доброякісний характер.</p>
				<p class="pro_posluhu_text pro_posluhu_text_strong"><strong>Пам'ятайте:</strong> рання діагностика завжди краща за тривале спостереження та невизначеність. Якщо вас турбує будь-яке новоутворення шкіри — не відкладайте консультацію. Турбота про здоров'я починається з уважності до себе.</p>
			</div>

			<div class="yak_prokhodyt">
				<h2 class="yak_prokhodyt_title">Як проходить процедура</h2>

				<div class="yak_prokhodyt_list">
					<article class="yak_prokhodyt_item">
						<span class="yak_prokhodyt_num" aria-hidden="true">01</span>
						<div class="yak_prokhodyt_body">
							<h3 class="yak_prokhodyt_item_title">Консультація та дерматоскопія</h3>
							<p class="yak_prokhodyt_item_text">Лікар оглядає утворення та проводить дерматоскопію — детальний огляд структури під збільшенням. Це дозволяє виявити ознаки злоякісних змін на ранній стадії та обрати оптимальний метод видалення.</p>
						</div>
					</article>

					<article class="yak_prokhodyt_item">
						<span class="yak_prokhodyt_num" aria-hidden="true">02</span>
						<div class="yak_prokhodyt_body">
							<h3 class="yak_prokhodyt_item_title">Підготовка та анестезія</h3>
							<p class="yak_prokhodyt_item_text">Шкіра обробляється антисептиком, наноситься місцева анестезія. Процедура проходить без болю та дискомфорту.</p>
						</div>
					</article>

					<article class="yak_prokhodyt_item">
						<span class="yak_prokhodyt_num" aria-hidden="true">03</span>
						<div class="yak_prokhodyt_body">
							<h3 class="yak_prokhodyt_item_title">Видалення</h3>
							<p class="yak_prokhodyt_item_text">Залежно від типу утворення лікар обирає метод:</p>
							<ul class="yak_prokhodyt_tags">
								<li class="yak_prokhodyt_tag">Діатермокоагуляція</li>
								<li class="yak_prokhodyt_tag">Кріодеструкція</li>
								<li class="yak_prokhodyt_tag">Радіохвильовий метод</li>
							</ul>
						</div>
					</article>

					<article class="yak_prokhodyt_item">
						<span class="yak_prokhodyt_num" aria-hidden="true">04</span>
						<div class="yak_prokhodyt_body">
							<h3 class="yak_prokhodyt_item_title">Обробка та рекомендації</h3>
							<p class="yak_prokhodyt_item_text">Ділянка обробляється антисептиком. Лікар надає детальні рекомендації щодо домашнього догляду. Загоєння — від кількох днів до двох тижнів.</p>
						</div>
					</article>
				</div>
			</div>
		</div>
	</section>

	<div class="edge_art edge_art_right" aria-hidden="true">
		<span class="edge_art_bg" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/right_edge_img.webp');"></span>
	</div>

	<section class="likari">
		<div class="container likari_inner">
			<div class="likari_head">
				<h2 class="likari_title font_heading">Лікарі</h2>
				<p class="likari_subtitle">що проводять процедуру видалення новоутворень</p>
			</div>

			<div class="likari_list">
				<article class="likari_card">
					<a class="likari_photo" href="#">
						<picture>
							<source media="(min-width: 1024px)" srcset="/wp-content/themes/beauty-institute/assets/images/single/likari.webp">
							<img
								class="likari_photo_img"
								src="/wp-content/themes/beauty-institute/assets/images/single/likari_mob.webp"
								alt=""
								width="358"
								height="260"
								loading="lazy"
								decoding="async"
							>
						</picture>
					</a>
					<a class="likari_info" href="#">
						<span class="likari_role">Естетичний хірург</span>
						<span class="likari_name">Сливка Олена Михайлівна</span>
					</a>
				</article>

				<article class="likari_card">
					<a class="likari_photo" href="#">
						<picture>
							<source media="(min-width: 1024px)" srcset="/wp-content/themes/beauty-institute/assets/images/single/likari_1.webp">
							<img
								class="likari_photo_img"
								src="/wp-content/themes/beauty-institute/assets/images/single/likari_mob_1.webp"
								alt=""
								width="358"
								height="260"
								loading="lazy"
								decoding="async"
							>
						</picture>
					</a>
					<a class="likari_info" href="#">
						<span class="likari_role">Естетичний хірург</span>
						<span class="likari_name">Сливка Олена Михайлівна</span>
					</a>
				</article>

				<article class="likari_card">
					<a class="likari_photo" href="#">
						<picture>
							<source media="(min-width: 1024px)" srcset="/wp-content/themes/beauty-institute/assets/images/single/likari_2.webp">
							<img
								class="likari_photo_img"
								src="/wp-content/themes/beauty-institute/assets/images/single/likari_mob_2.webp"
								alt=""
								width="358"
								height="260"
								loading="lazy"
								decoding="async"
							>
						</picture>
					</a>
					<a class="likari_info" href="#">
						<span class="likari_role">Естетичний хірург</span>
						<span class="likari_name">Сливка Олена Михайлівна</span>
					</a>
				</article>

				<article class="likari_card">
					<a class="likari_photo" href="#">
						<picture>
							<source media="(min-width: 1024px)" srcset="/wp-content/themes/beauty-institute/assets/images/single/likari_3.webp">
							<img
								class="likari_photo_img"
								src="/wp-content/themes/beauty-institute/assets/images/single/likari_mob_3.webp"
								alt=""
								width="358"
								height="260"
								loading="lazy"
								decoding="async"
							>
						</picture>
					</a>
					<a class="likari_info" href="#">
						<span class="likari_role">Естетичний хірург</span>
						<span class="likari_name">Сливка Олена Михайлівна</span>
					</a>
				</article>
			</div>
		</div>
	</section>

	<section class="vidhuky" aria-label="Відгуки">
		<div class="container vidhuky_inner">
			<div class="vidhuky_slider" data-vidhuky-slider>
				<div class="vidhuky_viewport">
					<div class="vidhuky_track">
						<div class="vidhuky_slide">
							<div class="vidhuky_card">
								<div class="vidhuky_back" aria-hidden="true">
									<img
										class="vidhuky_decor vidhuky_decor_mob"
										src="/wp-content/themes/beauty-institute/assets/images/zapysatys_na_mob_1.webp"
										alt=""
										width="134"
										height="152"
										decoding="async"
									>
									<img
										class="vidhuky_decor vidhuky_decor_desk"
										src="/wp-content/themes/beauty-institute/assets/images/zapysatys_na_1.webp"
										alt=""
										width="184"
										height="210"
										decoding="async"
									>
								</div>
								<div class="vidhuky_content">
									<figure class="vidhuky_photo">
										<img
											class="vidhuky_photo_img"
											src="/wp-content/themes/beauty-institute/assets/images/single/vydalennya_novoutvoren_review.webp"
											alt=""
											width="280"
											height="280"
											loading="lazy"
											decoding="async"
										>
									</figure>
									<div class="vidhuky_body">
										<img
											class="vidhuky_quot vidhuky_quot_start"
											src="/wp-content/themes/beauty-institute/assets/images/single/vydalennya_novoutvoren_review_quot_1.svg"
											alt=""
											width="45"
											height="40"
											decoding="async"
											aria-hidden="true"
										>
										<p class="vidhuky_topic">Видалення новоутворень</p>
										<div class="vidhuky_copy">
											<p class="vidhuky_name">Олена</p>
											<p class="vidhuky_text">Дуже вдячна лікарю за професійний підхід. На консультації все детально пояснили, визначили причину проблеми та підібрали лікування. Результат помітний вже після перших процедур. Окремо хочу відзначити уважність і делікатність у роботі.</p>
										</div>
										<img
											class="vidhuky_quot vidhuky_quot_end"
											src="/wp-content/themes/beauty-institute/assets/images/single/vydalennya_novoutvoren_review_quot_2.svg"
											alt=""
											width="45"
											height="40"
											decoding="async"
											aria-hidden="true"
										>
									</div>
								</div>
							</div>
						</div>

						<div class="vidhuky_slide">
							<div class="vidhuky_card">
								<div class="vidhuky_back" aria-hidden="true">
									<img
										class="vidhuky_decor vidhuky_decor_mob"
										src="/wp-content/themes/beauty-institute/assets/images/zapysatys_na_mob_1.webp"
										alt=""
										width="134"
										height="152"
										decoding="async"
									>
									<img
										class="vidhuky_decor vidhuky_decor_desk"
										src="/wp-content/themes/beauty-institute/assets/images/zapysatys_na_1.webp"
										alt=""
										width="184"
										height="210"
										decoding="async"
									>
								</div>
								<div class="vidhuky_content">
									<figure class="vidhuky_photo">
										<img
											class="vidhuky_photo_img"
											src="/wp-content/themes/beauty-institute/assets/images/single/vydalennya_novoutvoren_review.webp"
											alt=""
											width="280"
											height="280"
											loading="lazy"
											decoding="async"
										>
									</figure>
									<div class="vidhuky_body">
										<img
											class="vidhuky_quot vidhuky_quot_start"
											src="/wp-content/themes/beauty-institute/assets/images/single/vydalennya_novoutvoren_review_quot_1.svg"
											alt=""
											width="45"
											height="40"
											decoding="async"
											aria-hidden="true"
										>
										<p class="vidhuky_topic">Видалення новоутворень</p>
										<div class="vidhuky_copy">
											<p class="vidhuky_name">Олена</p>
											<p class="vidhuky_text">Дуже вдячна лікарю за професійний підхід. На консультації все детально пояснили, визначили причину проблеми та підібрали лікування. Результат помітний вже після перших процедур. Окремо хочу відзначити уважність і делікатність у роботі.</p>
										</div>
										<img
											class="vidhuky_quot vidhuky_quot_end"
											src="/wp-content/themes/beauty-institute/assets/images/single/vydalennya_novoutvoren_review_quot_2.svg"
											alt=""
											width="45"
											height="40"
											decoding="async"
											aria-hidden="true"
										>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="results_controls vidhuky_controls">
					<div class="results_dots" data-vidhuky-dots role="tablist" aria-label="Слайди відгуків"></div>
					<button class="results_next" type="button" data-vidhuky-next aria-label="Наступний відгук">
						<span class="results_next_icon" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right_nav.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right_nav.svg');" aria-hidden="true"></span>
					</button>
				</div>
			</div>
		</div>
	</section>

	<section class="do_ta_pislya" id="results" aria-label="До та після">
		<div class="container do_ta_pislya_head">
			<h2 class="do_ta_pislya_title font_heading">До та після</h2>
			<div class="do_ta_pislya_head_aside">
				<p class="do_ta_pislya_intro">Наші результати підкреслюють ваші індивідуальні риси.</p>
			</div>
		</div>

		<div class="container do_ta_pislya_slider" data-do-ta-pislya-slider>
			<div class="do_ta_pislya_viewport">
				<div class="do_ta_pislya_track">
					<div class="do_ta_pislya_slide">
						<div class="do_ta_pislya_photo">
							<img class="do_ta_pislya_img" src="/wp-content/themes/beauty-institute/assets/images/single/single_do_ta_slide_1.webp" alt="" loading="lazy" decoding="async">
						</div>
					</div>

					<div class="do_ta_pislya_slide">
						<div class="do_ta_pislya_photo">
							<img class="do_ta_pislya_img" src="/wp-content/themes/beauty-institute/assets/images/single/single_do_ta_slide_2.webp" alt="" loading="lazy" decoding="async">
						</div>
					</div>

					<div class="do_ta_pislya_slide">
						<div class="do_ta_pislya_photo">
							<img class="do_ta_pislya_img" src="/wp-content/themes/beauty-institute/assets/images/single/single_do_ta_slide_1.webp" alt="" loading="lazy" decoding="async">
						</div>
					</div>
				</div>
			</div>

			<div class="results_controls do_ta_pislya_controls">
				<div class="results_dots" data-do-ta-pislya-dots role="tablist" aria-label="Слайди до та після"></div>
				<button class="results_next" type="button" data-do-ta-pislya-next aria-label="Наступний слайд">
					<span class="results_next_icon" style="mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right_nav.svg'); -webkit-mask-image: url('/wp-content/themes/beauty-institute/assets/images/arrow_right_nav.svg');" aria-hidden="true"></span>
				</button>
			</div>
		</div>
	</section>

	<section class="use_shcho">
		<span
			class="use_shcho_bg"
			style="background-image: url('/wp-content/themes/beauty-institute/assets/images/child_cat/use_shcho.webp');"
			aria-hidden="true"
		></span>

		<div class="container use_shcho_inner">
			<div class="use_shcho_panel">
				<h2 class="use_shcho_title">Усе, що ви хотіли запитати</h2>

				<div class="use_shcho_list">
					<div class="use_shcho_item is_open">
						<button class="use_shcho_toggle" type="button" aria-expanded="true">
							<span class="use_shcho_question">Чому нам довіряють?</span>
							<span
								class="use_shcho_icon"
								style="background-image: url('/wp-content/themes/beauty-institute/assets/images/child_cat/use_shcho.svg');"
								aria-hidden="true"
							></span>
						</button>
						<div class="use_shcho_answer">
							<div class="use_shcho_answer_inner">
								<p class="use_shcho_answer_text">Це найважливіший критерій. Пацієнти звертаються до нас, тому що:</p>
								<ul class="use_shcho_answer_list">
									<li>є багато позитивних відгуків;</li>
									<li>працюють досвідчені лікарі;</li>
									<li>наш медичний центр має позитивну репутацію.</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="use_shcho_item">
						<button class="use_shcho_toggle" type="button" aria-expanded="false">
							<span class="use_shcho_question">Яка кваліфікація у наших спеціалістів?</span>
							<span
								class="use_shcho_icon"
								style="background-image: url('/wp-content/themes/beauty-institute/assets/images/child_cat/use_shcho.svg');"
								aria-hidden="true"
							></span>
						</button>
						<div class="use_shcho_answer">
							<div class="use_shcho_answer_inner">
								<p class="use_shcho_answer_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
							</div>
						</div>
					</div>

					<div class="use_shcho_item">
						<button class="use_shcho_toggle" type="button" aria-expanded="false">
							<span class="use_shcho_question">Чи можна рекомендувати наших лікарів?</span>
							<span
								class="use_shcho_icon"
								style="background-image: url('/wp-content/themes/beauty-institute/assets/images/child_cat/use_shcho.svg');"
								aria-hidden="true"
							></span>
						</button>
						<div class="use_shcho_answer">
							<div class="use_shcho_answer_inner">
								<p class="use_shcho_answer_text">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							</div>
						</div>
					</div>

					<div class="use_shcho_item">
						<button class="use_shcho_toggle" type="button" aria-expanded="false">
							<span class="use_shcho_question">Де ми розташовані?</span>
							<span
								class="use_shcho_icon"
								style="background-image: url('/wp-content/themes/beauty-institute/assets/images/child_cat/use_shcho.svg');"
								aria-hidden="true"
							></span>
						</button>
						<div class="use_shcho_answer">
							<div class="use_shcho_answer_inner">
								<p class="use_shcho_answer_text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
							</div>
						</div>
					</div>

					<div class="use_shcho_item">
						<button class="use_shcho_toggle" type="button" aria-expanded="false">
							<span class="use_shcho_question">На якому рівні якість сервісу?</span>
							<span
								class="use_shcho_icon"
								style="background-image: url('/wp-content/themes/beauty-institute/assets/images/child_cat/use_shcho.svg');"
								aria-hidden="true"
							></span>
						</button>
						<div class="use_shcho_answer">
							<div class="use_shcho_answer_inner">
								<p class="use_shcho_answer_text">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
							</div>
						</div>
					</div>

					<div class="use_shcho_item">
						<button class="use_shcho_toggle" type="button" aria-expanded="false">
							<span class="use_shcho_question">Чи сучасне у нас обладнання?</span>
							<span
								class="use_shcho_icon"
								style="background-image: url('/wp-content/themes/beauty-institute/assets/images/child_cat/use_shcho.svg');"
								aria-hidden="true"
							></span>
						</button>
						<div class="use_shcho_answer">
							<div class="use_shcho_answer_inner">
								<p class="use_shcho_answer_text">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="consult" id="consult" aria-label="Запис на консультацію">
			<div
				class="consult_media"
				aria-hidden="true"
				style="background-image: url('/wp-content/themes/beauty-institute/assets/images/zapys_img_mob.webp');"
			></div>

			<div class="container consult_container">
				<div
					class="consult_box"
					style="background-image: url('/wp-content/themes/beauty-institute/assets/images/zapys_bg.webp');"
				>
					<div class="consult_form_col">
						<h2 class="consult_title font_heading">Записатись на прийом</h2>
						<p class="consult_intro">Підберемо зручний час</p>
						<form action="/#wpcf7-f72-o1" method="post" class="wpcf7-form consult_form init" aria-label="Контактна форма" novalidate="novalidate" data-status="init">
							<p>
								<label> Ім’я</label><br>
								<span class="wpcf7-form-control-wrap" data-name="your-name"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text" autocomplete="name" aria-invalid="false" value="" type="text" name="your-name" placeholder="Вкажіть як до вас звертатися"></span>
							</p>
							<p>
								<label> Телефон</label><br>
								<span class="wpcf7-form-control-wrap" data-name="your-phone"><input size="40" maxlength="15" class="wpcf7-form-control wpcf7-tel wpcf7-text" autocomplete="tel" inputmode="numeric" aria-invalid="false" value="" type="tel" name="your-phone" placeholder="Вкажіть свій номер телефону"></span>
							</p>
							<p>
								<label> Послуга</label><br>
								<span class="wpcf7-form-control-wrap" data-name="your-service"><select class="wpcf7-form-control wpcf7-select" aria-invalid="false" name="your-service"><option value="">Оберіть послугу</option><option value="novoutvorennya">Видалення новоутворень</option><option value="injection">Ін’єкційна косметологія</option><option value="surgery">Естетична хірургія</option><option value="hardware">Апаратна косметологія</option><option value="care">Доглядові процедури</option><option value="stomatology">Стоматологія</option></select></span>
							</p>
							<p>
								<input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit" value="Відправити"><span class="wpcf7-spinner"></span>
							</p>
						</form>
					</div>

					<div class="consult_visual" aria-hidden="true"></div>
				</div>
			</div>
	</section>

</main>
<?php
get_footer();
