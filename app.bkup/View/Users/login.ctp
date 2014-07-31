<h1>Login</h1>
<div class="body">
<?php echo $this->Form->create('User', array('action' => 'login')); ?>
<?php echo  $this->Form->input('login');   //text ?>
<?php echo $this->Form->input('pwd');   //password ?>
<?php echo $this->Form->submit('Login');    ?>
<?php echo $this->Form->end(); ?>
</form>
</div>
