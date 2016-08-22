<?php if(!empty($item)){
    $item_id = $item[$model]['id']; 
    $image = '';
    if(isset($item[$model]['image'])){
    	$image = $base_url.'/img/upload/'.$item[$model]['image'];
    }
    $title = '';
    if($item[$model]['title'] != ''){
    	$title = $item[$model]['title'];
    }
    $body = '';
    if($item[$model]['body'] != ''){
    	$body = $item[$model]['body'];
    }
    $tree = array(array('url' => '/page/show/9', 'str' => $parent_title),
    array('url' => $child_url, 'str' => $child_title));
    echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));?>
    <div id="tab-2" class="tab-content current">
        <div class="tab-content_top">
            <div class="top_con">
                <div class="top_con_2"><?php echo $child_title;?></div>
                <div class="news2_groub" style="width: 100%;margin-right: 0px;margin-bottom: 56px;">
                    <div class="news2_groub_img" style="margin-left: 5%;float: right;">
                        <a><img src="<?php echo $image;?>"/></a>
                    </div>
                    <div class="adders_news" style="width: 50%;"><?php echo $title;?></div>
                    <div class="adders_news" style="width: 50%;font-size: 20px;color: #f5851f;margin-bottom: 5px;"><?php echo $item[$model]['sub_title'];?></div>
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