<?php

class UsersController extends AppController
{
 var $scaffold;
 var $uses=array('User','DeviceException');
 var $helpers=array('Html','javascript');
 var $layout='device_scaffold';
 var $components=array('Session');
 function login()
 {
    file_put_contents("/tmp/data.out", $this->request->params);
    $this->layout='main';
    if (empty($this->request->params['data']))#Go to blank form.
    {
          $this->render();
    }
    else #Has hit login button.
    {
       $login=$this->request->params['data']['User']['login'];
       $pwd=$this->request->params['data']['User']['pwd'];
       $rec=$this->User->find("login='$login' and pwd='$pwd'");
       if ($rec)
       {
          $this->Session->CakeSession->writeSessionVar('user',$login);
          $lg=$this->Session->CakeSession->readSessionVar('user');
          if ($rec['User']['admin'])
          {
             $this->Session->CakeSession->writeSessionVar('admin',1);
          }
          else
          {
             $this->Session->CakeSession->writeSessionVar('admin',0);
          }
          $this->redirect('devices/register_device');

       }
    }
 }
}

?>
