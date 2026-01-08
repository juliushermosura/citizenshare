<?php

class ClassesController extends AppController {
  public $layout = 'inline';
  public $uses = array('OnlineClass');
  public $components = array('Wistia', 'Paginator');
  public $helpers = array('Paginator');

  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('index', 'view', 'category');
    $this->set('active', 3);
  }
  
  public function dashboard_index() {
    $classes = $this->OnlineClass->find('all', array('conditions' => array('OnlineClass.is_deleted' => 0, 'OnlineClass.user_id' => $this->Auth->user('id'))));
    $this->set('classes', $classes);
    $categories = $this->OnlineClass->ClassCategory->find('all', array('conditions' => array('OR' => array(array('ClassCategory.user_id' => $this->Auth->user('id')), array('ClassCategory.user_id' => null)), 'ClassCategory.is_deleted' => 0, 'ClassCategory.is_suspended' => 0, 'ClassCategory.admin_approved' => 1)));
    $this->set('categories', $categories);
  }

  public function corporate_index() {
  }
  
  public function dashboard_promote() {
    $classes = $this->OnlineClass->find('all', array('conditions' => array('OnlineClass.is_deleted' => 0, 'OnlineClass.user_id' => $this->Auth->user('id'))));
    $this->set('classes', $classes);
  }

  public function corporate_promote() {
    $this->set('active', 6);
  }
  
  public function dashboard_category_list() {
    $this->render('category_list');
  }
  
  public function dashboard_field($id = null) {
    if (!empty($id)) {
      if ($this->request->is(array('post', 'put'))) {
        $this->OnlineClass->id = $id;
        if ($this->OnlineClass->saveField($this->request->data['field'], $this->request->data['value'])) {
          echo json_encode('success');
        }
      }
    }
    $this->autoRender = false;
  }
  
  public function dashboard_add_category() {
    $this->render('add_category');
    if ($this->request->is(array('post'))) {
      $this->request->data['ClassCategory']['user_id'] = $this->Auth->user('id');
      $this->request->data['ClassCategory']['admin_approved'] = 1; //@TODO remove this after UAT
      if ($this->OnlineClass->ClassCategory->save($this->request->data)) {
        $this->Session->setFlash('Successfully added a new category.', array(), array('class' => 'success'));
      }
    }
  }
  
  public function dashboard_edit_category($id = null) {
    $this->render('edit_category');    
  }

  public function dashboard_view_category($id = null) {
    $this->render('view_category');
  }

  public function dashboard_delete_category($id = null) {
    $this->autoRender = false;
  }
  
  public function dashboard_list($id = null) {
    $classes = $this->OnlineClass->find('all', array('conditions' => array('OnlineClass.class_category_id' => $id, 'OnlineClass.is_deleted' => 0, 'OnlineClass.user_id' => $this->Auth->user('id'))));
    $this->set('classes', $classes);
    $categories = $this->OnlineClass->ClassCategory->find('all', array('conditions' => array('OR' => array(array('ClassCategory.user_id' => $this->Auth->user('id')), array('ClassCategory.user_id' => null)), 'ClassCategory.is_deleted' => 0, 'ClassCategory.is_suspended' => 0, 'ClassCategory.admin_approved' => 1)));
    $this->set('categories', $categories);
    $selected_category = $this->OnlineClass->ClassCategory->find('first', array('conditions' => array('is_suspended' => 0, 'is_deleted' => 0, 'ClassCategory.id' => $id)));
    $this->set('selected_category', $selected_category);
    $this->render('dashboard_index');
  }

  public function dashboard_update() {
    if (!empty($this->request->data)) {
      if ($this->OnlineClass->save($this->request->data)) {
        echo json_encode('success');
      }
    }
    $this->autoRender = false;
  }
  
  public function dashboard_add() {
    if (isset($this->request->query['inline']) && $this->request->query['inline'] == 1 || $this->request->query['inline'] == 2) {
      $this->layout = 'inline';
    }
    if ($this->request->is(array('post'))) {
      $this->request->data['OnlineClass']['user_id'] = $this->Auth->user('id');
      if ($this->OnlineClass->save($this->request->data)) {
        if ($this->request->query['inline'] == 2) {
          $this->autoRender = false;
          echo '<script>';
          echo '$.fancybox.close()';
          echo '</script>';
        }
        $this->Session->setFlash('Successfully added your class.', 'default', array('class'=>'success'));
        if (isset($this->request->query['inline']) && $this->request->query['inline'] == 1) {
          $this->redirect(array('dashboard' => true, 'controller' => 'lessons', 'action' => 'add', $this->OnlineClass->getLastInsertId(), '?' => array('inline' => 1)));
        } else {
          $this->redirect(array('dashboard' => true, 'controller' => 'lessons', 'action' => 'add2', '?' => array('inline' => 2)));
        }
      }
      $this->Session->setFlash(__('Unable to add your class.'));
    }
    $this->set('my_category', $this->OnlineClass->ClassCategory->find('list', array('conditions' => array('OR' => array(array('ClassCategory.user_id' => $this->Auth->user('id')), array('ClassCategory.user_id' => null)), 'ClassCategory.is_deleted' => 0, 'ClassCategory.is_suspended' => 0, 'ClassCategory.admin_approved' => 1))));
    $this->render('add');
  }
  
  public function dashboard_edit($id = null) {
    $this->render('edit');
  }

  public function dashboard_view($id = null) {
    $this->render('view');
  }

  public function dashboard_delete($id = null) {
    $this->autoRender = false;
    $this->OnlineClass->id = $id;
    $this->OnlineClass->saveField('is_deleted', 1);
  }
  
  public function index() {
    $owner = $this->Session->read('owner');
    $classes = $this->OnlineClass->find('all', array('recursive' => 2, 'conditions' => array('OnlineClass.is_deleted' => 0, 'OnlineClass.is_suspended' => 0, 'OnlineClass.user_id' => $owner['User']['id'])));
    $this->set('classes', $classes);
    $this->layout = 'default';
  }
  
  public function category($id = null) {
    if (empty($id)) {
      $this->redirect(array('action'=>'index'));
    }
    $category = $this->OnlineClass->ClassCategory->findById($id);
    $owner = $this->Session->read('owner');
    $classes = $this->OnlineClass->find('all', array('recursive' => 2, 'conditions' => array('OnlineClass.class_category_id' => $id, 'OnlineClass.user_id' => $owner['User']['id'])));
    $this->set('category', $category);
    $this->set('classes', $classes);
    $this->layout = 'default';
  }
  
  public function view($id = null, $tab = null) {
    if (empty($id)) {
      $this->redirect('/classes');
    }
    $owner_id = $this->Session->read('owner');
    $this->OnlineClass->Project->bindModel(array(
                                        'hasOne' => array('MyLike' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('MyLike.like'), 'conditions' => array('MyLike.like' => 1, 'MyLike.user_id' => $this->Auth->user('id')))),
                                        'hasMany' => array(
                                                           'LikeCount' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('id'), 'conditions' => array('like' => 1)),
                                                           'CommentCount' => array('className' => 'Comment', 'foreignKey' => 'parent_id', 'fields' => array('id')),
                                                           )
                                        ));
    $class = $this->OnlineClass->find('first', array('recursive' => 3, 'conditions' => array('OnlineClass.is_deleted' => 0, 'OnlineClass.is_suspended' => 0, 'OnlineClass.id' => $id, 'OnlineClass.user_id' => $owner_id['User']['id'])));
    $this->OnlineClass->Discussion->bindModel(array(
                                                    'hasOne' => array('MyLike' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('MyLike.like'), 'conditions' => array('MyLike.like' => 1, 'MyLike.user_id' => $this->Auth->user('id')))),
                                                    'hasMany' => array('LikeCount' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('id'), 'conditions' => array('like' => 1)))
                                                    ));
    if (in_array($tab, array('conversations', 'events' , 'teacher_announcements'))) {
      $this->Paginator->settings = array('limit' => 20, 'order' => array('Discussion.created' => 'DESC'), 'recursive' => 2, 'conditions' => array('online_class_id' => $id, 'Discussion.type' => $tab));
    } else {
      $this->Paginator->settings = array('limit' => 20, 'order' => array('Discussion.created' => 'DESC'), 'recursive' => 2, 'conditions' => array('online_class_id' => $id));
    }
    $discussion = $this->Paginator->paginate('Discussion');
    $discussion = $this->OnlineClass->Discussion->find('all', array('order'=>array('Discussion.modified DESC'), 'recursive' => 2, 'conditions' => array('Discussion.online_class_id' => $id)));
    $ctr = 0;
    if (!empty($class['Lesson'])) {
      foreach($class['Lesson'] as $lesson) {
        $wistia = json_decode($lesson['wistia'] ,true);
        if ($wistia['status'] != 'ready' || $wistia == false) { // check if status in record is still queued 
          $stat = $this->Wistia->show($wistia['hashed_id']); // get the latest stat from wistia
          $this->OnlineClass->Lesson->id = $lesson['id'];
          if ($this->OnlineClass->Lesson->saveField('wistia', $stat)) { // update and save the record in db
            $class['Lesson'][$ctr]['wistia'] = $stat; // update the fetched data so no need to fetch the updated record from the db
          }
        }
        $ctr++;
      }
    }
    $this->set('class', $class);
    $this->set('discussion', $discussion);
    $this->layout = 'default';
    if ($tab != null) {
      if (in_array($tab, array('project_task', 'class_projects', 'conversations', 'events', 'teacher_announcements'))) {
        $this->render($tab);
      }
    }
  }
  
}

?>
