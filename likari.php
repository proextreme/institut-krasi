<?php
/**
 * Template Name: Likari
 *
 * @package beauty-institute
 */

get_header();

$likari_title = '';
$likari_intro = '';
while ( have_posts() ) :
	the_post();
	$likari_title = get_the_title();
	$likari_intro = get_the_content();
endwhile;

$specialties = get_terms(
	array(
		'taxonomy'   => 'bi_specialty',
		'hide_empty' => true,
	)
);
$specialties = is_wp_error( $specialties ) ? array() : $specialties;

// Doctors with no specialty assigned.
$unassigned = get_posts(
	array(
		'post_type'      => 'bi_doctor',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'no_found_rows'  => true,
		'tax_query'      => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
			array(
				'taxonomy' => 'bi_specialty',
				'operator' => 'NOT EXISTS',
			),
		),
	)
);

$panels = array();
foreach ( $specialties as $term ) {
	$ids = get_posts(
		array(
			'post_type'      => 'bi_doctor',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
			'tax_query'      => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				array(
					'taxonomy' => 'bi_specialty',
					'field'    => 'term_id',
					'terms'    => $term->term_id,
				),
			),
		)
	);
	if ( $ids ) {
		$panels[] = array(
			'slug'  => $term->slug,
			'name'  => $term->name,
			'items' => $ids,
		);
	}
}
if ( $unassigned ) {
	$panels[] = array(
		'slug'  => 'other',
		'name'  => __( 'Інші лікарі', 'beauty-institute' ),
		'items' => $unassigned,
	);
}

/**
 * Print one doctor card.
 *
 * @param int $doctor_id Doctor post ID.
 */
if ( ! function_exists( 'beauty_institute_doctor_card' ) ) :
function beauty_institute_doctor_card( $doctor_id ) {
	$photo_id = bi_image_id( function_exists( 'get_field' ) ? get_field( 'photo', $doctor_id ) : '' );
	if ( ! $photo_id ) {
		$photo_id = get_post_thumbnail_id( $doctor_id );
	}
	$photo_url = $photo_id ? wp_get_attachment_image_url( $photo_id, 'medium_large' ) : beauty_institute_asset( 'images/likari/estetychnyi_khirurh.webp' );
	$permalink = get_permalink( $doctor_id );

	$role = function_exists( 'get_field' ) ? trim( (string) get_field( 'role', $doctor_id ) ) : '';
	if ( '' === $role && function_exists( 'get_field' ) ) {
		$role = trim( (string) get_field( 'card_description', $doctor_id ) );
	}
	if ( '' === $role ) {
		$terms = get_the_terms( $doctor_id, 'bi_specialty' );
		if ( $terms && ! is_wp_error( $terms ) ) {
			$role = $terms[0]->name;
		}
	}
	?>
	<article class="estetychnyi_khirurh_card">
		<a class="estetychnyi_khirurh_photo" href="<?php echo esc_url( $permalink ); ?>" style="background-image: url('<?php echo esc_url( $photo_url ); ?>');"></a>
		<a class="estetychnyi_khirurh_info" href="<?php echo esc_url( $permalink ); ?>">
			<?php if ( '' !== $role ) : ?>
				<span class="estetychnyi_khirurh_role"><?php echo esc_html( $role ); ?></span>
			<?php endif; ?>
			<span class="estetychnyi_khirurh_name"><?php echo esc_html( get_the_title( $doctor_id ) ); ?></span>
		</a>
	</article>
	<?php
}
endif;
?>
<main class="likari">

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
			<h1 class="poslugi_title font_heading"><?php echo esc_html( $likari_title ? $likari_title : __( 'Наші лікарі', 'beauty-institute' ) ); ?></h1>
			<div class="poslugi_text">
				<div class="poslugi_desc">
					<?php
					echo $likari_intro
						? wp_kses_post( apply_filters( 'the_content', $likari_intro ) )
						: '<p>Наші лікарі — експерти, яким довіряють. Багаторічний досвід, постійне навчання, бездоганне володіння сучасними методами діагностики та лікування — основа нашої роботи.</p>';
					?>
				</div>
			</div>

			<?php if ( count( $panels ) > 1 ) : ?>
			<nav class="poslugi_tabs" aria-label="Наші лікарі" data-likari-tabs role="tablist">
				<?php foreach ( $panels as $index => $panel ) : ?>
					<button
						type="button"
						class="poslugi_tab<?php echo 0 === $index ? ' is_active' : ''; ?>"
						role="tab"
						id="likari-tab-<?php echo esc_attr( $panel['slug'] ); ?>"
						data-likari-tab="<?php echo esc_attr( $panel['slug'] ); ?>"
						aria-controls="likari-panel-<?php echo esc_attr( $panel['slug'] ); ?>"
						aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>"
						tabindex="<?php echo 0 === $index ? '0' : '-1'; ?>"
					><?php echo esc_html( $panel['name'] ); ?></button>
				<?php endforeach; ?>
			</nav>
			<?php endif; ?>
		</div>
	</section>

	<section class="estetychnyi_khirurh" aria-label="Список лікарів">
		<div class="container estetychnyi_khirurh_inner">
			<?php if ( $panels ) : ?>
			<div class="estetychnyi_khirurh_panels">
				<?php foreach ( $panels as $index => $panel ) : ?>
					<div
						class="estetychnyi_khirurh_panel<?php echo 0 === $index ? ' is_active' : ''; ?>"
						id="likari-panel-<?php echo esc_attr( $panel['slug'] ); ?>"
						role="tabpanel"
						data-likari-panel="<?php echo esc_attr( $panel['slug'] ); ?>"
						aria-labelledby="likari-tab-<?php echo esc_attr( $panel['slug'] ); ?>"
						aria-hidden="<?php echo 0 === $index ? 'false' : 'true'; ?>"
					>
						<div class="estetychnyi_khirurh_list">
							<?php
							foreach ( $panel['items'] as $doctor_id ) {
								beauty_institute_doctor_card( $doctor_id );
							}
							?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<?php else : ?>
				<p class="poslugi_desc"><?php esc_html_e( 'Лікарі зʼявляться тут найближчим часом.', 'beauty-institute' ); ?></p>
			<?php endif; ?>
		</div>
	</section>

</main>
<?php
get_footer();
