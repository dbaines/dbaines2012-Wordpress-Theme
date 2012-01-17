<?php
/*
Plugin Name: Plugin Options Starter Kit
Plugin URI: http://www.presscoders.com/plugins/plugin-options-starter-kit/
Description: Starter kit to help create Plugin options pages. Contains all the commonly used form options.
Version: 0.2
Author: David Gwyer
Author URI: http://www.presscoders.com
*/

/*  Copyright 2009 David Gwyer (email : d.v.gwyer@presscoders.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// ------------------------------------------------------------------------
// REQUIRE MINIMUM VERSION OF WORDPRESS:                                               
// ------------------------------------------------------------------------
// THIS IS USEFUL IF YOU REQUIRE A MINIMUM VERSION OF WORDPRESS TO RUN YOUR
// PLUGIN. IN THIS PLUGIN THE WP_EDITOR() FUNCTION REQUIRES WORDPRESS 3.3 
// OR ABOVE. ANYTHING LESS SHOWS A WARNING AND THE PLUGIN IS DEACTIVATED.                    
// ------------------------------------------------------------------------

function requires_wordpress_version() {
	global $wp_version;
	$plugin = plugin_basename( __FILE__ );
	$plugin_data = get_plugin_data( __FILE__, false );

	if ( version_compare($wp_version, "3.3", "<" ) ) {
		if( is_plugin_active($plugin) ) {
			deactivate_plugins( $plugin );
			wp_die( "'".$plugin_data['Name']."' requires WordPress 3.3 or higher, and has been deactivated! Please upgrade WordPress and try again.<br /><br />Back to <a href='".admin_url()."'>WordPress admin</a>." );
		}
	}
}
add_action( 'admin_init', 'requires_wordpress_version' );

// ------------------------------------------------------------------------
// PLUGIN PREFIX:                                                          
// ------------------------------------------------------------------------
// A PREFIX IS USED TO AVOID CONFLICTS WITH EXISTING PLUGIN FUNCTION NAMES.
// WHEN CREATING A NEW PLUGIN, CHANGE THE PREFIX AND USE YOUR TEXT EDITORS 
// SEARCH/REPLACE FUNCTION TO RENAME THEM ALL QUICKLY.
// ------------------------------------------------------------------------

// 'posk_' prefix is derived from [p]plugin [o]ptions [s]tarter [k]it

// ------------------------------------------------------------------------
// REGISTER HOOKS & CALLBACK FUNCTIONS:
// ------------------------------------------------------------------------
// HOOKS TO SETUP DEFAULT PLUGIN OPTIONS, HANDLE CLEAN-UP OF OPTIONS WHEN
// PLUGIN IS DEACTIVATED AND DELETED, INITIALISE PLUGIN, ADD OPTIONS PAGE.
// ------------------------------------------------------------------------

// Set-up Action and Filter Hooks
register_activation_hook(__FILE__, 'posk_add_defaults');
register_uninstall_hook(__FILE__, 'posk_delete_plugin_options');
add_action('admin_init', 'posk_init' );
add_action('admin_menu', 'posk_add_options_page');
add_filter( 'plugin_action_links', 'posk_plugin_action_links', 10, 2 );

// --------------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: register_uninstall_hook(__FILE__, 'posk_delete_plugin_options')
// --------------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE USER DEACTIVATES AND DELETES THE PLUGIN. IT SIMPLY DELETES
// THE PLUGIN OPTIONS DB ENTRY (WHICH IS AN ARRAY STORING ALL THE PLUGIN OPTIONS).
// --------------------------------------------------------------------------------------

// Delete options table entries ONLY when plugin deactivated AND deleted
function posk_delete_plugin_options() {
	delete_option('db_options');
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: register_activation_hook(__FILE__, 'posk_add_defaults')
// ------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE PLUGIN IS ACTIVATED. IF THERE ARE NO THEME OPTIONS
// CURRENTLY SET, OR THE USER HAS SELECTED THE CHECKBOX TO RESET OPTIONS TO THEIR
// DEFAULTS THEN THE OPTIONS ARE SET/RESET.
//
// OTHERWISE, THE PLUGIN OPTIONS REMAIN UNCHANGED.
// ------------------------------------------------------------------------------

// Define default option settings
function posk_add_defaults() {
	$tmp = get_option('db_options');
    if(($tmp['chk_default_options_db']=='1')||(!is_array($tmp))) {
		delete_option('db_options'); // so we don't have to reset all the 'off' checkboxes too! (don't think this is needed but leave for now)

		// Default settings
		$arr = array(
			"wpmenu" => "0",
			"plusone" => "1",
			"plusone_count" => "0",
			"authorinfo" => "0",
			"loadmore" => "1",
			"allthumbs" => "0",
			"blogrollfriends" => "0",
			"homeslides" => "5",
			"footertext" => 'Copyright &copy; David Baines 2011 &bull; <a href="http://dbaines.com/about">About</a> &bull; <a href="http://dbaines.com/sitemap">Sitemap</a> &bull; <a href="http://dbaines.com/accessability">Accessability</a> &bull; <a href="http://dbaines.com/blog/wp-admin/">Login</a>',
			"commentswarn" => "Please note: Any comments in a language other than English will be deleted. Similarly any comments using your website name or SEO keywords as your name will also be deleted. If it's your first time commenting your first comment will need to be approved, after which you will be able to comment freely.",
			"googleua" => "UA-12345-6"
		);
		update_option('db_options', $arr);
	}
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: add_action('admin_init', 'posk_init' )
// ------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE 'admin_init' HOOK FIRES, AND REGISTERS YOUR PLUGIN
// SETTING WITH THE WORDPRESS SETTINGS API. YOU WON'T BE ABLE TO USE THE SETTINGS
// API UNTIL YOU DO.
// ------------------------------------------------------------------------------

// Init plugin options to white list our options
function posk_init(){
	register_setting( 'posk_plugin_options', 'db_options', 'posk_validate_options' );
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: add_action('admin_menu', 'posk_add_options_page');
// ------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE 'admin_menu' HOOK FIRES, AND ADDS A NEW OPTIONS
// PAGE FOR YOUR PLUGIN TO THE SETTINGS MENU.
// ------------------------------------------------------------------------------

// Add menu page
function posk_add_options_page() {
	add_submenu_page('themes.php', 'Template Options', 'Template Options', 'manage_options', 'theme-options', 'posk_render_form');
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION SPECIFIED IN: add_options_page()
// ------------------------------------------------------------------------------
// THIS FUNCTION IS SPECIFIED IN add_options_page() AS THE CALLBACK FUNCTION THAT
// ACTUALLY RENDER THE PLUGIN OPTIONS FORM AS A SUB-MENU UNDER THE EXISTING
// SETTINGS ADMIN MENU.
// ------------------------------------------------------------------------------

// Render the Plugin options form
function posk_render_form() {
	?>
	<div class="wrap">
		
		<!-- Display Plugin Icon, Header, and Description -->
		<div class="icon32" id="icon-options-general"><br></div>
		<h2>dBaines 2012 Template Options</h2>
		<p>Use these options to customise your dBaines2012 experience!</p>

		<form method="post" action="options.php">
			<?php settings_fields('posk_plugin_options'); ?>
			<?php $options = get_option('db_options'); ?>

			<!-- Start Table -->
			<table class="form-table">
				
				<!-- LAYOUT -->
				<tr>
					<th scope="heading" colspan="2"><h2 style="border-bottom: 1px solid #ddd;">Layout</h2></th>
				</tr>
				<tr>
					<th scope="row">Wordpress Menu</th>
					<td>
						<label><input name="db_options[wpmenu]" type="checkbox" value="1" <?php if (isset($options['wpmenu'])) { checked('1', $options['wpmenu']); } ?> /> Tick to enable Wordpress Menu instead of hardcoded menu.</label>
					</td>
				</tr>
				<tr>
					<th scope="row">Google +1 Buttons</th>
					<td>
						<label><input name="db_options[plusone]" type="checkbox" value="1" <?php if (isset($options['plusone'])) { checked('1', $options['plusone']); } ?> /> Tick to enable Google +1 Buttons on your full post pages.</label>
					</td>
				</tr>
				<tr>
					<th scope="row">Google +1 Count</th>
					<td>
						<label><input name="db_options[plusone_count]" type="checkbox" value="1" <?php if (isset($options['plusone_count'])) { checked('1', $options['plusone_count']); } ?> /> Tick to enable the count bubbles on the +1 buttons. </label>
					</td>
				</tr>
				<tr>
					<th scope="row">Author Info</th>
					<td>
						<label><input name="db_options[authorinfo]" type="checkbox" value="1" <?php if (isset($options['authorinfo'])) { checked('1', $options['authorinfo']); } ?> /> Show author info at the bottom of posts. Only shows if the author has filled in their Wordpress profile.</label>
					</td>
				</tr>
				<tr>
					<th scope="row">Show "Listening To" field on posts</th>
					<td>
						<label><input name="db_options[listeningto]" type="checkbox" value="1" <?php if (isset($options['listeningto'])) { checked('1', $options['listeningto']); } ?> /> If ticked, you can set a "Listening To" custom field when posting that will display at the bottom of your published post.</label>
					</td>
				</tr>
				<tr>
					<th scope="row">AJAX Load More Posts</th>
					<td>
						<label><input name="db_options[loadmore]" type="checkbox" value="1" <?php if (isset($options['loadmore'])) { checked('1', $options['loadmore']); } ?> /> Tick to enable a twitter/facebook style 'load more' button instead of pagination. </label>
					</td>
				</tr>
				<tr>
					<th scope="row">All My Posts Have Thumbnails</th>
					<td>
						<label><input name="db_options[allthumbs]" type="checkbox" value="1" <?php if (isset($options['allthumbs'])) { checked('1', $options['allthumbs']); } ?> /> Tick to show thumbnails for all posts. Untick to only show thumbnails for posts in the 'tutorial' category.</label>
					</td>
				</tr>
				<tr>
					<th scope="row">Blogroll For "Friends"</th>
					<td>
						<label><input name="db_options[blogrollfriends]" type="checkbox" value="1" <?php if (isset($options['blogrollfriends'])) { checked('1', $options['blogrollfriends']); } ?> /> Tick to replace the 'friends' links at the bottom of the page with the links from the 'blogroll' category of links.</label>
					</td>
				</tr>
				<tr>
					<th scope="row">Homepage Slides</th>
					<td>
						<input type="text" size="57" name="db_options[homeslides]" value="<?php echo $options['homeslides']; ?>" />
						<br /><span style="color:#666666;margin-left:2px;">The number of slides to show on your homepage.</span>
					</td>
				</tr>

				<!-- SOCIAL ICONS -->
				<tr>
					<th scope="heading" colspan="2"><h2 style="border-bottom: 1px solid #ddd;">Social Icons (Header)</h2></th>
				</tr>
				<tr>
					<th scope="row">Github</th>
					<td>
						<span style="color:#666666;margin-left:2px;">Show:</span>
						<input name="db_options[si_github]" type="checkbox" value="1" <?php if (isset($options['si_github'])) { checked('1', $options['si_github']); } ?> />

						<span style="color:#666666;margin-left:2px;">URL:</span>
						<input type="text" size="57" name="db_options[si_github_url]" value="<?php echo $options['si_github_url']; ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row">Google+</th>
					<td>
						<span style="color:#666666;margin-left:2px;">Show:</span>
						<input name="db_options[si_googeplus]" type="checkbox" value="1" <?php if (isset($options['si_googeplus'])) { checked('1', $options['si_googeplus']); } ?> />

						<span style="color:#666666;margin-left:2px;">URL:</span>
						<input type="text" size="57" name="db_options[si_googeplus_url]" value="<?php echo $options['si_googeplus_url']; ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row">Forrst</th>
					<td>
						<span style="color:#666666;margin-left:2px;">Show:</span>
						<input name="db_options[si_forrst]" type="checkbox" value="1" <?php if (isset($options['si_forrst'])) { checked('1', $options['si_forrst']); } ?> />

						<span style="color:#666666;margin-left:2px;">URL:</span>
						<input type="text" size="57" name="db_options[si_forrst_url]" value="<?php echo $options['si_forrst_url']; ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row">Reddit</th>
					<td>
						<span style="color:#666666;margin-left:2px;">Show:</span>
						<input name="db_options[si_reddit]" type="checkbox" value="1" <?php if (isset($options['si_reddit'])) { checked('1', $options['si_reddit']); } ?> />

						<span style="color:#666666;margin-left:2px;">URL:</span>
						<input type="text" size="57" name="db_options[si_reddit_url]" value="<?php echo $options['si_reddit_url']; ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row">Steam Community</th>
					<td>
						<span style="color:#666666;margin-left:2px;">Show:</span>
						<input name="db_options[si_steam]" type="checkbox" value="1" <?php if (isset($options['si_steam'])) { checked('1', $options['si_steam']); } ?> />

						<span style="color:#666666;margin-left:2px;">URL:</span>
						<input type="text" size="57" name="db_options[si_steam_url]" value="<?php echo $options['si_steam_url']; ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row">Last.fm (AudioScrobbler)</th>
					<td>
						<span style="color:#666666;margin-left:2px;">Show:</span>
						<input name="db_options[si_lastfm]" type="checkbox" value="1" <?php if (isset($options['si_lastfm'])) { checked('1', $options['si_lastfm']); } ?> />

						<span style="color:#666666;margin-left:2px;">URL:</span>
						<input type="text" size="57" name="db_options[si_lastfm_url]" value="<?php echo $options['si_lastfm_url']; ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row">Twitter</th>
					<td>
						<span style="color:#666666;margin-left:2px;">Show:</span>
						<input name="db_options[si_twitter]" type="checkbox" value="1" <?php if (isset($options['si_twitter'])) { checked('1', $options['si_twitter']); } ?> />

						<span style="color:#666666;margin-left:2px;">URL:</span>
						<input type="text" size="57" name="db_options[si_twitter_url]" value="<?php echo $options['si_twitter_url']; ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row">Facebook</th>
					<td>
						<span style="color:#666666;margin-left:2px;">Show:</span>
						<input name="db_options[si_facebook]" type="checkbox" value="1" <?php if (isset($options['si_facebook'])) { checked('1', $options['si_facebook']); } ?> />

						<span style="color:#666666;margin-left:2px;">URL:</span>
						<input type="text" size="57" name="db_options[si_facebook_url]" value="<?php echo $options['si_facebook_url']; ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row">LinkedIn</th>
					<td>
						<span style="color:#666666;margin-left:2px;">Show:</span>
						<input name="db_options[si_linkedin]" type="checkbox" value="1" <?php if (isset($options['si_linkedin'])) { checked('1', $options['si_linkedin']); } ?> />

						<span style="color:#666666;margin-left:2px;">URL:</span>
						<input type="text" size="57" name="db_options[si_linkedin_url]" value="<?php echo $options['si_linkedin_url']; ?>" />
					</td>
				</tr>


				<!-- CUSTOMISATIONS -->
				<tr>
					<th scope="heading" colspan="2"><h2 style="border-bottom: 1px solid #ddd;">Text Customisations</h2></th>
				</tr>
				<tr>
					<th scope="row">Homepage Introduction</th>
					<td>
						<?php
							$args = array("textarea_name" => "db_options[homecontent]");
							wp_editor( $options['homecontent'], "db_options[homecontent]", $args );
						?>
						<br /><span style="color:#666666;margin-left:2px;">This text appears on the homepage underneath your slider.</span>
					</td>
				</tr>
				<tr>
					<th scope="row">Footer Text</th>
					<td>
						<?php
							$args = array("textarea_name" => "db_options[footertext]");
							wp_editor( $options['footertext'], "db_options[footertext]", $args );
						?>
						<br /><span style="color:#666666;margin-left:2px;">This text appears in the footer of your pages.</span>
					</td>
				</tr>
				<tr>
					<th scope="row">Comments Warning Text (Optional)</th>
					<td>
						<?php
							$args = array("textarea_name" => "db_options[commentswarn]");
							wp_editor( $options['commentswarn'], "db_options[commentswarn]", $args );
						?>
						<br /><span style="color:#666666;margin-left:2px;">This text appears above the comments form.</span>
					</td>
				</tr>
				<tr>
					<th scope="row">Search Placeholder</th>
					<td>
						<input type="text" size="57" name="db_options[searchplaceholder]" value="<?php echo $options['searchplaceholder']; ?>" />
						<br /><span style="color:#666666;margin-left:2px;">The placeholder attribute for the search field.</span>
					</td>
				</tr>

				<!-- OTHER STUFF -->
				<tr>
					<th scope="heading" colspan="2"><h2 style="border-bottom: 1px solid #ddd;">Other Stuff</h2></th>
				</tr>
				<tr>
					<th scope="row">Google Analytics UA Code</th>
					<td>
						<input type="text" size="57" name="db_options[googleua]" value="<?php echo $options['googleua']; ?>" />
						<br /><span style="color:#666666;margin-left:2px;">The UA Code for your Google Analytics. Should look like: UA-XXXXX-X</span>
					</td>
				</tr>

			</table>
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>

		<small style="margin-top:15px; text-align: right; display: block;">
			Template Options made with the fantastic <a href="http://wordpress.org/extend/plugins/plugin-options-starter-kit/">Plugin Options Starter Kit</a>. 
		</small>

	</div>
	<?php	
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function posk_validate_options($input) {
	 // strip html from textboxes
	$input['textarea_one'] =  wp_filter_nohtml_kses($input['textarea_one']); // Sanitize textarea input (strip html tags, and escape characters)
	$input['txt_one'] =  wp_filter_nohtml_kses($input['txt_one']); // Sanitize textbox input (strip html tags, and escape characters)
	return $input;
}

// Display a Settings link on the main Plugins page
function posk_plugin_action_links( $links, $file ) {

	if ( $file == plugin_basename( __FILE__ ) ) {
		$posk_links = '<a href="'.get_admin_url().'options-general.php?page=plugin-options-starter-kit/plugin-options-starter-kit.php">'.__('Settings').'</a>';
		// make the 'Settings' link appear first
		array_unshift( $links, $posk_links );
	}

	return $links;
}

// ------------------------------------------------------------------------------
// SAMPLE USAGE FUNCTIONS:
// ------------------------------------------------------------------------------
// THE FOLLOWING FUNCTIONS SAMPLE USAGE OF THE PLUGINS OPTIONS DEFINED ABOVE. TRY
// CHANGING THE DROPDOWN SELECT BOX VALUE AND SAVING THE CHANGES. THEN REFRESH
// A PAGE ON YOUR SITE TO SEE THE UPDATED VALUE.
// ------------------------------------------------------------------------------

// As a demo let's add a paragraph of the select box value to the content output
/*
add_filter( "the_content", "posk_add_content" );
function posk_add_content($text) {
	$options = get_option('db_options');
	$select = $options['wpmenu'];
	$text = "<p style=\"color: #777;border:1px dashed #999; padding: 6px;\">Select box Plugin option is: {$select}</p>{$text}";
	return $text;
}
*/

function getTemplateOption($option) {
	$options = get_option('db_options');
	return $options[$option];
}