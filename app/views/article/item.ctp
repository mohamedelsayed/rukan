<?php if(!empty($article)){
    $article_id = $article['Article']['id']; 
    $article_link = $base_url.'/article/item/'.$article_id;
    $article_date = date('F d, Y', strtotime($article['Article']['date'])); 
    $image = '';
	$image_path = '';
    if(isset($article['Gal'])){
    	$image = $base_url.'/img/upload/'.$article['Gal'][0]['image'];
		$image_path = WWW_ROOT.'img'.DS.'upload'.DS.$article['Gal'][0]['image'];
    }
    $resize->smartResizeImage($article['Gal'][0]['image']);
	if(file_exists($image_path)){   
	}else{
		$image = DEFAULT_IMAGE;
	}
    $title = '';
    if($article['Article']['title'] != ''){
    	$title = $article['Article']['title'];
    }
    $header = '';
    if($article['Article']['header'] != ''){
    	$header = $article['Article']['header'];
    }
    $body = '';
    if($article['Article']['body'] != ''){
    	$body = $article['Article']['body'];
    }?>
    <?php $tree = array(array('url' => '/page/show/6', 'str' => 'Media'),
    array('url' => '/article/all', 'str' => 'News'));
    echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));?>
    <div id="tab-2" class="tab-content current" style="width: 100%;">
        <div class="tab-content_top" style="width: 100%;">
            <div class="top_con">
                <?php echo $this->element('front'.DS.'media_tabs', array('type' => 'article'));?> 
                <div class="news2_groub" style="width: 100%;margin-right: 0px;margin-bottom: 56px;">
                    <div class="news2_groub_img" style="margin-left: 5%;float: right;">
                        <a><img src="<?php echo $image;?>"/></a>
                    </div>
                    <div class="adders_news" style="width: 50%;"><?php echo $title;?></div>
                    <div style="margin-bottom: 3%;width: 50%;" class="date_big">
                        <div class="date">
                            <a><img src="<?php echo $base_url.'/img/front/';?>data.png"/></a>
                        </div>
                        <div class="date_witer"><?php echo $article_date;?></div>
                    </div>
                    <div class="data_smill" style="float: none;">
                        <?php echo $body;?>
                    </div>                    
                </div>                
            </div>
        </div>
    </div>
<?php }else{?>
    <div class="no-data-found">No data found.</div>
<?php }?>
<style type="text/css">
    .date{
        float: left;
        width: 6%;
    }
    .date_witer{
        float: left;
        width: 94%;
    }
</style>