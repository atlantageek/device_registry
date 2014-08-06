<h1>Register Device</h1>
<div class="body">
<?php echo $this->Form->create(null, array('class'=>'form-horizontal'))?>
<div class="form-group">
<label class="col-sm-2 control-label">Serial Number</label>
<?php echo $this->Form->input('Device.sn', array('label'=>false, 'class'=>"col-sm-3"))?><p>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">First Name</label>
<?php echo $this->Form->input('Device.first_name',array('label'=> false, 'class'=>"col-sm-3"));?><p>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Last Name</label>
<?php echo $this->Form->input('Device.last_name',array('label'=> false, 'class'=>'col-sm-3'));?><p>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Supervisor Name</label>
<?php echo $this->Form->input('Device.supervisor_name',array('label'=> false, 'class' => 'col-sm-3'));?><p>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Supervisor Phone</label>
<?php echo $this->Form->input('Device.supervisor_phone',array('label'=> false, 'class'=> 'col-sm-3'));?><p>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Garage</label>
<?php echo $this->Form->input('Device.garage',array('label'=> false, 'class'=> 'col-sm-3'));?><p>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">City</label>
<?php echo $this->Form->input('Device.city',array('label'=> false, 'class'=> 'col-sm-3'));?><p>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">State</label>
<?php echo $this->Form->input('Device.state',array('label'=>false, 'class'=> 'col-sm-3'));?><p>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Config File1</label>
<?php echo $this->Form->selectTag('Device.config1',$config_list);?><p>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Config File 2</label>
<?php echo $this->Form->selectTag('Device.config2',$config_list);?><p>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Config File 3</label>
<?php echo $this->Form->selectTag('Device.config3',$config_list);?><p>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Config File 4</label>
<?php echo $this->Form->selectTag('Device.config4',$config_list);?><p>
</div>
<div class="form-group">
<?php echo $this->Form->hidden('Device.id');?><p>
</div>
<div class="form-group">
<?php echo $this->Form->submit('Save');?>
</div>
<?php echo $this->Form->end(); ?>
</div>
