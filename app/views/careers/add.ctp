<div class="careers form">
<?php echo $this->Form->create('Career', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Career Vacancy'); ?></legend>
	<?php
		echo $this->Form->input('title', array("label" => $titleLabel));
        //echo $this->Form->input('title_ar', array("label" => $titleLabel));
		echo $this->Form->input('Career.description', array('class'=>'ckeditor'));
        //echo $this->Form->input('Career.description_ar', array('class'=>'ckeditor'));
        echo $this->Form->input('to_email');
        echo $this->Form->input('weight', array('default'=>0));
		echo $this->Form->input('approved');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Careers Vacancies', true), array('action' => 'index'));?></li>	
	</ul>
</div>