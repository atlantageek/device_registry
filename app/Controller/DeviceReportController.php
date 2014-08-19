<?php

class DeviceReportController extends AppController
{
   var $uses=array('Device', 'DeviceException','Query','Report');
   var $helpers=array('Html');
   var $layout='main';

 function index()
 {
    $total=$this->Device->findCount();
    $unconnected=$this->Device->findCount('last_connected is NULL');
    $this->set('total_devices',$total);
    $this->set('unconnected_devices',$unconnected);
    $this->set('connected_devices',$total-$unconnected);
   $this->render();
 }
 function device_exception_report()
 {
   $rec_list=$this->DeviceException->find('all',array('order'=> array('DeviceException.last_changed' => 'desc')));
   $this->set('rec_list',$rec_list);
   $this->render();
 }
 function clear()
 {
   $rec_list=$this->DeviceException->find('all');
    foreach($rec_list as $rec)
    {
       $this->DeviceException->del($rec['DeviceException']['id']);
    }
   $this->redirect('/device_reports/device_exception_report');
 }
 function query_list()
 {
    $rec_list=$this->Query->find('all');
    $this->set('rec_list',$rec_list);
   $this->render();
 }
 function run_query()
 {
    $id =$this->request->params['id'];
    if (!$this->Query->read(null,$id))
    {
      $this->flash("Query for $id not found",'/device_reports/query_list');
      return;
    }
    $obj=$this->Query->read(null,$id);

    $title=$obj['Query']['title'];
    $sql=$obj['Query']['query'];
    $this->Query->id=$id;
    if ( ! preg_match('/^\s*select/i', $sql,$matches) ) 
    {
      $this->flash("The report you requested contains an illegal query",'/device_reports/query_list'); 
      return;
    }
    $db = ConnectionManager::getDataSource('default');
    $results=$this->Device->query($sql);
    $this->set('query',$sql);
    $this->set('report_title',$title);
    $this->set('results',$results);
    if (!$results || (count($results) == 0))
    {
      $this->flash("No Report Generated",'/device_reports/query_list');
    }
    else
    {
      $this->render();
    }
 }
 function delete_query()
 {
     $id =$this->request->params['id'];
    if ($this->Query->delete(intval($id)))
    {
          $this->redirect('/device_report/query_list');
    }
 }
 function query_admin($id=NULL)
 {
	 $id =$this->request->params['id'];
    if (empty($this->request->data))#Go to blank form.
    {
       if (is_null($id))
       {
          $this->render();
       }
       else
       {
	       $result=$this->Query->find('first',array('conditions' => array('id' => $id)));
	       if ($result)
	       {
		       $this->request->data = $result;
	       }
       }
       
    }
    else #Has hit save button.
    {
       $id = $this->request->data['Query']['id'];
       $data = $this->request->data;
       if (!is_null($id))
       {
          if(!$this->Query->read(null,$id))
          {
            $this->params['data']['Query']['id']=$id;
          }
          else
          {
            $this->params['data']['Query']['id']=NULL;
          }
       }

       if ($this->Query->save($data,false))
       {
          $this->params['data']=array();
          $this->redirect('/device_report/query_list');
       }
       else
       {
          $this->set('data',$this->params['data']);
          $this->validateErrors($this->Query);
          $this->render();
       }
    }
 }

}

?>
