<?php 

if(!function_exists('wpc_manage_post_ad_columns')){
    function wpc_manage_post_ad_columns($columns)
    {
        $columns['wpc_views_column'] = __('Views', 'wpcourse');
        if(current_Theme_supports('post-thumbnails')){
            $columns['wpc_thumbnail_column'] = __('Thumbnail','wpcourse');
        }
        if(array_key_exists('author', $columns)){
            unset($columns['author']);
        }
        return $columns;
    }
    add_filter('manage_post_posts_columns','wpc_manage_post_ad_columns');
    add_filter('manage_wpc_ad_posts_columns','wpc_manage_post_ad_columns');
}

if(!function_exists('wpc_set_post_ad_column_content')){
    function wpc_set_post_ad_column_content($column, $post_id)
    {
        switch($column){
            case 'wpc_views_column':
                echo ((int)(get_post_meta($post_id, 'wpc_post_views', true)));
                break;
            case 'wpc_thumbnail_column':
                echo get_the_post_thumbnail($post_id, [100,100]);
                break;
        }
    }
    add_filter('manage_post_posts_custom_column', 'wpc_set_post_ad_column_content',10, 2);
    add_filter('manage_wpc_ad_posts_custom_column', 'wpc_set_post_ad_column_content', 10 , 2);
}

if(!function_exists('wpc_set_post_ad_sortable_columns')){
    function wpc_set_post_ad_sortable_columns($columns)
    {
        $columns['wpc_views_column'] = 'post_views';
        return $columns;
    }
    add_filter('manage_edit-post_sortable_columns','wpc_set_post_ad_sortable_columns');
    add_filter('manage_edit-wpc_ad_sortable_columns','wpc_set_post_ad_sortable_columns');
}