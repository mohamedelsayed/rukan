<script src="<?php echo $base_url;?>/sliderengine/amazingslider.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>/sliderengine/amazingslider-1.css">
<script src="<?php echo $base_url;?>/sliderengine/initslider-1.js"></script>        
<?php if(!empty($album)){
    $album_id = $album['Album']['id']; 
    $album_link = $base_url.'/album/item/'.$album_id;
    $title = '';
    if($album['Album']['title'] != ''){
    	$title = $album['Album']['title'];
    }
    $header = '';
    if($album['Album']['header'] != ''){
    	$header = $album['Album']['header'];
    }?>
    <?php $tree = array(array('url' => '/page/show/6', 'str' => 'Media'),
    array('url' => '/gallery/all', 'str' => 'Gallery'));
    echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));?>
    <div id="tab-2" class="tab-content current">
        <div class="tab-content_top">
            <div class="top_con">
                <?php echo $this->element('front'.DS.'media_tabs', array('type' => 'gallery'));?>
                <div style="width: 100%; margin-bottom: 30px;" class="adders_news"><?php echo $title;?></div>                
                <?php if(!empty($album['Gal'])){?>
                    <div class="slide_galary">
                        <div id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:960px;margin:0px auto 88px;">
                            <div id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
                                <ul class="amazingslider-slides" style="display:none;">
                                    <?php foreach ($album['Gal'] as $key => $value) {
                                        $resize->smartResizeImage($value['image']);
                                        $image = $base_url.'/img/upload/'.$value['image'];?>
                                        <li>
                                            <img src="<?php echo $image;?>" alt=""  title="" />
                                        </li>
                                    <?php }?>
                                </ul>
                                <ul class="amazingslider-thumbnails" style="display:none;">
                                    <?php foreach ($album['Gal'] as $key => $value) {
                                        $image = $base_url.'/img/upload/'.$value['image'];?>
                                        <li>
                                            <img src="<?php echo $image;?>" alt="" title="" />
                                        </li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                    </div>      
                <?php }?>      
            </div>
        </div>
    </div>
<?php }else{?>
    <div class="no-data-found">No data found.</div>
<?php }?>
<script type="text/javascript">
jQuery(document).ready(function(){
    hideamazingsliderdiv();
});
function hideamazingsliderdiv () {
    jQuery('a').each(function(){ 
        var hrefcode = 'http://amazingslider.com';
        var hrefdata = this.href;
        if(this.href.indexOf(hrefcode) !== -1){
            $(this).parent('div').hide();            
        }
    });
}
</script>