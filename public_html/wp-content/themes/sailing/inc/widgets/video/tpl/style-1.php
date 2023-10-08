
<?php
wp_enqueue_script('magnific-popup');
$bg_img           = wp_get_attachment_image_url( $instance['self_poster'], 'full' );

$logo_img = wp_get_attachment_image_url( $instance['logo'], 'full' );
$title_background = $instance['background-title'];
$link_post_video  = $instance['external_video'];
$title = $instance['title'];
?>
<div class="thim-sc-video-box style-1">
    <div class="bg-image">
        <?php if( !empty($bg_img)){ ?>
            <img src="<?php echo esc_url($bg_img) ?>" alt="<?php echo esc_html__('IMG','sailing') ?>">                
        <?php } ?>
    </div>
    <h2 class="bg-title">
        <?php if( !empty($logo_img)){ ?>
            <img src="<?php echo esc_url($logo_img) ?>" alt="<?php echo esc_html__('IMG','sailing') ?>">                
        <?php } ?>
    </h2>
    <div class=" container  button-title-swapper">
        <div class="button-title">
            <div class="title-link">
                <?php echo esc_html($title) ?>
                <i class="las la-play"></i>
            </div>
            <a class="video-popup" href="<?php echo esc_url($link_post_video) ?>">
                <i class="las la-play-circle"></i>
            </a>
        </div>
    </div>
</div>