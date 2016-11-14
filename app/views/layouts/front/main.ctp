<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="en-US">
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html lang="en-US">
    <!--<![endif]-->
    <head>
		<!--
		 * @author Author "Mohamed Elsayed"  
		 * @author Author Email "me@mohamedelsayed.net"
		 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
		-->
		<?php echo $this->Html->charset();?>
		<title>
			<?php if($this->name != 'Home') echo $title_for_layout.' | '; 
			echo $this->Session->read('Setting.title'); ?>
		</title>
		<!--Share default image and description-->
		<meta property="og:image" content="<?php echo (isset($shareImage))?$base_url.'/img/upload/'.$shareImage:$base_url.'/img/front/logo.png';?>"/>
		<meta property="og:description" content="<?php echo (isset($metaDescription))?$metaDescription:$this->Session->read('Setting.meta_description');?>"/>
		<!--Meta sent by web admin -->
		<meta name="abstract" content="<?php echo (isset($metaKeywords))?$metaKeywords:$this->Session->read('Setting.meta_keywords');?>" />
		<meta HTTP-EQUIV="CONTENT-LANGUAGE" CONTENT="en" />
		<meta NAME="revisit-after" CONTENT="7 days" />
		<meta NAME="robots" CONTENT="all" />
		<meta name="rating" content="General" />
		<meta name="distribution" content="Global" />
		<meta name="MSSmartTagsPreventParsing" content="true" />
		<meta name="Expires" content="-1" />
		<meta name="reply-to" content="<?php echo $this->Session->read('Setting.email');?>" />
		<meta name="classification" content="Business" />
		<meta name="Copyright" content="Bloom" />
		<meta name="Author" content="" />
		<meta http-equiv="Cache-Control" content="Public" />
		<meta http-equiv="Pragma" content="No-Cache" />
		<?php //meta
		echo $this->Html->meta('icon', $base_url.'/app/webroot/img/front/favicon.png');
		echo $this->Html->meta('keywords', isset($metaKeywords)?$metaKeywords:$this->Session->read('Setting.meta_keywords'));
		echo $this->Html->meta('description', isset($metaDescription)?$metaDescription:$this->Session->read('Setting.meta_description'));	
		//CSS
		echo $this->Html->css(array('front/style', 'front/jMenu.jquery', 'front/skin', 'front/new_style', 'front/css3dropdownmenu'));
		//SCRIPTS
		echo $this->Html->scriptBlock("var siteUrl ='".$base_url."';");//Define global var siteUrl
		//echo $this->Javascript->link('libs/jquery');
		echo $this->Javascript->link(array('front/jquery', 'front/jMenu.jquery', 'front/jquery.jcarousel.min'));		
		echo $scripts_for_layout;
		$google_analytics_propertyid = $this->Session->read('Setting.google_analytics_propertyid');
		if(trim($google_analytics_propertyid) != ''){?>
		    <script>
              (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
              (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
              m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
              })(window,document,'script','//www.google-analytics.com/analytics.js','ga');            
              ga('create', '<?php echo trim($google_analytics_propertyid);?>', 'auto');
              ga('send', 'pageview');            
            </script>		    
		<?php }?>
		<script type="text/javascript">
		/** This code was added by "Mohamed Elsayed", Email "me@mohamedelsayed.net" to add display:none to style of wowslider link */
		$(document).ready(function () {
			var hrefcode = 'wowslider';
			$("[href*="+hrefcode+"]").css('display', 'none'); 			
		});
		</script>	
		<script type="text/javascript">
		$(document).ready(function(){
			$('ul.tabs li').click(function(){
				var tab_id = $(this).attr('data-tab');
				$('ul.tabs li').removeClass('current');
				$('.tab-content').removeClass('current');
				$(this).addClass('current');
				$("#"+tab_id).addClass('current');
			});			
		});		
		</script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_api_key;?>&libraries=geometry,places"></script>	
	</head>
	<body>
		<div class="container_big">
		    <?php include_once('header.ctp');?>
		    <?php if(!empty($widgets)){
                foreach ($widgets as $key => $widget) {
                    $data = $widget['Widget'];
                    if($data['id'] == 1){
                        $resize->smartResizeImage($data['image'], 1500);?>  
                        <div class="slider_main_div">              
                            <div class="slider">
                                <img style="width:100%;" src="<?php echo $base_url.'/img/upload/'.$data['image'];?>"/>
                            </div>
                            <div class="slider_main">
                                <div class="wrie_pic" style="width: 60%;margin-left: 20%;margin-right:20%;">
                                    <?php $body = $this->element('front'.DS.'view_string_according_lang', array('str_en' => $data['body'], 'str_ar' => $data['body_ar']));
                                    //echo $this->element('front'.DS.'remove_unneeded_tags_from_string', array('string' => $body));
                                    echo $body;?>            
                                    <?php /*<img src="<?php echo $base_url.'/img/front/arrow.png';?>"/>*/?>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                <?php }?>
            <?php }?>
		    <div class="container">		        
    			<?php //echo $this->Session->flash ();?>
    			<?php echo $content_for_layout; ?>				  
			</div>
			<?php include_once('footer.ctp');?>
		</div>
        <?php //echo '<div style="float:left; width:100%;"><div style="margin-left: auto;margin-right: auto;width:945px;">'.$this->element('sql_dump').'</div></div>';?>		
	</body>
</html>