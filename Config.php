<!-- This program is written by Pada Cherdchoothai,2019 -->
<?php
$servername = " ";
$username = " ";
$password = " ";
$dbname = " ";
// Create connection
$sqli = new mysqli($servername, $username, $password, $dbname);
$sqli->set_charset("utf8");

if($sqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
error_reporting(0); //show error

$CarOwner = "CarOwner2"; //CarOwner Tabel's Name
$ChildOwner = "ChildOwner";// Child Table's Name
?>