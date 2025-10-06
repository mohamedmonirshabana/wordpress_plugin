<?php 

if(!function_exists('wpc_add_metaboxes')){
    function wpc_add_metaboxes(){
        add_meta_box(
            'wpc_ad_url_metabox',
            __('Ad URL', 'wpcourse'),
            'wpc_ad_url_html',
            'wpc_ad',
            'normal',
            'default'
        );
    }
    add_action('add_meta_boxes', 'wpc_add_metaboxes');

}

function wpc_ad_url_html($post){
    $ad_url = get_post_meta($post->ID, 'wpc_ad_url', true);
    ?>
    <p>
        <label for="wpc_ad_url"><?php _e('Type URL', 'wpcourse'); ?></label>
        <input type="text" name="wpc_ad_url" id="wpc_ad_url" value="<?php echo esc_url($ad_url); ?>">
    </p>
    <?php
}

if(!function_exists('wpc_on_save_post')){
    function wpc_on_save_post($post_id, $post, $update){
        if(isset($_POST['wpc_ad_url'])){
            update_post_meta($post_id, 'wpc_ad_url', esc_url_raw($_POST['wpc_ad_url']));
        }
    }
    add_Action('save_post_wpc_ad', 'wpc_on_save_post',10,3);
}