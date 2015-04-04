<?php session_start(); error_reporting(0);
$dbhost = "mysql3.minecraftzocker.net";
$dbname = "web";
$dbuser = "web";
$dbpassword= "202723850f211428cd8edca474b1f51fcf624cd64f9eea68ee1ee26ee7430b9a";
$username = $_SESSION['username'];
$link = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);
$query = "SELECT * FROM template WHERE usernamelobby ='".$username."'";
		$result = mysqli_query($link,$query);
		$row = mysqli_fetch_array($result);
		if($result->num_rows == 1){
			if($row[1] == 'bright'){
				echo "<link rel='stylesheet' type='text/css' href='minecraftzocker/css/bright_theme.css'/>";
			}else{
				echo "<link rel='stylesheet' type='text/css' href='minecraftzocker/css/dark_theme.css  '/>";
			}
		}
?>