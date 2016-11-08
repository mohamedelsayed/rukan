<?php if(isset($members) && !empty($members)){?>
    <div class="members_margin_div"></div>
    <?php foreach ($members as $key => $value) {
        $image = '';
        $div_ratio = 250/250;
        $max_height = 'max-height:100%;';
        $max_width  = 'max-width:100%;';
        $style = $max_width;
        $thumb_image = '';
        if(trim($value['TeamMember']['image']) != ''){            
            $thumb_image = $base_url.'/img/upload/thumb_'.$value['TeamMember']['image'];
            /*$image = $base_url.'/img/upload/'.$value['TeamMember']['image'];
            $image_path = WWW_ROOT.'img'.DS.'upload'.DS.$value['TeamMember']['image'];    
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
            }*/
        }
        $biography = $this->element('front'.DS.'remove_unneeded_tags_from_string', array('string' => $value['TeamMember']['biography']));?>
        <div class="grob_about" style="margin-top: 20px;margin-bottom: 20px;">
            <div class="img_who" style="overflow: hidden; width: 250px;height: 250px;margin-right: 24px;border-radius: 125px;">
                <a><img style="<?php echo $style;?>" src="<?php echo $thumb_image;?>"/></a>
            </div>
            <div class="adders_about_w"><?php echo $value['TeamMember']['name'];?></div>
            <div class="adders_about_s"><?php echo $value['TeamMember']['position'];?></div>
            <div class="adders_about_smill_w">
                <?php echo $biography;?>
                <?php if($value['TeamMember']['mail'] != ''){?>
                    <div class="who_is_mail">
                        <a href="mailto:<?php echo $value['TeamMember']['mail'];?>">
                            <?php echo $value['TeamMember']['mail'];?>
                        </a>
                    </div>
                <?php }?> 
            </div>                               
        </div>
    <?php }?>
    <div class="members_margin_div"></div>
<?php }?>