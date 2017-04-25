<?php
/*
 * 
 * view.hero-takeover.php
 *  
 * 
 */

$hero_takeover_related     = new HeroTakeover('hero-takeover-related');

?>
<?php if ($has_posts): 

        //Get permalink for zone article / content
        $str_url = str_replace(home_url(), '', get_permalink());
        $str_url = trim ( $str_url ,'/' );

?>
<style>
.takeover-img-background {
    background-image: url("<?php echo $featured_image_url; ?>");
}
</style>
<div id="takeover-container" class="container-fluid col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xlg-12 hero-takeover-container ">
    
    <?php //closed bar ?>
    <div class="takeover-closed col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xlg-12 hidden">

        <a href="<?php echo $str_url; ?>"><?php  echo $title_two_words; ?></a>

        <span class="chevron-down">
            <img src="<?php echo get_template_directory_uri(); ?>/images/chevron_icon.png">
        </span>
    </div>
    
    <?php //opened takeover ?>
    <div class="takeover-open">
        
        <span class="x-close">
            <img src="<?php echo get_template_directory_uri(); ?>/images/close_icon.png">
        </span>

        <img class="img-responsive takeover-img-xs hidden-sm hidden-md hidden-lg hidden-xlg" src="<?php echo $featured_image_url; ?>" />

        <div class="lg-hero-takeover-spacer col-lg-8"></div>

        <div class="hero-takeover-background col-lg-4">

            <div class="takeover-content col-xs-12 col-sm-6 col-lg-12 no-padding-left no-padding-right">
                <div class="takeover-main-title">
                    <div class="title">
                        <a href="<?php echo get_permalink(); ?>"><?php echo $title; ?></a>
                    </div>
                    <div class="takeover-intro hidden-xs">

                        <?php echo get_the_excerpt( ); ?>

                    </div> 
                    <div class="full-article">
                        <a href="<?php echo get_permalink(); ?>">Full article</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-12 hero-article-container">
                <?php $hero_takeover_related->display_related('hero-takeover-related'); ?>
            </div>

        </div>

    </div>
    
</div>
<?php endif; ?>

<script>
jQuery(document).ready(function($){
    
    <?php //When takeover background image in is clicked, go to article ?>
    $('#takeover-container').on("click", function (e) {
      e.preventDefault();
      window.location.href = "<?php echo $str_url; ?>";
    });
    
    <?php //Make content div non-clickable because the BG is clickable ?>
    $(".article-title").click(function(event){
        event.stopPropagation();
    });
    
    <?php //Make content div non-clickable because the BG is clickable ?>
    $(".takeover-content").click(function(event){
        event.stopPropagation();
    });
    
    <?php //Make content div non-clickable because the BG is clickable ?>
    $(".takeover-closed").click(function(event){
        event.stopPropagation();
    });
    
    <?php //When takeover image in mobile is clicked, go to article ?>
    $('.takeover-img-xs').on("click", function (e) {
        e.preventDefault();
        window.location.href = "<?php echo $str_url; ?>";
    });
    
    var container = $("#takeover-container");
    
    //if the window width is GT than the maxWidth
    if(window.snBreakpointWatcher.breakPoint() >= SN.SCREEN_SM) {
        //Add the class to set the bg image         
        container.addClass("takeover-img-background");
    } 
    
    //Clicking on X glyph to minimise the takeover
    $( ".x-close" ).click(function() {
        $( ".takeover-closed" ).removeClass( "hidden" );
        $( ".takeover-open" ).addClass( "hidden" ); 
        container.removeClass("takeover-img-background");
        container.addClass( "hero-takeover-no-top-padding" );
        container.removeClass( "hero-takeover-top-padding" );
        event.stopPropagation();
    });
    
    //Clicking on chevron glyph to maximise the takeover
    $( ".chevron-down" ).click(function() {
        $( ".takeover-open" ).removeClass( "hidden" );
        $( ".takeover-closed" ).addClass( "hidden" );
        container.addClass("takeover-img-background");

        if( container.hasClass("hero-takeover-no-top-padding") ) {
            container.addClass( "hero-takeover-top-padding" ); 
            container.removeClass( "hero-takeover-no-top-padding" );
        }
        event.stopPropagation();
    });
    
})
</script>