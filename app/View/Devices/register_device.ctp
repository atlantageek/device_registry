<h1>Register Device</h1>
<div id="tab1" class="menu"><?php echo $this->element('menu'); ?></div>
<div class="body">
<?php echo $this->Form->create('register_device')?>
Serial Number: <?php echo $this->Form->input('Device/sn');?><p>
User First Name: <?php echo $this->Form->input('Device/first_name');?><p>
User Last Name: <?php echo $this->Form->input('Device/last_name');?><p>
Supervisor Name: <?php echo $this->Form->input('Device/supervisor_name');?><p>
Supervisor Phone: <?php echo $this->Form->input('Device/supervisor_phone');?><p>
Garage: <?php echo $this->Form->input('Device/garage');?><p>
City: <?php echo $this->Form->input('Device/city');?><p>
State: <?php echo $this->Form->input('Device/state');?><p>
Config File 1: <?php echo $this->Form->selectTag('Device/config1',$config_list);?><p>
Config File 2: <?php echo $this->Form->selectTag('Device/config2',$config_list);?><p>
Config File 3: <?php echo $this->Form->selectTag('Device/config3',$config_list);?><p>
Config File 4: <?php echo $this->Form->selectTag('Device/config4',$config_list);?><p>
<?php echo $this->Form->hidden('Device/id');?><p>
<?php echo $this->Form->submit('Save');?>
<?php echo $this->Form->end(); ?>
</div>
