$(function () {
	// Build ui-interactions for phorms
	$.datepicker.setDefaults($.extend({showMonthAfterYear: false}, $.datepicker.regional['']));
	$('.phorm_field_date input').each(function() {
		$(this).datepicker($.datepicker.regional['fr']);
	});

	$('form.phorm').each(function () {
		$(this).validate({
			errorElement: 'div',
			errorClass: 'validation-advice'
		});
	});
});
