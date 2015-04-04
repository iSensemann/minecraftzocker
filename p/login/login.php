<?php
session_start();
$username = ucfirst($_POST['username']);
$password = $_POST['password'];

if(isset($username)&&(isset($password))){
	function AuthMeCheck($username, $password){
		include ('dbconfig.php');
		$link = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);
		$query = "SELECT password FROM authme WHERE usernamelobby = '".$username."'";
		$pwd = explode('$', mysqli_fetch_assoc(mysqli_query($link,$query))['password']);
		if($pwd){
			if(strcasecmp(trim($pwd['3']), hash('sha256', hash('sha256', $password).$pwd['2'])) == 0){
				return 1;
			}else{
				return 0;
			}
		}
	}
	if(AuthMeCheck($username, $password) == 1){
		echo "Successfully logged in, redirecting...";
		$_SESSION['username'] = $username;
		header("Refresh: 0; url=../../");
	}else{
		echo "Login failed, redirecting...";
		header("Refresh: 2; url=../../");
	}
}
?>