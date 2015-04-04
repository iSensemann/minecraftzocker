<html><head><title>Test</title>

<style type="text/css">

</style>
<script src="jquery/jquery-2.1.0.min.js"></script>
<script type="text/javascript">
function MachGelb () {
	//$("#DynText").animate({padding-left: '1150px'}, 10);
	$("#DynText").animate({paddingLeft: '1390px',}, 100);
}

document.cookie="username=John Doe";
</script>
</head><body>
	<div id="DynText"><ul id="navi"><div id="conNavi">
					<li><a onmouseover="naviFadeIn();" onmouseout="naviFadeOut();" class="navi-links" id="home" href="#">Home</a></li>&nbsp;&#x2022;&nbsp; 
					<li><a onmouseover="" class="navi-links" id="yayin" href="#">PvP-Stats</a></li>&nbsp;&#x2022;&nbsp;
					<li><a onmouseover="" class="navi-links" id="diziler" href="#">SkyPvP-Stats</a></li>&nbsp;&#x2022;&nbsp;
					<li><a onmouseover="" class="navi-links" id="haberler" href="http://minecraftzocker-forum.de/index.php/BoardList/">Forum</a></li>
					
					</div>
					
					<a href="javascript:MachGelb()">gelb</a>
					
					
					
					
<?php 



$cook = $_COOKIE["username"];

echo $cook;








?>
					
</body></html>