<?php 
include("link.php");

$ngrok="https://7a39-61-230-162-98.jp.ngrok.io";
//設定Token 
$ChannelSecret = '37dc3371b860d8d23a6a12e5c14bd169'; 
$ChannelAccessToken = '+/5N813XXTcoB4UZrCh8uBHsnkIcqvUbqp4MCFdvYbUET4fFQ0fltd3yC6ny/C0Esz8BqYLUIc9H4ojMxBqKezh9Qt5OCwRnG2Y0XslUyEtYOA4mhucQAKaVQS8td72UvYVy5LTIH3Jczvp0zpCsFwdB04t89/1O/w1cDnyilFU='; 
 
//讀取資訊 
$HttpRequestBody = file_get_contents('php://input'); 
$HeaderSignature = $_SERVER['HTTP_X_LINE_SIGNATURE']; 
 
//驗證來源是否是LINE官方伺服器 
$Hash = hash_hmac('sha256', $HttpRequestBody, $ChannelSecret, true); 
$HashSignature = base64_encode($Hash); 
if($HashSignature != $HeaderSignature) 
{ 
    die('hash error!'); 
} 
 
//輸出 
file_put_contents('log.txt', $HttpRequestBody);
 
//解析 
$DataBody=json_decode($HttpRequestBody, true); 

$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.line.me/v2/bot/message/reply');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $ChannelAccessToken
    ]);

