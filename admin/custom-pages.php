<?php 

add_action('admin_menu',function(){
    add_menu_page(
        __('WP Course Options', 'wpcourse'),
        __('Options', 'wpcourse'),
        'manage_options',
        'wpc_options',
        'wpc_social_media_options',
        'dashicons-admin-generic',
        78
    );
    add_submenu_page(
        'wpc_options',
        __('Social Media', 'wpcourse'),
        __('Social Media', 'wpcourse'),
        'manage_options',
        'wpc_options',
        'wpc_social_media_options',
        1
    );
    add_submenu_page(
        'wpc_options',
        __('Post Options', 'wpcourse'),
        __('Post Options', 'wpcourse'),
        'manage_options',
        'wpc_post_options',
        'wpc_post_options',
        2
    );
});