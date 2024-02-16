<?php
    // 載入db.php來連結資料庫
    //require_once 'db.php';
    $dbhost='localhost';
    $dbuser = 'root';
    $dbpasswd = 'root';
    $db= 'smartbox';
    $link = new mysqli($host,$user,$passwd,$db) //(主機,帳號,密碼,資料庫名稱)
            or die("unable to connect");

    function show($result){
        // 如果有資料
        if ($result) {
            // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
            if (mysqli_num_rows($result)>0) {
                // 取得大於0代表有資料
                // while迴圈會根據資料數量，決定跑的次數
                // mysqli_fetch_assoc方法可取得一筆值
                while ($row = mysqli_fetch_assoc($result)) {
                // 每跑一次迴圈就抓一筆值，最後放進data陣列中
                    $datas[] = $row;
                }
            }
    // 釋放資料庫查到的記憶體
        mysqli_free_result($result);
        }else {
            // echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
        }
// 處理完後印出資料
        if(!empty($result)){
    // 如果結果不為空，就利用print_r方法印出資料
   // print_r($datas);
        }else {
   // 為空表示沒資料
            echo "查無資料";
        }
        return $datas;
    }

    // 設置一個空陣列來放資料
    $datas = array();
    // sql語法存在變數中
    $name= $_POST['name'];
    $email =$_POST['email'];
    if($name==NULL && $email==NULL){
        include("select_wronginput.php");
    }
    else if($name!=NULL){
        $sql = "SELECT `userName`, `email` FROM `user` AS userData WHERE `userName`=$name";
        $result = mysqli_query($link,$sql);
        $datas=show($result);
    }else if($email!=NULL){
        $sql = "SELECT `userName`, `email` FROM `user` AS userData WHERE `email`=$email ";
        $result = mysqli_query($link,$sql);
        $datas=show($result);
    }
    
    // 用mysqli_query方法執行(sql語法)將結果存在變數中
    
    
?>
    <h3>查詢結果</h3>
<div>
    <?php if(!empty($datas)): ?>
    <ul>
        <!-- 資料 as key(下標) => row(資料的row) -->
        <?php foreach ($datas as $key => $row) :?>
        <li>
           第<?php echo($key +1 ); ?>筆資料，名字<?php echo $row['userName']; ?>，email：<?php echo $row['email']; ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php else:  ?>
    查無資料
    <?php endif; ?>
</div>
    <!-- 代表結束連線 -->
<?php mysqli_close($link);?>
<form action="index.php" method="post">
    <input type ="submit" value="返回首頁">
</form>  
<form action="select_input.php" method="post">
    <input type ="submit" value="重新查詢">
</form>  