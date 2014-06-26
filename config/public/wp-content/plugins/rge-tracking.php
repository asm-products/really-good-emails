<?php
/**
 * Plugin Name: Really Good Emails Tracking
 * Description: Add tracking to the site via plugins so the theme is not hacked up. This will add the Tracking to every page on the site.
 * Version:1.0
 * Author: Kevin Dees
 * Author URI: http://robojuice.com
 * License: GPL2
 */
 
 /*  Copyright 2014  Kevin Dees

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class rge_tracking {

  function __construct() {
    add_action( 'wp_footer', array($this, 'rge_footer_script') );
  }
 
  function rge_footer_script() { 
    ?><script type="text/javascript"> (function() { window._pa = window._pa || {}; // _pa.orderId = "myOrderId"; // OPTIONAL: attach unique conversion identifier to conversions // _pa.revenue = "19.99"; // OPTIONAL: attach dynamic purchase values to conversions // _pa.productId = "myProductId"; // OPTIONAL: Include product ID for use with dynamic ads var pa = document.createElement('script'); pa.type = 'text/javascript'; pa.async = true; pa.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + "//tag.perfectaudience.com/serve/53ab5d8e36531ac20e00006f.js"; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(pa, s); })(); </script><?php 
  }

}

new rge_tracking();
