<?php if(!empty($events)){?>
    <div class="write_top"><?php echo __('EVENTS', true);?></div>
    <div class="data_comp1">
        <?php $i = 0;
        foreach ($events as $key => $event) {
            $date = $event['Event']['from_date'];
            $month = date('M', strtotime($date));
            $day = date('d', strtotime($date));
            if(isset($agendas[$event['Event']['id']])){
                $agenda = $agendas[$event['Event']['id']];
            }else{
                $agenda = $event['Event']['agenda'];                
            }
            $float = '';
            if($i % 2 == 1){
                $float = 'float:right';                
            }
            $i++;?>
            <div class="data_compaic" style="margin-left: 3%;width: 40%;<?php echo $float;?>">
                <div class="data" style="font-size: 34px;line-height: 34px;padding-bottom: 20px;height: auto;width: 60px;">
                    <a style="cursor: pointer;" onclick="open_event('<?php echo $event['Event']['id'];?>');">
                        <?php echo $month;?><br style="font-size: 60.78px;"><b><?php echo $day;?></b>
                    </a>
                </div>
                <div class="data_write">
                    <a style="cursor: pointer;" onclick="open_event('<?php echo $event['Event']['id'];?>');">
                        <?php echo strip_tags($event['Event']['title']);?>
                    </a>
                </div>
                <div class="event_home_category">Category:
                    <?php echo $event['Category']['title'];?>
                </div>
                <?php /*<div class="wret_data">
                    <?php $agenda = $this->element('front'.DS.'remove_unneeded_tags_from_string', array('string' => $agenda));
                    $agenda = $this->element('front'.DS.'string_format_view', array('str' => $agenda, 'val' => 14, 'type' => 'wordsCut'));
                    echo $agenda;?>
                </div>*/?>
            </div>
        <?php }?>
    </div>
    <div class="more_events_button_out">
        <a href="<?php echo $base_url.'/calendar';?>">
            <div class="more_events_button white_green_button">
                <?php echo __('More Events', true);?>
            </div>
        </a>
    </div>
<?php }?>