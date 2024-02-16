
<html>
<head>
    <!-- <SCRIPT language=javascript>
function go()
{
window.history.go(-1);
}
setTimeout(“go()”,3000);
</SCRIPT> -->

<!-- 
    <META HTTP-EQUIV="refresh" CONTENT="2; URL= history.back() ">
    192.168.100.154
-->
    <meta http-equiv="refresh" content="10;url=linktoESP32.php" />
</head>
<body>
<?php 

    $humid1 = $_GET['humid1'];
    $fsr1 = $_GET['FSR1'];
    $fsr2 = $_GET['FSR2'];
    $fsr3 = $_GET['FSR3'];
    $fsr_out = $_GET['FSR_OUT'];

    $group_id ="Cc6a9d28df00e1f7e7e736ac035404f6b";

    echo $humid1;
    echo $fsr1;
    echo $fsr2;
    echo $fsr3;
    echo $fsr_out;

    if($humid1>70 && $humid1!=null){
        require_once('humidpush.php');
    }

    if($fsr1<=1000 && $fsr1!=null){
        require_once('fsr1push.php');
    }

    if($fsr2<=1000 && $fsr2!=null){
        require_once('fsr2push.php');
    }

    if($fsr3<=1000 && $fsr3!=null){
        require_once('fsr3push.php');
    }

    if($fsr_out>0 && $fsr_out!=null){
        require_once('fsroutpush.php');
    }



// $usr_id = "U72bd036948faa5dbdf66db1d74b6809e";


?>
</body>
</html>
