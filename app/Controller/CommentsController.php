<?php

class CommentsController extends AppController {
  
  public function beforeFilter() {
    parent::beforeFilter();
    // Allow users to register and logout.
    $this->Auth->allow('get_list');
  }
  
  public function add() {
    $user = $this->Comment->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
    if ($this->request->is('ajax')) {
      if ($this->Auth->user('id')) {
        $data['Comment'] = array('parent_id' => $this->request->data['parent_id'], 'parent_table' => $this->request->data['type'], 'message' => $this->request->data['message'], 'user_id' => $this->Auth->user('id'), 'is_approved' => 1);
        if ($this->Comment->save($data)) {
          echo json_encode(array('id' => $this->Comment->getLastInsertId(), 'date' => date('F dS'), 'user_id' => $this->Auth->user('id'), 'full_name' => $user['Profile']['0']['first_name'] . ' '  . $user['Profile']['0']['last_name'], 'avatar' => $user['File']['0']['name']));
        }
      }
    }
    $this->autoRender = false;
    exit;    
  }

  public function get_list($id = null) {
    if ($this->request->is('ajax')) {
      $list = $this->Comment->find('all', array('recursive' => 2, 'order' => array('Comment.created DESC'), 'conditions' => array('parent_id' => $id)));
      if (!empty($list)) {
        echo json_encode($list);
      } else {
        echo json_encode(array('message' => 'No post yet.'));
      }
    }
    $this->autoRender = false;
    exit;    
  }
  
  public function like_unlike() {
    if ($this->request->is('ajax')) {
      if ($this->Auth->user('id')) {
        $liked = $this->Comment->Like->find('first', array('conditions' => array('Like.parent_id' => $this->request->data['comment_id'], 'Like.user_id' => $this->Auth->user('id'))));
        if (empty($liked)) {
          $data['Like'] = array('user_id' => $this->Auth->user('id'), 'parent_id' => $this->request->data['comment_id'], 'type' => 'comments', 'like' => $this->request->data['likeval']);
          if ($this->Comment->Like->save($data)) {
            echo json_encode('success');
          } else {
            echo json_encode('failed');
          }
        } else {
          $data['Like'] = array('id' => $liked['Like']['id'], 'user_id' => $this->Auth->user('id'), 'parent_id' => $this->request->data['comment_id'], 'type' => 'comments', 'like' => $this->request->data['likeval']);
          if ($this->Comment->Like->save($data)) {
            echo json_encode('success');
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
}

?>