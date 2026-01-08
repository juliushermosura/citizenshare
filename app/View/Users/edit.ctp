<h1><?php echo $pagetitle ?></h1>
<?php echo $list_link ?>
<hr />
<br />
<div class="absoluteright"><img src="/files/photos/blank-profile.png" width="200px" /></div>
<?php echo $this->Form->create('User') ?>
<?php echo $this->Form->hidden('User.id') ?>
<?php echo $this->Form->input('User.username') ?>
<?php echo $this->Form->input('User.password') ?>
<?php echo $this->Form->input('User.email') ?>
<?php echo $this->Form->input('Profile.first_name') ?>
<?php echo $this->Form->input('Profile.last_name') ?>
<?php echo $this->Form->input('Profile.gender', array('options'=>array('M'=>'Male', 'F'=>'Female'))) ?>
<?php echo $this->Form->input('Profile.birth_date', array('type'=>'date', 'maxYear'=>date('Y'), 'minYear'=>'1920')); ?>
<?php echo $this->Form->input('Profile.photo', array('type'=> 'file')) ?>
<?php echo $this->Form->input('User.group_id', array('label' => 'Type', 'options' => $group_list)) ?>
<?php echo $this->Form->end('Save') ?>