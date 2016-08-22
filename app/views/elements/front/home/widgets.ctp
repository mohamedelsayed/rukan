<?php if(!empty($widgets)){
    foreach ($widgets as $key => $widget) {
        $data = $widget['Widget'];
        /*if($data['id'] == 1){?>                
            <div class="slider">
                <img style="width:100%;" src="<?php echo $base_url.'/img/upload/'.$data['image'];?>"/>
            </div>
            <div class="wrie_pic">
                <?php $body = $this->element('front'.DS.'view_string_according_lang', array('str_en' => $data['body'], 'str_ar' => $data['body_ar']));
                echo $this->element('front'.DS.'remove_unneeded_tags_from_string', array('string' => $body));?>            
                <?php /*<img src="<?php echo $base_url.'/img/front/arrow.png';?>"/>*?>
            </div>
        <?php }else*/if($data['id'] == 2){?>
            <div class="write_top">                
                <?php $title = $this->element('front'.DS.'view_string_according_lang', array('str_en' => $data['title'], 'str_ar' => $data['title_ar']));
                echo strtoupper($title);?>
            </div>
            <div class="top_wriew">
               <?php $body = $this->element('front'.DS.'view_string_according_lang', array('str_en' => $data['body'], 'str_ar' => $data['body_ar']));
                echo $this->element('front'.DS.'remove_unneeded_tags_from_string', array('string' => $body));?>            
            </div>
            <div class="border_write">
                <img src="<?php echo $base_url.'/img/front/border.jpg';?>" />
            </div>
        <?php }?>
    <?php }?>
<?php }?>