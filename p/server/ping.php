<?php
error_reporting(0);
$password_auth = "9127&23986cedAca8e136e0Fe402559c?f";
$password_auth_hash = "3096b83235e053200bec3fdde99663f8c81ab2dfdc5cf0e93045cf47340ea75d";
$password_auth_post = $_POST['password'];

$server = $_POST['server'];

$password_hash = hash('sha256', $password_auth_post);

if($password_auth_hash != $password_hash ){
	echo "err1";
	$server = "lobby1";
}

$servers = array(
    "lobby 1" => "lobby1.minecraftzocker.net:2000",
    "lobby 2" => "lobby2.minecraftzocker.net:2001",
);

include_once 'mss/status.class.php';
$status = new MinecraftServerStatus();

$parsedUrl = parse_url($servers[$server]);

$response = $status->getStatus($parsedUrl["host"], $parsedUrl["port"]);
	if(!$response) {
		echo 'offline;'+$server;
	} else {
		//var_export($response);
		foreach ($response as $value) {
			echo $value.";";
		}
		echo $server;
	}
	
//hostname:"37.187.160.187", version:"", protocol:"", players:"11", maxplayers:"64", motd:"1.8", motd_raw:"1.8", favicon:"", ping:"21", 
//0								1			2			3 				4				5			6				7 			8

// 9 = Servername