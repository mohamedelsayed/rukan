<div id="mesagepopboxvacancypopoup" class="mesage-pop" >
    <div id="mesagecontent">
        <h4>
            <span id="vacancy_popup_title"></span>
            <div id="closevacancypopoup" class="closevacancypopoup">X</div>
        </h4>
        <div class="vacancypopoupbody" id="vacancypopoupbody">
            <?php echo $this->Form->create('vacancy', array('type' =>'file','id'=>'vacancyForm',  'class'=>'','url'=>$base_url.'/career/vacancyform/notajax'));?> 
            <div class="input_new">
                <input id="nameinput" class="input3new" type="text" name="data[vacancy][name]" placeholder="Name" />    
            </div>
            <div class="input_new">
                <input class="input3new" type="text" id="emailinput" name="data[vacancy][email]" placeholder="Email"  /> 
            </div>
            <div class="input_new">
                <textarea class="input3new" type="text" id="messageinput" name="data[vacancy][message]" placeholder="Message" style="height: 70px;padding: 5px 10px;"  /></textarea> 
            </div>
            <div class="input_new">
                <label>C.V</label>
                <input type="file" id="fileinput" name="file" class="input3new" />
            </div>
            <input type="hidden" name="data[vacancy][to_email]" value="" id="vacancy_popup_to_email" />
            <input type="hidden" name="data[vacancy][title]" value="" id="vacancy_popup_hidden_title" />
            <a id="send_form_vacancy"><div class="Send white_green_button">Send</div></a>
            <?php echo $this->Form->end();?>
            <div class="ajax_result_vacancy">        
                <div id="vacancy_ajaxLoading"></div>
                <div id="vacancy_Result2"></div>
            </div>
        </div>
    </div>
    <div class="mesage-pop-bg"></div>
</div>
<?php $tree = array(array('url' => '/page/show/9', 'str' => $parent_title),
array('url' => '', 'str' => $title));
echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));
$page_limit = $limit; $page = 1;?>
<div id="tab-2" class="tab-content current" style="width: 100%;">
    <div class="tab-content_top" style="width: 100%;">
        <div class="top_con">
            <div class="top_con_2"><?php echo $title;?></div>  
            <div class="adders_write"><?php echo $body;?></div>
            <?php if($pages_count > 0){?>
            <div id="items-listing" class="items-listing"></div>
            <div class="bottom_till_big" style="margin-bottom:20px;">
                <a class="loadmoreitem" id="loadmoreitem" page="<?php echo $page;?>" limit="<?php echo $page_limit;?>" pagecount="<?php echo $pages_count;?>" >
                    <div class="bottom_till">More</div>
                    <img style="margin-top: 2px;" src="<?php echo $base_url.'/img/front/bottom_news.png';?>"/>
                </a>
                <a class="ajaxloadingloadmoreitem"></a>
            </div>
            <?php }else{?>
                <div class="no-data-found">No data found.</div>
            <?php }?>
        </div>
    </div>
</div>
<?php if($pages_count > 0){?>
    <script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#loadmoreitem').click(function(){
            var page = $(this).attr("page");
            var limit = $(this).attr("limit");
            var nextpage = parseInt(page) + 1;
            var pagecount = $(this).attr("pagecount");
            var model = '<?php echo $model;?>';
            var loadmoreitembutton = $(this);
            $.ajax({
                type: "POST",
                url: siteUrl+'/career/list_items',
                data: {page:page,limit:limit,model:model},
                beforeSend: function() {
                    jQuery('.ajaxloadingloadmoreitem').show();                    
                    loadmoreitembutton.hide();
                    //loadmoreitembutton.addClass("ajaxloading");
                },
                success: function(result) {
                    jQuery('.ajaxloadingloadmoreitem').hide();                      
                    //loadmoreitembutton.removeClass("ajaxloading");
                    jQuery("#items-listing").append(result);                
                    if(parseInt(nextpage) <= parseInt(pagecount)){
                        loadmoreitembutton.show();
                        loadmoreitembutton.attr("page", nextpage)
                    }else{
                        loadmoreitembutton.hide();
                    }
                }
            });
        });
    });
    jQuery(document).ready(function() {
        jQuery("#loadmoreitem").click();
    });      
    
    </script>
<?php }?>
<script type="text/javascript">
var base_url = '<?php echo $base_url;?>';
var file_cv_error = 1;
jQuery(document).ready(function() {
    jQuery("#mesagepopboxvacancypopoup").on("click",".closevacancypopoup", function(){
        close_vacancy_popup();            
    });
    jQuery('.mesage-pop-bg').click(function(){
        close_vacancy_popup();
    });
    $("#send_form_vacancy").click(function(){
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
        }else{
            $("#emailinput").removeClass("required");
        }
        if($("#messageinput").val().length === 0){
            error = error + 'You must enter your Message.<br />';
            $("#messageinput").addClass("required");
        }else{
            $("#messageinput").removeClass("required");
        }
        if($("#fileinput").val().length === 0){
            error = error + 'You must attach your c.v.<br />';
            $("#fileinput").addClass("required");
        }
        if(error.length !== 0){                         
            //$('#vacancy_Result2').html(error);
            //$('#vacancy_Result2').show();
        }else{ 
            if(file_cv_error == 0){ 
            sendFormVacancy();                 
            }
        }
    });          
    $(':file').change(function(){
        var file = this.files[0];
        var name = file.name;
        var size = file.size;
        var type = file.type;      
        var ext = name.substr(name.lastIndexOf('.') + 1);  
        var ext = ext.toLowerCase();
        if(ext == 'pdf' || ext == 'doc' || ext == 'docx'){
            $(this).removeClass("required");
            file_cv_error = 0;            
        }else{
            $(this).addClass("required");
            file_cv_error = 1;
        }
    });   
    $("form#vacancyForm").submit(function(event){
        //disable the default form submission
        event.preventDefault();
        //grab all form data  
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: base_url+'/career/vacancyform/ajax',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $('#vacancy_Result2').hide();
                $('#vacancy_ajaxLoading').show(); 
            },
            success:function(result){
                $('#vacancy_ajaxLoading').hide();
                $('#vacancy_Result2').html(result).show();
                $('.vacancypopoupbody').find('form')[0].reset();
            }
        });
    return false;
    });
});
function open_vacancy_popup(){
    jQuery("#mesagepopboxvacancypopoup").show();
}
function close_vacancy_popup(){
    jQuery("#mesagepopboxvacancypopoup").hide(); 
}
function open_vacancy(obj){
    var parent_div_id = obj.parent().attr('id');
    var title = $('#'+parent_div_id+' .vacancy_div_title').html();
    var to_email = $('#'+parent_div_id+' .vacancy_div_to_email').val();
    $("#vacancy_popup_title").html(title);
    $("#vacancy_popup_to_email").val(to_email);
    $("#vacancy_popup_hidden_title").val(title);
    $('.vacancypopoupbody').find('form')[0].reset();
    $(".vacancypopoupbody input").removeClass("required");
    $(".vacancypopoupbody textarea").removeClass("required");  
    $('#vacancy_Result2').hide();      
    open_vacancy_popup();                        
}
/*function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};*/
function sendFormVacancy(siteUrl){
    $("form#vacancyForm").submit();
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
#vacancy_ajaxLoading{
    display:none;   
    width: 80px;
    height:15px;
    background-image: url(<?php echo $base_url.'/img/front/tloading.gif'?>);
    background-repeat: no-repeat;
}
#vacancy_Result2{
    font-family:OpenSans-Regular;
    color:#0d9f49;
    width: 100%
}
.ajax_result_vacancy{
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