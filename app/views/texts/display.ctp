<div id="requestpopup" class="mesage-pop" style="display:none;" >
    <h4>Contact Us<div id="closealert" class="closealert">X</div></h4>
    <div id="contactus_Resultdiv"></div>
</div>
<div id="mesagepopbox" class="mesage-pop" >
    <div id="mesagecontent">
    </div>
    <div class="mesage-pop-bg"></div>
</div>  
<script type="text/javascript">
    function opennorequestpopup(){
        var content = jQuery('#requestpopup').html();
        jQuery("#mesagepopbox #mesagecontent").html(content); 
        jQuery("#mesagepopbox").addClass("alert"); 
        jQuery("#mesagepopbox").show();                                             
        jQuery('body').addClass("mobile-menu-opend");       
    }
    jQuery(document).ready(function() {
        jQuery("#mesagepopbox").on("click",".closealert", function(){
            jQuery("#mesagepopbox").hide(); 
            jQuery("#mesagepopbox #mesagecontent").html('');
            jQuery("#mesagepopbox").removeClass("alert");
            jQuery('body').removeClass("mobile-menu-opend");        
        });
        jQuery('.mesage-pop-bg').click(function(){
            jQuery("#mesagepopbox").hide(); 
            jQuery("#mesagepopbox #mesagecontent").html('');
            jQuery("#mesagepopbox").removeClass("alert");
            jQuery('body').removeClass("mobile-menu-opend");        
        });
    });
</script>
<?php $tree = array(array('url' => '/contact-us', 'str' => $content['Content']['title']));
echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));?>
<div id="tab-2" class="tab-content current">
    <div class="tab-content_top">
        <div class="top_con">
            <div class="top_con_2"><?php echo $content['Content']['title'];?></div>
            <div class="img_about" id="map_canvas">
                <?php //echo $content['Content']['map_iframe'];?>
                <?php /*<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d27513.56686643945!2d31.1884216!3d30.4588901!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2seg!4v1397339395281" width="960" height="345" frameborder="0" style="border:0; margin-top:2.5%;"></iframe>*/?>
            </div>
        </div>
    </div>
</div>
<div class="grop_contact_left">    
    <div class="left_addret">
        <?php echo $this->element('front'.DS.'remove_unneeded_tags_from_string', array('string' => $body));?>            
    </div>
    <div class="adderss_contact" style="margin-top: 20px;margin-bottom: 10px;font-size: 25px;"><?php echo $content['Content']['inner_title'];?></div>
    <?php echo $this->Javascript->link('front/ajax/contactus');?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#send_form_contact").click(function(){
                var error = ''; 
                if($("#nameinput").val().length === 0){
                    error = error + 'You must enter your Name.<br />';
                    $("#nameinput").addClass("required");
                }else{
                    $("#nameinput").removeClass("required");
                }       
                if(!isValidEmailAddress($("#emailinput").val())) {
                    error = error + 'You must enter valid Email.<br />';
                    $("#emailinput").addClass("required");
                }
                else{
                    $("#emailinput").removeClass("required");
                }
                if($("#messageinput").val().length === 0){
                    error = error + 'You must enter your Message.<br />';
                    $("#messageinput").addClass("required");
                }   
                else{
                    $("#messageinput").removeClass("required");
                }
                if(error.length !== 0){                         
                    //$('#contactus_Result2').html(error);
                    //$('#contactus_Result2').show();
                }else{  
                    sendFormContact('<?php echo $base_url;?>');                 
                }
            });             
        });
        function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
            return pattern.test(emailAddress);
        };
    </script>
    <?php echo $this->Form->create('Contactus', array('type' =>'file','id'=>'ContactusForm',  'class'=>'','url'=>$base_url.'/texts/contactusForm/notajax'));?>    
    <div class="input_new">
        <input id="nameinput" class="input3new" type="text" name="data[Contactus][name]" placeholder="Name" />    
    </div>
    <div class="input_new">
        <input class="input3new" type="text" id="emailinput" name="data[Contactus][email]" placeholder="Email"  /> 
    </div>
    <div class="input_new">
        <textarea class="input3new" type="text" id="messageinput" name="data[Contactus][message]" placeholder="Message" style="height: 100px;padding: 5px 10px;"  /></textarea> 
    </div>
    <a id="send_form_contact"><div class="Send white_green_button">Send</div></a>
    <?php echo $this->Form->end();?>
    <div class="ajax_result_contactus">        
        <div id="contactus_ajaxLoading"></div>
        <div id="contactus_Result2"></div>
    </div>
    <style type="text/css">
    #contactus_ajaxLoading{
        display:none;   
        width: 80px;
        height:15px;
        background-image: url(<?php echo $base_url.'/img/front/tloading.gif'?>);
        background-repeat: no-repeat;
    }
    #contactus_Result2{
        font-family:OpenSans-Regular;
        font-size:14px;
        font-weight:100;
        color:#FF0000;
        width: 100%
    }
    #contactus_Result{
        font-family:OpenSans-Regular;
        color:#000000
        font-size:13px;
        font-weight: bold;
        width: 100%
    }
    .ajax_result_contactus{
        margin-top: 5px;
        width: 100%;
        float:left;
    }           
    </style>
