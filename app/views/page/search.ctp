<?php echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));?>
<div id="tab-2" class="tab-content current" style="width: 100%;">
    <div class="tab-content_top" style="width: 100%;min-height: 250px;">
        <div class="top_con">
            <div style="" class="top_con_2"><?php echo $title_for_layout;?></div>            
            <div class="page_body_div">
                <?php if(!empty($all_data)){    
                    foreach ($all_data as $key => $value) {
                        reset($value);
                        $first_key = key($value);
                        $href = '';
                        if(in_array($first_key, $all_tables)){
                            $data = $value[$first_key];
                            if($first_key == $all_tables[0]){
                                $href = 'href="'.$base_url.'/page/show/1/16"';
                            }elseif($first_key == $all_tables[1]){
                                $href = 'href="'.$base_url.'/page/show/'.$data['id'].'"';
                                if($data['parent_id'] != 0 && $data['parent_id'] != ''){
                                    $href = 'href="'.$base_url.'/page/show/'.$data['parent_id'].'/'.$data['id'].'"';
                                }
                            }elseif($first_key == $all_tables[2]){
                                $href = 'href="'.$base_url.'/career/all/vacancies"';
                            }elseif($first_key == $all_tables[3]){
                                $href = 'onclick=\'open_event("'.$data['id'].'");\'';
                            }elseif($first_key == $all_tables[4]){
                                $href = 'href="'.$base_url.'/career/item/'.$data['id'].'"';
                            }elseif($first_key == $all_tables[5]){
                                $href = 'href="'.$base_url.'/article/item/'.$data['id'].'"';
                            }elseif($first_key == $all_tables[6]){
                                $href = 'href="'.$base_url.'/page/academic/'.$data['id'].'"';
                            }elseif($first_key == $all_tables[7]){
                                $href = 'href="'.$base_url.'/gallery/item/'.$data['id'].'"';
                            }elseif($first_key == $all_tables[8]){
                                $href = 'href="'.$base_url.'/page/show/1/19"';
                            }elseif($first_key == $all_tables[9]){
                                $href = 'href="'.$base_url.'/page/show/1/14/"';
                            }                            
                            $title = '';
                            if(isset($data['title'])){
                                $title = $data['title'];
                            }elseif(isset($data['name'])){
                                $title = $data['name'];
                            }  
                            $body = '';                          
                            if(isset($data['body'])){
                                $body = $data['body'];
                            }elseif(isset($data['description'])){
                                $body = $data['description'];
                            }elseif(isset($data['agenda'])){
                                $body = $data['agenda'];
                            }elseif(isset($data['biography'])){
                                $body = $data['biography'];
                            }?>
                            <div>                            
                                <div class="adders_news">
                                    <a style="cursor: pointer;" <?php echo $href;?>><?php echo strip_tags($title);?></a>
                                    </div>
                                <div class="data_smill">
                                    <?php $body = $this->element('front'.DS.'remove_unneeded_tags_from_string', array('string' => $body));
                                    $body = $this->element('front'.DS.'string_format_view', array('str' => $body, 'val' => 100, 'type' => 'wordsCut'));?>
                                    <?php echo $body;?>
                                </div>
                            </div>                        
                        <?php }
                    }
                }?>
            </div>            
        </div>
    </div>
</div>