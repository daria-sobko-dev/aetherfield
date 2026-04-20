/**
 * Mobile navigation toggle.
 */
(() => {
	const header = document.getElementById('masthead');
	if (!header) return;

	const toggle = header.querySelector('.nav-toggle');
	const menu = header.querySelector('.nav__menu');
	if (!toggle || !menu) return;

	const close = () => {
		header.classList.remove('is-open');
		toggle.classList.remove('is-open');
		toggle.setAttribute('aria-expanded', 'false');
	};

	const open = () => {
		header.classList.add('is-open');
		toggle.classList.add('is-open');
		toggle.setAttribute('aria-expanded', 'true');
	};

	toggle.addEventListener('click', () => {
		toggle.getAttribute('aria-expanded') === 'true' ? close() : open();
	});

	document.addEventListener('click', (event) => {
		if (!header.contains(event.target)) close();
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape') close();
	});

	window.addEventListener('resize', () => {
		if (window.innerWidth >= 1024) close();
	});
})();
