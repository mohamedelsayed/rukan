<footer class="bottom_grop">
    <div class="main-footer">
        <div class="top_grop">
            <div class="adders_grop">
                <img src="<?php echo $base_url.'/img/front/ethos_footer_logo.png';?>" />
            </div>
            <?php /*<div class="top_grop" style="margin-bottom: 10px;">
                <div class="newsletter_footer_div">
                <?php echo $this->Javascript->link('front/ajax/newsletter'); ?>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#send_form").click(function(){           
                                sendForm('<?php echo BASE_URL;?>');                
                            });             
                        });
                    </script>
                    <?php echo $this->Form->create('newsletter', array('id' => 'newsletterForm'));?>  
                    <div class="input_2">
                        <input style="height: 35px;" name="data[newsletter][email]" class="inpu_lce" type="text" id="email" name="email" placeholder="Subscribe to our newsletter." />
                    </div>
                    <div class="Suche_2">
                        <input style="height: 39px;color: #414141;cursor: pointer;" class="Suche_a" type="button" value="Subscribe" id="send_form" style="cursor: pointer;background-color: #f5851f;color: #414141;">
                    </div>
                    <div class="ajax_result_adv" style="float: left;width: 100%;">        
                        <div id="newsletter_ajaxLoading"></div>
                        <div id="newsletter_Result" style="color: #FFFFFF;text-align: center;float: left;width:100%;margin-top: 5px;font-size: 20px;font-weight: normal;" ></div>
                    </div>
                    <?php echo $this->Form->end(__('', true,array('class' => '')));?>
                </div>
            </div>*/?>
            <div class="menu_grop">
                <div class="footer_menu">
                    <a href="<?php echo $base_url;?>"><?php echo $setting['home_string'];?></a>
                    <?php if(!empty($header_cats)){
                        foreach ($header_cats as $key => $header_cat) {
                            $url = $base_url.'/page/show/'.$header_cat['Cat']['id'];
                            $additional_code = '';
                            if($header_cat['Cat']['has_url'] == 1){
                                if (strpos($header_cat['Cat']['url'], 'http') !== FALSE) {
                                    $url = $header_cat['Cat']['url'];
                                    $additional_code = ' target="_blank" ';
                                }else{
                                    $url = $base_url.$header_cat['Cat']['url'];
                                }
                            }?>
                            <a href="<?php echo $url;?>" <?php echo $additional_code;?>>
                                <?php echo $header_cat['Cat']['title'];?>
                            </a>
                        <?php }?>
                    <?php }?>
                </div>
            </div>
            <div class="adders_face_s">
                <a target="_blank" href="<?php echo $setting['facbook_link'];?>">
                    <img class="facbook_link_footer" src="<?php echo $base_url.'/img/front/ethos_footer_facebook.png';?>" />
                </a>
                <a target="_blank" href="<?php echo $setting['twitter_link'];?>">
                    <img class="twitter_link_footer" src="<?php echo $base_url.'/img/front/ethos_footer_twiter.png';?>" />
                </a>
                <a target="_blank" href="<?php echo $setting['google_plus_link'];?>">
                    <img class="google_plus_link_footer" src="<?php echo $base_url.'/img/front/ethos_footer_google.png';?>" />
                </a>
            </div>
            <div class="left_bot">
                <?php echo $setting['footer'];?>
            </div>
            <div class="footer_accreditation">
                <img style="float: left;margin-left: 100px;" src="<?php echo $base_url;?>/app/webroot/img/ckeditor/british-council-logo-2-color-2-page-001-hr.jpg" alt="">
                <img style="float: right;margin-right: 100px;" src="<?php echo $base_url;?>/app/webroot/img/ckeditor/logo-cie.jpg" alt="">
            </div>
        </div>     
    </div>   
</footer>
<div id="Developer">
    Developed by <a href="http://www.mohamedelsayed.net" target="_blank">Mohamed Elsayed</a>
</div>