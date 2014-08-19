<h1>Report List </h1>
   </div>
      <div class="body">
      <br>
      <br>
<?php
echo $this->Html->link('Create','query_admin/', array('class'=>'btn btn-default'));
?>
<table style="width:500px;">
<tr><th>Report Title</th><th>Actions</th></tr>
<?php
   $i=0;
   foreach ($rec_list as $rec)
   {
     if ($i % 2) 
     {$rowclass='class=altrow';}
     else
     {$rowclass='';}
     echo "<tr $rowclass>".
       '<td >'.$rec['Query']['title'].
       '</td><td class="listactions">' .
        $this->Html->link('Edit','query_admin/'.$rec['Query']['id'], array('class'=>'btn btn-default')).
        $this->Html->link('Delete','delete_query/'.$rec['Query']['id'], array('class'=>'btn btn-default')).
        $this->Html->link('Run','run_query/'.$rec['Query']['id'],array('class' => 'btn btn-default')).
       '</td></tr>';
     $i++;
   }
?>
</table>
