<?php

class User extends AppModel {
		
		public $actsAs = array('Containable');
		public $belongsTo = array('Group');
  //public $hasAndBelongsToMany = array('OnlineClass');
		public $hasOne = array('UserSetting');
  public $hasMany = array(
																										'ClassCategory' => array('conditions' => array('ClassCategory.is_deleted' => 0, 'ClassCategory.is_suspended' => 0, 'ClassCategory.admin_approved' => 1)),
																										'OnlineClass',
																										'Project',
																										'File' => array(
																																										'conditions' => array('type' => 'user'),
																																										'limit' => 1,
																																										'order' => array('created' => 'DESC')
																																										),
																										'Profile' => array(
																																													'limit' => 1,
																																													'order' => array('created DESC')
																																													),
																										'Inbox' => array(
																																										'className' => 'Message',
																																										'foreignKey' => 'recipient_id',
																																										'conditions' => array('Inbox.deleted' => 0, 'Inbox.draft' => 0, 'Inbox.sent' => 0)
																																										),
																										'Sent' => array(
																																										'className' => 'Message',
																																										'foreignKey' => 'sender_id',
																																										'conditions' => array('Sent.sent' => 1, 'Sent.deleted' => 0, 'Sent.draft' => 0)
																																										),
																										'Draft' => array(
																																										'className' => 'Message',
																																										'foreignKey' => 'sender_id',
																																										'conditions' => array('Draft.sent' => 0, 'Draft.deleted' => 0, 'Draft.draft' => 1)
																																										),

																										);
		public $hasAndBelongsToMany = array(
																																						'Follower' => array(
																																																										'className' => 'User',
																																																										'joinTable' => 'follows',
																																																										'foreignKey' => 'user_id',
																																																										'associationForeignKey' => 'follow_id',
																																																										'conditions' => array('is_deleted' => 0),
																																																										'order' => array('Follower.created' => 'DESC')
																																																										),
																																						'Following' => array(
																																																										 'className' => 'User',
																																																										 'joinTable' => 'follows',
																																																										 'foreignKey' => 'follow_id',
																																																										 'associationForeignKey' => 'user_id',
																																																										 'conditions' => array('is_deleted' => 0),
																																																											'order' => array('Following.created' => 'DESC')
																																																										)
																																						);
}

?>