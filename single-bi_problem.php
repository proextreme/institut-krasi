<?php
/**
 * Single problem ("Що ми вирішуємо" detail).
 *
 * @package beauty-institute
 */

get_header();

while ( have_posts() ) :
	the_post();

	$problem_id = get_the_ID();
	$asset      = 'images/sho_vyrishuemo/';

	$hero_bg     = bi_image_id( bi_field( 'hero_bg' ) );
	$hero_bg_mob = bi_image_id( bi_field( 'hero_bg_mobile' ) );
	$hero_bg_url = $hero_bg ? wp_get_attachment_image_url( $hero_bg, 'full' ) : beauty_institute_asset( $asset . 'hero_bg.webp' );
	$hero_mob_url = $hero_bg_mob ? wp_get_attachment_image_url( $hero_bg_mob, 'large' ) : beauty_institute_asset( $asset . 'hero_bg_mob.webp' );

	$intro_img = bi_image_id( bi_field( 'intro_image' ) );
	$intro_src = $intro_img ? wp_get_attachment_image_url( $intro_img, 'large' ) : beauty_institute_asset( $asset . 'rozatsea_khronichne.webp' );

	$causes   = bi_parse_rows( bi_field( 'causes_list' ), 2 );
	$symptoms = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) bi_field( 'symptoms_list' ) ) ) );
	$stages   = bi_parse_rows( bi_field( 'stages_list' ), 2 );
	$services = bi_parse_rows( bi_field( 'treatment_services' ), 3 );

	$tr_img = bi_image_id( bi_field( 'treatment_image' ) );
	$tr_src = $tr_img ? wp_get_attachment_image_url( $tr_img, 'large' ) : beauty_institute_asset( $asset . 'likuvannya_pochynaietsya.webp' );
	?>
