jQuery(function($){
		
	$(document).on( "click", ".insert-shortcode", function(e){
		
		e.preventDefault();
		
		var output = '';
				
		
		/* -- Accordion
		-------------------------------------------------------- */
		if ( $("#sc-accordion").html() ) {
			
			var ac,
				title = [],
				text = [],
				section = '',
				itemCount = $('.item_title').size();
		
			for ( ac = 1; ac <= itemCount; ac++ ) {
				
				title[ac] = $("#item-title" + ac).val();
				text[ac] = $("#item-text" + ac).val();
				
				section += '[item title="' + title[ac] +'"]' + text[ac] + '[/item]<br />';
			}
			
			output += '[accordion]<br />' + section + '[/accordion]';
			
		}
		
		
		/* --  Button
		-------------------------------------------------------- */
		else if( $("#sc-button").html() ) {
		
			var text = $('#button-text').val(),
				url = $('#button-url').val(),
				color = $("input[name=item-bg]:checked").val();
				textColor = $("input[name=text-color]:checked").val(),
				windowOpen = $("input[name=window-open]:checked").val();
			
			output = '[button ';
			output += 'color="' + color + '" ';
			output += 'text="' + textColor + '" ';
			output += 'url="' + url + '" ';
			output += 'window="' + windowOpen + '"';
			output += ']' + text + '[/button]';
			
		}
		
		
		
		/* -- Columns
		-------------------------------------------------------- */
		else if( $("#sc-columns").html() ) {
		
			var colums_width = $('input[name=columns-width]:checked').val(),
				column = '[column]<br />Add Text or Shortcode<br />[/column]<br />',
				width = '',
				coltpl = '';
			
			function repeatColumn(col, count){
				 return new Array(count + 1).join(col);
			}
			
			$('input[name=columns-width]').change(function(){ 
					  
				switch ( colums_width ) {
					case 'coltpl1':
						width = 'half';
						coltpl = repeatColumn (column, 2);
						break;
					case 'coltpl2':
						width = 'third';
						coltpl = repeatColumn (column, 3);
						break;
					case 'coltpl3':
						width = 'fourth';
						coltpl = repeatColumn (column, 4);
						break;
					case 'coltpl4':
						width = 'two-thirds-and-third';
						coltpl = repeatColumn (column, 2);
						break;
					case 'coltpl5':
						width = 'third-and-two-thirds';
						coltpl = repeatColumn (column, 2);
						break;
				}
				
				output = '[columns_row width="' + width + '"]<p>' + coltpl +'</p>[/columns_row]';
				
			}).change();
			
		}
		
		
		
		/* --  Info Box
		-------------------------------------------------------- */
		else if( $("#sc-infobox").html() ) {
		
			var maintitle = $('#infobox-title').val(),
				subtitle = $('#infobox-sub').val(),
				bg = $("input[name=item-bg]:checked").val(),
				color = $("input[name=box-color]:checked").val(),
				opacity = $("input[name=box-opacity]:checked").val();
			
			output = '[infobox bg="' + bg + '" color="' + color + '" opacity="' + opacity + '" subtitle="' + subtitle + '"]' + maintitle + '[/infobox]';
			
		}
		
		
		
		/* -- Tabs
		-------------------------------------------------------- */
		else if( $("#sc-tabs").html() ) {
			
			var tc,
				title = [],
				text = [],
				tab = '',
				tabCount = $('.item_title').size(),
				layout = $("input[name=tab-layout]:checked").val();
				
			for (tc = 1; tc <= tabCount; tc++) {
				
				title[tc] = $("#item-title" + tc).val();
				text[tc] = $("#item-text" + tc).val();
				
				tab += '[tab title="' + title[tc] + '"]' + text[tc] + '[/tab]<br />';
			}
			
			output = '[tabgroup layout="' + layout + '"]<br />' + tab + '[/tabgroup]';
			
		}
		
		
		
		/* --  Title
		-------------------------------------------------------- */
		else if( $("#sc-title").html() ) {
		
			var maintitle = $('#maintitle').val(),
				subtitle = $('#subtitle').val();
				
			output = '[title subtitle="' + subtitle + '"]' + maintitle + '[/title]';
			
		}
		
		
		
		/* --  Separator
		-------------------------------------------------------- */
		else if( $("#sc-separator").html() ) {
			var type = $('input[name=sep-type]:checked').val();
			
			output = '[separator type="' + type + '"]';
			
		}
				
		
		
		/* -- Insert Button
		-------------------------------------------------------- */
		// Insert the shortcode
		ed = tinyMCE.activeEditor;
		ed.focus();
		ed.execCommand('mceInsertContent', false, output);
		
		// Close Dialog
		tb_remove();
		
	});

});