<?PHP
// 獲取推播token
// $curl = curl_init();
// curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://notify-bot.line.me/oauth/token",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_POSTFIELDS => array(
//                               'grant_type' => 'authorization_code',
//                             'redirect_uri' => 'https://461a-140-137-132-15.jp.ngrok.io/linebot/CallBack.php',
//                                'client_id' => 'rJOTGS6tF8loL0fm4dD7lT',
//                            'client_secret' => 'TWk7uu7yVT5FcHGh7zaGbqIZnyYlk77iZnr2CU4VNEM',
//                                     'code' => $_POST["code"]),
//   CURLOPT_HTTPHEADER => array(
//     "Cookie: XSRF-TOKEN=d98fa9e6-f9d6-46e2-ac3e-4df0c7b3f834"
//   ),
// ));
// $response = curl_exec($curl);
// curl_close($curl);
// $obj = json_decode($response);
$access_token = 'AUAcvImMQ5eGAhYxntrQjThbBj7i0yoeaI68TMMb6vy';
$msg = 'hi,my accesstoken = '.$access_token;

$headers = array(
  'Content-Type: multipart/form-data',
  'Authorization: Bearer '.$access_token
);
$message = array(
  'message' =>$msg
);
$ch = curl_init();
curl_setopt($ch , CURLOPT_URL , "https://notify-api.line.me/api/notify");
// curl_setopt($ch , CURLOPT_URL , "https://api.line.me/v2/bot/message/push");

https://api.line.me/v2/bot/message/push
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

$result = curl_exec($ch);
file_put_contents('callback.json', $result);
curl_close($ch);
?>


