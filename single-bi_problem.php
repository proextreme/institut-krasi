<?php
/**
 * Single "Запит" (bi_problem) — the "Що ми вирішуємо" layout, one record per request.
 *
 * Markup and CSS classes are the same as sho_vyrishuemo.php. The difference is
 * the content rule: every block is rendered only when its fields are filled,
 * so an unfinished request never shows another request's text.
 *
 * @package beauty-institute
 */

get_header();

while ( have_posts() ) :
	the_post();
endwhile;

$asset = 'images/sho_vyrishuemo/';

// Hero: own background → the record's featured image → plain brand colour.
$thumb_id    = get_post_thumbnail_id();
$hero_bg     = bi_image_id( bi_field( 'hero_bg' ) );
$hero_bg_mob = bi_image_id( bi_field( 'hero_bg_mobile' ) );
$hero_id     = $hero_bg ? $hero_bg : $thumb_id;
$hero_url    = $hero_id ? wp_get_attachment_image_url( $hero_id, 'full' ) : '';
$hero_mob    = $hero_bg_mob ? wp_get_attachment_image_url( $hero_bg_mob, 'large' ) : $hero_url;

$hero_title = bi_field( 'hero_title', get_the_title() );
$hero_text  = bi_field( 'hero_text', bi_field( 'lead' ) );

// Intro.
$intro_title = bi_field( 'intro_title' );
$intro_text  = bi_field( 'intro_text' );
$intro_id    = bi_image_id( bi_field( 'intro_image' ) );
$intro_src   = wp_get_attachment_image_url( $intro_id ? $intro_id : $thumb_id, 'large' );

// Details.
$types = array();
for ( $i = 1; $i <= 4; $i++ ) {
	$t_title = bi_field( "type_{$i}_title" );
	if ( ! $t_title ) {
		continue;
	}
	$t_img   = bi_image_id( bi_field( "type_{$i}_image" ) );
	$types[] = array(
		'title' => $t_title,
		'text'  => bi_field( "type_{$i}_text" ),
		'img'   => $t_img ? wp_get_attachment_image_url( $t_img, 'thumbnail' ) : '',
	);
}

$causes   = bi_parse_rows( bi_field( 'causes_list' ), 2 );
$symptoms = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) bi_field( 'symptoms_list' ) ) ) );
$stages   = bi_parse_rows( bi_field( 'stages_list' ), 2 );
$note     = bi_field( 'note_text' );

$has_intro   = $intro_title || $intro_text;
$has_details = $types || $causes || $symptoms || $stages || $note;

// Treatment.
$tr_title  = bi_field( 'treatment_title' );
$tr_text   = bi_field( 'treatment_text' );
$tr_id     = bi_image_id( bi_field( 'treatment_image' ) );
$tr_src    = $tr_id ? wp_get_attachment_image_url( $tr_id, 'large' ) : '';
$services  = bi_parse_rows( bi_field( 'treatment_services' ), 3 );
$has_treat = $tr_title || $tr_text || $services;

// Doctors, reviews, before/after.
$doctors = bi_field( 'doctors', array() );

$reviews = array();
for ( $i = 1; $i <= 3; $i++ ) {
	$r_text = bi_field( "review_{$i}_text" );
	if ( ! $r_text ) {
		continue;
	}
	$r_img     = bi_image_id( bi_field( "review_{$i}_photo" ) );
	$reviews[] = array(
		'topic' => bi_field( "review_{$i}_topic" ),
		'name'  => bi_field( "review_{$i}_name" ),
		'text'  => $r_text,
		'img'   => $r_img ? wp_get_attachment_image_url( $r_img, 'medium_large' ) : beauty_institute_asset( 'images/single/vydalennya_novoutvoren_review.webp' ),
	);
}

$results = array();
for ( $i = 1; $i <= 6; $i++ ) {
	$rid = bi_image_id( bi_field( "result_{$i}" ) );
	if ( $rid ) {
		$results[] = wp_get_attachment_image_url( $rid, 'large' );
	}
}

