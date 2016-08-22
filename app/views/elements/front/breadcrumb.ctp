<?php if(!empty($tree)){?>
    <ul class="tabs2">
        <?php $show_home = 1;
        if(isset($hide_home)){
            if($hide_home == 1){
                $show_home = 0;
            }
        }?>
        <?php if($show_home == 1){?>
            <li class="tab2-link" style="margin-top: 0px;">
                <a href="<?php echo $base_url;?>">
                    <img src="<?php echo $base_url.'/img/front/pic_home.png';?>"/>
                </a>
            </li>
        <?php }?>
		<?php foreach ($tree as $key => $value) {
		    $href = '';
		    if(isset($value['url'])){
		        if(trim($value['url']) != ''){
		            $href = 'href="'.$base_url.$value['url'].'"';
                }
            }
            $str = '';
            if(isset($value['str'])){
                if(trim($value['str']) != ''){
                    $str = '/ '.$value['str'];
                }
            }
            if($str != ''){?>
    			<li class="tab2-link">
    			    <a <?php echo $href;?>>
    			        <?php echo $str;?>
			        </a>
		        </li>
			<?php }?>
		<?php }?>
    </ul>
<?php }?>