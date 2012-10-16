<?php

/**
 * Plugin Name: zM Social Media
 * Plugin URI: --
 * Description: Adds functions for social media
 * Version: 1.0.0
 * Author: Zane M. Kolnik
 * Author URI: http://zanematthew.com/
 * License: GP
 */

define( 'ZM_SOCIAL_VERSION', '1' );
define( 'ZM_SOCIAL_OPTION', 'zm_social_version' );

require_once 'functions.php';

/**
 * Add the version number to the options table when
 * the plugin is installed.
 *
 * @note Our version number is used in Themes to check
 * if the plugin is installed!
 */
function zm_social_activation() {

    if ( get_option( ZM_SOCIAL_OPTION ) &&
         get_option( ZM_SOCIAL_OPTION ) > ZM_SOCIAL_VERSION )
        return;

    update_option( ZM_SOCIAL_OPTION, ZM_SOCIAL_VERSION );
}
register_activation_hook( __FILE__, 'zm_social_activation' );


/**
 * Delete our version number from the database
 */
function zm_social_deactivation(){
    delete_option( ZM_SOCIAL_OPTION );
}
register_deactivation_hook( __FILE__, 'zm_social_deactivation' );