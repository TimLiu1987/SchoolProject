<?php include("header.php");?><br/>
<form action="change_password.php" method="post">
輸入舊密碼: 
    <input type ="text" name="oldPasswd"><br/>
輸入新密碼: 
    <input type ="text" name="newPasswd"><br/>
再次輸入新密碼: 
    <input type ="text" name="checkNewPasswd"><br/>
    
    <input type ="submit" value="確認更改"><br/>
    
</form> 
<a href="change_personal_data_page.php"><input type="submit" value="返回修改頁面"></a>