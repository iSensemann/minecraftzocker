<?php

// Compatibility with PHP Report Maker
if (!isset($Language)) {
	include_once "ewcfg10.php";
	include_once "ewshared10.php";
	$Language = new cLanguage();
}


?>




<html>
<head>
<link rel="stylesheet" type="text/css" href="phpcss/pvpwebstats2.css">
<script src="jquery/jquery-2.1.0.min.js"></script>

<script type="text/javascript">
var jetzt = new Date();
//Tag
var Tag = jetzt.getDate();

//Woche "Wochentag[TagInWoche]"
var TagInWoche = jetzt.getDay();
var Wochentag = new Array("Son", "Mon", "Tue", "Wed",
                          "Thu", "Fri", "Sat");

//Monat "Monat[Jahresmonat]"
var Jahresmonat = jetzt.getMonth();
var Monat = new Array("Jan", "Feb", "Mar", "Apr", "Mai", "Jun",
                      "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

//Jahr
var Jahr = jetzt.getFullYear();

//Stunde
var Std = jetzt.getHours();

//Minute
var Min = jetzt.getMinutes();

//Minute für cookies +1
var cookieMin = Min + 3;

//Sekunde
var Sek = jetzt.getSeconds();

// DIE ZEIT FÜR Normal ***********************************************************************************************************
var zeit = Wochentag[TagInWoche] + " ," + Tag + " " + Monat[Jahresmonat] + " " + Jahr + " " + Std + ":" + Min + ":" + Sek + " GMT";

// DIE ZEIT FÜR Cookies ***********************************************************************************************************
var cookieZeit = Wochentag[TagInWoche] + " ," + Tag + " " + Monat[Jahresmonat] + " " + Jahr + " " + Std + ":" + cookieMin + ":" + Sek + " GMT";


var breite = screen.width;
var hohe = screen.height;

if(breite == 1600) {
	document.cookie="breite=1600px; expires=" + cookieZeit + "; path=/";
	document.cookie="paddingLeft=1150px; expires=" + cookieZeit + "; path=/";
	document.cookie="logo_marginLeft=1000px; expires=" + cookieZeit + "; path=/";
	document.cookie="liste_left=500px; expires=" + cookieZeit + "; path=/";
	document.cookie="liste_top=70px; expires=" + cookieZeit + "; path=/";
}

if(breite == 800) {
	document.cookie="breite=800px; expires=" + cookieZeit + "; path=/";
	document.cookie="paddingLeft=750px; expires=" + cookieZeit + "; path=/";
	document.cookie="logo_marginLeft=140px; expires=" + cookieZeit + "; path=/";
	document.cookie="liste_left=120px; expires=" + cookieZeit + "; path=/";
	document.cookie="liste_top=70px; expires=" + cookieZeit + "; path=/";
}

if(breite == 1280) {
	document.cookie="breite=1280px; expires=" + cookieZeit + "; path=/";
	document.cookie="paddingLeft=1020px; expires=" + cookieZeit + "; path=/";
	document.cookie="logo_marginLeft=680px; expires=" + cookieZeit + "; path=/";
	document.cookie="liste_left=300px; expires=" + cookieZeit + "; path=/";
	document.cookie="liste_top=70px; expires=" + cookieZeit + "; path=/";
}

if(breite == 1366) {
	document.cookie="breite=1366px; expires=" + cookieZeit + "; path=/";
	document.cookie="paddingLeft=1060px; expires=" + cookieZeit + "; path=/";
	document.cookie="logo_marginLeft=760px; expires=" + cookieZeit + "; path=/";
	document.cookie="liste_left=380px; expires=" + cookieZeit + "; path=/";
	document.cookie="liste_top=70px; expires=" + cookieZeit + "; path=/";
}

if(breite == 1920) {
	document.cookie="breite=1920px; expires=" + cookieZeit + "; path=/";
	document.cookie="paddingLeft=1340px; expires=" + cookieZeit + "; path=/";
	document.cookie="logo_marginLeft=1280px; expires=" + cookieZeit + "; path=/";
	document.cookie="liste_left=550px; expires=" + cookieZeit + "; path=/";
	document.cookie="liste_top=70px; expires=" + cookieZeit + "; path=/";
}


</script>

<?php
//COOKIES

$breite = $_COOKIE["breite"];
$paddingLeft = $_COOKIE['paddingLeft'];
$logo_marginLeft = $_COOKIE["logo_marginLeft"];
//$liste_left = $_COOKIE["liste_left"];
$liste_top = $_COOKIE["liste_top"];





?>


<style type="text/css">
#topHeader {
	position: fixed;
	margin-bottom: 100px;
	background: rgba(255, 255, 255, 0.8);
	padding-bottom: 4px;
	left: -560px;
	right: -100px;
	top: 0px;
	padding-left: <?php echo $paddingLeft ?>;
	}
html,body {background-image: url(phpimages/background.jpg);background-size:<?php echo $breite ?>; background-repeat:no-repeat; background-attachment:fixed;}
.ewHeaderRow{margin-left: <?php echo $logo_marginLeft ?>;}
.ewGridUpperPanel,.ewGridLowerPanel{margin-top: <?php ?>; border-radius: 4px;}
</style>


	<title>Minecraft-Zocker SkyPvP Stats</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="phpcss/jquery.fileupload-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo EW_PROJECT_STYLESHEET_FILENAME ?>">
