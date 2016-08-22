<div class="events form">
<?php echo $this->Form->create('Event', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Event'); ?></legend>
	<?php
		echo $this->Form->input('id');
        echo $this->Form->input('title', array("label" => $titleLabel, 'class'=>'ckeditor'));
        echo $this->Form->input('from_date');
        echo $this->Form->input('to_date');
        echo $this->Form->input('timing');
        echo $this->Form->input('location');
        echo $this->Form->input('Event.agenda', array('class'=>'ckeditor'));
        //echo $this->Form->input('Event.body_ar', array('class'=>'ckeditor'));
        echo $this->Form->input('category_id');
        echo $this->Form->input('approved');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Event.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Event.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Events', true), array('action' => 'index'));?></li>
	</ul>
</div>
<?php include_once 'js.php';?>