<div class="academics view">
<h2><?php  __('Academic');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $academic['Academic']['id']; ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tab Title'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
          <?php echo $academic['Academic']['tab_title'];?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $academic['Academic']['title']; ?>
            &nbsp;
        </dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Body'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $academic['Academic']['body']; ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Image'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $this->element('backend/image_view', array('image'=>array('id'=>$academic['Academic']['id'], 'image'=>$academic['Academic']['image']), 'size'=>'master'));?>
            &nbsp;
        </dd>	
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if($academic['Academic']['approved'] == 1) echo 'Yes';
            elseif($academic['Academic']['approved'] == 0) echo 'No';?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $academic['Academic']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $academic['Academic']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Academic', true), array('action' => 'edit', $academic['Academic']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Academic', true), array('action' => 'delete', $academic['Academic']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $academic['Academic']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Academics', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Academic', true), array('action' => 'add')); ?> </li>		
	</ul>
</div>