<?php

class UsersController extends AppController
{
 var $scaffold;
 var $helpers=array('Html','Form');
 var $uses=array('User');
 var $components=array('Session');
 function login()
 {
    $this->layout='main';
    if (empty($this->request->data))#Go to blank form.
    {
          $this->render();
    }
    else #Has hit login button.
    {
	    $login=$this->request->data['User']['login'];
       $pwd = $this->request->data['User']['pwd'];
       //$pwd=$this->request->params['data']['User']['pwd'];
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
          $this->redirect(array('controller' => 'devices', 'action' => register_device));

       }
    }
 }
}

?>
