<div class="articles index">
    <?php echo $this->element('backend/search_view',array('currentModel' => 'Article', 'currentField' => 'title'));?>
	<h2><?php __('Articles');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
        <th><?php echo $this->Paginator->sort('id');?></th>
        <th><?php echo $this->Paginator->sort('title');?></th>
        <?php /*<th><?php echo $this->Paginator->sort('title_ar');?></th>*/?>
        <th><?php echo $this->Paginator->sort('date');?></th>
        <?php /*<th><?php echo $this->Paginator->sort('home');?></th>
        <th><?php echo $this->Paginator->sort('subject_id');?></th>*/?>
        <th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($articles as $article):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $article['Article']['id']; ?>&nbsp;</td>
		<td><?php echo $article['Article']['title']; ?>&nbsp;</td>
		<?php /*<td><?php echo $article['Article']['title_ar']; ?>&nbsp;</td>*/?>
		<td><?php echo $article['Article']['date']; ?>&nbsp;</td>
		<?php /*<td><?php echo $article['Article']['home']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($article['Subject']['title'], array('controller' => 'subjects', 'action' => 'view', $article['Subject']['id'])); ?>
		</td>*/?>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $article['Article']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $article['Article']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $article['Article']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $article['Article']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Article', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Comments', true), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment', true), array('controller' => 'comments', 'action' => 'add')); ?> </li>
	</ul>
</div>