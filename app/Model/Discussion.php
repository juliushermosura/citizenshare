<?php

class Discussion extends AppModel {
  
  public $belongsTo = array("User", "OnlineClass");
  public $hasMany = array('Like' => array('className' => 'Like', 'foreignKey' => 'parent_id', 'conditions' => array('like' => 1)), 'Comment' => array('foreignKey' => 'parent_id', 'order' => array('Comment.modified ASC')));

}

?>