<?php
/**
 * Template Name: Zemits
 *
 * @package beauty-institute
 */

get_header();

while ( have_posts() ) :
	the_post();
endwhile;

$hero_bg_id  = bi_image_id( bi_field( 'hero_bg' ) );
$hero_mob_id = bi_image_id( bi_field( 'hero_bg_mobile' ) );
$hero_bg     = $hero_bg_id ? wp_get_attachment_image_url( $hero_bg_id, 'full' ) : beauty_institute_asset( 'images/zemits/aparatna_kosmetolohiya.webp' );
$hero_mob    = $hero_mob_id ? wp_get_attachment_image_url( $hero_mob_id, 'large' ) : beauty_institute_asset( 'images/zemits/aparatna_kosmetolohiya_mob.webp' );
$hero_btn    = bi_field( 'hero_btn' );

$hero_feats = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) bi_field( 'hero_feats' ) ) ) );
if ( ! $hero_feats ) {
	$hero_feats = array( '2 апарати Zemits', '5+ видів процедур', 'США виробник' );
}

$devices = get_posts(
	array(
		'post_type'      => 'bi_device',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'no_found_rows'  => true,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
	)
);

$zones = array();
for ( $i = 1; $i <= 4; $i++ ) {
	$zt = bi_field( "zone_{$i}_title" );
	if ( $zt ) {
		$zones[] = array( 'title' => $zt, 'desc' => bi_field( "zone_{$i}_desc" ) );
	}
}
$zones_photo_id = bi_image_id( bi_field( 'zones_photo' ) );
$zones_photo    = $zones_photo_id ? wp_get_attachment_image_url( $zones_photo_id, 'medium' ) : beauty_institute_asset( 'images/zemits/zony_obrobky.webp' );
?>
<main class="zemits">

	<section class="aparatna_kosmetolohiya">
		<span class="aparatna_kosmetolohiya_bg aparatna_kosmetolohiya_bg_mob" style="background-image: url('<?php echo esc_url( $hero_mob ); ?>');" aria-hidden="true"></span>
		<span class="aparatna_kosmetolohiya_bg aparatna_kosmetolohiya_bg_desk" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');" aria-hidden="true"></span>

		<nav class="breadcrumbs" aria-label="Хлібні крихти">
			<div class="container breadcrumbs_inner">
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) ) {
					yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
				}
				?>
			</div>
		</nav>

		<div class="container aparatna_kosmetolohiya_inner">
			<div class="aparatna_kosmetolohiya_top">
				<div class="aparatna_kosmetolohiya_text">
					<h1 class="aparatna_kosmetolohiya_title font_heading"><?php echo wp_kses_post( bi_field( 'hero_title', 'Апаратна косметологія<br>на обладнанні Zemits' ) ); ?></h1>
					<p class="aparatna_kosmetolohiya_desc"><?php bi_text( 'hero_desc', 'Косметологічні процедури на сертифікованих американських апаратах Zemits' ); ?></p>
				</div>

				<a class="btn btn_main aparatna_kosmetolohiya_btn" href="<?php echo esc_url( is_array( $hero_btn ) && ! empty( $hero_btn['url'] ) ? $hero_btn['url'] : home_url( '/#consult' ) ); ?>">
					<span class="btn_text"><?php echo esc_html( is_array( $hero_btn ) && ! empty( $hero_btn['title'] ) ? $hero_btn['title'] : 'Записатися' ); ?></span>
				</a>
			</div>

			<ul class="aparatna_kosmetolohiya_feats">
				<?php foreach ( $hero_feats as $feat ) : ?>
					<li class="aparatna_kosmetolohiya_feat">
						<img class="aparatna_kosmetolohiya_feat_icon" src="<?php echo esc_url( beauty_institute_asset( 'images/zemits/aparatna_kosmetolohiya.svg' ) ); ?>" alt="" width="10" height="10" decoding="async" aria-hidden="true">
						<span class="aparatna_kosmetolohiya_feat_text"><?php echo esc_html( $feat ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<?php
	if ( $devices ) {
		foreach ( $devices as $index => $device_id ) {
			beauty_institute_device_block( $device_id, $index );
			if ( 0 === $index ) {
				echo '<div class="edge_art edge_art_right" aria-hidden="true"><span class="edge_art_bg" style="background-image: url(\'' . esc_url( beauty_institute_asset( 'images/sho_vyrishuemo/decor.webp' ) ) . '\');"></span></div>';
			}
		}
	} else {
		?>
		<section class="box_type_1" aria-label="Мікрострумова терапія">
			<div class="container box_type_1_inner">
				<div class="box_type_1_head">
					<div class="box_type_1_heading">
						<h2 class="box_type_1_title font_heading">Мікрострумова терапія</h2>
						<div class="box_type_1_meta">
							<p class="box_type_1_device">Апарат: Zemits Adrinox 2.0</p>
							<p class="box_type_1_time">
								<img class="box_type_1_time_icon" src="<?php echo esc_url( beauty_institute_asset( 'images/zemits/clock.svg' ) ); ?>" alt="" width="24" height="24" decoding="async" aria-hidden="true">
								<span>45–60 хв</span>
							</p>
						</div>
					</div>
				</div>
				<div class="box_type_1_media">
					<div class="box_type_1_photo">
						<img class="box_type_1_img" src="<?php echo esc_url( beauty_institute_asset( 'images/zemits/mikrostrumova_terapiya.webp' ) ); ?>" alt="" width="620" height="478" loading="lazy" decoding="async">
					</div>
				</div>
				<div class="box_type_1_body">
					<p class="box_type_1_text">Безболісна процедура стимуляції м’язів і шкіри слабкими електричними імпульсами. Природне омолодження без операцій та ін’єкцій.</p>
					<ul class="box_type_1_list">
						<li class="box_type_1_item"><span class="box_type_1_item_text">Підтяжка контуру обличчя</span></li>
						<li class="box_type_1_item"><span class="box_type_1_item_text">Підвищення тонусу та еластичності</span></li>
						<li class="box_type_1_item"><span class="box_type_1_item_text">Зміцнення м’язів обличчя та шиї</span></li>
					</ul>
				</div>
				<a class="box_type_1_btn" href="<?php echo esc_url( home_url( '/#consult' ) ); ?>">
					<span class="box_type_1_btn_text">Записатись</span>
					<span class="box_type_1_btn_icon" aria-hidden="true"></span>
				</a>
			</div>
		</section>
		<?php
	}
	?>

	<?php beauty_institute_faq_section( bi_field( 'faq_title' ), (int) bi_field( 'faq_group', 0 ) ); ?>

	<section class="zony_obrobky" aria-label="Зони обробки апаратами Zemits">
		<div class="container zony_obrobky_inner">
			<div class="zony_obrobky_card">
				<div class="zony_obrobky_back" aria-hidden="true">
					<img class="zony_obrobky_decor zony_obrobky_decor_mob" src="<?php echo esc_url( beauty_institute_asset( 'images/zemits/zony_obrobky_mob_1.webp' ) ); ?>" alt="" width="134" height="152" decoding="async">
					<img class="zony_obrobky_decor zony_obrobky_decor_desk" src="<?php echo esc_url( beauty_institute_asset( 'images/zemits/zony_obrobky_1.webp' ) ); ?>" alt="" width="184" height="210" decoding="async">
				</div>

				<div class="zony_obrobky_content">
					<figure class="zony_obrobky_photo">
						<img class="zony_obrobky_img" src="<?php echo esc_url( $zones_photo ); ?>" alt="" width="280" height="280" loading="lazy" decoding="async">
					</figure>

					<div class="zony_obrobky_main">
						<h2 class="zony_obrobky_title"><?php bi_text( 'zones_title', 'Зони обробки апаратами Zemits:' ); ?></h2>

						<ul class="zony_obrobky_list">
							<?php
							if ( $zones ) {
								foreach ( $zones as $zone ) {
									printf(
										'<li class="zony_obrobky_item"><span class="zony_obrobky_item_title">%s</span><span class="zony_obrobky_item_desc">%s</span></li>',
										esc_html( $zone['title'] ),
										esc_html( $zone['desc'] )
									);
								}
							} else {
								?>
								<li class="zony_obrobky_item"><span class="zony_obrobky_item_title">Обличчя</span><span class="zony_obrobky_item_desc">Зволоження, ліфтинг, очищення</span></li>
								<li class="zony_obrobky_item"><span class="zony_obrobky_item_title">Шия і декольте</span><span class="zony_obrobky_item_desc">Ревіталізація, підтяжка</span></li>
								<li class="zony_obrobky_item"><span class="zony_obrobky_item_title">Руки</span><span class="zony_obrobky_item_desc">Омолодження, зволоження</span></li>
								<li class="zony_obrobky_item"><span class="zony_obrobky_item_title">Очі і губи</span><span class="zony_obrobky_item_desc">DermeBoost, делікатний догляд</span></li>
								<?php
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php beauty_institute_consult_section(); ?>

</main>
<?php
get_footer();
