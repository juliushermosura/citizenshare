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

		echo $this->Html->css('users/style');

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
    <li class="active"><a href="/corporate/users/dashboard" title="Dashboard">Dashboard</a></li>
    <li class=""><a href="/corporate/themes/select" title="Website Manager">Website Manager</a></li>
    <li class=""><a href="/corporate/classes" title="Create a Class">Create a Class</a></li>    
    <li class=""><a href="/corporate/lessons" title="Lesson Guide">Lesson Guide</a></li>    
    <li class=""><a href="/corporate/projects" title="Post a Project">Post a Project</a></li>    
    <li class=""><a href="/corporate/users/account" title="Account">Post a Project</a></li>    
    <li class=""><a href="/corporate/pages/faq" title="Frequently Asked Questions">FAQ</a></li>    
			</ul>
			<div class="header_panel">
				
			</div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
