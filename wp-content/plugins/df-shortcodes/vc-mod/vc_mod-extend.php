<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');

// ========================================================
// Advance Google Maps
// ========================================================
vc_map( array(
     "name" 		=> __("Advanced Google Maps", "dahztheme"),
     "base" 		=> "df_advanced_gmaps",
     "category" 	=> __('Social', 'dahztheme'),
     "description" 	=> __('Add two location and custom coloring.', 'dahztheme'),
     "icon"     	=> "icon-df_gmaps",
     "params" 		=> array(
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Address 1 : Latitude", "dahztheme"),
				"param_name" 	=> "latitude",
				"value" 		=> "",
				"description" 	=> __('Enter your Google Map coordinates to display a map on the Contact Form page template. You can get these details from <a href="http://itouchmap.com/latlong.html" target="_blank">Google Maps</a>', "dahztheme")
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Address 1 : Longitude", "dahztheme"),
				"param_name" 	=> "longitude",
				"value" 		=> "",
				"description" 	=> __('Enter your Google Map coordinates to display a map on the Contact Form page template. You can get these details from <a href="http://itouchmap.com/latlong.html" target="_blank">Google Maps</a>', "dahztheme")
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Address 1 : Full Address Text (shown in tooltip)", "dahztheme"),
				"param_name" 	=> "address",
				"value" 		=> "",
                "admin_label" 	=> true
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Address 2 : Latitude", "dahztheme"),
				"param_name" 	=> "latitude_2",
				"value" 		=> "",
				"description" 	=> __('Enter your Google Map coordinates to display a map on the Contact Form page template. You can get these details from <a href="http://itouchmap.com/latlong.html" target="_blank">Google Maps</a>', "dahztheme")
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Address 2 : Longitude", "dahztheme"),
				"param_name" 	=> "longitude_2",
				"value" 		=> "",
				"description" 	=> __('Enter your Google Map coordinates to display a map on the Contact Form page template. You can get these details from <a href="http://itouchmap.com/latlong.html" target="_blank">Google Maps</a>', "dahztheme")
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Address 2 : Full Address Text (shown in tooltip)", "dahztheme"),
				"param_name" 	=> "address_2",
				"value" 		=> "",
				"admin_label" 	=> true
			),
			array(
				"type" 			=> "attach_image",
				"heading" 		=> __("Upload Marker Icon", "dahztheme"),
				"param_name" 	=> "img",
				"value" 		=> "",
				"admin_label" 	=> true,
				"description" 	=> __("If left blank Google Default marker will be used.", "dahztheme")
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Map height", "dahztheme"),
				"param_name" 	=> "height",
				"admin_label" 	=> true,
				"description" 	=> __('Enter map height in pixels. Example: 200).', "dahztheme")
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Zoom", "dahztheme"),
				"param_name" 	=> "zoom",
				"admin_label" 	=> true,
				"description" 	=> __('Insert number from 1 to 19', "dahztheme")
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Pan Control", "dahztheme"),
				"param_name" 	=> "pan_control",
				"admin_label" 	=> true,
				"value" 		=> array(
										__("No", "dahztheme") 	=> "false",
										__("Yes", "dahztheme") 	=> "true"
								   )
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Draggable", "dahztheme"),
				"param_name" 	=> "draggable",
				"admin_label" 	=> true,
				"value" 		=> array(
										__("No", "dahztheme") 	=> "false",
										__("Yes", "dahztheme") 	=> "true"
								   )
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Zoom Control", "dahztheme"),
				"param_name" 	=> "zoom_control",
				"admin_label" 	=> true,
				"value" 		=> array(
					                    __("No", "dahztheme") 	=> "false",
					                    __("Yes", "dahztheme") 	=> "true"
					               )
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Map Type Control", "dahztheme"),
				"param_name" 	=> "map_type_control",
				"admin_label" 	=> true,
				"value" 		=> array(
										__("No", "dahztheme") 	=> "false",
										__("Yes", "dahztheme") 	=> "true"
								   )
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Scale Control", "dahztheme"),
				"param_name" 	=> "scale_control",
				"admin_label" 	=> true,
				"value" 		=> array(
										__("No", "dahztheme") 	=> "false",
										__("Yes", "dahztheme") 	=> "true"
								   )
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Modify Google Maps Coloring", "dahztheme"),
				"param_name" 	=> "modify_coloring",
				"value" 		=> array(
										__("No", "dahztheme") 	=> "false",
										__("Yes", "dahztheme") 	=> "true"
								   ),
				"description" 	=> __("", "dahztheme")
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> __("Hue", "dahztheme"),
				"param_name" 	=> "hue",
				"admin_label" 	=> true,
				"description" 	=> __("Sets the hue of the feature to match the hue of the color supplied. Note that the saturation and lightness of the feature is conserved, which means, the feature will not perfectly match the color supplied .", "dahztheme"),
				"dependency" 	=> array( 'element' => "modify_coloring", 'value' => array(	'true' ) )
			),
			array(
               	"type" 			=> "textfield",
               	"heading" 		=> __("Saturation", "dahztheme"),
               	"param_name" 	=> "saturation",
               	"description" 	=> __('Shifts the saturation of colors by a percentage of the original value if decreasing and a percentage of the remaining value if increasing. Valid values: [-100, 100].', "dahztheme"),
               	"dependency" 	=> array( 'element' => "modify_coloring", 'value' => array( 'true' ) )
          	),
          	array(
               	"type" 			=> "textfield",
               	"heading" 		=> __("Lightness", "dahztheme"),
               	"param_name" 	=> "lightness",
               	"description" 	=> __('Shifts lightness of colors by a percentage of the original value if decreasing and a percentage of the remaining value if increasing. Valid values: [-100, 100].', "dahztheme"),
               	"dependency" 	=> array( 'element' => "modify_coloring", 'value' => array( 'true' ) )
          	),
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Extra class name", "dahztheme"),
				"param_name" 	=> "el_class",
				"value" 		=> "",
				"admin_label" 	=> true,
				"description" 	=> __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "dahztheme")
			)
     )
) );

