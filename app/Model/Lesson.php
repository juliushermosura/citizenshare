<?php

class Lesson extends AppModel {
  public $belongsTo = array('OnlineClass', 'User', 'File');
}

?>