</div>
<div class="grop_contact_right">
    <div class="adderss_contact">
        Contacts
    </div>
    <?php if($content['Content']['address'] != ''){?>
        <div class="grob_contacts">
            <div class="home">
                <a>
                    <img src="<?php echo $base_url.'/img/front/';?>home.png"/>
                </a>
            </div><?php echo $content['Content']['address'];?>
        </div>
    <?php }?>
    <?php if($content['Content']['phone'] != ''){?>
        <div class="grob_contacts">
            <div class="home">
                <a>
                    <img src="<?php echo $base_url.'/img/front/';?>tele.png"/>
                </a>
            </div><?php echo $content['Content']['phone'];?>
        </div>
    <?php }?>
    <?php if($content['Content']['mail'] != ''){?>
        <div class="grob_contacts">
            <div class="home">
                <a href="mailto:<?php echo $content['Content']['mail'];?>">
                    <img style="margin-top: -3px;margin-left: -3px;" src="<?php echo $base_url.'/img/front/';?>contact_us_mail.png"/>
                </a>
            </div>
            <a href="mailto:<?php echo $content['Content']['mail'];?>"><?php echo $content['Content']['mail'];?></a>        
        </div>
    <?php }?>
    <?php if($content['Content']['facebook_link'] != ''){?>
        <div class="grob_contacts">
            <div class="home">
                <a href="<?php echo $content['Content']['facebook_link'];?>">
                    <img width="22" src="<?php echo $base_url.'/img/front/';?>face2.png"/>
                </a>
            </div>
            <a target="_blank" href="<?php echo $content['Content']['facebook_link'];?>">
                <?php $replace = '';$search1 = 'https://www.facebook.com';
                $search2 = 'http://www.facebook.com';
                $search3 = 'https://facebook.com';
                $search4 = 'http://facebook.com';
                $facebook = $content['Content']['facebook_link'];
                $facebook = str_replace($search1, $replace, $facebook);
                $facebook = str_replace($search2, $replace, $facebook);
                $facebook = str_replace($search3, $replace, $facebook);
                $facebook = str_replace($search4, $replace, $facebook);
                echo $facebook;?>
            </a>
        </div>
    <?php }?>
</div>      
<script type="text/javascript">
$(document).ready(function(){
    $(".img_about").css('width','960');
    $(".img_about").css('height','345');
    //$(".img_about iframe").css('border','2px solid #adadad');
});
</script> 
<script type="text/javascript">
var marker1;
var map;
var myLatlng1;
var lat_val = "<?php echo $content['Content']['latitude'];?>";
var lng_val = "<?php echo $content['Content']['longitude'];?>";
var zoom = <?php echo $content['Content']['zoom'];?>;
if (lat_val === "" || lng_val === "" || zoom == ''){
    lat_val = 30.048519;
    lng_val = 30.990039;
    zoom == 17;
}
jQuery(document).ready(function() {
    initialize(lat_val, lng_val);
});
function initialize(lat_val, lng_val) {
   lat_val = parseFloat(lat_val);
    lng_val = parseFloat(lng_val);
    var mapOptions = {
        center: { lat: lat_val, lng: lng_val},
        zoom: zoom,
        mapTypeId: google.maps.MapTypeId.TERRAIN,
        draggable: false, 
        //zoomControl: false, 
        //scrollwheel: false, 
        disableDoubleClickZoom: true        
    };
    map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);
    //markers
    myLatlng1 = new google.maps.LatLng(lat_val, lng_val);
    marker1 = new google.maps.Marker({
        position: myLatlng1,
        map: map,
        title:"<?php echo $content['Content']['address'];?>",
        //icon: image1,
    });
    marker1.setMap(map);
    marker1.info = new google.maps.InfoWindow({
    content: '<?php echo $content['Content']['address'];?>'
    }); 
    google.maps.event.addListener(marker1, 'mouseover', function() {
        marker1.info.open(map, marker1);
    });
    google.maps.event.addListener(marker1, 'mouseout', function() {
        marker1.info.close();
    });
}
</script>
<style type="text/css">
    .left_addret a{
        color: #0d9f49;
        text-decoration: none;
    }
    #map_canvas{
        margin-top: 20px;
    }
</style>