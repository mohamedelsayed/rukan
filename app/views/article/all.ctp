<?php $tree = array(array('url' => '/page/show/6', 'str' => 'Media'),
array('url' => '', 'str' => 'News'));
echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));
$page_limit = $limit; $page = 1;?>
<div id="tab-2" class="tab-content current" style="width: 100%;">
    <div class="tab-content_top" style="width: 100%;">
        <div class="top_con">            
            <?php echo $this->element('front'.DS.'media_tabs', array('type' => 'article'));?> 
            <?php if($pages_count > 0){?>
            <div id="articles-listing" class="articles-listing"></div>
            <div class="bottom_till_big">
                <a class="loadmorearticle" id="loadmorearticle" page="<?php echo $page;?>" limit="<?php echo $page_limit;?>" pagecount="<?php echo $pages_count;?>" >
                    <div class="bottom_till">More News</div>
                    <img style="margin-top: 2px;" src="<?php echo $base_url.'/img/front/bottom_news.png';?>"/>
                </a>
                <a class="ajaxloadingloadmorearticle"></a>
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
        jQuery('#loadmorearticle').click(function(){
            var page = $(this).attr("page");
            var limit = $(this).attr("limit");
            var nextpage = parseInt(page) + 1;
            var pagecount = $(this).attr("pagecount");
            var loadmorearticlebutton = $(this);
            $.ajax({
                type: "POST",
                url: siteUrl+'/article/list_articles',
                data: {page:page,limit:limit,},
                beforeSend: function() {
                    jQuery('.ajaxloadingloadmorearticle').show();                    
                    loadmorearticlebutton.hide();
                    //loadmorearticlebutton.addClass("ajaxloading");
                },
                success: function(result) {
                    jQuery('.ajaxloadingloadmorearticle').hide();                      
                    //loadmorearticlebutton.removeClass("ajaxloading");
                    jQuery("#articles-listing").append(result);                
                    if(parseInt(nextpage) <= parseInt(pagecount)){
                        loadmorearticlebutton.show();
                        loadmorearticlebutton.attr("page", nextpage)
                    }else{
                        loadmorearticlebutton.hide();
                    }
                }
            });
        });
    });
    jQuery(document).ready(function() {
        jQuery("#loadmorearticle").click();
    }); 
    </script>
<?php }?>
<style type="text/css">
    .news_groub{
        height: 420px;
       overflow: hidden
    }
    .date{
        float: left;
        width: 6%;
    }
    .date_witer{
        float: left;
        width: 94%;
    }
    .data_reed{
        float: right;
    }
</style>