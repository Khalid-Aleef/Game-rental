
<?php

$servername = "localhost";
$usern = "root";
$pass = "";
$dbname = "gamenest";

//creating connection

$conn = new mysqli($servername, $usern, $pass, $dbname);

//check connection 
if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
	}
   

?>