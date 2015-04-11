<?php session_start(); error_reporting(0); include ('../../php/theme.php'); $date = date('H:i:s');?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="../../css/animate.css"/>
		<link rel="stylesheet" type="text/css" href="../../css/design.css"/>
		<link rel="stylesheet" href="../../css/font-awesome.min.css">
		<link rel="shortcut icon" type="image/x-icon" href="../../img/favicon.ico">
		<title>MZ - Server</title>
	</head>
	<body class="bg"><noscript><div class="animated fadeoindown nojs">Pleas enable Javascript!</div></noscript>
		<div id="wrapper" class="background">
			<div id="sidebar-wrapper" class="animated fadeinleft">
				<ul id="sidebar_menu" class="sidebar-nav">
					<li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="fa fa-bars "></span></a></li>
				</ul>
				<ul class="sidebar-nav" id="sidebar">   
					<li><a href="../../">Home<span class=" sub_icon fa fa-home"></span></a></li>						
					<li><a href="../../p/server">Server<span class="sub_icon fa fa-server fa-server-fix"></span></a></li>
					<li><a href="../../p/dashboard">Dashboard<span class="sub_icon fa fa-tachometer"></span></a></li>
					<li><a href="../../p/stats">Stats<span class="sub_icon fa fa-star-o"></span></a></li>
					<li><a href="http://minecraftzocker-forum.de/index.php/BoardList/" target="blank" >Forums<span class="sub_icon fa fa-comments-o"></span></a></li>
					<li><a href="http://minecraftzocker.buycraft.net/" target="blank">Donate<span class="sub_icon glyphicon fa fa-money"></span></a></li>
				</ul>
				<ul id="sidebar_menu-login" class="sidebar-nav-login">
					<li class="sidebar-login">
						<a href="../../p/<?php if($_SESSION['username'] == NULL){echo "login";}else{echo "profile?user=".$_SESSION['username'];} ?>">
							<span id="main_icon-login" class="sub_icon fa fa-sign-in"></span>
							<img class="circular" src="https://minotar.net/avatar/<?php echo $_SESSION['username'];?>/100.png"></img>			
							<p id="login" class="activep hide-login"><?php if($_SESSION['username'] == NULL){echo "Login";}else{echo $_SESSION['username'];}?></p>
						</a>		
					</li>
				</ul>
				<ul class="sidebar-nav-links-1 sidebar-nav-links " id="sidebar">   
					<li class="sidebar-links"><a href="https://www.youtube.com/user/InsaneGamerLP/featured" target="blank">Youtube<span class="sub_icon fa fa-youtube"></span></a></li>
				</ul>
				<ul class="sidebar-nav-links-2 sidebar-nav-links" id="sidebar">   
					<li class="sidebar-links"><a href="https://www.facebook.com/MZ.Server" target="blank">Facebook<span class="sub_icon fa fa-facebook-official"></span></a></li>
				</ul>
			</div>
			<?php $urluser = $_GET['user']; $sessionuser = $_SESSION['username']; if($urluser == $sessionuser){$loggedin = 1;}else{$loggedin = 0;}?>
			<div id="page-content-wrapper">
				<div class="page-content inset">
					<div class="row">
						<div class="line animated fadeinleft">
							<p class="title">
								<h1 class="title"><img class="logo" src="../../img/logo.png">&nbsp;</img>
								<?php if($loggedin == 1){echo "Hi,&nbsp;".$sessionuser;}else{echo $urluser."'s&nbsp;Profile";}?></h1>
								<p class="title-home animated bouncein"><i class="c_green fa fa-user"></i>Online:&nbsp;<?php include '../../php/onlineplayers.php';?></p>
							</p>
						</div>							
						<div class="col-md-12 background">										
							<?php 
							
							if($loggedin == 1){?>
							<div class="profile-content">
								<div class="profile-header media">
								  <div class="media-left">
									<a href="../../p/profile?user=<?php echo $_SESSION['username']; ?>">
									  <img class="circular-profile" src="https://minotar.net/avatar/<?php echo $_SESSION['username'];?>/100.png"></img>
									</a>
								  </div>
								  <div class="media-body">
									<h2 class="media-heading profile-name">&nbsp;<?php echo $_SESSION['username']; ?></h2>
								  </div>
								</div>
								<div class="profile-content">
									<div class="list-group">
										  <a href="#" class="list-group-item disabled"><p>The last time you logged in Minecraft:&nbsp;<b><?php include('../../php/lastloginmc.php');?></b></p>	</a>
										 <br> <a href="#" class="list-group-item disabled">Settings</a>
										  <a href="#" class="list-group-item">Name:&nbsp;<b><?php echo $_SESSION['username'];?></b><a></a>
										  <a href="#" class="list-group-item">E-Mail:&nbsp;<b><?php include('../../php/email.php');?></b><a>
										  <a href="?test" class="list-group-item">Design:&nbsp;<b><?php include('../../php/template.php');?></b><a></a>
									</div>
									<?php }else{ ?>
									
									<?php } ?>
								</div>
							</div>
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
		$("#login").toggleClass("login");
		$("#login").toggleClass("hide-login");
		});
		</script>
	</body>
</html>