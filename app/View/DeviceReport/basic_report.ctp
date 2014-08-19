<h1>Basic Report</h1>
<div id="tab2">
<?php echo $this->renderElement('menu'); ?>
</div>
<?php
?>
<div class="body">
<table border=1 cellspacing=0 cellpadding=0>
<?php
$pagination->setPaging($paging);
$th = array (
   $pagination->sortBy('id'),
   $pagination->sortBy('sn'),
   $pagination->sortBy('first_name'),
   $pagination->sortBy('last_name'),
   $pagination->sortBy('supervisor_name'),
   $pagination->sortBy('supervisor_phone'),
   $pagination->sortBy('garage'),
   $pagination->sortBy('city'),
   $pagination->sortBy('state'),
   $pagination->sortBy('service_date'),
   $pagination->sortBy('fw'),
   $pagination->sortBy('hw'),
   $pagination->sortBy('cal_date'),
   $pagination->sortBy('vz_id'),
   $pagination->sortBy('config_file'),
   $pagination->sortBy('ch_plan'),
   $pagination->sortBy('updated')
);
echo $html->tableHeaders($th);
?>
<tbody>
<?
echo $this->renderElement('pagination',$paging); ?>
<?php
   $pagination->setPaging($paging);
   foreach($rec_list as $rec)
   { 
      echo "<tr><td>".
      $rec['Device']['id'].'</td><td>'.
      $rec['Device']['sn'].'</td><td>'.
      $rec['Device']['first_name'].'</td><td>'.
      $rec['Device']['last_name'].'</td><td>'.
      $rec['Device']['supervisor_name'].'</td><td>'.
      $rec['Device']['supervisor_phone'].'</td><td>'.
      $rec['Device']['garage'].'</td><td>'.
      $rec['Device']['city'].'</td><td>'.
      $rec['Device']['state'].'</td><td style="white-space:nowrap">'.
      $rec['Device']['service_date'].'</td><td>'.
      $rec['Device']['fw'].'</td><td>'.
      $rec['Device']['hw'].'</td><td style="white-space:nowrap">'.
      $rec['Device']['cal_date'].'</td><td>'.
      $rec['Device']['vz_id'].'</td><td>'.
      $rec['Device']['config_file'].'</td><td>'.
      $rec['Device']['ch_plan'].'</td><td>'.
      $rec['Device']['updated'].'</td></tr>'."\n";
   }
 ?>
 </tbody></table>
<?
echo $this->renderElement('pagination',$paging); ?>
 </div>
