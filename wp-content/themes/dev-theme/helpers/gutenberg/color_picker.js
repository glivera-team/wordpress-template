acf.add_filter('color_picker_args', function( args, field ) {
	// do something to args
	args.palettes = ['#FFDB70', '#00FFBC', '#001331', '#00E76B', '#0FFFCB', '#EA4238'];
	
	args.change = function(event, ui) {
		let $label = $(field.find('label')[0]).text();
		if ($label == 'Main color') {
			document.documentElement.style.setProperty('--theme_color_main', ui.color.toString());
		}
		if ($label == 'Secondary color') {
			document.documentElement.style.setProperty('--theme_color_secondary', ui.color.toString());
		}
		// update colors
		if ($label == 'Device color' || 'Decor color') {
			$('.acf-field-true-false[data-name="color_update_hidden"] label input').click();
		}
	}
	
	return args;
});