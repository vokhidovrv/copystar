<?php
require_once "connect.php";
$imgfile=$_FILES['img_product'];
$location="../img/product/".time()."_".$imgfile['name'];
$info_product['name']=$_POST['name_product'];
$info_product['about']=$_POST['about_product'];
$info_product['price']=$_POST['price_product'];
$info_product['category']=$_POST['category'];
move_uploaded_file($_FILES['img_product']['tmp_name'],$location);
print_r($info_product);
$sql="INSERT INTO `products` (`name`, `about`, `img`, `price`,`category`) VALUES ('$info_product[name]', '$info_product[about]', '$location', '$info_product[price]','$info_product[category]')";
$mysql->query($sql);
