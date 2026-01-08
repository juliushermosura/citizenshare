<?php

class UsersController extends AppController {
				
  public $layout = 'inline';
  public $group_list = array();
		public $components = array('RequestHandler');
  
  public function beforeFilter() {
    parent::beforeFilter();
    // Allow users to register and logout.
    $this->Auth->allow('login', 'logout', 'add', 'profile', 'followers', 'followings', 'forgot_password');
    $this->group_list = $this->User->Group->find('list', array('conditions'=>array('is_publish'=>1, 'is_deleted'=>0)));
  }
  
  public function dashboard_login() {
    $this->redirect('/users/login');
  }
  
  public function corporate_login() {
    $this->redirect('/users/login');
  }
  
  public function login() {
    $this->layout = 'login';
				if ($this->Auth->user()) {
						$this->redirect(array('action' => 'index'));
				}
    $this->request->data['User']['type'] = ucfirst(str_replace('/', '', $this->here));
    if ($this->request->is('post')) {
      if ($this->Auth->login()) {
								return $this->redirect($this->Auth->redirect());
      }
      $this->Session->setFlash(__('Invalid username or password, try again'));
    }
  }
  
  public function logout($ret = 0) {
    $this->Session->destroy();
				if ($ret == 0) {
						return $this->redirect($this->Auth->logout());
				} else {
						$referer = parse_url($this->referer());
						$this->redirect($referer['scheme'] . '://' . $referer['host']);
				}
  }
  
  public function forgot_password() {

  }
  
  public function index() {
    $dashboard = $this->Session->read('dashboard');
				$site_url = SITE_URL . '/';
				if ($this->referer() == $site_url) {
						$this->redirect(array($dashboard => true, 'action' => 'index'));
				} else {
						$this->redirect( $this->referer() );		
				}
  }
  
  public function corporate_index() {
    $this->layout = 'dashboard';
  }

  public function dashboard_index() {
    $this->layout = 'dashboard';
  }
  
  public function dashboard_welcome() {
    $this->layout = 'inline';
  }
  
  public function dashboard_memberships() {
  }
  
  public function dashboard_payments() {
  }

  public function corporate_update_profile() {
    if ($this->request->is(array('post', 'put'))) {
      $this->request->data['Profile']['user_id'] = $this->Auth->user('id');
      if ($this->User->Profile->save($this->request->data)) {
        $this->Session->setFlash('Successfully updated your profile.', 'default', array('class'=>'success'));
        $this->redirect(array('action' => 'profile'));
      }
      $this->Session->setFlash(__('Unable to update your profile.'));
    }
    $this->request->data = $this->User->Profile->findByUserId($this->Auth->user('id'));
    $this->render('update_profile');
  }   
  
  public function dashboard_update_profile() {
    if (isset($this->request->query['inline']) && $this->request->query['inline'] == 1) {
      $this->layout = 'inline';
    }
    if ($this->request->is(array('post', 'put'))) {
      $this->request->data['Profile']['user_id'] = $this->Auth->user('id');
      if ($this->User->Profile->save($this->request->data)) {
        $this->Session->setFlash('Successfully updated your profile.', 'default', array('class'=>'success'));
        if (isset($this->request->query['inline']) && $this->request->query['inline'] == 1) {
          $this->redirect(array('action' => 'update_profile/?inline=1'));
        } else {
          $this->redirect(array('action' => 'update_profile'));
        }
      }
      $this->Session->setFlash(__('Unable to update your profile.'));
    }
    $this->request->data = $this->User->Profile->findByUserId($this->Auth->user('id'));
    $this->render('update_profile');
  }   

  public function dashboard_email() {
    if ($this->request->is(array('post', 'put'))) {
      if ($this->User->save($this->data)) {
        $this->Session->setFlash('Successfully changed your email.', 'default', array('class'=>'success'));
        $this->redirect(array('action' => 'email'));
      }
      $this->Session->setFlash(__('Unable to update your email.'));
    }
    $this->request->data = $this->User->findById($this->Auth->user('id'));
    if (empty($this->data)) {
      $this->request->data = $this->User->findById($this->Auth->user('id'));
    }
    $this->render('change_email');
  }