// ========================================================
// Banner
// ========================================================
vc_map( array(
     "name"         => __("Banner", "dahztheme"),
     "base"         => "df_banner",
     "category"     => __('Content', "dahztheme"),
     "icon"         => "icon-df_banner",
     "description"  => __("Adds banner in your content", "dahztheme"),
     "params"       => array(
			array(
                "type"        => "dropdown",
                "heading"     => __("Background Image", "dahztheme"),
                "param_name"  => "back_image",
                "admin_label" => true,
                "description" => __("Choose your background style", "dahztheme"),
                "value"       => array(
	                                 __("No", "dahztheme") 	=> 'false',
	                                 __("Yes", "dahztheme") => 'true'
                                 )
            ),
            array(
                "type"        => "colorpicker",
                "heading"     => __("Background Color", "dahztheme"),
                "admin_label" => true,
                "param_name"  => "background",
                "dependency"  => array('element' => "back_image", 'value' => array('false'))
            ),
            array(
                "type"        => "attach_image",
                "heading"     => __("Image", "dahztheme"),
                "admin_label" => true,
                "param_name"  => "img",
                "dependency"  => array('element' => "back_image", 'value' => array('true'))
            ),
            array(
                "type"        => "textfield",
                "heading"     => __("Height", "dahztheme"),
                "admin_label" => true,
                "param_name"  => "height",
                "value"       => 400
            ),
            array(
                "type"        => "dropdown",
                "heading"     => __("Border", "dahztheme"),
                "admin_label" => true,
                "param_name"  => "border",
                "value"       => array(
									__("No", "dahztheme")  => 'no',
									__("Yes", "dahztheme") => 'yes'
                                 )
            ),
            array(
                "type"        => "colorpicker",
                "heading"     => __("Border Color", "dahztheme"),
                "admin_label" => true,
                "param_name"  => "border_color",
                "dependency"  => array('element' => "border", 'value' => array('yes'))
            ),
            array(
                'type'        => 'vc_link',
                'heading'     => __( 'URL (Link)', 'dahztheme' ),
                "admin_label" => true,
                'param_name'  => 'link'
            ),
            array(
                "type"        => "textarea_html",
                "heading"     => __("Content", "dahztheme"),
                "admin_label" => true,
                "param_name"  => "content"
            ),
            array(
                "type"        => "textfield",
                "heading"     => __("Extra class name", "dahztheme"),
                "admin_label" => true,
                "param_name"  => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "dahztheme")
            )
    )
) );

// ========================================================
// Price table
// ========================================================
vc_map( array(
     "name"         => __("Pricing Tables", "dahztheme"),
     "base"         => "price_table",
     "category"     => __('Content', "dahztheme"),
     "icon"         => "icon-df_price_table",
     "description"  => __("Build your own pricing tables", "dahztheme"),
     "params"       => array(
			array(
                "type"        => "textfield",
                "heading"     => __("Plan Title", "dahztheme"),
                "admin_label" => true,
                "param_name"  => "title",
            ),
            array(
                "type"        => "textfield",
                "heading"     => __("Price", "dahztheme"),
                "admin_label" => true,
                "param_name"  => "price",
            ),
            array(
                "type"        => "textfield",
                "heading"     => __("Currency", "dahztheme"),
                "admin_label" => true,
                "param_name"  => "currency",
            ),
            array(
                "type"        => "textfield",
                "heading"     => __("Price Period", "dahztheme"),
                "admin_label" => true,
                "param_name"  => "price_period",
            ),
            array(
                "type"        => "dropdown",
                "heading"     => __("Button", "dahztheme"),
                "param_name"  => "show_button",
                "value"       => array(
									__("No", "dahztheme")  => 'no',
									__("Yes", "dahztheme") => 'yes'
                                 )
            ),
            array(
                "type"        => "textfield",
                "heading"     => __("Button Text", "dahztheme"),
                "param_name"  => "button_text",
            	"dependency"  => array('element' => "show_button", 'value' => array('yes')),
            ),
            array(
                "type"        => "textfield",
                "heading"     => __("Button Link", "dahztheme"),
                "param_name"  => "button_link",
            	"dependency"  => array('element' => "show_button", 'value' => array('yes')),
            ),
            array(
                "type"        => "dropdown",
                "heading"     => __("Button Target", "dahztheme"),
                "param_name"  => "button_target",
                "value"       => array(
									__("Self", "dahztheme")  => '_self',
									__("Blank", "dahztheme") => '_blank',
                                 ),
            	"dependency"  => array('element' => "show_button", 'value' => array('yes')),
            ),
            array(
                "type"        => "dropdown",
                "heading"     => __("Button Style", "dahztheme"),
                "param_name"  => "button_shape",
                "value"       => array(
									__("Square", "dahztheme")  => 'df_square',
									__("Pill", "dahztheme")  => 'df_pill',
									__("Round", "dahztheme") => 'df_round'
                                 ),
            	"dependency"  => array('element' => "show_button", 'value' => array('yes')),
            ),
            array(
                "type"        => "textfield",
                "heading"     => __("Popular Text", "dahztheme"),
                "admin_label" => true,
                "param_name"  => "popular",
            ),
            array(
                "type"        => "textarea_html",
                "heading"     => __("Content", "dahztheme"),
                "param_name"  => "content",
                 "value"      => '[df_list][df_list_item icon="fa-check "]content[/df_list_item][df_list_item icon="fa-check "]content[/df_list_item][df_list_item icon="fa-check "]content[/df_list_item][df_list_item icon="fa-check "]content[/df_list_item][/df_list]'
            ),
    )
));

// ========================================================
// Share
// ========================================================
vc_map( array(
	"name"         => __("Share", "dahztheme"),
	"base"         => "share_social",
	"category"     => __('Content', "dahztheme"),
	"icon"         => "icon-df_share",
	"description"  => __("Make your share button", "dahztheme"),
	"params"       => array(
		array(
			"type"        => "dropdown",
			"heading"     => __("Twitter", "dahztheme"),
			"param_name"  => "twitter",
			"admin_label" => true,
			"value"       => array(
								__("No", "dahztheme")  => 'false',
								__("Yes", "dahztheme") => 'true'
							 )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __("Facebook", "dahztheme"),
			"param_name"  => "facebook",
			"admin_label" => true,
			"value"       => array(
								__("No", "dahztheme")  => 'false',
								__("Yes", "dahztheme") => 'true'
							 )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __("Google Plus", "dahztheme"),
			"param_name"  => "google",
			"admin_label" => true,
			"value"       => array(
								__("No", "dahztheme")  => 'false',
								__("Yes", "dahztheme") => 'true'
							 )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __("Pinterest", "dahztheme"),
			"param_name"  => "pinterest",
			"admin_label" => true,
			"value"       => array(
								__("No", "dahztheme")  => 'false',
								__("Yes", "dahztheme") => 'true'
							 )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __("Mail To", "dahztheme"),
			"param_name"  => "email",
			"admin_label" => true,
			"value"       => array(
								__("No", "dahztheme")  => 'false',
								__("Yes", "dahztheme") => 'true'
							 )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __("Big Icon", "dahztheme"),
			"param_name"  => "big_icon",
			"value"       => array(
								__("No", "dahztheme")  => 'false',
								__("Yes", "dahztheme") => 'true'
							 )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __("Show Share Text", "dahztheme"),
			"param_name"  => "share",
			"value"       => array(
								__("No", "dahztheme")  => 'false',
								__("Yes", "dahztheme") => 'true'
							 )
		),
		array(
			"type"        => "textfield",
			"heading"     => __("Share Text", "dahztheme"),
			"param_name"  => "share_text",
			"admin_label" => true,
			"dependency"  => array('element' => "share", 'value' => array('true'))
		),
		array(
			"type"        => "colorpicker",
			"heading"     => __("Icon Color", "dahztheme"),
			"param_name"  => "icon_color",
		),
	    array(
            "type" => "dropdown",
            "heading" => __("Alignment", "dahztheme"),
            "param_name" => "align",
            "value" => array(
                "Left" => "left",
                "Center" => "center",
                "Right" => "right",
            ),
        ),

	)
));

