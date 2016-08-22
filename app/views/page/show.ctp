<?php echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));?>
<div id="tab-2" class="tab-content current" style="width: 100%;">
    <div class="tab-content_top" style="width: 100%;min-height: 250px;">
        <div class="top_con">
            <div style="" class="top_con_2"><?php echo $title;?></div>
            <?php include_once 'tabs.php';?>
            <?php if(isset($testimonials) && $testimonials == 1){
                include_once 'testimonials.php';
            }elseif(isset($whoiswho) && $whoiswho == 1){
                include_once 'whoiswho.php';
            }else{?>           
                <?php if(isset($image) && trim($image) != ''){?>
                    <div class="img_about">
                        <a><img src="<?php echo $image;?>"/></a>
                    </div> 
                <?php }?>
                <?php if(trim(strip_tags($body)) != ''){?>
                    <div class="page_body_div">
                        <?php $resize->check_string_images($body);?>
                        <?php echo $body;?>
                        <?php if(isset($pdf_file)){
                            if(trim($pdf_file) != ''){?>
                                <div class="page_pdf_file">
                                    <a target="_blank" href="<?php echo $pdf_file;?>"><?php echo $pdf_name;?></a>
                                </div>
                            <?php }
                        }?>
                    </div>
                <?php }?>
            <?php }?>
            <?php if(isset($admissions) && $admissions == 1){
                include_once 'admissions_form.php';
            }?>
        </div>
    </div>
</div>
<?php if(isset($mission_vision_values) && $mission_vision_values == 1){
    include_once 'mission_vision_values.php';
}?>
<script type="text/javascript">
$(document).ready(function(){
    $('.page_body_div img').each(function(){
        $(this).css('height', 'auto');
    });
    $('.page_body_div table').each(function(){
        $(this).css('width', '100%');
        $(this).attr('cellspacing', 0);
        $(this).attr('cellpadding', 0);
        $(this).attr('border', 0);
    });
});
</script>
<style type="text/css">
    .page_body_div a{
        color: #0d9f49;
        text-decoration: none;
    }
</style>