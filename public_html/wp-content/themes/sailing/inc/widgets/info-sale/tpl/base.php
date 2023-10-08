
<?php
$list_items = $instance['info-sale'];
?>

<div class="info-sale-swapper base">
    <?php
    if($list_items){
        foreach( $list_items as $item){
            if(isset($item['image']['id'])){
                $img_id = $item['image']['id'];
            }else{
                $img_id = $item['image'];
            }
    ?>
        <div class="item">
            <div class="thumb">
                <?php
                    $img_url = ''; 
                    $img_url = wp_get_attachment_image_url($img_id,array(570,380));

                ?>
                <img src="<?php echo esc_url($img_url) ?>" alt="<?php esc_html__('IMG','sailing') ?>">
            </div>
            <div class="item-content">
                <p class="second-title"><?php echo esc_html($item['second_title']) ?></p>
                <h3 class="primary-title"><?php echo esc_html($item['primary_title']) ?></h3>
                <?php 
                    if(!empty($item['link']) && !empty($item['text_link'])){
                ?>
                    <a class="link" href="<?php echo esc_url($item['link']) ?>"><?php echo esc_html($item['text_link']) ?></a>
                <?php } ?>    
            </div>
        </div>
    <?php } } ?>
</div>