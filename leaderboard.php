<?php
include "php/connection.php";

if(isset($_POST['refresh'])){	
	$token = mysqli_real_escape_string($conn, $_POST['refresh']);
	$sql = "SELECT username, points
			FROM users
			ORDER BY points DESC
			LIMIT 10";
	$rows = array();
	if($result = mysqli_query($conn, $sql)){
		while($r = mysqli_fetch_assoc($result)){
			$rows[] = $r;
		}
		echo json_encode($rows);
	} else { 
		"Error: ".mysqli_error($conn);
	}
}
?>