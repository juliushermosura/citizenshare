<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Citizenshare: Learn Real-World Skills
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('dashboard/style');

		echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js');
		echo $this->Html->script('dashboard/script');
    
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<?php echo $this->Html->link($this->Html->image('citizenshare_logo.png', array('alt'=>'Citizenshare logo')), '/users/', array('escape' => false, 'title' => 'Citizenshare - Learn Real-World Skills')) ?>
			<ul id="menu">
    <li class="active"><a target="viewport" href="/<?php echo $this->Session->read('dashboard') ?>/users/welcome/?inline=1" title="Dashboard">Dashboard</a></li>
    <li class=""><a target="viewport" href="/<?php echo $this->Session->read('dashboard') ?>/microsites/index/?inline=1" title="Website Manager">Website Manager</a></li>
    <li class=""><a target="viewport" href="/<?php echo $this->Session->read('dashboard') ?>/classes/?inline=1" title="Create a Class">Create a Class</a></li>    
    <li class=""><a target="viewport" href="/<?php echo $this->Session->read('dashboard') ?>/lessons/?inline=1" title="Lesson Guide">Lesson Guide</a></li>    
    <li class=""><a target="viewport" href="/<?php echo $this->Session->read('dashboard') ?>/projects/?inline=1" title="Post a Project">Post a Project</a></li>    
    <li class=""><a target="viewport" href="/<?php echo $this->Session->read('dashboard') ?>/classes/promote/?inline=1" title="Promote a Class">Promote a Class</a></li>    
    <li class=""><a href="#" title="Account">Account</a>
					<ul class="submenu">
						<?php if (!empty($name)): ?>
						<li><a href="/users/profile/<?php echo AuthComponent::user('id') ?>">Public Profile</a></li>
						<?php endif ?>
						<li><a target="viewport" href="/<?php echo $this->Session->read('dashboard') ?>/users/update_profile/?inline=1"><?php echo (empty($name) ? 'Create' : 'Update') ?> Profile</a></li>
						<li><a target="viewport" href="/<?php echo $this->Session->read('dashboard') ?>/users/email/?inline=1">Email</a></li>
						<li><a target="viewport" href="/<?php echo $this->Session->read('dashboard') ?>/users/change_password/?inline=1">Password</a></li>
						<li><a target="viewport" href="/<?php echo $this->Session->read('dashboard') ?>/users/payments/?inline=1">Payments</a></li>
						<li><a target="viewport" href="/<?php echo $this->Session->read('dashboard') ?>/users/memberships/?inline=1">Memberships</a></li>
						<li><a target="viewport" href="/<?php echo $this->Session->read('dashboard') ?>/pages/tutorials/`">Tutorials</a></li>
						<li><a href="/users/logout/">Log Out</a></li>
					</ul>
				</li>
    <li><a target="viewport" href="/<?php echo $this->Session->read('dashboard') ?>/pages/faq/?inline=1" title="Frequently Asked Questions">FAQ</a></li>    
			</ul>
      <div class="rightphoto">
        <a href="/<?php echo $this->Session->read('dashboard') ?>/users/profile">
          <?php if (empty($photo)): ?>
          <img src="/files/default/user/blank-profile.png" title="Edit Profile Photo" />
          <?php else: ?>
          <img src="/files/<?php echo AuthComponent::user('id') . '/' . $photo['File']['type'] . '/' . $photo['File']['name'] ?>" />
          <?php endif ?>
        </a> <div class="liveoffline">OFFLINE</div>
      </div>
			<div class="header_panel">
				<div class="messagepanel">
					<a target="viewport" href="/dashboard/messages/inbox?inline=1" title="Message Inbox"><span class="icon-mail"></span></a> &nbsp;&nbsp;&nbsp;
					<a target="_blank" href="/pages/help" title="Getting Help"><span class="icon-question"></span></a>
				</div>
			</div>
		</div>
		<div id="content">
					
		<div class="sidebar">
      <?php
      $group_name = $this->Session->read('user.Group.title');
      if ($group_name == 'Branch Manager'): 
      ?>
			<?php echo $this->element('blog', $posts) ?>
      <?php endif ?>
		</div>
			<div class="contentarea">
				<?php echo $this->Session->flash(); ?>
	
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		<div class="clearboth"></div>
		<div id="footer">
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
