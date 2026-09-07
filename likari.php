<?php
/**
 * Template Name: Likari
 *
 * @package Beauty_Institute
 */

get_header();
?>
<main class="likari">

	<section class="poslugi">
		<nav class="breadcrumbs" aria-label="Хлібні крихти">
			<div class="container breadcrumbs_inner">
				<? if ( function_exists('yoast_breadcrumb') ) yoast_breadcrumb('<div id="breadcrumbs">','</div>');?>
			</div>
		</nav>

		<div class="container poslugi_inner">
			<h1 class="poslugi_title font_heading">Наші лікарі</h1>
			<div class="poslugi_text">
				<p class="poslugi_desc">Наші лікарі — експерти, яким довіряють. Багаторічний досвід, постійне навчання, бездоганне володіння сучасними методами діагностики та лікування — основа нашої роботи.</p>
			</div>
			<nav class="poslugi_tabs" aria-label="Наші лікарі" data-likari-tabs role="tablist">
				<button type="button" class="poslugi_tab" role="tab" id="likari-tab-dermatology" data-likari-tab="dermatology" aria-controls="likari-panel-dermatology" aria-selected="false" tabindex="-1">Дерматологи</button>
				<button type="button" class="poslugi_tab is_active" role="tab" id="likari-tab-surgery" data-likari-tab="surgery" aria-controls="likari-panel-surgery" aria-selected="true" tabindex="0">Хірурги</button>
				<button type="button" class="poslugi_tab" role="tab" id="likari-tab-cosmetology" data-likari-tab="cosmetology" aria-controls="likari-panel-cosmetology" aria-selected="false" tabindex="-1">Косметологи</button>
				<button type="button" class="poslugi_tab" role="tab" id="likari-tab-stomatology" data-likari-tab="stomatology" aria-controls="likari-panel-stomatology" aria-selected="false" tabindex="-1">Стоматологи</button>
				<button type="button" class="poslugi_tab" role="tab" id="likari-tab-other" data-likari-tab="other" aria-controls="likari-panel-other" aria-selected="false" tabindex="-1">Інші лікарі</button>
			</nav>
		</div>
	</section>

	<section class="estetychnyi_khirurh" aria-label="Список лікарів">
		<div class="container estetychnyi_khirurh_inner">
			<div class="estetychnyi_khirurh_panels">

				<div
					class="estetychnyi_khirurh_panel"
					id="likari-panel-dermatology"
					role="tabpanel"
					data-likari-panel="dermatology"
					aria-labelledby="likari-tab-dermatology"
					aria-hidden="true"
				>
					<div class="estetychnyi_khirurh_list">
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_3.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_7.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_1.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_9.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_5.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_10.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_2.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_8.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_4.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_6.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
					</div>
				</div>

				<div
					class="estetychnyi_khirurh_panel is_active"
					id="likari-panel-surgery"
					role="tabpanel"
					data-likari-panel="surgery"
					aria-labelledby="likari-tab-surgery"
					aria-hidden="false"
				>
					<div class="estetychnyi_khirurh_list">
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_1.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_2.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_3.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_4.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_5.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_6.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_7.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_8.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_9.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_10.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
					</div>
				</div>

				<div
					class="estetychnyi_khirurh_panel"
					id="likari-panel-cosmetology"
					role="tabpanel"
					data-likari-panel="cosmetology"
					aria-labelledby="likari-tab-cosmetology"
					aria-hidden="true"
				>
					<div class="estetychnyi_khirurh_list">
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_10.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_5.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_2.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_8.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_1.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_6.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_9.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_3.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_7.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_4.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
					</div>
				</div>

				<div
					class="estetychnyi_khirurh_panel"
					id="likari-panel-stomatology"
					role="tabpanel"
					data-likari-panel="stomatology"
					aria-labelledby="likari-tab-stomatology"
					aria-hidden="true"
				>
					<div class="estetychnyi_khirurh_list">
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_4.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_9.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_2.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_6.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_8.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_1.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_10.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_3.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_5.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_7.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
					</div>
				</div>

				<div
					class="estetychnyi_khirurh_panel"
					id="likari-panel-other"
					role="tabpanel"
					data-likari-panel="other"
					aria-labelledby="likari-tab-other"
					aria-hidden="true"
				>
					<div class="estetychnyi_khirurh_list">
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_8.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_6.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_2.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_10.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_4.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_1.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_7.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_3.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_9.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
						<article class="estetychnyi_khirurh_card">
							<a class="estetychnyi_khirurh_photo" href="/likar" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/likari/estetychnyi_khirurh_5.webp');"></a>
							<a class="estetychnyi_khirurh_info" href="/likar">
								<span class="estetychnyi_khirurh_role">Естетичний хірург</span>
								<span class="estetychnyi_khirurh_name">Сливка Олена Михайлівна</span>
							</a>
						</article>
					</div>
				</div>

			</div>
		</div>
	</section>

</main>
<?php
get_footer();
