<h1>Exception Report</h1>
<div id="tab4">
<?php echo $this->renderElement('menu'); ?>
<?php echo $javascript->link('sortTable.js')."\n"; ?>
<?php echo $html->css('sortTable')?>
</div>
<script type="text/JavaScript">
  var report_table= new sortableTable("report_table",1,"str,str");
  window.onload=function()
  {
     report_table.init();
  }
</script>
<div class="body">
<table id="report_table" border=1 cellspacing=0 cellpadding=0 style="width:700px">
<thead>
<tr>
<th style="width:1000px;">Exception Message</th>
<th style="width:270px;">Last Changed</th>
</tr>
</thead>
<tbody>
<ul class="actions">
    <li><a href="/device_registry/device_reports/clear" >Clear Exceptions</a></li>
    </ul>
<?php
   foreach($rec_list as $rec)
   { 
      echo "<tr><td>".
      $rec['DeviceException']['message'].'</td><td>'.
      $rec['DeviceException']['last_changed'].'</td></tr>'."\n";
   }
 ?>
 </tbody></table>
 </div>
