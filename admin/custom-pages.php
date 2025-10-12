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

if(!function_exists('wpc_social_media_options')){
    function wpc_social_media_options()
    {
        $networks = ['facebook', 'flickr' ,'instagram','pintrest', 'twitter', 'youtube'];
        ?>
        <div class="wrap">
            <h1><?php _e('Social Media Links', 'wpcourse'); ?></h1>
            <form action="" method="post">
                <table class="form-table">
                    <?php
                        foreach($networks as $network){
                            ?>
                                <tr>
                                    <th><?php _e(ucfirst($network), 'wpcourse'); ?></th>
                                    <td>
                                        <input type="url" name="<?php echo esc_attr('wpc_'.$network .'_link'); ?>" id="">
                                    </td>
                                </tr>
                            <?php
                        } 
                    ?>
                </table>
                <p class="submit">
                    <input type="submit" value="<?php echo esc_attr(__('Save Social Links', 'wpcourse'))  ?>" class="button button-primary">
                </p>
            </form>
        </div>
        <?php
    }
}