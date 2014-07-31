<?php

class DeviceReportsController extends AppController
{
   var $uses=array('Device', 'DeviceException','Query','Report');
   var $components = array ('Pagination');
   var $helpers=array('Html','Javascript','Pagination');
   var $layout='main';

 function basic_report()
 {
   $this->Pagination->modelClass = 'Device';
   list($order,$limit,$page) = $this->Pagination->init(NULL);
   $rec_list=$this->Device->findAll(NULL,NULL,$order,$limit, $page);
   $this->set('rec_list',$rec_list);
   $this->render();
 }
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
   $rec_list=$this->DeviceException->findAll(null,null,'last_changed');
   $this->set('rec_list',$rec_list);
   $this->render();
 }
 function clear()
 {
    $rec_list=$this->DeviceException->findAll(null,null,'last_changed');
    foreach($rec_list as $rec)
    {
       $this->DeviceException->del($rec['DeviceException']['id']);
    }
   $this->redirect('/device_reports/device_exception_report');
 }
 function query_list()
 {
    $rec_list=$this->Query->findAll(null,null);
    $this->set('rec_list',$rec_list);
   $this->render();
 }
 function run_query($id)
 {
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
    $results=$this->Report->query($sql);
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
 function delete_query($id)
 {
    if ($this->Query->del($id))
    {
       $this->redirect('/device_reports/query_list');
    }
 }
 function query_admin($id=NULL)
 {
    if (empty($this->request->params['data']))#Go to blank form.
    {
       if (is_null($id))
       {
          $this->render();
       }
       else
       {
          $this->request->params['data']=
            $this->Query->find("id=$id");
          $this->render();
       }
    }
    else #Has hit save button.
    {
       if (!is_null($id))
       {
          if(!$this->Query->read(null,$id))
          {
            $this->request->params['data']['Query']['id']=$id;
          }
          else
          {
            $this->request->params['data']['Query']['id']=NULL;
          }
       }

       if ($this->Query->save($this->request->params['data'],false))
       {
          $this->request->params['data']=array();
          $this->redirect('device_reports/query_list');
       }
       else
       {
          $this->set('data',$this->request->params['data']);
          $this->validateErrors($this->Query);
          $this->render();
       }
    }
 }

}

?>
