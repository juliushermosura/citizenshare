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
 * @package       app.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$this->layout = 'error';
?>
<div class="dialog">
  <h1>ERROR 404</h1>
  <h2>Sorry, the page you were looking for doesn’t exist.</h2>
  <p>Go back to <a href="<?= SITE_URL ?>">Citizenshare.com</a> or <a href="<?= SITE_URL ?>/pages/contact">contact us</a> about a problem.</p>
  <a href="<?= SITE_URL ?>" id="back"><img src="/img/citizenshare_logo.png" alt="Citizenshare"></a>
  <?php
  if (Configure::read('debug') > 0):
    echo $this->element('exception_stack_trace');
  endif;
  ?>
</div>
