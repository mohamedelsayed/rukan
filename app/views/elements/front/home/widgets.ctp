<?php if(!empty($widgets)){
    foreach ($widgets as $key => $widget) {
        $data = $widget['Widget'];
		$id = $data['id'];		
        if($id == 3){?>
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
        <?php if($id == 4){?>
        	<div class="home_widget_fourth">  
	        	<div class="home_widget_fourth_title">                
	                <?php $title = $this->element('front'.DS.'view_string_according_lang', array('str_en' => $data['title'], 'str_ar' => $data['title_ar']));
	                echo strtoupper($title);?>
	            </div>
	            <div class="home_widget_fourth_body"> 
		            <?php if(isset($values_data) && !empty($values_data)){?>
					    <?php $i = 0;
					    foreach ($values_data as $key => $value) {
					        $image = '';		        
					        $i++;
					        if(isset($value['Value'])){
					            $image = $base_url.'/img/upload/'.$value['Value']['image'];
					        }?>
					        <div class="home_widget_value" >
					            <div class="home_widget_value_image">
					            	<a>
					                    <img src="<?php echo $image;?>"/>
					                </a>
					            </div>
					            <div class="home_widget_value_title">
					            	<?php echo $value['Value']['title'];?>
				            	</div>
					            <?php /*<div class="adders_about_smill2">
					                <?php $body = $this->element('front'.DS.'remove_unneeded_tags_from_string', array('string' => $value['Value']['body']));
					                $body = $this->element('front'.DS.'string_format_view', array('str' => $body, 'val' => 100, 'type' => 'wordsCut'));
					                echo $body;?>
					            </div>*/?>
					        </div>
					    <?php }?>
					<?php }?>  
				</div>
			</div>
			<div class="line_border"></div>
    	<?php }?>
    <?php }?>
<?php }?>