  public function corporate_email() {
    if ($this->request->is(array('post', 'put'))) {
      if ($this->User->save($this->data)) {
        $this->Session->setFlash('Successfully changed your email.', 'default', array('class'=>'success'));
        $this->redirect(array('action' => 'email'));
      }
      $this->Session->setFlash(__('Unable to update your email.'));
    }
    $this->request->data = $this->User->findById($this->Auth->user('id'));
    if (empty($this->data)) {
      $this->request->data = $this->User->findById($this->Auth->user('id'));
    }
    $this->render('change_email');
  }
  
  public function dashboard_change_password() {
    if ($this->request->is(array('post', 'put'))) {
      if ($this->User->save($this->data)) {
        $this->Session->setFlash('Successfully changed your password.', 'default', array('class'=>'success'));
        $this->redirect(array('action' => 'change_password'));
      }
      $this->Session->setFlash(__('Unable to update your password.'));
    }
    $this->render('change_password');
  }

  public function corporate_change_password() {
    if ($this->request->is(array('post', 'put'))) {
      if ($this->User->save($this->data)) {
        $this->Session->setFlash('Successfully changed your password.', 'default', array('class'=>'success'));
        $this->redirect(array('action' => 'change_password'));
      }
      $this->Session->setFlash(__('Unable to update your password.'));
    }
    $this->render('change_password');
  }
  
  public function corporate_students_list() {
    $users = $this->User->Group->find('first', array('recursive'=>2,'conditions' => array('title' => 'Student')));
    $this->set('users', $users);
    $this->set('pagetitle', 'Manage Students');
    $this->set('add_link', '<a href="/corporate/users/add_student">Add Student</a>');
    $this->set('edit_link', 'edit_student');
    $this->set('delete_link', 'delete_student');
    $this->set('view_link', 'view_student');
    $this->render('list');	
  }
  
  public function corporate_add_student() {
    $this->set('pagetitle', 'Add Student');
    $this->set('group_list', $this->group_list);
    $this->set('list_link', '<a href="/corporate/users/students_list">Back to list</a>');
    if ($this->request->is(array('post', 'put'))) {
      $this->request->data['User']['activated'] = 1;
      if ($this->User->saveAll($this->request->data)) {
        $this->Session->setFlash('Successfully added student user.', array('default'), array('class'=>'success'));
        $this->redirect(array('action' => 'students_list'));
      }
      $this->Session->setFlash(__('Unable to add student user.'));
    }
    $this->render('add');
  }
  
  public function corporate_edit_student($id = null) {
    $this->set('pagetitle', 'Update Student\'s Record');
    $this->set('group_list', $this->group_list);
    $this->set('list_link', '<a href="/corporate/users/students_list">Back to list</a>');
    if ($this->request->is(array('post', 'put'))) {
      if ($this->User->saveAll($this->request->data)) {
        $this->Session->setFlash('Successfully updated student user.', array('default'), array('class'=>'success'));
        $this->redirect(array('action' => 'students_list'));
      }
      $this->Session->setFlash(__('Unable to update student user.'));
    }
    $this->request->data = $this->User->findById($id);
    $this->render('edit');
  }
  
