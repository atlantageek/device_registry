<h1><?php echo $dscr; ?></h1>
     <div class="body"> <br>
     <br>
<table style="width:600px;">
<tr><th>Serial Number</th><th>Last Changed</th><th>Last Connected</th><th>Actions</th></tr>
<?php
   $this->Pagination->setPaging($paging);
   $i=0;
   foreach ($data as $rec)
   {
     if ($i % 2) 
     {$rowclass='class=altrow';}
     else
     {$rowclass='';}
     echo "<tr $rowclass>".
       '</td><td>'.$rec['Device']['sn'].
       '</td><td>'.$rec['Device']['updated'].
       '</td><td>'.$rec['Device']['last_connected'].
       '</td>'.
       '<td class="listactions">' .  $this->Html->link('Edit Device','register_device/'.$rec['Device']['id']).
       '</td></tr>';
     $i++;
   }
?>
</table>
</div>
