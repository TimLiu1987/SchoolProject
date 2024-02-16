<?php
    // 載入db.php來連結資料庫
    // require_once 'db.php';
    $dbhost='localhost';
    $dbuser = 'root';
    $dbpasswd = 'root';
    $db= 'smartbox';
    $link = new mysqli($host,$user,$passwd,$db) //(主機,帳號,密碼,資料庫名稱)
            or die("unable to connect");
?>

<?php
    session_start();
    $newName=$_POST['newName'];
    $newEmail=$_POST['newEmail'];
    $newBoxid=$_POST['newBoxid'];

    if($newName==null)
        $newName=$_SESSION['name'];
    if($newEmail==null)
        $newEmail=$_SESSION['email'];
    if($newName==null)
        $newBoxid=$_SESSION['boxid'];

    $id=$_SESSION['id'];
        // sql語法存在變數中
    $sql = "UPDATE  `user` SET  `userName`='$newName', `email`='$newEmail', `boxid`='$newBoxid' WHERE `id`=$id ";
    // 用mysqli_query方法執行(sql語法)將結果存在變數中
    $result = mysqli_query($link,$sql);
    
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($link)>0) {
    echo "更改完成";
    }
    elseif(mysqli_affected_rows($link)==0) {
        header('Location: personal_data_page.php');
    }
    else {
        echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
    }
     mysqli_close($link); 
 ?>
 <br/><a href="personal_data_page.php"><input type="submit" value="返回個人資料頁面"></a>