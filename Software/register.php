

<?php
    include('link.php');
    //設定id
    $table=mysqli_query($link,"SELECT * FROM user"); 
    $new_id=mysqli_num_rows($table);
    
    $name=$_POST['name'];
    $passwd=base64_encode($_POST['passwd']);
    $email=$_POST['email'];
    $boxid=$_POST['boxid'];
    if($name==NULL || $email==NULL || $passwd==NULL){
        include("insert_wronginput.php");
    }else{
        if($boxid!=NULL){
            $sql = "INSERT INTO  `user` (`id`,`userName`,`password`,`email`,`boxid`) 
                    VALUE ($new_id,'$name','$passwd','$email','$boxid')";
        }else{
            $sql = "INSERT INTO  `user` (`id`,`userName`,`password`,`email`) 
                    VALUE ($new_id,'$name','$passwd','$email') ";
        }
        
        // 用mysqli_query方法執行(sql語法)將結果存在變數中
        $result=mysqli_query($link,$sql);

        // 如果有異動到資料庫數量(更新資料庫)
        if (mysqli_affected_rows($link)>0) {
            // echo "新增後的id為 {$new_id}";
            echo "註冊成功";
        }
        elseif(mysqli_affected_rows($link)==0) {
            echo "無資料新增";
        }
        else {
            // echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
        }
        mysqli_close($link); 
    }
    // $sql = "SELECT `userName`, `email` FROM `user` AS userData WHERE `userName`=$name `email`='$email'";
    // $result=mysqli_query($link,$sql);
    // if(!$result){
    //     include("insert_samename.php");
    // }
?>
<form action="index.php" method="post">
    <input type ="submit" value="返回首頁">
</form>  

<?//慢性病種類選擇?>