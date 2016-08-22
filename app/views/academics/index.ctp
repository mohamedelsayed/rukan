<div class="academics index">
	<?php echo $this->element('backend/search_view',array('currentModel' => 'Academic', 'currentField' => 'title'));?>
	<h2><?php __('Academics');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>			
			<?php /*<th><?php echo $this->Paginator->sort('title_ar');?></th>*/?>
			<th><?php echo $this->Paginator->sort('tab_title');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($academics as $academic):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $academic['Academic']['id']; ?>&nbsp;</td>		
		<?php /*<td><?php echo $academic['Academic']['title_ar']; ?>&nbsp;</td>*/?>		
		<td><?php echo $academic['Academic']['tab_title'];?>&nbsp;</td>
		<td><?php echo $academic['Academic']['title']; ?>&nbsp;</td>
		<td><?php if($academic['Academic']['approved'] == 1) echo 'Yes';
        elseif($academic['Academic']['approved'] == 0) echo 'No';?>&nbsp;</td> 
		<td><?php echo $academic['Academic']['created']; ?>&nbsp;</td>
		<td><?php echo $academic['Academic']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $academic['Academic']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $academic['Academic']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $academic['Academic']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $academic['Academic']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Academic', true), array('action' => 'add')); ?></li>
	</ul>
</div>