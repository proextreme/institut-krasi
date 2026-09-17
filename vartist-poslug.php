<?php
/**
 * Template Name: Vartist poslug
 *
 * @package beauty-institute
 */

get_header();

$tabs = array(
	'general' => array( 'label' => 'Загальний прайс', 'field' => 'price_general' ),
	'dental'  => array( 'label' => 'Стоматологія', 'field' => 'price_dental' ),
);
?>
<main class="vartist_poslug">

	<section class="poslugi">
		<nav class="breadcrumbs" aria-label="Хлібні крихти">
			<div class="container breadcrumbs_inner">
				<? if ( function_exists('yoast_breadcrumb') ) yoast_breadcrumb('<div id="breadcrumbs">','</div>');?>
			</div>
		</nav>

		<div class="container poslugi_inner">
			<h1 class="poslugi_title font_heading">Вартість наших послуг</h1>
			<div class="poslugi_text">
				<p class="poslugi_desc">Ми прагнемо, щоб вам було легко орієнтуватися у вартості послуг. Ціни в Інституті краси формуються - відповідно до досвіду лікарів, технологій і результату, який ви отримуєте.</p>
			</div>
			<nav class="poslugi_tabs" aria-label="Категорії прайсу" data-likari-tabs role="tablist">
				<?php foreach ( $tabs as $slug => $tab ) : $active = 'general' === $slug; ?>
					<button
						type="button"
						class="poslugi_tab<?php echo $active ? ' is_active' : ''; ?>"
						role="tab"
						id="price-tab-<?php echo esc_attr( $slug ); ?>"
						data-likari-tab="<?php echo esc_attr( $slug ); ?>"
						aria-controls="price-panel-<?php echo esc_attr( $slug ); ?>"
						aria-selected="<?php echo $active ? 'true' : 'false'; ?>"
						tabindex="<?php echo $active ? '0' : '-1'; ?>"
					><?php echo esc_html( $tab['label'] ); ?></button>
				<?php endforeach; ?>
			</nav>
		</div>
	</section>

	<?php foreach ( $tabs as $slug => $tab ) : $active = 'general' === $slug; ?>
	<section
		class="in_iektsiina_terapiya<?php echo $active ? ' is_active' : ''; ?>"
		id="price-panel-<?php echo esc_attr( $slug ); ?>"
		aria-label="Прайс послуг — <?php echo esc_attr( $tab['label'] ); ?>"
		role="tabpanel"
		data-likari-panel="<?php echo esc_attr( $slug ); ?>"
		aria-labelledby="price-tab-<?php echo esc_attr( $slug ); ?>"
		aria-hidden="<?php echo $active ? 'false' : 'true'; ?>"
	>
		<div class="in_iektsiina_terapiya_decor" aria-hidden="true">
			<span
				class="in_iektsiina_terapiya_decor_item in_iektsiina_terapiya_decor_item_1"
				style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/right_edge_img.webp' ) ); ?>');"
			></span>
			<span
				class="in_iektsiina_terapiya_decor_item in_iektsiina_terapiya_decor_item_2"
				style="background-image: url('<?php echo esc_url( beauty_institute_asset( 'images/right_edge_img.webp' ) ); ?>');"
			></span>
		</div>

		<div class="container in_iektsiina_terapiya_inner">
			<div class="in_iektsiina_terapiya_panel">
				<?php beauty_institute_price_list( bi_field( $tab['field'] ) ); ?>
			</div>
		</div>
	</section>
	<?php endforeach; ?>

</main>
<?php
get_footer();
