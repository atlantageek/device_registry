<h1><?php echo $report_title ?></h1>
   <table class="table table-striped"><tr>
<?php
   $firstrow=$results[0];
   foreach($firstrow as $tbl=>$arr)
   {
      foreach($arr as $field=>$val)
      {
         echo "<th>".$tbl.".".$field."</th>";
      }
   }
?>
</tr><tr>
<?php
   foreach ($results as $row)
   {
      echo "<tr>";
      foreach($row as $tbl=>$arr)
      {
         foreach($arr as $field=>$val)
         {
            echo "<td>".$val."</td>";
         }
      }
      echo "</tr>";
   }
?>
</table>
