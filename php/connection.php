<?php
//create db connection
function connect($host,$user,$pass,$db) {
	$mysqli = new mysqli($host, $user, $pass, $db);
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
		$conn = connect("localhost", $auth[0], $auth[1], "leaderboard");
	}
}
?>