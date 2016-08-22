<div class="Albums form">
<?php echo $this->Form->create('Album', array('url'=>'add' ,'type'=>'file', 'id' => 'album_form'));?>
<fieldset>
    <legend><?php __('Add Album'); ?></legend>
    <div id="form">
		<?php 
		echo $this->Form->input('Album.title', array('class'=>'ckeditor'));
		echo $this->Form->input('meta_keywords');
		echo $this->Form->input('meta_description');
        echo $this->Form->input('approved')
        ?>
    </div>
    <div id="tapss">
        <ul class="tabs">
            <li data-tab='tab2' class="current"><a>Images Gallery</a></li>
            <li data-tab='tab1'><a>Contents</a></li>
            <!--<li><a class="" href="#">Audios</a></li>
            <li><a class="" href="#">Videos</a></li>-->
        </ul>
        <div class="panes">
            <!--Image Gallery-->
            <div class="tabdiv" id="tab2" style="display: block;">
                <?php include_once 'upload_images.php';?>
            	<?php
            	//echo $this->Form->input('Gal.0.caption'); ?>            	                
            	<?php //echo $this->Form->input('Gal.0.image.', array('type'=>'file', 'multiple'));
            	?>
            </div>
            <!--Content-->
            <div class="tabdiv" id="tab1">
                <?php echo $this->Form->input('header');?>
            </div>
            <?php /*<!--Audio-->
            <div>
            	<?php 
				echo $this->Form->input('Audio.0.title');
				echo $this->Form->input('Audio.0.header');
				echo $this->Form->input('Audio.0.file', array('type'=>'file', 'label'=>'MP3 Audio File'));
				?>
            </div>
            <!--Video-->
            <div>
            	<?php 
				echo $this->Form->input('Video.0.title');
				echo $this->Form->input('Video.0.header');
				echo $this->Form->input('Video.0.image', array('type'=>'file', 'label'=>'Video Image'));
				echo $this->Form->input('Video.0.file', array('type'=>'file', 'label'=>'FLV Video File'));
				echo $this->Form->input('Video.0.url', array('label'=>'If you did not upload a video, add tube URL like(http://www.anytube.com/?id=any)'));
				?>
            </div>*/?>
        </div>
    </div>
</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Albums', true), array('action' => 'index'));?></li>
	</ul>
</div>