$arrow_nav = beauty_institute_asset( 'images/arrow_right_nav.svg' );
?>
<main class="sho_vyrishuemo">

	<section class="rosazeva" aria-label="<?php the_title_attribute(); ?>">
		<?php if ( $hero_mob ) : ?>
			<span class="rosazeva_bg rosazeva_bg_mob" style="background-image: url('<?php echo esc_url( $hero_mob ); ?>');" aria-hidden="true"></span>
		<?php endif; ?>
		<?php if ( $hero_url ) : ?>
			<span class="rosazeva_bg rosazeva_bg_desk" style="background-image: url('<?php echo esc_url( $hero_url ); ?>');" aria-hidden="true"></span>
		<?php endif; ?>

		<nav class="breadcrumbs" aria-label="Хлібні крихти">
			<div class="container breadcrumbs_inner">
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) ) {
					yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
				}
				?>
			</div>
		</nav>

		<div class="container rosazeva_inner">
			<h1 class="rosazeva_title font_heading"><?php echo wp_kses_post( $hero_title ); ?></h1>
			<?php if ( $hero_text ) : ?>
				<p class="rosazeva_text"><?php echo esc_html( $hero_text ); ?></p>
			<?php endif; ?>
		</div>
	</section>

	<?php if ( $has_intro ) : ?>
	<section class="rozatsea_khronichne" aria-label="Опис">
		<div class="container rozatsea_khronichne_inner">
			<div class="rozatsea_khronichne_content">
				<?php if ( $intro_title ) : ?>
					<h2 class="rozatsea_khronichne_title font_heading"><?php echo esc_html( $intro_title ); ?></h2>
				<?php endif; ?>
				<?php if ( $intro_text ) : ?>
					<div class="rozatsea_khronichne_text"><?php bi_wysiwyg( 'intro_text' ); ?></div>
				<?php endif; ?>
			</div>

			<?php if ( $intro_src ) : ?>
				<div class="rozatsea_khronichne_media">
					<picture>
						<img class="rozatsea_khronichne_img" src="<?php echo esc_url( $intro_src ); ?>" alt="" width="582" height="523" loading="lazy" decoding="async">
					</picture>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( $has_details ) : ?>
	<section class="view_01" aria-label="Деталі">
		<div class="container view_01_inner">
			<?php if ( $types ) : ?>
			<div class="view_01_block">
				<div class="view_01_head">
					<h2 class="view_01_title"><?php bi_text( 'types_title', 'Типи' ); ?></h2>
					<?php if ( bi_field( 'types_lead' ) ) : ?><p class="view_01_lead"><?php bi_text( 'types_lead' ); ?></p><?php endif; ?>
				</div>
				<ul class="view_01_grid view_01_grid_types">
					<?php foreach ( $types as $type ) : ?>
						<li class="view_01_card view_01_card_type">
							<?php if ( $type['img'] ) : ?>
								<img class="view_01_card_photo" src="<?php echo esc_url( $type['img'] ); ?>" alt="" width="100" height="100" loading="lazy" decoding="async">
							<?php endif; ?>
							<div class="view_01_card_body">
								<h3 class="view_01_card_title"><?php echo esc_html( $type['title'] ); ?></h3>
								<?php if ( $type['text'] ) : ?><p class="view_01_card_text"><?php echo esc_html( $type['text'] ); ?></p><?php endif; ?>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>

			<?php if ( $causes ) : ?>
			<div class="view_01_block">
				<div class="view_01_head"><h2 class="view_01_title"><?php bi_text( 'causes_title', 'Причини та тригери' ); ?></h2></div>
				<ul class="view_01_grid view_01_grid_causes">
					<?php foreach ( $causes as $cause ) : ?>
						<li class="view_01_card view_01_card_cause">
							<h3 class="view_01_card_title"><?php echo esc_html( $cause[0] ); ?></h3>
							<?php if ( $cause[1] ) : ?><p class="view_01_card_text"><?php echo esc_html( $cause[1] ); ?></p><?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>

			<?php if ( $symptoms ) : ?>
			<div class="view_01_block">
				<div class="view_01_head"><h2 class="view_01_title"><?php bi_text( 'symptoms_title', 'Симптоми' ); ?></h2></div>
				<ul class="view_01_grid view_01_grid_symptoms">
					<?php foreach ( $symptoms as $symptom ) : ?>
						<li class="view_01_card view_01_card_symptom"><p class="view_01_card_text"><?php echo esc_html( $symptom ); ?></p></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>

			<?php if ( $stages ) : ?>
			<div class="view_01_block">
				<div class="view_01_head"><h2 class="view_01_title"><?php bi_text( 'stages_title', 'Стадії розвитку' ); ?></h2></div>
				<ol class="view_01_grid view_01_grid_stages">
					<?php foreach ( $stages as $index => $stage ) : ?>
						<li class="view_01_stage">
							<span class="view_01_stage_num" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
							<div class="view_01_stage_body">
								<h3 class="view_01_card_title"><?php echo esc_html( $stage[0] ); ?></h3>
								<?php if ( $stage[1] ) : ?><p class="view_01_card_text"><?php echo esc_html( $stage[1] ); ?></p><?php endif; ?>
							</div>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
			<?php endif; ?>

			<?php if ( $note ) : ?>
			<div class="view_01_note">
				<p class="view_01_note_title"><?php bi_text( 'note_title', 'Важливо знати!' ); ?></p>
				<p class="view_01_note_text"><?php echo esc_html( $note ); ?></p>
			</div>
			<?php endif; ?>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( $has_treat ) : ?>
	<section class="likuvannya_pochynaietsya" aria-label="Лікування">
		<div class="container likuvannya_pochynaietsya_inner">
			<div class="likuvannya_pochynaietsya_head">
				<?php if ( $tr_src ) : ?>
					<div class="likuvannya_pochynaietsya_media">
						<picture>
							<img class="likuvannya_pochynaietsya_img" src="<?php echo esc_url( $tr_src ); ?>" alt="" width="582" height="300" loading="lazy" decoding="async">
						</picture>
					</div>
				<?php endif; ?>

				<div class="likuvannya_pochynaietsya_content">
					<?php if ( $tr_title ) : ?>
						<h2 class="likuvannya_pochynaietsya_title font_heading"><?php echo esc_html( $tr_title ); ?></h2>
					<?php endif; ?>
					<?php if ( $tr_text ) : ?>
						<div class="likuvannya_pochynaietsya_text"><?php bi_wysiwyg( 'treatment_text' ); ?></div>
					<?php endif; ?>
					<?php if ( $services ) : ?><p class="likuvannya_pochynaietsya_label"><?php bi_text( 'treatment_label', 'Послуги, які ми радимо:' ); ?></p><?php endif; ?>
				</div>
			</div>

			<?php if ( $services ) : ?>
			<ul class="likuvannya_pochynaietsya_list">
				<?php foreach ( $services as $service ) : ?>
					<li>
						<a class="likuvannya_pochynaietsya_item" href="<?php echo esc_url( $service[2] ? $service[2] : home_url( '/#consult' ) ); ?>">
							<span class="likuvannya_pochynaietsya_item_body">
								<span class="likuvannya_pochynaietsya_item_title"><?php echo esc_html( $service[0] ); ?></span>
								<?php if ( $service[1] ) : ?><span class="likuvannya_pochynaietsya_item_text"><?php echo esc_html( $service[1] ); ?></span><?php endif; ?>
							</span>
							<span class="likuvannya_pochynaietsya_item_arrow" aria-hidden="true"></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( is_array( $doctors ) && $doctors ) : ?>
	<section class="likari" aria-label="Лікарі">
		<div class="container likari_inner">
			<div class="likari_head">
				<h2 class="likari_title font_heading"><?php bi_text( 'doctors_title', 'Лікарі' ); ?></h2>
				<?php if ( bi_field( 'doctors_subtitle' ) ) : ?><p class="likari_subtitle"><?php bi_text( 'doctors_subtitle' ); ?></p><?php endif; ?>
			</div>
			<div class="likari_list">
				<?php
				foreach ( $doctors as $doc_id ) :
					$doc_id = (int) ( is_object( $doc_id ) ? $doc_id->ID : $doc_id );
					if ( ! $doc_id ) {
						continue;
					}
					$d_img = bi_image_id( get_field( 'photo', $doc_id ) );
					if ( ! $d_img ) {
						$d_img = get_post_thumbnail_id( $doc_id );
					}
					$d_src  = $d_img ? wp_get_attachment_image_url( $d_img, 'medium_large' ) : beauty_institute_asset( $asset . 'likari.webp' );
					$d_role = (string) get_field( 'role', $doc_id );
					if ( '' === $d_role ) {
						$d_role = (string) get_field( 'card_description', $doc_id );
					}
					?>
					<article class="likari_card">
						<a class="likari_photo" href="<?php echo esc_url( get_permalink( $doc_id ) ); ?>">
							<picture><img class="likari_photo_img" src="<?php echo esc_url( $d_src ); ?>" alt="" width="300" height="366" loading="lazy" decoding="async"></picture>
						</a>
						<a class="likari_info" href="<?php echo esc_url( get_permalink( $doc_id ) ); ?>">
							<?php if ( '' !== $d_role ) : ?><span class="likari_role"><?php echo esc_html( $d_role ); ?></span><?php endif; ?>
							<span class="likari_name"><?php echo esc_html( get_the_title( $doc_id ) ); ?></span>
						</a>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( $reviews ) : ?>
	<section class="vidhuky" aria-label="Відгуки">
		<div class="container vidhuky_inner">
			<div class="vidhuky_slider" data-vidhuky-slider>
				<div class="vidhuky_viewport">
					<div class="vidhuky_track">
						<?php foreach ( $reviews as $review ) : ?>
							<div class="vidhuky_slide">
								<div class="vidhuky_card">
									<div class="vidhuky_back" aria-hidden="true">
										<img class="vidhuky_decor vidhuky_decor_mob" src="<?php echo esc_url( beauty_institute_asset( 'images/zapysatys_na_mob_1.webp' ) ); ?>" alt="" width="134" height="152" decoding="async">
										<img class="vidhuky_decor vidhuky_decor_desk" src="<?php echo esc_url( beauty_institute_asset( 'images/zapysatys_na_1.webp' ) ); ?>" alt="" width="184" height="210" decoding="async">
									</div>
									<div class="vidhuky_content">
										<figure class="vidhuky_photo">
											<img class="vidhuky_photo_img" src="<?php echo esc_url( $review['img'] ); ?>" alt="" width="280" height="280" loading="lazy" decoding="async">
										</figure>
										<div class="vidhuky_body">
											<img class="vidhuky_quot vidhuky_quot_start" src="<?php echo esc_url( beauty_institute_asset( 'images/single/vydalennya_novoutvoren_review_quot_1.svg' ) ); ?>" alt="" width="45" height="40" decoding="async" aria-hidden="true">
											<?php if ( $review['topic'] ) : ?><p class="vidhuky_topic"><?php echo esc_html( $review['topic'] ); ?></p><?php endif; ?>
											<div class="vidhuky_copy">
												<?php if ( $review['name'] ) : ?><p class="vidhuky_name"><?php echo esc_html( $review['name'] ); ?></p><?php endif; ?>
												<p class="vidhuky_text"><?php echo esc_html( $review['text'] ); ?></p>
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
						<span class="results_next_icon" style="mask-image: url('<?php echo esc_url( $arrow_nav ); ?>'); -webkit-mask-image: url('<?php echo esc_url( $arrow_nav ); ?>');" aria-hidden="true"></span>
					</button>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( $results ) : ?>
	<section class="do_ta_pislya" id="results" aria-label="До та після">
		<div class="container do_ta_pislya_head">
			<h2 class="do_ta_pislya_title font_heading"><?php bi_text( 'results_title', 'До та після' ); ?></h2>
			<div class="do_ta_pislya_head_aside">
				<p class="do_ta_pislya_intro"><?php bi_text( 'results_intro', 'Наші результати підкреслюють ваші індивідуальні риси.' ); ?></p>
			</div>
		</div>

		<div class="container do_ta_pislya_slider" data-do-ta-pislya-slider>
			<div class="do_ta_pislya_viewport">
				<div class="do_ta_pislya_track">
					<?php foreach ( $results as $result_src ) : ?>
						<div class="do_ta_pislya_slide">
							<div class="do_ta_pislya_photo">
								<img class="do_ta_pislya_img" src="<?php echo esc_url( $result_src ); ?>" alt="" loading="lazy" decoding="async">
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="results_controls do_ta_pislya_controls">
				<div class="results_dots" data-do-ta-pislya-dots role="tablist" aria-label="Слайди до та після"></div>
				<button class="results_next" type="button" data-do-ta-pislya-next aria-label="Наступний слайд">
					<span class="results_next_icon" style="mask-image: url('<?php echo esc_url( $arrow_nav ); ?>'); -webkit-mask-image: url('<?php echo esc_url( $arrow_nav ); ?>');" aria-hidden="true"></span>
				</button>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php beauty_institute_consult_section(); ?>

</main>
<?php
get_footer();
