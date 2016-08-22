<div class="careers view">
<h2><?php  __('Career Vacancy');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $career['Career']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo $titleLabel; ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $career['Career']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $career['Career']['description']; ?>
			&nbsp;
		</dd>	
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('To Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		  <?php echo $career['Career']['to_email'];?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Weight'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
          <?php echo $career['Career']['weight'];?>
            &nbsp;
        </dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if($career['Career']['approved'] == 1) echo 'Yes';
            elseif($career['Career']['approved'] == 0) echo 'No';?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $career['Career']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $career['Career']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Career Vacancy', true), array('action' => 'edit', $career['Career']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Career Vacancy', true), array('action' => 'delete', $career['Career']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $career['Career']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Careers Vacancies', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Career Vacancy', true), array('action' => 'add')); ?> </li>		
	</ul>
</div>