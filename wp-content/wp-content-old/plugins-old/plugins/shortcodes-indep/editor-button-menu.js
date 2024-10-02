(function (){
	
	tinymce.create("tinymce.plugins.siMenuButton", {
				   
		init: function ( ed, url ){
			
			tinymce.plugins.siMenuButton.theurl = url;
			
			ed.addCommand( "mcebutton", function ( a, params ) {
												 
				var shortcodeType = params.identifier;
				
				// Open shortcodes dialog window
				tb_show("Build Shortcode", url + "/shortcode-popup.php?type=" + shortcodeType + "&height=850");
				
				var ajaxContent = jQuery( "#TB_ajaxContent" );
				ajaxContent.css({
					  paddingTop: 0,
					  paddingLeft: 0,
					  paddingRight: 0,
					  paddingBottom: 0,
					  width: ajaxContent.parent().width()+40,
					  height: ajaxContent.parent().height()-44
				});
				
			});
			
		},
		createControl: function ( btn, e ) {
			
			if ( btn == "sc_menu" ){
				var a = this;
				var ShortcodesIndep;
				var btn = e.createMenuButton( "sc_menu", {
                    title: "ThemesIndep Shortcodes",
					image: tinymce.plugins.siMenuButton.theurl + "/images/icon-shortcodes.png",
					icons: false
                });

                btn.onRenderMenu.add(function ( c, b ){					
					a.addWithPopup( b, "Accordion", "sc-accordion" );
					a.addWithPopup( b, "Button", "sc-button" );
					a.addWithPopup( b, "Columns", "sc-columns" );
					a.addWithPopup( b, "Info Box", "sc-infobox" );
					a.addWithPopup( b, "Tabs", "sc-tabs" );
					a.addWithPopup( b, "Title", "sc-title" );
					a.addWithPopup( b, "Separator", "sc-separator" );
				});
                
                return btn;
			}
			
			return null;
		},
		addWithPopup: function ( ed, title, id ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand( "mcebutton", false, {
						title: title,
						identifier: id
					})
				}
			})
		},
		addImmediate: function ( ed, title, sc ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand( "mceInsertContent", false, sc )
				}
			})
		},
		getInfo : function() {
            return {
                longname : "ThemesIndep Shortcodes Generator",
                author : 'ThemesIndep',
                authorurl : 'http://themesindep.com',
                infourl : 'http://themesindep.com',
                version : "1.0"
            };
        }
	});
	
	// Add ShortcodesIndep Generator plugin
	tinymce.PluginManager.add( "sc_menu", tinymce.plugins.siMenuButton );
})();