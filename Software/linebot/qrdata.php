<?php 

include("link.php");


$_SESSION['qrdata']=$_POST['qrdata'];
$_SESSION['usr_id']=$_POST['usr_id'];
$qrdata= $_SESSION['qrdata'];
$usr_id=$_SESSION['usr_id'];

$sql="SELECT `id` FROM `user` AS userData WHERE `id`= '$usr_id'";
$result = mysqli_query($link,$sql); 
$row = mysqli_fetch_assoc($result);
if(empty($row)){
    $sql = "INSERT INTO  `user` (`id`) VALUE ('$usr_id')";
    $result=mysqli_query($link,$sql);
}

$sql="SELECT `id` FROM `user` AS userData WHERE `id`= '$usr_id'";
$result = mysqli_query($link,$sql); 
$row = mysqli_fetch_assoc($result);
$check=strpos($qrdata,',');
if(!empty($row)&&$check!=0){
    
    $text=explode(",",$qrdata);
    
    
    $sql = "INSERT INTO `treatment`(
                                `id`, `drugName`, `disease`,
                                `takeTime`, `mealTime`, `pillQuantity`,
                                `pillFrequency`, `pillGetDate`, `pillGetDays`,
                                `pillGetTime`,`pillNum`) 
                            VALUES (
                                '$usr_id','$text[0]','$text[1]',
                                '$text[2]','$text[3]','$text[4]',
                                '$text[5]','$text[6]','$text[7]',
                                '$text[8]','$text[9]')";
    $result=mysqli_query($link,$sql);
    echo "新增成功";
}
else{
    echo "新增失敗，請重新掃描！";
}

// $url="scanner.php?id="+$usr_id;
?> 
<html>
<form action="scanner.php?id=<?=$usr_id?>" method="post">
    <input type ="submit" value="回到QR code掃描">
</form>
</html>