<?php
    // 載入db.php來連結資料庫
    // require_once 'db.php';
    $dbhost='localhost';
    $dbuser = 'root';
    $dbpasswd = 'A9406703';
    $db= 'smartbox';
    $link = new mysqli($dbhost,$dbuser,$dbpasswd,$db) //(主機,帳號,密碼,資料庫名稱)
            or die("unable to connect");
    session_start();
    $_SESSION['link']=$link;
?>