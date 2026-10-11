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

// Banner badges: default icon per slot, overridable via the "feat_N_icon" select.
$feat_icons = array( 'diamonds', 'clock', 'security', 'star', 'calendar' );
$feat_defs  = array();
foreach ( array( 1 => 'diamonds', 2 => 'clock', 3 => 'security', 4 => 'star' ) as $feat_n => $default_icon ) {
	$chosen_icon = get_field( 'feat_' . $feat_n . '_icon', $term );
	$feat_defs[] = array(
		'icon' => in_array( $chosen_icon, $feat_icons, true ) ? $chosen_icon : $default_icon,
		'text' => get_field( 'feat_' . $feat_n, $term ),
	);
}
if ( ! array_filter( wp_list_pluck( $feat_defs, 'text' ) ) ) {
	$feat_defs[0]['text'] = '6 напрямків';
	$feat_defs[1]['text'] = 'Від 30 хвилин';
	$feat_defs[2]['text'] = 'Сертифіковані препарати';
	$feat_defs[3]['text'] = 'Видимий ефект після першої процедури';
}

$price_btn = get_field( 'price_btn', $term );

$intro_img_id = bi_image_id( get_field( 'intro_image', $term ) );
$intro_img    = $intro_img_id ? wp_get_attachment_image_url( $intro_img_id, 'large' ) : beauty_institute_asset( 'images/child_cat/molodist_bez.webp' );

