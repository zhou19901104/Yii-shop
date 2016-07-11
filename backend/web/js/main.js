+(function() {
	$(document).on('click', '[href^="#nav"]', function() {
		createCookie('nav-toggle-closed', $('#nav').hasClass('nav-xs') ? 'no' : 'yes');
	});
})();