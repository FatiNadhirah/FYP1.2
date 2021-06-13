<?php


$sname = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "personality";


$link = mysqli_connect($sname, $dbusername, $dbpassword, $dbname);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>