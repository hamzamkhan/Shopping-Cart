<?php

$servername = "localhost";
$username = "[your username]";
$password = "[your password]";
$dbname = "shopping_cart";

//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
if($conn->connect_error){
	die("Connection Failed :". $conn->connect_error);

}
