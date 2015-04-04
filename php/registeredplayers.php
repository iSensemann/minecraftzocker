<?php session_start();
$dbhost = "mysql3.minecraftzocker.net";
$dbname = "login";
$dbuser = "web";
$dbpassword= "202723850f211428cd8edca474b1f51fcf624cd64f9eea68ee1ee26ee7430b9a";

$link = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);
$query = 'SELECT COUNT(*) FROM authme';
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);
echo $row[0];
?>