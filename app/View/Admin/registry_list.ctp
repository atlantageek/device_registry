<h1>Configuration Information </h1>
     <div class="body"> <br>
<table style="width:800px;">
<tr><th>Attribute</th><th>Original Value</th><th>Change Value</th><th>Actions</th></tr>
<?php
   $i=0;
   foreach ($data as $rec)
   {
     if ($i % 2) 
     {$rowclass='class=altrow';}
     else
     {$rowclass='';}
     echo "<tr $rowclass> <form method=\"post\">".
       '<td>'.$rec['VimgtConfigs']['name'].
       '</td><td>'.$rec['VimgtConfigs']['value'].
       '</td><td>'.$this->Form->input('attribute.' . $rec['VimgtConfigs']['name'], array('label'=>'', 'value'=>$rec['VimgtConfigs']['value'])) .
       '</td><td class="listactions">' .
       $this->Form->submit('Set \''.$rec['VimgtConfigs']['name']."'").
       '</td></form></tr>';
     $i++;
   }
?>
</table>
</div>
