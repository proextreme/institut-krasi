<?php
/* Template Name: Contact */
get_header();

while ( have_posts() ) :
	the_post();
endwhile;

$hero_bg_id     = bi_image_id( bi_field( 'hero_bg' ) );
$hero_bg_mob_id = bi_image_id( bi_field( 'hero_bg_mobile' ) );
$hero_bg        = $hero_bg_id ? wp_get_attachment_image_url( $hero_bg_id, 'full' ) : beauty_institute_asset( 'images/contacts/contact_hero_bg.webp' );
$hero_bg_mob    = $hero_bg_mob_id ? wp_get_attachment_image_url( $hero_bg_mob_id, 'large' ) : beauty_institute_asset( 'images/contacts/contact_hero_bg_mob.webp' );

$feats = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) bi_field( 'hero_feats' ) ) ) );
if ( ! $feats ) {
	$feats = array( bi_option( 'work_hours', 'Щодня з 9:00 до 21:00' ) );
}
?>
<main class="contact">
	<section class="contact_hero">
		<span class="contact_hero_bg contact_hero_bg_mob" style="background-image: url('<?php echo esc_url( $hero_bg_mob ); ?>');" aria-hidden="true"></span>
		<span class="contact_hero_bg contact_hero_bg_desk" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');" aria-hidden="true"></span>
		<nav class="breadcrumbs" aria-label="Хлібні крихти">
			<div class="container breadcrumbs_inner">
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) ) {
					yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
				}
				?>
			</div>
		</nav>

		<div class="container contact_hero_inner">
			<div class="contact_hero_top">
				<div class="contact_hero_text">
					<h1 class="contact_hero_title font_heading"><?php echo esc_html( bi_field( 'hero_title', __( 'Наші контакти', 'beauty-institute' ) ) ); ?></h1>
				</div>
			</div>

			<?php if ( $feats ) : ?>
			<ul class="contact_hero_feats">
				<?php foreach ( $feats as $feat ) : ?>
					<li class="contact_hero_feat">
						<span class="contact_hero_feat_icon contact_hero_feat_icon_clock" aria-hidden="true"></span>
						<span class="contact_hero_feat_text"><?php echo esc_html( $feat ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>
	</section>

	<?php
	beauty_institute_find_section();
	beauty_institute_consult_section();
	?>
</main>
<?php
get_footer();
