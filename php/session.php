<?php
include "connection.php";

if(isset($_POST['session'])){	
	$token = mysqli_real_escape_string($conn, $_POST['session']);
	$sql = "SELECT username
			FROM users
			WHERE sessionToken='$token'";
	if($result = mysqli_query($conn, $sql)){
		$result = mysqli_fetch_row($result);
		if($result[0]){
			echo "Submitting as: ".$result[0];
		} else {
			echo "";
		}
	} else { 
		"Error: ".mysqli_error($conn);
	}
}
?>