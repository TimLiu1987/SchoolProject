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
    $passwd=$_SESSION['passwd'];
    $oldPasswd=$_POST['oldPasswd'];
    $newPasswd=$_POST['newPasswd'];
    $checkNewPasswd=$_POST['checkNewPasswd'];

    $id=$_SESSION['id'];
    if($oldPasswd != $passwd){
        echo "舊密碼輸入不正確！";
        echo '<br/><a href="change_password_page.php"><input type="submit" value="返回更改密碼"></a>';
        
    }else if($oldPasswd == $newPasswd){
        echo "新密碼不可以和舊密碼相同！";
        echo '<br/><a href="change_password_page.php"><input type="submit" value="返回更改密碼"></a>';
        
    
    }else if($newPasswd != $checkNewPasswd){
        echo "兩次輸入不符！";
        echo '<br/><a href="change_password_page.php"><input type="submit" value="返回更改密碼"></a>';
    
    }else{
        // sql語法存在變數中 
        $sql = "UPDATE  `user` SET  `password`='$newPasswd' WHERE `id`=$id ";
        // 用mysqli_query方法執行(sql語法)將結果存在變數中
         $result = mysqli_query($link,$sql);
         // 如果有異動到資料庫數量(更新資料庫)
        if (mysqli_affected_rows($link)>0) {
        echo "更改完成";
        }
        // elseif(mysqli_affected_rows($link)==0) {
        //     echo "無更改任何資料";
        //     include("")
        // }
        else {
            echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
        }
        echo '<br/><a href="index.php"><input type="submit" value="返回登入"></a>';
    }

    
    
    
     mysqli_close($link); 
 ?>
 