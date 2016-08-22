<div class="categories form">
<?php echo $this->Form->create('Category', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Event Category'); ?></legend>
	<?php
		echo $this->Form->input('title', array("label" => 'Title'));
		echo $this->Form->input('color', array('class' => 'simple_color', 'default' => '#000000'));
		echo $this->Form->input('weight', array('default'=>0));
		echo $this->Form->input('approved');	
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Event Categories', true), array('action' => 'index'));?></li>		
	</ul>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('.simple_color').simpleColor();
});
</script>