// ========================================================
// Social Icon
// ========================================================
vc_map( array(
	"name"         => __("Social Icon", "dahztheme"),
	"base"         => "social_icon",
	"category"     => __('Content', "dahztheme"),
	"icon"         => "icon-df_social",
	"description"  => __("Make your social button", "dahztheme"),
	"params"       => array(
		array(
			"type"        => "textfield",
			"heading"     => __("Twitter Social Link", "dahztheme"),
			"param_name"  => "twitter",
		),
		array(
			"type"        => "textfield",
			"heading"     => __("Facebook Social Link", "dahztheme"),
			"param_name"  => "facebook",
		),
		array(
			"type"        => "textfield",
			"heading"     => __("Google Social Link", "dahztheme"),
			"param_name"  => "google",
		),
		array(
			"type"        => "textfield",
			"heading"     => __("Pinterest Social Link", "dahztheme"),
			"param_name"  => "pinterest",
		),
		array(
			"type"        => "textfield",
			"heading"     => __("Email Social Link", "dahztheme"),
			"param_name"  => "email",
		),
		array(
			"type"        => "textfield",
			"heading"     => __("Youtube Social Link", "dahztheme"),
			"param_name"  => "youtube",
		),
		array(
			"type"        => "textfield",
			"heading"     => __("Vimeo Social Link", "dahztheme"),
			"param_name"  => "vimeo",
		),
		array(
			"type"        => "textfield",
			"heading"     => __("Instagram Social Link", "dahztheme"),
			"param_name"  => "instagram",
		),
		array(
			"type"        => "textfield",
			"heading"     => __("Dribbble Social Link", "dahztheme"),
			"param_name"  => "dribbble",
		),
		array(
			"type"        => "textfield",
			"heading"     => __("Linkedin Social Link", "dahztheme"),
			"param_name"  => "linkedin",
		),
		array(
			"type"        => "textfield",
			"heading"     => __("Tumblr Social Link", "dahztheme"),
			"param_name"  => "tumblr",
		),
		array(
			"type"        => "textfield",
			"heading"     => __("Reddit Social Link", "dahztheme"),
			"param_name"  => "reddit",
		),
		array(
			"type"        => "textfield",
			"heading"     => __("Stumbleupon Social Link", "dahztheme"),
			"param_name"  => "stumbleupon",
		),
		array(
			"type"        => "dropdown",
			"heading"     => __("Big Icon", "dahztheme"),
			"param_name"  => "big_icon",
			"value"       => array(
								__("No", "dahztheme")  => 'false',
								__("Yes", "dahztheme") => 'true'
							 )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __("Show Social Text", "dahztheme"),
			"param_name"  => "share",
			"value"       => array(
								__("No", "dahztheme")  => 'false',
								__("Yes", "dahztheme") => 'true'
							 )
		),
		array(
			"type"        => "textfield",
			"heading"     => __("Social Text", "dahztheme"),
			"param_name"  => "share_text",
			"admin_label" => true,
			"dependency"  => array('element' => "share", 'value' => array('true'))
		),
		array(
			"type"        => "colorpicker",
			"heading"     => __("Icon Color", "dahztheme"),
			"param_name"  => "icon_color",
		),
		array(
            "type" => "dropdown",
            "heading" => __("Alignment", "dahztheme"),
            "param_name" => "align",
            "value" => array(
                "Left" => "left",
                "Center" => "center",
                "Right" => "right",
            ),
        ),
	)
));

