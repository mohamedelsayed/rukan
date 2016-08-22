<div class="Albums form">
<?php echo $this->Form->create('Album', array('url'=>'edit' ,'type'=>'file', 'id' => 'album_form'));?>
<fieldset>
    <legend><?php __('Edit Album'); ?></legend>
    <div id="form">
		<?php 
		echo $this->Form->input('id');
        echo $this->Form->input('title', array("label" => $titleLabel, 'class'=>'ckeditor'));
		echo $this->Form->input('meta_keywords');
		echo $this->Form->input('meta_description');		
        echo $this->Form->input('approved')
        ?>
    </div>
    <div id="tapss">
        <ul class="tabs">
            <?php /*<li data-tab='tab1' class="current"><a>Contents</a></li>*/?>
            <li data-tab='tab2' class="current"><a>Images Gallery</a></li>
            <!--<li><a class="" href="#">Audios</a></li>
            <li><a class="" href="#">Videos</a></li>-->
        </ul>
        <div class="panes">
        	<!--Contents-->
            <?php /*<div class="tabdiv" id="tab1" style="display: block;">
                <?php echo $this->Form->input('header');?>
            </div>*/?>
            <!--Image Gallery-->
            <div class="tabdiv" id="tab2" style="display: block;">
                <?php include_once 'upload_images.php';?>
                 <?php
                //echo $this->Form->input('Gal.0.caption', array('value'=>'')); ?>
                <?php //echo $this->Form->input('Gal', array('type'=>'file', 'multiple' => 'multiple'));
                /*echo '<h3>'.__('Related Images', true).'</h3>';
                echo $this->element('backend/images_gallery_view', array('gallery' => $this->data['Gal']));
                ?>            
                <?php if(!empty($this->data['Gal']) && (count($this->data['Gal']) > 1)){?>
                    <div class="actions">
                        <ul>
                            <li style="width:140px;">
                                <?php echo $this->Html->link(__('Positioning of Images', true), array('controller'=> 'gals','action' => 'index',$this->data['Album']['id'],'Album'));?>   
                            </li>
                        </ul>
                    </div>
                <?php }*/?>
            </div>
            <!--Audio-->
            <?php /*<div>
            	<?php 
				echo $this->Form->input('Audio.0.title', array('value'=>''));
				echo $this->Form->input('Audio.0.header', array('value'=>''));
				echo $this->Form->input('Audio.0.file', array('type'=>'file', 'label'=>'MP3 Audio File'));
				echo '<h3>'.__('Related Audios', true).'</h3>';
				echo $this->element('backend/audios_gallery_view', array('gallery' => $this->data['Audio']));
				?>
            </div>         
            <!--Videos-->
            <div>                      
 				<?php 
            	echo $this->Form->input('Video.0.title', array('value'=>''));
				echo $this->Form->input('Video.0.header', array('value'=>''));
            	echo $this->Form->input('Video.0.image', array('type'=>'file', 'label'=>'Video Image'));
				echo $this->Form->input('Video.0.file', array('type'=>'file', 'label'=>'FLV Video File'));
				echo $this->Form->input('Video.0.url', array('value'=>'' ,'label'=>'If you did not upload a video, add tube URL like(http://www.anytube.com/?id=any)'));
				echo '<h3>'.__('Related Videos', true).'</h3>';
				echo $this->element('backend/videos_gallery_view', array('gallery' => $this->data['Video']));
				?>
				<?php /*if(!empty($this->data['Video'])){ ?>
	                 <div class="actions">
	                 	<ul>
	                 		<li style="width:140px;">
	                 			<?php echo $this->Html->link(__('Positioning of Videos', true), array('controller'=> 'videos','action' => 'index',$this->data['Album']['id'])); ?>   
	                 		</li>
	                 	</ul>
	                 </div>
                <?php }*/?>
            </div>
        </div>    
</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Album.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Album.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Albums', true), array('action' => 'index'));?></li>
	</ul>
</div>