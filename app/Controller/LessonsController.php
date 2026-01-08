<?php

class LessonsController extends AppController {
  public $layout = 'inline';
  public $components = array('Wistia');

  public function afterFilter() {
    if ($this->Auth->user()) {
      if (!$this->Session->check('dashboard')) {
        if (isset($this->request->query['inline']) && $this->request->query['inline'] == 1) {
          $this->layout = 'inline';
        }
      }
    }
  }

  public function beforeFilter() {
    parent::beforeFilter();
    $this->set('active', 4);
  }
  
  public function dashboard_index() {
    $classes = $this->Lesson->OnlineClass->find('all', array('conditions' => array('OnlineClass.is_deleted' => 0, 'OnlineClass.user_id' => $this->Auth->user('id'))));
    $this->set('classes', $classes);
  }
  
  public function corporate_index() {
  }

  public function dashboard_add2() {
    if (isset($this->request->query['inline']) && $this->request->query['inline'] == 1 || $this->request->query['inline'] == 2) {
      $this->layout = 'inline';
    }
    if ($this->request->is(array('post', 'put'))) {
      $this->request->data['Lesson']['user_id'] = $this->Auth->user('id');
      $this->request->data['Lesson']['order'] = 0;
      if ($this->Lesson->save($this->request->data)) {
        
        $lesson_id = $this->Lesson->getLastInsertId();
        
        $this->loadModel('File');
        $filevid = $this->File->find('first', array('conditions' => array('File.id' => $this->data['Lesson']['file_id']), 'recursive' -1, 'fields' => array('File.name', 'File.type')));
        if (!empty($filevid)) {
          $status = $this->Wistia->upload($filevid);
        } else {
          
        }
        
        $this->Lesson->id = $lesson_id;
        $data['Lesson']['wistia'] = $status;
        $this->Lesson->save($data);
        
        $this->redirect(array('dashboard' => true, 'action' => 'add2', $this->request->data['Lesson']['online_class_id'], '?' => array('inline' => 2)));
        $this->Session->setFlash('Successfully added your lesson.', 'default', array('class'=>'success'));
      } else {
        $this->Session->setFlash(__('Unable to add your class.'));
      }
    }
    //$this->set('lessons', $this->Lesson->find('all', array('conditions' => array('online_class_id' => $this->request->data['Lesson']['online_class_id'], 'is_deleted' => 0, 'is_suspended' => 0,), 'recursive' => -1, 'fields' => array('title', 'description', 'wistia'), 'order' => array('order ASC' ,'created DESC'))));
    $this->set('classes', $this->Lesson->OnlineClass->find('list', array('conditions' => array('OnlineClass.user_id' => $this->Auth->user('id'), 'OnlineClass.is_deleted' => 0, 'OnlineClass.is_suspended' => 0))));
    $this->render('add2');
  }
  
  public function dashboard_add($id = null) {
    if (empty($id)) {
      if (isset($this->request->query['inline']) && $this->request->query['inline'] == 1) {
        $this->redirect(array('dashboard' => true, 'controller' => 'classes', 'action' => 'add', '?' => array('inline' => 1)));
      } else {
        $this->redirect(array('dashboard' => true, 'controller' => 'classes', 'action' => 'add'));
      }
    }
    if (isset($this->request->query['inline']) && $this->request->query['inline'] == 1) {
      $this->layout = 'inline';
    }
    if ($this->request->is(array('post', 'put'))) {
      $this->request->data['Lesson']['user_id'] = $this->Auth->user('id');
      $this->request->data['Lesson']['online_class_id'] = $id;
      $this->request->data['Lesson']['order'] = 0;
      if ($this->Lesson->save($this->request->data)) {
        
        $lesson_id = $this->Lesson->getLastInsertId();
        
        $this->loadModel('File');
        $filevid = $this->File->find('first', array('conditions' => array('File.id' => $this->data['Lesson']['file_id']), 'recursive' -1, 'fields' => array('File.name', 'File.type')));
        if (!empty($filevid)) {
          $status = $this->Wistia->upload($filevid);
        } else {
          
        }
        
        $this->Lesson->id = $lesson_id;
        $data['Lesson']['wistia'] = $status;
        $this->Lesson->save($data);
        
        $this->redirect(array('dashboard' => true, 'action' => 'add', $id, '?' => array('inline' => 1)));
        $this->Session->setFlash('Successfully added your lesson.', 'default', array('class'=>'success'));
      } else {
        $this->Session->setFlash(__('Unable to add your class.'));
      }
    }
    $this->set('lessons', $this->Lesson->find('all', array('conditions' => array('online_class_id' => $id, 'is_deleted' => 0, 'is_suspended' => 0,), 'recursive' => -1, 'fields' => array('title', 'description', 'wistia'), 'order' => array('order ASC' ,'created DESC'))));
    $this->render('add');
  }
  
