<?php

namespace taskplugin;

/**
 * Plugin Name:       Tasks Plugin
 * Plugin URI:        https://example.com/firstplugin
 * Description:       Plugin for displaying custom adds on pages
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Milan Malla
 * Author URI:        https://example.com
 * Text Domain:       firstplugin
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

class TaskPlugin {
    function __construct() {
        if( !defined( 'TASK_PLUGIN_DIR_PATH' ) ) {
            define( 'TASK_PLUGIN_PATH' , plugin_dir_path( __FILE__ ) );
        }

        if( !defined( 'TASK_PLUGIN_URL' ) ) {
            define( 'TASK_PLUGIN_URL' , plugin_dir_url( __FILE__ ) );
        }

        if( !defined( 'TASK_PLUGIN_FILE' ) ) {
            define( 'TASK_PLUGIN_FILE' ,  __FILE__ );
        }
    }

    public static function initialize () {
        return true;
    } 
}

$GLOBALS['task'] = TaskPlugin::initialize();
