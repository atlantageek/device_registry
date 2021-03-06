<?php

class DevicesController extends AppController
{
 var $scaffold;
 var $uses=array('Device','DeviceException','VimgtConfigs','Option');
 var $components = array ('Pagination');
 var $helpers=array('Html','javascript','Pagination');
 var $layout='device_scaffold';
   

 function index()
 {
    $sortBy=empty($_GET['sortBy'])?'id.asc':$_GET['sortBy'];
    $sortDtls=split('\.',$sortBy);
       $sortBy=$sortDtls[0]." ".$sortDtls[1];
    $directions=array(
      'id'=>'asc',
      'sn'=>'asc',
      'first_name'=>'asc',
      'last_name'=>'asc',
      'supervisor_name'=>'asc',
      'supervisor_phone'=>'asc',
      'garage'=>'asc',
      'city'=>'asc',
      'state'=>'asc',
      'service_date'=>'asc',
      'fw'=>'asc',
      'hw'=>'asc',
      'cal_date'=>'asc',
      'vz_id'=>'asc',
      'config_file'=>'asc',
      'ch_plan'=>'asc',
      'updated'=>'asc'
    );

    $dir=$sortDtls[1];
    if (empty($dir)|| ($dir == 'asc'))
    {
       $sortDtls[1]='desc';
    }
    else
    {
       $sortDtls[1]='asc';
    }
   $directions[$sortDtls[0]]=$sortDtls[1];
   $this->set('directions',$directions);
   $rec_list=$this->Device->findAll(null,null,$sortBy);
   $this->set('rec_list',$rec_list);
   $this->render();
 }
 function unconnected_device_list()
 {
   $this->layout='main';
   $criteria="last_connected is NULL";
   list($order,$limit,$page) = $this->Pagination->init($criteria);
   $data=$this->Device->findAll($criteria,NULL,$order, $limit, $page);
   $this->set('data',$data);
   $this->set('dscr','Unconnected Devices');
   $this->render('device_list');
      
 }
 function connected_device_list()
 {
   $this->layout='main';
   $criteria="last_connected is not NULL";
   list($order,$limit,$page) = $this->Pagination->init($criteria);
   $data=$this->Device->findAll($criteria,NULL,$order, $limit, $page);
   $this->set('data',$data);
   $this->set('dscr','Connected Devices');
   $this->render('device_list');
 }
 function device_list()
 {
   $conditions=NULL;
   if (!empty($this->request->params['data']['search']['sn']))#Go to blank form.
   {
      $snlike=$this->request->params['data']['search']['sn']."%";
      $conditions="sn like \"$snlike\"";
   }
   $this->layout='main';
   list($order,$limit,$page) = $this->Pagination->init($conditions);
   $data=$this->Device->findAll($conditions,NULL,$order, $limit, $page);
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
    #$ftp_dir=$this->VimgtConfigs->get_value('ftp_dir');
    $this->layout='main';
    $file_data_list=$this->_build_config_list();
    $config_list=array();
    foreach ($file_data_list as $data)
    {
       $config_list[$data[0]]=$data[0];
    }
    $this->set('config_list', $config_list);
    if (empty($this->request->params['data']))#Go to blank form.
    {
       if (is_null($id))
       {
          $user=$this->Session->CakeSession->readSessionVar('user');
          $result=$this->Device->findall("registered_by=\"$user\" and date_registered is not NULL",null,'date_registered DESC',1);
          if ($result)
          {
          $this->request->params['data']=$result[0];
          $this->request->params['data']['Device']['id']=null;
          $this->request->params['data']['Device']['last_name']=null;
          $this->request->params['data']['Device']['first_name']=null;
          $this->request->params['data']['Device']['sn']=null;
          $this->render();
          }
       }
       else
       {
          $this->request->params['data']=
            $this->Device->find("id=$id");
          $this->render();
       }
    }
    else #Has hit save button.
    {
       $sn=$this->request->params['data']['Device']['sn'];
       $sn=trim($sn);
       $rec=$this->Device->find("sn='$sn'");
       if ($rec)
       {
          $this->request->params['data']['Device']['id']=$rec['Device']['id'];
       }
       $this->request->params['data']['Device']['date_registered']=date('Y-m-d H:i:s');
       $this->request->params['data']['Device']['service_date']=date('Y-m-d');
       $user=$this->Session->CakeSession->readSessionVar('user');
       $this->request->params['data']['Device']['registered_by']=$user;
       if ($this->Device->save($this->request->params['data'],false))
       {
          $this->request->params['data']=array();
          $this->redirect('devices/register_device');
       }
       else
       {
          $this->set('data',$this->request->params['data']);
          $this->validateErrors($this->Device);
          $this->render();
       }
    }
 }
 function _build_config_list()
 {
    vendor('filefind');
    $ftp_dir=$this->VimgtConfigs->get_value('fs_prefix');
    $ext=$this->VimgtConfigs->get_value('config_ext');
    $ext=trim($ext);
    $ext=ereg_replace('^\.','',$ext);
    $file_data_list=array();
    file_find($ftp_dir,$ext,$file_data_list, $ftp_dir);
    return $file_data_list;
    //Loop through stored system files.  
    //If file exists in data_list then keep the id but delete from data_list. 
    //If file does not exist in data_list then delete it from the database
    //Otherwise delete kk
    
 }

 function dev_checkin()
 {
    $this->layout='empty';
    $sn=$this->request->params["form"]['sn'];
    $rec=$this->Device->findBySn($sn);
    $this->set('sn',$sn);
    if ($rec)
    {
	    $this->Device->setId($rec['Device']['id']);
       $device=$this->request->params['form'];
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
    $ftp_dir=$this->VimgtConfigs->get_value('ftp_dir');
    $fs_prefix=$this->VimgtConfigs->get_value('fs_prefix');
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
