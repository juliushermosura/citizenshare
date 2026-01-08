<h1><?php echo $pagetitle ?></h1>
<?php echo $list_link ?>
<hr />
<br />
<?php echo $this->Form->create('User') ?>
<?php echo $this->Form->input('User.username') ?>
<?php echo $this->Form->input('User.password') ?>
<?php echo $this->Form->input('User.email') ?>
<?php echo $this->Form->input('Profile.first_name') ?>
<?php echo $this->Form->input('Profile.last_name') ?>
<?php echo $this->Form->input('User.group_id', array('label' => 'Type', 'options' => $group_list)) ?>
<?php echo $this->Form->end('Save') ?>