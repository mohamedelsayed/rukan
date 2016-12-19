<header>
    <div class="top_header_logo"></div>
    <div class="main-header">
        <div class="men_etop">
            <?php /*<div class="men_a">
                <a class="menu_smill" href="#">EN /</a> 
                <a class="menu_smill" href="#"> عربي</a>
            </div>*/?>
            <div class="men_face">
                <a target="_blank" href="<?php echo $setting['linkedin_link'];?>">
                    <img class="Twitter" src="<?php echo $base_url.'/img/front/';?>in.png" />
                </a>
                <a target="_blank" href="<?php echo $setting['twitter_link'];?>">
                    <img class="Twitter" src="<?php echo $base_url.'/img/front/';?>Twitter.png" />
                </a>
                <a target="_blank" href="<?php echo $setting['facbook_link'];?>">
                    <img class="Twitter" src="<?php echo $base_url.'/img/front/';?>face.png" />
                </a>
            </div>
            <div class="input">
                <?php $keyword = '';
                if(isset($_GET['k'])){
                    $keyword = $_GET['k'];
                }?>
                <form onsubmit="return validateheadersearchform();" id="headersearchform" method="get" action="<?php echo $base_url.'/search';?>">
                    <a onclick="headersearchformsubmit();" style="cursor: pointer;">
                        <img class="seah" src="<?php echo $base_url.'/img/front/';?>sh.jpg" />
                    </a>
                    <input id="headersearchformk" class="input_s" type="text" name="k" value="<?php echo $keyword;?>" > 
                </form>
            </div>
        </div>
        <div class="menu_big">
        	<a href="<?php echo $base_url;?>">
	            <div class="logo">                
                    <img src="<?php echo $base_url.'/img/front/logo.png';?>" />                
    	        </div>
	        </a>
            <div class="menu_">
                <ul id="jMenu" class="menu">
                    <li>
                        <a href="<?php echo $base_url;?>" class="fNiv" id="home" ><?php echo $setting['home_string'];?></a>           
                    </li>
                    <?php if(!empty($header_cats)){
                        foreach ($header_cats as $key => $header_cat) {
                            $additional_code = '';
                            $url = $base_url.'/page/show/'.$header_cat['Cat']['id'];
                            if($header_cat['Cat']['has_url'] == 1){
                                if (strpos($header_cat['Cat']['url'], 'http') !== FALSE) {
                                    $url = $header_cat['Cat']['url'];
                                    $additional_code = ' target="_blank" ';
                                }else{
                                    $url = $base_url.$header_cat['Cat']['url'];
                                }
                            }?>
                            <li>
                                <a href="<?php echo $url;?>" class="fNiv" id="<?php echo strtolower(str_replace(' ', '', $header_cat['Cat']['title']));?>"  <?php echo $additional_code;?>>
                                    <?php echo $header_cat['Cat']['title'];?>
                                </a>
                                <?php /*if(!empty($header_cat['Node'])){?>
                                    <ul>
                                        <?php foreach ($header_cat['Node'] as $key => $header_cat_node) {?>
                                            <li class="submenu">
                                                <a style="width: 200px;" href="<?php echo $base_url.'/page/show/'.$header_cat['Cat']['id'].'?nodeid='.$header_cat_node['id'];?>"><?php echo $header_cat_node['title'];?></a>
                                            </li>
                                        <?php }?>
                                    </ul>
                                <?php }else*/?>
                                <?php if(!empty($header_cat['ChildCat'])){
                                	$style_menu_chlid = '';
                                	if($header_cat['Cat']['id'] == 9){
                                		$style_menu_chlid = 'left: -150px;';                                		
                                	}?>
                                    <ul style="width: auto;overflow: hidden;<?php echo $style_menu_chlid;?>">
                                        <?php foreach ($header_cat['ChildCat'] as $key => $header_cat_child) {
                                            $in_url = $base_url.'/page/show/'.$header_cat['Cat']['id'].'/'.$header_cat_child['id'];
                                            $additional_code = '';
                                            if($header_cat_child['has_url'] == 1){
                                                if (strpos($header_cat_child['url'], 'http') !== FALSE) {
                                                    $in_url = $header_cat_child['url'];
                                                    $additional_code = ' target="_blank" ';
                                                }else{
                                                    $in_url = $base_url.$header_cat_child['url'];
                                                }
                                            }
                                            ?>
                                            <li class="submenu" style="width: 100%;padding: 0 5px;">
                                                <a style="width: auto;white-space: nowrap; min-width: 200px" href="<?php echo $in_url;?>" <?php echo $additional_code;?>><?php echo $header_cat_child['title'];?></a>
                                            </li>
                                        <?php }?>
                                    </ul>
                                <?php }?>
                            </li>
                        <?php }?>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
</header>
<?php /*<script type="text/javascript">
$(document).ready(function() {
    $("#jMenu").jMenu({
        ulWidth : '320',
        absoluteTop: 40,
        }
    );
});
</script>*/?>
<?php if(isset($selected)){?>
    <script type="text/javascript">
    $(document).ready(function(){
        $(".fNiv").removeClass('selected');
        $("#<?php echo $selected;?>").addClass('selected');  
    });
    </script>
<?php }?>
<?php if(!isset($is_home)){?>
    <style type="text/css">
    header{
        border-bottom: 5px solid #ececec;
    }
    </style>
<?php }?>
<div id="mesagepopboxeventpopoup" class="mesage-pop" >
    <div id="mesagecontent"></div>
    <div class="mesage-pop-bg"></div>
</div>  
<script type="text/javascript">
var base_url = '<?php echo $base_url;?>';
function open_event_popup(content){
    jQuery("#mesagepopboxeventpopoup #mesagecontent").html(content); 
    jQuery("#mesagepopboxeventpopoup").addClass("alert"); 
    jQuery("#mesagepopboxeventpopoup").show();
    jQuery('body').addClass("mobile-menu-opend");       
}
function close_event_popup(){
    jQuery("#mesagepopboxeventpopoup").hide(); 
    jQuery("#mesagepopboxeventpopoup #mesagecontent").html('');
    jQuery("#mesagepopboxeventpopoup").removeClass("alert");
    jQuery('body').removeClass("mobile-menu-opend");          
}
function open_event(id){
    jQuery.ajax({
        url: base_url+'/calendar/get_event/'+id,
        type: 'GET',
         beforeSend: function() {
             open_event_popup('<h4>Loading<div id="closeeventpopoup" class="closeeventpopoup">X</div></h4><div class="event_loading"></div>');            
        },
        success: function(result) {
            open_event_popup(result);            
        }
    }); 
}
jQuery(document).ready(function() {
    jQuery("#mesagepopboxeventpopoup").on("click",".closeeventpopoup", function(){
        close_event_popup();            
    });
    jQuery('.mesage-pop-bg').click(function(){
        close_event_popup();
    });
});
/*jQuery(document).ready(function() {
    jQuery("#jMenu li").hover(function(){
        var current = jQuery(this).children('ul');
        jQuery("#jMenu li ul").not(current).hide();
        //jQuery("#jMenu li ul").hide();
        //jQuery(this).children('ul').fadeIn();                        
    }, function(){
        jQuery(this).children('ul').hide();        
    });
});*/
function headersearchformsubmit () {
    jQuery('#headersearchform').submit();  
}
function validateheadersearchform () {
    var k = jQuery('#headersearchformk').val();
    if(k.length > 0){
        return true;
    }else{
        return false;
    }
}
</script>
<?php include_once 'send_mail_popup.php';?>