  public function dashboard_delete($id = null) {
    if (!empty($id)) {
      $existing_id = $this->Lesson->find('first', array('conditions' => array('Lesson.id' => $id)));
      if (!empty($existing_id)) {
        $this->Lesson->id = $id;
        if ($this->Lesson->saveField('is_deleted', 1)) {
          echo json_encode('success');
        }
      }
    }
    $this->autoRender = false;
  }
  
  public function dashboard_edit($id = null) {
    if (empty($id)) {
      if (isset($this->request->query['inline']) && $this->request->query['inline'] == 1) {
        $this->redirect(array('dashboard' => true, 'controller' => 'classes', 'action' => 'edit', '?' => array('inline' => 1)));
      } else {
        $this->redirect(array('dashboard' => true, 'controller' => 'classes', 'action' => 'edit'));
      }
    }
    if (isset($this->request->query['inline']) && $this->request->query['inline'] == 1) {
      $this->layout = 'inline';
    }
    if ($this->request->is(array('post', 'put'))) {
      $existing_id = $this->Lesson->find('first', array('conditions' => array('Lesson.id' => $id, 'Lesson.is_deleted' => 0, 'Lesson.is_suspended' => 0)));
      if (!empty($existing_id)) {
        $this->request->data['Lesson']['id'] = $id;
        $this->request->data['Lesson']['order'] = 0;
        if ($this->Lesson->save($this->request->data)) {
          
          $lesson_id = $id;
          if (!empty($this->request->data['Lesson']['file_id'])) {
            $this->loadModel('File');
            $filevid = $this->File->find('first', array('conditions' => array('File.id' => $this->data['Lesson']['file_id']), 'recursive' -1, 'fields' => array('File.name', 'File.type')));
            if (!empty($filevid)) {
              $status = $this->Wistia->upload($filevid);
              $this->Lesson->id = $lesson_id;
              $data['Lesson']['wistia'] = $status;
              $this->Lesson->save($data);
            } else {
              
            }
          }
          
          $this->redirect(array('dashboard' => true, 'action' => 'edit', $id, '?' => array('inline' => 1)));
          $this->Session->setFlash('Successfully added your lesson.', 'default', array('class'=>'success'));
        } else {
          $this->Session->setFlash(__('Unable to add your class.'));
        }
      }
    } else {
      $this->request->data = $this->Lesson->find('first', array('conditions' => array('Lesson.id' => $id, 'Lesson.is_deleted' => 0, 'Lesson.is_suspended' => 0)));
    }
    $this->set('lessons', $this->Lesson->find('all', array('conditions' => array('online_class_id' => $id, 'is_deleted' => 0, 'is_suspended' => 0,), 'recursive' => -1, 'fields' => array('title', 'description', 'wistia'), 'order' => array('order ASC' ,'created DESC'))));
    $this->render('edit');
  
  }
  
  public function dashboard_sort() {
    if ($this->request->is(array('post', 'put'))) {
      $positions = explode(';', $this->request->data['positions']);
      $ctr = 0;
      foreach($positions as $pos) {
        $ctr++;
        $filter = str_replace('=' . $ctr, '', str_replace('lesson-', '', $pos, $cnt));
        if ($cnt == 1) {
          $clean_pos[] = $filter;
        }
      }
      $ctr = 0;
      foreach($clean_pos as $pos) {
        $ctr++;
        $this->Lesson->id = $pos;
        $this->Lesson->saveField('order', $ctr);
      }
    }
    echo json_encode('success');
    $this->autoRender = false;
  }
  
}

?>
