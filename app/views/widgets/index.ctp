<div class="widgets index">
	<?php echo $this->element('backend/search_view',array('currentModel' => 'Widget', 'currentField' => 'title'));?>
	<h2><?php __('Widgets');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<?php /*<th><?php echo $this->Paginator->sort('title_ar');?></th>*/?>
			<th><?php echo $this->Paginator->sort('page_id');?></th>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($widgets as $widget):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $widget['Widget']['id']; ?>&nbsp;</td>
		<td><?php echo $widget['Widget']['title']; ?>&nbsp;</td>
		<?php /*<td><?php echo $widget['Widget']['title_ar']; ?>&nbsp;</td>*/?>		
		<td><?php echo $pages[$widget['Widget']['page_id']];?>&nbsp;</td>
		<td><?php if($widget['Widget']['approved'] == 1) echo 'Yes';
        elseif($widget['Widget']['approved'] == 0) echo 'No';?>&nbsp;</td> 
		<td><?php echo $widget['Widget']['created']; ?>&nbsp;</td>
		<td><?php echo $widget['Widget']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $widget['Widget']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $widget['Widget']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $widget['Widget']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $widget['Widget']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Widget', true), array('action' => 'add')); ?></li>
	</ul>
</div>