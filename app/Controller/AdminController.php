<?php

class AdminController extends AppController
{
 var $uses=array('VimgtConfigs');
 var $layout='main';

 function registry_list()
 {
    if (!empty($this->data))
    {
       $sent_data=$this->data['attribute'];
       foreach($sent_data as $name=>$val)
       {
          $found_rec=$this->VimgtConfigs->find("first", array( "conditions" => array("name=\"$name\"" )));
          if (($name == 'ftp_dir') ||($name == 'fs_prefix'))
          {
             $val=trim($val);
             $val=ereg_replace('\/$','',$val);
          }
          $id = $found_rec["VimgtConfigs"]["id"];
          $found_rec["VimgtConfigs"]["value"] = $val;
          $found_rec["VimgtConfigs"]["id"] = intval($id);
          $found_rec["VimgtConfigs"]["name"] = $name;
          $this->VimgtConfigs->save($found_rec);
       }
    }

    $data=$this->VimgtConfigs->find('all');
    $this->set('data',$data);

 }


}

?>
