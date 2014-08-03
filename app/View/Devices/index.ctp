<?php
?>
<script type="text/javascript" class="init">
    $(document).ready(function() {
	$('#report_table').dataTable();
    } );
</script>

<div class="body">
<table id="report_table" border=1 cellspacing=0 cellpadding=0>
<thead>
<tr>
<th>Actions</th>
<th>ID</th>
<th>SN</th>
<th>First Name</th>
<th>Last Name</th>
<th>Garage</th>
<th>City</th>
<th>State</th>
<th>Service Date</th>
<th>FW</th>
<th>HW</th>
<th>Calibration Date</th>
<th>VZID</th>
<th>Config File</th> 
<th>Ch Plan</th>
<th>Updated</th>
</tr>
</thead>
<tbody>
<?php
   foreach($rec_list as $rec)
   { 
      echo "<tr>".
      '<td class="listactions"> <div style="width:12em">'.
        '<a href="/device_registry/devices/show/'.$rec['Device']['id'].'/" >View</a>' .
        '<a href="/device_registry/devices/edit/'.$rec['Device']['id'].'/" >Edit</a>'.
        '<a href="/device_registry/devices/delete/'.$rec['Device']['id'].'/" >Delete</a>'.
        '</div></td>'.
      "<td>".
      $rec['Device']['id'].'</td><td>'.
      $rec['Device']['sn'].'</td><td>'.
      $rec['Device']['first_name'].'</td><td>'.
      $rec['Device']['last_name'].'</td><td>'.
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
 </div>
