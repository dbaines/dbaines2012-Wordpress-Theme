dbaines2012 - dBaines.com Wordpress Theme
==========================================

This is the theme currently in use at dBaines.com
This project is not something you can take and add to your website and have it "just work". It's the theme I'm currently using on my website and fills very specific requirements of mine.
This project is purely intended as a developer resource to see how the theme was built.

This project is a continuation of the [dbaines2011 Wordpress Theme](https://github.com/dbaines/dbaines2011-Wordpress-Theme).

## Notable features:

* Custom Post types for artwork, motion and website portfolios
* Motion Post Type uses flowplayer to display a .flv video
* Website Post Type uses easySlider to display multiple images of each website project
* Search bar drop down options to search in specific custom post types, or all
* Permalinks for custom post type indexes
* RSS Feeds for custom post types
* Portfolio page takes the latest thumbnail from each area (website, artwork, motion) and creates a button from that image
* Modified SudoSlider script to include keyboard navigation and support for multiple sliders on a single page
* Heavy uses of HTML5 and CSS3
* Custom homepage theme
* Randomised 404 page
* Responsive design for less than 960 width and a mobile-friendly(ish) display for less than 600.
* Custom login page
* Shortcodes reference panel when writing a post
* Theme Options page:
	* Enable Google +1 buttons
	* Enable the count bubble for the Google +1 buttons
	* Twitter-like load more posts option
	* All posts have thumbnails on/off
	* Use custom Wordpress menu instead of hardcoded menu
	* Use custom Wordpress blogroll links category instead of hardcoded friends list
	* Specify number of homepage slides
	* Customise social links and turn them on/off individually
	* Custom Footer text
	* Custom Comments intro text
	* Custom Google Analytics code
	* Customise the search field placeholder attribute
	
It should be noted that this theme does not (and will not) support old browsers.

## Recommended Wordpress Plugins:

* Advanced Excerpt - HTMLified Excerpts for searches and tutorial posts
* Custom Field Template - Very handy template to set up custom fields for different custom post types. 
* Post Types Order - Quickly and easily re-arrange your custom post types - in my case portfolio entries.
* WP Page Navi - The best page navigation replacement plugin. 
* WP Audioscrobbler - Classic last.fm integration

## Credits

### Base:

* HTML5 Boilerplate
* TwentyTen Wordpress Theme (3.1)

### Icons:

* iconsweets2
* inFocus
* Function

### Scripts:

* Modernizr
* SudoSlider
* Colorbox
* Flowplayer

### Fonts:

* TitilliumText

If you are the creator of any of these resources and have issue with me redistributing them, please let me know. I'll be more than happy to remove your material from this project.

## Version History

### 2.0 - 2012-04-01

* Added buttons to TinyMCE editor for shortcodes - /functions/functions.tinymce.php
	* Download Button - [download]
	* Demo/Download Buttons - [demodownload]
	* Message Box - [info], [important] and [error]
	* Highlight - [hilight]
	* Code - [code]
	* Codebox - [codebox] - doesn't quite work properly yet :(
	* Float Right - [fright]

* New Shortcode + TinyMCE Buton:
	* Divider - three styles:
		* HR - just a line
		* Back To Top - a line with a "back to top" button
		* Clear - this replaces [clear] with an invisible divider

* New theme options:
	* Social Icons are now sortable using jQuery UI Sortable, code is undesirably repeated, need to re-think default order setting.
	* Use widgets for the subsection areas

* Changed SudoSlider to FlexSlider for a responsive content slider
* Improved responsive and mobile media queries
* Added small and large icons for custom post types in Wordpress administration - bottom of functions/functions.post-types.php
* Added custom post types to "Right Now" dashboard
* Changed slider/colourbox arrows to use CSS3 transitions instead of jQuery animation
* Moved custom image sizes in to functions file to avoid the reliance on the Aditional Image Sizes plugin
* Laid the groundwork for moving custom post type fields in to a functions file (functions/functions.post-type-fields.php) to avoid the reliance on the Custom Field Template plugin
* Fixed thumbnail sizes on search results
* Removed change log from style.css to reduce page load a bit
* Fixed the [col] shortcode description in functions.shortcodes.php
* Cleaned up the <head> for a nicer source code view. Empty lines above and below php comments stop the wierd spacing behaviour, yet look floaty. A fair compromise. 
* Fixed some &s that should be &amp;s in the rss feed links in the <head>
* Fixed contact me link to </a></li> instead of </a></a>
* Added human_time_diff times for post dates (posted x days ago) to header.php, loop.php, search.php
* Smushed a whole bunch of images

### 1.1 - 2012-01-18

* Fixed missing theme option: slider category. Specifies which category of posts to show on the homepage slider
* Fixed google plus social icon options
* Redesigned theme options page to use tabs to make it easier to use
* Wiki now available on github project page
* New theme options:
	* Social Image (/images/facebook.png)
	* Facebook og:type
	* Facebook fb:admins
	* Facebook fb:app_id
	* Meta Author
	* Meta Description
	* Meta Keywords
* Google +1 script now only loads if +1 has been enabled in theme options.

### 1.0 - 2012-01-17

* Initial Release
* Changes from dbaines2011-Wordpress-Theme:
	* Updated look and feel for 2012
	* Redesigned Slider
		* Titles and categories have been brought in
		* CSS3 animations on hover, fallback to always showing for unsupported browsers
		* Bullet Navigation
		* Posts that in the "Tutorials" category included in slider
	* New Theme Options
		* Redeveloped and based on [Plugin Options Starter Kit](http://wordpress.org/extend/plugins/plugin-options-starter-kit/)
		* Show/Hide author information at the bottom of posts
		* Number of slides on the homepage
		* Show "Listening To" on blog posts
		* WYSIWYG eidtor fot:
			* Homepage Introduction
			* Comments Introduction
			* Footer text
		* Show/Hide social links in header and customise URLs
		* Search field placeholder attribute
	* Styling for paged posts
	* Removed some unnecessary "type" attributes on links and scripts
	* Revamped login screen to match changes for Wordpress 3.3.x

### Previous Version History
* This theme is a continuation of the [dbaines2011-Wordpress-Theme project](https://github.com/dbaines/dbaines2011-Wordpress-Theme).