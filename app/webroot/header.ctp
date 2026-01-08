			<div class="logo">
			<?php echo $this->Html->link($this->Html->image('citizenshare_logo.png', array('alt'=>'Citizenshare logo')), '/', array('escape' => false, 'title' => 'Citizenshare - Learn Real-World Skills')) ?>
			</div>
			<ul class="menu primary">
				<?php if ($this->Session->read('Auth.User')): ?>
				<li>Dashboard</li>
				<?php endif ?>
				<li><a href="/classes">Classes</a></li>
				<li><a href="/projects">Projects</a></li>
				<li><a href="/pages/join">Free Trial Membership</a></li>
				<li><a href="/pages/teach">Start Your Own Online School</a></li>
			</ul>
			<?php echo $this->Form->create('Search', array('url'=>array('controller'=>'classes', 'action'=>'search'),'class'=>'searchform')) ?>
			<?php echo $this->Form->input('query', array('label' => false, 'placeholder' => 'SEARCH')) ?>
			<?php echo $this->Form->end(null) ?>
			<ul class="menu secondary">
				<li><a href="#"><img src="/img/notification.png" border="0" alt="notification" title="Notification" /></a></li>
				<li><a href="#"><img src="/img/cart.png" border="0" alt="Check out cart" title="Check out cart" /></a></li>
				<li><a href="http://uat.citizenshare.net/branch_manager">Sign In</a></li>
			</ul>
			<div class="right">
				<a href="/pages/join" class="btn_orange">Join for Free</a>
			</div>