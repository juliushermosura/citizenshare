<header class="cd-header <?php echo ( ($this->params['controller'] == 'pages' && $this->params['pass']['0'] == 'home') || ($this->params['controller'] == 'classes' && $this->params['action'] == 'view') ) ? 'is-fixed' : '' ?> is-visible">
    <div class="cd-logo">
      <?php echo $this->Html->link($this->Html->image('citizenshare_logo.png', array('alt'=>'Citizenshare logo')), '/', array('escape' => false, 'title' => 'Citizenshare - Learn Real-World Skills')) ?>
    </div>
 
    <nav id="cd-horizontal-nav">
      <ul class="cd-secondary-nav">
      <?php if ($this->Session->check('Auth.User.id')): ?>
								<li><a href="<?php echo SITE_URL ?>/dashboard/users/index">Dashboard</a></li>
      <?php endif ?>
        <li>
									<a class="classcategory hassubmenu" href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/classes">Classes<span class="icon-arrow-down"></span></a>
									<ul class="submenu">
											<?php foreach($class_categories as $category): ?>
												<li><a href="/classes/category/<?php echo $category['ClassCategory']['id'] ?>"><?php echo $category['ClassCategory']['title'] ?></a></li>
											<?php endforeach ?>
									</ul>
								</li>
        <li><a href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/projects">Projects</a></li>
        <li><a href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/pages/teach">Teach</a></li>
								<?php if ($showmembership): ?>
        <li><a href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/join">Membership</a></li>
								<?php endif ?>
        <li><a href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/teach">Start Your Own School</a></li>
      </ul>
      <ul class="cd-third-nav">
								<li>
									<form name="" action="/classes/search" >
										<input type="text" name="data[OnlineClass][keyword]" value="" placeholder="Search" class="search" />
									</form>
								</li>
      <?php if (!$this->Session->check('Auth.User.id')): ?>
        <li class="marginleft10">
          <div class="cd-sign-nav">
                <a href="#cd-signin" class="cd-signin">Sign in</a>
          </div>
        </li>
        <li class="marginleft0">
          <div class="cd-sign-nav cd-switcher2">
                <a href="#cd-signup" class="cd-signup"><img class="join" src="/img/signup.png" border="0" /></a>
          </div>
        </li>
								<?php else: ?>
								<li class="marginleft0 hassubmenu">
          <div id="badger">
                <a href="#"><img src="/img/notify.png" class="notify_icon" border="0" /></a>
          </div>
									<ul class="submenu">
												<li>No notification</li>
									</ul>
        </li>
								<li class="marginleft10 hassubmenu">
									<div class="avatar-xsmall">
										<a href="/<?php echo $this->Session->read('dashboard') ?>/users/profile">
												<img border="0" class="avatar-image" src="/img/profile.png" title="" />
										</a>
									</div>
									<ul class="submenu">
												<li><a href="http://uat.citizenshare.net/dashboard/users/index">Dashboard</a></li>
												<li><a href="http://uat.citizenshare.net/dashboard/users/index#profile">Profile</a></li>
												<li><a href="http://uat.citizenshare.net/dashboard/users/index#cart">Cart (1)</a></li>
												<li><a href="http://uat.citizenshare.net/dashboard/users/index#settings">Settings</a></li>
												<li><a href="http://uat.citizenshare.net/dashboard/users/index#invite-friend">Invite a Friend</a></li>
												<li><a href="http://uat.citizenshare.net/users/logout/1">Sign Out</a></li>
									</ul>
								</li>
        <?php endif ?>
      </ul>
    </nav> <!-- nav -->
</header>
<?php if ($this->Session->check('Auth.User.id') && $is_notification): ?>
<script type="text/javascript">
$(document).ready(function() {
	$('#badger').badger('0');
});
</script>
<?php endif ?>