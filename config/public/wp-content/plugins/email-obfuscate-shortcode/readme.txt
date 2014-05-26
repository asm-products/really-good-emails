=== Email Obfuscate Shortcode ===
Contributors: khromov
Tags: email, obfuscator, email obfuscator, spam stopper
Requires at least: 3.0
Tested up to: 3.8.1
Stable tag: 2.0
License: GPL2

Obfuscate your email address or other sensitive information with a shortcode to prevent spam and automated harvesting of data.

== Description ==
Obfuscate your email address or other sensitive information with a shortcode to prevent harvesting of your data.

Version 2.0 includes an improved way of displaying the email without relying on JavaScript document.write();

**Usage**

*Basic usage*

[email-obfuscate email="bob@example.com"]

*Setting custom link text*

[email-obfuscate email="bob@example.com" link_title="Email Bob!"]

*Setting custom link title attribute"

[email-obfuscate email="bob@example.com" tag_title="Email Bob!"]

*Using every available setting (this example shows their default values)*

[email-obfuscate email="bob@example.com" linkable="1" link_title="" use_htmlentities="1" use_noscript_fallback="1" noscript_message="Please enable JavaScript to see this field."]

**Usage from a template or plugin**

Below is a snippet that you can use in any template or plugin to apply the same obfuscation to an email as using the shortcode:

if(function_exists('eos_obfuscate'))
{
  echo eos_obfuscate(array('email' => $email, 'link_title' => 'Email Bob!'));
}
else 
{
  echo $email;
}
    
If the plugin is not enabled, the email address will just pass through and output in cleartext.

== Requirements ==
* PHP 5.3 or higher
* mbstring extension

== Translations ==
* Swedish

== Installation ==
1. Upload the `email-obfuscate-shortcode` folder to `/wp-content/plugins/`
2. Activate the plugin (Email Obfuscate Shortcode) through the 'Plugins' menu in WordPress
3. Use the shortcode in any post, page or custom post type.

== Frequently Asked Questions ==

= How does this plugin prevent my email address or other personal information from being harvested? =

Email Obfuscate Shortcode converts your email address into JavaScript-based snippet. This makes the address unreadable to the vast majority
of email harvesting techniques.

= What browsers is this plugin compatible with? =
Internet Explorer 6 and up, any Firefox, Chrome, Safari or Opera version.

= How do you obfuscate information other than email addresses? =

To obfuscate phone numbers, names and other sensitive information, pass the parameter linkable="0". This will print anything you
put in the "email" field as text onto your page, fully protected.

= Will people without JavaScript see my email address? =

People without JavaScript will see a placeholder message urging them to enable JavaScript. The current placeholder message reads:
"Please enable JavaScript to see this field."

You can customize this message by passing the noscript_message="" parameter to the shortcode.

= Is the solution bulletproof? =

This protection has been proven very effective. However it is theoretically possible to harvest the email address if you run a real browser that resolves javascript (Selenium, Mechanical Turk workers etc.)

== Screenshots ==

1. Shortcode example in editor
2. Obfuscated JavaScript code as rendered to page

== Changelog ==
= 2.0 =
* Improved way of displaying emails, using getElementByID and innerHTML(). This plugin is no longer dependent on document.write and can now be used when data is displayed via AJAX. Compatibility with major browsers should be unaffected.

= 1.3.3 =
* Fix update issue

= 1.3.2 =
* Added support for a tag title attribute via the tag_title="title" shortcode attribute.

= 1.3.1 =
* Fixed issue with additional space being added after email address. (Thanks to omdaddi)

= 1.3 =
* Fixed compatibility issue with PHP 5.2 (5.3 is still recommended)
* Fixed a bug that made use_htmlentities setting not work. 

= 1.2 =
* Minor documentation fixes

= 1.1 =
* Changed Plugin URI to the plugin page at Wordpress.org

= 1.0 =
* Initial release

== Upgrade Notice ==
= 1.0 =
Initial release

== TODO ==
* Better noscript_fallback. Enable people without JavaScript to see the email address using technique to inject empty spans via css.
(Example: bob@<span style="display:none">randomtext</span>company.com
Reference: http://wordpress.org/extend/plugins/obfuscate-email/other_notes/