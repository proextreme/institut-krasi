<?php
/**
 * Template Name: About us
 *
 * @package beauty-institute
 */

get_header();

while ( have_posts() ) :
	the_post();
endwhile;

/**
 * Local helper: <img> for an about-page image field, else a theme asset.
 *
 * @param string $field  ACF field name.
 * @param string $asset  Fallback asset path.
 * @param string $class  img class.
 * @param string $size   Image size.
 */
if ( ! function_exists( 'beauty_institute_about_img' ) ) :
function beauty_institute_about_img( $field, $asset, $class, $size = 'large' ) {
	bi_image(
		$field,
		$asset,
		$size,
		array(
			'class'    => $class,
			'alt'      => '',
			'loading'  => 'lazy',
			'decoding' => 'async',
		)
	);
}
endif;

$about_cards = array();
for ( $i = 1; $i <= 6; $i++ ) {
	$title = bi_field( "card_{$i}_title" );
	$text  = bi_field( "card_{$i}_text" );
	if ( $title || $text ) {
		$about_cards[] = array( 'title' => $title, 'text' => $text );
	}
}

$about_certs = array();
for ( $i = 1; $i <= 6; $i++ ) {
	$name = bi_field( "cert_{$i}_name" );
	$img  = bi_image_id( bi_field( "cert_{$i}_image" ) );
	if ( $name || $img ) {
		$about_certs[] = array(
			'name' => $name,
			'year' => bi_field( "cert_{$i}_year" ),
			'link' => bi_field( "cert_{$i}_link" ),
			'src'  => $img ? wp_get_attachment_image_url( $img, 'large' ) : beauty_institute_asset( 'images/nashi_sertyfikaty.webp' ),
		);
	}
}

$doctors_list = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) bi_field( 'doctors_list' ) ) ) );
$doctors_btn  = bi_field( 'doctors_btn' );
?>
<main class="about-us">
<nav class="breadcrumbs" aria-label="Хлібні крихти">
	<div class="container breadcrumbs_inner">
		<?php
		if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
		} else {
			?>
			<div id="breadcrumbs"><span><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a></span> / <span class="breadcrumb_last" aria-current="page"><?php the_title(); ?></span></span></div>
			<?php
		}
		?>
	</div>
</nav>

<section class="instytut_krasy">
	<div class="container instytut_krasy_inner">
		<div class="instytut_krasy_content">
			<h1 class="instytut_krasy_title font_heading"><?php echo wp_kses_post( bi_field( 'hero_title', 'Інститут краси<br>з медичним підходом' ) ); ?></h1>
			<p class="instytut_krasy_text"><?php bi_text( 'hero_text', 'Діагностика, лікування та естетика — в одному місці.' ); ?></p>
		</div>

		<div class="instytut_krasy_gallery" aria-hidden="true">
			<figure class="instytut_krasy_card instytut_krasy_card_tl"><?php beauty_institute_about_img( 'hero_img_1', 'images/instytut_krasy.webp', 'instytut_krasy_card_img' ); ?></figure>
			<figure class="instytut_krasy_card instytut_krasy_card_bl"><?php beauty_institute_about_img( 'hero_img_2', 'images/instytut_krasy_1.webp', 'instytut_krasy_card_img' ); ?></figure>
			<figure class="instytut_krasy_card instytut_krasy_card_tr"><?php beauty_institute_about_img( 'hero_img_3', 'images/instytut_krasy_3.webp', 'instytut_krasy_card_img' ); ?></figure>
			<figure class="instytut_krasy_card instytut_krasy_card_br"><?php beauty_institute_about_img( 'hero_img_4', 'images/instytut_krasy_2.webp', 'instytut_krasy_card_img' ); ?></figure>
		</div>
	</div>
</section>

