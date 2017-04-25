<?php
/*
 * 
 * view.hero-takeover-related.php
 *  
 * 
 */
?>
<?php if ($has_posts): 

    //Get permalink for zone article / content
    $str_url = str_replace(home_url(), '', get_permalink());
    $str_url = trim ( $str_url ,'/' );



?>

    <?php foreach ( $this->stories as $story ) { 

$thumbnail = $this->get_thumbnail_image($story->ID, $story->post_type);
            $meta_data = get_post_meta( $story->ID,'sn_url_override',true);
            //$author = sn_get_first_coauthor( $story->ID );
            $authors = get_coauthors( $story->ID );
            setup_postdata( $GLOBALS['post'] =& $story ); // gets template vars ready.
            $title = sn_get_shortened_title($story, "long"); // Uses the "headline" field in the Headlines Meta Box. NOT the same as the_title() / get_the_title()   
        
            // Determine if the article has an attached video
            $video_icon         = '';
            $bc_attached_videos = bc_get_attached_videos( $story->ID );
            $post_type          = get_post_type( $story->ID );
            $has_video          = !empty( $bc_attached_videos ) || $post_type == 'bc-video' ? true : false;

            if ( $has_video == true ){
                $video_icon = "featured-video-icon";
            }

?>
            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding-left">
                <div class="takeover-sub-article col-xs-12 <?php if ($story === end($this->stories))
        echo 'hero-no-border-bottom';?>">
                    <div class="article-arrow">
                        <a class="<?php echo $video_icon; ?>"></a>
                    </div>
                    <div class="article-title">
                        <a href="<?php echo get_permalink(); ?>"><?php echo $title; ?></a>
                        <div class="article-time-author">
                            <?php echo sn_get_post_time_ago( $story->ID ); ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $authors[0]->display_name; ?>
                        </div>
                    </div>
                </div>
            </div>
    <?php } ?>

<?php endif; ?>