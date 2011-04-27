$(function () {
	$('#todos-list .name').each(function () {
		$(this).click(function() {
			var target = $(this).next();
			$(target).slideToggle('slow');
			return false;
		});
	});
	$('#todos-list .section-name').each(function () {
		$(this).click(function() {
			var target = $(this).parent().next();
			$(target).slideToggle('slow');
			return false;
		});
	});
	$('#todos-list .todo-slider').each(function () {
		$(this).slider({
			range: 'min',
			min: 0,
			max: 100,
			value: $(this).next().text(),
			slide: function(event, ui) {
				$(this).next().text(ui.value);
			},
			stop: function(event, ui) {
				$(this).next().text(ui.value);
				$(this).next().next().text('% Chargement...');
				$(this).parent().fadeTo('fast', 0.2);
				$.ajax({
					url: $(this).next().next().attr('class'),
					context: $(this),
					type: 'POST',
					data: 'progress=' + $(this).next().text(),
					success: function() {
						$(this).parent().fadeTo('fast', 1);
						$(this).next().next().text('%');
						
						var percent = $(this).next().text();
						
						if(percent != 0) {
							var width = $(this).parent().parent().prev().children().first().next().width();

							$(this).parent().parent().prev().children().first().show();
							
							//alert($(this).parent().parent().prev().children().first());
							$(this).parent().parent().prev().children().first().animate({
								width: Math.ceil(width * (percent/100)) + 'px'
							}, 'slow');
						}
						else {
							$(this).parent().parent().prev().children().first().animate({
								width: 'hide'
							}, 'slow');
						}
					}
				});
			}
		});
	});
	
	$('#todos-list .name-percentage').each(function () {
		var percent = $(this).css('width');
		
		if(percent != '0%') {
			var width = $(this).next().width();
			percent = percent.substring(0, percent.length - 1);

			$(this).width(0).show().animate({
				width: Math.ceil(width * (percent/100)) + 'px'
			}, 'slow');
		}
	});
});
