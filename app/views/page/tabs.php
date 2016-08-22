<?php if(isset($cats)){?>
    <?php if(!empty($cats)){?>
        <div class="student_life_tabs">
            <ul class="tabs3">
                <?php foreach ($cats as $key => $value) {
                    $class = '';
                    $href = 'href="'.$base_url.'/page/show/'.$value['Cat']['parent_id'].'/'.$value['Cat']['id'].'"';
                    $additional_code = '';
                    if($value['Cat']['has_url'] == 1){
                        if (strpos($value['Cat']['url'], 'http') !== FALSE) {
                            $href = 'href="'.$value['Cat']['url'].'"';
                            $additional_code = ' target="_blank" ';
                        }else{
                            $href = 'href="'.$base_url.$value['Cat']['url'].'"';
                        }
                    }
                    if($childid == $value['Cat']['id']){
                        $class = ' current';
                        $href = '';
                    }?>
                    <li class="tab3-link <?php echo $class;?>">
                        <a <?php echo $href;?> <?php echo $additional_code;?>>
                            <?php echo $value['Cat']['title'];?>
                        </a>
                    </li>
                <?php }?>
            </ul>
        </div>
    <?php }?>
<?php }?>
<style type="text/css">
.student_life_tabs{
    float: left;
    width: 100%;
}
ul.tabs3{
    margin: 10px 0;
    border-bottom: 0px;
    display:table;
    background: none;
    width: 100%;
    padding-left: 0px;
}
ul.tabs3 li{
    border-bottom: 2px solid #0d9f49;
    /*background-color: #d6d6d6;*/
    padding: 0px;
    float: none; 
    display: table-cell;   
}
ul.tabs3 li a{
    text-align:center;
    display: block;
    padding: 10px;
}
ul.tabs3 li.current a{
    color: #ffffff;
    cursor: default;
    background-color: #0d9f49;
}
.tab3-link a{
    text-decoration: none;
    color: #414141;
}
</style>