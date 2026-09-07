<?php
/* Template Name: Contact */
get_header();
?>
<main class="contact">
	<section class="contact_hero">
		<span
			class="contact_hero_bg contact_hero_bg_mob"
			style="background-image: url('/wp-content/themes/beauty-institute/assets/images/contacts/contact_hero_bg_mob.webp');"
			aria-hidden="true"
		></span>
		<span
			class="contact_hero_bg contact_hero_bg_desk"
			style="background-image: url('/wp-content/themes/beauty-institute/assets/images/contacts/contact_hero_bg.webp');"
			aria-hidden="true"
		></span>
		<nav class="breadcrumbs" aria-label="Хлібні крихти">
			<div class="container breadcrumbs_inner">
				<?php if ( function_exists( 'yoast_breadcrumb' ) ) {
					yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
				} ?>
			</div>
		</nav>

		<div class="container contact_hero_inner">
			<div class="contact_hero_top">
				<div class="contact_hero_text">
					<h1 class="contact_hero_title font_heading">Наші контакти</h1>
				</div>
			</div>

			<ul class="contact_hero_feats">
				<li class="contact_hero_feat">
					<span class="contact_hero_feat_icon contact_hero_feat_icon_clock" aria-hidden="true"></span>
					<span class="contact_hero_feat_text">Щодня з 9:00 до 21:00</span>
				</li>
			</ul>
		</div>
	</section>

	<section class="find" id="find" aria-label="Як нас знайти">
			<div class="container find_inner">
				<div class="find_content">
					<h2 class="find_title font_heading">Як нас знайти</h2>

					<div class="find_text">
						<p>ІНСТИТУТ КРАСИ працює з 1949 року і є одним із найвідоміших центрів естетичної медицини. За роки роботи нам довірили своє здоров’я тисячі пацієнтів.</p>
						<p>Наші лікарі поєднують професійний досвід, сучасні технології та уважне ставлення до кожного пацієнта.</p>
					</div>

					<ul class="find_contacts">
						<li class="find_contact">
							<span class="find_contact_icon" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/icon_location_find.svg');" aria-hidden="true"></span>
							<span class="find_contact_body">
								<span class="find_contact_label">Україна, м. Київ, 01024</span>
								<span class="find_contact_value">вул. Чикаленка Євгена, буд. 20,<br>приміщення №49</span>
							</span>
						</li>
						<li class="find_contact">
							<span class="find_contact_icon" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/icon_sms_find.svg');" aria-hidden="true"></span>
							<span class="find_contact_body">
								<span class="find_contact_label">Телефон</span>
								<span class="find_contact_value">
									<a href="tel:+380985101551">+38 098 510 15 51</a>
									<a href="tel:+380955101551">+38 095 510 15 51</a>
								</span>
							</span>
						</li>
						<li class="find_contact">
							<span class="find_contact_icon" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/icon_call_find.svg');" aria-hidden="true"></span>
							<span class="find_contact_body">
								<span class="find_contact_label">E-mail</span>
								<span class="find_contact_value">
									<a href="mailto:22872120@ukr.net">22872120@ukr.net</a>
								</span>
							</span>
						</li>
						<li class="find_contact">
							<span class="find_contact_icon" style="background-image: url('/wp-content/themes/beauty-institute/assets/images/icon_edrpou_find.svg');" aria-hidden="true"></span>
							<span class="find_contact_body">
								<span class="find_contact_label">код ЄРДПОУ</span>
								<span class="find_contact_value">22872120</span>
							</span>
						</li>
					</ul>
				</div>

				<div class="find_map">
					<iframe
						class="find_map_frame"
						src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2540.7894765006495!2d30.51458497713916!3d50.445021871591116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4ce57ca29633d%3A0xbb7585b5becfb7e1!2z0IbQvdGB0YLQuNGC0YPRgiDQmtGA0LDRgdC4!5e0!3m2!1sru!2sua!4v1786569008133!5m2!1sru!2sua"
						title="Інститут краси на карті"
						width="100%"
						height="450"
						style="border:0;"
						allowfullscreen=""
						loading="lazy"
						referrerpolicy="strict-origin-when-cross-origin"
					></iframe>
				</div>
			</div>
	</section>

	<section class="consult" id="consult" aria-label="Запис на консультацію">
			<div
				class="consult_media"
				aria-hidden="true"
				style="background-image: url('/wp-content/themes/beauty-institute/assets/images/zapys_img_mob.webp');"
			></div>

			<div class="container consult_container">
				<div
					class="consult_box"
					style="background-image: url('/wp-content/themes/beauty-institute/assets/images/zapys_bg.webp');"
				>
					<div class="consult_form_col">
						<h2 class="consult_title font_heading">Запис на консультацію</h2>
						<p class="consult_intro consult_intro_desktop">Ми завжди раді відповісти на всі хвилюючі вас питання і зробити все можливе для поліпшення вашого здоров’я і зовнішнього вигляду</p>
						<p class="consult_intro consult_intro_mobile">Допоможемо визначити проблему та підібрати лікування.</p>

						<form action="/#wpcf7-f72-o1" method="post" class="wpcf7-form consult_form init" aria-label="Контактна форма" novalidate="novalidate" data-status="init">
							<p>
								<label> Ім’я</label><br>
								<span class="wpcf7-form-control-wrap" data-name="your-name"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text" autocomplete="name" aria-invalid="false" value="" type="text" name="your-name" placeholder="Вкажіть як до вас звертатися"></span>
							</p>
							<p>
								<label> Телефон</label><br>
								<span class="wpcf7-form-control-wrap" data-name="your-phone"><input size="40" maxlength="15" class="wpcf7-form-control wpcf7-tel wpcf7-text" autocomplete="tel" inputmode="numeric" aria-invalid="false" value="" type="tel" name="your-phone" placeholder="Вкажіть свій номер телефону"></span>
							</p>
							<p>
								<label> Послуга</label><br>
								<span class="wpcf7-form-control-wrap" data-name="your-service"><select class="wpcf7-form-control wpcf7-select" aria-invalid="false" name="your-service"><option value="">Оберіть послугу</option><option value="novoutvorennya">Видалення новоутворень</option><option value="injection">Ін’єкційна косметологія</option><option value="surgery">Естетична хірургія</option><option value="hardware">Апаратна косметологія</option><option value="care">Доглядові процедури</option><option value="stomatology">Стоматологія</option></select></span>
							</p>
							<p>
								<input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit" value="Відправити"><span class="wpcf7-spinner"></span>
							</p>
						</form>
					</div>

					<div class="consult_visual" aria-hidden="true"></div>
				</div>
			</div>
	</section>
</main>
<?php
get_footer();
