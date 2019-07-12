jQuery(document).ready(function ($) {
	"use strict";

	/**
	 * Slider Custom Control
	 */

	// Set our slider defaults and initialise the slider
	$('.slider-custom-control').each(function () {
		var sliderValue = $(this).find('.customize-control-slider-value').val();
		var newSlider = $(this).find('.slider');
		var sliderMinValue = parseFloat(newSlider.attr('slider-min-value'));
		var sliderMaxValue = parseFloat(newSlider.attr('slider-max-value'));
		var sliderStepValue = parseFloat(newSlider.attr('slider-step-value'));

		newSlider.slider({
			value: sliderValue,
			min: sliderMinValue,
			max: sliderMaxValue,
			step: sliderStepValue,
			change: function (e, ui) {
				// Important! When slider stops moving make sure to trigger change event so Customizer knows it has to save the field
				$(this).parent().find('.customize-control-slider-value').trigger('change');
			}
		});
	});

	// Change the value of the input field as the slider is moved
	$('.slider').on('slide', function (event, ui) {
		$(this).parent().find('.customize-control-slider-value').val(ui.value);
	});

	// Reset slider and input field back to the default value
	$('.slider-reset').on('click', function () {
		var resetValue = $(this).attr('slider-reset-value');
		$(this).parent().find('.customize-control-slider-value').val(resetValue);
		$(this).parent().find('.slider').slider('value', resetValue);
	});

	// Update slider if the input field loses focus
	$('.customize-control-slider-value').blur(function () {
		var resetValue = $(this).val();
		var slider = $(this).parent().find('.slider');
		var sliderMinValue = parseInt(slider.attr('slider-min-value'));
		var sliderMaxValue = parseInt(slider.attr('slider-max-value'));

		// Make sure our manual input value doesn't exceed the minimum & maxmium values
		if (resetValue < sliderMinValue) {
			resetValue = sliderMinValue;
			$(this).val(resetValue);
		}
		if (resetValue > sliderMaxValue) {
			resetValue = sliderMaxValue;
			$(this).val(resetValue);
		}
		$(this).parent().find('.slider').slider('value', resetValue);
	});


	/**
	 * Image Check Box Custom Control
	 */

	$('.multi-image-checkbox').on('change', function () {
		getAllCheckboxes($(this).parent().parent());
	});

	// Get the values from the checkboxes and add to our hidden field
	function getAllCheckboxes($element) {
		var inputValues = $element.find('.multi-image-checkbox').map(function () {
			if ($(this).is(':checked')) {
				return $(this).val();
				//   } else {
				//     return '';
			}
		}).toArray();
		// Triggering change event for customizer refresh !important
		$element.find('.customize-control-multi-image-checkbox').val(inputValues).trigger('change');
	}

	/**
	 * Connected Fields Custom Control
	 */

	$('.connected-fields-value').on('change', function () {
		getAllConnectedFields($(this).parent().parent());
	});

	// Get the values from connected textboxes and add to hidden field
	function getAllConnectedFields($element) {
		var inputValues = $element.find('.connected-field').map(function () {
			return $(this).val();
		}).toArray();

		$('.connected-input-control').each( function() {
			var _field = $(this);
			var firstField = _field.find('.field-first');
			var secondField = _field.find('.field-second');
			var thirdField = _field.find('.field-third');
			var fourthField = _field.find('.field-fourth');
			var lock = _field.find('#lock-icon');

			function checkLock() {
				var isLock = lock.prop('checked');			

				$('.connected-field').on('input', function(){
					var isLock = lock.prop('checked');
					if(isLock){
						var _value = $(this).val();
						firstField.val(_value);
						secondField.val(_value);
						thirdField.val(_value);
						fourthField.val(_value);
					}
				});
			}
			
			lock.on('change', function() {
				checkLock();
			});
		});
		
		// Triggering change event for customizer refresh (!important)
		$element.find('.customize-control-connected-input').val(inputValues).trigger('change');

		$element.find('.slider-reset').on('click', function () {
			var resetValue = $(this).attr('slider-reset-value');
			
			$element.find('.connected-field').val(resetValue);
		});
	}


});