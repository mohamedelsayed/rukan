<?php if(!empty($widgets)){
    foreach ($widgets as $key => $widget) {
        $data = $widget['Widget'];
		$id = $data['id'];		
        /*if($id == 1){?>                
            <div class="slider">
                <img style="width:100%;" src="<?php echo $base_url.'/img/upload/'.$data['image'];?>"/>
            </div>
            <div class="wrie_pic">
                <?php $body = $this->element('front'.DS.'view_string_according_lang', array('str_en' => $data['body'], 'str_ar' => $data['body_ar']));
                echo $this->element('front'.DS.'remove_unneeded_tags_from_string', array('string' => $body));?>            
                <?php /*<img src="<?php echo $base_url.'/img/front/arrow.png';?>"/>*?>
            </div>
        <?php }*/
        if($id == 2 || $id == 3){?>
            <?php /*<div class="write_top">                
                <?php $title = $this->element('front'.DS.'view_string_according_lang', array('str_en' => $data['title'], 'str_ar' => $data['title_ar']));
                echo strtoupper($title);?>
            </div>*/?>
            <div class="home_word_widgets home_word_widgets<?php echo $id;?>">
            	<?php if($id == 3){?>
		        	<div class="home_second_widget_image1"></div>
		        	<div class="home_second_widget_image2"></div>
		        	<div class="home_second_widget_word">
				<?php }?>
				<?php $body = $this->element('front'.DS.'view_string_according_lang', array('str_en' => $data['body'], 'str_ar' => $data['body_ar']));
                echo $this->element('front'.DS.'remove_unneeded_tags_from_string', array('string' => $body));?>            
                <?php if($id == 3){?>
	                </div>
	                <div class="home_second_widget_image3"></div>
				<?php }?>
            </div>
            <?php if($id == 3){?>
	            <div class="line_border"></div>
            <?php }?>
        <?php }?>
    <?php }?>
<?php }?>