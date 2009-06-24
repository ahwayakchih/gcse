jQuery(document).ready(function() {
	var help = jQuery('#help').toggleClass('settings');

	if (help.length < 1) return;

	jQuery('h2:first')
		.append('&nbsp;<a title="Show information" accesskey="h" class="help button">')
		.bind('click', function() {
			jQuery(help).toggleClass('settings');
			jQuery(this).attr('title', (jQuery(help).hasClass('settings') ? 'Hide information' : 'Show information'));
		});
});
