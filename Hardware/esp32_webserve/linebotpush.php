<?php 
// include("link.php");
header("Access-Control-Allow-Origin: *");
// header(“Access-Control-Allow-Methods: *”);
header("Access-Control-Allow-Headers:x-requested-with,content-type");

$data=$_GET['temp1'];
// 如果是 GET 請求
if (!empty($data)) {

//   回應請求
  echo  $data;
  exit;
}

// $uri = $_SERVER['REQUEST_URI'];
// $data = explode("?",$uri);
// $eachdata=explode("&",$uri);
// $temp=$eachdata;
// $humi=$eachdata;
// file_put_contents('get.txt', $data[1]);
// echo "data=".$data[1];
// $sql="SELECT `id` FROM `user` AS userData WHERE `boxid`= '$boxid'";
// $result = mysqli_query($link,$sql); 
// $usr_id = mysqli_fetch_assoc($result);

//設定Token 
$ChannelSecret = '37dc3371b860d8d23a6a12e5c14bd169'; 
$ChannelAccessToken = '+/5N813XXTcoB4UZrCh8uBHsnkIcqvUbqp4MCFdvYbUET4fFQ0fltd3yC6ny/C0Esz8BqYLUIc9H4ojMxBqKezh9Qt5OCwRnG2Y0XslUyEtYOA4mhucQAKaVQS8td72UvYVy5LTIH3Jczvp0zpCsFwdB04t89/1O/w1cDnyilFU='; 

$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.line.me/v2/bot/message/push');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $ChannelAccessToken
    ]);

// $usr_id = "U72bd036948faa5dbdf66db1d74b6809e";
$group_id ="Cc6a9d28df00e1f7e7e736ac035404f6b";
//逐一執行事件 

    $Payload = [ 
        'to' => $group_id,
        'messages' => [
            [
                'type' => 'text',
                'text' => '嗨，我來主動找醜醜聊天了'
            ],
        //     [
        //         'type' => 'text',
        //         'text' => $data[1]
        //     ]
        ]
    ];

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($Payload));
    curl_exec($ch);
    curl_close($ch);
    
    
    

    

?>