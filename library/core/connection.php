<?php
session_start();
$dbservername="localhost";
$dbusername="matrimonial";
$dbpassword="matrimonial020497@";
$dbName="library";
$conn=new mysqli($dbservername, $dbusername, $dbpassword, $dbName);
if ($conn->connect_error) {
die("connection failed:");
}
?>