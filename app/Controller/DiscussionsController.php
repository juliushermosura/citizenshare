<?php

class DiscussionsController extends AppController {
  
  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('view');
  }
  
  public function add() {
    $user = $this->Discussion->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
    if ($this->request->is('ajax')) {
      if ($this->Auth->user('id')) {
        $data['Discussion'] = array('type' => $this->request->data['type'], 'title' => $this->request->data['title'], 'online_class_id' => $this->request->data['online_class_id'], 'message' => $this->request->data['message'], 'user_id' => $this->Auth->user('id'), 'is_approved' => 1);
        if ($this->Discussion->save($data)) {
          echo json_encode(array('id' => $this->Discussion->getLastInsertId(),'date' => date('F dS'), 'user_id' => $this->Auth->user('id'), 'full_name' => $user['Profile']['0']['first_name'] . ' '  . $user['Profile']['0']['last_name'], 'avatar' => $user['File']['0']['name']));
        }
      }
    }
    $this->autoRender = false;
    exit;
  }
  
  public function view($id = null) {
    $this->Discussion->bindModel(array(
                                        'hasOne' => array('MyLike' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('MyLike.like'), 'conditions' => array('MyLike.like' => 1, 'MyLike.user_id' => $this->Auth->user('id')))),
                                        'hasMany' => array('LikeCount' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('id'), 'conditions' => array('like' => 1)))
                                        ));
    $discussion = $this->Discussion->find('first', array('recursive' => 2, 'conditions' => array('Discussion.id' => $id)));
    $this->Discussion->Comment->bindModel(array(
                                        'hasOne' => array('MyLike' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('MyLike.like'), 'conditions' => array('MyLike.like' => 1, 'MyLike.user_id' => $this->Auth->user('id')))),
                                        'hasMany' => array(
                                                           'LikeCount' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'fields' => array('id'), 'conditions' => array('like' => 1)),
                                                           'CommentReply' => array('className' => 'Comment', 'foreignKey' => 'parent_id', 'conditions' => array('parent_table' => 'comment')),
                                                           )
                                        ));
    $comments = $this->Discussion->Comment->find('all', array('order' => array('Comment.created' => 'ASC'), 'recursive' => 3, 'conditions' => array('Comment.parent_id' => $id)));
    $this->set('discussion', $discussion);
    $this->set('comments', $comments);
    $this->layout = 'default';
  }
  
  public function like() {
    if ($this->request->is('ajax')) {
      if ($this->Auth->user('id')) {
        $liked = $this->Discussion->Like->find('first', array('conditions' => array('Like.parent_id' => $this->request->data['discussion_id'], 'Like.user_id' => $this->Auth->user('id'))));
        if (empty($liked)) {
          $data['Like'] = array('user_id' => $this->Auth->user('id'), 'parent_id' => $this->request->data['discussion_id'], 'type' => 'discussions', 'like' => 1);
          if ($this->Discussion->Like->save($data)) {
            echo json_encode('success');
          } else {
            echo json_encode('failed');
          }
        } else {
          if ($liked['Like']['like'] == 0) {
            $data['Like'] = array('id' => $liked['Like']['id'], 'user_id' => $this->Auth->user('id'), 'parent_id' => $this->request->data['discussion_id'], 'type' => 'discussions', 'like' => 1);
            if ($this->Discussion->Like->save($data)) {
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
        $liked = $this->Discussion->Like->find('first', array('conditions' => array('Like.parent_id' => $this->request->data['discussion_id'], 'Like.type' => 'discussions', 'user_id' => $this->Auth->user('id'), 'Like.like' => 1)));
        if (!empty($liked)) {
          $data['Like'] = array('id' => $liked['Like']['id'], 'like' => 0);
          if ($this->Discussion->Like->save($data)) {
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