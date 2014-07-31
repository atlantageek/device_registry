<html>
<head>
<title> VIMgt : <?php echo $title_for_layout;?></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
<div style="display:block;float:none;padding:0px 20px 0px 20px;height:15px;width:1000px;background:#db8101;color:#f0f0f0;font-weight:bolder;">Page Last Loaded: <?php echo date(DATE_RFC822); ?></div>
</div>
<div class="content" >
<?php echo $this->fetch('content');?>
</div>
</body>
</html>
