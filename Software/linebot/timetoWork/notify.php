<?php
include("link.php");
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

// $group_id ="Cc6a9d28df00e1f7e7e736ac035404f6b";
$hour = date("G");
$min = date("i");
$sql1 = "SELECT `id`,`eatCheck` FROM `user`";
$result1 = mysqli_query($link, $sql1);

if (mysqli_num_rows($result1) > 0) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $usr_id = $row1['id'];
        $sql2 = " SELECT `pillQuantity`,`pillNum`,`takeTime` FROM `treatment` WHERE `id`='$usr_id'  ";
        $result2 = mysqli_query($link, $sql2);
        while($row2 = mysqli_fetch_assoc($result2)){
            if (mysqli_num_rows($result2) > 0 && $row1['eatCheck'] == 0) {

                // if($hour>=7 && $hour<=10){
                if ($min % 4 == 1 && preg_match("/1/", $row2['takeTime']) != false) {
                    $Payload = [
                        'to' => $usr_id,
                        'messages' => [
                            [
                                'type' => 'text',
                                'text' => '目前尚未服藥，請記得服藥'
                            ],
                        ]
                    ];
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($Payload));
                    curl_exec($ch);
    
                    $pillnum = $row2['pillNum'] - $row2['pillQuantity'];
                    $taketime = $row2['takeTime'];
                    $sql = "UPDATE `treatment` SET `pillNum`= '$pillnum' WHERE `id`='$usr_id' and `takeTime`='$taketime'";
                    mysqli_query($link, $sql);
                }
    
                // if($hour>=11 && $hour<=13){
                if ($min % 4 == 2 && preg_match("/2/", $row2['takeTime']) != false) {
                    $Payload = [
                        'to' => $usr_id,
                        'messages' => [
                            [
                                'type' => 'text',
                                'text' => '目前尚未服藥，請記得服藥'
                            ],
                        ]
                    ];
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($Payload));
                    curl_exec($ch);
    
                    $pillnum = $row2['pillNum'] - $row2['pillQuantity'];
                    $taketime = $row2['takeTime'];
                    $sql = "UPDATE `treatment` SET `pillNum`= '$pillnum' WHERE `id`='$usr_id' and `takeTime`='$taketime'";
                    mysqli_query($link, $sql);
                }
    
                // if($hour>=17 && $hour<=20){
                if ($min % 4 == 3 && preg_match("/3/", $row2['takeTime']) != false) {
                    $Payload = [
                        'to' => $usr_id,
                        'messages' => [
                            [
                                'type' => 'text',
                                'text' => '目前尚未服藥，請記得服藥'
                            ],
                        ]
                    ];
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($Payload));
                    curl_exec($ch);
    
                    $pillnum = $row2['pillNum'] - $row2['pillQuantity'];
                    $taketime = $row2['takeTime'];
                    $sql = "UPDATE `treatment` SET `pillNum`= '$pillnum' WHERE `id`='$usr_id' and `takeTime`='$taketime'";
                    mysqli_query($link, $sql);
                }
    
                // if($hour>=21 && $hour<=0){
                if ($min % 4 == 0 && preg_match("/4/", $row2['takeTime']) != false) {
                    $Payload = [
                        'to' => $usr_id,
                        'messages' => [
                            [
                                'type' => 'text',
                                'text' => '目前尚未服藥，請記得服藥'
                            ],
                        ]
                    ];
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($Payload));
                    curl_exec($ch);
    
                    $pillnum = $row2['pillNum'] - $row2['pillQuantity'];
                    $taketime = $row2['takeTime'];
                    $sql = "UPDATE `treatment` SET `pillNum`= '$pillnum' WHERE `id`='$usr_id' and `takeTime`='$taketime'";
                    mysqli_query($link, $sql);
                }
            }
        }
        
        
    }
}




curl_close($ch);
