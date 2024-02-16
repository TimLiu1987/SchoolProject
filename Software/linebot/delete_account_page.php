<?php include ("header.php");
    // session_start();
    // $id=$_SESSION['id'];
    // echo $id;

?>

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

    <link rel="stylesheet" href="style/delete_account_page_style.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>資料修改</title>

</head>

<body>
    <nav class="navbar navbar-light" style="border-radius: 5px; background-color:#272727;" id="nav-header">
        <a class="navbar-brand" href="index.php">
            <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30"
                class="d-inline-block align-top" alt="">
            智慧藥盒
        </a>
    </nav>

    <div class="center">
        <h1>資料刪除</h1>
        <form action="delete_account.php" method="post" name="form">
            <div class="txt_field">
                <span style="color:red">請問是否要刪除帳號？</span>
            </div>
            <div class="txt_field">
                <span>請輸入您的密碼：</span>
                <input type="password" name="passwd">
            </div>
            <div class="txt_field">
                <span style="color:red">＊注意：此操作不可逆</span>
            </div>
            <div class="button">
                <input type="submit" value="確認">
            </div>
            <div class="button">
                <a href="personal_data_page.php"><input type="submit" value="返回個人資料頁面"></a>
            </div>

        </form>
    </div>

</body>



</html>