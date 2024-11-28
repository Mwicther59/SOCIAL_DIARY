<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "dairy";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn)
{
    die("server connection failed : " . mysqli_connect_error());
}
?>