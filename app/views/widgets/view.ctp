<div class="widgets view">
<h2><?php  __('Widget');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $widget['Widget']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $widget['Widget']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Body'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $widget['Widget']['body']; ?>
			&nbsp;
		</dd>	
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Page'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		  <?php echo $pages[$widget['Widget']['page_id']];?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Image'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $this->element('backend/image_view', array('image'=>array('id'=>$widget['Widget']['id'], 'image'=>$widget['Widget']['image']), 'size'=>'master'));?>
            &nbsp;
        </dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if($widget['Widget']['approved'] == 1) echo 'Yes';
            elseif($widget['Widget']['approved'] == 0) echo 'No';?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $widget['Widget']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $widget['Widget']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Widget', true), array('action' => 'edit', $widget['Widget']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Widget', true), array('action' => 'delete', $widget['Widget']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $widget['Widget']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Widgets', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Widget', true), array('action' => 'add')); ?> </li>		
	</ul>
</div>