$services = bi_parse_rows( get_field( 'services_list', $term ), 4 );
$audience = bi_parse_rows( get_field( 'audience_list', $term ), 2 );
$problems = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) get_field( 'problems_list', $term ) ) ) );
$process  = bi_parse_rows( get_field( 'process_steps', $term ), 3 );
$doctors  = get_field( 'doctors', $term );
$doctors  = ( is_array( $doctors ) && $doctors ) ? $doctors : array();

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
					<?php if ( $hero_desc ) : ?><p class="iniektsiina_kosmetolohiya_desc"><?php echo nl2br( esc_html( $hero_desc ) ); ?></p><?php endif; ?>
				</div>

				<div class="iniektsiina_kosmetolohiya_actions">
					<a class="btn btn_main iniektsiina_kosmetolohiya_btn" href="<?php echo esc_url( home_url( '/#consult' ) ); ?>">
						<span class="btn_text">Записатися</span>
					</a>
					<?php if ( is_array( $price_btn ) && ! empty( $price_btn['url'] ) ) : ?>
					<a class="btn iniektsiina_kosmetolohiya_btn_price" href="<?php echo esc_url( $price_btn['url'] ); ?>" <?php echo ! empty( $price_btn['target'] ) ? 'target="' . esc_attr( $price_btn['target'] ) . '"' : ''; ?>>
						<span class="btn_text"><?php echo esc_html( ! empty( $price_btn['title'] ) ? $price_btn['title'] : 'Прайс' ); ?></span>
						<span class="btn_icon_arrow" style="mask-image: url('<?php echo esc_url( $arrow ); ?>'); -webkit-mask-image: url('<?php echo esc_url( $arrow ); ?>');" aria-hidden="true"></span>
					</a>
					<?php endif; ?>
				</div>
			</div>

			<ul class="iniektsiina_kosmetolohiya_feats">
				<?php
				foreach ( $feat_defs as $feat ) :
					if ( ! $feat['text'] ) {
						continue;
					}
					?>
					<li class="iniektsiina_kosmetolohiya_feat">
						<span class="iniektsiina_kosmetolohiya_feat_icon iniektsiina_kosmetolohiya_feat_icon_<?php echo esc_attr( $feat['icon'] ); ?>" aria-hidden="true"></span>
						<span class="iniektsiina_kosmetolohiya_feat_text"><?php echo esc_html( $feat['text'] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<?php
	$intro_title = get_field( 'intro_title', $term );
	$intro_text  = (string) get_field( 'intro_text', $term );
	$intro_more  = (string) get_field( 'intro_text_more', $term );
	?>
	<?php if ( $intro_title || $intro_text || $intro_more ) : ?>
	<section class="molodist_bez">
		<div class="container molodist_bez_inner">
			<div class="molodist_bez_content">
				<?php if ( $intro_title ) : ?><h2 class="molodist_bez_title font_heading"><?php echo esc_html( $intro_title ); ?></h2><?php endif; ?>
				<div class="molodist_bez_text"><?php echo wp_kses_post( wpautop( $intro_text ) ); ?></div>
			</div>

			<div class="molodist_bez_media" style="background-image: url('<?php echo esc_url( $intro_img ); ?>');" aria-hidden="true"></div>
		</div>
		<?php if ( $intro_more ) : ?>
		<div class="container molodist_bez_more">
			<div class="molodist_bez_text"><?php echo wp_kses_post( wpautop( $intro_more ) ); ?></div>
		</div>
		<?php endif; ?>
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
				<?php
				foreach ( $services as $service ) :
					$service_link = trim( $service[2] );
					$service_tags = array_filter( array_map( 'trim', explode( ',', (string) $service[3] ) ) );
					$item_tag     = $service_link ? 'a' : 'div';
					?>
					<<?php echo tag_escape( $item_tag ); ?>
						class="nashi_posluhy_item"
						<?php if ( $service_link ) : ?>href="<?php echo esc_url( $service_link ); ?>"<?php endif; ?>
					>
						<div class="nashi_posluhy_body">
							<div class="nashi_posluhy_head">
								<h3 class="nashi_posluhy_name"><?php echo esc_html( $service[0] ); ?></h3>
								<span class="btn_icon_arrow nashi_posluhy_arrow" style="mask-image: url('<?php echo esc_url( $arrow ); ?>'); -webkit-mask-image: url('<?php echo esc_url( $arrow ); ?>');" aria-hidden="true"></span>
							</div>
							<?php if ( $service[1] ) : ?><p class="nashi_posluhy_desc"><?php echo esc_html( $service[1] ); ?></p><?php endif; ?>
							<?php if ( $service_tags ) : ?>
							<ul class="nashi_posluhy_tags">
								<?php foreach ( $service_tags as $tag ) : ?>
									<li class="nashi_posluhy_tag"><?php echo esc_html( $tag ); ?></li>
								<?php endforeach; ?>
							</ul>
							<?php endif; ?>
						</div>
						<span class="btn_icon_arrow nashi_posluhy_arrow_aside" style="mask-image: url('<?php echo esc_url( $arrow ); ?>'); -webkit-mask-image: url('<?php echo esc_url( $arrow ); ?>');" aria-hidden="true"></span>
					</<?php echo tag_escape( $item_tag ); ?>>
				<?php endforeach; ?>
			</div>

			<?php $services_note = get_field( 'services_note', $term ); ?>
			<?php if ( $services_note ) : ?>
			<p class="nashi_posluhy_note"><?php echo esc_html( $services_note ); ?></p>
			<?php endif; ?>
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

	<?php if ( $process ) : ?>
	<section class="yak_prokhodyt_section">
		<div class="container">
			<div class="yak_prokhodyt">
				<h2 class="yak_prokhodyt_title"><?php echo esc_html( get_field( 'process_title', $term ) ? get_field( 'process_title', $term ) : 'Як проходить процедура' ); ?></h2>
				<div class="yak_prokhodyt_list">
					<?php foreach ( $process as $step_n => $step ) : ?>
						<?php $step_tags = array_filter( array_map( 'trim', explode( ',', $step[2] ) ) ); ?>
						<article class="yak_prokhodyt_item">
							<span class="yak_prokhodyt_num" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $step_n + 1 ) ); ?></span>
							<div class="yak_prokhodyt_body">
								<h3 class="yak_prokhodyt_item_title"><?php echo esc_html( $step[0] ); ?></h3>
								<?php if ( '' !== $step[1] ) : ?><p class="yak_prokhodyt_item_text"><?php echo esc_html( $step[1] ); ?></p><?php endif; ?>
								<?php if ( $step_tags ) : ?>
								<ul class="yak_prokhodyt_tags">
									<?php foreach ( $step_tags as $step_tag ) : ?>
										<li class="yak_prokhodyt_tag"><?php echo esc_html( $step_tag ); ?></li>
									<?php endforeach; ?>
								</ul>
								<?php endif; ?>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( $doctors ) : ?>
	<section class="likari" aria-label="Лікарі">
		<div class="container likari_inner">
			<div class="likari_head">
				<h2 class="likari_title font_heading"><?php echo esc_html( get_field( 'doctors_title', $term ) ? get_field( 'doctors_title', $term ) : 'Лікарі' ); ?></h2>
				<?php $doctors_subtitle = get_field( 'doctors_subtitle', $term ); ?>
				<?php if ( $doctors_subtitle ) : ?><p class="likari_subtitle"><?php echo esc_html( $doctors_subtitle ); ?></p><?php endif; ?>
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
					$d_src  = $d_img ? wp_get_attachment_image_url( $d_img, 'medium_large' ) : beauty_institute_asset( 'images/likari/estetychnyi_khirurh.webp' );
					$d_role = trim( (string) get_field( 'role', $doc_id ) );
					if ( '' === $d_role ) {
						$d_role = trim( (string) get_field( 'card_description', $doc_id ) );
					}
					if ( '' === $d_role ) {
						$d_terms = get_the_terms( $doc_id, 'bi_specialty' );
						$d_role  = ( $d_terms && ! is_wp_error( $d_terms ) ) ? $d_terms[0]->name : '';
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

	<?php beauty_institute_faq_section( '', 0, beauty_institute_asset( 'images/child_cat/use_shcho.webp' ) ); ?>

	<?php
	beauty_institute_consult_section(
		'',
		'',
		(string) get_field( 'consult_title', $term ),
		(string) get_field( 'consult_intro_desktop', $term )
	);
	?>

</main>
