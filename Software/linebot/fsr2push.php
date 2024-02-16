<?php
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
    
$group_id ="Cc6a9d28df00e1f7e7e736ac035404f6b";

$Payload = [ 
        'to' => $group_id,
        'messages' => [
            [
                'type' => 'text',
                'text' => '目前2號藥盤藥量較低，建議補藥'
            ],
        ]
    ];

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($Payload));
    curl_exec($ch);
    curl_close($ch);