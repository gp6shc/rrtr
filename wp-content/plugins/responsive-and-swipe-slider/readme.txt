=== RESPONSIVE AND SWIPE SLIDER! ===
Contributors: mansoormunib
Tags: Wordpress responsive and swipe slider, flex slider, responsive slider, responsive image gallery, Swipe image gallery, image slider gallery mobile, Tablet image gallery, Mobile image gallery
Requires at least: 3.4.1
Tested up to: 3.8
Version: 1.0.1
Stable tag: 1.0.1

RESPONSIVE AND SWIPE SLIDER creates multiple gallery each having multiple images

== Description ==
RESPONSIVE AND SWIPE SLIDER can create multiple image galleries and you can display by using short code [rsSlider id=27]. Where 27 is the post id. You can get this shortcode in the admin panel.

Each gallery can be of different size. You can set the size of gallery under the Slider panel setting. If you want to add your own custom size then use add_image_size() in the function.php file. More detail can be found here how to add custom image sizes http://codex.wordpress.org/Function_Reference/add_image_size
After doing that you can select your own custom size in the Slider setting panel.

More over you can choose to display the title and description of each image and you can also hide it admin panel setting

== Screenshots ==

1. Admin panel will look like this. You can use this shortcode in the content.
2. Add new slides inside gallery.
3. Slider setting panel

== Installation ==

1. Download the plugin and extract the files
2. Upload `responsive-and-swipe-slider` to your `~/wp-content/plugins/` directory
3. Edit the templates your Theme uses and add the following code:
    
	`<?php
		echo do_shortcode("[rsSlider id=27]");
	?>`
	
4. You can also add the short code in the content.

Test it out and enjoy!


== Frequently Asked Questions ==

= When will the next version of your plugin be released? =
As soon as I find the time, I will update the plugin and release a new version.