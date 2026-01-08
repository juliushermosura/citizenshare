<?php

class Microsite extends AppModel {

  public $name = 'Microsite';
  public $belongsTo = array('User', 'File');
  
}

?>