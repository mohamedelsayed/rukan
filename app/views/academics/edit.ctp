<div class="academics form">
<?php echo $this->Form->create('Academic', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Academic'); ?></legend>
	<?php
		echo $this->Form->input('id');
        echo $this->Form->input('tab_title');
        echo $this->Form->input('title', array("label" => $titleLabel));
        //echo $this->Form->input('title_ar', array("label" => $titleLabel));
        echo $this->Form->input('Academic.body', array('class'=>'ckeditor'));
        //echo $this->Form->input('Academic.body_ar', array('class'=>'ckeditor'));
		echo $this->element('backend/image_view', array('image'=>array('id'=>$this->data['Academic']['id'], 'image'=>$this->data['Academic']['image']), 'size'=>'master'));
		echo $form->input('image', array('type'=>'file', 'label'=>'Image'));
		//echo $this->Form->input('page_id',array('empty'=>''));
		echo $this->Form->input('approved');		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Academic.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Academic.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Academics', true), array('action' => 'index'));?></li>
	</ul>
</div>