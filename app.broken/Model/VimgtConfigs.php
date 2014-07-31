<?php

class VimgtConfigs extends AppModel
{
   function get_value($name)
   { 
      $found_rec=$this->find(array("name=\"$name\""));
      $result=$found_rec['VimgtConfigs']['value'];
      return $result;
   }
}

?>
