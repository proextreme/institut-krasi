<?php
/**
 * Single doctor (bi_doctor).
 *
 * @package beauty-institute
 */

get_header();

while ( have_posts() ) :
	the_post();

	$doctor_id = get_the_ID();
	$photo_id  = bi_image_id( bi_field( 'photo' ) );
	if ( ! $photo_id ) {
		$photo_id = get_post_thumbnail_id( $doctor_id );
	}
	$photo_url = $photo_id ? wp_get_attachment_image_url( $photo_id, 'large' ) : beauty_institute_asset( 'images/single_likar/trembach_inna.webp' );

	$spec_list = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) bi_field( 'specialization_list' ) ) ) );
	$serv_list = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) bi_field( 'services_list' ) ) ) );
	?>
<main class="single_likar">

	<nav class="breadcrumbs" aria-label="Хлібні крихти">
		<div class="container breadcrumbs_inner">
			<?php
			if ( function_exists( 'yoast_breadcrumb' ) ) {
				yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
			}
			?>
		</div>
	</nav>

	<section class="likar" aria-label="<?php the_title_attribute(); ?>">
		<div class="container likar_inner">
			<div class="likar_hero">
				<div
					class="likar_photo"
					style="background-image: url('<?php echo esc_url( $photo_url ); ?>');"
					role="img"
					aria-label="<?php the_title_attribute(); ?>"
				></div>
				<div class="likar_intro">
					<h1 class="likar_name"><?php the_title(); ?></h1>
					<div class="likar_posts">
						<div class="likar_post">
							<?php
							bi_wysiwyg( 'position', '<p>Директор медичного центру «Інститут краси».<br>Лікар-дерматолог вищої категорії.</p>' );
							?>
						</div>
						<?php $since = bi_field( 'since' ); ?>
						<?php if ( $since ) : ?>
							<p class="likar_since"><?php echo esc_html( $since ); ?></p>
						<?php endif; ?>
					</div>
					<div class="likar_bio">
						<?php
						$bio = bi_field( 'bio' );
						if ( $bio ) {
							bi_wysiwyg( 'bio' );
						} elseif ( get_the_content() ) {
							the_content();
						} else {
							echo '<p>Лікар із багаторічним досвідом у дерматології та медичній косметології.</p>';
						}
						?>
					</div>
				</div>
			</div>

			<?php if ( $spec_list || $serv_list ) : ?>
			<div class="likar_cols">
				<?php if ( $spec_list ) : ?>
				<div class="likar_col">
					<h2 class="likar_col_title">Спеціалізація:</h2>
					<ul class="likar_list">
						<?php foreach ( $spec_list as $item ) : ?>
							<li><?php echo esc_html( $item ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>
				<?php if ( $serv_list ) : ?>
				<div class="likar_col">
					<h2 class="likar_col_title">Послуги:</h2>
					<ul class="likar_list">
						<?php foreach ( $serv_list as $item ) : ?>
							<li><?php echo esc_html( $item ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php
			$certs = array();
			for ( $i = 1; $i <= 6; $i++ ) {
				$label = bi_field( "cert_{$i}_label" );
				if ( ! $label ) {
					continue;
				}
				$certs[] = array(
					'label' => $label,
					'year'  => bi_field( "cert_{$i}_year" ),
					'file'  => bi_field( "cert_{$i}_file" ),
				);
			}
			if ( $certs ) :
				?>
			<div class="likar_certs">
				<div class="likar_certs_head">
					<h2 class="likar_certs_title">Сертифікати та нагороди</h2>
					<p class="likar_certs_text"><?php bi_text( 'certs_intro', 'Підтвердження кваліфікації та постійного професійного розвитку лікаря.' ); ?></p>
				</div>
				<div class="likar_certs_list">
					<?php foreach ( $certs as $cert ) : ?>
						<a class="likar_cert" href="<?php echo esc_url( $cert['file'] ? $cert['file'] : '#' ); ?>"<?php echo $cert['file'] ? ' target="_blank" rel="noopener"' : ''; ?>>
							<span class="likar_cert_meta">
								<span class="likar_cert_label"><?php echo esc_html( $cert['label'] ); ?></span>
								<?php if ( $cert['year'] ) : ?>
									<span class="likar_cert_year"><?php echo esc_html( $cert['year'] ); ?></span>
								<?php endif; ?>
							</span>
							<span class="likar_cert_action">
								<span class="likar_cert_action_text">Переглянути</span>
								<span class="likar_cert_arrow" aria-hidden="true">
									<span class="likar_cert_arrow_line" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/single_likar/trembach_inna_1.svg' ) ); ?>');"></span>
									<span class="likar_cert_arrow_tip" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/single_likar/trembach_inna.svg' ) ); ?>');"></span>
								</span>
							</span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</section>

	<?php
	$reviews = get_posts(
		array(
			'post_type'      => 'bi_review',
			'post_status'    => 'publish',
			'posts_per_page' => 10,
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				array(
					'key'     => 'doctor',
					'value'   => $doctor_id,
					'compare' => '=',
				),
			),
		)
	);

	if ( $reviews ) :
		?>
	<section class="vidhuky" aria-label="Відгуки">
		<div class="container vidhuky_inner">
			<div class="vidhuky_slider" data-vidhuky-slider>
				<div class="vidhuky_viewport">
					<div class="vidhuky_track">
						<?php
						foreach ( $reviews as $review_id ) :
							$rev_photo = bi_image_id( get_field( 'photo', $review_id ) );
							$rev_src   = $rev_photo ? wp_get_attachment_image_url( $rev_photo, 'medium' ) : beauty_institute_asset( 'images/single/vydalennya_novoutvoren_review.webp' );
							?>
							<div class="vidhuky_slide">
								<div class="vidhuky_card">
									<div class="vidhuky_back" aria-hidden="true">
										<img class="vidhuky_decor vidhuky_decor_mob" src="<?php echo esc_url( beauty_institute_asset( 'images/zapysatys_na_mob_1.webp' ) ); ?>" alt="" width="134" height="152" decoding="async">
										<img class="vidhuky_decor vidhuky_decor_desk" src="<?php echo esc_url( beauty_institute_asset( 'images/zapysatys_na_1.webp' ) ); ?>" alt="" width="184" height="210" decoding="async">
									</div>
									<div class="vidhuky_content">
										<figure class="vidhuky_photo">
											<img class="vidhuky_photo_img" src="<?php echo esc_url( $rev_src ); ?>" alt="" width="280" height="280" loading="lazy" decoding="async">
										</figure>
										<div class="vidhuky_body">
											<img class="vidhuky_quot vidhuky_quot_start" src="<?php echo esc_url( beauty_institute_asset( 'images/single/vydalennya_novoutvoren_review_quot_1.svg' ) ); ?>" alt="" width="45" height="40" decoding="async" aria-hidden="true">
											<?php $rev_topic = get_field( 'topic', $review_id ); ?>
											<?php if ( $rev_topic ) : ?>
												<p class="vidhuky_topic"><?php echo esc_html( $rev_topic ); ?></p>
											<?php endif; ?>
											<div class="vidhuky_copy">
												<p class="vidhuky_name"><?php echo esc_html( get_field( 'author_name', $review_id ) ); ?></p>
												<p class="vidhuky_text"><?php echo esc_html( get_field( 'text', $review_id ) ); ?></p>
											</div>
											<img class="vidhuky_quot vidhuky_quot_end" src="<?php echo esc_url( beauty_institute_asset( 'images/single/vydalennya_novoutvoren_review_quot_2.svg' ) ); ?>" alt="" width="45" height="40" decoding="async" aria-hidden="true">
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="results_controls vidhuky_controls">
					<div class="results_dots" data-vidhuky-dots role="tablist" aria-label="Слайди відгуків"></div>
					<button class="results_next" type="button" data-vidhuky-next aria-label="Наступний відгук">
						<span class="results_next_icon" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right_nav.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right_nav.svg' ) ); ?>');" aria-hidden="true"></span>
					</button>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php beauty_institute_consult_section(); ?>

</main>
	<?php
endwhile;

get_footer();
