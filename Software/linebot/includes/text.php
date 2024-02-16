<?php
/**
 * Copyright 2020 GoneTone
 *
 * Line Bot
 * 範例 Example Bot (Text)
 *
 * 此範例 GitHub 專案：https://github.com/GoneToneStudio/line-example-bot-tiny-php
 * 此範例教學文章：https://blog.reh.tw/archives/988
 *
 * 官方文檔：https://developers.line.biz/en/reference/messaging-api#text-message
 */

/*
陣列輸出 Json
==============================
{
    "type": "text",
    "text": "Hello, world!"
}
==============================
*/
global $client, $message, $event;
if (strtolower($message['text']) == "text" || $message['text'] == "文字") {
    $client->replyMessage(array(
        'replyToken' => $event['replyToken'],
        'messages' => array(
            array(
                'type' => 'text', //訊息類型 (文字)
                'text' => 'Hello, daniel' //回覆訊息
            )
        )
    ));
}
if (strtolower($message['text']) == "a") {
    $client->replyMessage([
        "replyToken" => $event['replyToken'],
        'messages' => [
            [
                'type' => 'text', //訊息類型 (文字)
                'text' => '想去哪裡', //回覆訊息
                // 'quickReply' => [
                //     'item' => [
                //         [
                //             "type"=> "action",
                //             "action" => [
                //                 "type"=> "message",
                //                 "label"=> "歐洲",
                //                 "text"=> "歐洲"
                //             ]
                //         ]
                //     ]
                // ] 
            ]
        ]
    ]);
}
