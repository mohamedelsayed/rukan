<div class="events view">
<h2><?php  __('Event');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('From Date'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $event['Event']['from_date']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('To Date'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $event['Event']['to_date']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Timing'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $event['Event']['timing']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Location'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $event['Event']['location']; ?>
            &nbsp;
        </dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Agenda'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['agenda']; ?>
			&nbsp;
		</dd>			
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Category'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $this->Html->link($event['Category']['title'], array('controller' => 'categories', 'action' => 'view', $event['Category']['id'])); ?>
            &nbsp;
        </dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if($event['Event']['approved'] == 1) echo 'Yes';
            elseif($event['Event']['approved'] == 0) echo 'No';?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Event', true), array('action' => 'edit', $event['Event']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Event', true), array('action' => 'delete', $event['Event']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $event['Event']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Events', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event', true), array('action' => 'add')); ?> </li>		
	</ul>
</div>