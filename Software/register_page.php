<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style/register_page_style.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>個人訊息</title>

    <?php include("header.php");?>

</head>

<body>
    <!-- Header -->

    <nav class="navbar navbar-light" style="border-radius: 5px; background-color:#272727;" id="nav-header">
        <a class="navbar-brand" href="index.html">
            <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30"
                class="d-inline-block align-top" alt="">
            智慧藥盒
        </a>
    </nav>

    <div class="center">
        <h1>使用者註冊</h1>
        <form action="register.php" method="post">
            <div class="txt_field">
                <span>請輸入名字 :</span>
                <input type="text" name="name">
            </div>
            <div class="txt_field">
                <span>請輸入密碼 :</span>
                <input type="password" name="passwd">
            </div>
            <div class="txt_field">
                <span>請輸入email :</span>
                <input type="email" name="email">
            </div>
            <div class="txt_field">
                <span>請輸入產品序號(選填) :</span>
                <input type="text" name="boxid">
            </div>
            <div class="button">
                <input type="submit" value="送出">
            </div>

        </form>
    </div>




</body>

</html>






<!-- 慢性病選擇
慢性病種類顯示、增減
藥物增減(圖形化介面)
藥物剩餘量(顆/日)
藥物量少時提醒 -->