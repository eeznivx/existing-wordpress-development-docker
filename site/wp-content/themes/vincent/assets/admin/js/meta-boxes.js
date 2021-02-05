jQuery( function($) {
	"use strict";

	// Show/hide post format meta boxes
	function togglePostFormatMetaBoxes() {
		var $input = $('input[name=post_format]'),
			$metaBoxes = $('[id^="opt-meta-box-post-format-"]').hide();

		$input.on( 'change', function() {
			$metaBoxes.hide();
			$('#opt-meta-box-post-format-' + $( this ).val() ).show();
		} );
		$input.filter(':checked').trigger('change');
	}
} );