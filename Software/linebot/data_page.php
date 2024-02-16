<!DOCTYPE html>
<html>

<head>

</head>

<body>
<?php

    include("link.php");
    // sql語法存在變數中
    $usr_id = $_GET['id'];
    // echo "藥品名稱 ";echo "疾病類型 ";echo "服藥時間 ";
    //         echo "搭餐方式 ";echo "服藥數量 ";echo "服藥頻率 ";
    //         echo "上次領藥日期 ";echo "領藥日份 ";echo "剩餘取藥次數 ";
    //         echo "餘藥量<br>";
    $sql="SELECT `drugName`,`disease`,`takeTime`,
                `mealTime`,`pillQuantity`,`pillFrequency`,
                `pillGetDate`,`pillGetDate`,`pillGetDays`,
                `pillGetTime`,`pillNum` FROM `treatment` WHERE `id`= '$usr_id'";
    $result = mysqli_query($link,$sql); 
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            echo $row['drugName'];
            switch($row['disease']){
                case 0:
                    echo " 心臟病";
                    break;
                case 1:
                    echo " 高血壓";
                    break;
                case 2:
                    echo " 糖尿病";
                    break;
                case 3:
                    echo " 痛風";
                    break;
                case 4:
                    echo " 高血糖";
                    break;
            }
            switch($row['takeTime']){
                case 1:
                    echo " 早上";
                    break;
                case 2:
                    echo " 中午";
                    break;
                case 3:
                    echo " 晚上";
                    break;
                case 4:
                    echo " 睡前";
                    break;
                case 12:
                    echo " 早上和中午";
                    break;
                case 13:
                    echo " 早上和晚上";
                    break;
                case 14:
                    echo " 早上和睡前";
                    break;
                case 23:
                    echo " 中午和晚上";
                    break;
                case 24:
                    echo " 中午和睡前";
                    break;
                case 34:
                    echo " 晚上和睡前";
                    break;
                case 123:
                    echo " 早上、中午和晚上";
                    break;
                case 124:
                    echo " 早上、中午和睡前";
                    break;
                case 134:
                    echo " 早上、晚上和睡前";
                    break;
                case 234:
                    echo " 中午、晚上和睡前";
                    break;
                case 1234:
                    echo " 早上、中午、晚上和睡前";
                    break;
            }
            switch($row['mealTime']){
                case 0:
                    echo " 空腹";
                    break;
                case 1:
                    echo " 飯前";
                    break;
                case 2:
                    echo " 飯中";
                    break;
                case 3:
                    echo " 飯後";
                    break;
            }
            switch($row['pillQuantity']){
                case 1:
                    echo " 一次1顆";
                    break;
                case 2:
                    echo " 一次2顆";
                    break;
                case 3:
                    echo " 一次3顆";
                    break;
            }
            switch($row['pillFrequency']){
                case 1:
                    echo " 一日1服";
                    break;
                case 2:
                    echo " 兩日1服";
                    break;
                case 3:
                    echo " 三日1服";
                    break;
            }
            echo " 上次領藥日期："; echo $row['pillGetDate'];
            echo " 領藥" . $row['pillGetDays'] . "日份";
            echo " 剩餘" . $row['pillGetTime'] . "次取藥次數";
            echo " 剩餘" . $row['pillNum'] . "顆藥";
            echo "<br>";
        }
    }
    
    
    ?>
    <!-- 代表結束連線 -->
    <?php mysqli_close($link); ?>

    <!-- <div class="submit-butt">
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
    </div> -->



</body>

</html>






<!-- 慢性病選擇
慢性病種類顯示、增減
藥物增減(圖形化介面)
藥物剩餘量(顆/日)
藥物量少時提醒 -->