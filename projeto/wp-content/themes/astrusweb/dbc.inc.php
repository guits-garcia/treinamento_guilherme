<?php

$servername = "192.168.10.115";
$username = "root";
$password = "d0r1t0s1mp10";
$database = "projetoguilherme";



$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error){
	die("Connection failed: :" . $conn->connect_error);
}