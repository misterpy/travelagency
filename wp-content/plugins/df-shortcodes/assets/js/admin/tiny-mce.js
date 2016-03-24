// =============================================================================
// JS/ADMIN/TINYMCE.JS
// -----------------------------------------------------------------------------
// TinyMCE specific functions.
// =============================================================================

(function() {

tinymce.PluginManager.add('DahzThemeShortcodes', function( editor, url ) {
	editor.addButton( 'DahzThemeShortcodes', {
		title: 'Insert Shortcode',
		icon: false,
		type: 'menubutton',
		menu: [
			{
				text: 'Content', 
				menu: [
					{ // begin Dropcap
	      			  text:'Dropcap',
	      			  onclick: function() {
	      			  		editor.windowManager.open({
	      			  			title: 'Blockquote Shortcode',
		                      	style: 'overflow-y:auto;overflow-x:hidden;max-height:60%;',
		                      	body: [
		                      		{
	                      			  type: 'textbox',
				                      name: 'bg_color',
				                      label: 'Background Color',
				                      value: ''
	                      			},
	                      			{ 
				                      type: 'label',
				                      name: 'someHelpText',
				                      multiline: true,
				                      style: 'padding: 5px 0;font-size: 11px;font-style: italic;color: #999;left:auto;text-align:right;',
				                      text: "",
			                        },
			                        {
	                      			  type: 'textbox',
				                      name: 'font_color',
				                      label: 'Font Color',
				                      value: ''
	                      			},
	                      			{ 
				                      type: 'label',
				                      name: 'someHelpText',
				                      multiline: true,
				                      style: 'padding: 5px 0;font-size: 11px;font-style: italic;color: #999;left:auto;text-align:right;',
				                      text: "",
			                        },
			                        {
				                      type: 'textbox',
				                      name: 'content',
				                      label: 'Content',
				                      value: 'Hello',
				                      multiline: true,
				                      minWidth: 300,
				                      minHeight: 100
				                    },
				                    { 
				                      type: 'label',
				                      name: 'someHelpText',
				                      multiline: true,
				                      style: 'padding: 5px 0;font-size: 11px;font-style: italic;color: #999;left:auto;text-align:right;',
				                      text: "",
				                      onPostRender : function() {
				                        this.getEl().innerHTML =
				                            "Write the content.";}
			                        }
		                      	],
		                      	onsubmit: function( e ) {
				                    editor.insertContent('[df_dropcap background_color="'+e.data.bg_color+'" color="'+e.data.font_color+'"]'+e.data.content+'[/df_dropcap]');
		                  		}
	      			  		});
	      			  }
					}, // end Dropcap
					{ // begin Highlight
  						text: 'Highlight',
  						onclick: function() {
  							editor.windowManager.open({
  								title: 'Highlight Shortcode',
		                      	style: 'overflow-y:auto;overflow-x:hidden;max-height:60%;',
		                      	body: [
		                      			{
		                      			  type: 'textbox',
		                      			  name: 'font_color',
		                      			  label: 'Font Color',
		                      			  value: '#FFFFFF'
		                      			},
		                      			{ 
					                      type: 'label',
					                      name: 'someHelpText',
					                      multiline: true,
					                      style: 'padding: 5px 0;font-size: 11px;font-style: italic;color: #999;left:auto;text-align:right;',
					                      text: "",
					                      
				                        },
				                        {
		                      			  type: 'textbox',
		                      			  name: 'bg_color',
		                      			  label: 'Background Color',
		                      			  value: '#0F0F0F'
		                      			},
		                      			{ 
					                      type: 'label',
					                      name: 'someHelpText',
					                      multiline: true,
					                      style: 'padding: 5px 0;font-size: 11px;font-style: italic;color: #999;left:auto;text-align:right;',
					                      text: "",
					                     
				                        },
				                        {
					                      type: 'textbox',
					                      name: 'content',
					                      label: 'Text',
					                      value: 'CONTENT',
					                      multiline: true,
					                      minWidth: 300,
					                      minHeight: 100
					                    },
					                    { 
					                      type: 'label',
					                      name: 'someHelpText',
					                      multiline: true,
					                      style: 'padding: 5px 0;font-size: 11px;font-style: italic;color: #999;left:auto;text-align:right;',
					                      text: "",
					                      
				                        }
		                      		  ],
                      			onsubmit: function( e ) {
				                    editor.insertContent( '[df_highlight background="'+e.data.bg_color+'" color="'+e.data.font_color+'"]'+e.data.content+'[/df_highlight]' );
				                }
  							});
  						}
  					}, // end highlight
  					{ // begin List
  						text: 'List Item',
  						onclick: function() {
  							editor.windowManager.open({
  								title: 'List Item Shortcode',
		                      	style: 'overflow-y:auto;overflow-x:hidden;max-height:60%;',
		                      	body: [
		                      			{
		                      			  type: 'textbox',
				                          name: 'listcount',
				                          label: 'How many items ?',
				                          value: '1'
		                      			},			                      			
		                      			{ 
					                      type: 'label',
					                      name: 'someHelpText',
					                      multiline: true,
					                      style: 'padding: 5px 0;font-size: 11px;font-style: italic;color: #999;left:auto;text-align:right;',
					                      text: "",
					                      onPostRender : function() {
					                        this.getEl().innerHTML =
					                            "Set the items.";}
				                        },
				                        {
				                          type: 'textbox',
				                          name: 'icon',
				                          label: 'What icon you want use ?',
				                          value: 'fa-'
				                        },
		                      			{ 
					                      type: 'label',
					                      name: 'someHelpText',
					                      multiline: true,
					                      style: 'padding: 5px 0;font-size: 11px;font-style: italic;color: #999;left:auto;text-align:right;',
					                      text: "",
					                      onPostRender : function() {
					                        this.getEl().innerHTML =
					                            "Check the icon list here <a href='http://fortawesome.github.io/Font-Awesome/cheatsheet/' target='_blank' style='font-size:11px;'>Font Awesome</a>, use icon id only. e.g. 'adjust'.";}
				                        }
		                      		  ],
                      			onsubmit: function( e ) {
				                    editor.insertContent('[df_list]');
				                    for (i = 0; i < e.data.listcount; i++) {
				                        editor.insertContent('[df_list_item icon="'+ e.data.icon +'"]content[/df_list_item]');
				                    }
				                    editor.insertContent('[/df_list]');
				                }
  							});
  						}
  					}, // end list
  					{/*start table*/
		             text: 'Table',
		              onclick: function() {
		                editor.windowManager.open( {
		                  title: 'Insert Table Shortcode',
		                  body: [
		                    {
		                      type: 'textbox',
		                      name: 'table_row',
		                      label: 'How many row ?',
		                      value: '4'
		                    },
		                    {
		                      type: 'textbox',
		                      name: 'table_coloumn',
		                      label: 'How many column ?',
		                      value: '4'
		                    } 
		                  ],
		                  onsubmit: function( e ) {
		                    editor.insertContent('[df_table]');
		                      for (i = 0; i < e.data.table_row; i++) {
		                        editor.insertContent('[df_table_tr]');
		                        for (j = 0; j < e.data.table_coloumn; j++) {
		                            editor.insertContent('[df_table_td]content[/df_table_td]');
		                        }
		                        editor.insertContent('[/df_table_tr]');
		                      }
		                    editor.insertContent('[/df_table]');
		                  }
		                });
		              }
		            }, /*finish table*/
  					{ // begin Tooltip
  						text: 'Tooltip',
  						onclick: function() {
  							editor.windowManager.open({
  								title: 'Tooltips Shortcode',
		                      	style: 'overflow-y:auto;overflow-x:hidden;max-height:60%;',
		                      	body: [
		                      			{
		                      			  type: 'textbox',
				                          name: 'link',
				                          label: 'Link',
				                          value: 'example.com'
		                      			},			                      			
		                      			{ 
					                      type: 'label',
					                      name: 'someHelpText',
					                      multiline: true,
					                      style: 'padding: 5px 0;font-size: 11px;font-style: italic;color: #999;left:auto;text-align:right;',
					                      text: "",
					                      onPostRender : function() {
					                        this.getEl().innerHTML =
					                            "Set the link text.";}
				                        },
				                        {
		                      			  type: 'textbox',
				                          name: 'title',
				                          label: 'Title Hover',
				                          value: 'example'
		                      			},			                      			
		                      			{ 
					                      type: 'label',
					                      name: 'someHelpText',
					                      multiline: true,
					                      style: 'padding: 5px 0;font-size: 11px;font-style: italic;color: #999;left:auto;text-align:right;',
					                      text: "",
					                      onPostRender : function() {
					                        this.getEl().innerHTML =
					                            "Set the link title text.";}
				                        },
				                        {
		                      			  type: 'listbox',
				                          name: 'target',
				                          label: 'Open Page In',
				                          'values': [
				                          			 {text: 'New Tab', value: '_target'},
				                          			 {text: 'Current Page', value: '_self'}
				                          			]
		                      			},			                      			
		                      			{ 
					                      type: 'label',
					                      name: 'someHelpText',
					                      multiline: true,
					                      style: 'padding: 5px 0;font-size: 11px;font-style: italic;color: #999;left:auto;text-align:right;',
					                      text: "",
					                      onPostRender : function() {
					                        this.getEl().innerHTML =
					                            "Set open link.";}
				                        },
				                        {
				                          type: 'textbox',
				                          name: 'font_color',
				                          label: 'Link Color',
				                          value: '#'
				                        },
		                      			{ 
					                      type: 'label',
					                      name: 'someHelpText',
					                      multiline: true,
					                      style: 'padding: 5px 0;font-size: 11px;font-style: italic;color: #999;left:auto;text-align:right;',
					                      text: "",
					                      onPostRender : function() {
					                        this.getEl().innerHTML =
					                            "Set your tooltip text color.";}
				                        },
				                        {
				                          type: 'textbox',
				                          name: 'bg_color',
				                          label: 'Background Color',
				                          value: '#'
				                        },
		                      			{ 
					                      type: 'label',
					                      name: 'someHelpText',
					                      multiline: true,
					                      style: 'padding: 5px 0;font-size: 11px;font-style: italic;color: #999;left:auto;text-align:right;',
					                      text: "",
					                      onPostRender : function() {
					                        this.getEl().innerHTML =
					                            "Set your tooltip background color.";}
				                        }
		                      		  ],
                      			onsubmit: function( e ) {
				                    editor.insertContent( '[df_tooltip link="'+e.data.link+'" tooltip="'+e.data.title+'" target="'+e.data.target+'" color="'+e.data.font_color+'" bg_color="'+e.data.bg_color+'"]LINK TOOLTIP[/df_tooltip]' );
				                }
  							});
  						}
  					} // end Tooltip
				]
			},
			{ // begin box
				text: 'Box', 
				menu: [
					{ // begin blockquote
	      			  text:'Blockquote',
	      			  onclick: function() {
							editor.windowManager.open({
								title: 'Blockquote Shortcode',
		                      	style: 'overflow-y:auto;overflow-x:hidden;max-height:60%;',
		                      	body: [
		                      			{
		                      			  type: 'listbox',
					                      name: 'blockquote_type',
					                      label: 'Blockquote Style',
					                      'values': [
					                      			  { text: 'Type 1', value: '1' },
					                      			  { text: 'Type 2', value: '2' }
					                      		 	]
		                      			},
		                      			{ 
					                      type: 'label',
					                      name: 'someHelpText',
					                      multiline: true,
					                      style: 'padding: 5px 0;font-size: 11px;font-style: italic;color: #999;left:auto;text-align:right;',
					                      text: "",
				                        },
		                      			{
		                      			  type: 'textbox',
					                      name: 'border_size',
					                      label: 'Border Size',
					                      value: '4px'
		                      			},
		                      			{ 
					                      type: 'label',
					                      name: 'someHelpText',
					                      multiline: true,
					                      style: 'padding: 5px 0;font-size: 11px;font-style: italic;color: #999;left:auto;text-align:right;',
					                      text: "",
					                      onPostRender : function() {
					                        this.getEl().innerHTML =
					                            "Active when you choose 'Type 2'";}
				                        },
				                        {
		                      			  type: 'textbox',
					                      name: 'border_color',
					                      label: 'Border Color',
					                      value: '#0F0F0F'
		                      			},
		                      			{ 
					                      type: 'label',
					                      name: 'someHelpText',
					                      multiline: true,
					                      style: 'padding: 5px 0;font-size: 11px;font-style: italic;color: #999;left:auto;text-align:right;',
					                      text: "",
					                      onPostRender : function() {
					                        this.getEl().innerHTML =
					                            "Active when you choose 'Type 2'";}
				                        },
				                        {
					                      type: 'textbox',
					                      name: 'content',
					                      label: 'Content',
					                      value: 'Hello',
					                      multiline: true,
					                      minWidth: 300,
					                      minHeight: 100
					                    },
					                    { 
					                      type: 'label',
					                      name: 'someHelpText',
					                      multiline: true,
					                      style: 'padding: 5px 0;font-size: 11px;font-style: italic;color: #999;left:auto;text-align:right;',
					                      text: "",
					                      onPostRender : function() {
					                        this.getEl().innerHTML =
					                            "Write the content.";}
				                        }
	                  		  ],
	                      	onsubmit: function( e ) {
			                    editor.insertContent('[df_blockquote ver="'+ e.data.blockquote_type +'" border_size="'+e.data.border_size+'" color="'+e.data.border_color+'"]'+e.data.content+'[/df_blockquote]');
	                  		}
	                    });
		              }
	      			}, // end blockquote
					{ // begin columns
	      			  text:'Columns',
	      			  onclick: function() {
	      			  	editor.windowManager.open({
	      			  		title: 'Columns Shortcode',
	                      	style: 'overflow-y:auto;overflow-x:hidden;max-height:60%;',
	                      	body: [
								{
									type: 'listbox',
									name: 'columnListboxName',
									label: 'Add Column',
									'values': [
										{text: 'Two Column', value: 'two_col'},
										{text: 'Three Column', value: 'three_col'},
										{text: 'Four Column', value: 'four_col'},
										{text: 'Five Column', value: 'five_col'}
									]
								} 
							],
							onsubmit: function( e ) {
			                    if (e.data.columnListboxName == 'two_col') {
				                    editor.insertContent( '[twocol_one] your content [/twocol_one][twocol_one_last] your content [/twocol_one_last]');
			                    } else if (e.data.columnListboxName == 'three_col') {
			                      	editor.insertContent( '[threecol_one] your content [/threecol_one][threecol_one] your content [/threecol_one][threecol_one_last] your content [/threecol_one_last]');
			                    } else if (e.data.columnListboxName == 'four_col') {
			                      	editor.insertContent( '[fourcol_one] your content [/fourcol_one][fourcol_one] your content [/fourcol_one][fourcol_one] your content [/fourcol_one][fourcol_one_last] your content [/fourcol_one_last]');
			                    } else if (e.data.columnListboxName == 'five_col') {
			                      	editor.insertContent( '[fivecol_one] your content [/fivecol_one][fivecol_one] your content [/fivecol_one][fivecol_one] your content [/fivecol_one][fivecol_one] your content [/fivecol_one][fivecol_one_last] your content [/fivecol_one_last]');
			                    }
			                }
	      			  	});
	      			  }
		      		}
				]
			} // end box
		]
	}); // editor.addButton
}); // tinymce.PluginManager.add

})(jQuery);