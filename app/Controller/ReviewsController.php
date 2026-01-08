<?php

class ReviewsController extends AppController {
  
  public function add() {
    $user = $this->Review->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
    if ($this->request->is('ajax')) {
      if ($this->Auth->user('id')) {
        $data['Review'] = array('online_class_id' => $this->request->data['online_class_id'], 'message' => $this->request->data['message'], 'user_id' => $this->Auth->user('id'), 'is_approved' => 1);
        if ($this->Review->save($data)) {
          echo json_encode(array('date' => date('M d, Y H:i:s'), 'user_id' => $this->Auth->user('id'), 'full_name' => $user['Profile']['0']['first_name'] . ' '  . $user['Profile']['0']['last_name'], 'avatar' => $user['File']['0']['name']));
        }
      }
    }
    $this->autoRender = false;
    exit;
  }
  
}

?>