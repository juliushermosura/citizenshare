<div class="users form">
				<?php echo $this->Session->flash(); ?>
				<h1>
								<a class="logo_container" title="back to Citizenshare home" href="/">Citizenshare</a>			
				</h1>
				<?php echo $this->Form->create('User'); ?>
        <?php echo $this->Form->input('password', array('placeholder' => 'NEW PASSWORD', 'label'=>false));
        echo $this->Form->input('confirm_password', array('type'=>'password', 'placeholder' => 'CONFIRM PASSWORD', 'label'=>false));
        echo $this->Form->hidden('id');
    ?>
				<?php echo $this->Form->submit(__('SAVE NEW PASSWORD')); ?>
				<?php echo $this->Form->end() ?>
</div>
