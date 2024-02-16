<?php
include('link.php');
$sql="SELECT `drugName` FROM `treatment` WHERE `id`= 'U72bd036948faa5dbdf66db1d74b6809e'";
$result = mysqli_query($link,$sql); 
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        echo $row['drugName'];
    }
}

?>