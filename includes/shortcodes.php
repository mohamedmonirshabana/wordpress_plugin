<?php 

add_shortcode('wpc_ad', function(){
    $ads = get_posts([
        'post_type' => ['wpc_ad'],
        'numberposts' => 1,
        'orderby' =>  'rand',
    ]);
    if(count($ads)){
        $result = '<div class="d-flex">';
        $result .= '<div class="ad-thumbnail">' .get_the_post_thumbnail($ads[0]->ID, [110, 110]) .'</div>';
        $result .= '<div class="ad-info">';
        $result .= '<h6>'.$ads[0]->post_title.'</h6>';
        $result .= '<p>'.$ads[0]->post_excerpt.'</p>';
        $result .= '</div>';
        $result .= '</div>';
        return $result;
    }
});