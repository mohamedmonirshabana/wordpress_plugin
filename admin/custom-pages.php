<?php 

add_action('admin_menu',function(){
    add_menu_page(
        __('WP Course Options', 'wpcourse'),
        __('Options', 'wpcourse'),
        'manage_options',
        'wpc_options',
        'wpc_social_media_options',
        'dashicons-admin-generic',
    );
});