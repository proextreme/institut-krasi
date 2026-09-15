<?php
/**
 * Individual service page (category with is_child_cat = true).
 *
 * @package beauty-institute
 */

$term = get_queried_object();

$hero_bg     = bi_image_id( get_field( 'hero_bg', $term ) );
$hero_bg_mob = bi_image_id( get_field( 'hero_bg_mobile', $term ) );
$hero_bg_url = $hero_bg ? wp_get_attachment_image_url( $hero_bg, 'full' ) : beauty_institute_asset( 'images/child_cat/iniektsiina_kosmetolohiya.webp' );
$hero_mob_url = $hero_bg_mob ? wp_get_attachment_image_url( $hero_bg_mob, 'large' ) : beauty_institute_asset( 'images/child_cat/iniektsiina_kosmetolohiya_mob.webp' );

$feats = array_filter( array( get_field( 'feat_1', $term ), get_field( 'feat_2', $term ), get_field( 'feat_3', $term ) ) );
if ( ! $feats ) {
	$feats = array( 'Індивідуальний підхід', 'Досвідчені лікарі', 'Сертифіковані матеріали' );
}

$intro_img_id = bi_image_id( get_field( 'intro_image', $term ) );
$intro_img    = $intro_img_id ? wp_get_attachment_image_url( $intro_img_id, 'large' ) : beauty_institute_asset( 'images/child_cat/molodist_bez.webp' );

$services = bi_parse_rows( get_field( 'services_list', $term ), 2 );
$audience = bi_parse_rows( get_field( 'audience_list', $term ), 2 );
$problems = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) get_field( 'problems_list', $term ) ) ) );

