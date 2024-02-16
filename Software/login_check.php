<?php
    // 載入db.php來連結資料庫
    //require_once 'db.php';
    include('link.php');
    
    
    $email = $_POST['email'];
    $passwd = base64_encode($_POST['passwd']);
    $sql = "SELECT `email`, `password` FROM `user` WHERE `email`='$email' AND `password`='$passwd' ";
    // echo $email." " .$passwd." ";
    $result = mysqli_query($link,$sql);
    $login=false;
    $row = mysqli_fetch_assoc($result);
    // echo $row['password'];
    if(!empty($row['password'])){
        echo "passwd n null";
        if($passwd==$row['password']){
            session_start();
            $_SESSION['email']="$email";
            $_SESSION['passwd']="$passwd";
            $login=true;
            
            header('Location: personal_data_page.php');
        }else{
            header('Location: wrong_passwd_page.php');
        }
    }
    // echo"F";
    mysqli_close($link);
