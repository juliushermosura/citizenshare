<h1>Change Email Address</h1>
<?php
echo $this->Form->create('User', array('method'=>'post'));
echo $this->Form->hidden('id');
echo $this->Form->input('email');
echo $this->Form->end('Save');
?>