<h2>
	<?php echo "Search:";?>
</h2>
<div style="width: 350px;">
	<?php echo $this->Form->create($currentModel, array('action'=>'index'));
	echo $this->Form->input($currentModel.'.'.$currentField, array('type' => 'text'));
	echo $this->Form->end(__('Search', true));
	?>
</div>
<style type="text/css">
    form .required label::after{
        content: '';
    }
</style>