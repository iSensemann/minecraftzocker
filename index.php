<?php session_start(); error_reporting(7); include ('php/timediff.php'); $date = ('H:M:s'); include ('php/theme.php');?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="css/animate.css"/>
		<link rel="stylesheet" type="text/css" href="css/design.css"/>
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
		<title>MZ - Home</title>
	</head>
	<body class="bg"><noscript><div class="animated fadeoindown nojs">Pleas enable Javascript!</div></noscript>
		<div id="wrapper" class="background active">
			<div id="sidebar-wrapper" class="animated fadeinleft">
				<ul id="sidebar_menu" class="sidebar-nav">
					<li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="fa fa-bars "></span></a></li>
				</ul>
				<ul class="sidebar-nav" id="sidebar">   
					<li class="activep"><a href="">Home<span class="c_green sub_icon fa fa-home"></span></a></li>						
					<li><a href="p/server">Server<span class="sub_icon fa fa-server fa-server-fix"></span></a></li>
					<li><a href="p/dashboard">Dashboard<span class="sub_icon fa fa-tachometer"></span></a></li>
					<li><a href="p/stats">Stats<span class="sub_icon fa fa-star-o"></span></a></li>
					<li><a href="http://minecraftzocker-forum.de/index.php/BoardList/" target="blank">Forums<span class="sub_icon fa fa-comments-o"></span></a></li>
					<li><a href="http://minecraftzocker.buycraft.net/" target="blank">Donate<span class="sub_icon glyphicon fa fa-money"></span></a></li>
				</ul>
				<ul id="sidebar_menu-login" class="sidebar-nav-login">
					<li class="sidebar-login">
						<a href="p/<?php if($_SESSION['username'] == NULL){echo "login";}else{echo "profile?user=".$_SESSION['username'];} ?>">
							<span id="main_icon-login" class="sub_icon fa fa-sign-in"></span>
							<img class="circular" src="https://minotar.net/avatar/<?php echo $_SESSION['username'];?>/100.png"></img>			
							<p id="login" class="hide-login"><?php if($_SESSION['username'] == NULL){echo "Login";}else{echo $_SESSION['username'];}?></p>
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
			<div id="page-content-wrapper">
				<div class="page-content inset">
					<div class="row">
						<div class="line animated fadeinleft">
							<p class="title">
								<h1 class="title"><img class="logo" src="img/logo.png">&nbsp;</img>Home</h1>
								<p class="title-home animated bouncein"><i class="c_green fa fa-user"></i>Online:&nbsp;<?php include 'php/onlineplayers.php';?></p>
							</p>
						</div>	
						<div class="col-md-12 news">
						
							<article id="comment-id-2" class=""> 
								<a class="pull-left">
								<img class="circular" src="http://minecraft-skin-viewer.com/face.php?u=_Sensemann_&s=64">
								</a>
								<section class="media-body panel">
									<header class="panel-heading clearfix"> <a class="linkred" href="p/profile/?user=_Sensemann_">_Sensemann_&nbsp;</a> 
									<label class="label bg-primary group-admin">Admin</label> 
									<span class="text-muted m-l-small pull-right">
									<i class="fa fa-clock-o"></i>
									<?php $curenttime="2015-03-31 00:20:00";$time_ago =strtotime($curenttime);echo timeAgo($time_ago);?>
									</span> 
									</header> 
									<div class="panel-body">
									<blockquote> 
									<p>Last Homepage update 31th March 2015, 12:20am ALPHA 1.1.10
									</p> 
									</blockquote>
									</div>
								</section> 
							</article>
							<br>
							<article id="comment-id-1" class=""> 
								<a class="pull-left">
								<img class="circular" src="http://minecraft-skin-viewer.com/face.php?u=_Sensemann_&s=64">
								</img>
								</a>
								<section class="media-body panel">
									<header class="panel-heading clearfix"> <a class="linkred" href="p/profile/?user=_Sensemann_">_Sensemann_&nbsp;</a> 
									<label class="label bg-primary group-admin">Admin</label> 
									<span class="text-muted m-l-small pull-right">
									<i class="fa fa-clock-o">
									</i>
									<?php
									$curenttime="2015-03-29 13:12:00";
									$time_ago =strtotime($curenttime);
									echo timeAgo($time_ago);
									?>
									</span> 
									</header> 
									<div class="panel-body">
									<blockquote> 
									<p>
									New Groups:
									<label class="label bg-primary group-owner">Owner</label> 
									<label class="label bg-primary group-admin">Admin</label> 
									<label class="label bg-primary group-architect-leader">Architect-Leader</label> 
									<label class="label bg-primary group-staff-leader">Staff-Leader</label> 
									<label class="label bg-primary group-staffplus">Staff+</label> 
									<label class="label bg-primary group-staff">Staff</label> 
									<label class="label bg-primary group-vip">VIP</label> 
									<label class="label bg-primary group-premium">Premium</label> 
									<label class="label bg-primary group-gamer">Gamer</label> 
									</p> 
									<small> 
									<cite title="Source Title">Added 29th March 2015
									</cite>
									</small> 
									</blockquote>
									</div>
								</section> <div style="height:1100px;"></div><center><h1>#Scrollbar</h1></center> 
							</article>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script type="text/javascript">
		setTimeout('$("#wrapper").toggleClass("active")', 4000);
		$("#login").toggleClass("login");
		$("#login").toggleClass("hide-login");
		setTimeout('$("#login").toggleClass("login")', 4000);
		setTimeout('$("#login").toggleClass("hide-login")', 4000);
		$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("active");
		$("#login").toggleClass("login");
		$("#login").toggleClass("hide-login");
		});
		</script>
	</body>
</html>