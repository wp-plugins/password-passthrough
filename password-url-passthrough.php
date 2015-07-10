<?php
/*
Plugin Name: Password URL Pass-through
Description: This plugin allows passwords for password-protected pages/posts to be passed directly through the URL. The query string parameter that should contain the password is <strong>pw</strong>. For example, if the URL of your post is <strong>http://myblog.com/password-protected-page/</strong> and the password is <strong>PASSWORD</strong>, then just append <strong>?pw=PASSWORD</strong> to it. If the URL already contains a query string (for example, <strong>http://myblog.com/?p=5</strong>), then be sure to append <strong>&pw=PASSWORD</strong> instead.
Version:     1.0
Author:      Andres Villarreal
Author URI:  http://andres.villarreal.co.cr
License: GPLv3 or later
 */

/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

defined( 'ABSPATH' ) or die();

// plugin functionality
add_action( 'init', function () {
    if ( isset($_GET['pw']) ) {
        $_COOKIE['wp-postpass_' . COOKIEHASH] = wp_hash_password( $_GET['pw'] );
    }
});

// making documentation for administrator more readable
add_filter('admin_head', function () {
    print <<<HTML
    <script type='text/javascript'>
        jQuery(function () {
            jQuery('#password-url-pass-through .plugin-description p').html(
                'This plugin allows passwords for password-protected pages/posts to be passed directly through the URL. ' +
                'The query string parameter that should contain the password is <code>pw</code>.<br><br> ' +
                'For example, if the URL of your post is <code>http://myblog.com/password-protected-page/</code> and  ' +
                'the password is <strong>PASSWORD</strong>, then just append <code>?pw=<strong>PASSWORD</strong></code> to it.<br><br>  ' +
                'If the URL already contains a query string (for example, <code>http://myblog.com/?p=5</code>),  ' +
                'then be sure to append <code>&pw=<strong>PASSWORD</strong></code> instead.');
        });
    </script>
HTML;
});
