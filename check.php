<?php
include "php/connection.php";

if(isset($_POST['username'])){	
	$user = mysqli_real_escape_string($conn, trim($_POST['username']));
	$sql = "SELECT COUNT(password)
			FROM users
			WHERE username='$user'";
	if($result = mysqli_query($conn, $sql)){
		$result = mysqli_fetch_row($result);
		if ($result[0] == 0){
			echo "";
		} else {
			echo "error";
		}
	} else { 
		"Error: ".mysqli_error($conn);
	}	
}
?>