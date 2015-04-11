<?php session_start(); error_reporting(0); include ('../../php/theme.php'); $date = date('H:i:s'); ?>
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
					<li class="activep"><a href="../../p/server">Server<span class="c_green sub_icon fa fa-server fa-server-fix"></span></a></li>
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
								<h1 class="title"><img class="logo" src="../../img/logo.png">&nbsp;</img>Home</h1>
								<p class="title-home animated bouncein"><i class="c_green fa fa-user"></i>Online:&nbsp;<?php include '../../php/onlineplayers.php';?></p>
							</p>
						</div>							
						<div class="col-md-12 background">										
							<h2 class="server">Lobby&nbsp;
								<small class="server">last update:&nbsp;<i class="fa fa-clock-o">&nbsp;</i><?php echo $date; ?></small>
							</h2>
							<?php
							for ($i = 1; $i <= 5; $i++) {
							?>
							<div id="box_lobby<?php echo $i; ?>"class="box-option box-option--normal">
							<div class="box-option__detail">
							<span id="box_lobby_name<?php echo $i; ?>" class="servericon fa fa-server box-option__type">&nbsp;-<?php echo "&nbsp;";?></span><br>
							<span id="box_lobby_ping<?php echo $i; ?>" class="servericon fa fa-wifi box-option__c">&nbsp;-</span><br>
							<span id="box_lobby_players<?php echo $i; ?>" class="servericon fa fa-user box-option__c"><i><font color="#bdc3c7">&nbsp;-/-</font></i></span><br>
							<span id="box_lobby_mcver<?php echo $i; ?>" class="servericon fa fa-info box-option__c">&nbsp;-</span>
							</div>
							<a href="#" id="box_lobby_status<?php echo $i; ?>" class="box-option__p">&nbsp;-</a>
							</div>
							<?php
							}
							?>
							
							<br><br>
							
							<h2 class="server">PvP&nbsp;
								<small class="server">last update:&nbsp;<i class="fa fa-clock-o">&nbsp;</i><?php echo $date; ?></small>
							</h2>
							<?php
							for ($i = 1; $i <= 5; $i++) {
							?>
							<div id="box_pvp<?php echo $i; ?>"class="box-option box-option--normal">
							<div class="box-option__detail">
							<span id="box_pvp_name<?php echo $i; ?>" class="fa fa-server box-option__type">&nbsp;-</span><br>
							<span id="box_pvp_ping<?php echo $i; ?>" class="fa fa-wifi box-option__c">&nbsp;-</span><br>
							<span id="box_pvp_players<?php echo $i; ?>" class="fa fa-user box-option__c"><i><font color="#bdc3c7">&nbsp;-/-</font></i></span><br>
							<span id="box_pvp_mcver<?php echo $i; ?>" class="fa fa-info box-option__c">&nbsp;-</span>
							</div>
							<a href="#" id="box_pvp_status<?php echo $i; ?>" class="box-option__p">&nbsp;</a>
							</div>
							<?php
							}
							?>
							
							<br><br>

							<h2 class="server">Building&nbsp;
								<small class="server">last update:&nbsp;<i class="fa fa-clock-o">&nbsp;</i><?php echo $date; ?></small>
							</h2>
							<?php
							for ($i = 1; $i <= 5; $i++) {
							?>
							<div id="box_pvp<?php echo $i; ?>"class="box-option box-option--normal">
							<div class="box-option__detail">
							<span id="box_pvp_name<?php echo $i; ?>" class="fa fa-server box-option__type">&nbsp;-</span><br>
							<span id="box_pvp_ping<?php echo $i; ?>" class="fa fa-wifi box-option__c">&nbsp;-</span><br>
							<span id="box_pvp_players<?php echo $i; ?>" class="fa fa-user box-option__c"><i><font color="#bdc3c7">&nbsp;-/-</font></i></span><br>
							<span id="box_pvp_mcver<?php echo $i; ?>" class="fa fa-info box-option__c">&nbsp;-</span>
							</div>
							<a href="#" id="box_pvp_status<?php echo $i; ?>" class="box-option__p">&nbsp;</a>
							</div>
							<?php
							}
							?>
							
							<br><br>
							
							<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
							<script type="text/javascript">
							var i = 1;

							setTimeout(pingTo("lobby", "lobby 1"),2000);
							setTimeout(pingTo("pvp", "skypvp3"),2000);

							function ucFirst(string) {
							return string.substring(0, 1).toUpperCase() + string.substring(1).toLowerCase();
							}

							function pingTo(cat, server){
							$.post("ping.php", 
							{
							password: "9127&23986cedAca8e136e0Fe402559c?f",
							server: server,
							},
							function(data, status){
							var arr = data.split(";");
							if(arr[0] == "offline" || arr[0] == "0"){
							$("#box_"+cat+i).removeClass( "box-option--normal" ).addClass( "box-option--offline" );
							$("#box_"+cat+"_name"+i).text(ucFirst(arr[1]));
							$("#box_"+cat+"_status"+i).text("Offline");
							i++;
							return;
							}if(arr[8] > 200){
							$("#box_"+cat+i).removeClass( "box-option--normal" ).addClass( "box-option--lagg" );
							$("#box_"+cat+"_name"+i).text(ucFirst(arr[9]));
							$("#box_"+cat+"_ping"+i).text(arr[8]);
							$("#box_"+cat+"_players"+i).text(+arr[3]+"/"+arr[4]);
							$("#box_"+cat+"_players"+i).prepend('<i class="fa fa-wifi"></i>');
							$("#box_"+cat+"_mcver"+i).text(arr[5]);
							$("#box_"+cat+"_status"+i).text("Lagg");
							i++;
							return;
							}
							$("#box_"+cat+i).removeClass( "box-option--normal" ).addClass( "box-option--online" );
							$("#box_"+cat+"_name"+i).text(ucFirst(arr[9]));
							$("#box_"+cat+"_ping"+i).text(arr[8]);
							$("#box_"+cat+"_players"+i).text(arr[3]+"/"+arr[4]);
							$("#box_"+cat+"_mcver"+i).text(arr[5]);
							$("#box_"+cat+"_status"+i).text("Online");
							i++;
							//  $("#mcver").text(arr[5]);
							});
							}


							</script>

						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="../js/bootstrap.js"></script>
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