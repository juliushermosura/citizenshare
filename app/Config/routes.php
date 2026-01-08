<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
$subdomain = substr(env("HTTP_HOST"), 0, strpos(env("HTTP_HOST"), ".")); 

if ($subdomain != 'uat') { 
  Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home', 'subdomain' => $subdomain));
  Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display', 'subdomain' => $subdomain)); 
		Router::connect('/teach', array('controller' => 'pages', 'action' => 'display', 'teach', 'subdomain' => $subdomain));
		Router::connect('/join', array('controller' => 'pages', 'action' => 'display', 'join', 'subdomain' => $subdomain));
  Router::connect('/:controller', array('subdomain' => $subdomain)); 
  Router::connect('/:controller/:action', array('subdomain' => $subdomain)); 
  Router::connect('/:controller/:action/*', array('subdomain' => $subdomain)); 
  Router::connect('/:controller/*', array('subdomain' => $subdomain)); 
} else {

	Router::connect('/', array('controller' => 'users', 'action' => 'login'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	Router::connect('/teach', array('controller' => 'pages', 'action' => 'display', 'teach'));
	Router::connect('/join', array('controller' => 'pages', 'action' => 'display', 'join'));
	Router::connect('/corporate', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/teacher', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/branch_manager', array('controller' => 'users', 'action' => 'login'));
}


/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
