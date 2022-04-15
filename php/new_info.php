<?php
require_once "connect.php";
session_start();
$user=$_SESSION['user'];
$user_info=$_POST['userinfo'];
$sql="SELECT * FROM `users` WHERE `login`='$user_info[user_login]'";
$check=$mysql->query($sql);

if($check->num_rows>=1){
    echo "errorlog";
    exit;
}
$sql="UPDATE `users` SET `login` = '$user_info[user_login]',`pass` = '$user_info[user_pass]',`name_user` = '$user_info[name_user]',`surname_user` = '$user_info[surname_user]',`secondname_user` = '$user_info[secondname_user]' WHERE `id_user` ='$user[id_user]'";
$mysql->query($sql);
$sql="SELECT * FROM `users` WHERE `id_user`='$user[id_user]'";
$user=$mysql->query($sql);

$_SESSION['user']=$user->fetch_assoc();