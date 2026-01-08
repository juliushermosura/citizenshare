<?php

class OnlineClass extends AppModel {
  
  public $actsAs = array('Containable');
  public $name = 'OnlineClass';
  public $belongsTo = array('File', 'ClassCategory', 'User');
  public $hasAndBelongsToMany = array('User');
  public $hasMany = array('Lesson' => array('conditions' => array('is_deleted' => 0, 'is_suspended' => 0), 'order' => array('order ASC', 'created DESC')), 'Project' => array('order' => array('created DESC')), 'Review' => array('order' => array('created DESC')), 'Discussion' => array('order' => array('created DESC')));
  
}

?>