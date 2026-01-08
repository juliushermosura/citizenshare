<h1>Change Password</h1>
<?php
echo $this->Form->create('User', array('method'=>'post'));
echo $this->Form->hidden('id');
echo $this->Form->input('current_password', array('type'=>'password'));
echo $this->Form->input('new_password', array('type'=>'password'));
echo $this->Form->input('confirm_password', array('type'=>'password'));
echo $this->Form->end('Save');
?>