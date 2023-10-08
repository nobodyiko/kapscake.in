
<?php
$list_items = $instance['info-sale'];
if(isset($instance['bg_image']['id'])){
    $bg_img_id = $instance['bg_image']['id'];
}else{
    $bg_img_id = $instance['bg_image'];
}
?>

<div class="info-sale-swapper style-1" style="background-image: url('<?php echo wp_get_attachment_image_url( $bg_img_id,'full' ) ?>');">
    <div class="info-sale">
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
                <div class="thumb" style="background-image: url('<?php echo wp_get_attachment_image_url( $img_id,'full' ) ?>');">
                    
                    <div class="item-content">
                        <p class="second-title"><?php echo esc_html($item['second_title']) ?></p>
                        <h3 class="primary-title"><?php echo esc_html($item['primary_title']) ?></h3>
                        <p class ="content"><?php echo esc_html($item['short_content']) ?></p>
                        <?php 
                            if(!empty($item['link']) && !empty($item['text_link'])){
                        ?>
                            <a class="link" href="<?php echo esc_url($item['link']) ?>"><?php echo esc_html($item['text_link']) ?></a>
                        <?php } ?>    
                    </div>
                </div>
                
            </div>
        <?php } } ?>
    </div> 
</div>