// ========================================================
// Service
// ========================================================
vc_map( array(
     "name"     	=> __("Services", "dahztheme"),
     "base"     	=> "df_services",
     "category" 	=> __('Content', "dahztheme"),
     "icon"     	=> "icon-df_services",
     "description"  => __("Build your service content", "dahztheme"),
     "params"   	=> array(
     		array(
                "type"        => "dropdown",
                "heading"     => __("Service Layout", "dahztheme"),
				"admin_label" => true,
                "value"       => array(
                                       __("Top Left", "dahztheme")   => 'icon_left',
                                       __("Top Center", "dahztheme") => 'top',
                                       __("Top Right", "dahztheme")  => 'icon_right',
                                       __("Left", "dahztheme") 		 => 'left',
                                       __("Right", "dahztheme")  	 => 'right'
                                      ),
                "param_name"  => "position"
            ),
            array(
                "type"        => "dropdown",
                "heading"     => __("Icon Type", "dahztheme"),
                "param_name"  => "icon_type",
                "value"       => array(
                                     __( "None", "dahztheme") 		 	=> '',
                                     __( "Font Awesome", "dahztheme") 	=> 'fontawesome',
                                     __( "Open Iconic", "dahztheme" ) 	=> 'openiconic',
									 __( "Typicons", "dahztheme" ) 		=> 'typicons',
									 __( "Entypo", "dahztheme" ) 		=> 'entypo',
									 __( "Linecons", "dahztheme" ) 		=> 'linecons',
									 __( "Linea", "dahztheme" ) 		=> 'linea',
									 __( "Image", "dahztheme" ) 		=> 'image_icon'
                                 )
            ),
            array(
                "type"        => "attach_image",
                "heading"     => __("Upload Icon", "dahztheme"),
                "param_name"  => "img",
                "dependency"  => array('element' => "icon_type", 'value' => array('image_icon'))
            ),
            array(
                "type"        => "textfield",
                "heading"     => __("Image Width", "dahztheme"),
                "param_name"  => "img_width",
                "value"       => 48,
                "dependency"  => array('element' => "icon_type", 'value' => array('image_icon'))
            ),
            array(
				'type' 		  => 'iconpicker',
				'heading' 	  => __( 'Icon', 'dahztheme' ),
				'param_name'  => 'icon_fontawesome',
				'value' 	  => 'fa fa-adjust', // default value to backend editor admin_label
				'settings' 	  => array(
									'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
									'iconsPerPage' 	=> 4000 // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
								 ),
				'dependency'  => array( 'element' => 'icon_type', 'value' => 'fontawesome' ),
				'description' => __( 'Select icon from library.', 'dahztheme' )
			),
			array(
				'type' 		  => 'iconpicker',
				'heading'     => __( 'Icon', 'dahztheme' ),
				'param_name'  => 'icon_openiconic',
				'value' 	  => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
				'settings' 	  => array(
									'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
									'type' 			=> 'openiconic',
									'iconsPerPage' 	=> 4000 // default 100, how many icons per/page to display
								 ),
				'dependency'  => array( 'element' => 'icon_type', 'value' => 'openiconic' ),
				'description' => __( 'Select icon from library.', 'dahztheme' )
			),
			array(
				'type' 		  => 'iconpicker',
				'heading' 	  => __( 'Icon', 'dahztheme' ),
				'param_name'  => 'icon_typicons',
				'value' 	  => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
				'settings' 	  => array(
									'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
									'type' 			=> 'typicons',
									'iconsPerPage' 	=> 4000 // default 100, how many icons per/page to display
								 ),
				'dependency'  => array( 'element' => 'icon_type', 'value' => 'typicons' ),
				'description' => __( 'Select icon from library.', 'dahztheme' )
			),
			array(
				'type' 		  => 'iconpicker',
				'heading' 	  => __( 'Icon', 'dahztheme' ),
				'param_name'  => 'icon_entypo',
				'value' 	  => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
				'settings' 	  => array(
									'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
									'type' 			=> 'entypo',
									'iconsPerPage'  => 4000 // default 100, how many icons per/page to display
								 ),
				'dependency'  => array( 'element' => 'icon_type', 'value' => 'entypo' )
			),
			array(
				'type' 		  => 'iconpicker',
				'heading' 	  => __( 'Icon', 'dahztheme' ),
				'param_name'  => 'icon_linecons',
				'value' 	  => 'vc_li vc_li-heart', // default value to backend editor admin_label
				'settings' 	  => array(
									'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
									'type' 			=> 'linecons',
									'iconsPerPage'	=> 4000 // default 100, how many icons per/page to display
								 ),
				'dependency'  => array( 'element' => 'icon_type', 'value' => 'linecons' ),
				'description' => __( 'Select icon from library.', 'dahztheme' )
			),
			array(
				'type' 		  => 'iconpicker',
				'heading' 	  => __( 'Linea Icons', 'dahztheme' ),
				'param_name'  => 'icon_linea',
				'value' 	  => 'arrows-anticlockwise', // default value to backend editor admin_label
				'settings' 	  => array(
									'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
									'type' 			=> 'linea',
									'iconsPerPage'	=> 4000 // default 100, how many icons per/page to display
								 ),
				'dependency'  => array( 'element' => 'icon_type', 'value' => 'linea' ),
				'description' => __( 'Select icon from library.', 'dahztheme' )
			),
			array(
                "type"        => "dropdown",
                "heading"     => __("Icon Size", "dahztheme"),
                "param_name"  => "icon_size",
				"admin_label" => true,
                "value"       => array(
                                     __("33%", "dahztheme") => 'fa-lg',
                                     __("2x", "dahztheme") 	=> 'fa-2x',
                                     __("3x", "dahztheme") 	=> 'fa-3x',
                                     __("4x", "dahztheme") 	=> 'fa-4x',
                                     __("5x", "dahztheme") 	=> 'fa-5x'
                                 ),
                "dependency"  => array('element' => "icon_type", 'value' => array('fontawesome', 'openiconic', 'openiconic', 'typicons', 'entypo', 'linecons', 'linea'))
            ),
            array(
                "type"        => "dropdown",
                "heading"     => __("Style Your Icon", "dahztheme"),
                "param_name"  => "icon_style",
				"admin_label" => true,
                "value"       => array(
                                     __("Simple", "dahztheme") 				=> 'simple',
                                     __("Square", "dahztheme") 				=> 'square',
                                     __("Rounded", "dahztheme") 			=> 'rounded',
                                     __("Style Your Own Icon", "dahztheme") => 'own'
                                 ),
                "dependency"  => array('element' => "icon_type", 'value' => array('fontawesome', 'openiconic', 'openiconic', 'typicons', 'entypo', 'linecons', 'linea'))
            ),
            array(
                "type"        => "colorpicker",
                "heading"     => __("Icon Color", "dahztheme"),
				"admin_label" => true,
                "param_name"  => "icon_color",
                "dependency"  => array('element' => "icon_type", 'value' => array('fontawesome', 'openiconic', 'openiconic', 'typicons', 'entypo', 'linecons', 'linea'))
            ),
            array(
                "type"        => "colorpicker",
                "heading"     => __("Icon Background Color", "dahztheme"),
				"admin_label" => true,
                "param_name"  => "icon_bg_color",
                "dependency"  => array('element' => "icon_style", 'value' => array('square', 'rounded', 'own'))
            ),
            array(
                "type"        => "dropdown",
                "heading"     => __("Border Style", "dahztheme"),
                "param_name"  => "border_style",
				"admin_label" => true,
                "value"       => array(
                                     __("None", "dahztheme") 	=> '',
                                     __("Solid", "dahztheme") 	=> 'solid',
                                     __("Dashed", "dahztheme") 	=> 'dashed',
                                     __("Dotted", "dahztheme") 	=> 'dotted',
                                     __("Double", "dahztheme") 	=> 'double',
                                     __("Inset", "dahztheme") 	=> 'inset',
                                     __("Outset", "dahztheme") 	=> 'outset'
                                 ),
                "dependency"  => array('element' => "icon_style", 'value' => array('own'))
            ),
            array(
                "type"        => "textfield",
                "heading"     => __("Border Width", "dahztheme"),
				"admin_label" => true,
                "param_name"  => "border_width",
                "dependency"  => array('element' => "border_style", 'value' => array('solid', 'dashed', 'dotted', 'double', 'inset', 'outset'))
            ),
            array(
                "type"        => "textfield",
                "heading"     => __("Border Radius", "dahztheme"),
				"admin_label" => true,
                "param_name"  => "border_radius",
                "dependency"  => array('element' => "border_style", 'value' => array('solid', 'dashed', 'dotted', 'double', 'inset', 'outset'))
            ),
            array(
                "type"        => "colorpicker",
                "heading"     => __("Border Color", "dahztheme"),
				"admin_label" => true,
                "param_name"  => "border_color",
                "dependency"  => array('element' => "border_style", 'value' => array('solid', 'dashed', 'dotted', 'double', 'inset', 'outset'))
            ),
            array(
                "type"        => "dropdown",
                "class"       => "",
                "heading"     => __("Select Hover Effect type", "dahztheme"),
				"admin_label" => true,
                "param_name"  => "hover_effect",
                "value"       => array(
                                     __("No Effect", "dahztheme") 		=> 'style_1',
                                     __("Icon Zoom", "dahztheme") 		=> 'style_2',
                                     __("Icon Bounce Up", "dahztheme") 	=> 'style_3',
                                 ),
                "dependency"  => array('element' => "icon_type", 'value' => array('fontawesome', 'openiconic', 'openiconic', 'typicons', 'entypo', 'linecons', 'linea')),
                "description" => __("Select the type of effct you want on hover", "dahztheme")
            ),
            array(
                "type"        => "dropdown",
                "heading"     => __("Animation","dahztheme"),
				"admin_label" => true,
                "param_name"  => "icon_animation",
                "value"       => array(
                                    __("No Animation","dahztheme") 	=> "",
                                    __("Fade In","dahztheme") 		=> "fadeIn",
                                    __("Fade In Up","dahztheme") 	=> "fadeInUp",
                                    __("Fade In Down","dahztheme") 	=> "fadeInDown",
                                    __("Fade In Left","dahztheme") 	=> "fadeInLeft",
                                    __("Fade In Right","dahztheme") => "fadeInRight",
                                ),
                "description" => __("Like CSS3 Animations? We have several options for you!","smile")
            ),
            array(
                'type'        => 'vc_link',
                'heading'     => __( 'URL (Link)', 'dahztheme' ),
                "admin_label" => true,
                'param_name'  => 'link'
            ),
            array(
                "type"        => "textfield",
                "heading"     => __("Title", "dahztheme"),
				"admin_label" => true,
                "param_name"  => "title"
            ),
            array(
                "type"        => "colorpicker",
                "heading"     => __("Title Color", "dahztheme"),
                "param_name"  => "title_color",
            ),
            array(
                "type"        => "textarea_html",
                "heading"     => __("Content", "dahztheme"),
				"admin_label" => true,
                "param_name"  => "content"
            ),
            array(
                "type"        => "textfield",
                "heading"     => __("Extra Class", "dahztheme"),
				"admin_label" => true,
                "param_name"  => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "dahztheme")
            )
     )
));

