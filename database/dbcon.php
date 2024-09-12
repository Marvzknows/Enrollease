<?php

$dbserver = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbnName = "u679986758_capstone";

$connection = mysqli_connect($dbserver,$dbuser,$dbpassword,$dbnName);

if(!$connection)
{
    die(mysqli_connect_error());
}
?>