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
<html lang="en" class="no-js">
<head>
	<?php //echo $this->Html->charset(); ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('reset');
		echo $this->Html->css('badger.min');
		echo $this->Html->css('style');
		echo $this->Html->css('light');

		//echo $this->Html->css('jquery.qtip');

		echo $this->Html->script('modernizr');

		echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js');
		//echo $this->Html->script('jquery.qtip');
		echo $this->Html->script('badger.min');
		echo $this->Html->script('script');

		echo $this->fetch('meta');
		echo $this->fetch('css');
?>

  	<title>
		Citizenshare: Learn Real-World Skills
		<?php echo $title_for_layout; ?>
	</title>
</head>
<body>
		<div id="header_outer">
						<?php echo $this->element('header') ?>
		</div>

  <main>
   
    <!-- content -->
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>

		<div class="cd-overlay"></div>

		<?php echo $this->element('footer') ?>
  </main>


<div class="cd-user-modal">
  <?php echo $this->element('user_modal'); ?>
</div>

<div id="cd-shadow-layer"></div>
 

</body>
</html>