// ========================================================
// Member
// ========================================================
vc_map( array(
     "name" => __("Member", "dahztheme"),
     "base" => "member",
     "category" => __('Content', "dahztheme"),
     "icon" => "icon-df_member",
     "description"  => __("Adds member profile in your content", "dahztheme"),
     "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Style", "dahztheme"),
            "param_name" => "styles",
            "value" => array(
            __('Style 1', "dahztheme") => "style1",
            __('Style 2', "dahztheme") => "style2",
            __('Style 3', "dahztheme") => "style3",
            ),
        ),
        array(
            "type" => "attach_image",
            "heading" => __("Box Image", "dahztheme"),
            "admin_label" => true,
            "param_name" => "img",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Name", "dahztheme"),
            "param_name" => "name",
            "description" => __("Insert member name", "dahztheme"),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Role", "dahztheme"),
            "param_name" => "role",
            "description" => __("Insert role", "dahztheme"),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Link", "dahztheme"),
            "param_name" => "link",
        ),
        array(
            "type" => "textarea_html",
            "heading" => __("Description", "dahztheme"),
            "param_name" => "content",

        ),
        array(
            "type" => "textfield",
            "heading" => __("Facebook", "dahztheme"),
            "param_name" => "facebook",
            "description" => __("Insert link", "dahztheme"),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Twitter", "dahztheme"),
            "param_name" => "twitter",
            "description" => __("Insert link", "dahztheme"),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Google Plus", "dahztheme"),
            "param_name" => "google",
            "description" => __("Insert link", "dahztheme"),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Linkedin", "dahztheme"),
            "param_name" => "linkedin",
            "description" => __("Insert link", "dahztheme"),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Mail", "dahztheme"),
            "param_name" => "mail",
            "description" => __("Insert link", "dahztheme"),
        ),
      )
));

// ========================================================
// Counter
// ========================================================
if (!class_exists('Ultimate_VC_Addons')) {
	vc_map( array(
	     "name"     => __("Counter", "dahztheme"),
	     "base"     => "df_stat_counter",
	     "category" => __('Content', "dahztheme"),
	     "description"  => __("Adds your own counter", "dahztheme"),
	     "icon"     => "icon-df_counter",
	     "params"   => array(
	            array(
	                "type"        => "textfield",
	                "heading"     => __("Counter Title", "dahztheme"),
	                "param_name"  => "counter_title"
	            ),
	            array(
	                "type"        => "textfield",
	                "heading"     => __("Counter Text Front", "dahztheme"),
	                "param_name"  => "counter_text_front"
	            ),
	            array(
	                "type"        => "textfield",
	                "heading"     => __("Counter Text Back", "dahztheme"),
	                "param_name"  => "counter_text_back"
	            ),
	            array(
	                "type"        => "textfield",
	                "heading"     => __("Counter value", "dahztheme"),
	                "param_name"  => "counter_value",
	                "value"       => 1000
	            ),
	            array(
	                "type"        => "textfield",
	                "heading"     => __("Counter Separator", "dahztheme"),
	                "param_name"  => "counter_sep"
	            ),
	            array(
	                "type"        => "textfield",
	                "heading"     => __("Counter Decimal", "dahztheme"),
	                "param_name"  => "counter_decimal"
	            ),
	            array(
	                "type"        => "colorpicker",
	                "heading"     => __("Counter Text Color", "dahztheme"),
	                "param_name"  => "counter_color_txt"
	            ),
	            array(
	                "type"        => "textfield",
	                "heading"     => __("Counter Font Size", "dahztheme"),
	                "param_name"  => "font_size_counter",
	                "value"       => 18
	            ),
	            array(
	                "type"        => "dropdown",
	                "heading"     => __("Select Counter Font Weight", "dahztheme"),
	                "param_name"  => "font_weight_counter",
	                "value"       => array(
	                                    __("Normal","dahztheme") => "normal",
	                                    __("Bold","dahztheme") => "bold",
	                                    __("Bolder","dahztheme") => "bolder",
	                                    __("Lighter","dahztheme") => "lighter",
	                                 )
	            ),
	            array(
	                "type"        => "colorpicker",
	                "heading"     => __("Counter Title Color", "dahztheme"),
	                "param_name"  => "counter_title_color_txt"
	            ),
	            array(
	                "type"        => "textfield",
	                "heading"     => __("Counter Title Font Size", "dahztheme"),
	                "param_name"  => "font_size_title",
	                "value"       => 28
	            ),
	            array(
	                "type"        => "textfield",
	                "heading"     => __("Counter Speed", "dahztheme"),
	                "param_name"  => "speed",
	                "value"       => 0.1
	            ),
	            array(
	                "type"        => "textfield",
	                "heading"     => __("Extra Class", "dahztheme"),
	                "param_name"  => "el_class",
	                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "dahztheme")

	            ),
	    )
	));
}

