<?php

class Comment extends AppModel {
  
  public $belongsTo = array('User', 'Discussion' => array('foreignKey' => 'parent_id'));
  public $hasMany = array('Like' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'conditions' => array('like' => 1)));
  
}

?>