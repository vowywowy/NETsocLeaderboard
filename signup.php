<?php
include "php/connection.php";

if(!empty($_POST['username']) &&
   !empty($_POST['password']) &&
   !empty($_POST['email']) &&
   !empty($_POST['name'])){
	
	$user = mysqli_real_escape_string($conn, trim($_POST['username']));
	$pass = mysqli_real_escape_string($conn, password_hash(trim($_POST['password']), PASSWORD_DEFAULT));
	$email = mysqli_real_escape_string($conn, trim($_POST['email']));
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$token = bin2hex(openssl_random_pseudo_bytes(16));
	$dayAfter = time() + (1 * 24 * 60 * 60);
	$expire = date("Y-m-d H:i:s", $dayAfter); //current date + 1 day

	$sql = "SELECT COUNT(password)
			FROM users
			WHERE username='$user'";
	if($result = mysqli_query($conn, $sql)){
		$result = mysqli_fetch_row($result);
		if ($result[0] == '0'){
			$sql = "INSERT INTO users (username, password, email, name, sessionToken, sessionExpiration) 
			VALUES ('$user','$pass','$email','$name','$token','$expire')";
			setcookie("sessionToken", $token, $dayAfter);
			if(mysqli_query($conn, $sql)){
				//succesfully inserted
				header("Location: submit.html");
				exit;
			} else {
				echo "Error: ".mysqli_error($conn);
			}
		} else {
			//should never reach this branch
			header("Location: login.html");
			exit;
		}
	} else { 
		"Error: ".mysqli_error($conn);
	}
}
?>