<?php if(!empty($articles)){?>
    <div class="write_top"><?php echo __('LATEST NEWS', true);?></div>
    <div class="home_latest_news">
        <a class="jcarousel-prev"></a>
        <div class="jcarousel-wrapper">
            <div id="jcarousel" class="jcarousel">
                <ul>
                    <?php foreach ($articles as $key => $article) {
                        $image = '';
                        $div_ratio = 251/175;
                        if(isset($article['Gal'])){
                            $resize->smartResizeImage($article['Gal'][0]['image']);
                            $image = $base_url.'/img/upload/'.$article['Gal'][0]['image'];
                            $image_path = WWW_ROOT.'img'.DS.'upload'.DS.$article['Gal'][0]['image'];                                 
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
                        $article_link = $base_url.'/article/item/'.$article['Article']['id'];?>
                        <li>
                            <div class="top_con">
                                <div class="top_con_3">
                                    <?php echo $this->element('front'.DS.'english_date_view', array('date' => $article['Article']['date']));?>
                                </div>
                                <div class="top_con_iddle">
                                    <a href="<?php echo $article_link;?>">
                                        <?php echo $this->element('front'.DS.'view_string_according_lang', array('str_en' => $article['Article']['title'], 'str_ar' => $article['Article']['title_ar']));?>
                                    </a>
                                </div>
                                <?php if($image != ''){?>
                                    <div class="img_home" style="width: 251px;">
                                        <a href="<?php echo $article_link;?>">
                                            <img style="<?php echo $style;?>" src="<?php echo $image;?>"/>
                                        </a>
                                    </div>
                                <?php }?>
                                <div class="bot_school">
                                    <?php $body = $this->element('front'.DS.'view_string_according_lang', array('str_en' => $article['Article']['body'], 'str_ar' => $article['Article']['body_ar']));?>
                                    <?php //$body = $this->element('front'.DS.'remove_unneeded_tags_from_string', array('string' => $body));
                                    $body = $this->element('front'.DS.'string_format_view', array('str' => $body, 'val' => 27, 'type' => 'wordsCut'));
                                    echo $body;?>                                    
                                </div>
                                <a class="bott_more" href="<?php echo $article_link;?>"><?php echo __('More', true);?> ></a>
                            </div>
                        </li>
                    <?php }?>
                </ul>        
            </div>
        </div>
        <a class="jcarousel-next"></a>    
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#jcarousel').jcarousel({
            animation: 'slow',
            duration: 800,
            easing:   'linear',
            wrap: 'circular',
        });
        $('.jcarousel-prev').click(function() {
            $('#jcarousel').jcarousel('scroll', '-=1');
        });            
        $('.jcarousel-next').click(function() {
            $('#jcarousel').jcarousel('scroll', '+=1');
        });
        setInterval("$('#jcarousel').jcarousel('scroll', '+=1')", 15000)
    });
    </script>
    <div class="border_write">
        <img src="<?php echo $base_url.'/img/front/';?>border.jpg"/>
    </div>
<?php }?>