<main class="sho_vyrishuemo">

	<section class="rosazeva" aria-label="<?php the_title_attribute(); ?>">
		<span class="rosazeva_bg rosazeva_bg_mob" style="background-image: url('<?php echo esc_url( $hero_mob_url ); ?>');" aria-hidden="true"></span>
		<span class="rosazeva_bg rosazeva_bg_desk" style="background-image: url('<?php echo esc_url( $hero_bg_url ); ?>');" aria-hidden="true"></span>

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
			<h1 class="rosazeva_title font_heading"><?php echo wp_kses_post( bi_field( 'hero_title', get_the_title() ) ); ?></h1>
			<p class="rosazeva_text"><?php bi_text( 'hero_text', 'Хронічне запалення шкіри обличчя з почервонінням, судинними сіточками та висипом. Піддається ефективному лікуванню під наглядом лікаря.' ); ?></p>
		</div>
	</section>

	<section class="rozatsea_khronichne" aria-label="<?php the_title_attribute(); ?>">
		<div class="container rozatsea_khronichne_inner">
			<div class="rozatsea_khronichne_content">
				<h2 class="rozatsea_khronichne_title font_heading"><?php bi_text( 'intro_title', 'Розацеа — хронічне запалення центральної частини обличчя' ); ?></h2>
				<div class="rozatsea_khronichne_text">
					<?php
					bi_wysiwyg(
						'intro_text',
						'<p>Розацеа — це запальне захворювання шкіри, яке переважно вражає щоки, ніс, підборіддя та лоб. Має хвилеподібний перебіг: загострення чергуються з ремісіями.</p><p>На жаль, розацеа часто плутають з акне або алергічним почервонінням — і роками лікують неправильно. Тільки лікар-дерматолог може поставити точний діагноз та призначити ефективну терапію.</p>'
					);
					?>
				</div>
			</div>

			<div class="rozatsea_khronichne_media">
				<picture>
					<img class="rozatsea_khronichne_img" src="<?php echo esc_url( $intro_src ); ?>" alt="" width="582" height="523" loading="lazy" decoding="async">
				</picture>
			</div>
		</div>
	</section>

	<?php
	$types = array();
	for ( $i = 1; $i <= 4; $i++ ) {
		$t_title = bi_field( "type_{$i}_title" );
		if ( ! $t_title ) {
			continue;
		}
		$t_img       = bi_image_id( bi_field( "type_{$i}_image" ) );
		$types[]     = array(
			'title' => $t_title,
			'text'  => bi_field( "type_{$i}_text" ),
			'img'   => $t_img ? wp_get_attachment_image_url( $t_img, 'thumbnail' ) : beauty_institute_asset( $asset . '01.webp' ),
		);
	}
	$has_details = $types || $causes || $symptoms || $stages || bi_field( 'note_text' );
	if ( $has_details ) :
		?>
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
							<img class="view_01_card_photo" src="<?php echo esc_url( $type['img'] ); ?>" alt="" width="100" height="100" loading="lazy" decoding="async">
							<div class="view_01_card_body">
								<h3 class="view_01_card_title"><?php echo esc_html( $type['title'] ); ?></h3>
								<p class="view_01_card_text"><?php echo esc_html( $type['text'] ); ?></p>
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
							<p class="view_01_card_text"><?php echo esc_html( $cause[1] ); ?></p>
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
								<p class="view_01_card_text"><?php echo esc_html( $stage[1] ); ?></p>
							</div>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
			<?php endif; ?>

			<?php if ( bi_field( 'note_text' ) ) : ?>
			<div class="view_01_note">
				<p class="view_01_note_title"><?php bi_text( 'note_title', 'Важливо знати!' ); ?></p>
				<p class="view_01_note_text"><?php bi_text( 'note_text' ); ?></p>
			</div>
			<?php endif; ?>
		</div>
	</section>
	<?php endif; ?>

	<section class="likuvannya_pochynaietsya" aria-label="Лікування">
		<div class="container likuvannya_pochynaietsya_inner">
			<div class="likuvannya_pochynaietsya_head">
				<div class="likuvannya_pochynaietsya_media">
					<picture>
						<img class="likuvannya_pochynaietsya_img" src="<?php echo esc_url( $tr_src ); ?>" alt="" width="582" height="300" loading="lazy" decoding="async">
					</picture>
				</div>

				<div class="likuvannya_pochynaietsya_content">
					<h2 class="likuvannya_pochynaietsya_title font_heading"><?php bi_text( 'treatment_title', 'Лікування починається з діагнозу' ); ?></h2>
					<div class="likuvannya_pochynaietsya_text">
						<?php
						bi_wysiwyg(
							'treatment_text',
							'<p>В Інституті Краси лікування завжди починається з консультації лікаря-дерматолога. Лікар встановлює тип і стадію захворювання, виявляє тригери та підбирає індивідуальну програму терапії.</p>'
						);
						?>
					</div>
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
								<span class="likuvannya_pochynaietsya_item_text"><?php echo esc_html( $service[1] ); ?></span>
							</span>
							<span class="likuvannya_pochynaietsya_item_arrow" aria-hidden="true"></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>
	</section>

	<?php
	$doctors = beauty_institute_home_query( 'doctors', 'bi_doctor', 6 );
	if ( $doctors ) :
		?>
	<section class="likari" aria-label="Лікарі">
		<div class="container likari_inner">
			<div class="likari_head">
				<h2 class="likari_title font_heading"><?php bi_text( 'doctors_title', 'Лікарі' ); ?></h2>
				<p class="likari_subtitle"><?php bi_text( 'doctors_subtitle', 'Наші лікарі ведуть прийом щоденно. Консультація включає огляд, постановку діагнозу та призначення індивідуального плану лікування.' ); ?></p>
			</div>
			<div class="likari_list">
				<?php
				foreach ( $doctors as $doc_id ) :
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

	<?php
	$reviews = beauty_institute_home_query( 'reviews', 'bi_review', 10 );
	if ( $reviews ) :
		?>
	<section class="vidhuky" aria-label="Відгуки">
		<div class="container vidhuky_inner">
			<div class="vidhuky_slider" data-vidhuky-slider>
				<div class="vidhuky_viewport">
					<div class="vidhuky_track">
						<?php
						foreach ( $reviews as $rev_id ) :
							$r_img = bi_image_id( get_field( 'photo', $rev_id ) );
							$r_src = $r_img ? wp_get_attachment_image_url( $r_img, 'medium' ) : beauty_institute_asset( 'images/single/vydalennya_novoutvoren_review.webp' );
							?>
							<div class="vidhuky_slide">
								<div class="vidhuky_card">
									<div class="vidhuky_back" aria-hidden="true">
										<img class="vidhuky_decor vidhuky_decor_mob" src="<?php echo esc_url( beauty_institute_asset( 'images/zapysatys_na_mob_1.webp' ) ); ?>" alt="" width="134" height="152" decoding="async">
										<img class="vidhuky_decor vidhuky_decor_desk" src="<?php echo esc_url( beauty_institute_asset( 'images/zapysatys_na_1.webp' ) ); ?>" alt="" width="184" height="210" decoding="async">
									</div>
									<div class="vidhuky_content">
										<figure class="vidhuky_photo">
											<img class="vidhuky_photo_img" src="<?php echo esc_url( $r_src ); ?>" alt="" width="280" height="280" loading="lazy" decoding="async">
										</figure>
										<div class="vidhuky_body">
											<img class="vidhuky_quot vidhuky_quot_start" src="<?php echo esc_url( beauty_institute_asset( 'images/single/vydalennya_novoutvoren_review_quot_1.svg' ) ); ?>" alt="" width="45" height="40" decoding="async" aria-hidden="true">
											<?php $r_topic = (string) get_field( 'service', $rev_id ); ?>
											<?php if ( '' === $r_topic ) { $r_topic = (string) get_field( 'title', $rev_id ); } ?>
											<?php if ( '' !== $r_topic ) : ?><p class="vidhuky_topic"><?php echo esc_html( $r_topic ); ?></p><?php endif; ?>
											<div class="vidhuky_copy">
												<p class="vidhuky_name"><?php echo esc_html( (string) get_field( 'author_name', $rev_id ) ); ?></p>
												<p class="vidhuky_text"><?php echo esc_html( (string) get_field( 'text', $rev_id ) ); ?></p>
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

	<?php
	$results = beauty_institute_home_query( 'results', 'bi_result', 12 );
	if ( $results ) :
		?>
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
					<?php
					foreach ( $results as $res_id ) :
						$res_img = bi_image_id( get_field( 'image', $res_id ) );
						if ( ! $res_img ) {
							$res_img = get_post_thumbnail_id( $res_id );
						}
						$res_src = $res_img ? wp_get_attachment_image_url( $res_img, 'large' ) : beauty_institute_asset( $asset . 'do_ta_pislya_1.webp' );
						?>
						<div class="do_ta_pislya_slide">
							<div class="do_ta_pislya_photo">
								<img class="do_ta_pislya_img" src="<?php echo esc_url( $res_src ); ?>" alt="" loading="lazy" decoding="async">
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="results_controls do_ta_pislya_controls">
				<div class="results_dots" data-do-ta-pislya-dots role="tablist" aria-label="Слайди до та після"></div>
				<button class="results_next" type="button" data-do-ta-pislya-next aria-label="Наступний слайд">
					<span class="results_next_icon" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right_nav.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right_nav.svg' ) ); ?>');" aria-hidden="true"></span>
				</button>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php beauty_institute_consult_section(); ?>

</main>
	<?php
endwhile;

get_footer();
