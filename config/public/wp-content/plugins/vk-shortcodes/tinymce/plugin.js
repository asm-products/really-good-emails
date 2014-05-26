(function ()
{
	// create visualShortcodes plugin
	tinymce.create("tinymce.plugins.visualShortcodes",
	{
		init: function ( ed, url )
		{
			ed.addCommand("visualPopup", function ( a, params )
			{
				var popup = params.identifier;
				
				// load thickbox
				tb_show("Insert Visual Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
			});
		},
		createControl: function ( btn, e )
		{
			if ( btn == "visual_button" )
			{	
				var a = this;
				
				var btn = e.createSplitButton('visual_button', {
                    title: "Insert Visual Shortcode",
					image: VisualShortcodes.plugin_folder +"/tinymce/images/icon.png",
					icons: false
                });

                btn.onRenderMenu.add(function (c, b)
				{					
					a.addWithPopup( b, "Alerts", "alert" );
					a.addWithPopup( b, "Buttons", "button" );
					a.addWithPopup( b, "Columns", "columns" );
					a.addWithPopup( b, "Tabs", "tabs" );
					a.addWithPopup( b, "Toggle", "toggle" );
					a.addImmediate( b, "Code", "[code]Place your code here.[/code]" );
				});
                
                return btn;
			}
			
			return null;
		},
		addWithPopup: function ( ed, title, id ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand("visualPopup", false, {
						title: title,
						identifier: id
					})
				}
			})
		},
		addImmediate: function ( ed, title, sc) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand( "mceInsertContent", false, sc )
				}
			})
		},
		getInfo: function () {
			return {
				longname: 'Visual Shortcodes',
				author: 'Visual Kicks',
				authorurl: 'http://themeforest.net/user/visualkicks/',
				infourl: 'http://wiki.moxiecode.com/',
				version: "1.0"
			}
		}
	});
	
	// add visualShortcodes plugin
	tinymce.PluginManager.add("visualShortcodes", tinymce.plugins.visualShortcodes);
})();