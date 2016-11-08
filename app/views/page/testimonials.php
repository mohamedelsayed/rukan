<?php if(isset($testimonials_data) && !empty($testimonials_data)){?>
    <?php foreach ($testimonials_data as $key => $value) {
        $image = '';
        $div_ratio = 180/180;
        if(trim($value['Testimonial']['image']) != ''){
            $image = $base_url.'/img/upload/'.$value['Testimonial']['image'];
            $image_path = WWW_ROOT.'img'.DS.'upload'.DS.$value['Testimonial']['image'];                    
            $max_height = 'max-height:100%;';
            $max_width  = 'max-width:100%;';
            $style = $max_width;
			$image_size = array();
			if(file_exists($image_path)){   
            	$image_size = getimagesize($image_path);          
			}else{
				$image = DEFAULT_IMAGE;
				$style = 'width:100%;';
			} 
            if(!empty($image_size)){
                $width = $image_size[0];
                $height = $image_size[1];   
                $image_ratio = $width/$height;
                if($image_ratio > $div_ratio){                  
                    $style = $max_height;
                }
            }
        }
        $body = $this->element('front'.DS.'remove_unneeded_tags_from_string', array('string' => $value['Testimonial']['body']));?>
        <div class="grob_testimonials">
            <div class="img_testimonials" style="overflow: hidden; width: 180px;height: 180px;margin-right: 30px;border-radius: 90px;">
                <a><img style="<?php echo $style;?>" src="<?php echo $image;?>"/></a>
            </div>
            <div class="adders_testimonials"><?php echo $value['Testimonial']['name'];?></div>
            <div class="adders_testimonials_smill"><?php echo $body;?></div>
        </div>
    <?php }?>   
    <div class="members_margin_div"></div> 
<?php }?>