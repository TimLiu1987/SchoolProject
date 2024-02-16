<?php
    // 載入db.php來連結資料庫
    // require_once 'db.php';
    $dbhost='localhost';
    $dbuser = 'root';
    $dbpasswd = 'root';
    $db= 'smartbox';
    $link = new mysqli($dbhost,$dbuser,$dbpasswd,$db) //(主機,帳號,密碼,資料庫名稱)
            or die("unable to connect");
?>
<?php
session_start();
$checkPasswd=$_POST['passwd'];
$passwd=$_SESSION['passwd'];
$id=$_SESSION['id'];

if($checkPasswd==$passwd){
    // sql語法存在變數中
    $sql = "DELETE FROM `user` WHERE `id`= $id;";
    // 用mysqli_query方法執行(sql語法)將結果存在變數中
    $result = mysqli_query($link,$sql);
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($link)>0) {
        echo "資料已刪除";
        echo '<a href="index.php"><input style="submit" value="返回首頁"></a>';
    }else if(mysqli_affected_rows($link)==0) {
        echo "無資料刪除";
    }else {
        echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
    }
}else{
    echo "密碼輸入錯誤";
    echo '<br/><a href="personal_data_page.php"><input type="submit" value="返回個人資料頁面"></a>';
}



 mysqli_close($link); 
 ?>