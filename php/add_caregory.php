<?php
require_once "connect.php";
$caregory=$_POST['name_category'];

$sql="INSERT INTO `categories` (`name`) VALUES ('$caregory')";
$mysql->query($sql);