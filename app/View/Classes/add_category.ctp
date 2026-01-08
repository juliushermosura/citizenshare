<h1>Add New Category</h1>
<?php echo $this->Session->flash() ?>
<?php echo $this->Form->create('ClassCategory') ?>
<?php echo $this->Form->input('title', array('label' => 'Category title')) ?>
<?php echo $this->Form->end('Save') ?>
