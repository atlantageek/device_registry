<h1>Register Device</h1>
<div id="tab5">
</div>
<div class="body">
<form method="post" action="query_admin">
   <div style="width:400">
   <table>
<?php echo $this->Form->input('Query.id',array('type'=>'hidden'));?>
<tr><td>Title:</td><td class="position:relative;align:left"><?php echo $this->Form->input('Query.title',array('label' => false,'size'=>'20','MAXLENGTH'=>'20'));?></td></tr>
<tr><td>Query:</td>
   <td><?php echo $this->Form->textarea('Query.query',array('cols'=>'50','rows'=>'12'));?></td></tr>

<tr><td><?php echo $this->Form->submit('Save');?></td><td></td></tr>
   </div>
</form>
</div>
