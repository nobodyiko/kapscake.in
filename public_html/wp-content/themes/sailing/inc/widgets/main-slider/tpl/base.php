<?php
// $bg_img           = wp_get_attachment_image_src( $instance['background_img'], 'full' );
// $title_background = $instance['background-title'];
// $link_post_video  = $instance['external_video'];
$title = $instance['title'];
$desc = $instance['desc'];
$text_link = $instance['text_link'];
$link = $instance['link'];
if ( !is_array( $instance['background_img'] ) ) {
    $background_images = explode( ",", $instance['background_img'] );
} else {
    $background_images = $instance['background_img'];
}
if($instance['enable_autoplay'] =='yes' || $instance['enable_autoplay'] == true){
    $enable_autoplay = 1;
    
}else{
    $enable_autoplay = 0;
}
$autoplay_speed = isset($instance['autoplay_speed']) ? $instance['autoplay_speed'] : 3000;
?>
<div class="element-main-slider">
    <div class="wrap-element" data-autoplay="<?php echo esc_attr($enable_autoplay) ?>" data-speed="<?php echo esc_attr($autoplay_speed) ?>">
    <?php if(!empty($background_images)){
        
        foreach($background_images as $bg_image){
           
            if(!empty($bg_image['id'])){
                    $image_id = $bg_image['id'];
            }else{
                    $image_id = $bg_image;
            }
           
    ?>    
            <div class="inner-banner" style="background-image: url('<?php echo wp_get_attachment_image_url( $image_id,'full' ) ?>');">
                <div class="gradien"></div>
            </div>      
    <?php }
    }
    ?>
    </div>
    <div class="content-title container">
        <p class="title">
            <?php echo ent2ncr($title)?>
        </p>
        <p class="des">
            <?php echo esc_html($desc)?>
        </p>
        <?php if(!empty($text_link) && !empty($text_link)){?>
            <div class="link-swapper">
                <a class="link" href="<?php echo esc_url($link) ?>"><?php echo esc_html($text_link) ?></a>
            </div>
        <?php } ?>
    </div> 
</div>   