$arrow = beauty_institute_asset( 'images/arrow_right.svg' );
?>
<main class="child-cat">

	<section class="iniektsiina_kosmetolohiya">
		<span class="iniektsiina_kosmetolohiya_bg iniektsiina_kosmetolohiya_bg_mob" style="background-image: url('<?php echo esc_url( $hero_mob_url ); ?>');" aria-hidden="true"></span>
		<span class="iniektsiina_kosmetolohiya_bg iniektsiina_kosmetolohiya_bg_desk" style="background-image: url('<?php echo esc_url( $hero_bg_url ); ?>');" aria-hidden="true"></span>

		<nav class="breadcrumbs" aria-label="Хлібні крихти">
			<div class="container breadcrumbs_inner">
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) ) {
					yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
				}
				?>
			</div>
		</nav>

		<div class="container iniektsiina_kosmetolohiya_inner">
			<div class="iniektsiina_kosmetolohiya_top">
				<div class="iniektsiina_kosmetolohiya_text">
					<h1 class="iniektsiina_kosmetolohiya_title font_heading"><?php echo esc_html( $term->name ); ?></h1>
					<?php $hero_desc = get_field( 'hero_desc', $term ); ?>
					<?php if ( $hero_desc ) : ?><p class="iniektsiina_kosmetolohiya_desc"><?php echo esc_html( $hero_desc ); ?></p><?php endif; ?>
				</div>

				<div class="iniektsiina_kosmetolohiya_actions">
					<a class="btn btn_main iniektsiina_kosmetolohiya_btn" href="<?php echo esc_url( home_url( '/#consult' ) ); ?>">
						<span class="btn_text">Записатися</span>
					</a>
				</div>
			</div>

			<ul class="iniektsiina_kosmetolohiya_feats">
				<?php foreach ( $feats as $feat ) : ?>
					<li class="iniektsiina_kosmetolohiya_feat">
						<span class="iniektsiina_kosmetolohiya_feat_text"><?php echo esc_html( $feat ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<?php if ( get_field( 'intro_title', $term ) || get_field( 'intro_text', $term ) ) : ?>
	<section class="molodist_bez">
		<div class="container molodist_bez_inner">
			<div class="molodist_bez_content">
				<?php $intro_title = get_field( 'intro_title', $term ); ?>
				<?php if ( $intro_title ) : ?><h2 class="molodist_bez_title font_heading"><?php echo esc_html( $intro_title ); ?></h2><?php endif; ?>
				<div class="molodist_bez_text"><?php echo wp_kses_post( wpautop( (string) get_field( 'intro_text', $term ) ) ); ?></div>
			</div>

			<div class="molodist_bez_media" style="background-image: url('<?php echo esc_url( $intro_img ); ?>');" aria-hidden="true"></div>
		</div>
	</section>
	<?php endif; ?>

	<div class="edge_art edge_art_right" aria-hidden="true">
		<span class="edge_art_bg" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/right_edge_img.webp' ) ); ?>');"></span>
	</div>

	<?php if ( $services ) : ?>
	<section class="nashi_posluhy">
		<div class="nashi_posluhy_decor" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/child_cat/nashi_posluhy.webp' ) ); ?>');" aria-hidden="true"></div>

		<div class="container nashi_posluhy_inner">
			<h2 class="nashi_posluhy_title"><?php echo esc_html( get_field( 'services_title', $term ) ? get_field( 'services_title', $term ) : 'Наші послуги' ); ?></h2>

			<div class="nashi_posluhy_list">
				<?php foreach ( $services as $service ) : ?>
					<div class="nashi_posluhy_item">
						<div class="nashi_posluhy_body">
							<div class="nashi_posluhy_head">
								<h3 class="nashi_posluhy_name"><?php echo esc_html( $service[0] ); ?></h3>
							</div>
							<?php if ( $service[1] ) : ?><p class="nashi_posluhy_desc"><?php echo esc_html( $service[1] ); ?></p><?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( $audience || $problems ) : ?>
	<section class="komu_pidkhodyt">
		<div class="container komu_pidkhodyt_inner">
			<?php if ( $audience ) : ?>
			<div class="komu_pidkhodyt_block">
				<h2 class="komu_pidkhodyt_title"><?php echo esc_html( get_field( 'audience_title', $term ) ? get_field( 'audience_title', $term ) : 'Кому підходить' ); ?></h2>
				<div class="komu_pidkhodyt_list">
					<?php foreach ( $audience as $item ) : ?>
						<article class="komu_pidkhodyt_card">
							<h3 class="komu_pidkhodyt_card_title"><?php echo esc_html( $item[0] ); ?></h3>
							<p class="komu_pidkhodyt_card_text"><?php echo esc_html( $item[1] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>

			<?php if ( $problems ) : ?>
			<div class="yaki_problemy">
				<h2 class="yaki_problemy_title"><?php echo esc_html( get_field( 'problems_title', $term ) ? get_field( 'problems_title', $term ) : 'Які проблеми вирішує' ); ?></h2>
				<div class="yaki_problemy_list">
					<?php foreach ( $problems as $problem ) : ?>
						<article class="yaki_problemy_card">
							<p class="yaki_problemy_card_text"><?php echo esc_html( $problem ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</section>
	<?php endif; ?>

	<?php beauty_institute_faq_section(); ?>

	<section class="consult" id="consult" aria-label="Запис на консультацію">
		<div class="consult_media" aria-hidden="true" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/zapys_img_mob.webp' ) ); ?>');"></div>

		<div class="container consult_container">
			<div class="consult_box" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/zapys_bg.webp' ) ); ?>');">
				<div class="consult_form_col">
					<h2 class="consult_title font_heading"><?php echo esc_html( get_field( 'consult_title', $term ) ? get_field( 'consult_title', $term ) : 'Записатись на прийом' ); ?></h2>
					<p class="consult_intro"><?php echo esc_html( get_field( 'consult_intro_desktop', $term ) ? get_field( 'consult_intro_desktop', $term ) : 'Підберемо зручний час' ); ?></p>
					<?php beauty_institute_consult_form(); ?>
				</div>

				<div class="consult_visual" aria-hidden="true"></div>
			</div>
		</div>
	</section>

</main>