<section class="tour_3d_ekskursiya">
	<div class="tour_3d_ekskursiya_head">
		<div class="container tour_3d_ekskursiya_intro">
			<h2 class="tour_3d_ekskursiya_title font_heading"><?php bi_text( 'tour_title', '3D-екскурсія' ); ?></h2>
			<p class="tour_3d_ekskursiya_text"><?php echo wp_kses_post( bi_field( 'tour_text', 'Зазирніть в Інститут зсередини.<br>Ви потрапили в медичний центр ІНСТИТУТ КРАСИ, де на першому місці - ВИ!' ) ); ?></p>
		</div>
	</div>

	<div class="container tour_3d_ekskursiya_media">
		<div class="tour_3d_ekskursiya_card">
			<?php
			$tour_poster = bi_image_id( bi_field( 'tour_poster' ) );
			$tour_src    = $tour_poster ? wp_get_attachment_image_url( $tour_poster, 'large' ) : beauty_institute_asset( 'images/3d_ekskursiya.webp' );
			$tour_yt     = bi_field( 'tour_youtube_id', 'rAx1qYtXI28' );
			?>
			<img class="tour_3d_ekskursiya_img" src="<?php echo esc_url( $tour_src ); ?>" alt="" width="1046" height="468" loading="lazy" decoding="async">
			<button type="button" class="tour_3d_ekskursiya_play" data-video-open data-youtube-id="<?php echo esc_attr( $tour_yt ); ?>" aria-label="Відкрити 3D-екскурсію">
				<img class="tour_3d_ekskursiya_play_icon" src="<?php echo esc_url( beauty_institute_asset( 'images/3d_ekskursiya.svg' ) ); ?>" alt="" width="19" height="20" loading="lazy" decoding="async">
			</button>
		</div>
	</div>

	<div class="videovidhuky_modal" data-video-modal hidden>
		<div class="videovidhuky_modal_backdrop" data-video-modal-close tabindex="-1"></div>
		<div class="videovidhuky_modal_dialog" role="dialog" aria-modal="true" aria-label="3D-екскурсія">
			<button type="button" class="videovidhuky_modal_close" data-video-modal-close aria-label="Закрити відео"></button>
			<div class="videovidhuky_modal_frame">
				<iframe class="videovidhuky_modal_iframe" data-video-iframe title="3D-екскурсія" src="" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</section>

<section class="my_pratsyuiemo">
	<div class="container my_pratsyuiemo_inner">
		<div class="my_pratsyuiemo_gallery" aria-hidden="true">
			<div class="my_pratsyuiemo_card my_pratsyuiemo_card_stat my_pratsyuiemo_card_tl">
				<p class="my_pratsyuiemo_stat"><?php echo esc_html( bi_field( 'stat_1_number', '75' ) ); ?><br><?php echo esc_html( bi_field( 'stat_1_text', 'років досвіду' ) ); ?></p>
			</div>

			<figure class="my_pratsyuiemo_card my_pratsyuiemo_card_bl"><?php beauty_institute_about_img( 'work_image_1', 'images/my_pratsyuiemo_2.webp', 'my_pratsyuiemo_card_img' ); ?></figure>
			<figure class="my_pratsyuiemo_card my_pratsyuiemo_card_tr"><?php beauty_institute_about_img( 'work_image_2', 'images/my_pratsyuiemo_1.webp', 'my_pratsyuiemo_card_img' ); ?></figure>

			<div class="my_pratsyuiemo_card my_pratsyuiemo_card_stat my_pratsyuiemo_card_br">
				<p class="my_pratsyuiemo_stat my_pratsyuiemo_stat_dark"><?php echo esc_html( bi_field( 'stat_2_number', '23' ) ); ?> <?php echo esc_html( bi_field( 'stat_2_text', 'видів косметологічних послуг' ) ); ?></p>
			</div>
		</div>

		<blockquote class="my_pratsyuiemo_quote">
			<div class="my_pratsyuiemo_quote_body">
				<img class="my_pratsyuiemo_marks my_pratsyuiemo_marks_open" src="<?php echo esc_url( beauty_institute_asset( 'images/my_pratsyuiemo.svg' ) ); ?>" alt="" width="44" height="34" loading="lazy" decoding="async">
				<p class="my_pratsyuiemo_quote_text font_heading"><?php bi_text( 'quote_text', 'Ми працюємо, щоб кожен пацієнт отримав не просто процедуру, а точний діагноз і ефективне лікування.' ); ?></p>
				<img class="my_pratsyuiemo_marks my_pratsyuiemo_marks_close" src="<?php echo esc_url( beauty_institute_asset( 'images/my_pratsyuiemo_1.svg' ) ); ?>" alt="" width="44" height="34" loading="lazy" decoding="async">
			</div>
			<footer class="my_pratsyuiemo_author">
				<cite class="my_pratsyuiemo_name"><?php bi_text( 'quote_author', 'Інна Трембач' ); ?></cite>
				<span class="my_pratsyuiemo_role"><?php bi_text( 'quote_role', 'Директор медичного центру «Інститут краси»' ); ?></span>
			</footer>
		</blockquote>
	</div>
