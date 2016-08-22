<div class="developments view">
<h2><?php  __('Development');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $development['Development']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $development['Development']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sub Title'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $development['Development']['sub_title']; ?>
            &nbsp;
        </dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Body'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $development['Development']['body']; ?>
			&nbsp;
		</dd>	
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Image'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $this->element('backend/image_view', array('image'=>array('id'=>$development['Development']['id'], 'image'=>$development['Development']['image']), 'size'=>'master'));?>
            &nbsp;
        </dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Weight'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		  <?php echo $development['Development']['weight'];?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if($development['Development']['approved'] == 1) echo 'Yes';
            elseif($development['Development']['approved'] == 0) echo 'No';?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $development['Development']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $development['Development']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Development', true), array('action' => 'edit', $development['Development']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Development', true), array('action' => 'delete', $development['Development']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $development['Development']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Developments', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Development', true), array('action' => 'add')); ?> </li>		
	</ul>
</div>