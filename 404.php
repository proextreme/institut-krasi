<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Beauty_Institute
 */

get_header();
?>
<main class="page_404">
	<section class="page_404_hero" aria-label="<?php esc_attr_e( 'Сторінку не знайдено', 'beauty-institute' ); ?>">
		<span
			class="page_404_bg page_404_bg_mob"
			style="background-image: url('/wp-content/themes/beauty-institute/assets/images/404/4_mob.webp');"
			aria-hidden="true"
		></span>
		<span
			class="page_404_bg page_404_bg_desk"
			style="background-image: url('/wp-content/themes/beauty-institute/assets/images/404/4.webp');"
			aria-hidden="true"
		></span>

		<div class="container page_404_inner">
			<p class="page_404_code">404</p>

			<div class="page_404_panel">
				<div class="page_404_copy">
					<h1 class="page_404_title font_heading">Сторінку<br class="page_404_br"> не знайдено</h1>
					<div class="page_404_text">
						<p>Можливо, сторінка була переміщена, видалена або посилання виявилось неактуальним.</p>
						<p>Пропонуємо повернутися на головну сторінку або скористатися меню сайту.</p>
					</div>
				</div>

				<div class="page_404_actions">
					<a class="page_404_btn_home" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						На головну сторінку
					</a>
					<a class="page_404_btn_services" href="<?php echo esc_url( home_url( '/poslugi/' ) ); ?>">
						<span class="page_404_btn_services_text">Всі послуги</span>
						<span class="page_404_btn_services_icon" aria-hidden="true"></span>
					</a>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