</section>

<div class="edge_art edge_art_right" aria-hidden="true">
	<span class="edge_art_bg" style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/right_edge_img.webp' ) ); ?>');"></span>
</div>

<section class="pro_instytut">
	<div class="container pro_instytut_inner">
		<header class="pro_instytut_header">
			<h2 class="pro_instytut_title font_heading"><?php bi_text( 'about_title', 'Про інститут' ); ?></h2>
			<div class="pro_instytut_leads">
				<p class="pro_instytut_lead"><?php bi_text( 'about_lead', 'Інститут Краси був заснований в 1949 році та на даний момент має досвід 77 років, наша установа користується великою довірою і успіхом не тільки у мешканців Києва, а й усієї України.' ); ?></p>
				<p class="pro_instytut_sub"><?php bi_text( 'about_sub', 'На той час це був єдиний в Україні лікарський косметологічний центр з лікування, як вроджених, так і набутих косметичних недоліків шкіри.' ); ?></p>
			</div>
		</header>

		<div class="pro_instytut_body">
			<?php
			$about_media = '<figure class="pro_instytut_media"><picture>';
			$about_img   = bi_image_id( bi_field( 'about_image' ) );
			$about_img_src = $about_img ? wp_get_attachment_image_url( $about_img, 'large' ) : beauty_institute_asset( 'images/pro_instytut.webp' );
			$about_media .= '<img class="pro_instytut_img" src="' . esc_url( $about_img_src ) . '" alt="" width="404" height="586" loading="lazy" decoding="async">';
			$about_media .= '</picture></figure>';

			if ( $about_cards ) {
				foreach ( $about_cards as $index => $card ) {
					printf(
						'<article class="pro_instytut_card"><h3 class="pro_instytut_card_title">%s</h3><p class="pro_instytut_card_text">%s</p></article>',
						esc_html( $card['title'] ),
						wp_kses_post( nl2br( $card['text'] ) )
					);
					if ( 2 === $index ) {
						echo $about_media; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built above with esc_url().
					}
				}
				if ( count( $about_cards ) <= 3 ) {
					echo $about_media; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			} else {
				?>
				<article class="pro_instytut_card">
					<h3 class="pro_instytut_card_title">Як ми працюємо</h3>
					<p class="pro_instytut_card_text">Відвідування інституту починається з консультації лікаря, тому що тільки лікар може встановити причину косметичної проблеми і після огляду зробити призначення, а також в процесі лікування здійснити контроль.</p>
				</article>
				<article class="pro_instytut_card">
					<h3 class="pro_instytut_card_title">За необхідності ми консультуємося з фахівцями інститутів і лікувальних установ, а саме:</h3>
					<p class="pro_instytut_card_text">Кафедра дерматовенерології Національного медичного університету ім. О.О.Богомольця;<br>Національний інститут раку.</p>
				</article>
				<article class="pro_instytut_card">
					<h3 class="pro_instytut_card_title">Для кого ми працюємо</h3>
					<p class="pro_instytut_card_text">Віковий діапазон наших відвідувачів - від 2 тижнів до 99 років. До нас звертаються з новоутвореннями шкіри (родимки, кератоми, атероми, ангіоми, ксантелазми, папіломи та ін.), розацеа, вікові зміни шкіри обличчя та ін.</p>
				</article>
				<?php echo $about_media; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<article class="pro_instytut_card">
					<h3 class="pro_instytut_card_title">Наше завдання</h3>
					<p class="pro_instytut_card_text">Наше завдання, окрім постановки діагнозу, для чого нам нерідко потрібна консультація онколога, вибрати метод видалення, щоб залишити найменший слід після нашого втручання.</p>
				</article>
				<article class="pro_instytut_card">
					<h3 class="pro_instytut_card_title">З чим до нас звертаються</h3>
					<p class="pro_instytut_card_text">Чимало звернень до пластичних хірургів з приводу посттравматичних рубців, деформацій вушних раковин, вікових змін обличчя, шиї та ін.</p>
				</article>
				<article class="pro_instytut_card">
					<h3 class="pro_instytut_card_title">Наші методики</h3>
					<p class="pro_instytut_card_text">У лікуванні і профілактиці використовуються як класичні методики, відпрацьовані часом, так і сучасні дерматологічні інноваційні технології.</p>
				</article>
				<?php
			}
			?>
		</div>
	</div>
</section>

<section class="nashi_likari">
	<div class="container nashi_likari_inner">
		<div class="nashi_likari_gallery" aria-hidden="true">
			<figure class="nashi_likari_photo nashi_likari_photo_back"><?php beauty_institute_about_img( 'doctors_image_1', 'images/nashi_likari.webp', 'nashi_likari_photo_img' ); ?></figure>
			<figure class="nashi_likari_photo nashi_likari_photo_front"><?php beauty_institute_about_img( 'doctors_image_2', 'images/nashi_likari_1.webp', 'nashi_likari_photo_img' ); ?></figure>
		</div>

		<div class="nashi_likari_content">
			<h2 class="nashi_likari_title font_heading"><?php bi_text( 'doctors_title', 'Наші лікарі:' ); ?></h2>

			<ul class="nashi_likari_list">
				<?php
				if ( $doctors_list ) {
					foreach ( $doctors_list as $item ) {
						printf( '<li class="nashi_likari_item">%s</li>', esc_html( $item ) );
					}
				} else {
					?>
					<li class="nashi_likari_item">Постійно підвищують кваліфікацію та навчаються новим технікам омолодження шкіри</li>
					<li class="nashi_likari_item">Освоюють сучасні методики онкодерматології</li>
					<li class="nashi_likari_item">Відвідують міжнародні конгреси та виставки індустрії краси</li>
					<li class="nashi_likari_item">Консультуються з провідними спеціалістами медичних установ України</li>
					<?php
				}
				?>
			</ul>

			<a class="btn btn_blue nashi_likari_btn" href="<?php echo esc_url( is_array( $doctors_btn ) && ! empty( $doctors_btn['url'] ) ? $doctors_btn['url'] : home_url( '/likari/' ) ); ?>">
				<span class="btn_text"><?php echo esc_html( is_array( $doctors_btn ) && ! empty( $doctors_btn['title'] ) ? $doctors_btn['title'] : 'Наші Лікарі' ); ?></span>
				<span class="btn_icon btn_icon_arrow" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>');" aria-hidden="true"></span>
			</a>
		</div>
	</div>
</section>

<?php beauty_institute_results_tabs( bi_field( 'results_title' ), bi_field( 'results_text' ) ); ?>

<section class="nashi_sertyfikaty">
	<div class="container nashi_sertyfikaty_inner">
		<h2 class="nashi_sertyfikaty_title font_heading"><?php bi_text( 'certs_title', 'Наші сертифікати' ); ?></h2>

		<div class="nashi_sertyfikaty_list">
			<?php
			if ( $about_certs ) {
				foreach ( $about_certs as $cert ) {
					?>
					<a class="nashi_sertyfikaty_card" href="<?php echo esc_url( $cert['link'] ? $cert['link'] : '#' ); ?>"<?php echo $cert['link'] ? ' target="_blank" rel="noopener"' : ''; ?> style="--card-photo: url('<?php echo esc_url( $cert['src'] ); ?>');">
						<picture>
							<img class="nashi_sertyfikaty_img" src="<?php echo esc_url( $cert['src'] ); ?>" alt="" width="620" height="315" loading="lazy" decoding="async">
						</picture>
						<span class="requests_card_panel nashi_sertyfikaty_panel">
							<span class="nashi_sertyfikaty_meta">
								<span class="nashi_sertyfikaty_name"><?php echo esc_html( $cert['name'] ); ?></span>
								<?php if ( $cert['year'] ) : ?>
									<span class="nashi_sertyfikaty_year"><?php echo esc_html( $cert['year'] ); ?></span>
								<?php endif; ?>
							</span>
							<span class="nashi_sertyfikaty_action">
								<span class="nashi_sertyfikaty_action_text">Переглянути</span>
								<span class="requests_card_arrow nashi_sertyfikaty_arrow" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>');" aria-hidden="true"></span>
							</span>
						</span>
					</a>
					<?php
				}
			} else {
				?>
				<a class="nashi_sertyfikaty_card" href="#" style="--card-photo: url('<?php echo esc_url( beauty_institute_asset( 'images/nashi_sertyfikaty.webp' ) ); ?>');">
					<picture>
						<source media="(max-width: 1023px)" srcset="<?php echo esc_url( beauty_institute_asset( 'images/nashi_sertyfikaty_2.webp' ) ); ?>">
						<img class="nashi_sertyfikaty_img" src="<?php echo esc_url( beauty_institute_asset( 'images/nashi_sertyfikaty.webp' ) ); ?>" alt="" width="620" height="315" loading="lazy" decoding="async">
					</picture>
					<span class="requests_card_panel nashi_sertyfikaty_panel">
						<span class="nashi_sertyfikaty_meta">
							<span class="nashi_sertyfikaty_name">Сертифікат косметології</span>
							<span class="nashi_sertyfikaty_year">2026</span>
						</span>
						<span class="nashi_sertyfikaty_action">
							<span class="nashi_sertyfikaty_action_text">Переглянути</span>
							<span class="requests_card_arrow nashi_sertyfikaty_arrow" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>');" aria-hidden="true"></span>
						</span>
					</span>
				</a>
				<a class="nashi_sertyfikaty_card" href="#" style="--card-photo: url('<?php echo esc_url( beauty_institute_asset( 'images/nashi_sertyfikaty_1.webp' ) ); ?>');">
					<picture>
						<source media="(max-width: 1023px)" srcset="<?php echo esc_url( beauty_institute_asset( 'images/nashi_sertyfikaty_3.webp' ) ); ?>">
						<img class="nashi_sertyfikaty_img" src="<?php echo esc_url( beauty_institute_asset( 'images/nashi_sertyfikaty_1.webp' ) ); ?>" alt="" width="620" height="315" loading="lazy" decoding="async">
					</picture>
					<span class="requests_card_panel nashi_sertyfikaty_panel">
						<span class="nashi_sertyfikaty_meta">
							<span class="nashi_sertyfikaty_name">Сертифікат косметології</span>
							<span class="nashi_sertyfikaty_year">2026</span>
						</span>
						<span class="nashi_sertyfikaty_action">
							<span class="nashi_sertyfikaty_action_text">Переглянути</span>
							<span class="requests_card_arrow nashi_sertyfikaty_arrow" style="mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>'); -webkit-mask-image: url('<?php echo esc_url( beauty_institute_asset( 'images/arrow_right.svg' ) ); ?>');" aria-hidden="true"></span>
						</span>
					</span>
				</a>
				<?php
			}
			?>
		</div>
	</div>
</section>

<?php beauty_institute_find_section(); ?>
</main>
<?php
get_footer();
