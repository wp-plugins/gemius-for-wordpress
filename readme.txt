=== Gemius for WordPress ===
Contributors: tlamedia
Donate link: http://www.tlamedia.dk/
Tags: gemius
Requires at least: 3.2
Tested up to: 3.6
Stable tag: 1.2

Simple implementation of the Gemius Audience tracking script. 

== Description ==

Implementing [Gemius](http://www.gemius.com/) Audience tracking on your blog is very easy. The Gemius tracking script is very simple and anybody can implement it. However, when you are changing themes it is quit easy to forget the Gemius tracking script. With Gemius for WordPress plugin you never have to vory about tracking issues again - it just works.

* Automatically adds the Gemius tracking script to all pages.

== Installation ==

1. Upload the `gemiuswp` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Enter the Gemius Identifier for the site

== Screenshots ==

1. The Gemius Audience for WordPress settings panel.

== Changelog ==

= 1.2 = 

* Updated tracking script to the new improved version that uses BrowserID based on a combination of 3rd party cookies, 1st party cookies and localStorage identifiers. 

* Tested up to WordPress: 3.5.1

= 1.1 = 

* The scripts are now implemented with wp_enqueue_script and wp_localize_script instead of simply including them in the footer. 

* Tested up to WordPress: 3.4.1

= 1.0.1 =

* Tested up to WordPress: 3.4.1

= 1.0 =

* Gemius for WordPress is now stable.

= 0.2 =

* Added uninstall routine to delete configuration data stored in the database when uninstalling the plugin.

= 0.1.1 =

* Added Danish translation.

= 0.1 =

* Initial beta release.

