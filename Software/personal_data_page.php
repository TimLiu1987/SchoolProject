<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="style\css\personal_data_style.css" />
    <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <?php
    include("header.php");
    // 載入db.php來連結資料庫
    //require_once 'db.php';
    include("link.php");
    // sql語法存在變數中

    session_start();

    $email = $_SESSION['email'];
    $passwd = $_SESSION['passwd'];


    $sql = "SELECT `id`, `userName`,`password`, `email`, `boxid` FROM `user` AS userData WHERE `email`='$email' AND `password`='$passwd'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    // 用mysqli_query方法執行(sql語法)將結果存在變數中
    $_SESSION['id'] = $row['id'];
    $_SESSION['userName'] = $row['userName'];
    $_SESSION['passwd'] = $row['password'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['boxid'] = $row['boxid'];


    ?>
    <title>個人訊息</title>

</head>

<body>

    <div id="page-wrapper">

        <!-- Header -->
        <nav class="navbar navbar-light" style="border-radius: 5px; background-color:#272727;" id="nav-header">
            <a class="navbar-brand" href="index.html">
                <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
                智慧藥盒
            </a>
        </nav>




        <!-- Banner -->
        <div class="container">
            <div class="user_profile wrap">
                <div><img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" class="user_photo">
                </div>
                <div>
                    <h2>歡迎來到智慧藥盒官網</h2>
                    <div id="center">
                        <h2>
                        <?php
                            echo $_SESSION['userName'];
                        ?>，你好
                        </h2>
                        <h3>個人資料:
                        </h3>
                        <div> 名字：
                        <?php
                            echo $_SESSION['userName'];
                        ?>
                        </div>
                        <div> email：
                        <?php
                            echo $_SESSION['email']
                        ?>
                        </div>
                        <div> boxid：
                        <?php
                            echo $_SESSION['boxid']
                        ?>
                        </div>
                        <img src="photo/personalData.png">

                        <a href="add_drug_page.php"><img src="photo/add_Drug.png" id="add_drug"></a>
                    </div>
                </div>
                <div>
                    <img src="https://i.pinimg.com/originals/2d/b7/f7/2db7f72926a43467c1f685765cbb3181.png" style="width: 200px; height: 100%;">
                </div>
            </div>
        </div>
    </div>

    <div class="h2">
        藥物種類及次數
    </div>

    <div class="wrapper">
        <li class="note">
            <div class="details">
                <p>藥物1</p>
                <span>藥物內容</span>
            </div>
            <div class="buttom-content">
                <div class="settings">
                    <i class="uil uil-ellipsis-h"></i>
                    <ul class="menu">
                        <li><i class="uil uil-pen"></i>edit</li>
                        <li><i class="uil uil-trash"></i>delete</li>
                    </ul>
                </div>
            </div>
        </li>

        <li class="note">
            <div class="details">
                <p>藥物2</p>
                <span>藥物內容</span>
            </div>
            <div class="buttom-content">
                <div class="settings">
                    <i class="uil uil-ellipsis-h"></i>
                    <ul class="menu">
                        <li><i class="uil uil-pen"></i>edit</li>
                        <li><i class="uil uil-trash"></i>delete</li>
                    </ul>
                </div>
            </div>
        </li>

        <li class="note">
            <div class="details">
                <p>藥物3</p>
                <span>藥物內容</span>
            </div>
            <div class="buttom-content">
                <div class="settings">
                    <i class="uil uil-ellipsis-h"></i>
                    <ul class="menu">
                        <li><i class="uil uil-pen"></i>edit</li>
                        <li><i class="uil uil-trash"></i>delete</li>
                    </ul>
                </div>
            </div>
        </li>

        <li class="note">
            <div class="details">
                <p>藥物4</p>
                <span>藥物內容</span>
            </div>
            <div class="buttom-content">
                <div class="settings">
                    <i class="uil uil-ellipsis-h"></i>
                    <ul class="menu">
                        <li><i class="uil uil-pen"></i>edit</li>
                        <li><i class="uil uil-trash"></i>delete</li>
                    </ul>
                </div>
            </div>
        </li>
    </div>


    <!-- 代表結束連線 -->
    <?php mysqli_close($link); ?>

    <div class="submit-butt">
        <form action="change_personal_data_page.php" method="post">
            <input type="submit" value="修改資料" class="btn btn-info">
        </form>
        <br>
        <form action="index.php" method="post">
            <input type="submit" value="登出" class="btn btn-info">
        </form>
        <br>
        <a href="delete_account_page.php">
            <input style="color:red; font-weight:bold;" type="submit" value="刪除帳號" class="btn btn-info">
        </a>
    </div>



</body>

</html>






<!-- 慢性病選擇
慢性病種類顯示、增減
藥物增減(圖形化介面)
藥物剩餘量(顆/日)
藥物量少時提醒 -->