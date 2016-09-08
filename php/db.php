<?php
function connect($host,$user,$pass,$db) {
	if(empty($db)){
		$mysqli = new mysqli($host, $user, $pass);
	} else {
		$mysqli = new mysqli($host, $user, $pass, $db);
	}
	if($mysqli->connect_error){
		die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
	}     
	return $mysqli;
}

const conf = "conf.txt";
if(file_exists(conf) && 
   is_readable(conf) &&
   finfo_file(finfo_open(FILEINFO_MIME_TYPE), conf) == "text/plain"){    
    $read = fopen(conf, "r");    
   
	$auth = array();
    while(!feof($read) && count($auth) <= 2){
         $auth[] = trim(fgets($read, 4096));
    }
    fclose($read);

    if(count($auth) != 2){
        echo "Invalid conf.txt syntax!";
	} else {
		$conn = connect("localhost", $auth[0], $auth[1], "");
		$sql = "CREATE DATABASE IF NOT EXISTS leaderboard";
		if(mysqli_query($conn, $sql)){
			/*
				succ
				might do something here eventually...
			*/
		} else {
			echo "Error: " . mysqli_error($conn);
		}
		$conn = connect("localhost", $auth[0], $auth[1], "leaderboard");
		$sql = "CREATE TABLE IF NOT EXISTS users(
					id INT UNSIGNED NOT NULL AUTO_INCREMENT,
					username VARCHAR(255) NOT NULL,
					password VARCHAR(255) NOT NULL,
					sessionToken VARCHAR(255) NOT NULL,
					sessionExpiration DATETIME NOT NULL,
					email VARCHAR(255) NOT NULL,
					name VARCHAR(255) NOT NULL,
					points INT DEFAULT 0 NOT NULL,
					picture VARCHAR(255),
					PRIMARY KEY (id)
				);
				CREATE TABLE IF NOT EXISTS answered(
					id INT UNSIGNED NOT NULL AUTO_INCREMENT,
					question INT UNSIGNED NOT NULL,
					username VARCHAR(255) NOT NULL,
					PRIMARY KEY (id)
				);
				CREATE TABLE IF NOT EXISTS questions(
					id INT UNSIGNED NOT NULL AUTO_INCREMENT,
					value INT NOT NULL,
					PRIMARY KEY (id)
				)";
		if(mysqli_multi_query($conn, $sql)){
			/*
				succ
				might do something here eventually...
			*/
		} else {
			echo "Error: " . mysqli_error($conn);
		}

	}
} else {
	die("conf.txt is missing, unreadable, or not a valid text file.");
}
?>