<?php if(!empty($albums)){?>
    <div class="write_top"><?php echo __('GALLERY', true);?></div>
    <div class="img_big_bottow">
        <?php $i = 0;
        foreach ($albums as $key => $album) {
            $image = '';
            $div_ratio = 297/233;          
            if(isset($album['Gal'][0]['image'])){
                if($i == 3){
                    break;
                }
                $i++;
                $resize->smartResizeImage($album['Gal'][0]['image']);
                $image = $base_url.'/img/upload/'.$album['Gal'][0]['image'];            
                $image_path = WWW_ROOT.'img'.DS.'upload'.DS.$album['Gal'][0]['image']; 				
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
                $album_link = $base_url.'/gallery/item/'.$album['Album']['id'];?>                        
                <div class="img_bottow">
                    <a href="<?php echo $album_link;?>">
                        <img style="<?php echo $style;?>" src="<?php echo $image;?>"/>
                    </a>
                    <div class="img_bottow_write">
                        <div style="opacity:0.99;">
                            <?php echo $this->element('front'.DS.'view_string_according_lang', array('str_en' => $album['Album']['title'], 'str_ar' => $album['Album']['title']));?>
                        </div>
                    </div>
                </div>
            <?php }?>
        <?php }?>
    </div>
    <div class="border_write">
        <img src="<?php echo $base_url.'/img/front/';?>border.jpg"/>
    </div>
<?php }?>