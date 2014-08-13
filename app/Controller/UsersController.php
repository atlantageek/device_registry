<?php

class UsersController extends AppController
{
 var $scaffold;
 var $helpers=array('Html','Form');
 var $uses=array('User');
 var $components=array('Session');
 function login()
 {
    $this->layout=false;
    if (empty($this->request->query['data']))#Go to blank form.
    {
          $this->render();
 $this->log('Got here2', 'debug');
    }
    else #Has hit login button.
    {
	    $login=$this->request->query['data']['User']['login'];
       $pwd = $this->request->query['data']['User']['pwd'];
       $rec=$this->User->findByLoginAndPwd($login, $pwd);
       if ($rec)
       {
          $this->Session->write('user',$login);
          $lg=$this->Session->read('user');
          if ($rec['User']['admin'])
          {
             $this->Session->write('admin',1);
          }
          else
          {
             $this->Session->write('admin',0);
          }
          $this->redirect(array('controller' => 'devices', 'action' => 'index'));

       }
    }
 }
}

?>

