<?php

/* =======================================================

CUSTOM TINYMCE BUTTONS
http://wp.tutsplus.com/tutorials/theme-development/wordpress-shortcodes-the-right-way/
http://codex.wordpress.org/TinyMCE_Custom_Buttons
http://www.garyc40.com/2010/03/how-to-make-shortcodes-user-friendly/

======================================================= */

// Add the button on init
add_action('init', 'add_button');

// Adding out button - the function - the musical - on ice.
function add_button() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'add_plugin');  
     add_filter('mce_buttons', 'register_button');  
   }  
}  

// Add Button CSS
function button_css($hook) { 

	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/functions/tinymce/images/editor_buttons.css" />'; 
}
add_action( 'admin_print_styles-post.php', 'button_css' );
add_action( 'admin_print_styles-post-new.php', 'button_css' );

// Register our new buttons
function register_button($buttons) {
	array_push($buttons, "download"); 
	array_push($buttons, "demodownload"); 
	array_push($buttons, "dividers"); 
	array_push($buttons, "message"); 
	array_push($buttons, "highlight"); 
	array_push($buttons, "code"); 
	array_push($buttons, "codebox"); 
	array_push($buttons, "floatright"); 
	array_push($buttons, "columns"); 
	return $buttons;  
}  

// Register a JS file for each button
function add_plugin($plugin_array) { 
	$plugin_array['download'] = get_bloginfo('template_url').'/functions/tinymce/download.js'; 
	$plugin_array['demodownload'] = get_bloginfo('template_url').'/functions/tinymce/demo_download.js'; 
	$plugin_array['dividers'] = get_bloginfo('template_url').'/functions/tinymce/dividers.js'; 
	$plugin_array['message'] = get_bloginfo('template_url').'/functions/tinymce/message.js'; 
	$plugin_array['highlight'] = get_bloginfo('template_url').'/functions/tinymce/highlight.js'; 
	$plugin_array['code'] = get_bloginfo('template_url').'/functions/tinymce/code.js'; 
	$plugin_array['codebox'] = get_bloginfo('template_url').'/functions/tinymce/codebox.js'; 
	$plugin_array['floatright'] = get_bloginfo('template_url').'/functions/tinymce/float_right.js'; 

	/*
	$plugin_array['columns'] = get_bloginfo('template_url').'/functions/tinymce/columns.js'; 
	$plugin_array['subhead'] = get_bloginfo('template_url').'/functions/tinymce/subhead.js'; 
	$plugin_array['blockquote'] = get_bloginfo('template_url').'/functions/tinymce/blockquote.js'; 
	$plugin_array['pullquote'] = get_bloginfo('template_url').'/functions/tinymce/pullquote.js'; 
	$plugin_array['accordion'] = get_bloginfo('template_url').'/functions/tinymce/accordion.js'; 
	*/

	return $plugin_array;  
} 

?>