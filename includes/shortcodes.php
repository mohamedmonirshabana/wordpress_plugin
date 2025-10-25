<?php 

add_shortcode('wpc_colored_area', function($attributes, $content){
    $defaults= ['color' => '#fff'];
    $attributes =  shortcode_atts($defaults, $attributes);
    return '<div style="background-color:'.esc_attr($attributes['color']).';">'.do_shortcode($content).'</div>';
});

add_shortcode('wpc_ad', function($attributes){
    if(!array_key_exists('id',$attributes)){
        return;
    }
    $ads = get_posts([
        'p' => $attributes['id'],
        'post_type' => ['wpc_ad'],
        // 'numberposts' => 1,
        // 'orderby' =>  'rand',
    ]);
    if(count($ads)){
        if(array_key_exists('days', $attributes)){
            $difference = (int)abs((current_time('U') - strtotime($ads[0]->post_date)));
            if($difference > ((int)($attributes['days'])*86400)){
                return;
            }
        }
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

if(!function_exists('wpc_masonry_section')){
    function wpc_masonry_section($attributes, $content, $tag){
        return '<div class="'.$tag.'-side">'. do_shortcode($content) . '</div>';
    }
    add_shortcode('left', 'wpc_masonry_section');
    add_shortcode('center', 'wpc_masonry_section');
    add_shortcode('right', 'wpc_masonry_section');
}

add_shortcode('post', function($attributes){
    $defaults = ['order' => 1];
    $attributes = shortcode_atts($defaults, $attributes);
    $masonry_post = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => 1,
        'offset' => $attributes['order'] -1 
    ]);
    $extra_classes = '';
    switch($attributes['order']){
        case '1':
        case '5':
            $thumbnail_size = '534x468';
            break;
        case '2':
            $thumbnail_size = '533x261';
            break;
        default:
            $thumbnail_size = '400x299';
            $extra_classes = 'small-box';
    }
    if($masonry_post->have_posts()){
        while($masonry_post->have_posts()){
            $masonry_post->the_post();
            $categories = get_the_category();
            $post_categories = (!empty($categories)) ? '<span class="bg-'.wpc_get_term_color($categories[0]->term_id).'"><a href="'.get_term_link($categories[0]).'" title="">'.$categories[0]->name.'</a></span>':'';
            return '
            <div class="masonry-box post-media '.$extra_classes.'">
                    <img src="'.get_the_post_thumbnail_url(null, $thumbnail_size).'" alt="" class="img-fluid">
                    <div class="shadoweffect">
                    <div class="shadow-desc">
                        <div class="blog-meta">
                            '.$post_categories.'
                            <h4><a href="'.get_permalink().'" title="">'.get_the_title().'</a></h4>
                            <small><a href="'.get_permalink().'" title="">'.get_the_date('d M, Y').'</a></small>
                            <small>'.get_the_author_link().'</small>
                        </div><!-- end meta -->
                    </div><!-- end shadow-desc -->
                </div><!-- end shadow -->
            </div><!-- end post-media -->
            ';
        }
    }
    
});