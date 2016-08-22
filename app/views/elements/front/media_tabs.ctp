<div class="top_con_2">Media</div> 
<div class="student_life_tabs">
    <ul class="tabs3">
        <?php $class = '';
        $href = 'href="'.$base_url.'/article/all/"';
        if($type == 'article'){
            $class = ' current';
            $href = '';
        }?>
        <li class="tab3-link <?php echo $class;?>">
            <a <?php echo $href;?>>
                News
            </a>
        </li>
        <?php $class = '';
        $href = 'href="'.$base_url.'/gallery/all"';
        if($type == 'gallery'){
            $class = ' current';
            $href = '';
        }?>
        <li class="tab3-link <?php echo $class;?>">
            <a <?php echo $href;?>>
                Gallery
            </a>
        </li>
    </ul>
</div>
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