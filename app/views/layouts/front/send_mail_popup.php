<div id="mesagepopboxsendmailpopoup" class="mesage-pop" >
    <div id="mesagecontent">
        <h4>
            <span id="sendmail_popup_title">Send mail</span>
            <div id="closesendmailpopoup" class="closesendmailpopoup">X</div>
        </h4>
        <div class="sendmailpopoupbody" id="sendmailpopoupbody">
            <?php echo $this->Form->create('sendmail', array('type' =>'file','id'=>'sendmailForm',  'class'=>'', 'url'=>$base_url.'/texts/sendmailform/notajax'));?> 
            <div class="input_new">
                <input id="nametopinput" class="input3new" type="text" name="data[sendmail][name]" placeholder="Name" />    
            </div>
            <div class="input_new">
                <input class="input3new" type="text" id="emailtopinput" name="data[sendmail][email]" placeholder="Email"  /> 
            </div>
            <div class="input_new">
                <input class="input3new" type="text" id="subjectinput" name="data[sendmail][subject]" placeholder="Subject"  /> 
            </div>
            <div class="input_new">
                <textarea class="input3new" type="text" id="messagetopinput" name="data[sendmail][message]" placeholder="Message" style="height: 70px;padding: 5px 10px;"  /></textarea> 
            </div>
            <input type="hidden" name="data[sendmail][to_email]" value="" id="sendmail_popup_to_email" />
            <a id="send_form_sendmail"><div class="Send white_green_button">Send</div></a>
            <?php echo $this->Form->end();?>
            <div class="ajax_result_sendmail">        
                <div id="sendmail_ajaxLoading"></div>
                <div id="sendmail_Result2"></div>
            </div>
        </div>
    </div>
    <div class="mesage-pop-bg"></div>
</div>
<script type="text/javascript">
var base_url = '<?php echo $base_url;?>';
jQuery(document).ready(function() {
    jQuery("#mesagepopboxsendmailpopoup").on("click",".closesendmailpopoup", function(){
        close_sendmail_popup();            
    });
    jQuery('.mesage-pop-bg').click(function(){
        close_sendmail_popup();
    });
    $("#send_form_sendmail").click(function(){
        var error = ''; 
        if($("#nametopinput").val().length === 0){
            error = error + 'You must enter your Name.<br />';
            $("#nametopinput").addClass("required");
        }else{
            $("#nametopinput").removeClass("required");
        }  
        if($("#subjectinput").val().length === 0){
            error = error + 'You must enter Subject.<br />';
            $("#subjectinput").addClass("required");
        }else{
            $("#subjectinput").removeClass("required");
        }       
        if(!isValidEmailAddress($("#emailtopinput").val())) {
            error = error + 'You must enter valid Email.<br />';
            $("#emailtopinput").addClass("required");
        }else{
            $("#emailtopinput").removeClass("required");
        }
        if($("#messagetopinput").val().length === 0){
            error = error + 'You must enter your Message.<br />';
            $("#messagetopinput").addClass("required");
        }else{
            $("#messagetopinput").removeClass("required");
        }
        if(error.length !== 0){                         
            //$('#sendmail_Result2').html(error);
            //$('#sendmail_Result2').show();
        }else{      
            sendFormsendmail();                             
        }
    });           
    $("form#sendmailForm").submit(function(event){
        //disable the default form submission
        event.preventDefault();
        //grab all form data  
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: base_url+'/texts/sendmailform/ajax',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $('#sendmail_Result2').hide();
                $('#sendmail_ajaxLoading').show(); 
            },
            success:function(result){
                $('#sendmail_ajaxLoading').hide();
                $('#sendmail_Result2').html(result).show();
                $('.sendmailpopoupbody').find('form')[0].reset();
            }
        });
    return false;
    });
    jQuery("a").click(function(event){
        var href = jQuery(this).attr('href');
        var mail_to_string = 'mailto:';
        if (typeof href !== typeof undefined && href !== false) {
            if(href.indexOf(mail_to_string) > -1){
                var mail_val = href.replace(mail_to_string, '');
                event.preventDefault();
                open_sendmail(mail_val);            
            }
        }
    });
});
function open_sendmail_popup(){
    jQuery("#mesagepopboxsendmailpopoup").show();
}
function close_sendmail_popup(){
    jQuery("#mesagepopboxsendmailpopoup").hide(); 
}
function open_sendmail(to_email){
    $("#sendmail_popup_to_email").val(to_email);
    $('.sendmailpopoupbody').find('form')[0].reset();
    $(".sendmailpopoupbody input").removeClass("required");
    $(".sendmailpopoupbody textarea").removeClass("required");  
    $('#sendmail_Result2').hide();      
    open_sendmail_popup();                        
}
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};
function sendFormsendmail(siteUrl){
    $("form#sendmailForm").submit();
}
</script>
<style type="text/css">
.vacancies_groub{
    height: auto;
}
.bottm_apply{
    cursor: pointer;
}
.input3new{
    width: 95%;
    height: 25px;
}
#sendmail_ajaxLoading{
    display:none;   
    width: 80px;
    height:15px;
    background-image: url(<?php echo $base_url.'/img/front/tloading.gif'?>);
    background-repeat: no-repeat;
}
#sendmail_Result2{
    font-family:OpenSans-Regular;
    color:#0d9f49;
    width: 100%
}
.ajax_result_sendmail{
    margin-top: 5px;
    width: 100%;
    float:left;
}       
form{
    color: #000000;
    font-size: 15px;
    font-weight: normal;
}
#fileinput{
    width: 89%;    
}
</style>