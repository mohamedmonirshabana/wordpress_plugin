<?php 

/**
 * Plugin Name: WP Course
 * Plugin URI: https://itcodx.com/plugin
 * Description: test Plugin for my Test 
 * Version: 1.0.0
 * Requires at least: 2.9
 * Requires PHP: 5.6
 * Author: Mohamed Monir
 * Author URI: https://itcodx.com/founder
 * License: GPL  V2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wpcourse
 * Domain Path: /languages
 */

if(!function_exists('wpc_load_wpcourse_translation')){
    function wpc_load_wpcourse_translation(){
        load_plugin_textdomain('wpcourse', false, basename(dirname(__FILE__)).'/languages/');
    }
    add_Action('plugin_loaded','wpc_load_wpcourse_translation');
}
if(!function_exists('wpc_on_activate_plugin')){
    function wpc_on_activate_plugin(){
        wpc_add_roles();
        wpc_register_post_types();
        wpc_register_taxonomies();
        flush_rewrite_rules();
        wpc_create_db_tables();
    }
    register_Activation_hook(__FILE__,'wpc_on_activate_plugin');
}

if(!function_exists('wpc_on_deactivate_plugin')){
    function wpc_on_deactivate_plugin(){
        remove_role('company');
    }
    register_deactivation_hook(__FILE__,'wpc_on_deactivate_plugin');
}

if(!function_exists('wpc_on_uninstall_plugin')){
    function wpc_on_uninstall_plugin(){
        global $wpdb;
        $table_query = 'Drop TABLE IF EXISTS '.$wpdb->prefix . 'subscribers';
        $wpdb->query($table_query);
        
    }
    register_uninstall_hook(__FILE__,'wpc_on_uninstall_plugin');
}

require plugin_dir_path(__FILE__) . 'includes/index.php';
require plugin_dir_path(__FILE__). 'admin/index.php';