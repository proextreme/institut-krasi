/**
 * Main scripts.
 *
 * @package Beauty
 */

document.addEventListener('DOMContentLoaded', () => {
	const burger = document.querySelector('.header_burger');
	const menu = document.getElementById('mobile-menu');
	const menuBackdrop = document.getElementById('mobile-menu-backdrop');
	const closeBtn = document.querySelector('.mobile_menu_close');

	/**
	 * Open / close mobile menu.
	 *
	 * @param {boolean} isOpen Whether menu should be open.
	 */
	const setMenuOpen = (isOpen) => {
		if (!burger || !menu) {
			return;
		}

		burger.setAttribute('aria-expanded', String(isOpen));
		burger.setAttribute('aria-label', isOpen ? 'Закрити меню' : 'Відкрити меню');
		menu.setAttribute('aria-hidden', String(!isOpen));
		if (menuBackdrop) {
			menuBackdrop.setAttribute('aria-hidden', String(!isOpen));
		}
		document.body.classList.toggle('is_menu_open', isOpen);
	};

	if (burger && menu) {
		burger.addEventListener('click', () => {
			const isOpen = burger.getAttribute('aria-expanded') === 'true';
			setMenuOpen(!isOpen);
		});

		if (closeBtn) {
			closeBtn.addEventListener('click', () => {
				setMenuOpen(false);
			});
		}

		if (menuBackdrop) {
			menuBackdrop.addEventListener('click', () => {
				setMenuOpen(false);
			});
		}

		menu.querySelectorAll('a').forEach((link) => {
			link.addEventListener('click', () => {
				setMenuOpen(false);
			});
		});

		document.addEventListener('keydown', (event) => {
			if (event.key === 'Escape' && document.body.classList.contains('is_menu_open')) {
				setMenuOpen(false);
			}
		});
	}

	// Footer accordion (mobile) with height animation.
	const footerCols = document.querySelectorAll('.footer_col');
	const footerMobileMq = window.matchMedia('(max-width: 991px)');

	/**
	 * Animate footer column list open/close.
	 *
	 * @param {HTMLElement} col Footer column.
	 * @param {boolean} open Whether to open.
	 */
	const setFooterColOpen = (col, open) => {
		const list = col.querySelector('.footer_col_list');
		const btn = col.querySelector('.footer_col_toggle');

		if (!list) {
			return;
		}

		if (open) {
			col.classList.add('is_open');
			if (btn) {
				btn.setAttribute('aria-expanded', 'true');
			}

			list.style.maxHeight = '0px';
			list.style.opacity = '0';
			// Force reflow before expanding to measured height.
			void list.offsetHeight;
			list.style.maxHeight = `${list.scrollHeight}px`;
			list.style.opacity = '1';
			return;
		}

		list.style.maxHeight = `${list.scrollHeight}px`;
		void list.offsetHeight;
		list.style.maxHeight = '0px';
		list.style.opacity = '0';
		col.classList.remove('is_open');
		if (btn) {
			btn.setAttribute('aria-expanded', 'false');
		}
	};

	/**
	 * Sync footer accordion heights for current viewport.
	 */
	const syncFooterCols = () => {
		footerCols.forEach((col) => {
			const list = col.querySelector('.footer_col_list');

			if (!list) {
				return;
			}

			if (!footerMobileMq.matches) {
				list.style.maxHeight = '';
				list.style.opacity = '';
				return;
			}

			if (col.classList.contains('is_open')) {
				list.style.maxHeight = `${list.scrollHeight}px`;
				list.style.opacity = '1';
			} else {
				list.style.maxHeight = '0px';
				list.style.opacity = '0';
			}
		});
	};

	document.querySelectorAll('.footer_col_toggle').forEach((toggle) => {
		toggle.addEventListener('click', () => {
			if (!footerMobileMq.matches) {
				return;
			}

			const col = toggle.closest('.footer_col');

			if (!col) {
				return;
			}

			const isOpen = col.classList.contains('is_open');

			footerCols.forEach((openCol) => {
				if (openCol !== col && openCol.classList.contains('is_open')) {
					setFooterColOpen(openCol, false);
				}
			});

			setFooterColOpen(col, !isOpen);
		});
	});

	syncFooterCols();
	footerMobileMq.addEventListener('change', syncFooterCols);
	window.addEventListener('resize', syncFooterCols);

	// FAQ spoilers (use_shcho): smooth open/close, one item open at a time.
	const useShchoItems = document.querySelectorAll('.use_shcho_item');

	/**
	 * Animate FAQ answer open/close via max-height.
	 *
	 * @param {HTMLElement} item Accordion item.
	 * @param {boolean} open Whether to open.
	 */
	const setUseShchoOpen = (item, open) => {
		const answer = item.querySelector('.use_shcho_answer');
		const btn = item.querySelector('.use_shcho_toggle');

		if (!answer) {
			return;
		}

		if (open) {
			item.classList.add('is_open');
			if (btn) {
				btn.setAttribute('aria-expanded', 'true');
			}

			answer.style.maxHeight = '0px';
			answer.style.opacity = '0';
			void answer.offsetHeight;
			answer.style.maxHeight = `${answer.scrollHeight}px`;
			answer.style.opacity = '1';
			return;
		}

		answer.style.maxHeight = `${answer.scrollHeight}px`;
		void answer.offsetHeight;
		answer.style.maxHeight = '0px';
		answer.style.opacity = '0';
		item.classList.remove('is_open');
		if (btn) {
			btn.setAttribute('aria-expanded', 'false');
		}
	};

	/**
	 * Sync open FAQ answers to measured height (resize-safe).
	 */
	const syncUseShcho = () => {
		useShchoItems.forEach((item) => {
			const answer = item.querySelector('.use_shcho_answer');

			if (!answer) {
				return;
			}

			if (item.classList.contains('is_open')) {
				answer.style.maxHeight = `${answer.scrollHeight}px`;
				answer.style.opacity = '1';
			} else {
				answer.style.maxHeight = '0px';
				answer.style.opacity = '0';
			}
		});
	};

	document.querySelectorAll('.use_shcho_toggle').forEach((toggle) => {
		toggle.addEventListener('click', () => {
			const item = toggle.closest('.use_shcho_item');

			if (!item) {
				return;
			}

			const isOpen = item.classList.contains('is_open');

			useShchoItems.forEach((openItem) => {
				if (openItem !== item && openItem.classList.contains('is_open')) {
					setUseShchoOpen(openItem, false);
				}
			});

			setUseShchoOpen(item, !isOpen);
		});
	});

	syncUseShcho();
	window.addEventListener('resize', syncUseShcho);

	// Price accordion (in_iektsiina_terapiya): smooth open/close, items independent.
	const priceItems = document.querySelectorAll('.in_iektsiina_terapiya_item');

	/**
	 * Animate price spoiler open/close via max-height.
	 *
	 * @param {HTMLElement} item Accordion item.
	 * @param {boolean} open Whether to open.
	 */
	const setPriceSpoilerOpen = (item, open) => {
		const body = item.querySelector('.in_iektsiina_terapiya_body');
		const btn = item.querySelector('.in_iektsiina_terapiya_toggle');

		if (!body) {
			return;
		}

		if (open) {
			item.classList.add('is_open');
			if (btn) {
				btn.setAttribute('aria-expanded', 'true');
			}

			body.style.maxHeight = 'none';
			const height = body.scrollHeight;
			body.style.maxHeight = '0px';
			body.style.opacity = '0';
			void body.offsetHeight;
			body.style.maxHeight = `${height}px`;
			body.style.opacity = '1';
			return;
		}

		body.style.maxHeight = `${body.scrollHeight}px`;
		void body.offsetHeight;
		body.style.maxHeight = '0px';
		body.style.opacity = '0';
		item.classList.remove('is_open');
		if (btn) {
			btn.setAttribute('aria-expanded', 'false');
		}
	};

	/**
	 * Sync open price spoilers to measured height (resize-safe).
	 */
	const syncPriceSpoilers = () => {
		priceItems.forEach((item) => {
			const body = item.querySelector('.in_iektsiina_terapiya_body');

			if (!body) {
				return;
			}

			if (item.classList.contains('is_open')) {
				body.style.maxHeight = 'none';
				const height = body.scrollHeight;
				body.style.maxHeight = `${height}px`;
				body.style.opacity = '1';
			} else {
				body.style.maxHeight = '0px';
				body.style.opacity = '0';
			}
		});
	};

	document.querySelectorAll('.in_iektsiina_terapiya_toggle').forEach((toggle) => {
		toggle.addEventListener('click', () => {
			const item = toggle.closest('.in_iektsiina_terapiya_item');

			if (!item) {
				return;
			}

			setPriceSpoilerOpen(item, !item.classList.contains('is_open'));
		});
	});

	syncPriceSpoilers();
	requestAnimationFrame(syncPriceSpoilers);
	window.addEventListener('load', syncPriceSpoilers);
	window.addEventListener('resize', syncPriceSpoilers);

	/**
	 * Format digits as UA phone mask: (099) 999-99-99.
	 *
	 * @param {string} value Raw input value.
	 * @return {string} Formatted phone.
	 */
	const formatUaPhoneMask = (value) => {
		const digits = String(value).replace(/\D/g, '').slice(0, 10);

		if (!digits.length) {
			return '';
		}

		let formatted = '(' + digits.slice(0, Math.min(3, digits.length));

		if (digits.length >= 3) {
			formatted += ')';
		}

		if (digits.length > 3) {
			formatted += ' ' + digits.slice(3, Math.min(6, digits.length));
		}

		if (digits.length >= 6) {
			formatted += '-' + digits.slice(6, Math.min(8, digits.length));
		}

		if (digits.length >= 8) {
			formatted += '-' + digits.slice(8, Math.min(10, digits.length));
		}

		return formatted;
	};

	/**
	 * Count digit characters before a caret position.
	 *
	 * @param {string} value Field value.
	 * @param {number} caret Caret index.
	 * @return {number} Digit count.
	 */
	const countDigitsBefore = (value, caret) => {
		return String(value)
			.slice(0, Math.max(0, caret))
			.replace(/\D/g, '').length;
	};

	/**
	 * Caret index after N digits in a formatted phone string.
	 *
	 * @param {string} formatted Formatted value.
	 * @param {number} digitCount Digits before caret.
	 * @return {number} Caret index.
	 */
	const caretPosAfterDigits = (formatted, digitCount) => {
		if (digitCount <= 0) {
			return formatted.startsWith('(') ? 1 : 0;
		}

		let seen = 0;

		for (let i = 0; i < formatted.length; i += 1) {
			if (/\d/.test(formatted[i])) {
				seen += 1;
				if (seen >= digitCount) {
					return i + 1;
				}
			}
		}

		return formatted.length;
	};

	/**
	 * Bind phone mask to a tel input.
	 *
	 * @param {HTMLInputElement} input Tel field.
	 */
	const bindPhoneMask = (input) => {
		if (!input || input.dataset.phoneMaskBound === '1') {
			return;
		}

		const defaultPlaceholder = input.getAttribute('placeholder') || 'Вкажіть свій номер телефону';
		const maskHint = '(099) 999-99-99';

		input.dataset.phoneMaskBound = '1';
		input.dataset.phonePlaceholder = defaultPlaceholder;
		input.setAttribute('maxlength', '15');
		input.setAttribute('inputmode', 'numeric');
		input.setAttribute('placeholder', defaultPlaceholder);

		if (input.value) {
			input.value = formatUaPhoneMask(input.value);
		}

		/**
		 * Sync placeholder: default / mask hint / hidden by value.
		 */
		const syncPhonePlaceholder = () => {
			const hasValue = Boolean(input.value.replace(/\D/g, '').length);

			if (hasValue) {
				input.setAttribute('placeholder', '');
				return;
			}

			if (document.activeElement === input) {
				input.setAttribute('placeholder', maskHint);
				return;
			}

			input.setAttribute('placeholder', defaultPlaceholder);
		};

		input.addEventListener('focus', () => {
			syncPhonePlaceholder();
		});

		input.addEventListener('blur', () => {
			input.value = formatUaPhoneMask(input.value);
			syncPhonePlaceholder();
		});

		input.addEventListener('keydown', (event) => {
			// Backspace on a mask char should remove the previous digit.
			if (event.key !== 'Backspace' || input.selectionStart !== input.selectionEnd) {
				return;
			}

			const pos = input.selectionStart || 0;

			if (pos <= 0) {
				return;
			}

			const prevChar = input.value[pos - 1];

			if (/\d/.test(prevChar)) {
				return;
			}

			const digitsBefore = countDigitsBefore(input.value, pos);

			if (digitsBefore <= 0) {
				return;
			}

			event.preventDefault();

			const digits = input.value.replace(/\D/g, '');
			const nextDigits = digits.slice(0, digitsBefore - 1) + digits.slice(digitsBefore);
			const formatted = formatUaPhoneMask(nextDigits);

			input.value = formatted;
			const nextPos = caretPosAfterDigits(formatted, digitsBefore - 1);
			input.setSelectionRange(nextPos, nextPos);
			syncPhonePlaceholder();
		});

		input.addEventListener('input', () => {
			const prevCaret = input.selectionStart || 0;
			const digitsBefore = countDigitsBefore(input.value, prevCaret);
			const formatted = formatUaPhoneMask(input.value);

			input.value = formatted;

			const nextPos = caretPosAfterDigits(formatted, digitsBefore);
			input.setSelectionRange(nextPos, nextPos);
			syncPhonePlaceholder();
		});
	};

	/**
	 * Init phone masks in forms (static + CF7).
	 *
	 * @param {ParentNode} [root=document] Scope root.
	 */
	const initPhoneMasks = (root = document) => {
		root.querySelectorAll('.consult_form input[type="tel"], input.wpcf7-tel[type="tel"]').forEach((input) => {
			bindPhoneMask(input);
		});
	};

	initPhoneMasks();
	document.addEventListener('wpcf7init', (event) => {
		initPhoneMasks(event.target);
	});

	/**
	 * How many clone slides are needed so the last originals still fill the viewport.
	 *
	 * @param {HTMLElement} viewport Slider viewport.
	 * @param {HTMLElement} track Slider track.
	 * @param {HTMLElement} sampleSlide First original slide.
	 * @return {number} Clone count.
	 */
	const getLoopCloneCount = (viewport, track, sampleSlide) => {
		if (!viewport || !track || !sampleSlide) {
			return 0;
		}

		const gap = parseFloat(getComputedStyle(track).columnGap || getComputedStyle(track).gap) || 0;
		const slideW = sampleSlide.getBoundingClientRect().width;

		if (slideW <= 0) {
			return 0;
		}

		const visible = (viewport.clientWidth + gap) / (slideW + gap);

		return Math.max(0, Math.ceil(visible) - 1);
	};

	/**
	 * Append loop clones after originals (fills the right edge on late indices).
	 *
	 * @param {Object} options Options.
	 * @param {HTMLElement} options.track Track element.
	 * @param {HTMLElement[]} options.originals Original slides.
	 * @param {HTMLElement[]} options.clones Clone registry (mutated).
	 * @param {number} options.need Clone count.
	 */
	const syncLoopClones = ({ track, originals, clones, need }) => {
		while (clones.length) {
			const node = clones.pop();
			if (node && node.parentNode) {
				node.parentNode.removeChild(node);
			}
		}

		for (let i = 0; i < need; i++) {
			const source = originals[i % originals.length];
			const clone = source.cloneNode(true);
			clone.classList.add('is_clone');
			clone.setAttribute('aria-hidden', 'true');
			clone.querySelectorAll('a').forEach((link) => {
				link.setAttribute('tabindex', '-1');
			});
			track.appendChild(clone);
			clones.push(clone);
		}
	};

	/**
	 * Pointer drag / swipe for a transform-based slider (mouse + touch).
	 *
	 * @param {Object} options Options.
	 * @param {HTMLElement} options.viewport Drag surface.
	 * @param {HTMLElement} options.track Moving track.
	 * @param {() => number} options.getIndex Current index getter.
	 * @param {(next: number) => void} options.goTo Navigate callback.
	 * @param {() => boolean} [options.isEnabled] Whether drag is active.
	 */
	const bindSliderDrag = ({ viewport, track, getIndex, goTo, isEnabled }) => {
		if (!viewport || !track) {
			return;
		}

		let pointerId = null;
		let startX = 0;
		let startY = 0;
		let baseOffset = 0;
		let moved = false;
		let lockedAxis = '';

		/**
		 * Current track translate X (px).
		 *
		 * @return {number} Offset.
		 */
		const readOffset = () => {
			const match = /translate3d\(\s*(-?[\d.]+)px/.exec(track.style.transform || '');
			return match ? -parseFloat(match[1]) : 0;
		};

		/**
		 * Suppress the next click after a drag.
		 *
		 * @param {Event} event Click event.
		 */
		const suppressClick = (event) => {
			event.preventDefault();
			event.stopPropagation();
			viewport.removeEventListener('click', suppressClick, true);
		};

		viewport.addEventListener('pointerdown', (event) => {
			if (typeof isEnabled === 'function' && !isEnabled()) {
				return;
			}

			if (event.button !== 0 && event.pointerType === 'mouse') {
				return;
			}

			pointerId = event.pointerId;
			startX = event.clientX;
			startY = event.clientY;
			baseOffset = readOffset();
			moved = false;
			lockedAxis = '';
			viewport.classList.add('is_dragging');
			track.classList.add('is_dragging');

			try {
				viewport.setPointerCapture(pointerId);
			} catch (err) {
				// Ignore capture errors on older engines.
			}
		});

		viewport.addEventListener('pointermove', (event) => {
			if (pointerId === null || event.pointerId !== pointerId) {
				return;
			}

			const dx = event.clientX - startX;
			const dy = event.clientY - startY;

			if (!lockedAxis) {
				if (Math.abs(dx) < 6 && Math.abs(dy) < 6) {
					return;
				}

				lockedAxis = Math.abs(dx) >= Math.abs(dy) ? 'x' : 'y';

				if (lockedAxis === 'y') {
					return;
				}
			}

			if (lockedAxis !== 'x') {
				return;
			}

			event.preventDefault();
			moved = true;
			track.style.transform = 'translate3d(' + -(baseOffset - dx) + 'px, 0, 0)';
		});

		/**
		 * Finish drag and snap to nearest step.
		 *
		 * @param {PointerEvent} event Pointer event.
		 */
		const endDrag = (event) => {
			if (pointerId === null || event.pointerId !== pointerId) {
				return;
			}

			const dx = event.clientX - startX;
			const wasDrag = moved && lockedAxis === 'x';

			pointerId = null;
			viewport.classList.remove('is_dragging');
			track.classList.remove('is_dragging');

			try {
				viewport.releasePointerCapture(event.pointerId);
			} catch (err) {
				// Ignore.
			}

			if (!wasDrag) {
				return;
			}

			viewport.addEventListener('click', suppressClick, true);

			const threshold = Math.max(40, viewport.clientWidth * 0.12);
			const current = getIndex();

			if (dx <= -threshold) {
				goTo(current + 1);
			} else if (dx >= threshold) {
				goTo(current - 1);
			} else {
				goTo(current);
			}
		};

		viewport.addEventListener('pointerup', endDrag);
		viewport.addEventListener('pointercancel', endDrag);
	};

	// Requests slider (mobile only): 2 cards per slide, step 1 + swipe.
	document.querySelectorAll('[data-requests-slider]').forEach((slider) => {
		const viewport = slider.querySelector('.requests_viewport');
		const track = slider.querySelector('.requests_track');
		const slides = Array.from(slider.querySelectorAll('.requests_slide'));
		const dotsWrap = slider.querySelector('[data-requests-dots]');
		const nextBtn = slider.querySelector('[data-requests-next]');
		const desktopMq = window.matchMedia('(min-width: 992px)');

		if (!track || !slides.length || !dotsWrap) {
			return;
		}

		let index = 0;

		/**
		 * Build pagination dots.
		 */
		const buildDots = () => {
			dotsWrap.innerHTML = '';

			slides.forEach((_, i) => {
				const dot = document.createElement('button');
				dot.type = 'button';
				dot.className = 'requests_dot' + (i === index ? ' is_active' : '');
				dot.setAttribute('aria-label', 'Слайд ' + (i + 1));
				dot.setAttribute('aria-selected', i === index ? 'true' : 'false');
				dot.addEventListener('click', () => {
					goTo(i);
				});
				dotsWrap.appendChild(dot);
			});
		};

		/**
		 * Sync active dot state.
		 */
		const syncDots = () => {
			dotsWrap.querySelectorAll('.requests_dot').forEach((dot, i) => {
				const isActive = i === index;
				dot.classList.toggle('is_active', isActive);
				dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
			});
		};

		/**
		 * Move track to slide index (step 1).
		 *
		 * @param {number} nextIndex Target slide.
		 */
		const goTo = (nextIndex) => {
			if (desktopMq.matches) {
				track.style.transform = '';
				return;
			}

			const total = slides.length;
			index = ((nextIndex % total) + total) % total;

			const slide = slides[index];
			const offset = slide ? slide.offsetLeft : 0;
			track.style.transform = 'translate3d(' + -offset + 'px, 0, 0)';
			syncDots();
		};

		buildDots();
		goTo(0);

		if (nextBtn) {
			nextBtn.addEventListener('click', () => {
				goTo(index + 1);
			});
		}

		bindSliderDrag({
			viewport,
			track,
			getIndex: () => index,
			goTo,
			isEnabled: () => !desktopMq.matches,
		});

		window.addEventListener('resize', () => {
			goTo(index);
		});

		if (typeof desktopMq.addEventListener === 'function') {
			desktopMq.addEventListener('change', () => {
				goTo(index);
			});
		} else if (typeof desktopMq.addListener === 'function') {
			desktopMq.addListener(() => {
				goTo(index);
			});
		}
	});

	// Doctors slider: step 1; loop clones keep the row full; drag + swipe.
	document.querySelectorAll('[data-doctors-slider]').forEach((slider) => {
		const viewport = slider.querySelector('.doctors_viewport');
		const track = slider.querySelector('.doctors_track');
		const originals = Array.from(slider.querySelectorAll('.doctors_slide:not(.is_clone)'));
		const dotsWrap = slider.querySelector('[data-doctors-dots]');
		const nextBtn = slider.querySelector('[data-doctors-next]');

		if (!viewport || !track || !originals.length || !dotsWrap) {
			return;
		}

		let index = 0;
		const clones = [];

		/**
		 * Number of dots (one per original slide).
		 *
		 * @return {number} Page count.
		 */
		const getPageCount = () => originals.length;

		/**
		 * Refresh loop clones for current layout.
		 */
		const syncClones = () => {
			const need = getLoopCloneCount(viewport, track, originals[0]);
			syncLoopClones({ track, originals, clones, need });
		};

		/**
		 * Build pagination dots.
		 */
		const buildDots = () => {
			const pages = getPageCount();
			dotsWrap.innerHTML = '';

			if (index > pages - 1) {
				index = pages - 1;
			}

			for (let i = 0; i < pages; i++) {
				const dot = document.createElement('button');
				dot.type = 'button';
				dot.className = 'doctors_dot' + (i === index ? ' is_active' : '');
				dot.setAttribute('aria-label', 'Слайд ' + (i + 1));
				dot.setAttribute('aria-selected', i === index ? 'true' : 'false');
				dot.addEventListener('click', () => {
					goTo(i);
				});
				dotsWrap.appendChild(dot);
			}
		};

		/**
		 * Sync active dot state.
		 */
		const syncDots = () => {
			dotsWrap.querySelectorAll('.doctors_dot').forEach((dot, i) => {
				const isActive = i === index;
				dot.classList.toggle('is_active', isActive);
				dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
			});
		};

		/**
		 * Move track by one slide (step 1).
		 *
		 * @param {number} nextIndex Target slide.
		 */
		const goTo = (nextIndex) => {
			const pages = getPageCount();
			index = ((nextIndex % pages) + pages) % pages;

			const slide = originals[index];
			const offset = slide ? slide.offsetLeft : 0;

			track.style.transform = 'translate3d(' + -offset + 'px, 0, 0)';
			syncDots();
		};

		/**
		 * Refresh clones, dots and position.
		 *
		 * @param {number} page Target page.
		 */
		const refresh = (page) => {
			syncClones();
			buildDots();
			goTo(page);
		};

		refresh(0);

		if (nextBtn) {
			nextBtn.addEventListener('click', () => {
				goTo(index + 1);
			});
		}

		bindSliderDrag({
			viewport,
			track,
			getIndex: () => index,
			goTo,
		});

		window.addEventListener('resize', () => {
			refresh(index);
		});
	});

	// Results / before-after: step 1; loop clones; drag + swipe.
	document.querySelectorAll('[data-results-slider]').forEach((slider) => {
		const track = slider.querySelector('.results_track');
		const viewport = slider.querySelector('.results_viewport');
		const originals = Array.from(slider.querySelectorAll('.results_slide:not(.is_clone)'));
		const dotsWrap = slider.querySelector('[data-results-dots]');
		const nextBtn = slider.querySelector('[data-results-next]');

		if (!track || !viewport || !originals.length || !dotsWrap) {
			return;
		}

		let index = 0;
		const clones = [];

		/**
		 * Number of dots (one per original slide).
		 *
		 * @return {number} Page count.
		 */
		const getPageCount = () => originals.length;

		/**
		 * Refresh loop clones for current layout.
		 */
		const syncClones = () => {
			const need = getLoopCloneCount(viewport, track, originals[0]);
			syncLoopClones({ track, originals, clones, need });
		};

		/**
		 * Build pagination dots.
		 */
		const buildDots = () => {
			const pages = getPageCount();
			dotsWrap.innerHTML = '';

			if (index > pages - 1) {
				index = pages - 1;
			}

			for (let i = 0; i < pages; i++) {
				const dot = document.createElement('button');
				dot.type = 'button';
				dot.className = 'results_dot' + (i === index ? ' is_active' : '');
				dot.setAttribute('aria-label', 'Слайд ' + (i + 1));
				dot.setAttribute('aria-selected', i === index ? 'true' : 'false');
				dot.addEventListener('click', () => {
					goTo(i);
				});
				dotsWrap.appendChild(dot);
			}
		};

		/**
		 * Sync active dot state.
		 */
		const syncDots = () => {
			dotsWrap.querySelectorAll('.results_dot').forEach((dot, i) => {
				const isActive = i === index;
				dot.classList.toggle('is_active', isActive);
				dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
			});
		};

		/**
		 * Move track by one slide (step 1).
		 *
		 * @param {number} nextIndex Target slide.
		 */
		const goTo = (nextIndex) => {
			const pages = getPageCount();
			index = ((nextIndex % pages) + pages) % pages;

			const slide = originals[index];
			const offset = slide ? slide.offsetLeft : 0;

			track.style.transform = 'translate3d(' + -offset + 'px, 0, 0)';
			syncDots();
		};

		/**
		 * Refresh clones, dots and position.
		 *
		 * @param {number} page Target page.
		 */
		const refresh = (page) => {
			syncClones();
			buildDots();
			goTo(page);
		};

		refresh(0);

		if (nextBtn) {
			nextBtn.addEventListener('click', () => {
				goTo(index + 1);
			});
		}

		bindSliderDrag({
			viewport,
			track,
			getIndex: () => index,
			goTo,
		});

		window.addEventListener('resize', () => {
			refresh(index);
		});
	});

	// Reviews slider (vidhuky): one slide at a time.
	document.querySelectorAll('[data-vidhuky-slider]').forEach((slider) => {
		const track = slider.querySelector('.vidhuky_track');
		const viewport = slider.querySelector('.vidhuky_viewport');
		const originals = Array.from(slider.querySelectorAll('.vidhuky_slide:not(.is_clone)'));
		const dotsWrap = slider.querySelector('[data-vidhuky-dots]');
		const nextBtn = slider.querySelector('[data-vidhuky-next]');

		if (!track || !viewport || !originals.length || !dotsWrap) {
			return;
		}

		let index = 0;

		/**
		 * Sync slide widths to viewport (one full slide).
		 */
		const syncSlideWidths = () => {
			const width = viewport.clientWidth;

			slider.querySelectorAll('.vidhuky_slide').forEach((slide) => {
				slide.style.width = width + 'px';
				slide.style.flexBasis = width + 'px';
			});
		};

		/**
		 * Build pagination dots.
		 */
		const buildDots = () => {
			const pages = originals.length;
			dotsWrap.innerHTML = '';

			if (index > pages - 1) {
				index = pages - 1;
			}

			for (let i = 0; i < pages; i++) {
				const dot = document.createElement('button');
				dot.type = 'button';
				dot.className = 'results_dot' + (i === index ? ' is_active' : '');
				dot.setAttribute('aria-label', 'Відгук ' + (i + 1));
				dot.setAttribute('aria-selected', i === index ? 'true' : 'false');
				dot.addEventListener('click', () => {
					goTo(i);
				});
				dotsWrap.appendChild(dot);
			}
		};

		/**
		 * Sync active dot state.
		 */
		const syncDots = () => {
			dotsWrap.querySelectorAll('.results_dot').forEach((dot, i) => {
				const isActive = i === index;
				dot.classList.toggle('is_active', isActive);
				dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
			});
		};

		/**
		 * Move track by one slide.
		 *
		 * @param {number} nextIndex Target slide.
		 */
		const goTo = (nextIndex) => {
			const pages = originals.length;
			index = ((nextIndex % pages) + pages) % pages;

			const slide = originals[index];
			const offset = slide ? slide.offsetLeft : 0;

			track.style.transform = 'translate3d(' + -offset + 'px, 0, 0)';
			syncDots();
		};

		/**
		 * Refresh widths, dots and position.
		 *
		 * @param {number} page Target page.
		 */
		const refresh = (page) => {
			syncSlideWidths();
			buildDots();
			goTo(page);
		};

		refresh(0);

		if (nextBtn) {
			nextBtn.addEventListener('click', () => {
				goTo(index + 1);
			});
		}

		bindSliderDrag({
			viewport,
			track,
			getIndex: () => index,
			goTo,
		});

		window.addEventListener('resize', () => {
			refresh(index);
		});
	});

	// Single "До та після" (do_ta_pislya): 1 slide mob / 2 desk, step 1.
	document.querySelectorAll('[data-do-ta-pislya-slider]').forEach((slider) => {
		const track = slider.querySelector('.do_ta_pislya_track');
		const viewport = slider.querySelector('.do_ta_pislya_viewport');
		const originals = Array.from(slider.querySelectorAll('.do_ta_pislya_slide:not(.is_clone)'));
		const dotsWrap = slider.querySelector('[data-do-ta-pislya-dots]');
		const nextBtn = slider.querySelector('[data-do-ta-pislya-next]');
		const deskMq = window.matchMedia('(min-width: 1024px)');

		if (!track || !viewport || !originals.length || !dotsWrap) {
			return;
		}

		let index = 0;
		const clones = [];
		const gap = 20;

		/**
		 * Number of dots (one per original slide).
		 *
		 * @return {number} Page count.
		 */
		const getPageCount = () => originals.length;

		/**
		 * Visible slides: 1 on mobile, 2 on desktop.
		 *
		 * @return {number} Visible count.
		 */
		const getVisibleCount = () => (deskMq.matches ? 2 : 1);

		/**
		 * Set each slide width from viewport.
		 */
		const syncSlideWidths = () => {
			const visible = getVisibleCount();
			const width = (viewport.clientWidth - gap * (visible - 1)) / visible;

			if (width <= 0) {
				return;
			}

			slider.querySelectorAll('.do_ta_pislya_slide').forEach((slide) => {
				slide.style.width = width + 'px';
				slide.style.flexBasis = width + 'px';
			});
		};

		/**
		 * Refresh loop clones for current layout (fills 2nd slot on desk).
		 */
		const syncClones = () => {
			const need = getLoopCloneCount(viewport, track, originals[0]);
			syncLoopClones({ track, originals, clones, need });
			syncSlideWidths();
		};

		/**
		 * Build pagination dots.
		 */
		const buildDots = () => {
			const pages = getPageCount();
			dotsWrap.innerHTML = '';

			if (index > pages - 1) {
				index = pages - 1;
			}

			for (let i = 0; i < pages; i++) {
				const dot = document.createElement('button');
				dot.type = 'button';
				dot.className = 'results_dot' + (i === index ? ' is_active' : '');
				dot.setAttribute('aria-label', 'Слайд ' + (i + 1));
				dot.setAttribute('aria-selected', i === index ? 'true' : 'false');
				dot.addEventListener('click', () => {
					goTo(i);
				});
				dotsWrap.appendChild(dot);
			}
		};

		/**
		 * Sync active dot state.
		 */
		const syncDots = () => {
			dotsWrap.querySelectorAll('.results_dot').forEach((dot, i) => {
				const isActive = i === index;
				dot.classList.toggle('is_active', isActive);
				dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
			});
		};

		/**
		 * Move track by one slide.
		 *
		 * @param {number} nextIndex Target slide.
		 */
		const goTo = (nextIndex) => {
			const pages = getPageCount();
			index = ((nextIndex % pages) + pages) % pages;

			const slide = originals[index];
			const offset = slide ? slide.offsetLeft : 0;

			track.style.transform = 'translate3d(' + -offset + 'px, 0, 0)';
			syncDots();
		};

		/**
		 * Refresh widths, clones, dots and position.
		 *
		 * @param {number} page Target page.
		 */
		const refresh = (page) => {
			syncSlideWidths();
			syncClones();
			buildDots();
			goTo(page);
		};

		refresh(0);

		const imgs = Array.from(slider.querySelectorAll('.do_ta_pislya_img'));
		Promise.all(
			imgs.map((img) => {
				if (img.complete) {
					return Promise.resolve();
				}

				return new Promise((resolve) => {
					img.addEventListener('load', resolve, { once: true });
					img.addEventListener('error', resolve, { once: true });
				});
			})
		).then(() => {
			requestAnimationFrame(() => {
				refresh(index);
			});
		});

		if (nextBtn) {
			nextBtn.addEventListener('click', () => {
				goTo(index + 1);
			});
		}

		bindSliderDrag({
			viewport,
			track,
			getIndex: () => index,
			goTo,
		});

		window.addEventListener('resize', () => {
			refresh(index);
		});

		if (typeof deskMq.addEventListener === 'function') {
			deskMq.addEventListener('change', () => {
				refresh(index);
			});
		} else if (typeof deskMq.addListener === 'function') {
			deskMq.addListener(() => {
				refresh(index);
			});
		}
	});

	/**
	 * Results galleries (rezultaty_yakym): one tab → one panel with fade.
	 */
	document.querySelectorAll('[data-rezultaty-tabs]').forEach((root) => {
		const tabs = Array.from(root.querySelectorAll('[data-rezultaty-tab]'));
		const panels = Array.from(root.querySelectorAll('[data-rezultaty-panel]'));

		if (!tabs.length || !panels.length) {
			return;
		}

		/**
		 * Activate gallery tab / panel.
		 *
		 * @param {string} id Gallery id.
		 * @param {HTMLElement} [focusTab] Tab to focus after switch.
		 */
		const activate = (id, focusTab) => {
			const nextPanel = panels.find((panel) => panel.getAttribute('data-rezultaty-panel') === id);

			if (!nextPanel || nextPanel.classList.contains('is_active')) {
				return;
			}

			tabs.forEach((tab) => {
				const isActive = tab.getAttribute('data-rezultaty-tab') === id;
				tab.classList.toggle('is_active', isActive);
				tab.setAttribute('aria-selected', String(isActive));
				tab.setAttribute('tabindex', isActive ? '0' : '-1');
			});

			panels.forEach((panel) => {
				const isActive = panel === nextPanel;
				panel.classList.toggle('is_active', isActive);
				panel.setAttribute('aria-hidden', String(!isActive));
			});

			if (focusTab) {
				focusTab.focus();
			}
		};

		tabs.forEach((tab, index) => {
			tab.addEventListener('click', () => {
				activate(tab.getAttribute('data-rezultaty-tab') || '');
			});

			tab.addEventListener('keydown', (event) => {
				let nextIndex = index;

				if (event.key === 'ArrowRight' || event.key === 'ArrowDown') {
					nextIndex = (index + 1) % tabs.length;
				} else if (event.key === 'ArrowLeft' || event.key === 'ArrowUp') {
					nextIndex = (index - 1 + tabs.length) % tabs.length;
				} else if (event.key === 'Home') {
					nextIndex = 0;
				} else if (event.key === 'End') {
					nextIndex = tabs.length - 1;
				} else {
					return;
				}

				event.preventDefault();
				const nextTab = tabs[nextIndex];
				activate(nextTab.getAttribute('data-rezultaty-tab') || '', nextTab);
			});
		});
	});

	/**
	 * Doctors page tabs (likari): switch shuffled lists with fade.
	 */
	document.querySelectorAll('[data-likari-tabs]').forEach((root) => {
		const page = root.closest('.likari') || document;
		const tabs = Array.from(root.querySelectorAll('[data-likari-tab]'));
		const panels = Array.from(page.querySelectorAll('[data-likari-panel]'));

		if (!tabs.length || !panels.length) {
			return;
		}

		/**
		 * Activate doctors category tab / panel.
		 *
		 * @param {string} id Panel id.
		 * @param {HTMLElement} [focusTab] Tab to focus after switch.
		 */
		const activate = (id, focusTab) => {
			const nextPanel = panels.find((panel) => panel.getAttribute('data-likari-panel') === id);

			if (!nextPanel || nextPanel.classList.contains('is_active')) {
				return;
			}

			tabs.forEach((tab) => {
				const isActive = tab.getAttribute('data-likari-tab') === id;
				tab.classList.toggle('is_active', isActive);
				tab.setAttribute('aria-selected', String(isActive));
				tab.setAttribute('tabindex', isActive ? '0' : '-1');
			});

			panels.forEach((panel) => {
				const isActive = panel === nextPanel;
				panel.classList.toggle('is_active', isActive);
				panel.setAttribute('aria-hidden', String(!isActive));
			});

			if (focusTab) {
				focusTab.focus();
			}
		};

		tabs.forEach((tab, index) => {
			tab.addEventListener('click', () => {
				activate(tab.getAttribute('data-likari-tab') || '');
			});

			tab.addEventListener('keydown', (event) => {
				let nextIndex = index;

				if (event.key === 'ArrowRight' || event.key === 'ArrowDown') {
					nextIndex = (index + 1) % tabs.length;
				} else if (event.key === 'ArrowLeft' || event.key === 'ArrowUp') {
					nextIndex = (index - 1 + tabs.length) % tabs.length;
				} else if (event.key === 'Home') {
					nextIndex = 0;
				} else if (event.key === 'End') {
					nextIndex = tabs.length - 1;
				} else {
					return;
				}

				event.preventDefault();
				const nextTab = tabs[nextIndex];
				activate(nextTab.getAttribute('data-likari-tab') || '', nextTab);
			});
		});
	});

	// Reviews page: load more cards (desk +6, mob +3).
	document.querySelectorAll('[data-reviews-list]').forEach((list) => {
		const items = Array.from(list.querySelectorAll('[data-review-item]'));
		const more = list.parentElement
			? list.parentElement.querySelector('[data-reviews-more]')
			: null;
		const deskMq = window.matchMedia('(min-width: 1024px)');

		if (!items.length || !more) {
			return;
		}

		/**
		 * Visible batch size for current viewport.
		 *
		 * @return {number} Step / initial count.
		 */
		const getBatch = () => (deskMq.matches ? 6 : 3);

		let visibleCount = getBatch();

		/**
		 * Sync card visibility and more-button state.
		 *
		 * @param {boolean} animate Whether to animate newly shown cards.
		 */
		const applyVisibility = (animate) => {
			items.forEach((item, index) => {
				const shouldShow = index < visibleCount;
				const wasHidden = item.classList.contains('is_hidden');

				if (shouldShow) {
					item.classList.remove('is_hidden');

					if (animate && wasHidden) {
						item.classList.remove('is_revealing');
						void item.offsetWidth;
						item.classList.add('is_revealing');
						item.addEventListener(
							'animationend',
							() => {
								item.classList.remove('is_revealing');
							},
							{ once: true }
						);
					}
				} else {
					item.classList.add('is_hidden');
					item.classList.remove('is_revealing');
				}
			});

			more.hidden = visibleCount >= items.length;
		};

		more.addEventListener('click', () => {
			visibleCount = Math.min(items.length, visibleCount + getBatch());
			applyVisibility(true);
		});

		const onViewportChange = () => {
			const minVisible = getBatch();

			if (visibleCount < minVisible) {
				visibleCount = minVisible;
			}

			applyVisibility(false);
		};

		if (typeof deskMq.addEventListener === 'function') {
			deskMq.addEventListener('change', onViewportChange);
		} else if (typeof deskMq.addListener === 'function') {
			deskMq.addListener(onViewportChange);
		}

		applyVisibility(false);

		const section = list.closest('.onovlenyi_prostir');
		if (section) {
			section.classList.add('is_ready');
		}
	});

	// YouTube video modal (play → autoplay with sound).
	document.querySelectorAll('[data-video-modal]').forEach((modal) => {
		const root = modal.closest('section') || modal.parentElement;
		const iframe = modal.querySelector('[data-video-iframe]');
		const openButtons = root
			? root.querySelectorAll('[data-video-open]')
			: [];
		const closeTargets = modal.querySelectorAll('[data-video-modal-close]');

		if (!iframe || !openButtons.length) {
			return;
		}

		/**
		 * Build YouTube embed URL with autoplay (unmuted after user gesture).
		 *
		 * @param {string} videoId YouTube video id.
		 * @return {string} Embed URL.
		 */
		const buildEmbedUrl = (videoId) => {
			const params = new URLSearchParams({
				autoplay: '1',
				mute: '0',
				rel: '0',
				playsinline: '1',
				modestbranding: '1',
			});

			return `https://www.youtube.com/embed/${encodeURIComponent(videoId)}?${params.toString()}`;
		};

		/**
		 * Open modal and start playback.
		 *
		 * @param {string} videoId YouTube video id.
		 * @param {HTMLElement|null} trigger Button that opened the modal.
		 */
		const openModal = (videoId, trigger) => {
			if (!videoId) {
				return;
			}

			iframe.src = buildEmbedUrl(videoId);
			modal.hidden = false;
			modal._videoTrigger = trigger || null;
			document.body.classList.add('is_video_modal_open');

			const closeBtn = modal.querySelector('.videovidhuky_modal_close');
			if (closeBtn) {
				closeBtn.focus();
			}
		};

		/**
		 * Close modal and stop playback.
		 */
		const closeModal = () => {
			modal.hidden = true;
			iframe.src = '';
			document.body.classList.remove('is_video_modal_open');

			if (modal._videoTrigger && typeof modal._videoTrigger.focus === 'function') {
				modal._videoTrigger.focus();
			}
		};

		openButtons.forEach((btn) => {
			btn.addEventListener('click', (event) => {
				event.preventDefault();
				openModal(btn.getAttribute('data-youtube-id') || '', btn);
			});
		});

		closeTargets.forEach((el) => {
			el.addEventListener('click', closeModal);
		});

		document.addEventListener('keydown', (event) => {
			if (event.key === 'Escape' && !modal.hidden) {
				closeModal();
			}
		});
	});
});