// ========================================================
// Countdown
// ========================================================
vc_map( array(
     "name"     => __("Countdown", "dahztheme"),
     "base"     => "df_countdown",
     "category" => __('Content', "dahztheme"),
     "description"  => __("Adds your own countdown time", "dahztheme"),
     "icon"     => "icon-df_countdown",
     "params"   => array(
            array(
                "type"        => "textfield",
                "heading"     => __("Target Time For Countdown", "dahztheme"),
                "param_name"  => "datetime",
                "value"       => "yyyy/mm/dd hh:mm:ss",
                "description" => __("Date and time format (yyyy/mm/dd hh:mm:ss).", "dahztheme")
            ),
            array(
                "type"        => "dropdown",
                "heading"     => __("Countdown Timer Depends on", "dahztheme"),
                "param_name"  => "timezone",
                "value"       => array(
                                    __("None","dahztheme") => "none",
                                    __("WordPress Defined Timezone","dahztheme") => "df-wptz",
                                    __("User's System Timezone","dahztheme") => "df-usrtz"
                                 )
            ),
            array(
                "type"        => "checkbox",
                "heading"     => __("Select Time Units To Display In Countdown Timer", "dahztheme"),
                "param_name"  => "countdown_opts",
                "value"       => array(
                                    __("Years","dahztheme") => "syear",
                                    __("Months","dahztheme") => "smonth",
                                    __("Weeks","dahztheme") => "sweek",
                                    __("Days","dahztheme") => "sday",
                                    __("Hours","dahztheme") => "shr",
                                    __("Minutes","dahztheme") => "smin",
                                    __("Seconds","dahztheme") => "ssec"
                                 )
            ),
            array(
                "type"        => "colorpicker",
                "heading"     => __("Timer Digit Text Color", "dahztheme"),
                "param_name"  => "tick_col"
            ),
            array(
                "type"        => "textfield",
                "heading"     => __("Timer Digit Text Size", "dahztheme"),
                "param_name"  => "tick_size"
            ),
            array(
                "type"        => "dropdown",
                "heading"     => __("Timer Digit Text Style", "dahztheme"),
                "value"       => array(
                                    __("Normal","dahztheme") => "",
                                    __("Bold","dahztheme") => "bold",
                                    __("Italic","dahztheme") => "italic",
                                    __("Bold & Italic","dahztheme") => "boldnitalic"
                                 ),
                "param_name"  => "tick_style"
            ),
            array(
                "type"        => "colorpicker",
                "heading"     => __("Timer Unit Text Color", "dahztheme"),
                "param_name"  => "tick_sep_col"
            ),
            array(
                "type"        => "textfield",
                "heading"     => __("Timer Unit Text Size", "dahztheme"),
                "param_name"  => "tick_sep_size",
                "value"       => 13
            ),
            array(
                "type"        => "dropdown",
                "heading"     => __("Timer Unit Text Style", "dahztheme"),
                "param_name"  => "tick_sep_style",
                "value"       => array(
                                    __("Normal","dahztheme") => "",
                                    __("Bold","dahztheme") => "bold",
                                    __("Italic","dahztheme") => "italic",
                                    __("Bold & Italic","dahztheme") => "boldnitalic"
                                ),
            ),
            array(
                "type"        => "colorpicker",
                "heading"     => __("Timer Digit Background Color", "dahztheme"),
                "param_name"  => "timer_bg_color"
            ),
            array(
                "type"        => "textfield",
                "heading"     => __("Extra Class", "dahztheme"),
                "param_name"  => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "dahztheme")

            ),

    )
));

