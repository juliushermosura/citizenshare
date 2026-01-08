<div class="users form">
				<?php echo $this->Session->flash(); ?>
				<h1>
								<a class="logo_container" title="back to Citizenshare home" href="/">Citizenshare</a>			
				</h1>

				<?php echo $this->Form->create('User'); ?>
        <?php echo $this->Form->input('email', array('type' => 'text', 'placeholder' => 'EMAIL', 'label'=>false));
        echo $this->Form->input('password', array('placeholder' => 'PASSWORD',  'label'=>false));
								echo $this->Form->hidden('type');
    ?>
				<?php echo $this->Form->submit(__('SIGN IN')); ?>
				<div class="marginbottom20 margintop20">
				<?php echo $this->Html->link('Forgot Password', array('controller'=>'users', 'action'=>'forgot_password'), array()) ?>
				</div>
				<?php echo $this->Form->checkbox('agree') ?>
				<label for="UserAgree">I agree to Citizenshare's Terms of Service & Privacy Policy</label>
				<?php echo $this->Form->end() ?>
</div>
<script type="text/javascript">
				if (inIframe()) {
								top.location.reload();
				}
				function inIframe () {
								try {
												return window.self !== window.top;
								} catch (e) {
												return true;
								}
				}
</script>