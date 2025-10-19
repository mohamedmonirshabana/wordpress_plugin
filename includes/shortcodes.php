<?php 

add_shortcode('wpc_ad', function(){
    $ads = get_posts([
        'post_type' => ['wpc_ad'],
        'numberposts' => 1,
        'orderby' =>  'rand',
    ]);
    if(count($ads)){
        $result = '<div class="d-flex mt-5 mb-5">';
        $result .= '<div class="ad-thumbnail">' .get_the_post_thumbnail($ads[0]->ID, [110, 110]) .'</div>';
        $result .= '<div class="ad-info">';
        $result .= '<h6 class="mb-1 ">'.$ads[0]->post_title.'</h6>';
        $result .= '<p class="mb-1">'.$ads[0]->post_excerpt.'</p>';
        $link = get_post_permalink($ads[0]->ID,'wpc_ad_url', true);
        if($link){
            $result .= '<p class="mb-0"><a href="'.esc_url($link).'">'.__('Learn More', 'wpcourse').'</a></p>';
        }
        $result .= '</div>';
        $result .= '</div>';
        return $result;
    }
});