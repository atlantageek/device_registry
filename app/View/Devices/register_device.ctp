<h1>Register Device</h1>
<div class="body">
<?php echo $this->Form->create()?>
<?php echo $this->Form->input('Device.sn', array('label'=>'Serial Number'))?><p>
<?php echo $this->Form->input('Device.first_name',array('label'=> 'First Name'));?><p>
<?php echo $this->Form->input('Device.last_name',array('label'=> 'Last Name'));?><p>
<?php echo $this->Form->input('Device.supervisor_name',array('label'=> 'Supervisor Name'));?><p>
<?php echo $this->Form->input('Device.supervisor_phone',array('label'=> 'Supervisor Phone'));?><p>
<?php echo $this->Form->input('Device.garage',array('label'=> 'Garage'));?><p>
<?php echo $this->Form->input('Device.city',array('label'=> 'City'));?><p>
<?php echo $this->Form->input('Device.state',array('label'=> 'State'));?><p>
<?php echo $this->Form->selectTag('Device.config1',$config_list);?><p>
<?php echo $this->Form->selectTag('Device.config2',$config_list);?><p>
<?php echo $this->Form->selectTag('Device.config3',$config_list);?><p>
<?php echo $this->Form->selectTag('Device.config4',$config_list);?><p>
<?php echo $this->Form->hidden('Device.id');?><p>
<?php echo $this->Form->submit('Save');?>
<?php echo $this->Form->end(); ?>
</div>
