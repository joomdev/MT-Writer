jQuery(document).ready(function ($) {
	"use strict";

	/**
	 * Sortable Repeater Custom Control
	 */

	// Update the values for all our input fields and initialise the sortable repeater
	$('.sortable_repeater_control').each(function () {
		// If there is an existing customizer value, populate our rows
		var defaultValuesArray = $(this).find('.customize-control-sortable-repeater').val().split(',');
		var numRepeaterItems = defaultValuesArray.length;

		if (numRepeaterItems > 0) {
			// Add the first item to our existing input field
			$(this).find('.repeater-input').val(defaultValuesArray[0]);
			// Create a new row for each new value
			if (numRepeaterItems > 1) {
				var i;
				for (i = 1; i < numRepeaterItems; ++i) {
					mightythemesAppendRow($(this), defaultValuesArray[i]);
				}
			}
		}
	});

	// Make our Repeater fields sortable
	$(this).find('.sortable').sortable({
		update: function (event, ui) {
			mightythemesGetAllInputs($(this).parent());
		}
	});

	// Remove item starting from it's parent element
	$('.sortable').on('click', '.customize-control-sortable-repeater-delete', function (event) {
		event.preventDefault();
		var numItems = $(this).parent().parent().find('.repeater').length;

		if (numItems > 1) {
			$(this).parent().slideUp('fast', function () {
				var parentContainer = $(this).parent().parent();
				$(this).remove();
				mightythemesGetAllInputs(parentContainer);
			})
		} else {
			$(this).parent().find('.repeater-input').val('');
			mightythemesGetAllInputs($(this).parent().parent().parent());
		}
	});

	// Add new item
	$('.customize-control-sortable-repeater-add').click(function (event) {
		event.preventDefault();
		mightythemesAppendRow($(this).parent());
		mightythemesGetAllInputs($(this).parent());
	});

	// Refresh our hidden field if any fields change
	$('.sortable').change(function () {
		mightythemesGetAllInputs($(this).parent());
	})

	// Add https:// to the start of the URL if it doesn't have it
	$('.sortable').on('blur', '.repeater-input', function () {
		var url = $(this);
		var val = url.val();
		if (val && !val.match(/^.+:\/\/.*/)) {
			// Triggering change event for customizer refresh !important
			url.val('https://' + val).trigger('change');
		}
	});

	// Append a new row to our list of elements
	function mightythemesAppendRow($element, defaultValue = '') {
		var newRow = '<div class="repeater" style="display:none"><input type="text" value="' + defaultValue + '" class="repeater-input" placeholder="https://" /><span class="dashicons dashicons-sort"></span><a class="customize-control-sortable-repeater-delete" href="#"><span class="dashicons dashicons-no-alt"></span></a></div>';

		$element.find('.sortable').append(newRow);
		$element.find('.sortable').find('.repeater:last').slideDown('slow', function () {
			$(this).find('input').focus();
		});
	}

	// Get the values from the repeater input fields and add to our hidden field
	function mightythemesGetAllInputs($element) {
		var inputValues = $element.find('.repeater-input').map(function () {
			return $(this).val();
		}).toArray();
		// Add all the values from our repeater fields to the hidden field (which is the one that actually gets saved)
		$element.find('.customize-control-sortable-repeater').val(inputValues);
		// Triggering change event for customizer refresh !important
		$element.find('.customize-control-sortable-repeater').trigger('change');
	}

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