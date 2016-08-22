<div class="developments form">
<?php echo $this->Form->create('Development', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Development'); ?></legend>
	<?php
		echo $this->Form->input('title', array("label" => $titleLabel));
        echo $this->Form->input('sub_title');
        //echo $this->Form->input('title_ar', array("label" => $titleLabel));
		echo $this->Form->input('Development.body', array('class'=>'ckeditor'));
        //echo $this->Form->input('Development.body_ar', array('class'=>'ckeditor'));
		echo $form->input('image', array('type'=>'file', 'label'=>'Image'));
        echo $this->Form->input('weight', array('default'=>0));
		echo $this->Form->input('approved');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Developments', true), array('action' => 'index'));?></li>	
	</ul>
</div>