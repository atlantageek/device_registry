<?php

class DevicesController extends AppController
{
 var $scaffold;
 var $uses=array('Device','DeviceException','VimgtConfig','Option');
 var $helpers=array('Html','Form');
 var $layout='device_scaffold';
 var $components=array('Session', 'DataTable', 'RequestHandler');
function beforeFilter() {
    // filter actions which should not output debug messages
        Configure::write('debug', 0);
}
   
 function index()
 {
   $this->layout='main';
   $this->paginate = array(
           'limit' => 100,
	   'fields' => array('Device.id','Device.sn','Device.first_name','Device.last_name',
      'Device.garage', 'Device.city', 'Device.state', 'Device.service_date', 'Device.fw',
      'Device.hw', 'Device.cal_date', 'Device.vz_id', 'Device.config_file', 'Device.ch_plan',
      'Device.updated'));
   $this->DataTable->mDataProp = true;
   $this->set('response', $this->DataTable->getResponse());
   $this->set('_serialize', 'response');
   #$rec_list=$this->Device->find('all');
   #$this->set('rec_list',$rec_list);
   #$this->render();
 }
 function unconnected_device_list()
 {
   $this->layout='main';
   $this->paginate = array(
           'limit' => 100,
     'conditions' => array(array('last_connected' => null)),
     'fields' => array('Device.id','Device.sn','Device.first_name','Device.last_name',
      'Device.garage', 'Device.city', 'Device.state', 'Device.service_date', 'Device.fw',
      'Device.hw', 'Device.cal_date', 'Device.vz_id', 'Device.config_file', 'Device.ch_plan',
      'Device.updated'));
   $this->DataTable->mDataProp = true;
   $this->set('response', $this->DataTable->getResponse());
   $this->set('_serialize', 'response');
      
 }
 function connected_device_list()
 {
   $this->layout='main';
   $this->paginate = array(
           'limit' => 100,
     'conditions' => array(array("NOT" => array('last_connected' => null))),
     'fields' => array('Device.id','Device.sn','Device.first_name','Device.last_name',
      'Device.garage', 'Device.city', 'Device.state', 'Device.service_date', 'Device.fw',
      'Device.hw', 'Device.cal_date', 'Device.vz_id', 'Device.config_file', 'Device.ch_plan',
      'Device.updated'));
   $this->DataTable->mDataProp = true;
   $this->set('response', $this->DataTable->getResponse());
   $this->set('_serialize', 'response');
 }
 function device_list()
 {
   echo("HELLO");
   $conditions=NULL;
   if (!empty($this->request->params['data']['search']['sn']))#Go to blank form.
   {
      $snlike=$this->request->params['data']['search']['sn']."%";
      $conditions="sn like \"$snlike\"";
   }
   $this->layout='main';
   //list($order,$limit,$page) = $this->Pagination->init($conditions);
   $data=$this->Device->find("all", array('conditions' => $conditions));//,NULL);,$order, $limit, $page);
   $this->set('dscr','All Devices');
   $this->set('data',$data);
 }
 function delete($id=NULL)
 {
    $this->Device->query('delete from options_devices where device_id='.$id);
    $this->Device->del($id);
    $this->redirect('/devices/');

 }
 function register_device($id=NULL)
 {
	 
    $this->layout='main';
    $ftp_dir=$this->VimgtConfig->get_value('ftp_dir');
    $file_data_list=$this->_build_config_list();
    $config_list=array();
    foreach ($file_data_list as $data)
    {
       $config_list["/" . $data]=$data;
    }
    $this->set('config_list', $config_list);
    if (empty($this->request->data))#Go to blank form.
    {
       if (is_null($id))
       {
          $user=$this->Session->read('user');
          $result=$this->Device->find("all", array('conditions' => array("registered_by=\"$user\" and date_registered is not NULL"),array('date_registered DESC')));
//"registered_by=\"$user\" and date_registered is not NULL",null,'date_registered DESC',1);
          if ($result)
          {
          $this->request->data=$result[0];
          $this->render();
          }
       }
       else
       {
	  $this->request->data = $this->Device->find("first", array('conditions' =>array("id"=>$id)));
	  $cfg1 = $this->request->data["Device"]["config1"];
	  #$cfg1 = '/bob.pc7';
          $this->set('config1',$cfg1);//$this->request->data["Device"]["config1"]);
          $this->set('config1',$cfg2);//$this->request->data["Device"]["config2"]);
          $this->set('config1',$cfg3);//$this->request->data["Device"]["config3"]);
          $this->set('config1',$cfg4);//$this->request->data["Device"]["config4"]);
          $this->render();
       }
    }
    else #Has hit save button.
    {
       $sn=$this->request->data['Device']['sn'];
       $sn=trim($sn);
       $rec=$this->Device->find("first", array('conditions' => array("sn='$sn'")));
       if ($rec)
       {
          $this->request->data['Device']['id']=$rec['Device']['id'];
       }
       $this->request->data['Device']['date_registered']=date('Y-m-d H:i:s');
       $this->request->data['Device']['service_date']=date('Y-m-d');
       $user=$this->Session->read('user');
       $this->request->data['Device']['registered_by']=$user;
       if ($this->Device->save($this->request->data,false))
       {
          $this->request->data=array();
          $this->redirect('/devices/register_device');
       }
       else
       {
          $this->set('data',$this->request->data);
          $this->validateErrors($this->Device);
          $this->render();
       }
    }
 }
 function _build_config_list()
 {
    $ftp_dir=$this->VimgtConfig->get_value('fs_prefix');
    $ext=$this->VimgtConfig->get_value('config_ext');
    $ext=trim($ext);
    $ext=ereg_replace('^\.','',$ext);
    $file_data_list=array();
    $handle = opendir($ftp_dir);
    while (false !== ($entry = readdir($handle))) {
        if (preg_match('/.*' . $ext . '/', $entry) == 1)
        {
	    array_push($file_data_list, $entry);
        }
    }
    closedir($handle);
    return $file_data_list;
    //Loop through stored system files.  
    //If file exists in data_list then keep the id but delete from data_list. 
    //If file does not exist in data_list then delete it from the database
    //Otherwise delete kk
    
 }

