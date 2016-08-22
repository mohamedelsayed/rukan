<div class="input file">
    <label for="AlbumGal">Images:</label>
    <input type="file" id="AlbumGal" multiple="multiple" name="images[]">
    <div id="ajaxLoading"></div>
    <div class="mymessage"></div> 
    <div class="images_wrapper"><?php echo $images_div;?></div>       
</div>
<script type="text/javascript">
var base_url = '<?php echo $base_url;?>';
$(document).ready(function(){
    $('#AlbumGal').on('change',function(){
        $(".mymessage").html("");
        var my_files = this.files;
        var index;        
        for (index = 0; index < my_files.length; ++index) {
            var file_data = my_files[index];
            var name = file_data.name;
            var ext = name.substr(name.lastIndexOf('.') + 1);  
            var form_data = new FormData();
            form_data.append('file', file_data);
            var ext = ext.toLowerCase();
            if(ext == 'jpeg' || ext == 'png' || ext == 'gif' || ext == 'jpg'){
                $.ajax({
                url: base_url+'/texts/upload_image',
                type: 'POST',
                data: form_data,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('#ajaxLoading').show(); 
                },
                success:function(result){                    
                    $('#ajaxLoading').hide();
                    $('.images_wrapper').append(result);
                }
            });
            }else{
                $(".mymessage").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
            }
        }
        $('#AlbumGal').val('');
    });
    jQuery("body").on("click", ".delete a", function () {
        var y = confirm('Are you sure you want to delete this image?');
        if(y){
            jQuery(this).closest('div.image_wrap').remove();
        }
    });
});
</script>
<style type="text/css">
#ajaxLoading{
    display:none;   
    width: 80px;
    height:15px;
    background-image: url(<?php echo $base_url.'/img/front/tloading.gif'?>);
    background-repeat: no-repeat;
}
.images_wrapper{
    float: none;
    width:100%;
    clear: both;
} 
.image_wrap .caption, .image_wrap .cover, .image_wrap .delete{
    float: left;
    width: 50%;
    clear: none;
}
.image_wrap .img_item{
    float: left;
    width: 35%;    
    clear: none;
}
.image_wrap .delete{
    margin-left: 10px;
}
.image_wrap{
    float: none;
    width:100%;
    max-height:250px;
    overflow: hidden;
}
</style>