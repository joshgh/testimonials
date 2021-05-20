<?php
/**
 * Plugin Name: Testimonials
 * Plugin URI: https://github.com/joshgh/testimonials
 * Description: This is an updated version of Woothemes Testimonials, for compatibility with current WP and PHP versions. Hi, I'm your testimonials management plugin for WordPress. Show off what your customers or website users are saying about your business and how great they say you are, using our shortcode, widget or template tag.
 * Author: WooThemes
 * Version: 1.5.6
 * Author URI: http://woothemes.com/
 * Text Domain: testimonials-by-woothemes
 *
 * @package WordPress
 * @subpackage Woothemes_Testimonials
 * @author Matty
 * @since 1.0.0
 */

require_once( 'classes/class-woothemes-testimonials.php' );
require_once( 'classes/class-woothemes-testimonials-taxonomy.php' );
require_once( 'woothemes-testimonials-template.php' );
require_once( 'classes/class-woothemes-widget-testimonials.php' );
global $woothemes_testimonials;
$woothemes_testimonials = new Woothemes_Testimonials( __FILE__ );
$woothemes_testimonials->version = '1.5.6';

function testimonials_disable_auto_update ( $update, $item ) {
    // Array of plugin slugs to always auto-update
    $plugins = array (
        'testimonials',
    );
    if ( in_array( $item->slug, $plugins ) ) {
         // Never update plugins in this array
        return false;
    } else {
        // Else, use the normal API response to decide whether to update or not
        return $update;
    }
}

function testimonials_remove_update_notification($value) {
     unset($value->response[ plugin_basename(__FILE__) ]);
     return $value;
} 

add_filter( 'auto_update_plugin', 'testimonials_disable_auto_update', 10, 2 );
add_filter('site_transient_update_plugins', 'testimonials_remove_update_notification');