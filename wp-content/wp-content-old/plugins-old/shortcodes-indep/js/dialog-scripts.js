jQuery(function($){
	"use strict";
	
	var dialogScript = {
		
		loadScript: function(){
			
			var i,
				colorType,
				colorList = ["redlight", "red", "orangelight", "orange", "yellowlight", "yellow", "greenlight", "green", "turquoise", "bluelight", "blue", "purplelight", "purple", "brownlight", "brown", "gray", "darkgray", "black"],
				colorInput = '',
				colorLabel = '';
			
			for (i=0, colorType=colorList.length; i < colorType; i++) {
				colorInput = $('<input />').prop({
				  type: 'radio',
				  name: 'item-bg',
				  id: colorList[i],
				  value: colorList[i]	  
				}),
				colorLabel = $('<label for="' + colorList[i] + '"></label>');
					  
				$(".bg-pallete").append(colorInput, colorLabel);
				  
			}
			
			// Make first color checked
			$('.bg-pallete input:eq(0)').prop('checked', true);
						
			
			
			/* -- Clone. For: toggles, tabs, pricing table field
			-------------------------------------------------------- */
			// Add element
			$('#btn-add').click( function() {
				var num     = $('.item_box').length;
				var newNum  = num + 1;
				var newElem = $('#box' + num).clone().prop('id', 'box' + newNum);
				
				newElem.children('.item_title:eq(0)')
					.prop({
						id: 'item-title' + newNum,
						value: 'Title ' + newNum
					});
					
				newElem.children('.item_text:eq(0)').prop('id', 'item-text' + newNum);
				newElem.children('.item_feature:eq(0)').prop('id', 'item-feature' + newNum);
				
				$('#box' + num).after(newElem);
				$('#btn-remove').prop('disabled', false);
				
				// Disable Add button when limit of 20 items is reached
				if (newNum == 20) {
					$('#btn-add').prop('disabled', true);
				}
			});
			
			// Remove element
			$('#btn-remove').click( function() {
				var num = $('.item_box').length;
				
				$('#box' + num).remove();
				$('#btn-add').prop('disabled', false);
				
				// Disable 'Remove' button when there is only one element
				if (num-1 == 1) {
					$('#btn-remove').prop('disabled', true);
				}
			});
			
			$('#btn-remove').prop('disabled', true);
			
						
			
			/* -- Shortcode Preview
			-------------------------------------------------------- */
			function shortcodePreview() {
				
				
				/* -- Button preview
				------------------------------ */
				var text = $("#button-text").val(),
					bg = $("input[name=item-bg]:checked").val(),
					textColor = $("input[name=text-color]:checked").val(),
					windowOpen = $("input[name=window-open]:checked").val();
				
				$(".btn-preview")
					.html( $('<a />', {
						   href: '#',
						   target: windowOpen,
						   'class': 'sc-button bg-' + bg + ' color-' + textColor,
						   html: text
					  	}
					));
				
				
				/* -- Info box preview
				------------------------------ */
				var title = $("#infobox-title").val(),
					subtitle = $("#infobox-sub").val(),
					bg = $("input[name=item-bg]:checked").val(),
					color = $("input[name=box-color]:checked").val(),
					opacity = $("input[name=box-opacity]:checked").val(),
					info = '';
					
				info += '<div class="sc-infobox bg-' + bg + ' content-' + color + ' opacity-' + opacity + '">';
				info += '<div class="border">';
				info += '<span>' + title + '</span>';
				info += '<div class="sep"></div>';
				info += '<span>' + subtitle + '</span>';
				info += '</div>';
				info += '</div>';
				
				$(".info-preview").html(info);
				  
			}
		
			$("select, input[type=radio]").change(shortcodePreview);
			$("input[type=text], textarea").keyup(shortcodePreview);
			shortcodePreview();
			
		},
		
		
		load: function(){
			
			// Initialise function
			dialogScript.loadScript();
			
		}
		
	};
	
	// Load the js
	$('.shortcode-form').livequery( function() { dialogScript.load(); } );

				
});