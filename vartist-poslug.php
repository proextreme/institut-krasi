<?php
/**
 * Template Name: Vartist poslug
 *
 * @package Beauty_Institute
 */

get_header();
?>
<main class="vartist_poslug">

	<section class="poslugi">
		<nav class="breadcrumbs" aria-label="Хлібні крихти">
			<div class="container breadcrumbs_inner">
				<? if ( function_exists('yoast_breadcrumb') ) yoast_breadcrumb('<div id="breadcrumbs">','</div>');?>
			</div>
		</nav>

		<div class="container poslugi_inner">
			<h1 class="poslugi_title font_heading">Вартість наших послуг</h1>
			<div class="poslugi_text">
				<p class="poslugi_desc">Ми прагнемо, щоб вам було легко орієнтуватися у вартості послуг. Ціни в Інституті краси формуються - відповідно до досвіду лікарів, технологій і результату, який ви отримуєте.</p>
			</div>
			<nav class="poslugi_tabs" aria-label="Категорії прайсу">
				<a class="poslugi_tab is_active" href="#">Загальний прайс</a>
				<a class="poslugi_tab" href="#">Технології</a>
				<a class="poslugi_tab" href="#">Стоматологія</a>
			</nav>
		</div>
	</section>

	<section class="in_iektsiina_terapiya" aria-label="Прайс послуг">
		<div class="in_iektsiina_terapiya_decor" aria-hidden="true">
			<span
				class="in_iektsiina_terapiya_decor_item in_iektsiina_terapiya_decor_item_1"
				style="background-image: url('/wp-content/themes/beauty-institute/assets/images/right_edge_img.webp');"
			></span>
			<span
				class="in_iektsiina_terapiya_decor_item in_iektsiina_terapiya_decor_item_2"
				style="background-image: url('/wp-content/themes/beauty-institute/assets/images/right_edge_img.webp');"
			></span>
		</div>

		<div class="container in_iektsiina_terapiya_inner">
			<div class="in_iektsiina_terapiya_panel">
				<ul class="in_iektsiina_terapiya_list">
					<li class="in_iektsiina_terapiya_item is_open">
						<button type="button" class="in_iektsiina_terapiya_toggle" aria-expanded="true">
							<span class="in_iektsiina_terapiya_cat">Консультації</span>
							<span class="in_iektsiina_terapiya_icon" aria-hidden="true"><span></span></span>
						</button>
						<div class="in_iektsiina_terapiya_body">
							<div class="in_iektsiina_terapiya_body_inner">
								<ul class="in_iektsiina_terapiya_rows">
									<li class="in_iektsiina_terapiya_row">
										<span class="in_iektsiina_terapiya_name">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
										<span class="in_iektsiina_terapiya_meta">
											<span class="in_iektsiina_terapiya_price">1000 грн</span>
											<span class="in_iektsiina_terapiya_time">60-90 хв</span>
										</span>
									</li>
									<li class="in_iektsiina_terapiya_row">
										<span class="in_iektsiina_terapiya_name">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
										<span class="in_iektsiina_terapiya_meta">
											<span class="in_iektsiina_terapiya_price">1000 грн</span>
											<span class="in_iektsiina_terapiya_time">60-90 хв</span>
										</span>
									</li>
								</ul>
							</div>
						</div>
					</li>

					<li class="in_iektsiina_terapiya_item">
						<button type="button" class="in_iektsiina_terapiya_toggle" aria-expanded="false">
							<span class="in_iektsiina_terapiya_cat">Проколи шкіри</span>
							<span class="in_iektsiina_terapiya_icon" aria-hidden="true"><span></span></span>
						</button>
						<div class="in_iektsiina_terapiya_body">
							<div class="in_iektsiina_terapiya_body_inner">
								<ul class="in_iektsiina_terapiya_rows">
									<li class="in_iektsiina_terapiya_row">
										<span class="in_iektsiina_terapiya_name">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
										<span class="in_iektsiina_terapiya_meta">
											<span class="in_iektsiina_terapiya_price">1000 грн</span>
											<span class="in_iektsiina_terapiya_time">60-90 хв</span>
										</span>
									</li>
									<li class="in_iektsiina_terapiya_row">
										<span class="in_iektsiina_terapiya_name">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
										<span class="in_iektsiina_terapiya_meta">
											<span class="in_iektsiina_terapiya_price">1000 грн</span>
											<span class="in_iektsiina_terapiya_time">60-90 хв</span>
										</span>
									</li>
								</ul>
							</div>
						</div>
					</li>

					<li class="in_iektsiina_terapiya_item">
						<button type="button" class="in_iektsiina_terapiya_toggle" aria-expanded="false">
							<span class="in_iektsiina_terapiya_cat">Лікувальна мезотерапія обличчя</span>
							<span class="in_iektsiina_terapiya_icon" aria-hidden="true"><span></span></span>
						</button>
						<div class="in_iektsiina_terapiya_body">
							<div class="in_iektsiina_terapiya_body_inner">
								<div class="in_iektsiina_terapiya_group">
									<ul class="in_iektsiina_terapiya_rows">
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Лікувальна мезотерапія NCTF 135 НА</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">4 000 грн</span>
												<span class="in_iektsiina_terapiya_time">60-90 хв</span>
											</span>
										</li>
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Лікувальна мезотерапія BSK1 Multipetides HA</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">2 000 грн</span>
												<span class="in_iektsiina_terapiya_time">60 хв</span>
											</span>
										</li>
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Лікувальна мезотерапія BSK2 Firmpro</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">1 100 грн</span>
												<span class="in_iektsiina_terapiya_time">60 хв</span>
											</span>
										</li>
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Лікувальна мезотерапія BSK3 Botopeptides</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">2 000 грн</span>
												<span class="in_iektsiina_terapiya_time">60 хв</span>
											</span>
										</li>
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Лікувальна мезотерапія BSK4 Revitalpro 20</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">1 500 грн</span>
												<span class="in_iektsiina_terapiya_time">60 хв</span>
											</span>
										</li>
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Лікувальна мезотерапія BSK7 Brightpro</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">1 100 грн</span>
												<span class="in_iektsiina_terapiya_time">60 хв</span>
											</span>
										</li>
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Лікувальна мезотерапія BSK14 Tranex pro</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">1 500 грн</span>
												<span class="in_iektsiina_terapiya_time">60 хв</span>
											</span>
										</li>
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Лікувальна мезотерапія BSK17 Dmae 3%</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">1 100 грн</span>
												<span class="in_iektsiina_terapiya_time">60 хв</span>
											</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</li>

					<li class="in_iektsiina_terapiya_item">
						<button type="button" class="in_iektsiina_terapiya_toggle" aria-expanded="false">
							<span class="in_iektsiina_terapiya_cat">Біоревіталізація</span>
							<span class="in_iektsiina_terapiya_icon" aria-hidden="true"><span></span></span>
						</button>
						<div class="in_iektsiina_terapiya_body">
							<div class="in_iektsiina_terapiya_body_inner">
								<ul class="in_iektsiina_terapiya_rows">
									<li class="in_iektsiina_terapiya_row">
										<span class="in_iektsiina_terapiya_name">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
										<span class="in_iektsiina_terapiya_meta">
											<span class="in_iektsiina_terapiya_price">1000 грн</span>
											<span class="in_iektsiina_terapiya_time">60-90 хв</span>
										</span>
									</li>
									<li class="in_iektsiina_terapiya_row">
										<span class="in_iektsiina_terapiya_name">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
										<span class="in_iektsiina_terapiya_meta">
											<span class="in_iektsiina_terapiya_price">1000 грн</span>
											<span class="in_iektsiina_terapiya_time">60-90 хв</span>
										</span>
									</li>
								</ul>
							</div>
						</div>
					</li>

					<li class="in_iektsiina_terapiya_item">
						<button type="button" class="in_iektsiina_terapiya_toggle" aria-expanded="false">
							<span class="in_iektsiina_terapiya_cat">Ін'єкційна терапія волосистої частини голови</span>
							<span class="in_iektsiina_terapiya_icon" aria-hidden="true"><span></span></span>
						</button>
						<div class="in_iektsiina_terapiya_body">
							<div class="in_iektsiina_terapiya_body_inner">
								<ul class="in_iektsiina_terapiya_rows">
									<li class="in_iektsiina_terapiya_row">
										<span class="in_iektsiina_terapiya_name">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
										<span class="in_iektsiina_terapiya_meta">
											<span class="in_iektsiina_terapiya_price">1000 грн</span>
											<span class="in_iektsiina_terapiya_time">60-90 хв</span>
										</span>
									</li>
									<li class="in_iektsiina_terapiya_row">
										<span class="in_iektsiina_terapiya_name">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
										<span class="in_iektsiina_terapiya_meta">
											<span class="in_iektsiina_terapiya_price">1000 грн</span>
											<span class="in_iektsiina_terapiya_time">60-90 хв</span>
										</span>
									</li>
								</ul>
							</div>
						</div>
					</li>

					<li class="in_iektsiina_terapiya_item">
						<button type="button" class="in_iektsiina_terapiya_toggle" aria-expanded="false">
							<span class="in_iektsiina_terapiya_cat">Контурна пластика</span>
							<span class="in_iektsiina_terapiya_icon" aria-hidden="true"><span></span></span>
						</button>
						<div class="in_iektsiina_terapiya_body">
							<div class="in_iektsiina_terapiya_body_inner">
								<ul class="in_iektsiina_terapiya_rows">
									<li class="in_iektsiina_terapiya_row">
										<span class="in_iektsiina_terapiya_name">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
										<span class="in_iektsiina_terapiya_meta">
											<span class="in_iektsiina_terapiya_price">1000 грн</span>
											<span class="in_iektsiina_terapiya_time">60-90 хв</span>
										</span>
									</li>
									<li class="in_iektsiina_terapiya_row">
										<span class="in_iektsiina_terapiya_name">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
										<span class="in_iektsiina_terapiya_meta">
											<span class="in_iektsiina_terapiya_price">1000 грн</span>
											<span class="in_iektsiina_terapiya_time">60-90 хв</span>
										</span>
									</li>
								</ul>
							</div>
						</div>
					</li>

					<li class="in_iektsiina_terapiya_item">
						<button type="button" class="in_iektsiina_terapiya_toggle" aria-expanded="false">
							<span class="in_iektsiina_terapiya_cat">Пластична хірургія</span>
							<span class="in_iektsiina_terapiya_icon" aria-hidden="true"><span></span></span>
						</button>
						<div class="in_iektsiina_terapiya_body">
							<div class="in_iektsiina_terapiya_body_inner">
								<div class="in_iektsiina_terapiya_group">
									<h3 class="in_iektsiina_terapiya_sub">Блефаропластика</h3>
									<ul class="in_iektsiina_terapiya_rows">
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Блефаропластика кругова</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">95 000 грн</span>
												<span class="in_iektsiina_terapiya_time">120 хв</span>
											</span>
										</li>
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Блефаропластика верхня *місцева анестезія</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">45 000 грн</span>
												<span class="in_iektsiina_terapiya_time">60 хв</span>
											</span>
										</li>
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Блефаропластика нижня</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">50 000 грн</span>
												<span class="in_iektsiina_terapiya_time">60 хв</span>
											</span>
										</li>
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Пластика куточків очей (кантопексія/кантопластика)</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">20 600 грн</span>
												<span class="in_iektsiina_terapiya_time">50 хв</span>
											</span>
										</li>
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Блефаропластика нижня черезшкірна з переміщенням жиру в середню зону обличчя</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">100 500 грн</span>
												<span class="in_iektsiina_terapiya_time">60 хв</span>
											</span>
										</li>
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Блефаропластика нижня черезшкірна з підтяжкою середньої зони обличчя</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">170 600 грн</span>
												<span class="in_iektsiina_terapiya_time">100 хв</span>
											</span>
										</li>
									</ul>
								</div>
								<div class="in_iektsiina_terapiya_group">
									<h3 class="in_iektsiina_terapiya_sub">Ринопластика</h3>
									<ul class="in_iektsiina_terapiya_rows">
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Ринопластика (пластика кінчика/спинки носа)</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">140 000 грн</span>
												<span class="in_iektsiina_terapiya_time">120 хв</span>
											</span>
										</li>
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Корекція крил носа</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">61 000 грн</span>
												<span class="in_iektsiina_terapiya_time">60 хв</span>
											</span>
										</li>
									</ul>
								</div>
								<div class="in_iektsiina_terapiya_group">
									<h3 class="in_iektsiina_terapiya_sub">Отопластика</h3>
									<ul class="in_iektsiina_terapiya_rows">
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Отопластика однобічна *місцева анестезія</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">15 000 грн</span>
												<span class="in_iektsiina_terapiya_time">30 хв</span>
											</span>
										</li>
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Отопластика двобічна *місцева анестезія</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">30 000 грн</span>
												<span class="in_iektsiina_terapiya_time">60 хв</span>
											</span>
										</li>
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Отопластика повторна реконструктивна (двобічна) *місцева анестезія</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">51 500 грн</span>
												<span class="in_iektsiina_terapiya_time">60 хв</span>
											</span>
										</li>
										<li class="in_iektsiina_terapiya_row">
											<span class="in_iektsiina_terapiya_name">Пластика мочки вуха</span>
											<span class="in_iektsiina_terapiya_meta">
												<span class="in_iektsiina_terapiya_price">8 000 грн</span>
												<span class="in_iektsiina_terapiya_time">30 хв</span>
											</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</li>

					<li class="in_iektsiina_terapiya_item">
						<button type="button" class="in_iektsiina_terapiya_toggle" aria-expanded="false">
							<span class="in_iektsiina_terapiya_cat">Хірургія класична</span>
							<span class="in_iektsiina_terapiya_icon" aria-hidden="true"><span></span></span>
						</button>
						<div class="in_iektsiina_terapiya_body">
							<div class="in_iektsiina_terapiya_body_inner">
								<ul class="in_iektsiina_terapiya_rows">
									<li class="in_iektsiina_terapiya_row">
										<span class="in_iektsiina_terapiya_name">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
										<span class="in_iektsiina_terapiya_meta">
											<span class="in_iektsiina_terapiya_price">1000 грн</span>
											<span class="in_iektsiina_terapiya_time">60-90 хв</span>
										</span>
									</li>
									<li class="in_iektsiina_terapiya_row">
										<span class="in_iektsiina_terapiya_name">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
										<span class="in_iektsiina_terapiya_meta">
											<span class="in_iektsiina_terapiya_price">1000 грн</span>
											<span class="in_iektsiina_terapiya_time">60-90 хв</span>
										</span>
									</li>
								</ul>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</section>

</main>
<?php
get_footer();
