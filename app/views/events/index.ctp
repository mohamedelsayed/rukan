<div class="events index">
	<?php //echo $this->element('backend/search_view',array('currentModel' => 'Event', 'currentField' => 'title'));?>
	<h2>
    <?php echo "Search:";?>
    </h2>
    <div style="width: 350px;">
        <?php $currentModel = 'Event';
        $currentField = 'title';
        $months_options = array();
        $months_options[0] = 'All';
        for($m = 1;$m <= 12; $m++){
            $month =  date("F", mktime(0, 0, 0, $m));
            $months_options[$m] = $month;
        }
        $years_options = array();
        $years_options[0] = 'All';
        $minYearValue = date("Y") - 10;
        $maxYearValue = date("Y") + 10;
        for ($i = $minYearValue; $i <= $maxYearValue; $i++) {
            $years_options[$i] =$i;
        }
        $year = isset($_GET['year'])?$_GET['year']:0;
        $month = isset($_GET['month'])?$_GET['month']:0;
        echo $this->Form->create($currentModel, array('action'=>'index', 'type' => 'get'));
        echo $this->Form->input($currentModel.'.'.$currentField, array('type' => 'text'));
        //echo $this->Form->input($currentModel.'.from_date', array('type' => 'date', 'dateFormat' => 'MY'));
        echo $this->Form->input('month', array('type' => 'select', 'options' => $months_options, 'default' => $month));
        echo $this->Form->input('year', array('type' => 'select', 'options' => $years_options, 'default' => $year));
        echo $this->Form->end(__('Search', true));
        ?>
    </div>
    <style type="text/css">
        form .required label::after{
            content: '';
        }
    </style>
	<h2><?php __('Events');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<?php /*<th><?php echo $this->Paginator->sort('id');?></th>*/?>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('from_date');?></th>
			<th><?php echo $this->Paginator->sort('to_date');?></th>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<?php /*<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>*/?>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($events as $event):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<?php /*<td><?php echo $event['Event']['id']; ?>&nbsp;</td>*/?>
		<td><?php echo strip_tags($event['Event']['title']);?>&nbsp;</td>
		<td><?php echo date('d-m-Y', strtotime($event['Event']['from_date'])); ?>&nbsp;</td>
		<td><?php echo date('d-m-Y', strtotime($event['Event']['to_date'])); ?>&nbsp;</td>	
		<td><?php if($event['Event']['approved'] == 1) echo 'Yes';
        elseif($event['Event']['approved'] == 0) echo 'No';?>&nbsp;</td> 
		<?php /*<td><?php echo $event['Event']['created']; ?>&nbsp;</td>
		<td><?php echo $event['Event']['updated']; ?>&nbsp;</td>*/?>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $event['Event']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $event['Event']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $event['Event']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $event['Event']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>
	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Event', true), array('action' => 'add')); ?></li>
	</ul>
</div>