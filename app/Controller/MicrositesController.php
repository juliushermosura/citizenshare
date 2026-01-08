<?php

class MicrositesController extends AppController {
  var $layout = 'dashboard';

  public function beforeFilter() {
    parent::beforeFilter();
    $this->set('active', 2);
  }
  
  public function dashboard_subdomain() {
    $this->layout = 'inline';
  }
  
  public function dashboard_index() {
    if (isset($this->request->query['inline']) && $this->request->query['inline'] == 1 || $this->request->query['inline'] == 2) {
      $this->layout = 'inline';
    }
    if ($this->request->is(array('post', 'put'))) {
      $key = key($this->request->data['Microsite']);
      $this->request->data['Microsite']['user_id'] = $this->Auth->user('id');
      $this->request->data['Microsite']['file_id'] = $this->request->data['Microsite'][$key]['file_id'];
      $this->request->data['Microsite']['content'] = $this->request->data['Microsite'][$key]['content'];
      $this->request->data['Microsite']['is_fixed_bg'] = $this->request->data['Microsite'][$key]['is_fixed_bg'];
      $this->request->data['Microsite']['color'] = $this->request->data['Microsite'][$key]['color'];
      $this->request->data['Microsite']['section'] = $this->request->data['Microsite'][$key]['section'];
      $this->request->data['Microsite']['modified'] = date('Y-m-d H:i:s');
      $this->request->data['Microsite']['created'] = date('Y-m-d H:i:s');
      if ($this->Microsite->save($this->request->data)) {
        $this->Session->setFlash('Saved successfully.', 'default', array('class' => 'success'));
        if (isset($this->request->query['inline']) && $this->request->query['inline'] == 1) {
          $this->redirect(array('dashboard' => true, 'action' => 'index', '?' => array('inline' => 1)));
        } else {
          $this->redirect(array('dashboard' => true, 'action' => 'index'));
        }
      }
    }
    $intro = $this->Microsite->find('first', array('conditions' => array('Microsite.user_id' => $this->Auth->user('id'), 'section' => 'intro'), 'order' => array('Microsite.created DESC')));
    $about = $this->Microsite->find('first', array('conditions' => array('Microsite.user_id' => $this->Auth->user('id'), 'section' => 'about'), 'order' => array('Microsite.created DESC')));
    $classes = $this->Microsite->find('first', array('conditions' => array('Microsite.user_id' => $this->Auth->user('id'), 'section' => 'classes'), 'order' => array('Microsite.created DESC')));
    $projects = $this->Microsite->find('first', array('conditions' => array('Microsite.user_id' => $this->Auth->user('id'), 'section' => 'projects'), 'order' => array('Microsite.created DESC')));
    $contact = $this->Microsite->find('first', array('conditions' => array('Microsite.user_id' => $this->Auth->user('id'), 'section' => 'contact'), 'order' => array('Microsite.created DESC')));

    if (!empty($intro['Microsite'])) {
      $this->request->data['Microsite']['0'] = $intro['Microsite'];
      if (!empty($intro['File'])) $this->set('intro', $intro['File']);
    }
    if (!empty($about['Microsite'])) {
      $this->request->data['Microsite']['1'] = $about['Microsite'];
      if (!empty($intro['File'])) $this->set('about', $about['File']);
    }
    if (!empty($classes['Microsite'])) {
      $this->request->data['Microsite']['2'] = $classes['Microsite'];
      if (!empty($intro['File'])) $this->set('classes', $classes['File']);
    }
    if (!empty($projects['Microsite'])) {
      $this->request->data['Microsite']['3'] = $projects['Microsite'];
      if (!empty($intro['File'])) $this->set('projects', $projects['File']);
    }
    if (!empty($contact['Microsite'])) {
      $this->request->data['Microsite']['4'] = $contact['Microsite'];
      if (!empty($intro['File'])) $this->set('contact', $contact['File']);
    }
  }
  
  public function corporate_index() {
  }
  
}

?>
