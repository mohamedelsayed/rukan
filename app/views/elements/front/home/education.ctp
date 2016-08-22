<?php if(!empty($education_cat)){?>
    <div class="write_top"><?php echo strtoupper($education_cat['Cat']['title']);?></div>
    <div class="menu-outer">
        <div class="table">    
        <ul class="tabs">
            <?php $i = 0;            
            foreach ($education_cat['ChildCat'] as $key => $item) {
                $class = '';
                if($i == 0){
                    $class = ' current';
                }?>
                <li class="tab-link <?php echo $class;?>" data-tab="tab-<?php echo $key;?>">
                    <?php echo ucfirst($item['title']);?>
                </li>
            <?php $i++; }?>
        </ul>
    </div>
    </div>
    <?php $i = 0;
    $cat_id = $education_cat['Cat']['id'];
    foreach ($education_cat['ChildCat'] as $key => $item){
        $max_height = 'max-height:100%;';
        $max_width  = 'max-width:100%;';
        $style = $max_width;
        $class = '';
        if($i == 0){
            $class = ' current';
        }
        $image = $base_url.'/img/front/default_image.jpg';
        $div_ratio = 251/175;                    
        $image_path = WWW_ROOT.'img'.DS.'upload'.DS.$item['image'];            
        if(file_exists($image_path) && is_file($image_path)){
            $resize->smartResizeImage($item['image']);
            $image = $base_url.'/img/upload/'.$item['image'];
            $image_size = getimagesize($image_path);                                  
            if(!empty($image_size)){
                $width = $image_size[0];
                $height = $image_size[1];                      
                $image_ratio = $width/$height;
                if($image_ratio > $div_ratio){                  
                    $style = $max_height;
                }
            }
        }
        $item_link = $base_url.'/page/show/'.$cat_id.'/'.$item['id'];
        $body = $item['body'];
        //$body = $this->element('front'.DS.'remove_unneeded_tags_from_string', array('string' => $item['body']));
        $body = $this->element('front'.DS.'string_format_view', array('str' => $body, 'val' => 38, 'type' => 'wordsCut'));?>
        <div id="tab-<?php echo $key;?>" class="tab-content <?php echo $class;?>">
            <div class="tab-content_top">
                <div class="top_con">
                    <?php /*<div class="top_con_3">May 21, 2015</div>*/?>
                    <div class="top_con_iddle"><?php echo $item['title'];?></div>
                    <div class=" img_academic">
                        <?php if($image != ''){?>
                            <a href="<?php echo $item_link;?>">
                                <img style="<?php echo $style;?>" src="<?php echo $image;?>"/>
                            </a>
                        <?php }?>
                    </div>
                    <div class="bot_school"><?php echo str_replace('&nbsp;', '', trim($body));?></div>
                    <a class="bott_more" href="<?php echo $item_link;?>"><?php echo __('More', true);?> ></a>
                    <?php /*<a class="bottow_read" href="#">Read More</a>*/?>
                </div>
            </div>
        </div>
    <?php $i++; }?>
    <div class="border_write">
        <img src="<?php echo $base_url.'/img/front/';?>border.jpg"/>
    </div>
<?php }?>