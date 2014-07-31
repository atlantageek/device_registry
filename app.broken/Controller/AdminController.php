<?php

class AdminController extends AppController
{
 var $uses=array('VimgtConfigs');
 var $helpers=array('Html','Javascript');
 var $layout='main';

 function registry_list()
 {
    if (!empty($this->request->params['data']))
    {
       $sent_data=$this->request->params['data']['attribute'];
       foreach($sent_data as $name=>$val)
       {
          $found_rec=$this->VimgtConfigs->find(array("name=\"$name\""));
          $this->VimgtConfigs->setId($found_rec["VimgtConfigs"]["id"]);
          if (($name == 'ftp_dir') ||($name == 'fs_prefix'))
          {
             $val=trim($val);
             $val=ereg_replace('\/$','',$val);
          }
          $this->VimgtConfigs->save(array('VimgtConfigs'=>array('name'=>$name,
             'value'=>$val)));
       }
    }
    $data=$this->VimgtConfigs->findAll();
    $this->set('data',$data);
 }


}

?>