 function dev_checkin()
 {
	 $this->layout='empty';
	 Debugger::dump($this->request->data,9);
    #$sn=$this->request->params["form"]['sn'];
    $sn=$this->request->data['sn'];
    $rec=$this->Device->findBySn($sn);
    $this->set('sn',$sn);
    if ($rec)
    {
	    $this->Device->id = $rec['Device']['id'];
       $device=$this->request->data;
       $device['last_connected']=date('Y-m-d H:i:s');
       $device['vz_id']=$device['user_id']; 
       $options=array();
             #$device['Option']['Option']=$options;
	    $this->Device->save($device);
	    $query='delete from options_devices where device_id="'.
	    	$rec['Device']['id'].'"';
            $this->Option->query($query);
       foreach($device as $key=>$value)
       {
          $key_array=explode('/',$key);
          if ((sizeof($key_array)==2) && ($key_array[0]=='option'))
          {
             $opt_name=$key_array[1];
             $opt_name=str_replace('_',' ',$opt_name);
		
             $option_rec=$this->Option->find('option_name="'.$opt_name.'"');
             if (isset($option_rec['Option']))
             {
                $query='replace into options_devices (device_id, option_id) values ('.$rec['Device']['id'].','.$option_rec['Option']['id'].')';
                $this->Option->query($query);
             }
          }
          
       }
       $this->render('dev_checkin','empty');

    }
    else
    {
       $this->render('dev_error','empty');
       #    	$this->Device->save($this->request->params['form']);
    }
 }
 function config_file_list()
 {
    $this->layout='empty';
    $sn=$this->request->params["form"]['sn'];
    $rec=$this->Device->findBySn($sn);
    $this->set('status',1);
    $ftp_dir=$this->VimgtConfig->get_value('ftp_dir');
    $fs_prefix=$this->VimgtConfig->get_value('fs_prefix');
    if ($rec)
    {
       $this->set('status',1);
	    $this->set('sn',trim($sn));
            if (strlen(trim($rec['Device']['config1'])) !=0)
             { 
                $this->set('config1',$ftp_dir.$rec['Device']['config1']); 
                $mtime=filemtime($fs_prefix.$rec['Device']['config1']);
                if ($mtime!=false)
                { $this->set('date1',date('YmdHis',$mtime)); }
                else
                { $this->set('date1',''); }
             }
            else
             { 
                $this->set('config1',''); 
                $this->set('date1',''); 
             }
            if (strlen(trim($rec['Device']['config2'])) !=0)
             { 
                $this->set('config2',$ftp_dir.$rec['Device']['config2']); 
                $mtime=filemtime($fs_prefix.$rec['Device']['config2']);
                if ($mtime!=false)
                { $this->set('date2',date('YmdHis',$mtime)); }
                else
                { $this->set('date2',''); }
             }
            else
             { 
                $this->set('config2',''); 
                $this->set('date2',''); 
             }
            if (strlen(trim($rec['Device']['config3'])) !=0)
             { 
                $mtime=filemtime($fs_prefix.$rec['Device']['config3']);
                $this->set('config3',$ftp_dir.$rec['Device']['config3']); 
                if ($mtime!=false)
                { $this->set('date3',date('YmdHis',$mtime)); }
                else
                { $this->set('date3',''); }
             }
            else
             { 
                $this->set('config3',''); 
                $this->set('date3',''); 
             }
            if (strlen(trim($rec['Device']['config4'])) !=0)
             { 
                $mtime=filemtime($fs_prefix.$rec['Device']['config4']);
                $this->set('config4',$ftp_dir.$rec['Device']['config4']); 
                if ($mtime!=false)
                { $this->set('date4',date('YmdHis',$mtime)); }
                else
                { $this->set('date4',''); }
             }
            else
             { 
                $this->set('config4',''); 
                $this->set('date4',''); 
             }
    }
    else
    {
       $this->set('status',0);
	    $this->set('sn',trim($sn));
       #    	$this->Device->save($this->request->params['form']);
    }
    $this->render('config_file_list','empty');
    
 }

}
?>
