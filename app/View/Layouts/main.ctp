<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Navbar Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/jquery.dataTables.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/navbar.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/jquery.dataTables.js"></script>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <img class="navbar-brand" src="/images/veex_header.png" width="120px">
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="/device_reports"><a href="/devices/">Home</a></li>
            <li><a href="/devices/register_device">Register Devices</a></li>
            <li><a href="/devices/">Device List</a></li>
	    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#contact">Admin  <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                  <li><a href="/devices">Devices</a></li>
                  <li><a href="/users">Users</a></li>
                  <li><a href="/admin/registry_list">Config File Setup</a></li>
	    </ul>
            </li>
            <li><a href="/">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
<p>
    <div class="container">

      <div class="starter-template">
<?php echo $this->fetch('content');?>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>