  public function corporate_delete_student($id = null) {
    if (!empty($id)) {
      $this->request->data['User']['deleted'] = 1;
      $this->request->data['User']['id'] = $id;
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash('Successfully deleted corporate user.', array('default'), array('class'=>'success'));
        $this->redirect(array('action' => 'students_list'));
      }
      $this->Session->setFlash(__('Unable to delete student user.'));      
    }
    $this->redirect('/corporate/users/students_list');
    $this->autoRender = false;
  }
  
  public function corporate_view_student($id = null) {
    $this->set('pagetitle', 'View Student\'s Record');
    $this->set('list_link', '<a href="/corporate/users/students_list">Back to list</a>');
    if (!empty($id)) {
    }
    $this->render('view');
  }
  
  public function corporate_branchmanagers_list() {
    $this->set('pagetitle', 'Manage Branch Managers');
    $users = $this->User->Group->find('first', array('recursive'=>2,'conditions' => array('title' => 'Branch Manager')));
    $this->set('users', $users);
    $this->set('add_link', '<a href="/corporate/users/add_branchmanager">Add Branch Manager</a>');
    $this->set('edit_link', 'edit_branchmanager');
    $this->set('delete_link', 'delete_branchmanager');
    $this->set('view_link', 'view_branchmanager');
    $this->render('list');
  }
  
  public function corporate_add_branchmanager() {
    $this->set('pagetitle', 'Add Branch Manager');
    $this->set('group_list', $this->group_list);
    $this->set('list_link', '<a href="/corporate/users/branchmanagers_list">Back to list</a>');
    if ($this->request->is(array('post', 'put'))) {
      $this->request->data['User']['activated'] = 1;
      if ($this->User->saveAll($this->request->data)) {
        $this->Session->setFlash('Successfully added branch manager user.', array('default'), array('class'=>'success'));
        $this->redirect(array('action' => 'branchmanagers_list'));
      }
      $this->Session->setFlash(__('Unable to add branch manager user.'));
    }
    $this->render('add');
  }
  
  public function corporate_edit_branchmanager($id = null) {
    $this->set('pagetitle', 'Update Branch Manager\'s Record');
    $this->set('group_list', $this->group_list);
    $this->set('list_link', '<a href="/corporate/users/branchmanagers_list">Back to list</a>');
    if ($this->request->is(array('post', 'put'))) {
      if ($this->User->saveAll($this->request->data)) {
        $this->Session->setFlash('Successfully updated branch manager user.', array('default'), array('class'=>'success'));
        $this->redirect(array('action' => 'branchmanagers_list'));
      }
      $this->Session->setFlash(__('Unable to update branch manager user.'));
    }
    $this->request->data = $this->User->findById($id);
    $this->render('edit');
  }
  
  public function corporate_delete_branchmanager($id = null) {
    if (!empty($id)) {
      $this->request->data['User']['deleted'] = 1;
      $this->request->data['User']['id'] = $id;
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash('Successfully deleted branch manager user.', array('default'), array('class'=>'success'));
        $this->redirect(array('action' => 'branchmanagers_list'));
      }
      $this->Session->setFlash(__('Unable to delete branch manager user.'));      
    }
    $this->redirect('/corporate/users/branchmanagers_list');
    $this->autoRender = false;
  }
  
  public function corporate_view_branchmanager($id = null) {
    $this->set('pagetitle', 'View Branch Manager\'s Record');
    $this->set('list_link', '<a href="/corporate/users/branchmanagers_list">Back to list</a>');
    if (!empty($id)) {
    }
    $this->render('view');
  }

  public function corporate_teachers_list() {
    $this->set('pagetitle', 'Manage Teachers');
    $users = $this->User->Group->find('first', array('recursive'=>2,'conditions' => array('title' => 'Teacher')));
    $this->set('users', $users);
    $this->set('add_link', '<a href="/corporate/users/add_teacher">Add Teacher</a>');
    $this->set('edit_link', 'edit_teacher');
    $this->set('delete_link', 'delete_teacher');
    $this->set('view_link', 'view_teacher');
    $this->render('list');
  }
  
  public function corporate_add_teacher() {
    $this->set('pagetitle', 'Add Teacher');
    $this->set('group_list', $this->group_list);
    $this->set('list_link', '<a href="/corporate/users/teachers_list">Back to list</a>');
    if ($this->request->is(array('post', 'put'))) {
      $this->request->data['User']['activated'] = 1;
      if ($this->User->saveAll($this->request->data)) {
        $this->Session->setFlash('Successfully added teacher user.', array('default'), array('class'=>'success'));
        $this->redirect(array('action' => 'teachers_list'));
      }
      $this->Session->setFlash(__('Unable to add teacher user.'));
    }
    $this->render('add');
  }
  
  public function corporate_edit_teacher($id = null) {
    $this->set('pagetitle', 'Update Corporate User\'s Record');
    $this->set('group_list', $this->group_list);
    $this->set('list_link', '<a href="/corporate/users/teachers_list">Back to list</a>');
    if ($this->request->is(array('post', 'put'))) {
      if ($this->User->saveAll($this->request->data)) {
        $this->Session->setFlash('Successfully updated teacher user.', array('default'), array('class'=>'success'));
        $this->redirect(array('action' => 'teachers_list'));
      }
      $this->Session->setFlash(__('Unable to update teacher user.'));
    }
    $this->request->data = $this->User->findById($id);
    $this->render('edit');
  }
  
  public function corporate_delete_teacher($id = null) {
    if (!empty($id)) {
      $this->request->data['User']['deleted'] = 1;
      $this->request->data['User']['id'] = $id;
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash('Successfully deleted teacher user.', array('default'), array('class'=>'success'));
        $this->redirect(array('action' => 'teachers_list'));
      }
      $this->Session->setFlash(__('Unable to delete teacher user.'));      
    }
    $this->redirect('/corporate/users/teachers_list');
    $this->autoRender = false;
  }
  
  public function corporate_view_teacher($id = null) {
    $this->set('pagetitle', 'View Teacher\'s Record');
    $this->set('list_link', '<a href="/corporate/users/teachers_list">Back to list</a>');
    if (!empty($id)) {
    }
    $this->render('view');
  }
  
  public function corporate_admins_list() {
    $this->set('pagetitle', 'Manage Corporate Users');
    $users = $this->User->Group->find('first', array('recursive'=>2,'conditions' => array('title' => 'Corporate')));
    $this->set('users', $users);
    $this->set('add_link', '<a href="/corporate/users/add_admin">Add Corporate User</a>');
    $this->set('edit_link', 'edit_admin');
    $this->set('delete_link', 'delete_admin');
    $this->set('view_link', 'view_admin');
    $this->render('list');
  }
  
  public function corporate_add_admin() {
    $this->set('pagetitle', 'Add Corporate User');
    $this->set('group_list', $this->group_list);
    $this->set('list_link', '<a href="/corporate/users/admins_list">Back to list</a>');
    if ($this->request->is(array('post', 'put'))) {
      $this->request->data['User']['activated'] = 1;
      if ($this->User->saveAll($this->request->data)) {
        $this->Session->setFlash('Successfully added corporate user.', array('default'), array('class'=>'success'));
        $this->redirect(array('action' => 'admins_list'));
      }
      $this->Session->setFlash(__('Unable to add corporate user.'));
    }
    $this->render('add');
  }
  
  public function corporate_edit_admin($id = null) {
    $this->set('pagetitle', 'Update Corporate User\'s Record');
    $this->set('group_list', $this->group_list);
    $this->set('list_link', '<a href="/corporate/users/admins_list">Back to list</a>');
    if ($this->request->is(array('post', 'put'))) {
      if ($this->User->saveAll($this->request->data)) {
        $this->Session->setFlash('Successfully updated corporate user.', array('default'), array('class'=>'success'));
        $this->redirect(array('action' => 'admins_list'));
      }
      $this->Session->setFlash(__('Unable to update corporate user.'));
    }
    $this->request->data = $this->User->findById($id);
    $this->render('edit');
  }
  
  public function corporate_delete_admin($id = null) {
    if (!empty($id)) {
      $this->request->data['User']['deleted'] = 1;
      $this->request->data['User']['id'] = $id;
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash('Successfully deleted corporate user.', array('default'), array('class'=>'success'));
        $this->redirect(array('action' => 'admins_list'));
      }
      $this->Session->setFlash(__('Unable to delete corporate user.'));      
    }
    $this->redirect('/corporate/users/admins_list');
    $this->autoRender = false;
  }
  
  public function corporate_view_admin($id = null) {
    $this->set('pagetitle', 'View Admin User\'s Record');
    $this->set('list_link', '<a href="/corporate/users/admins_list">Back to list</a>');
    if (!empty($id)) {
    }
    $this->render('view');
  }
  
  public function dashboard_teachers_list() {
    $this->set('pagetitle', 'Manage Teachers');
    $users = $this->User->Group->find('first', array('recursive'=>2,'conditions' => array('title' => 'Teacher')));
    $this->set('users', $users);
    $this->set('add_link', '<a href="/corporate/users/add_teacher">Add Teacher</a>');
    $this->set('edit_link', 'edit_teacher');
    $this->set('delete_link', 'delete_teacher');
    $this->set('view_link', 'view_teacher');
    $this->render('list');
  }
  
  public function dashboard_add_teacher() {
    $this->set('pagetitle', 'Add Teacher');
    $this->set('group_list', $this->group_list);
    $this->set('list_link', '<a href="/corporate/users/teachers_list">Back to list</a>');
    if ($this->request->is(array('post', 'put'))) {
      $this->request->data['User']['activated'] = 1;
      if ($this->User->saveAll($this->request->data)) {
        $this->Session->setFlash('Successfully added teacher user.', array('default'), array('class'=>'success'));
        $this->redirect(array('action' => 'teachers_list'));
      }
      $this->Session->setFlash(__('Unable to add teacher user.'));
    }
    $this->render('add');
  }
  
  public function dashboard_edit_teacher($id = null) {
    $this->set('pagetitle', 'Update Corporate User\'s Record');
    $this->set('group_list', $this->group_list);
    $this->set('list_link', '<a href="/corporate/users/teachers_list">Back to list</a>');
    if ($this->request->is(array('post', 'put'))) {
      if ($this->User->saveAll($this->request->data)) {
        $this->Session->setFlash('Successfully updated teacher user.', array('default'), array('class'=>'success'));
        $this->redirect(array('action' => 'teachers_list'));
      }
      $this->Session->setFlash(__('Unable to update teacher user.'));
    }
    $this->request->data = $this->User->findById($id);
    $this->render('edit');
  }
  
  public function dashboard_delete_teacher($id = null) {
    if (!empty($id)) {
      $this->request->data['User']['deleted'] = 1;
      $this->request->data['User']['id'] = $id;
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash('Successfully deleted teacher user.', array('default'), array('class'=>'success'));
        $this->redirect(array('action' => 'teachers_list'));
      }
      $this->Session->setFlash(__('Unable to delete teacher user.'));      
    }
    $this->redirect('/corporate/users/teachers_list');
    $this->autoRender = false;
  }
  
  public function dashboard_getting_started() {
    $this->layout = 'inline';
  }
		
		public function profile($id = null) {
				header('Access-Control-Allow-Origin: *');
				header('Access-Control-Allow-Methods: POST');
				header('Access-Control-Max-Age: 1000');
				if (!empty($this->request->data['ajax']) && $this->request->data['ajax'] == true) {
						$this->User->unbindModel(array('hasAndBelongsToMany' => array('Follower', 'Following')));
						$this->User->bindModel(array(
																																			'hasOne' => array('Followed' => array(
																																																																								'className' => 'Follow',
																																																																								'conditions' => array(
																																																																																														'Followed.user_id' => $this->Auth->user('id'),
																																																																																														'Followed.follow_id' => $id,
																																																																																														'Followed.is_deleted' => 0
																																																																																														)
																																																																								)
																																																				),
																																			'hasAndBelongsToMany' => array(
																																																																		'Follower' => array(
																																																																																						'className' => 'User',
																																																																																						'joinTable' => 'follows',
																																																																																						'foreignKey' => 'user_id',
																																																																																						'associationForeignKey' => 'follow_id',
																																																																																						'conditions' => array('is_deleted' => 0),
																																																																																						'limit' => 3,
																																																																																						'order' => array('Follower.created' => 'DESC')
																																																																																						),
																																																																		'Following' => array(
																																																																																							'className' => 'User',
																																																																																							'joinTable' => 'follows',
																																																																																							'foreignKey' => 'follow_id',
																																																																																							'associationForeignKey' => 'user_id',
																																																																																							'conditions' => array('is_deleted' => 0),
																																																																																							'limit' => 3,
																																																																																							'order' => array('Following.created' => 'DESC')
																																																																																						)	
																																																																		)
																																			)
																													);
						$profile = $this->User->find('first', array('recursive' => 3, 'conditions' => array('User.id' => $id)));
						echo json_encode($profile);
						$this->autoRender = false;
						$this->layout = 'ajax';
				} else {
						if (empty($id)) {
								$this->redirect('/');
						}
						$this->User->unbindModel(array('hasAndBelongsToMany' => array('Follower', 'Following')));
						$this->User->bindModel(array(
																																			'hasOne' => array('Followed' => array(
																																																																								'className' => 'Follow',
																																																																								'conditions' => array(
																																																																																														'Followed.user_id' => $this->Auth->user('id'),
																																																																																														'Followed.follow_id' => $id,
																																																																																														'Followed.is_deleted' => 0
																																																																																														)
																																																																								)
																																																				),
																																			'hasAndBelongsToMany' => array(
																																																																		'Follower' => array(
																																																																																						'className' => 'User',
																																																																																						'joinTable' => 'follows',
																																																																																						'foreignKey' => 'user_id',
																																																																																						'associationForeignKey' => 'follow_id',
																																																																																						'conditions' => array('is_deleted' => 0),
																																																																																						'limit' => 3,
																																																																																						'order' => array('Follower.created' => 'DESC')
																																																																																						),
																																																																		'Following' => array(
																																																																																							'className' => 'User',
																																																																																							'joinTable' => 'follows',
																																																																																							'foreignKey' => 'follow_id',
																																																																																							'associationForeignKey' => 'user_id',
																																																																																							'conditions' => array('is_deleted' => 0),
																																																																																							'limit' => 3,
																																																																																							'order' => array('Following.created' => 'DESC')
																																																																																						)	
																																																																		)
																																			)
																													);
						$profile = $this->User->find('first', array('recursive' => 3, 'conditions' => array('User.id' => $id)));
						$this->set('profile', $profile);
						$this->layout = 'default';
				}
		}
		
		public function followers($id = null) {
				if (empty($id)) {
						$this->redirect('/');
				}
				$this->User->unbindModel(array('hasAndBelongsToMany' => array('Follower', 'Following')));
				$this->User->bindModel(array(
																																	'hasOne' => array('Followed' => array(
																																																																						'className' => 'Follow',
																																																																						'conditions' => array(
																																																																																												'Followed.user_id' => $this->Auth->user('id'),
																																																																																												'Followed.follow_id' => $id,
																																																																																												'Followed.is_deleted' => 0
																																																																																												)
																																																																						)
																																																		),
																																	'hasAndBelongsToMany' => array(
																																																																'Follower' => array(
																																																																																				'className' => 'User',
																																																																																				'joinTable' => 'follows',
																																																																																				'foreignKey' => 'user_id',
																																																																																				'associationForeignKey' => 'follow_id',
																																																																																				'conditions' => array('is_deleted' => 0),
																																																																																				'order' => array('Follower.created' => 'DESC')
																																																																																				),
																																																																'Following' => array(
																																																																																					'className' => 'User',
																																																																																					'joinTable' => 'follows',
																																																																																					'foreignKey' => 'follow_id',
																																																																																					'associationForeignKey' => 'user_id',
																																																																																					'conditions' => array('is_deleted' => 0),
																																																																																					'limit' => 3,
																																																																																					'order' => array('Following.created' => 'DESC')
																																																																																				)	
																																																																)
																																	)
																											);
				$profile = $this->User->find('first', array('recursive' => 3, 'conditions' => array('User.id' => $id)));
				$this->set('profile', $profile);
				$this->layout = 'default';
		}
		
		public function followings($id = null) {
				if (empty($id)) {
						$this->redirect('/');
				}
				$this->User->unbindModel(array('hasAndBelongsToMany' => array('Follower', 'Following')));
				$this->User->bindModel(array(
																																	'hasOne' => array('Followed' => array(
																																																																						'className' => 'Follow',
																																																																						'conditions' => array(
																																																																																												'Followed.user_id' => $this->Auth->user('id'),
																																																																																												'Followed.follow_id' => $id,
																																																																																												'Followed.is_deleted' => 0
																																																																																												)
																																																																						)
																																																		),
																																	'hasAndBelongsToMany' => array(
																																																																'Follower' => array(
																																																																																				'className' => 'User',
																																																																																				'joinTable' => 'follows',
																																																																																				'foreignKey' => 'user_id',
																																																																																				'associationForeignKey' => 'follow_id',
																																																																																				'conditions' => array('is_deleted' => 0),
																																																																																				'limit' => 3,
																																																																																				'order' => array('Follower.created' => 'DESC')
																																																																																				),
																																																																'Following' => array(
																																																																																					'className' => 'User',
																																																																																					'joinTable' => 'follows',
																																																																																					'foreignKey' => 'follow_id',
																																																																																					'associationForeignKey' => 'user_id',
																																																																																					'conditions' => array('is_deleted' => 0),
																																																																																					'order' => array('Following.created' => 'DESC')
																																																																																				)	
																																																																)
																																	)
																											);
				$profile = $this->User->find('first', array('recursive' => 3, 'conditions' => array('User.id' => $id)));
				$this->set('profile', $profile);
				$this->layout = 'default';
		}
		
		public function follow($id = null) {
				$this->autoRender = false;
				if ($this->request->is('ajax')) {
						$this->layout = 'ajax';
						if (!empty($id)) {
								if ($id != $this->Auth->user('id')) {
										$exist = $this->User->Following->find('first', array('conditions' => array('is_deleted' => 0, 'user_id' => $this->Auth->user('id'), 'follow_id' => $id), 'fields' => array('id'), 'recursive' => -1));
										if (empty($exist)) {
												$data['Following'] = array('user_id' => $this->Auth->user('id'), 'follow_id' => $id, 'is_deleted' => 0);
												if ($this->User->Following->save($data)) {
														echo json_encode('success');
												} else {
														echo json_encode('failed');
												}
										}
								}
						}
				} else {
						if (empty($id)) {
								$this->redirect('/');
						} else {
								$exist = $this->User->Following->find('first', array('conditions' => array('is_deleted' => 0, 'user_id' => $this->Auth->user('id'), 'follow_id' => $id), 'recursive' => 1));
								if (empty($exist)) {
										$data['Following'] = array('user_id' => $this->Auth->user('id'), 'follow_id' => $id, 'is_deleted' => 0);
										if ($this->User->Following->save($data)) {
												$this->Session->setFlash('You are now following ' . $exist['Profile']['0']['first_name'] . '.', 'default', array('class'=>'success'));
										} else {
												$this->Session->setFlash('Oops! Something went wrong. Please try again later.');
										}
										$this->redirect('/users/profile/' . $id);
								}
						}
				}
		}
		
		public function unfollow($id = null) {
				$this->autoRender = false;
				if ($this->request->is('ajax')) {
						$this->layout = 'ajax';
						if (!empty($id)) {
								if ($id != $this->Auth->user('id')) {
										$exist = $this->User->Following->find('first', array('conditions' => array('is_deleted' => 0, 'user_id' => $this->Auth->user('id'), 'follow_id' => $id), 'fields' => array('id'), 'recursive' => -1));
										if (!empty($exist)) {
												$this->User->Following->id = $exist['Following']['id'];
												if ($this->User->Following->saveField('is_deleted', 1)) {
														echo json_encode('success');
												} else {
														echo json_encode('failed');
												}
										}
								}
						}
				} else {
						if (empty($id)) {
								$this->redirect('/');
						} else {
								if (!empty($exist)) {
										$this->User->Following->id = $exist['Following']['id'];
										if ($this->User->Following->saveField('is_deleted', 1)) {
												$this->Session->setFlash('You\'ve just unfollowed ' . $exist['Profile']['0']['first_name'] . '.', 'default', array('class'=>'success'));
										} else {
												$this->Session->setFlash('Oops! Something went wrong. Please try again later.');
										}
								}
								$this->redirect('/users/profile/' . $id);
						}
				}
		}
		
}

?>
