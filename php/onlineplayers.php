<?php session_start(); error_reporting(0);
$dbhost = "mysql3.minecraftzocker.net";
$dbname = "web";
$dbuser = "web";
$dbpassword= "202723850f211428cd8edca474b1f51fcf624cd64f9eea68ee1ee26ee7430b9a";

$link = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);
$query = "SELECT * FROM onlineplayers WHERE id = '1'";
		$result = mysqli_query($link,$query);
		$row = mysqli_fetch_array($result);
		if($result->num_rows == 1){
			echo $row[1];
		}else{
			echo "Error #1";
		}
?>
