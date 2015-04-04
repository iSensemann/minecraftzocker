<?php session_start(); $date = date('H:i:s'); error_reporting(0); include ('../../php/theme.php');?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="../../css/animate.css"/>
		<link rel="stylesheet" type="text/css" href="../../css/design.css"/>
		<link rel="stylesheet" href="../../css/font-awesome.min.css">
		<link rel="shortcut icon" type="image/x-icon" href="../../img/favicon.ico">
		<title>MZ - Server</title>
	</head>
	<body class="bg">
		<div id="wrapper" class="background">
			<div id="sidebar-wrapper">
				<ul id="sidebar_menu" class="sidebar-nav">
					<li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="fa fa-bars "></span></a></li>
				</ul>
				<ul class="sidebar-nav" id="sidebar">   
					<li><a href="../../">Home<span class=" sub_icon fa fa-home"></span></a></li>						
					<li class="activep"><a href="../../p/server">Server<span class="c_green sub_icon fa fa-server fa-server-fix"></span></a></li>
					<li><a href="../../p/dashboard">Dashboard<span class="sub_icon fa fa-tachometer"></span></a></li>
					<li><a href="../../p/stats">Stats<span class="sub_icon fa fa-star-o"></span></a></li>
					<li><a href="http://forum.minecraftzocker.net/" >Forums<span class="sub_icon fa fa-comments-o"></span></a></li>
					<li><a href="http://minecraftzocker.buycraft.net/" target="blank">Donate<span class="sub_icon glyphicon fa fa-money"></span></a></li>
				</ul>
				<ul id="sidebar_menu-login" class="sidebar-nav-login">
					<li class="sidebar-login">
						<a href="../../p/<?php if($_SESSION['username'] == NULL){echo "login";}else{echo "profile?user=".$_SESSION['username'];} ?>">
							<img class="circular" src="https://minotar.net/avatar/<?php echo $_SESSION['username'];?>/100.png"></img>
							<span id="main_icon" class="fa fa-sign-in"></span>
							<p>Login</p>						
						</a>		
					</li>
				</ul>
			</div>
			<div id="page-content-wrapper">
				<div class="page-content inset">
					<div class="row">
						<p class="title">
							<h1 class="title"><img class="logo" src="../../img/logo.png">&nbsp;</img>Home</h1>
							<p class="title-home"><i class="c_green fa fa-user"></i>Online:&nbsp;<?php include 'php/onlineplayers.php';?></p>
						</p>
						<div class="line"></div>							
						<div class="col-md-12 background">										

						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script type="text/javascript">
		$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("active");
		});
		</script>
	</body>
</html>