<?php

class WistiaComponent extends Component {
  public $components = array('Auth');
  
  public function upload($data = array()) {
    $process = curl_init(WISTIA_UPLOAD_URL);
    curl_setopt_array($process, array(
      CURLOPT_POST => TRUE,
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_POSTFIELDS => http_build_query(
        array(
        'api_password' => WISTIA_API_KEY,
        'url' => SITE_URL . '/files/' . $this->Auth->user('id') . '/' . $data['File']['type'] . '/' . $data['File']['name'],
        'project_id' => 'x8hg7p7ihn'
        )
      )
    ));

    // Send the request
    return curl_exec($process);
  }
  
  public function show($id = null) {
    $process = curl_init(WISTIA_SHOW_URL . $id . '.json?api_password=' . WISTIA_API_KEY);
    curl_setopt_array($process, array(
      CURLOPT_RETURNTRANSFER => TRUE,
    ));
    return curl_exec($process);
  }

}
  
?>