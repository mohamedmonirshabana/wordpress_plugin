<?php 

if(!function_exists('wpc_manage_post_ad_columns')){
    function wpc_manage_post_ad_columns($columns){
        $columns['wpc_views_column'] = __('Views', 'wpcourse');
        $columns['wpc_thumbnail_column'] = __('Thumbnail','wpcourse');
        return $columns;
    }
    add_filter('manage_post_posts_columns','wpc_manage_post_ad_columns');
    add_filter('manage_wpc_ad_posts_columns','wpc_manage_post_ad_columns');
}