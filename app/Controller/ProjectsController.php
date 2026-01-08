<?php

class ProjectsController extends AppController {
  var $layout = 'inline';

  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('index', 'view');
    $this->set('active', 5);
  }
  
  public function dashboard_index() {
    $this->Project->bindModel(array(
                                    'hasOne' => array('MyLike' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('MyLike.like'), 'conditions' => array('MyLike.like' => 1, 'MyLike.user_id' => $this->Auth->user('id')))),
                                    'hasMany' => array(
                                                       'LikeCount' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('id'), 'conditions' => array('like' => 1)),
                                                       'CommentCount' => array('className' => 'Comment', 'foreignKey' => 'parent_id', 'fields' => array('id')),
                                                       )
                                    ));
    $projects = $this->Project->find('all', array('recursive' => 3, 'conditions' => array('Project.is_deleted' => 0, 'Project.is_suspended' => 0, 'Project.user_id' => $this->Auth->user('id'))));
    $this->set('projects', $projects);
  }
  
  public function corporate_index() {
  }
  
  public function dashboard_edit($id = null) {
    if (empty($id)) {
      $this->redirect('/projects');
    }
    if ($this->request->is(array('post', 'put'))) {
      if ($this->Project->save($this->request->data)) {
        $this->Session->setFlash('Record has been saved successfully.', 'default', array('class'=>'success'));
      }
    }
    $this->Project->bindModel(array(
                                    'hasOne' => array('MyLike' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('MyLike.like'), 'conditions' => array('MyLike.like' => 1, 'MyLike.user_id' => $this->Auth->user('id')))),
                                    'hasMany' => array(
                                                       'LikeCount' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('id'), 'conditions' => array('like' => 1)),
                                                       'CommentCount' => array('className' => 'Comment', 'foreignKey' => 'parent_id', 'fields' => array('id')),
                                                       'CommentReply' => array('className' => 'Comment', 'foreignKey' => 'parent_id', 'conditions' => array('parent_table' => 'comment')),
                                                       'Comment' => array('className' => 'Comment', 'foreignKey' => 'parent_id', 'conditions' => array('parent_table' => 'project'))
                                                       )
                                    ));
    $class = $this->Project->find('first', array('recursive' => 3, 'conditions' => array('Project.id' => $id, 'Project.user_id' => $this->Auth->user('id'))));
    $classes = $this->Project->OnlineClass->find('list', array('conditions' => array('OnlineClass.is_deleted' => 0, 'OnlineClass.is_suspended' => 0)));
    $this->set('classes', $classes);
    $this->request->data = $class;
    $this->set('project', $class);
  }
  
  public function dashboard_delete($id = null) {
    if (!empty($id)) {
      $this->Project->id = $id;
      if ($this->Project->saveField('is_deleted', 1)) {
        echo json_encode('success');
      }
      $this->autoRender = false;
    }
  }
  
  public function dashboard_add2() {
    if (isset($this->request->query['inline']) && $this->request->query['inline'] == 2) {
      $this->layout = 'inline';
    }
    if ($this->request->is(array('post', 'put'))) {
      $this->request->data['Project']['user_id'] = $this->Auth->user('id');
      //$this->request->data['Project']['online_class_id'] = $id;
      if ($this->Project->save($this->request->data)) {
        $this->redirect(array('dashboard' => true, 'action' => 'add2', $this->request->data['Project']['online_class_id'], '?' => array('inline' => 2)));
        $this->Session->setFlash('Successfully added your project.', 'default', array('class'=>'success'));
      } else {
        $this->Session->setFlash(__('Unable to add your project.'));
      }
    }
    $classes = $this->Project->OnlineClass->find('list', array('conditions' => array('OnlineClass.user_id' => $this->Auth->user('id'), 'OnlineClass.is_deleted' => 0, 'OnlineClass.is_suspended' => 0)));
    $this->set('classes', $classes);
    $projects = $this->Project->find('all', array('conditions' => array('Project.user_id' => $this->Auth->user('id'), 'OnlineClass.is_deleted' => 0, 'OnlineClass.is_suspended' => 0,), 'recursive' => 1, 'order' => array('order' => 'ASC' ,'Project.created' => 'DESC')));
    $this->set('projects', $projects);
    $this->render('add');
  }
  
  public function dashboard_add($id = null) {
    if (isset($this->request->query['inline']) && $this->request->query['inline'] == 1) {
      $this->layout = 'inline';
    }
    if ($this->request->is(array('post', 'put'))) {
      $this->request->data['Project']['user_id'] = $this->Auth->user('id');
      //$this->request->data['Project']['online_class_id'] = $id;
      if ($this->Project->save($this->request->data)) {
        $this->redirect(array('dashboard' => true, 'action' => 'add', $id, '?' => array('inline' => 1)));
        $this->Session->setFlash('Successfully added your project.', 'default', array('class'=>'success'));
      } else {
        $this->Session->setFlash(__('Unable to add your project.'));
      }
    }
    $classes = $this->Project->OnlineClass->find('list', array('conditions' => array('OnlineClass.user_id' => $this->Auth->user('id'), 'OnlineClass.is_deleted' => 0, 'OnlineClass.is_suspended' => 0)));
    $this->set('classes', $classes);
    $projects = $this->Project->find('all', array('conditions' => array('Project.user_id' => $this->Auth->user('id'), 'OnlineClass.is_deleted' => 0, 'OnlineClass.is_suspended' => 0,), 'recursive' => 1, 'order' => array('order' => 'ASC' ,'Project.created' => 'DESC')));
    $this->set('projects', $projects);
    $this->render('add');
  }
  
  public function index() {
    $this->layout = 'default';
    $owner = $this->Session->read('owner');
    $this->Project->bindModel(array(
                                    'hasOne' => array('MyLike' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('MyLike.like'), 'conditions' => array('MyLike.like' => 1, 'MyLike.user_id' => $this->Auth->user('id')))),
                                    'hasMany' => array(
                                                       'LikeCount' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('id'), 'conditions' => array('like' => 1)),
                                                       'CommentCount' => array('className' => 'Comment', 'foreignKey' => 'parent_id', 'fields' => array('id')),
                                                       )
                                    ));
    $projects = $this->Project->find('all', array('recursive' => 3, 'conditions' => array('Project.user_id' => $owner['User']['id'])));
    $this->set('projects', $projects);
  }
  
  public function view($id = null) {
    if (empty($id)) {
      $this->redirect('/projects');
    }
    $owner_id = $this->Session->read('owner');
    $this->Project->bindModel(array(
                                    'hasOne' => array('MyLike' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('MyLike.like'), 'conditions' => array('MyLike.like' => 1, 'MyLike.user_id' => $this->Auth->user('id')))),
                                    'hasMany' => array(
                                                       'LikeCount' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('id'), 'conditions' => array('like' => 1)),
                                                       'CommentCount' => array('className' => 'Comment', 'foreignKey' => 'parent_id', 'fields' => array('id')),
                                                       'CommentReply' => array('className' => 'Comment', 'foreignKey' => 'parent_id', 'conditions' => array('parent_table' => 'comment')),
                                                       'Comment' => array('className' => 'Comment', 'foreignKey' => 'parent_id', 'conditions' => array('parent_table' => 'project'))
                                                       )
                                    ));
    $class = $this->Project->find('first', array('recursive' => 3, 'conditions' => array('Project.id' => $id, 'Project.user_id' => $owner_id['User']['id'])));
    $this->Project->Comment->bindModel(array(
                                        'hasOne' => array('MyLike' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('MyLike.like'), 'conditions' => array('MyLike.like' => 1, 'MyLike.user_id' => $this->Auth->user('id')))),
                                        'hasMany' => array(
                                                           'LikeCount' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('id'), 'conditions' => array('like' => 1)),
                                                           'CommentReply' => array('className' => 'Comment', 'foreignKey' => 'parent_id', 'conditions' => array('parent_table' => 'comment')),
                                                           )
                                        ));
    $comments = $this->Project->Comment->find('all', array('order' => array('Comment.created' => 'ASC'), 'recursive' => 3, 'conditions' => array('Comment.parent_id' => $id)));
    $this->set('comments', $comments);
    $this->set('class', $class);
    $this->layout = 'default';
  }
  
  public function like() {
    if ($this->request->is('ajax')) {
      if ($this->Auth->user('id')) {
        $liked = $this->Project->Like->find('first', array('conditions' => array('Like.parent_id' => $this->request->data['discussion_id'], 'Like.user_id' => $this->Auth->user('id'))));
        if (empty($liked)) {
          $data['Like'] = array('user_id' => $this->Auth->user('id'), 'parent_id' => $this->request->data['discussion_id'], 'type' => 'projects', 'like' => 1);
          if ($this->Project->Like->save($data)) {
            echo json_encode('success');
          } else {
            echo json_encode('failed');
          }
        } else {
          if ($liked['Like']['like'] == 0) {
            $data['Like'] = array('id' => $liked['Like']['id'], 'user_id' => $this->Auth->user('id'), 'parent_id' => $this->request->data['discussion_id'], 'type' => 'projects', 'like' => 1);
            if ($this->Project->Like->save($data)) {
              echo json_encode('success');
            } else {
              echo json_encode('failed');
            }            
          } else {
            echo json_encode('failed');
          }
        }
      } else {
        echo json_encode('failed');
      }
    } else {
      echo json_encode('failed');
    }
    $this->autoRender = false;
  }
  
  public function unlike() {
    if ($this->request->is('ajax')) {      
      if ($this->Auth->user('id')) {
        $liked = $this->Project->Like->find('first', array('conditions' => array('Like.parent_id' => $this->request->data['discussion_id'], 'Like.type' => 'projects', 'user_id' => $this->Auth->user('id'), 'Like.like' => 1)));
        if (!empty($liked)) {
          $data['Like'] = array('id' => $liked['Like']['id'], 'like' => 0);
          if ($this->Project->Like->save($data)) {
            echo json_encode('success');
          } else {
            echo json_encode('failed');
          }
        } else {
          echo json_encode('failed');
        }
      } else {
        echo json_encode('failed');
      }
    } else {
      echo json_encode('failed');
    }
    $this->autoRender = false;
  }
  
}

?>
