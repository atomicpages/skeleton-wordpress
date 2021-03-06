<?php

add_action("init", "of_options");

if(!function_exists("of_options")) {
	function of_options() {
		// Access the WordPress Categories via an Array
		$of_categories 		= array();
		$of_categories_obj 	= get_categories("hide_empty=0");
		foreach($of_categories_obj as $of_cat) {
			$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");
		// Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages("sort_column=post_parent,menu_order");
		foreach($of_pages_obj as $of_page) {
			$of_pages[$of_page->ID] = $of_page->post_name;
		}
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");

		// Testing
		$of_options_select 	= array("one","two","three","four","five");
		$of_options_tf 		= array("true" => "True", "false" => "False");
		$of_options_radio 	= array("one" => "One","two" => "Two", "three" => "Three", "four" => "Four", "five" => "Five");
		// Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array(
			"disabled" => array(
				"placebo" 		=> "placebo", // REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			),
			"enabled" => array(
				"placebo" 		=> "placebo", // REQUIRED!
				"block_four"	=> "Block Four",
			),
		);

		// Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array("");

		if(is_dir($alt_stylesheet_path) ) {
			if($alt_stylesheet_dir = opendir($alt_stylesheet_path)) {
				while(($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false) {
					if(stristr($alt_stylesheet_file, ".css") !== false) {
						$alt_stylesheets[] = $alt_stylesheet_file;
					}
				}
			}
		}

		// Background Images Reader
		$bg_images_path = get_stylesheet_directory(). "/images/bg/"; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri()."/images/bg/"; // change this to where you store your bg images
		$bg_images = array(""); // add single item for no image

		if(is_dir($bg_images_path) ) {
			if($bg_images_dir = opendir($bg_images_path)) {
				while( ($bg_images_file = readdir($bg_images_dir)) !== false) {
					if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
						$bg_images[] = $bg_images_url . $bg_images_file;
					}
				}
			}
		}

		// Google webfont array
		$of_webfont_options = array(
			"none" 					=> "Select a font", // please, always use this key: "none"
			"Alegreya"				=> "Alegreya",
			"Alegreya SC"			=> "Alegreya SC",
			"Bitter"				=> "Bitter",
			"Buenard"				=> "Buenard",
			"Cabin"					=> "Cabin",
			"Cardo"					=> "Cardo",
			"Crimson Text"			=> "Crimson Text",
			"Droid Sans"			=> "Droid Sans",
			"Droid Serif"			=> "Droid Serif",
			"Gentium Book Basic"	=> "Gentium Book Basic",
			"Istok Web"				=> "Istok Web",
			"Josefin Slab"			=> "Josefin Slab",
			"Josefin Sans"			=> "Josefin Sans",
			"Lato"					=> "Lato",
			"Lora"					=> "Lora",
			"Lusitana"				=> "Lusitana",
			"Maven Pro"				=> "Maven Pro",
			"Merriweather"			=> "Merriweather",
			"Neuton"				=> "Neuton",
			"Noticia Text"			=> "Noticia Text",
			"Noto Sans"				=> "Noto Sans",
			"Noto Serif"			=> "Noto Serif",
			"Open Sans"				=> "Open Sans",
			"Oxygen"				=> "Oxygen",
			"PT Sans"				=> "PT Sans",
			"PT Sans Caption"		=> "PT Sans Caption",
			"PT Serif"				=> "PT Serif",
			"PT Serif Caption"		=> "PT Serif Caption",
			"Playfair Display"		=> "Playfair Display",
			"Quattrocento"			=> "Quattrocento",
			"Raleway"				=> "Raleway",
			"Roboto"				=> "Roboto",
			"Source Sans Pro"		=> "Source Sans Pro",
			"Tangerine"				=> "Tangerine",
			"Tinos"					=> "Tinos",
			"Ubuntu"				=> "Ubuntu",
			"Volkhov"				=> "Volkhov"
		);

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/

		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr["path"];
		$all_uploads 		= get_option("of_uploads");
		$other_entries 		= array("Select a number:", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19");
		$body_repeat 		= array("no-repeat", "repeat-x", "repeat-y", "repeat");
		$body_pos 			= array("top left", "top center", "top right", "center left", "center center", "center right", "bottom left", "bottom center", "bottom right");

		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left", "alignright" => "Right", "aligncenter" => "Center");

		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image", "post" => "The Post");


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( 	"name" 		=> "General",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Logo Upload",
						"desc" 		=> "Upload your logo or type in the path to the logo here.",
						"id" 		=> "logo",
						"std" 		=> "",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Tracking Code",
						"desc" 		=> "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
						"id" 		=> "google_analytics",
						"std" 		=> "",
						"type" 		=> "textarea"
				);

$of_options[] = array( 	"name" 		=> "Footer Text",
						"desc" 		=> "Customize your footer easily!",
						"id" 		=> "footer_text",
						"std" 		=> "Powered by [wordpress]. Built with [credit].",
						"type" 		=> "textarea"
				);

$of_options[] = array(
			"name" 		=> "Upload Slides",
			"desc" 		=> "Unlimited slider with drag and drop sortings.",
			"id" 		=> "pingu_slider",
			"std" 		=> "",
			"type" 		=> "slider"
		);

$of_options[] = array( 	"name" 		=> "Styles",
						"type" 		=> "heading"
				);

$url =  ADMIN_DIR . 'assets/images/';
$of_options[] = array( 	"name" 		=> "Main Layout",
						"desc" 		=> "Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.",
						"id" 		=> "layout",
						"std" 		=> "2cl",
						"type" 		=> "images",
						"options" 	=> array(
							"1c" 	=> $url . "1col.png",
							"2cr" 	=> $url . "2cr.png",
							"2cl" 	=> $url . "2cl.png",
							"3clr" 	=> $url . "3clr.png",
							"3cr" 	=> $url . "3cr.png",
							"3cl"	=> $url . "3cl.png"
						)
				);

$of_options[] = array( 	"name" 		=> "Background Images",
						"desc" 		=> "Select a background pattern. By default no patten is selected.",
						"id" 		=> "custom_bg",
						// "std" 		=> $bg_images_url . "bg0.png",
						"std" 		=> "",
						"type" 		=> "tiles",
						"options" 	=> $bg_images,
				);

$of_options[] = array( 	"name" 		=> "Body Background Color",
						"desc" 		=> "Pick a background color for the theme (default: #fff).",
						"id" 		=> "body_background",
						"std" 		=> "",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> "Header Background Color",
						"desc" 		=> "Pick a background color for the header (default: #fff).",
						"id" 		=> "header_background",
						"std" 		=> "",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> "Footer Background Color",
						"desc" 		=> "Pick a background color for the footer (default: #fff).",
						"id" 		=> "footer_background",
						"std" 		=> "",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> "Typography",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Theme Stylesheet",
						"desc" 		=> "Select your themes alternative color scheme.",
						"id" 		=> "alt_stylesheet",
						"std" 		=> "default.css",
						"type" 		=> "select",
						"options" 	=> $alt_stylesheets
				);

$of_options[] = array( 	"name" 		=> "Body Font",
						"desc" 		=> "Specify the body font properties",
						"id" 		=> "body_font",
						"std" 		=> array(
										"size" => "12px",
										"face" => "Arial, sans-serif",
										"style" => "normal",
										"weight" => "normal",
										"color" => "#000000"
									),
						"type" 		=> "typography"
				);

$of_options[] = array( 	"name" 		=> "Heading Font",
						"desc" 		=> "Specify the heading font properties",
						"id" 		=> "heading_font",
						"std" 		=> array(
										"face" => "Arial, sans-serif",
										"style" => "normal",
										"weight" => "normal",
										"color" => "#000000"
									),
						"type" 		=> "typography_limited"
				);

$of_options[] = array( 	"name" 		=> "Navigation Font",
						"desc" 		=> "Specify the nav font properties",
						"id" 		=> "nav_font",
						"std" 		=> array(
										"size" => "12px",
										"face" => "Arial, sans-serif",
										"style" => "normal",
										"weight" => "normal",
										"color" => "#000000"
									),
						"type" 		=> "typography"
				);
/*
$of_options[] = array( 	"name" 		=> "Body Font Selection",
						"desc" 		=> "Some description.",
						"id" 		=> "body_font_select",
						"std" 		=> "Select a font",
						"type" 		=> "select_google_font",
						"preview" 	=> array("size" => "30px"),
						"style"		=> array("normal" => "Normal", "bold" => "Bold"),
						"options" 	=> $of_webfont_options
				);
*/

$of_options[] = array(
						"name"		=> "Slider Options",
						"type"		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Slider Animation",
						"desc" 		=> "Choose whether the slider will slide or fade",
						"id" 		=> "slider_animation",
						"std" 		=> "slide",
						"type" 		=> "select",
						"options" 	=> array("slide" => "Slide", "fade" => "Fade")
				);

$of_options[] = array( 	"name" 		=> "Slider Direction",
						"desc" 		=> "Choose the direction in which the slider will move",
						"id" 		=> "slider_direction",
						"std" 		=> "horizontal",
						"type" 		=> "select",
						"options" 	=> array("horizontal" => "Horizontal", "vertical" => "Vertical")
				);

$of_options[] = array( 	"name" 		=> "Slider Slideshow",
						"desc" 		=> "Choose whether the slide will animate automatically",
						"id" 		=> "slide_auto",
						"std" 		=> "false",
						"type" 		=> "select",
						"options" 	=> array("false" => "False", "true" => "True")
				);

$of_options[] = array(  "name" 		=> "Slideshow Speed",
						"desc" 		=> "Set the speed of the slideshow cycling, in milliseconds",
						"id" 		=> "slideshow_speed",
						"std" 		=> "7000",
						"min" 		=> "0",
						"step"		=> "500",
						"max" 		=> "30000",
						"type" 		=> "sliderui"
				);

$of_options[] = array(  "name" 		=> "Animation Speed",
						"desc" 		=> "Set the speed of the slideshow cycling, in milliseconds",
						"id" 		=> "animation_speed",
						"std" 		=> "600",
						"min" 		=> "0",
						"step"		=> "100",
						"max" 		=> "3000",
						"type" 		=> "sliderui"
				);

$of_options[] = array( 	"name" 		=> "Use Control Navigation",
						"desc" 		=> "Create navigation for paging control of each slide?",
						"id" 		=> "slide_control_nav",
						"std" 		=> "true",
						"type" 		=> "select",
						"mod" 		=> "mini",
						"options" 	=> array("true" => "True", "false" => "False")
				);

$of_options[] = array( 	"name" 		=> "Use Direction Navigation",
						"desc" 		=> "Create navigation for previous/next navigation?",
						"id" 		=> "slide_direction_nav",
						"std" 		=> "true",
						"type" 		=> "select",
						"mod" 		=> "mini",
						"options" 	=> array("true" => "True", "false" => "False")
				);

$of_options[] = array(
						"name"		=> "Custom CSS",
						"type"		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Custom CSS",
						"desc" 		=> "",
						"id" 		=> "custom_css",
						"std" 		=> "/* Enter Custom CSS here */",
						"type" 		=> "textarea"
				);

$of_options[] = array(
						"name"		=> "Custom Scripts",
						"type"		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Custom Scripts",
						"desc" 		=> "",
						"id" 		=> "custom_scripts",
						"std" 		=> "// jQuery is allowed",
						"type" 		=> "textarea"
				);

$of_options[] = array( 	"name" 		=> "Example Options",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Typography",
						"desc" 		=> "This is a typographic specific option.",
						"id" 		=> "typography",
						"std" 		=> array(
											"size"  => "12px",
											"face"  => "verdana",
											"style" => "bold italic",
											"color" => "#123456"
										),
						"type" 		=> "typography"
				);

$of_options[] = array( 	"name" 		=> "Border",
						"desc" 		=> "This is a border specific option.",
						"id" 		=> "border",
						"std" 		=> array(
											"width" => "2",
											"style" => "dotted",
											"color" => "#444444"
										),
						"type" 		=> "border"
				);

$of_options[] = array( 	"name" 		=> "Colorpicker",
						"desc" 		=> "No color selected.",
						"id" 		=> "example_colorpicker",
						"std" 		=> "",
						"type" 		=> "color"
					);

$of_options[] = array( 	"name" 		=> "Colorpicker (default #2098a8)",
						"desc" 		=> "Color selected.",
						"id" 		=> "example_colorpicker_2",
						"std" 		=> "#2098a8",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> "Input Text",
						"desc" 		=> "A text input field.",
						"id" 		=> "test_text",
						"std" 		=> "Default Value",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Input Checkbox (false)",
						"desc" 		=> "Example checkbox with false selected.",
						"id" 		=> "example_checkbox_false",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"name" 		=> "Input Checkbox (true)",
						"desc" 		=> "Example checkbox with true selected.",
						"id" 		=> "example_checkbox_true",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"name" 		=> "Normal Select",
						"desc" 		=> "Normal Select Box.",
						"id" 		=> "example_select",
						"std" 		=> "three",
						"type" 		=> "select",
						"options" 	=> $of_options_select
				);

$of_options[] = array( 	"name" 		=> "Mini Select",
						"desc" 		=> "A mini select box.",
						"id" 		=> "example_select_2",
						"std" 		=> "two",
						"type" 		=> "select",
						"mod" 		=> "mini",
						"options" 	=> $of_options_radio
				);

$of_options[] = array( 	"name" 		=> "Use Tipsy Tooltip",
						"desc" 		=> "Switch to enable Tipsy Tooltips on user-specified selectors",
						"id" 		=> "switch_tipsy",
						"std" 		=> 0,
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"folds"		=> 1,
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Tipsy Selectors",
						"desc" 		=> "Add custom selectors separated by commas",
						"id" 		=> "hidden_tipsy_selectors",
						"std" 		=> "abbr[title], dd[title], .comments-link a",
						"fold" 		=> "switch_tipsy", /* the switch hook */
						"type" 		=> "text"
				);

$url =  ADMIN_DIR . 'assets/images/';
$of_options[] = array( 	"name" 		=> "Image Select",
						"desc" 		=> "Use radio buttons as images.",
						"id" 		=> "images",
						"std" 		=> "warning.css",
						"type" 		=> "images",
						"options" 	=> array(
											'warning.css' 	=> $url . 'warning.png',
											'accept.css' 	=> $url . 'accept.png',
											'wrench.css' 	=> $url . 'wrench.png'
										)
				);

$of_options[] = array( 	"name" 		=> "Textarea",
						"desc" 		=> "Textarea description.",
						"id" 		=> "example_textarea",
						"std" 		=> "Default Text",
						"type" 		=> "textarea"
				);

$of_options[] = array( 	"name" 		=> "Multicheck",
						"desc" 		=> "Multicheck description.",
						"id" 		=> "example_multicheck",
						"std" 		=> array("three","two"),
						"type" 		=> "multicheck",
						"options" 	=> $of_options_radio
				);

$of_options[] = array( 	"name" 		=> "Select a Category",
						"desc" 		=> "A list of all the categories being used on the site.",
						"id" 		=> "example_category",
						"std" 		=> "Select a category:",
						"type" 		=> "select",
						"options" 	=> $of_categories
				);

$of_options[] = array( 	"name" 		=> "Advanced Options",
						"type" 		=> "heading",
				);

$of_options[] = array( 	"name" 		=> "Use Built-in Colorbox",
						"desc" 		=> "Disable this if you wish to use a colrobox or lightbox-like plugin",
						"id" 		=> "use_colorbox",
						"std" 		=> "true",
						"type" 		=> "select",
						"mod" 		=> "mini",
						"options" 	=> $of_options_tf
				);

// Backup Options
$of_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading",
				);

$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);

$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can transfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);

	} // End function: of_options()
} // End check if function exists: of_options()
