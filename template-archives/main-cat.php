<?php
/**
 * "Послуги" hub page (category with is_main_cat = true).
 *
 * @package beauty-institute
 */

$hub_term = get_queried_object();

$children = get_terms(
	array(
		'taxonomy'   => 'category',
		'parent'     => $hub_term->term_id,
		'hide_empty' => false,
		'orderby'    => 'term_order',
	)
);
if ( is_wp_error( $children ) ) {
	$children = array();
}
?>
<main class="main-cat">

	<section class="poslugi">
		<nav class="breadcrumbs" aria-label="Хлібні крихти">
			<div class="container breadcrumbs_inner">
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) ) {
					yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
				}
				?>
			</div>
		</nav>

		<div class="container poslugi_inner">
			<h1 class="poslugi_title font_heading">
				<span class="poslugi_title_short"><?php echo esc_html( $hub_term->name ); ?></span>
				<span class="poslugi_title_long"><?php esc_html_e( 'Наші послуги', 'beauty-institute' ); ?></span>
			</h1>
			<div class="poslugi_text">
				<p class="poslugi_lead"><?php echo esc_html( get_field( 'hub_lead', $hub_term ) ? get_field( 'hub_lead', $hub_term ) : 'Краса та здоров’я — в одному місці!' ); ?></p>
				<p class="poslugi_desc"><?php echo esc_html( get_field( 'hub_desc', $hub_term ) ? get_field( 'hub_desc', $hub_term ) : 'Інститут краси поєднує дерматологію, косметологію та естетичну хірургію під одним дахом. Наші спеціалісти підберуть оптимальне рішення — від делікатного догляду до хірургічної корекції — з урахуванням ваших потреб та побажань.' ); ?></p>
			</div>
		</div>
	</section>

	<section class="poslugi_box">
		<div class="container poslugi_box_list">
			<?php
			$arrow = beauty_institute_asset( 'images/arrow_right.svg' );
			foreach ( $children as $child ) :
				$img_id   = bi_image_id( get_field( 'card_image', $child ) );
				$img_src  = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : beauty_institute_asset( 'images/in_iektsiina_kosmetolohiya.webp' );
				$subtitle = get_field( 'card_subtitle', $child );
				$services = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) get_field( 'card_services', $child ) ) ) );
				$link     = get_term_link( $child );
				?>
				<article class="poslugi_box_card" style="--card-photo: url('<?php echo esc_url( $img_src ); ?>');">
					<picture class="poslugi_box_media">
						<img class="poslugi_box_img" src="<?php echo esc_url( $img_src ); ?>" alt="" width="615" height="448" loading="lazy" decoding="async">
					</picture>
					<div class="poslugi_box_panel">
						<div class="poslugi_box_body">
							<div class="poslugi_box_head">
								<h2 class="poslugi_box_name"><?php echo esc_html( $child->name ); ?></h2>
								<?php if ( $subtitle ) : ?><p class="poslugi_box_sub"><?php echo esc_html( $subtitle ); ?></p><?php endif; ?>
							</div>
							<?php if ( $services ) : ?>
							<ul class="poslugi_box_services">
								<?php foreach ( $services as $service ) : ?>
									<li class="poslugi_box_service"><?php echo esc_html( $service ); ?></li>
								<?php endforeach; ?>
							</ul>
							<?php endif; ?>
						</div>
						<a class="btn btn_blue poslugi_box_btn" href="<?php echo esc_url( $link ); ?>">
							<span class="btn_text"><?php esc_html_e( 'Перейти до послуг', 'beauty-institute' ); ?></span>
							<span class="btn_icon btn_icon_arrow" style="mask-image: url('<?php echo esc_url( $arrow ); ?>'); -webkit-mask-image: url('<?php echo esc_url( $arrow ); ?>');" aria-hidden="true"></span>
						</a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<div class="edge_art edge_art_right" aria-hidden="true">
		<span class="edge_art_bg" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/right_edge_img.webp' ) ); ?>');"></span>
	</div>

	<section class="chomu_obyrayut" aria-label="Чому обирають Інститут краси">
		<div class="container chomu_obyrayut_inner">
			<div class="chomu_obyrayut_header">
				<h2 class="chomu_obyrayut_title font_heading">Чому обирають Інститут краси</h2>
				<p class="chomu_obyrayut_sub">Де медична точність зустрічається з мистецтвом краси</p>
			</div>

			<div class="chomu_obyrayut_body">
				<article class="chomu_obyrayut_card">
					<h3 class="chomu_obyrayut_card_title">Досвідчена команда</h3>
					<p class="chomu_obyrayut_card_text">Наші лікарі-косметологи та пластичні хірурги постійно вдосконалюють майстерність, застосовуючи сучасні методики для досягнення найкращого результату.</p>
				</article>

				<article class="chomu_obyrayut_card">
					<h3 class="chomu_obyrayut_card_title">Сучасне обладнання</h3>
					<p class="chomu_obyrayut_card_text">Використовуємо перевірені апаратні технології, що забезпечують точність і безпеку кожної процедури.</p>
				</article>

				<figure class="chomu_obyrayut_media">
					<img class="chomu_obyrayut_img" src="<?php echo esc_url( beauty_institute_asset( 'images/chomu_obyrayut.webp' ) ); ?>" alt="" width="407" height="366" loading="lazy" decoding="async">
				</figure>

				<article class="chomu_obyrayut_card">
					<h3 class="chomu_obyrayut_card_title">Широкий спектр послуг</h3>
					<p class="chomu_obyrayut_card_text">Від доглядових процедур до пластичної хірургії — все в одному місці, без потреби шукати різних спеціалістів.</p>
				</article>

				<article class="chomu_obyrayut_card">
					<h3 class="chomu_obyrayut_card_title">Індивідуальний підхід</h3>
					<p class="chomu_obyrayut_card_text">Кожен пацієнт унікальний. Підбираємо програму догляду під ваші особливості, цілі та стиль життя.</p>
				</article>
			</div>
		</div>
	</section>

	<section class="zapysatys_na" aria-label="Записатись на прийом">
		<div class="container zapysatys_na_inner">
			<div class="zapysatys_na_card">
				<div class="zapysatys_na_back" aria-hidden="true">
					<img class="zapysatys_na_decor zapysatys_na_decor_mob" src="<?php echo esc_url( beauty_institute_asset( 'images/zapysatys_na_mob_1.webp' ) ); ?>" alt="" width="134" height="152" decoding="async">
					<img class="zapysatys_na_decor zapysatys_na_decor_desk" src="<?php echo esc_url( beauty_institute_asset( 'images/zapysatys_na_1.webp' ) ); ?>" alt="" width="184" height="210" decoding="async">
				</div>
				<div class="zapysatys_na_content">
					<figure class="zapysatys_na_photo">
						<picture>
							<img class="zapysatys_na_img" src="<?php echo esc_url( beauty_institute_asset( 'images/zapysatys_na.webp' ) ); ?>" alt="" width="240" height="240" loading="lazy" decoding="async">
						</picture>
					</figure>

					<nav class="zapysatys_na_nav" aria-label="Швидкі посилання">
						<a class="zapysatys_na_link" href="<?php echo esc_url( home_url( '/poslugi/' ) ); ?>">
							<span class="zapysatys_na_link_text">Ціни на послуги</span>
							<span class="zapysatys_na_link_icon btn_icon_arrow" style="mask-image: url('<?php echo esc_url( $arrow ); ?>'); -webkit-mask-image: url('<?php echo esc_url( $arrow ); ?>');" aria-hidden="true"></span>
						</a>
						<a class="zapysatys_na_link" href="<?php echo esc_url( home_url( '/vidguki/' ) ); ?>">
							<span class="zapysatys_na_link_text">Відгуки клієнтів</span>
							<span class="zapysatys_na_link_icon btn_icon_arrow" style="mask-image: url('<?php echo esc_url( $arrow ); ?>'); -webkit-mask-image: url('<?php echo esc_url( $arrow ); ?>');" aria-hidden="true"></span>
						</a>
						<a class="zapysatys_na_link" href="#">
							<span class="zapysatys_na_link_text">Поширені питання</span>
							<span class="zapysatys_na_link_icon btn_icon_arrow" style="mask-image: url('<?php echo esc_url( $arrow ); ?>'); -webkit-mask-image: url('<?php echo esc_url( $arrow ); ?>');" aria-hidden="true"></span>
						</a>
						<a class="zapysatys_na_link" href="<?php echo esc_url( home_url( '/#consult' ) ); ?>">
							<span class="zapysatys_na_link_text">Записатись<br>на прийом</span>
							<span class="zapysatys_na_link_icon btn_icon_arrow" style="mask-image: url('<?php echo esc_url( $arrow ); ?>'); -webkit-mask-image: url('<?php echo esc_url( $arrow ); ?>');" aria-hidden="true"></span>
						</a>
					</nav>
				</div>
			</div>
		</div>
	</section>

	<?php beauty_institute_consult_section(); ?>

</main>