// ========================================================
// Modal
// ========================================================
vc_map( array(
    "name"        => __( "Modal Box", "dahztheme" ),
    "base"        => "df_modal",
    "icon"        => "icon-df_modal_box",
    "class"       => "modal_box",
    "category"    => __( "Content", "dahztheme" ),
    "description" => "Adds bootstrap modal box in your content",
    "controls"    => "full",
    "show_settings_on_create" => true,
    "params"      => array(
        array(
            "type"        => "dropdown",
            "heading"     => __( "Icon to display:", "dahztheme" ),
            "param_name"  => "icon_type",
            "value"       => array(
                                __( "No Icon",           "dahztheme" ) => "none",
                                __( "Font Icon Manager", "dahztheme" ) => "fa_icon",
                                __( "Custom Image Icon", "dahztheme" ) => "custom"
                             )
        ),
        array(
            "type"        => "textfield",
            "heading"     => __( "Insert Icon", "dahztheme" ),
            "param_name"  => "icon",
            "description" => __( "Insert Icon Class", "dahztheme" ),
            "dependency"  => array( "element" => "icon_type", "value" => array( "fa_icon" ) )
        ),
        array(
            "type"        => "attach_image",
            "heading"     => __( "Upload Image Icon:", "dahztheme" ),
            "param_name"  => "icon_img",
            "description" => __( "Upload the custom image icon.", "dahztheme" ),
            "dependency"  => array( "element" => "icon_type", "value" => array( "custom" ) )
        ),
        // Modal Title
        array(
            "type"        => "textfield",
            "heading"     => __( "Modal Box Title", "dahztheme" ),
            "param_name"  => "modal_title",
            "admin_label" => true,
            "description" => __( "Provide the title for modal box.", "dahztheme" )
        ),
        // Add some description
        array(
            "type"        => "textarea_html",
            "heading"     => __( "Modal Content", "dahztheme" ),
            "param_name"  => "content",
            "description" => __( "Content that will be displayed in Modal Popup.", "dahztheme" )
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __( "What's in Modal Popup?", "dahztheme" ),
            "param_name"  => "modal_contain",
            "value"       => array(
                                __( "Miscellaneous Things", "dahztheme" ) => "df-html",
                                __( "Youtube Video",        "dahztheme" ) => "df-youtube",
                                __( "Vimeo Video",          "dahztheme" ) => "df-vimeo",
                             )
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __( "Display Modal On -", "dahztheme" ),
            "param_name"  => "modal_on",
            "value"       => array(
                                __( "Button",       "dahztheme" ) => "df_button",
                                __( "Image",        "dahztheme" ) => "image",
                                __( "Text",         "dahztheme" ) => "text",
                                __( "On Page Load", "dahztheme" ) => "onload",
                             ),
            "description" => __( "When should the popup be initiated?", "dahztheme" )
        ),
        array(
            "type"        => "textfield",
            "heading"     => __( "Delay in Popup Display", "dahztheme" ),
            "param_name"  => "onload_delay",
            "description" => __( "Time delay before modal popup on page load (in seconds)", "dahztheme" ),
            "dependency"  => array( "element" => "modal_on", "value" => array( "onload" ) )
        ),
        array(
            "type"        => "attach_image",
            "heading"     => __( "Upload Image", "dahztheme" ),
            "param_name"  => "btn_img",
            "admin_label" => true,
            "description" => __( "Upload the custom image / image banner.", "dahztheme" ),
            "dependency"  => array( "element" => "modal_on", "value" => array( "image" ) )
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __( "Button Size", "dahztheme" ),
            "param_name"  => "btn_size",
            "value"       => array(
                                __( "Small",  "dahztheme" ) => "sm",
                                __( "Medium", "dahztheme" ) => "md",
                                __( "Large",  "dahztheme" ) => "lg",
                                __( "Block",  "dahztheme" ) => "block",
                             ),
            "description" => __( "How big the button would you like?", "dahztheme" ),
            "dependency"  => array( "element" => "modal_on", "value" => array( "df_button" ) )
        ),
        array(
            "type"        => "colorpicker",
            "heading"     => __( "Button Background Color", "dahztheme" ),
            "param_name"  => "btn_bg_color",
            "value"       => "#333333",
            "description" => __( "Give it a nice paint!", "dahztheme" ),
            "dependency"  => array( "element" => "modal_on", "value" => array( "df_button" ) )
        ),
        array(
            "type"        => "colorpicker",
            "heading"     => __( "Button Text Color", "dahztheme" ),
            "param_name"  => "btn_txt_color",
            "value"       => "#FFFFFF",
            "description" => __( "Give it a nice paint!", "dahztheme" ),
            "dependency"  => array( "element" => "modal_on", "value" => array( "df_button" ) )
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __( "Alignment", "dahztheme" ),
            "param_name"  => "modal_on_align",
            "value"       => array(
                                __( "Center", "dahztheme" ) => "center",
                                __( "Left",   "dahztheme" ) => "left",
                                __( "Right",  "dahztheme" ) => "right",
                             ),
            "dependency"  => array( "element" => "modal_on", "value" => array( "df_button", "image", "text" ) ),
            "description" => __( "Selector the alignment of button/text/image", "dahztheme" )
        ),
        array(
            "type"        => "textfield",
            "heading"     => __( "Text on Button", "dahztheme" ),
            "param_name"  => "btn_text",
            "admin_label" => true,
            "description" => __( "Provide the title for this button.", "dahztheme" ),
            "dependency"  => array( "element" => "modal_on", "value" => array( "df_button" ) )
        ),
        // Custom text for modal trigger
        array(
            "type"        => "textfield",
            "heading"     => __( "Enter Text", "dahztheme" ),
            "param_name"  => "read_text",
            "description" => __( "Enter the text on which the modal box will be triggered.", "dahztheme" ),
            "dependency"  => array( "element" => "modal_on", "value" => array( "text" ) )
        ),
        array(
            "type"        => "colorpicker",
            "heading"     => __( "Text Color", "dahztheme" ),
            "param_name"  => "txt_color",
            "value"       => "#f60f60",
            "description" => __( "Give it a nice paint!", "dahztheme" ),
            "dependency"  => array( "element" => "modal_on", "value" => array( "text" ) )
        ),
        // Modal box size
        array(
            "type"        => "dropdown",
            "heading"     => __( "Modal Size", "dahztheme" ),
            "param_name"  => "modal_size",
            "value"       => array(
                                __( "Small",  "dahztheme" ) => "small",
                                __( "Medium", "dahztheme" ) => "medium",
                                __( "Large",  "dahztheme" ) => "container",
                                __( "Block",  "dahztheme" ) => "block"
                             ),
            "description" => __( "How big the modal box would you like?", "dahztheme" )
        ),
        // Modal Style
        array(
            "type"        => "dropdown",
            "heading"     => "Modal Box Style",
            "param_name"  => "modal_style",
            "value"       => array(
                                __( "Fade",        "dahztheme" ) => "overlay-fade",
                                __( "Slide Down",  "dahztheme" ) => "overlay-slidedown",
                                __( "Slide Up",    "dahztheme" ) => "overlay-slideup",
                                __( "Slide Left",  "dahztheme" ) => "overlay-slideleft",
                                __( "Slide Right", "dahztheme" ) => "overlay-slideright"
                             ),
        ),
        array(
            "type"        => "colorpicker",
            "heading"     => __( "Content Background Color", "dahztheme" ),
            "param_name"  => "content_bg_color",
            "description" => __( "Give it a nice paint!", "dahztheme" ),
        ),
        array(
            "type"        => "colorpicker",
            "heading"     => __( "Content Text Color", "dahztheme" ),
            "param_name"  => "content_text_color",
            "description" => __( "Give it a nice paint!", "dahztheme" ),
        ),
        array(
            "type"        => "colorpicker",
            "heading"     => __( "Header Background Color", "dahztheme" ),
            "param_name"  => "header_bg_color",
            "description" => __( "Give it a nice paint!", "dahztheme" ),
        ),
        array(
            "type"        => "colorpicker",
            "heading"     => __( "Header Text Color", "dahztheme" ),
            "param_name"  => "header_text_color",
            "value"       => "#333333",
            "description" => __( "Give it a nice paint!", "dahztheme" ),
        ),
        array(
            "type"        => "textfield",
            "heading"     => __( "Extra Class", "dahztheme" ),
            "param_name"  => "el_class",
            "description" => __( "Add extra class name that will be applied to the modal popup, and you can use this class for your customizations.", "dahztheme" ),
        )
    )
) );

