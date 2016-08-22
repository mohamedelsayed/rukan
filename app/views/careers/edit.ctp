<div class="careers form">
<?php echo $this->Form->create('Career', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Career Vacancy'); ?></legend>
	<?php
		echo $this->Form->input('id');
        echo $this->Form->input('title', array("label" => $titleLabel));
        //echo $this->Form->input('title_ar', array("label" => $titleLabel));
        echo $this->Form->input('Career.description', array('class'=>'ckeditor'));
        //echo $this->Form->input('Career.description_ar', array('class'=>'ckeditor'));
        echo $this->Form->input('to_email');
        echo $this->Form->input('weight');		
		echo $this->Form->input('approved');		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Career.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Career.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Careers Vacancies', true), array('action' => 'index'));?></li>
	</ul>
</div>