<?php

class MessagesController extends AppController {

    public $layout = 'inline';
    
    /* connect to gmail */
    private $hostname = MAIL_HOST;
    private $username = MAIL_USERNAME;
    private $password = MAIL_PASSWORD;
    private $port = MAIL_PORT;
    private $ssl = true;
    private $mail;
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
    }
    
    public function dashboard_inbox() {
        $this->components[] = 'Paginator';
        $this->helpers[] = 'Paginator';
        $this->paginate = array(
            'limit' => 5,
            'conditions' => array('Inbox.recipient_id' => $this->Auth->user('id'), 'Inbox.deleted' => 0),
            'recursive' => 1,
            'order' => array('Inbox.created' => 'desc')
        );
        $this->set('title', 'Inbox');
        $data = $this->paginate('User.Inbox');
        $this->set('data', $data);
    }
    
    public function dashboard_sent() {
        $this->components[] = 'Paginator';
        $this->helpers[] = 'Paginator';
        $this->paginate = array(
            'limit' => 5,
            'conditions' => array('Sent.sender_id' => $this->Auth->user('id'), 'Sent.sent' => 1, 'Sent.deleted' => 0),
            'recursive' => 1,
            'group' => 'Sent.batch_id',
            'order' => array('Sent.created' => 'desc')
        );
        $this->set('title', 'Sent');
        $data = $this->paginate('User.Sent');
        $this->set('data', $data);
    }
    
    public function dashboard_drafts() {
        $this->components[] = 'Paginator';
        $this->helpers[] = 'Paginator';
        $this->paginate = array(
            'limit' => 5,
            'conditions' => array('Draft.sender_id' => $this->Auth->user('id'), 'Draft.draft' => 1, 'Draft.deleted' => 0),
            'recursive' => 1,
            'order' => array('Draft.modified' => 'desc')
        );
        $this->set('title', 'Drafts');
        $data = $this->paginate('User.Draft');
        $this->set('data', $data);
    }
    
    public function dashboard_compose() {
        $this->set('title', 'Compose');
    }

    public function mark_as_read($id = null) {
        $this->autoRender = false;
        if ($this->request->is('get')) {
            if (!empty($id)) {
                $exist = $this->User->Inbox->find('first', array('conditions' => array('Inbox.id' => $id)));
                $read = ($exist['Inbox']['read'] == 0) ? true : false;
                if (!empty($exist)) {
                    $this->User->Inbox->id = $id;
                    if ($this->User->Inbox->saveField('read', 1)) {
                        if ($read) {
                            if ($this->Session->check('Notifications.UnreadMails')) {
                                if ($this->Session->read('Notifications.UnreadMails') > 0) {
                                    $this->Session->write('Notifications.UnreadMails', $this->Session->read('Notifications.UnreadMails') - 1);
                                }
                            }
                        }
                        echo 'success';
                    } else {
                        echo 'failed';
                    }
                } else {
                    echo 'not exist';
                }
            } else {
                echo 'no id';
            }
        } else {
            
        }
    }
    
    public function mark_as_unread($id = null) {
        $this->autoRender = false;
        if ($this->request->is('get')) {
            if (!empty($id)) {
                $exist = $this->User->Inbox->find('first', array('conditions' => array('Inbox.id' => $id)));
                if (!empty($exist)) {
                    $this->User->Inbox->id = $id;
                    if ($this->User->Inbox->saveField('read', 0)) {
                        echo 'success';
                    } else {
                        echo 'failed';
                    }
                } else {
                    echo 'not exist';
                }
            } else {
                echo 'no id';
            }
        } else {
            
        }
    }
    
    public function __extract_email_address ($string) {
        foreach(preg_split('/ /', $string) as $token) {
            $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
            if ($email !== false) {
                $emails[] = $email;
            } else {
                return false;
            }
        }
        return $emails;
    }
    
    public function send_mail() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            //@TODO: check if email is for citizenshare users or for others
            $recipients = explode(',', $this->request->data['to']);
            $batch_id = String::uuid();
            foreach($recipients as $recipient) {
                unset($emails);
                $emails = $this->__extract_email_address($recipient);
                if ($emails != false) {
                    foreach($emails as $email) {
                        $e = explode('@', $email);
                        // check if recipient's email address is GL user
                        if ($e['1'] == 'citizenshare.com' || $e['1'] == 'citizenshare.net') {
                            unset($data);
                            $data = array(
                                'Inbox' => array(
                                    'batch_id' => $batch_id,
                                    'parent_id' => $id,
                                    'subject' => $this->request->data['subject'],
                                    'body_plain' => $this->request->data['message'],
                                    'body_html' => nl2br($this->request->data['message']),
                                    'sender_email' => $this->Auth->user('email'),
                                    'sender_id' => $this->Auth->user('id'),
                                    'reply_to' => $this->Auth->user('id'),
                                    'recipients' => $this->request->data['to'],
                                    'recipient_id' => trim($recipient),
                                    'sent' => 1,
                                    'sent_on' => date('Y-m-d H:i:s')
                                )
                            );
                            $this->User->Inbox->create();
                            if ($this->User->Inbox->save($data)) {
                                if (isset($this->request->data['id'])) {
                                    if (!empty($this->request->data['id'])) {
                                        $this->User->Inbox->save(array('Inbox' => array('id' => $this->request->data['id'], 'deleted' => 1, 'deleted_on' => date('Y-m-d H:i:s'))));
                                    }
                                }
                                $this->Session->setFlash('Message sent.', 'default', array('class' => 'success'));
                                echo 'success';
                            } else {
                                echo 'failed';
                            }
                        } else {
                            // recipient's email address is external email
                            unset($data);
                            $data = array(
                                'Inbox' => array(
                                    'batch_id' => $batch_id,
                                    'parent_id' => !empty($this->request->data['parent']) ? $this->request->data['parent'] : '',
                                    'subject' => $this->request->data['subject'],
                                    'body_plain' => $this->request->data['message'],
                                    'body_html' => nl2br($this->request->data['message']),
                                    'sender_email' => $this->Auth->user('full_name') . ' <' . $this->Auth->user('email') . '>',
                                    'sender_id' => $this->Auth->user('id'),
                                    'reply_to' => $this->Auth->user('id'),
                                    'recipients' => $this->request->data['to'],
                                    'recipient_email' => trim($recipient),
                                    'sent' => 1,
                                    'sent_on' => date('Y-m-d H:i:s')
                                )
                            );
                            $this->User->Inbox->create();
                            if ($this->User->Inbox->save($data)) {
                                if (isset($this->request->data['id'])) {
                                    if (!empty($this->request->data['id'])) {
                                        if ($this->User->Inbox->save(array('Inbox' => array('id' => $this->request->data['id'], 'deleted' => 1, 'deleted_on' => date('Y-m-d H:i:s'))))) {
                                            App::uses('CakeEmail', 'Network/Email');
                                            $Email = new CakeEmail();
                                            $Email->from(array('jhermosura1@citizenshare.com' => 'Julius Hermosura1'));
                                            $Email->to('julius.hermosura@gmail.com');
                                            $Email->subject('About');
                                            $Email->send('My message');
                                        }
                                    }
                                }
                                $this->Session->setFlash('Message sent.', 'default', array('class' => 'success'));
                                echo 'success';
                            } else {
                                echo 'failed';
                            }
                        }
                    }
                } else {
                    //check if valid users
                    unset($valid_user);
                    $valid_user = $this->User->find('first', array('conditions' => array('User.id' => trim($recipient)), 'recursive' => -1, 'fields' => array('User.id')));
                    if (!empty($valid_user)) {
                        unset($data);
                        $data = array(
                            'Inbox' => array(
                                'batch_id' => $batch_id,
                                'parent_id' => !empty($this->request->data['parent']) ? $this->request->data['parent'] : '',
                                'subject' => $this->request->data['subject'],
                                'body_plain' => $this->request->data['message'],
                                'body_html' => nl2br($this->request->data['message']),
                                'sender_email' => $this->Auth->user('full_name') . ' <' . $this->Auth->user('email') . '>',
                                'sender_id' => $this->Auth->user('id'),
                                'recipients' => $this->request->data['to'],
                                'reply_to' => $this->Auth->user('id'),
                                'recipient_id' => trim($recipient),
                                'sent' => 1,
                                'sent_on' => date('Y-m-d H:i:s'),
                                'received_on' => date('Y-m-d H:i:s')
                            )
                        );
                        $this->User->Inbox->create();
                        if ($this->User->Inbox->save($data)) {
                            if (isset($this->request->data['id'])) {
                                if (!empty($this->request->data['id'])) {
                                    $this->User->Inbox->save(array('Inbox' => array('id' => $this->request->data['id'], 'deleted' => 1, 'deleted_on' => date('Y-m-d H:i:s'))));
                                }
                            }
                            $this->Session->setFlash('Message sent.', 'default', array('class' => 'success'));
                            echo 'success';
                        } else {
                            echo 'failed';
                        }
                    } else {
                        //skip saving and mail sending
                        
                    }
                }
            }
        } else {
            $data = null;
        }
    }
    
    public function save_mail() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $data = array(
                'Inbox' => array(
                    'id' => isset($this->request->data['id']) ? $this->request->data['id'] : '',
                    'recipient_email' => $this->request->data['to'],
                    'subject' => !empty($this->request->data['subject']) ? $this->request->data['subject'] : 'No Subject',
                    'body_plain' => $this->request->data['message'],
                    'body_html' => nl2br($this->request->data['message']),
                    'sender_email' => $this->Auth->user('full_name') . ' <' . $this->Auth->user('email') . '>',
                    'sender_id' => $this->Auth->user('id'),
                    'reply_to' => $this->Auth->user('id'),
                    'draft' => 1,
                    'parent_id' => !empty($this->request->data['parent']) ? $this->request->data['parent'] : ''
                )
            );
            if (isset($this->request->data['id'])) {
                $this->User->Inbox->create();
            }
            if ($this->User->Inbox->save($data)) {
                $this->Session->setFlash('Message saved.', 'default', array('class' => 'success'));
                echo $this->User->Inbox->getLastInsertId();
            } else {
                echo 'failed';
            }
        } else {
            $data = null;
        }
    }
    
    public function delete_mail($id = null) {
        $this->autoRender = false;
        if ($this->request->is('get')) {
            if (!empty($id)) {
                $exist = $this->User->Inbox->find('first', array('conditions' => array('Inbox.id' => $id), 'recursive' => -1));
                if (!empty($exist)) {
                    $data = array(
                        'Inbox' => array(
                            'id' => $id,
                            'deleted' => 1,
                            'deleted_on' => date('Y-m-d H:i:s')
                        )
                    );
                    if ($this->User->Inbox->save($data)) {
                        //$this->Session->setFlash('Message deleted. To undo click <a href="/users/undelete_mail/' .$id. '">here</a>', 'default', array('class' => 'success'));
                        echo 'success';
                    } else {
                        echo 'failed';
                    }
                }
            }
        } else {
            $data = null;
        }
    }
    
    public function undelete_mail($id = null) {
        $this->autoRender = false;
        if ($this->request->is('get')) {
            if (!empty($id)) {
                $exist = $this->User->Inbox->find('first', array('conditions' => array('Inbox.id' => $id, 'Inbox.deleted' => 1), 'recursive' => -1));
                if (!empty($exist)) {
                    $this->User->Inbox->id = $id;
                    if ($this->User->Inbox->saveField('deleted', 0)) {
                        echo 'success';
                    } else {
                        echo 'failed';
                    }
                }
            }
        } else {
            $data = null;
        }
    }
    
    public function index() {
        App::uses('CakeEmail', 'Network/Email');
        $Email = new CakeEmail('default');
        $Email->from(array('jhermosura1@citizenshare.com' => 'Julius Hermosura1'));
        $Email->sender('no-reply@citizenshare.com');
        $Email->to('julius.hermosura@gmail.com');
        $Email->subject('About');
        $Email->send('my message');
        //$this->__connect();
        //$this->__fetch();
        $this->autoRender = false;
    }
    
    public function __connect() {
        set_include_path(implode(PATH_SEPARATOR, array(
            WWW_ROOT . '/zend/library/',
             get_include_path(),
        )));
        
        require_once 'Zend/Loader/Autoloader.php';
        
        Zend_Loader_Autoloader::getInstance();
        
        $this->mail = new Zend_Mail_Storage_Imap(
            array(
                'host'     => $this->hostname,
                'port'     => $this->port,
                'ssl'      => $this->ssl,
                'user'     => $this->username,
                'password' => $this->password,
            )
        );
    }
    
    private function __fetch() {
        $this->loadModel('User');
        $this->log('==================================================');
        $this->log('Start Fetching Emails');
        $this->mail->noop();
        foreach ($this->mail as $messageNum => $message) {
            unset($emails);
            $emails = $this->__extract_email_address($message->to);
            if ($emails != false) {
                foreach ($emails as $email) {
                    unset($valid_recipient);
                    $e = explode('@', $email);
                    $valid_recipient = $this->User->find('first', array('conditions' => array('User.username' => $e['0']), 'recursive' => -1));
                    if (!empty($valid_recipient)) {
                        $plain = array();
                        $html = array();
                        foreach (new RecursiveIteratorIterator($message) as $part) {
                            try {
                                if (strtok($part->contentType, ';') == 'text/plain') {
                                    $plain[] = $part->getContent();
                                }
                                if (strtok($part->contentType, ';') == 'text/html') {
                                    $html[] = $part->getContent();
                                }
                            } catch (Zend_Mail_Exception $e) {
                                // ignore
                            }
                        }
                        unset($data);
                        $data = array(
                            'Message' => array(
                                'recipient_id' => $valid_recipient['User']['id'],
                                'recipient_email' => $message->to,
                                'sender_email' => $message->from,
                                'subject' => $message->subject,
                                'received_on' => date('Y-m-d H:i:s', strtotime($message->date)),
                                'body_plain' => implode(' ', $plain),
                                'body_html' => implode(' ', $html)
                            )
                        );
                        $this->mail->noop();
                        $this->Message->create();
                        if (!$this->Message->save($data)) {
                            $this->log('==================================================');
                            $this->log('Email Failed to Save to DB.');
                            $this->log('Message ID: ' . $message->messageId);
                            $this->log('Sender: ' . $message->from);
                            $this->log('Recipient: ' . $message->to);
                            $this->log('Subject: ' . $message->subject);
                            $this->log('Email Date Received: ' . $message->date);
                        } else {
                            //Zend_Debug::dump($message->getHeaders());
                            //Zend_Debug::dump($message->getContent());
                            $this->mail->removeMessage($messageNum);
                        }
                    } else {
                        $this->log('==================================================');
                        $this->log('No Valid Recipient.');
                        $this->log('Message ID: ' . $message->messageId);
                        $this->log('Sender: ' . $message->from);
                        $this->log('Recipient: ' . $message->to);
                        $this->log('Subject: ' . $message->subject);
                        $this->log('Email Date Received: ' . $message->date);
                        $this->mail->removeMessage($messageNum);
                    }
                }
            } else {
                $this->log('==================================================');
                $this->log('No Valid Recipient.');
                $this->log('Message ID: ' . $message->messageId);
                $this->log('Sender: ' . $message->from);
                $this->log('Recipient: ' . $message->to);
                $this->log('Subject: ' . $message->subject);
                $this->log('Email Date Received: ' . $message->date);
                $this->mail->removeMessage($messageNum);
            }
        }
        $this->log('==================================================');
        $this->log('Done Fetching Emails');
        // output subject of message
        //$message = $this->mail->getMessage(1);
        //$email = $this->__extract_email_address($message->to);
        //echo $message->subject . "<br>";
        //echo '<pre>' . $message->getContent() . '</pre>';

        // dump message headers
        //Zend_Debug::dump($message->getHeaders());
    }

}

?>