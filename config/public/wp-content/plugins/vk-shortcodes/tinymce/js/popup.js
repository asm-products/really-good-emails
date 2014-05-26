
// start the popup specefic scripts
// safe to use $
jQuery(document).ready(function($) {
    var visuals = {
    	loadVals: function()
    	{
    		var shortcode = $('#_visual_shortcode').text(),
    			uShortcode = shortcode;
    		
    		// fill in the gaps eg {{param}}
    		$('.visual-input').each(function() {
    			var input = $(this),
    				id = input.attr('id'),
    				id = id.replace('visual_', ''),		// gets rid of the visual_ prefix
    				re = new RegExp("{{"+id+"}}","g");
    				
    			uShortcode = uShortcode.replace(re, input.val());
    		});
    		
    		// adds the filled-in shortcode as hidden input
    		$('#_visual_ushortcode').remove();
    		$('#visual-sc-form-table').prepend('<div id="_visual_ushortcode" class="hidden">' + uShortcode + '</div>');
    	},
    	cLoadVals: function()
    	{
    		var shortcode = $('#_visual_cshortcode').text(),
    			pShortcode = '';
    			shortcodes = '';
    		
    		// fill in the gaps eg {{param}}
    		$('.child-clone-row').each(function() {
    			var row = $(this),
    				rShortcode = shortcode;
    			
    			$('.visual-cinput', this).each(function() {
    				var input = $(this),
    					id = input.attr('id'),
    					id = id.replace('visual_', '')		// gets rid of the visual_ prefix
    					re = new RegExp("{{"+id+"}}","g");
    					
    				rShortcode = rShortcode.replace(re, input.val());
    			});
    	
    			shortcodes = shortcodes + rShortcode + "\n";
    		});
    		
    		// adds the filled-in shortcode as hidden input
    		$('#_visual_cshortcodes').remove();
    		$('.child-clone-rows').prepend('<div id="_visual_cshortcodes" class="hidden">' + shortcodes + '</div>');
    		
    		// add to parent shortcode
    		this.loadVals();
    		pShortcode = $('#_visual_ushortcode').text().replace('{{child_shortcode}}', shortcodes);
    		
    		// add updated parent shortcode
    		$('#_visual_ushortcode').remove();
    		$('#visual-sc-form-table').prepend('<div id="_visual_ushortcode" class="hidden">' + pShortcode + '</div>');
    	},
    	children: function()
    	{
    		// assign the cloning plugin
    		$('.child-clone-rows').appendo({
    			subSelect: '> div.child-clone-row:last-child',
    			allowDelete: false,
    			focusFirst: false
    		});
    		
    		// remove button
    		$('.child-clone-row-remove').live('click', function() {
    			var	btn = $(this),
    				row = btn.parent();
    			
    			if( $('.child-clone-row').size() > 1 )
    			{
    				row.remove();
    			}
    			else
    			{
    				alert('You need a minimum of one row');
    			}
    			
    			return false;
    		});
    		
    		// assign jUI sortable
    		$( ".child-clone-rows" ).sortable({
				placeholder: "sortable-placeholder",
				items: '.child-clone-row'
				
			});
    	},
    	resizeTB: function()
    	{
			var	ajaxCont = $('#TB_ajaxContent'),
				tbWindow = $('#TB_window'),
				visualPopup = $('#visual-popup');

            tbWindow.css({
                height: visualPopup.outerHeight() + 50,
                width: visualPopup.outerWidth(),
                marginLeft: -(visualPopup.outerWidth()/2)
            });

			ajaxCont.css({
				paddingTop: 0,
				paddingLeft: 0,
				paddingRight: 0,
				height: (tbWindow.outerHeight()-47),
				overflow: 'auto', // IMPORTANT
				width: visualPopup.outerWidth()
			});
			
			$('#visual-popup').addClass('no_preview');
    	},
    	load: function()
    	{
    		var	visuals = this,
    			popup = $('#visual-popup'),
    			form = $('#visual-sc-form', popup),
    			shortcode = $('#_visual_shortcode', form).text(),
    			popupType = $('#_visual_popup', form).text(),
    			uShortcode = '';
    		
    		// resize TB
    		visuals.resizeTB();
    		$(window).resize(function() { visuals.resizeTB() });
    		
    		// initialise
    		visuals.loadVals();
    		visuals.children();
    		visuals.cLoadVals();
    		
    		// update on children value change
    		$('.visual-cinput', form).live('change', function() {
    			visuals.cLoadVals();
    		});
    		
    		// update on value change
    		$('.visual-input', form).change(function() {
    			visuals.loadVals();
    		});
    		
    		// when insert is clicked
    		$('.visual-insert', form).click(function() {    		 			
    			if(window.tinyMCE)
				{
					window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, $('#_visual_ushortcode', form).html());
					tb_remove();
				}
    		});
    	}
	}
    
    // run
    $('#visual-popup').livequery( function() { visuals.load(); } );
});