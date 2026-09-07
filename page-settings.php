<?php
/**
 * Template Name: Налаштування сайту
 *
 * Holder for global ACF settings (contacts, socials, map, footer).
 * Not meant to be viewed on the front end — visitors are sent to the home page.
 *
 * @package beauty-institute
 */

if ( ! is_user_logged_in() ) {
	wp_safe_redirect( home_url( '/' ), 302 );
	exit;
}

get_header();
?>
<main class="page" id="primary">
	<div class="container" style="padding:4rem 0;">
		<p>
			<?php esc_html_e( 'Ця сторінка містить глобальні налаштування сайту (контакти, соцмережі, карта, підвал). Редагуйте поля нижче в адмінці.', 'beauty-institute' ); ?>
		</p>
	</div>
</main>
<?php
get_footer();
