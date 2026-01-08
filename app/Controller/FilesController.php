<?php

class FilesController extends AppController {

  public function upload() {
    if ($this->request->is(array('post'))) {
      $this->request->data['File']['user_id'] = $this->Auth->user('id');
      //pr($this->data);
      $new_name = $this->__generate_name() . '.' .  pathinfo($this->request->data['File']['file']['name'], PATHINFO_EXTENSION);
      $this->request->data['File']['name'] = $new_name;
      if (!is_dir(WWW_ROOT . 'files' . DS . $this->Auth->user('id') . DS . $this->data['File']['type'])) {
        if (!is_dir(WWW_ROOT . 'files' . DS . $this->Auth->user('id'))) {
          mkdir(WWW_ROOT . 'files' . DS . $this->Auth->user('id'));
        }
        mkdir(WWW_ROOT . 'files' . DS . $this->Auth->user('id') . DS . $this->data['File']['type']);
      }
      $success = move_uploaded_file($this->request->data['File']['file']['tmp_name'], WWW_ROOT . 'files' . DS . $this->Auth->user('id') . DS . $this->data['File']['type'] . DS . $new_name);
      if ($success == true) {
        if ($this->File->save($this->data)) {
          echo $this->File->getLastInsertId();
        }
      }
    }
    $this->autoRender = false;
  }

  public function __generate_name($length = 15) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
    $this->autoRender = false;
  }

}
//curl -i -d "api_password=79d0f2229d965158ec03b8a91b0bc8c8b0f0d5fa&url=http://uat.citizenshare.net/files/53ce9512-2ddc-4096-bea1-200f22234ddc/lesson/yaa63yrn9yjr5xw.MOV" https://upload.wistia.com/

?>