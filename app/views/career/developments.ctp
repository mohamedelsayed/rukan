<?php $tree = array(array('url' => '/page/show/9', 'str' => $parent_title),
array('url' => '', 'str' => $title));
echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));
$page_limit = $limit; $page = 1;?>
<div id="tab-2" class="tab-content current" style="width: 100%;">
    <div class="tab-content_top" style="width: 100%;">
        <div class="top_con">
            <div class="top_con_2"><?php echo $title;?></div>  
            <?php if($pages_count > 0){?>
            <div id="items-listing" class="items-listing"></div>
            <div class="bottom_till_big" style="margin-bottom:20px;">
                <a class="loadmoreitem" id="loadmoreitem" page="<?php echo $page;?>" limit="<?php echo $page_limit;?>" pagecount="<?php echo $pages_count;?>" >
                    <div class="bottom_till">More</div>
                    <img style="margin-top: -4px;" src="<?php echo $base_url.'/img/front/bottom_news.png';?>"/>
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
<style type="text/css">
    .bottm_img{
        padding-left: 10px;
        width: 420px;
    }
    .bottm_reed a{
        color: #0d9f49;
        text-decoration: none;        
    }
    .bottm_reed a:hover{
        text-decoration: none;        
    }
</style>