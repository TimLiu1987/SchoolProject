<?php
    // 載入db.php來連結資料庫
    $dbhost='localhost';
    $dbuser = 'root';
    $dbpasswd = 'root';
    $db= 'smartbox';
    $link = new mysqli($host,$user,$passwd,$db) //(主機,帳號,密碼,資料庫名稱)
            or die("unable to connect");
?>



<!-- <h3>sql插入結果</h3> -->

<?php
    
    //設定id
    $table=mysqli_query($link,"SELECT * FROM user"); 
    $new_id=mysqli_num_rows($table);
    $name= $_POST['name'];
    $passwd=$_POST['passwd'];
    $email=$_POST['email'];
    $boxid=$_POST['boxid'];
    if($name==NULL || $email==NULL || $passwd==NULL){
        include("insert_wronginput.php");
    }else{
        if($boxid=='\0'){
            $sql = "INSERT INTO  `user` (`id`,`userName`,`password`,`email`,`boxid`) 
                    VALUE ($new_id,$name,$passwd,'$email',$boxid)";
        }else if($name!='\0' && $passwd!='\0' && $email!='\0'){
            $sql = "INSERT INTO  `user` (`id`,`userName`,`password`,`email`) 
                    VALUE ($new_id,$name,$passwd,'$email') ";
        }
        
        // 用mysqli_query方法執行(sql語法)將結果存在變數中
        mysqli_query($link,$sql);

        // 如果有異動到資料庫數量(更新資料庫)
        if (mysqli_affected_rows($link)>0) {
            echo "新增後的id為 {$new_id} ";
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