<?php if (ew_IsMobile()) { ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="phpcss/ewmobile.css">
<?php } ?>
<?php if (@$gsExport == "print" && @$_GET["pdf"] == "1" && EW_PDF_STYLESHEET_FILENAME <> "") { ?>
<link rel="stylesheet" type="text/css" href="<?php echo EW_PDF_STYLESHEET_FILENAME ?>">
<?php } ?>
<script type="text/javascript" src="<?php echo ew_jQueryFile("jquery-%v.min.js") ?>"></script>
<?php if (ew_IsMobile()) { ?>
<link rel="stylesheet" type="text/css" href="<?php echo ew_jQueryFile("jquery.mobile-%v.min.css") ?>">
<script type="text/javascript">
jQuery(document).bind("mobileinit", function() {
	jQuery.mobile.ajaxEnabled = false;
	jQuery.mobile.ignoreContentEnabled = true;
});
</script>
<script type="text/javascript" src="<?php echo ew_jQueryFile("jquery.mobile-%v.min.js") ?>"></script>
<?php } ?>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="jqueryfileupload/jquery.ui.widget.js"></script>
<script type="text/javascript" src="jqueryfileupload/jqueryfileupload.min.js"></script>
<script type="text/javascript">
var EW_LANGUAGE_ID = "<?php echo $gsLanguage ?>";
var EW_DATE_SEPARATOR = "/" || "/"; // Default date separator
var EW_DECIMAL_POINT = "<?php echo $DEFAULT_DECIMAL_POINT ?>";
var EW_THOUSANDS_SEP = "<?php echo $DEFAULT_THOUSANDS_SEP ?>";
var EW_MAX_FILE_SIZE = <?php echo EW_MAX_FILE_SIZE ?>; // Upload max file size
var EW_UPLOAD_ALLOWED_FILE_EXT = "gif,jpg,jpeg,bmp,png,doc,xls,pdf,zip"; // Allowed upload file extension

// Ajax settings
var EW_LOOKUP_FILE_NAME = "ewlookup10.php"; // Lookup file name
var EW_AUTO_SUGGEST_MAX_ENTRIES = <?php echo EW_AUTO_SUGGEST_MAX_ENTRIES ?>; // Auto-Suggest max entries

// Common JavaScript messages
var EW_DISABLE_BUTTON_ON_SUBMIT = true;
var EW_IMAGE_FOLDER = "phpimages/"; // Image folder
var EW_UPLOAD_URL = "<?php echo EW_UPLOAD_URL ?>"; // Upload url
var EW_UPLOAD_THUMBNAIL_WIDTH = <?php echo EW_UPLOAD_THUMBNAIL_WIDTH ?>; // Upload thumbnail width
var EW_UPLOAD_THUMBNAIL_HEIGHT = <?php echo EW_UPLOAD_THUMBNAIL_HEIGHT ?>; // Upload thumbnail height
var EW_USE_JAVASCRIPT_MESSAGE = false;
<?php if (ew_IsMobile()) { ?>
var EW_IS_MOBILE = true;
<?php } else { ?>
var EW_IS_MOBILE = false;
<?php } ?>
</script>
<script type="text/javascript" src="phpjs/jsrender.min.js"></script>
<script type="text/javascript" src="phpjs/ewp10.js"></script>
<script type="text/javascript" src="phpjs/userfn10.js"></script>
<script type="text/javascript">
<?php echo $Language->ToJSON() ?>
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?php echo ew_ConvertFullUrl("favicon.ico") ?>"><link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo ew_ConvertFullUrl("favicon.ico") ?>">
<meta name="generator" content="PHPMaker v10.0.1">
</head>
<body>
<?php if (ew_IsMobile()) { ?>
<div data-role="page">
	<div data-role="header">
		<a href="mobilemenu.php"><?php echo $Language->Phrase("MobileMenu") ?></a>
		<h1 id="ewPageTitle"></h1>
	</div>
<?php } ?>
<?php if (@!$gbSkipHeaderFooter) { ?>
<div class="ewLayout">
<?php if (!ew_IsMobile()) { ?>
	<!-- header (begin) -->
	<div id="topHeader"><ul id="navi"><div id="conNavi">
					<li><a class="navi-links" id="home" href="?start=1">Home</a></li>&nbsp;&#x2022;&nbsp; 
					<li><a class="navi-links" id="speedpvp" href="../speedpvp">SpeedPvP-Stats</a></li>&nbsp;&#x2022;&nbsp;
					<li><a class="navi-links" id="pvp" href="../pvp">PvP-Stats</a></li>&nbsp;&#x2022;&nbsp;
					<li><a class="navi-links" id="forum" href="http://minecraftzocker-forum.de/index.php/">Forum</a></li>
					
					</div>
				</ul></div>
	<div id="ewHeaderRow" class="ewHeaderRow"><img id="logo" src="phpimages/logo.png" alt="Logo" style="border: 0;">	</div>
	<!-- header (end) -->
<?php } ?>

<?php } ?>
