<?php if(isset($values_data) && !empty($values_data)){?>
    <?php $i = 0;
    foreach ($values_data as $key => $value) {
        $image = '';
        $max_width  = 'max-width:100%;';
        $max_height  = 'max-height:80%;';
        $i++;
        $height = '162px';
        if($i == 3){
            $height = '127px';
        }
        if(isset($value['Value'])){
            $image = $base_url.'/img/upload/'.$value['Value']['image'];
        }?>
        <div class="com_small" style="height: 400px;">
            <div class="logo_small" style="height: <?php echo $height;?>;overflow: hidden;">
                <a>
                    <img style="<?php echo $max_width.$max_height;?>" src="<?php echo $image;?>"/>
                </a>
            </div>
            <div class="adders_about2">
                <?php echo $value['Value']['title'];?>
            </div>
            <div class="adders_about_smill2">
                <?php $body = $this->element('front'.DS.'remove_unneeded_tags_from_string', array('string' => $value['Value']['body']));
                $body = $this->element('front'.DS.'string_format_view', array('str' => $body, 'val' => 100, 'type' => 'wordsCut'));
                echo $body;?>
            </div>
        </div>
    <?php }?>
<?php }?>    
<div class="members_margin_div"></div>
<style type="text/css">
    .img_about img{
        border: 1px solid #adadad;
        max-height: 490px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        max-width: 100%;
        /*width: auto;*/
        float: none;
        margin-top: 15px;
    }
</style>