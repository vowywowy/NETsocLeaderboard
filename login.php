<?php
include "php/connection.php";

if(!empty($_POST['username']) &&
   !empty($_POST['password'])){
	
	$user = mysqli_real_escape_string($conn, trim($_POST['username']));
	$pass = mysqli_real_escape_string($conn, trim($_POST['password']));
	$token = mysqli_real_escape_string($conn, $_POST['token']);

	$sql = "SELECT password, sessionToken, sessionExpiration
			FROM users
			WHERE username='$user'";
	$rows = array();
	if($result = mysqli_query($conn, $sql)){
		$result = mysqli_fetch_row($result);
		if (password_verify($pass,$result[0])){
			$dayAfter = time() + (1 * 24 * 60 * 60);
			setcookie("sessionToken", $result[1], $dayAfter);
			if($result[2] < date("Y-m-d H:i:s")){
				$token = bin2hex(openssl_random_pseudo_bytes(16));				
				$expire = date("Y-m-d H:i:s", $dayAfter); //current date + 1 day
				$sql = "UPDATE users
						SET sessionToken='$token', sessionExpiration='$expire'
						WHERE username='$user'";
				if($result = mysqli_query($conn, $sql)){
					setcookie("sessionToken", $token, $dayAfter);
				} else {
					echo "Error: ".mysqli_error($conn);
				}					
			}			
			header("Location: submit.html");
			exit;
		} else {
			header("Location: login.html");
			exit;
		}
	} else { 
		echo "Error: ".mysqli_error($conn);
	}
}
?>