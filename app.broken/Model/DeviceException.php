<?php

class DeviceException extends AppModel
{
   function generate_exception($message)
   {
      $rec=array('DeviceException'=>array('message'=>$message));
      $this->save($rec);
      
   }
}

?>
