=== Code Click to Copy ===
Contributors: treeflips
Donate link: https://www.paypal.me/wpjohnny
Tags: code, copy, pre, html, syntax
Requires at least: 4.9
Tested up to: 5.4.2
Stable tag: 0.1.2
License: GPL-2.0+

Copies content inside `<code>` tags automatically to clipboard.

== Description ==

Simple plugin that automatically copies content in `<code>` tags to clipboard (when clicked). Other plugins out there do the same but create a little [COPY] button that you have to aim for. Mine doesn't require any aiming, just click anywhere on the code block and it copies the whole thing.

For any sites sharing code-commands, this plugin will save users time from having to highlight and copy-paste bits of text back and forth. It’s especially helpful for large globs of code that scroll off-screen, or when copying on your mobile phone.

== Installation ==

1. Install easily from your dashboard Add Plugins page or manually download the plugin and upload the extracted archived to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= Does this plugin work with newest WP version and also older versions? =
Yes, this plugin works perfect with the latest version of WordPress! It also works with older versions as well but you should always run the latest WordPress and PHP version for best security and performance. This plugin is used in my critical sites so you can be assured it works perfect.

= Will this plugin slow down my site? =
No. It's coded extremely lightweight. The plugin CSS and JS is only 1.7KB total, and inlined in your site footer. No extra CSS or JS files are loaded. It does only the essential function and nothing more. No heavy PHP processing or database queries. I'm an absolute speed fanatic.

= Do you plan to add more features? =
Not unless someone wanted to pay for my development time and costs. This was intended as a free community plugin. 

= How do I style the copy block? =
You can style the "codecopy_tooltip" CSS class. Change background, color, font-family, font-size, padding, word-wrap, overflow, etc. I might add this option in the plugin one day but just trying to keep it lightweight for now.

= What if I don't see the click option? =

Make sure your content is wrapped in "code" tags.

= Any known incompatibility issues? =

One user reported it didn't work on his DIVI site through DIVI's own "code" block mechanism.

== Screenshots ==
1. Click anywhere on the text to copy. Little box at top-left lets you know it's copied! (show image of once clicked!)

== Changelog ==

= 0.1.1 =

Updated description.

= 0.1.1 =
* Fix parsin error on readme.txt file.

= 0.1.0 =
* Initial Release
