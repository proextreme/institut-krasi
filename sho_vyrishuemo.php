<?php
/**
 * Template Name: Sho vyrishuemo
 *
 * Listing of all "Запити" (problems), linking to each detail page.
 *
 * @package beauty-institute
 */

get_header();

$page_title = '';
$page_text  = '';
while ( have_posts() ) :
	the_post();
	$page_title = get_the_title();
	$page_text  = get_the_content();
endwhile;

$problems = get_posts(
	array(
		'post_type'      => 'bi_problem',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'no_found_rows'  => true,
		'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
	)
);

$shapes = array( 'requests_card_cut_br', 'requests_card_cut_tr', 'requests_card_cut_bl', 'requests_card_cut_tl' );
?>
<main class="sho_vyrishuemo">

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
			<h1 class="poslugi_title font_heading"><?php echo esc_html( bi_field( 'hero_title', $page_title ? $page_title : __( 'Що ми вирішуємо', 'beauty-institute' ) ) ); ?></h1>
			<div class="poslugi_text">
				<p class="poslugi_desc">
					<?php
					$desc = bi_field( 'hero_text', '' );
					if ( '' === $desc && $page_text ) {
						$desc = wp_strip_all_tags( $page_text );
					}
					echo esc_html( $desc ? $desc : 'Наші спеціалісти допомагають діагностувати та лікувати широкий спектр дерматологічних і естетичних проблем. Оберіть запит, щоб дізнатися більше.' );
					?>
				</p>
			</div>
		</div>
	</section>

	<section class="requests" aria-label="Запити">
		<div class="container requests_inner">
			<?php if ( $problems ) : ?>
			<div class="requests_track requests_track_grid">
				<?php
				foreach ( $problems as $i => $problem_id ) :
					$img_id = bi_image_id( get_field( 'card_image', $problem_id ) );
					if ( ! $img_id ) {
						$img_id = get_post_thumbnail_id( $problem_id );
					}
					$src = $img_id ? wp_get_attachment_image_url( $img_id, 'medium_large' ) : beauty_institute_asset( 'images/request_' . ( ( $i % 8 ) + 1 ) . '.webp' );
					?>
					<a class="requests_card requests_card_tall <?php echo esc_attr( $shapes[ $i % 4 ] ); ?>" href="<?php echo esc_url( get_permalink( $problem_id ) ); ?>" style="--card-photo: url('<?php echo esc_url( $src ); ?>');">
						<img class="requests_card_img" src="<?php echo esc_url( $src ); ?>" alt="" width="300" height="366" loading="lazy" decoding="async">
						<span class="requests_card_panel">
							<span class="requests_card_name"><?php echo esc_html( get_the_title( $problem_id ) ); ?></span>
							<span class="requests_card_arrow" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>');" aria-hidden="true"></span>
						</span>
					</a>
				<?php endforeach; ?>
			</div>
			<?php else : ?>
				<p class="poslugi_desc"><?php esc_html_e( 'Розділ наповнюється. Незабаром тут зʼявляться описи запитів.', 'beauty-institute' ); ?></p>
			<?php endif; ?>
		</div>
	</section>

	<?php beauty_institute_consult_section(); ?>

</main>
<?php
get_footer();