//逐一執行事件 
foreach($DataBody['events'] as $Event) 
{ 
    $getsource = $Event['source'];
    $getMessage = $Event['message'];
    $usr_id = $getsource['userId'];

    // 傳送訊息
    
    switch ($Event['type']) {
        case 'message': //訊息觸發

            //確認登入與否
            $sql="SELECT `loginCheck` FROM `user` AS userData WHERE `id`= '$usr_id'";
            $result= mysqli_query($link,$sql);
            $row = mysqli_fetch_assoc($result);

            if($row['loginCheck']==null){//確認註冊與否
                $Payload = [ 
                    'replyToken' => $Event['replyToken'],
                    'messages' => [
                        [
                            'type' => 'text',
                            'text' => '請先註冊'
                        ],
                    ]
                ];
            }
            
            else if($getMessage['text'] == "milkcoco"){//判斷訊息是否為登入密語
                $Payload = [ 
                    'replyToken' => $Event['replyToken'],
                    'messages' => [
                        [
                            'type' => 'text',
                            'text' => '登入成功'
                        ],
                    ]
                ];
                $sql="UPDATE  `user` SET  `loginCheck`= 1 WHERE `id`='$usr_id' ";
                mysqli_query($link,$sql);
            }
           
            else if(preg_match("/註冊/", $getMessage['text'])!=false){ //確認是否為要求註冊的訊息
                $Payload = [
                    'replyToken'=>$Event['replyToken'],
                    'messages' => [
                    [
                        'type' => 'template', //訊息類型 (模板)
                        'altText' => '已開啟功能選單', //替代文字
                        'template' => [
                            'type' => 'buttons', //類型 (按鈕)
                            'title' => '功能選單',
                            'text' => '選擇要開啟的功能', //文字
                            'actions' => [
                            [
                                'type' => 'uri', //類型 (連結)
                                'label' => '點我註冊', //標籤
                                'uri' => "$ngrok/linebot/lineRegister.php?id=$usr_id" //連結網址
                            ],
                            ]
                        ]
                    ]]  
                ];
            }
           
            else if($row['loginCheck'] == 0){ //確認是否未登入
                $Payload = [ 
                    'replyToken' => $Event['replyToken'],
                    'messages' => [
                        [
                            'type' => 'text',
                            'text' => '請輸入登入密語'
                        ],
                    ]
                ];
            }
            
            else{//確認已註冊且已登入
                switch ($getMessage['type']) {
                    case 'text': //訊息為文字
                        $message=strtolower($getMessage['text']);

                        switch($message){//各項訊息文字確認
                            case preg_match("/hi/", $message)!=false :
                                $Payload = [ 
                                    'replyToken' => $Event['replyToken'],
                                    'messages' => [
                                        [
                                            'type' => 'text',
                                            'text' => '嗨，我是藥盒小精靈，找我有什麼事嗎？'
                                        ],
                                    ]
                                ];
                                break;
                            case preg_match("/qr/", $message)!=false ://QR code掃描
                                $Payload = [
                                    'replyToken'=>$Event['replyToken'],
                                    'messages' => [[
                                        'type' => 'template', //訊息類型 (模板)
                                        'altText' => '已開啟功能選單', //替代文字
                                        'template' => [
                                            'type' => 'buttons', //類型 (按鈕)
                                            'title' => '功能選單',
                                            'text' => '選擇要開啟的功能', //文字
                                            'actions' => [
                                                [
                                                    'type' => 'uri', //類型 (連結)
                                                    'label' => 'QR code scaner', //標籤
                                                    'uri' => "$ngrok/linebot/scanner.php?id=$usr_id" //連結網址
                                                ],
                                            ]
                                        ]
                                    ]]  
                                ];
                                break;

                            case "我已服藥":
                                $Payload = [ 
                                    'replyToken' => $Event['replyToken'],
                                    'messages' => [
                                        [
                                            'type' => 'text',
                                            'text' => '好的，已關閉提醒'
                                        ],
                                    ]
                                ];
                                $sql="UPDATE  `user` SET  `eatCheck`= 1 WHERE `id`='$usr_id' ";
                                mysqli_query($link,$sql);
                                break;

                            case "顯示詳細資料":
                                $Payload = [
                                    'replyToken'=>$Event['replyToken'],
                                    'messages' => [[
                                        'type' => 'template', //訊息類型 (模板)
                                        'altText' => '已開啟功能選單', //替代文字
                                        'template' => [
                                            'type' => 'buttons', //類型 (按鈕)
                                            'title' => '功能選單',
                                            'text' => '選擇要開啟的功能', //文字
                                            'actions' => [
                                                [
                                                    'type' => 'uri', //類型 (連結)
                                                    'label' => '點我查看服藥詳情', //標籤
                                                    'uri' => "$ngrok/linebot/data_page.php?id=$usr_id" //連結網址
                                                ],
                                            ]
                                        ]
                                    ]]  
                                ];
                                break;

                            case "藥盒狀態":
                                $Payload = [
                                    'replyToken'=>$Event['replyToken'],
                                    'messages' => [[
                                        'type' => 'template', //訊息類型 (模板)
                                        'altText' => '已開啟功能選單', //替代文字
                                        'template' => [
                                            'type' => 'buttons', //類型 (按鈕)
                                            'title' => '功能選單',
                                            'text' => '選擇要開啟的功能', //文字
                                            'actions' => [
                                                [
                                                    'type' => 'uri', //類型 (連結)
                                                    'label' => '點我查看藥盒狀態', //標籤
                                                    'uri' => "$ngrok/linebot/linktoESP32.php" //連結網址
                                                ],
                                            ]
                                        ]
                                    ]]  
                                ];
                                break;
                                
                            case "登出":
                                $Payload = [ 
                                    'replyToken' => $Event['replyToken'],
                                    'messages' => [
                                        [
                                            'type' => 'text',
                                            'text' => '已登出'
                                        ],
                                    ]
                                ];
                                $sql="UPDATE  `user` SET  `loginCheck`= 0 WHERE `id`='$usr_id' ";
                                mysqli_query($link,$sql);
                                break;
                            
                            
                            default:
                                $Payload = [ 
                                    'replyToken' => $Event['replyToken'],
                                    'messages' => [
                                        [
                                            'type' => 'text',
                                            'text' => '我不能理解'
                                        ],
                                    ]
                                ];
                                break;
                            
                        }
                        break;
                    default:
                        break;
                }
            }
            break;
        case 'follow': //加為好友觸發
            $Payload = [
                'replyToken'=>$Event['replyToken'],
                'messages' => [
                [
                    'type' => 'text',
                    'text' => '嗨，我是藥盒小精靈'
                ],
                [
                    'type' => 'template', //訊息類型 (模板)
                    'altText' => '已開啟功能選單', //替代文字
                    'template' => [
                        'type' => 'buttons', //類型 (按鈕)
                        'title' => '功能選單',
                        'text' => '選擇要開啟的功能', //文字
                        'actions' => [
                        [
                            'type' => 'uri', //類型 (連結)
                            'label' => '點我註冊', //標籤
                            'uri' => "$ngrok/linebot/lineRegister.php?id=$usr_id" //連結網址
                        ],
                        ]
                    ]
                ]]  
            ];
            break;
        case 'join': //加入群組觸發
            $Payload = [
                'replyToken'=>$Event['replyToken'],
                'messages' => [
                [
                    'type' => 'text',
                    'text' => '嗨，我是藥盒小精靈'
                ],
                [
                    'type' => 'template', //訊息類型 (模板)
                    'altText' => '已開啟功能選單', //替代文字
                    'template' => [
                        'type' => 'buttons', //類型 (按鈕)
                        'title' => '功能選單',
                        'text' => '選擇要開啟的功能', //文字
                        'actions' => [
                        [
                            'type' => 'uri', //類型 (連結)
                            'label' => '點我註冊', //標籤
                            'uri' => "$ngrok/linebot/lineRegister.php?id=$usr_id" //連結網址
                        ],
                        ]
                    ]
                ]
                ]  
            ];
            break;
        default:
            break;
        
    }
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($Payload));
    curl_exec($ch);
    curl_close($ch);
    
}
?>