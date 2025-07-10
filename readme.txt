=== Code Click to Copy ===
Contributors: treeflips, zeroneit
Donate link: https://www.paypal.me/wpjohnny
Tags: code, copy, pre, html, syntax
Requires at least: 4.9
Tested up to: 6.8
Stable tag: 1.0.0
License: GPL-2.0+

Copies `<pre>` and `<code>` tags automatically to clipboard with customizable tooltips.

== Description ==

Simple plugin that automatically copies content in `<pre>` and `<code>` tags to clipboard (when clicked). Other plugins out there do the same but create a little [COPY] button that you have to aim for. Mine doesn't require any aiming, just click anywhere on the code block and it copies the whole thing. Customizable hover tooltip lets you know it's copied.

For sites sharing code-commands, this plugin will save users time from having to highlight and copy-paste bits of text back and forth. It's especially helpful for large globs of code that scroll off-screen, or when copying on your mobile phone. I've added more features to make it more helpful.

**Features:**
* Easy aim - click anywhere on text block to copy entire text, no need to aim for tiny text or clipboard icon.
* Tooltip text customization - change tooltip text.
* Tooltip color options - customize tooltip background and text colors.
* Tooltip hover custom CSS - completely restyle the tooltip hover.
* Tooltip function custom CSS - apply tooltip function to other CSS classes. Allowing copy function on any content block, not only code blocks.

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
You can customize the tooltip through the admin settings at Settings > Code Click to Copy. You can change:
* Tooltip background and text colors
* Custom tooltip text messages
* Apply copy function to other CSS classes
* Custom tooltip CSS class for advanced styling

For advanced CSS customization, you can style the "codeCopyTooltip" CSS class or your custom class.

= Any known incompatibility issues? =

One user reported it didn't work on his DIVI site through DIVI's own "code" block mechanism.

== Screenshots ==
1. Click anywhere on the text to copy. Little box at top-left lets you know it's copied! (show image of once clicked!)

== Changelog ==
= 1.0.0 =
* Major version release - no longer beta
* Added comprehensive customization options
* Tooltip background and text color customization
* Custom tooltip text messages
* Custom CSS class support for tooltip styling
* Custom CSS class support for applying copy function to other elements
* Modern clipboard API with fallback support
* Improved positioning and styling
* Admin settings page for easy customization
* Tested with WordPress 6.8

= 0.1.5 =
* Tested with WordPress 6.8. Updated version number to reflect compatibility with latest WordPress version.

= 0.1.4 =
* It was tested in WP 6.4.2. Program code was cleaned professionally.

= 0.1.3 =
* Multi language is supported. Please make language .po and .mo files in /languages folder. Chinese language file is provided as an example.

= 0.1.2 =

Updated description.

= 0.1.1 =
* Fix parsin error on readme.txt file.

= 0.1.0 =
* Initial Release
