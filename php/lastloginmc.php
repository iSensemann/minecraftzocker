<?php session_start();
$dbhost = "mysql3.minecraftzocker.net";
$dbname = "login";
$dbuser = "web";
$dbpassword= "202723850f211428cd8edca474b1f51fcf624cd64f9eea68ee1ee26ee7430b9a";

$username = $_SESSION['username'];
$link = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);
$query = "SELECT lastloginlobby FROM authme WHERE usernamelobby = '".$username."'";
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);
$timestamp = substr("$row[0]",0,-3);
echo gmdate("Y-m-d H:i:s", $timestamp);
?>