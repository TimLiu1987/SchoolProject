<?php 

include("link.php");
$usr_id=$_GET['id'];


$sql="SELECT `id` FROM `user` AS userData WHERE `id`= '$usr_id'";
$result = mysqli_query($link,$sql); 
$row = mysqli_fetch_assoc($result);
if(empty($row)){
    $sql = "INSERT INTO  `user` (`id`,`loginCheck`) VALUE ('$usr_id','0')";
    mysqli_query($link,$sql);
    echo "註冊成功，可以關閉本頁面";
}else{
    $sql="SELECT `pillNum` FROM `treatment` WHERE `id`= '$usr_id'";
    $result= mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);
    echo $row['pillNum'];
    echo "已有帳號，可以關閉本頁面";
}