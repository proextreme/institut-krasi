<?php
/**
 * Template Name: Reviews
 *
 * @package beauty-institute
 */

get_header();

$reviews_title = '';
while ( have_posts() ) :
	the_post();
	$reviews_title = get_the_title();
endwhile;

$text_reviews = get_posts(
	array(
		'post_type'      => 'bi_review',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'no_found_rows'  => true,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
		'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			'relation' => 'OR',
			array( 'key' => 'is_video', 'compare' => 'NOT EXISTS' ),
			array( 'key' => 'is_video', 'value' => '1', 'compare' => '!=' ),
		),
	)
);

$video_reviews = get_posts(
	array(
		'post_type'      => 'bi_review',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'no_found_rows'  => true,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
		'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			array( 'key' => 'is_video', 'value' => '1', 'compare' => '=' ),
		),
	)
);

/**
 * Print one text-review card.
 *
 * @param int $review_id Review post ID.
 */
if ( ! function_exists( 'beauty_institute_review_card' ) ) :
function beauty_institute_review_card( $review_id ) {
	$tags = array();
	$service = (string) get_field( 'service', $review_id );
	if ( '' !== $service ) {
		$tags[] = $service;
	}
	foreach ( (array) get_field( 'doctors', $review_id ) as $doctor_id ) {
		$tags[] = beauty_institute_doctor_short_name( (int) $doctor_id );
	}
	?>
	<article class="onovlenyi_prostir_card" data-review-item>
		<div class="onovlenyi_prostir_top">
			<span class="onovlenyi_prostir_quote" aria-hidden="true"></span>
			<?php if ( $tags ) : ?>
			<div class="onovlenyi_prostir_tags">
				<?php foreach ( $tags as $tag ) : ?>
					<span class="onovlenyi_prostir_tag"><?php echo esc_html( $tag ); ?></span>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>
		<?php $title = (string) get_field( 'title', $review_id ); ?>
		<?php if ( '' !== $title ) : ?>
			<h3 class="onovlenyi_prostir_title"><?php echo esc_html( $title ); ?></h3>
		<?php endif; ?>
		<p class="onovlenyi_prostir_text"><?php echo esc_html( (string) get_field( 'text', $review_id ) ); ?></p>
		<p class="onovlenyi_prostir_author"><?php echo esc_html( (string) get_field( 'author_name', $review_id ) ); ?></p>
	</article>
	<?php
}
endif;
?>
<main class="reviews">

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
			<h1 class="poslugi_title font_heading"><?php echo esc_html( $reviews_title ? $reviews_title : __( 'Відгуки', 'beauty-institute' ) ); ?></h1>
			<div class="poslugi_text">
				<p class="poslugi_desc"><?php bi_text( 'hero_desc', 'Ми щодня працюємо над тим, щоб поєднувати високий рівень медичних послуг, турботу про пацієнтів та атмосферу комфорту в Інституті краси. Щиро дякуємо вам за теплі слова та довіру. Для нас дуже цінні ваші відгуки, адже саме вони допомагають нам ставати ще кращими. Дякуємо, що обираєте Інститут краси.' ); ?></p>
			</div>
		</div>
	</section>

	<section class="onovlenyi_prostir" aria-label="Відгуки пацієнтів">
		<div class="container onovlenyi_prostir_inner">
			<div class="onovlenyi_prostir_list" data-reviews-list>
				<?php
				if ( $text_reviews ) {
					foreach ( $text_reviews as $review_id ) {
						beauty_institute_review_card( $review_id );
					}
				} else {
					$demo = array(
						array( 'Консультація косметолога', 'Трембач О.М.', 'Турбота та професіоналізм', 'Приємний, ввічливий і дуже уважний лікар – Трембач Олександр Михайлович. Ціни дуже приємні у порівнянні з іншими медичними центрами. Велике дякую Інституту краси та лікареві за добрі руки та професіоналізм на вищому рівні', 'Олена Боднар' ),
						array( 'Гідродаймонд (Zemits)', 'Трембач І.О.', 'Результат після першої процедури', 'Я шокована результатами доглядових процедур на апаратах Zemits. Шкіра стала настільки чистою та підтягнутою, вирівнявся рельєф. Результат отримала після першого разу!', 'Тетяна Горлушко' ),
						array( 'Видалення бородавок і папілом', 'Наконечна К.М.', 'Уважні лікарі та чудовий результат', 'Рекомендую чудових лікарів: справді лікарі вищої категорії, уважні, спокійні та доброзичливі. Результат – чисті і доглянуті ніжки! Я дуже задоволена!', 'Ірина Крутко' ),
						array( 'Загальний огляд інституту', '', 'Оновлений простір краси та комфорту', 'На новому місці Інститут краси став ще кращий, нові кабінети, свіжий ремонт, атмосфера чистоти та затишку і звісно професіоналізм лікарів на вищому рівні!', 'Валентина Анопрієнко' ),
						array( 'Кругова підтяжка обличчя', 'Трембач О.М.', 'Лікар, якому довіряють роками', 'Зробила ще одну хірургічну операцію і сто процентів залишилась задоволена результатом. Реабілітація пройшла дуже швидко і практично безболісно. Він найкращій хірург в Україні!', 'Софія Михайленко' ),
						array( 'Стоматологія', '', 'Сучасна стоматологія без болю', 'Зробила професійну чистку зубів, лікар уважно вислухав всі мої побажання та зробив все без болю. Сучасне обладнання, новий ремонт, стерилізація, все на вищому рівні!', 'Олена Мельник' ),
					);
					foreach ( $demo as $d ) {
						?>
						<article class="onovlenyi_prostir_card" data-review-item>
							<div class="onovlenyi_prostir_top">
								<span class="onovlenyi_prostir_quote" aria-hidden="true"></span>
								<div class="onovlenyi_prostir_tags">
									<span class="onovlenyi_prostir_tag"><?php echo esc_html( $d[0] ); ?></span>
									<?php if ( $d[1] ) : ?><span class="onovlenyi_prostir_tag"><?php echo esc_html( $d[1] ); ?></span><?php endif; ?>
								</div>
							</div>
							<h3 class="onovlenyi_prostir_title"><?php echo esc_html( $d[2] ); ?></h3>
							<p class="onovlenyi_prostir_text"><?php echo esc_html( $d[3] ); ?></p>
							<p class="onovlenyi_prostir_author"><?php echo esc_html( $d[4] ); ?></p>
						</article>
						<?php
					}
				}
				?>
			</div>
			<button type="button" class="onovlenyi_prostir_more" data-reviews-more>
				<span class="onovlenyi_prostir_more_text"><?php esc_html_e( 'Завантажити ще відгуки', 'beauty-institute' ); ?></span>
				<span class="onovlenyi_prostir_more_icon" aria-hidden="true"></span>
			</button>
		</div>
	</section>

	<?php
	$video_count = $video_reviews ? count( $video_reviews ) : 2;
	$is_slider   = $video_count >= 3;
	?>
	<section class="videovidhuky" aria-label="Відеовідгуки">
		<div class="videovidhuky_head">
			<span class="videovidhuky_decor" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/reviews/reviews_video_decor.webp' ) ); ?>');" aria-hidden="true"></span>
			<div class="container videovidhuky_intro">
				<h2 class="videovidhuky_title font_heading"><?php bi_text( 'videos_title', 'Відеовідгуки' ); ?></h2>
				<p class="videovidhuky_text"><?php bi_text( 'videos_text', 'Реальні історії, щирі емоції та результати, якими хочеться ділитися. Дякуємо нашим пацієнтам за довіру та теплі слова про Інститут краси.' ); ?></p>
			</div>
		</div>

		<div class="container videovidhuky_media">
			<div class="videovidhuky_slider<?php echo $is_slider ? ' is_slider' : ''; ?>"<?php echo $is_slider ? ' data-videovidhuky-slider' : ''; ?>>
				<div class="videovidhuky_list">
					<?php
					if ( $video_reviews ) {
						foreach ( $video_reviews as $review_id ) {
							$yt      = beauty_institute_youtube_id( (string) get_field( 'video_url', $review_id ) );
							$poster  = bi_image_id( get_field( 'video_poster', $review_id ) );
							if ( ! $poster ) {
								$poster = get_post_thumbnail_id( $review_id );
							}
							$src     = $poster ? wp_get_attachment_image_url( $poster, 'large' ) : beauty_institute_asset( 'images/reviews/videovidhuky.webp' );
							$name    = (string) get_field( 'author_name', $review_id );
							$service = (string) get_field( 'service', $review_id );
							$title   = (string) get_field( 'title', $review_id );
							$meta    = trim( $service . ( $service && $title ? ' - ' : '' ) . $title );
							?>
							<article class="videovidhuky_card">
								<img class="videovidhuky_img" src="<?php echo esc_url( $src ); ?>" alt="" width="615" height="468" loading="lazy" decoding="async">
								<?php if ( $yt ) : ?>
								<button type="button" class="videovidhuky_play" data-video-open data-youtube-id="<?php echo esc_attr( $yt ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Дивитися відеовідгук: %s', 'beauty-institute' ), $name ) ); ?>">
									<span class="videovidhuky_play_icon" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/reviews/videovidhuky.svg' ) ); ?>');" aria-hidden="true"></span>
								</button>
								<?php endif; ?>
								<div class="videovidhuky_caption">
									<p class="videovidhuky_name"><?php echo esc_html( $name ); ?></p>
									<?php if ( '' !== $meta ) : ?>
										<p class="videovidhuky_meta"><?php echo esc_html( $meta ); ?></p>
									<?php endif; ?>
								</div>
							</article>
							<?php
						}
					} else {
						for ( $i = 0; $i < 2; $i++ ) :
							$suffix = $i ? '_' . $i : '';
							?>
							<article class="videovidhuky_card">
								<img class="videovidhuky_img" src="<?php echo esc_url( beauty_institute_asset( 'images/reviews/videovidhuky' . $suffix . '.webp' ) ); ?>" alt="" width="615" height="468" loading="lazy" decoding="async">
								<button type="button" class="videovidhuky_play" data-video-open data-youtube-id="rAx1qYtXI28" aria-label="Дивитися відеовідгук">
									<span class="videovidhuky_play_icon" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/reviews/videovidhuky' . $suffix . '.svg' ) ); ?>');" aria-hidden="true"></span>
								</button>
								<div class="videovidhuky_caption">
									<p class="videovidhuky_name">Олена Боднар</p>
									<p class="videovidhuky_meta">Консультація косметолога - Турбота та професіоналізм</p>
								</div>
							</article>
							<?php
						endfor;
					}
					?>
				</div>

				<?php if ( $is_slider ) : ?>
				<div class="videovidhuky_nav" aria-hidden="true">
					<button type="button" class="videovidhuky_arrow videovidhuky_arrow_prev" data-videovidhuky-prev aria-label="<?php esc_attr_e( 'Попередній', 'beauty-institute' ); ?>">
						<span class="videovidhuky_arrow_icon" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right_nav.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right_nav.svg' ) ); ?>');"></span>
					</button>
					<button type="button" class="videovidhuky_arrow videovidhuky_arrow_next" data-videovidhuky-next aria-label="<?php esc_attr_e( 'Наступний', 'beauty-institute' ); ?>">
						<span class="videovidhuky_arrow_icon" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right_nav.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right_nav.svg' ) ); ?>');"></span>
					</button>
				</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="videovidhuky_modal" data-video-modal hidden>
			<div class="videovidhuky_modal_backdrop" data-video-modal-close tabindex="-1"></div>
			<div class="videovidhuky_modal_dialog" role="dialog" aria-modal="true" aria-label="Відеовідгук">
				<button type="button" class="videovidhuky_modal_close" data-video-modal-close aria-label="Закрити відео"></button>
				<div class="videovidhuky_modal_frame">
					<iframe class="videovidhuky_modal_iframe" data-video-iframe title="Відеовідгук" src="" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</section>

	<?php if ( $is_slider ) : ?>
	<style>
		.videovidhuky_slider.is_slider { position: relative; }
		.videovidhuky_slider.is_slider .videovidhuky_list {
			flex-direction: row;
			flex-wrap: nowrap;
			overflow-x: auto;
			scroll-snap-type: x mandatory;
			scroll-behavior: smooth;
			-webkit-overflow-scrolling: touch;
			scrollbar-width: none;
			padding-bottom: 4px;
		}
		.videovidhuky_slider.is_slider .videovidhuky_list::-webkit-scrollbar { display: none; }
		.videovidhuky_slider.is_slider .videovidhuky_card {
			flex: 0 0 85%;
			scroll-snap-align: start;
		}
		.videovidhuky_nav { display: flex; justify-content: flex-end; gap: 12px; margin-top: 20px; }
		.videovidhuky_arrow {
			width: 48px; height: 48px; border-radius: 50%;
			border: 1px solid var(--color_terracote_30, #dfbfa8);
			background: transparent; cursor: pointer; display: inline-flex;
			align-items: center; justify-content: center;
		}
		.videovidhuky_arrow_prev { transform: scaleX(-1); }
		.videovidhuky_arrow[disabled] { opacity: .35; cursor: default; }
		.videovidhuky_arrow_icon {
			width: 20px; height: 20px; display: block;
			background-color: currentColor;
			mask-repeat: no-repeat; mask-position: center; mask-size: contain;
			-webkit-mask-repeat: no-repeat; -webkit-mask-position: center; -webkit-mask-size: contain;
		}
		@media (min-width: 1024px) {
			.videovidhuky_slider.is_slider .videovidhuky_card { flex-basis: calc((100% - 30px) / 2); }
		}
	</style>
	<script>
		(function () {
			var slider = document.querySelector('[data-videovidhuky-slider]');
			if (!slider) { return; }
			var list = slider.querySelector('.videovidhuky_list');
			var prev = slider.querySelector('[data-videovidhuky-prev]');
			var next = slider.querySelector('[data-videovidhuky-next]');
			if (!list || !prev || !next) { return; }

			function step() {
				var card = list.querySelector('.videovidhuky_card');
				if (!card) { return list.clientWidth; }
				var gap = parseFloat(getComputedStyle(list).columnGap || getComputedStyle(list).gap || '0') || 0;
				return card.getBoundingClientRect().width + gap;
			}
			function sync() {
				var max = list.scrollWidth - list.clientWidth - 1;
				prev.disabled = list.scrollLeft <= 0;
				next.disabled = list.scrollLeft >= max;
			}
			prev.addEventListener('click', function () { list.scrollBy({ left: -step(), behavior: 'smooth' }); });
			next.addEventListener('click', function () { list.scrollBy({ left: step(), behavior: 'smooth' }); });
			list.addEventListener('scroll', sync, { passive: true });
			window.addEventListener('resize', sync);
			sync();
		})();
	</script>
	<?php endif; ?>

	<?php beauty_institute_consult_section(); ?>

</main>
<?php
get_footer();
