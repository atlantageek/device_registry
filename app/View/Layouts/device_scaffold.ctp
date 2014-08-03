<html>
<head>
<title> VIMgt : <?php echo $title_for_layout;?></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<?php echo $this->Html->charset('UTF-8')?>
<?php echo $this->Html->css('cake.default')?><!-- //in /app/webroot/css/ -->
</head>
<body>
<div style="display:block;float:none;padding:0px 20px 0px 20px;height:15px;width:1000px;background:#db8101;color:#f0f0f0;font-weight:bolder;">Page Last Loaded: <?php echo date(DATE_RFC822); ?></div>
<div style="width:800px;border:0px solid #000;"><?php echo $this->Html->image('vimgt.png',array('alt'=>'Verizon Inventory Management System.'))?>
</div>
<div class="content" >
<h1>Device Admin</h1>
<div id="tab7">
<?php echo $this->element('menu'); ?>
</div>
<div style="position:relative;top:20px;">
<?php echo $content_for_layout;?></div>
   <br>
</div>

</body>
</html>
