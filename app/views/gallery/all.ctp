<?php $tree = array(array('url' => '/page/show/6', 'str' => 'Media'),
array('url' => '', 'str' => 'Gallery'));
echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));
$page_limit = $limit; $page = 1;?>
<div id="tab-2" class="tab-content current" style="width: 100%;">
    <div class="tab-content_top" style="width: 100%;">
        <div class="top_con">
            <?php echo $this->element('front'.DS.'media_tabs', array('type' => 'gallery'));?> 
            <?php if($pages_count > 0){?>
            <div id="albums-listing" class="albums-listing"></div>
            <div class="bottom_till_big loadmorealbum_div">
                <a class="loadmorealbum" id="loadmorealbum" page="<?php echo $page;?>" limit="<?php echo $page_limit;?>" pagecount="<?php echo $pages_count;?>" >
                    <div class="bottom_till">More Gallery</div>
                    <img style="margin-top: 2px;" src="<?php echo $base_url.'/img/front/bottom_news.png';?>"/>
                </a>
                <a class="ajaxloadingloadmorealbum"></a>
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
        jQuery('#loadmorealbum').click(function(){
            var page = $(this).attr("page");
            var limit = $(this).attr("limit");
            var nextpage = parseInt(page) + 1;
            var pagecount = $(this).attr("pagecount");
            var loadmorealbumbutton = $(this);
            $.ajax({
                type: "POST",
                url: siteUrl+'/gallery/list_albums',
                data: {page:page,limit:limit,},
                beforeSend: function() {
                    jQuery('.ajaxloadingloadmorealbum').show();                    
                    loadmorealbumbutton.hide();
                    //loadmorealbumbutton.addClass("ajaxloading");
                },
                success: function(result) {
                    jQuery('.ajaxloadingloadmorealbum').hide();                      
                    //loadmorealbumbutton.removeClass("ajaxloading");
                    jQuery("#albums-listing").append(result);                
                    if(parseInt(nextpage) <= parseInt(pagecount)){
                        loadmorealbumbutton.show();
                        loadmorealbumbutton.attr("page", nextpage)
                    }else{
                        loadmorealbumbutton.hide();
                    }
                }
            });
        });
    });
    jQuery(document).ready(function() {
        jQuery("#loadmorealbum").click();
    }); 
    </script>
<?php }?>