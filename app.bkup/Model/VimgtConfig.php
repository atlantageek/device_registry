<?php
App::uses('AppModel', 'Model');

class VimgtConfig extends AppModel
{
   public $name = VimgtConfig;
   function get_value($name)
   { 
      $found_rec=$this->find('first', array('conditions' => array("VimgtConfig.name" => $name)));
      $result=$found_rec['VimgtConfig']['value'];
      return $result;
   }
}

?>
