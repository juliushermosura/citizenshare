<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
  public $uses = array('User');
  public $components = array(
    'Cookie',
    'WpRss',
    'Session',
    'Auth' => array(
      'authenticate' => array(
        'Form' => array(
          'fields' => array('username' => 'email', 'password' => 'password')
        )
       ),
      'loginRedirect' => array(
        'controller' => 'users',
        'action' => 'index'
      )
    )
  );

  public function beforeFilter() {
    $this->Cookie->domain = DOMAIN_NAME;
    $show_membership = false;
    $is_notification = false;
    $this->set('is_notification', $is_notification);
    if ($this->Session->check('pageviews')) {
      $pageviews = $this->Session->read('pageviews') + 1;
      $this->Session->write('pageviews', $pageviews);
    } else {
      $this->Session->write('pageviews', 37);
    }

    if (!empty($this->params['subdomain'])) {
      $subdomain = $this->User->find('first', array('conditions' => array('subdomain' => $this->params['subdomain']), 'fields' => array('User.id'), 'recursive' => -1));
      $this->Session->write('owner', $subdomain);
      if (empty($subdomain)) {
        throw new NotFoundException();
      } else {
        $this->User->OnlineClass->contain('ClassCategory');
        $class_categories = $this->User->OnlineClass->find('all', array('conditions' => array('OnlineClass.user_id' => $subdomain['User']['id']), 'fields' => array('DISTINCT OnlineClass.class_category_id', 'ClassCategory.title')));
        if (empty($class_categories)) $class_categories = $this->User->ClassCategory->find('all', array('conditions' => array('ClassCategory.user_id' => null, 'ClassCategory.admin_approved' => 1, 'ClassCategory.is_deleted' => 0, 'ClassCategory.is_suspended' => 0)));
        $this->set('class_categories', $class_categories);
        if ($this->params['controller'] == 'pages' && $this->params['pass']['0'] == 'home') {
          $this->User->unbindModel(array('hasMany' => array('File', 'Profile', 'OnlineClass', 'Project')));
          $this->User->bindModel(array('hasMany' => array(
            'File' => array('limit' => 1, 'order' => array('created DESC'), 'fields' => array('name'), 'conditions' => array('type' => 'user')), 
            'Profile' => array('limit' => 1, 'order' => array('created DESC'), 'fields' => array('first_name', 'last_name')),
            'OnlineClass' => array('limit' => 3, 'order' => array('created DESC'), 'conditions' => array('is_deleted' => 0, 'is_suspended' => 0)),
            'Project' => array('limit' => 3, 'order' => array('created DESC'))
          )));
          $this->User->Profile->unbindModel(array('belongsTo' => array('User')));
          $this->User->File->unbindModel(array('belongsTo' => array('User', 'Lesson', 'OnlineClass', 'Project', 'Microsite')));
          $user = $this->User->find('first', array('fields' => array('User.id'), 'recursive' => 2, 'conditions'=>array('User.id' => $subdomain['User']['id'])));
          $this->set('user', $user);
        }
        $this->User->UserSetting->id = $subdomain['User']['id'];
        $show_membership = $this->User->UserSetting->field('show_membership');
      }
    } else {
      $class_categories = $this->User->ClassCategory->find('all', array('conditions' => array('ClassCategory.user_id' => null, 'ClassCategory.admin_approved' => 1, 'ClassCategory.is_deleted' => 0, 'ClassCategory.is_suspended' => 0)));
      $this->set('class_categories', $class_categories);
    }
    if ($this->Auth->user()) {
      if (!$this->Session->check('dashboard')) {
        $user_type = $this->Auth->user('group_id');
        $group_name = $this->User->Group->find('first', array('recursive' => 1, 'conditions' => array('id' => $user_type)));
        $this->Session->write('user', $group_name);
        if ($group_name['Group']['title'] == 'Corporate') {
          $this->Session->write('dashboard', 'corporate');
        } else {
          $this->Session->write('dashboard', 'dashboard');
        }
      }
      $this->set('posts', $this->WpRss->feeds());
      $photo = $this->User->File->find('first', array('conditions' => array('type' => 'user', 'user_id' => $this->Auth->user('id')), 'recursive' => -1, 'order' => array('created DESC')));
      $this->set('photo', $photo);
      $this->set('name', $this->User->Profile->find('first', array('fields'=>array('first_name', 'last_name'), 'recursive'=> -1, 'conditions'=>array('user_id' => $this->Auth->user('id')))));
    } 
    $this->set('showmembership', $show_membership);
  }


}
