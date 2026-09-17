<?php
/**
 * Template Name: Text page
 *
 * Plain content page (legal documents, static text) — no sidebar,
 * no widgets, just a readable column matching the site's design.
 *
 * @package beauty-institute
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>

	<main class="text_page">
		<section class="text_page_hero">
			<nav class="breadcrumbs" aria-label="Хлібні крихти">
				<div class="container breadcrumbs_inner">
					<?php
					if ( function_exists( 'yoast_breadcrumb' ) ) {
						yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
					}
					?>
				</div>
			</nav>
			<div class="container">
				<h1 class="text_page_title font_heading"><?php the_title(); ?></h1>
			</div>
		</section>

		<section class="text_page_body">
			<div class="container text_page_container">
				<div class="text_page_content">
					<?php the_content(); ?>
				</div>
			</div>
		</section>
	</main>

	<?php
endwhile;

get_footer();
