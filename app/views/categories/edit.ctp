<div class="cats form">
<?php echo $this->Form->create('Category', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Event Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title', array("label" => 'Title'));
        echo $this->Form->input('color', array('class' => 'simple_color'));
		echo $this->Form->input('weight');
		echo $this->Form->input('approved');			
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Cat.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Cat.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Event Categories', true), array('action' => 'index'));?></li>
	</ul>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('.simple_color').simpleColor();
});
</script>