// ========================================================
// Testimonial
// ========================================================
if ( class_exists( 'df_Testimonial' ) ) :
vc_map(array(
    "name" => __("Testimonial", "dahztheme"),
    "base" => "df_testimonial",
    "category" => __('Content', "dahztheme"),
    "icon" => "icon-df_testimonial",
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Max Post", "dahztheme"),
            "param_name" => "limit",
            "admin_label" => true
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Order", "dahztheme"),
            "param_name" => "orderby",
            "value" => array(
                            __('None', "dahztheme") => "none",
                            __('Date', "dahztheme") => "date",
                            __('Name', "dahztheme") => "name",
                            __('Title', "dahztheme") => "title",
                            __('Random', "dahztheme") => "rand",
                            __('Comment Count', "dahztheme") => "comment_count"
                        ),
            "description" => __("Select order", "dahztheme")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Order by", "dahztheme"),
            "param_name" => "order",
            "value" => array(
            __('None', "dahztheme") => "",
            __('Descending', "dahztheme") => "DESC",
            __('Ascending', "dahztheme") => "ASC",

            ),
            "description" => __("Select order by", "dahztheme")
        ),
        array(
	        "type" => "textfield",
	        "heading" => __("Text Size", "dahztheme"),
	        "param_name" => "testi_text_size",
            "description" => __("Insert a number e.g 16", "dahztheme"),
			"value" => "16",

	    ),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Text Color", "dahztheme"),
			"param_name" => "testi_text_color",
			"value" => "#6b6b6b",
		),
        array(
            "type" => "checkbox",
            "heading" => __("Display Author", "dahztheme"),
            "param_name" => "display_author",
            "admin_label" => true,
            "value" => array(__("Yes", "dahztheme") => 'true'),
        ),
        array(
	        "type" => "textfield",
	        "heading" => __("Author Text Size", "dahztheme"),
	        "param_name" => "testi_au_size",
            "description" => __("Insert a number e.g 16", "dahztheme"),
			"value" => "16",
            "dependency" => array("element" => "display_author","value" => array("true")),

	    ),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Author Text Color", "dahztheme"),
			"param_name" => "testi_au_color",
			"value" => "#6b6b6b",
            "dependency" => array("element" => "display_author","value" => array("true")),

		),
        array(
            "type" => "checkbox",
            "heading" => __("Display Avatar", "dahztheme"),
            "param_name" => "display_avatar",
            "admin_label" => true,
            "value" => array(__("Yes", "dahztheme") => 'true')
        ),

        array(
            "type" => "checkbox",
            "heading" => __("Display url", "dahztheme"),
            "param_name" => "display_url",
            "admin_label" => true,
            "value" => array(__("Yes", "dahztheme") => 'true')
        ),
        // array(
        //     "type" => "textfield",
        //     "heading" => __("Image Size", "dahztheme"),
        //     "param_name" => "size",
        // ),
        array(
            "type" => "textfield",
            "heading" => __("Category Include", "dahztheme"),
            "param_name" => "category",
            "description" => __("Fill name category or id category you want to show", "dahztheme")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Position", "dahztheme"),
            "param_name" => "position",
            "description" => __("Testimonial position", "dahztheme"),
            "value" => array(
                            __('Default', "dahztheme") => "",
                            __('Left', "dahztheme") => "left",
                            __('Right', "dahztheme") => "right",
                            __('Center', "dahztheme") => "center"
                        )
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Slider Testimonial", "dahztheme"),
            "param_name" => "testimonial_slider",
            "admin_label" => true,
            "value" => array(
                            __('No', "dahztheme") => "false",
                            __('Yes', "dahztheme") => "true",
                        )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Unique Id Testimonial Slider", "dahztheme"),
            "param_name" => "id_testimonial_slider",
            "dependency" => Array('element' => "testimonial_slider", 'value' => array('true'))
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class", "dahztheme"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "dahztheme")
        )
    )
));
endif;

// ========================================================
// Blog slider
// ========================================================
vc_map(array(
    "name" => __("Blog Slider", "dahztheme"),
    "base" => "blog",
    "category" => __('Content', "dahztheme"),
    "icon" => "icon-df_blog",
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Max Post", "dahztheme"),
            "param_name" => "posts",
            "admin_label" => true
        ),
        array(
            "type" => "textfield",
            "heading" => __("Number of thumbnails", "dahztheme"),
            "param_name" => "slider_post_number",
            "admin_label" => true
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Order", "dahztheme"),
            "param_name" => "orderby",
            "value" => array(
                            __('None', "dahztheme") => "none",
                            __('Date', "dahztheme") => "date",
                            __('Name', "dahztheme") => "name",
                            __('Title', "dahztheme") => "title",
                            __('Random', "dahztheme") => "rand",
                            __('Comment Count', "dahztheme") => "comment_count"
                        ),
            "description" => __("Select order", "dahztheme")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Order by", "dahztheme"),
            "param_name" => "order",
            "value" => array(
            __('None', "dahztheme") => "none",
            __('Descending', "dahztheme") => "DESC",
            __('Ascending', "dahztheme") => "ASC",

            ),
            "description" => __("Select order by", "dahztheme")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Category Include", "dahztheme"),
            "param_name" => "category",
            "description" => __("Fill slug category if you want to show", "dahztheme"),
            "admin_label" => true
        ),
        array(
            "type" => "textfield",
            "heading" => __("Posts ID", "dahztheme"),
            "param_name" => "ids",
            "description" => __("Fill posts id if you want to show", "dahztheme"),
            "admin_label" => true
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class", "dahztheme"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "dahztheme")
        )
    )
));

//Carousel
vc_map( array(
    "name" => __("Carousel", "dahztheme"),
    "base" => "df_slider",
    "as_parent" => array('only' => 'df_slider_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Slide Item", "my-text-domain"),
            "param_name" => "items",
            "description" => __("Number of slides you want to display.", "my-text-domain")
        ),
        array(
            "type" => "checkbox",
            "heading" => __("Autoplay", "my-text-domain"),
            "param_name" => "auto_play",
             "value"       => array(
                                    __("Yes","dahztheme") => 'true',
                                 )
        ),
         array(
            "type" => "checkbox",
            "heading" => __("Use Pagination ?", "my-text-domain"),
            "param_name" => "pagination",
             "value"       => array(
                                    __("Yes","dahztheme") => 'true',
                                 )
        ),
    ),
    "js_view" => 'VcColumnView'
) );
vc_map( array(
    "name" => __("Carousel Item", "dahztheme"),
    "base" => "df_slider_item",
    "content_element" => true,
    "show_settings_on_create" => false,
    "as_child" => array('only' => 'df_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "as_parent" => array('only' => 'member, df_banner, df_video, vc_button, vc_column_text, vc_progress_bar, vc_pie' ),
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "my-text-domain"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "my-text-domain")
        )
    ),
   "js_view" => 'VcColumnView'
) );
//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Df_Slider extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Df_Slider_Item extends WPBakeryShortCodesContainer {
    }
}