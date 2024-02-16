<?php
    //連線至db
    include("link.php");


    


    //藥物名稱
    $drugName=$_POST['drugName'];echo $drugName;echo '</br>';
    //藥物用途
    $drugUsage=$_POST['drugUsage'];echo $drugUsage;echo '</br>';//無法顯示
    //藥物用法/用量

   

    $breakfast=$_POST['breakfast'];echo $breakfast;echo '</br>';//得到值為true 要改成數字
    $launch=$_POST['launch'];echo $launch;echo '</br>';
    $dinner=$_POST['dinner'];echo $dinner;echo '</br>';
    $sleep=$_POST['sleep'];echo $sleep;echo '</br>';
    
    //上一次領藥日期
    $lastTimeDate=$_POST['lastTimeDate'];echo $lastTimeDate;echo '</br>';
    // echo $lastTimeDate;

    //給藥日份
    $dateofTreatment=$_POST['dateofTreatment'];echo $dateofTreatment;echo '</br>';

    //剩餘領藥次數
    if($_POST['Radio2'])
        $_SESSION['timesCanGet']=2;
    else if($_POST['Radio1'])
        $_SESSION['timesCanGet']=1;
    else if($_POST['Radio0'])
        $_SESSION['timesCanGet']=0;
    $timesCanGet=$_SESSION['timesCanGet'];
    echo $_SESSION['timesCanGet'];echo '</br>';
    
    
    

    //錯誤處理
    if($drugName==null){
        echo "請輸入名字";
        echo '<a href="personal_data_page.php"><input type="submit" value="返回個人資料頁面"></a>';
        echo '<a href="add_drug_page.php"><input type="submit" value="返回新增藥品頁面"></a>';
    }
    else if($drugUsage==null){
        echo "請選擇藥物用途";
        echo '<a href="personal_data_page.php"><input type="submit" value="返回個人資料頁面"></a>';
        echo '<a href="add_drug_page.php"><input type="submit" value="返回新增藥品頁面"></a>';
    }
    else if($breakfast==null && $launch==null && $dinner==null && $sleep==null){
        echo "請選擇服藥時間";
        echo '<a href="personal_data_page.php"><input type="submit" value="返回個人資料頁面"></a>';
        echo '<a href="add_drug_page.php"><input type="submit" value="返回新增藥品頁面"></a>';
    }
    
    
    
    


    if($breakfast){
        //服用時間  mealTimeSelectorB
        $mtsB = $_POST['mtsB'];
        //一次用量  pillQuantitySelectorB
        $pqsB = $_POST['pqsB'];
        //服用頻率  pillFrequancySelectorB
        $pfsB = $_POST['pfsB'];
        
        $breakfast=1;
        $id=$_SESSION['id'];

        /*                           序號  藥品名稱   適用疾病                  */      
        $sqlB = "INSERT INTO  `treatment` (`id`,`drugName`,`disease`,
        /*                           服藥時間    搭餐方式   單次用量            */
                                    `takeTime`,`mealTime`,`pillQuantity`,
        /*                           服用頻率         上次領藥日期   給藥日份   */
                                    `pillFrequency`,`pillGetDate`,`pillGetDays`,
        /*                           剩餘領藥次數   餘藥量                     */
                                    `pillGetTime`/*,`pillNumber`*/) 
                            VALUE ('$id','$drugName','$drugUsage',
                                   '$breakfast','$mtsB','$pqsB',
                                   '$pfsB','$lastTimeDate','$dateofTreatment',
                                   '$timesCanGet')";
        // echo $sql;
        $result = mysqli_query($_SESSION['link'],$sqlB);
        if (mysqli_affected_rows($link)>0) {
                echo "新增完成";
        }else {
                echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
        }
       
    }
    if($launch){
        $mtsL = $_POST['mtsL'];
        $pqsL = $_POST['pqsL'];
        $pfsL = $_POST['pfsL'];

        $launch=2;
        $id=$_SESSION['id'];

        /*                           序號  藥品名稱   適用疾病                  */      
        $sqlL = "INSERT INTO  `treatment` (`id`,`drugName`,`disease`,
        /*                           服藥時間    搭餐方式   單次用量            */
                                    `takeTime`,`mealTime`,`pillQuantity`,
        /*                           服用頻率         上次領藥日期   給藥日份   */
                                    `pillFrequency`,`pillGetDate`,`pillGetDays`,
        /*                           剩餘領藥次數   餘藥量                     */
                                    `pillGetTime`/*,`pillNumber`*/) 
                            VALUE ('$id','$drugName','$drugUsage',
                                   '$launch','$mtsL','$pqsL',
                                   '$pfsL','$lastTimeDate','$dateofTreatment',
                                   '$timesCanGet')";
        echo $sqlL;
        $result = mysqli_query($_SESSION['link'],$sqlL);
        if (mysqli_affected_rows($link)>0) {
                echo "新增完成";
        }else {
                echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
        }
        
    }
    if($dinner){
        $mtsD = $_POST['mtsD'];
        $pqsD = $_POST['pqsD'];
        $pfsD = $_POST['pfsD'];

        $dinner=3;
        $id=$_SESSION['id'];

        /*                           序號  藥品名稱   適用疾病                  */      
        $sqlD = "INSERT INTO  `treatment` (`id`,`drugName`,`disease`,
        /*                           服藥時間    搭餐方式   單次用量            */
                                    `takeTime`,`mealTime`,`pillQuantity`,
        /*                           服用頻率         上次領藥日期   給藥日份   */
                                    `pillFrequency`,`pillGetDate`,`pillGetDays`,
        /*                           剩餘領藥次數   餘藥量                     */
                                    `pillGetTime`/*,`pillNumber`*/) 
                            VALUE ('$id','$drugName','$drugUsage',
                                   '$launch','$mtsD','$pqsD',
                                   '$pfsD','$lastTimeDate','$dateofTreatment',
                                   '$timesCanGet')";
        echo $sqlD;
        $result = mysqli_query($_SESSION['link'],$sqlD);
        if (mysqli_affected_rows($link)>0) {
                echo "新增完成";
        }else {
                echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
        }
        
    }
    if($sleep){
        $mtsS = $_POST['mtsS'];
        $pqsS = $_POST['pqsS'];
        $pfsS = $_POST['pfsS'];

        $sleep=4;
        $id=$_SESSION['id'];

        /*                           序號  藥品名稱   適用疾病                  */      
        $sqlS = "INSERT INTO  `treatment` (`id`,`drugName`,`disease`,
        /*                           服藥時間    搭餐方式   單次用量            */
                                    `takeTime`,`mealTime`,`pillQuantity`,
        /*                           服用頻率         上次領藥日期   給藥日份   */
                                    `pillFrequency`,`pillGetDate`,`pillGetDays`,
        /*                           剩餘領藥次數   餘藥量                     */
                                    `pillGetTime`/*,`pillNumber`*/) 
                            VALUE ('$id','$drugName','$drugUsage',
                                   '$launch','$mtsS','$pqsS',
                                   '$pfsS','$lastTimeDate','$dateofTreatment',
                                   '$timesCanGet')";
        echo $sqlS;
        $result = mysqli_query($_SESSION['link'],$sqlS);
        if (mysqli_affected_rows($link)>0) {
                echo "新增完成";
        }else {
                echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
        }
        
    }
    mysqli_close($link);
    
    
    
    // $sql = "UPDATE  `user` SET  
    //         `userName`='$newName',
    //         `email`='$newEmail', 
    //         `boxid`='$newBoxid' 
    //         WHERE `id`=$id ";
    
    
    // $result = mysqli_query($link,$sql);
    // 如果有異動到資料庫數量(更新資料庫)
    // if (mysqli_affected_rows($link)>0) {
    //     echo "新增完成";
    // }
    // elseif(mysqli_affected_rows($link)==0) {
    //     header('Location: personal_data_page.php');
    // }
    // else {
    //     echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
    // }
    // mysqli_close($link); 
 ?>
 <!-- <br/><a href="personal_data_page.php"><input type="submit" value="返回個人資料頁面"></a> -->


<!-- 先對後面資料做審核 審核完畢後
再審核treament的輸入 用前面的資料 在各treatment無誤的情況下 各自新增一行資料 -->