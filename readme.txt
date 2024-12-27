= Jacqui =

Theme Name:   Jacqui

Contributors: Sunland Computers

Requires PHP: 7.2

Requires CP:  1.4

Tested up to: 2.3

Version:      2.0.0

Text domain:  jacqui

* by Larry Judd Oliver http://tradesouthwest.com/
* built on the Gridiculous Responsive Grid Boilerplate http://gridiculo.us/

== ABOUT JACQUI ==

Supported post formats: Video, Image, Aside, Status, Audio, Quote, Link and Gallery. Works perfectly in desktop browsers, tablets and handheld devices. For a live demo go to http://themes.tradesouthwest.com/jacqui.

== NOTES ==

* Only top level (parent) menu items should used in footer. Same with top menu IF you are concerned about touch screens. It is a good place to add social media links as a menu item.
* If a left sidebar layout option is selected, the sidebar will go offcanvas on mobile devices and appear below the mobile menu when the top left icon is clicked.

== LICENSE ==

html5shiv - http://code.google.com/p/html5shiv/
License: [[http://opensource.org/licenses/MIT|MIT]]

Normalize.css - http://necolas.github.io/normalize.css/
License: Free to use
Copyright: Nicolas Gallagher, Jonathan Neal

Harvey.js - http://harvesthq.github.io/harvey/
License: [[http://opensource.org/licenses/MIT|MIT]]
Copyright: Harvest, http://www.getharvest.com/

Font Awesome - http://fortawesome.github.io/Font-Awesome/
License: [[http://opensource.org/licenses/MIT|MIT]]
Copyright: Dave Gandy, https://twitter.com/davegandy

Google Fonts - http://www.google.com/fonts/
License: [[http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL|SIL Open Font License]]

All bundled images including background created with GIMP by Author | GPL License

== CHANGELOG ==
= 0.9 =
March 30th 2015
* fixed illegal string offset error.

= 0.8 Feb. 22, 2015 =
* fixed slugs in enqueue scripts
* removed docs folder - docs in plugin svn now

= 0.7 Feb. 21st, 2015 =
* theme was not calling dynamic sidebar correctly, fixed

= 0.6 Feb. 21st, 2015 =
* added string definition to sanitize theme options theme mod 'layout'

= 0.5 Feb. 21, 2015 =
* fixed plugin url source
* added docs folder with instructions on how to use lugin with other themes.

= 0.4 Feb. 20, 2015 =
* created function for content width
* fixed some sanitizers
* removed some notes from functions file
* reworked google fonts enqueue to include ssl connect
* verified svn for plugin is now active.

= 0.3 Feb 4th 2015 =
* escaped some echo strings in functions file
* internationalize the text in sidebar-header-area.php and other files updated
* escaped the variables in jacqui_primary_attr() and jacqui_sidebar_class() 
* enque scripts prefixed correctly. 
* added IE browser agent meta to html5 shiv enqueue.
* replaced minified with non minified shiv

= 0.2 =
* escape the variables in jqi_primary_attr(), jqi_styles() and jqi_sidebar_class()
* escape $jqi_theme_options in header.php
* define the text domain in the style.css header and make sure it is the theme slug jacqui
* In function jqi_register_required_plugins() 'required' set to false and 'dismissable' to true
* code in functions.php line 86-89 placed in a function
* script handles in jqi_custom_enqueue_scripts() prefixed correctly.
* remove the admin bar menu. It is not needed.
* licence of the images included in the theme in the readme. 
* added newer version of Font Awesome
* fixed mobile menu icons 

== TO DO ==
