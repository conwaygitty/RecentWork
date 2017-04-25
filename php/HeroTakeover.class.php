<?php

class HeroTakeover extends StoriesList {  

    public $current_theme_zone; 
    public $stories_slug; 
    public $header;
    public $is_visible; 
    
    const DEFAULT_NUMBER_OF_POSTS = 1; 
    const DEFAULT_THEME_ZONE_SUFFIX = 'hero-takeover-main';
    
   function get_posts( $num_posts ) {
        $this->stories = array(); 
       
        
        if ( isset( $this->stories_slug ) ) {
            if ( zp_is_zone_visible($this->stories_slug) == false ) {
                return false;
            }

            $this->stories =  zp_get_posts_in_zone( $this->stories_slug, $num_posts ); 

            if ( sizeof( $this->stories ) > 0 ) {
                return true;
            }
        }
        
        return false; 
    }
    
    function display( $view_name ) {
        $html = '';
        
        $has_posts = $this->get_posts($this->numPosts);      

        if ( $has_posts === true ) {

            $story = $this->stories[0];
            
            // Figure out whether a video play icon overlay class is needed.
            $str_video_class = $this->get_video_play_class($story->ID, $story->post_type);
            
            // Get the IMG tag for the thumbnail image for this post (gets the secondary image automatically if needed).
            $thumbnail = $this->get_thumbnail_image($story->ID, $story->post_type);
            
            //Get featured image for article in main takeover zone
            $featured_image_attachment_id = get_post_thumbnail_id($story->ID);
            $featured_image = wp_get_attachment_image_src($featured_image_attachment_id, 'full'); 
            $featured_image_url = $featured_image[0];
            $meta_data = get_post_meta( $story->ID,'sn_url_override',true);        
            setup_postdata( $GLOBALS['post'] =& $story ); // gets template vars ready.
            $title = sn_get_shortened_title($story, "long"); // Uses the "headline" field in the Headlines Meta Box. NOT the same as the_title() / get_the_title()                        
            $title_two_words = sn_get_shortened_title($story, "short");
            
            ob_start();            
            require_once ( get_template_directory() . '/inc/views/hero-takeover/view.hero-takeover.php');
            $html = ob_get_contents();         
            ob_end_clean();     

            wp_reset_postdata();
        }
        
        echo $html;

    }
    
    function display_related( $view_name ) {
        $html = '';
        
        $has_posts = $this->get_posts($this->numPosts);      

        if ( $has_posts === true ) {

            $story = $this->stories[0];
            
            // Get the IMG tag for the thumbnail image for this post (gets the secondary image automatically if needed).
            $thumbnail = $this->get_thumbnail_image($story->ID, $story->post_type);
            $meta_data = get_post_meta( $story->ID,'sn_url_override',true);
            //$author = sn_get_first_coauthor( $story->ID );
            $authors = get_coauthors( $story->ID );
            setup_postdata( $GLOBALS['post'] =& $story ); // gets template vars ready.
            $title = sn_get_shortened_title($story, "long"); // Uses the "headline" field in the Headlines Meta Box. NOT the same as the_title() / get_the_title()             
            
            ob_start();            
            require_once ( get_template_directory() . '/inc/views/hero-takeover/view.hero-takeover-related.php');
            $html = ob_get_contents();         
            ob_end_clean();     

            wp_reset_postdata();
        }
        
        echo $html;
            


    }
    
}