<div class="careers index">
	<?php echo $this->element('backend/search_view',array('currentModel' => 'Career', 'currentField' => 'title'));?>
	<h2><?php __('Careers Vacancies');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort($titleLabel, 'title');?></th>
			<th><?php echo $this->Paginator->sort('weight');?></th>
			<?php /*<th><?php echo $this->Paginator->sort('title_ar');?></th>
			<th><?php echo $this->Paginator->sort('page_id');?></th>*/?>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($careers as $career):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $career['Career']['id']; ?>&nbsp;</td>
		<td><?php echo $career['Career']['title']; ?>&nbsp;</td>
		<td><?php echo $career['Career']['weight']; ?>&nbsp;</td>
		<?php /*<td><?php echo $career['Career']['title_ar']; ?>&nbsp;</td>		
		<td><?php echo $pages[$career['Career']['page_id']];?>&nbsp;</td>*/?>
		<td><?php if($career['Career']['approved'] == 1) echo 'Yes';
        elseif($career['Career']['approved'] == 0) echo 'No';?>&nbsp;</td> 
		<td><?php echo $career['Career']['created']; ?>&nbsp;</td>
		<td><?php echo $career['Career']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $career['Career']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $career['Career']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $career['Career']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $career['Career']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Career Vacancy', true), array('action' => 'add')); ?></li>
	</ul>
</div>