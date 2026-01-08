<div class="users form">
				<?php echo $this->Session->flash(); ?>
				<h1>
								<a class="logo_container" title="back to Citizenshare home" href="/">Citizenshare</a>			
				</h1>
				<?php echo $this->Form->create('User'); ?>
        <?php echo $this->Form->input('username', array('placeholder' => 'USERNAME / EMAIL', 'label'=>false));
    ?>
				<?php echo $this->Form->submit(__('REQUEST TO RESET PASSWORD')); ?>
				<div class="marginbottom20 margintop20 textalign_left paddingleft16 fontsize12">
								<p>Lost your password?</p>
								<p>Enter your username/email address to request for a reset password.</p>
				<?php echo $this->Html->link('&larr; Back to login', $this->Session->read('loginpage'), array('escape' => false, 'class'=>'backtologin')) ?>
				</div>
				<?php echo $this->Form->end() ?>
</div>
