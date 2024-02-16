<?php
// include("header.php");
// echo '<h3>歡迎來到智慧藥盒官網</h3>
// <a href="login_page.php">登入</a>
// <a href="register_page.php">註冊</a>';
// session_start();
// session_destroy();
?>

<!DOCTYPE html>
<!-- lang代表網頁主要語言,如果有設對於搜尋引擎是友善的,對於瀏覽器在判斷是有幫助的 -->
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="style\css\index_style.css">
    <title>
        智慧藥盒系統
    </title>


</head>

<body>
    <div class="center">
        <h1>登入</h1>
        <form action="login_check.php" method="post">
            <div class="txt_field">
                <input type="email" name='email' required>
                <label>帳號</label>
            </div>
            <div class="txt_field">
                <input type="password" name='passwd' required>
                <label>密碼</label>
            </div>
            <div class="fogetpass">
                忘記密碼?
            </div>
            <input type="submit" value="Login">
            <div class="signup">
                還沒有加入? <a href="register_page.php">註冊</a>
            </div>
        </form>
    </div>

</body>