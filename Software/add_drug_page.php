<?php 
    include("header.php");
    include("link.php");
?>

<h3>新增藥品</h3>
<a href="personal_data_page.php"><input type="submit" value="返回個人資料頁面"></a>
<form action="add_drug.php" method="post" id="add">
 
藥物名稱
    <input type="input" name="drugName"></br>
<!-- 藥物用途(可複選) -->
藥物用途
    <select name="drugUsage">
        <option>請選擇藥物用途</option>
        <?php
            $diseaseId=0;
            $showDisease=TRUE;
            
            while($showDisease){
                $sql="SELECT `disease` FROM `diseaselist` WHERE `diseaseId`=$diseaseId";
                $table=mysqli_query($link,$sql); 
                $row = mysqli_fetch_assoc($table);   

                if(empty($row)){
                    $showDisease=FALSE;
                }else{?>
                    <option value="<?=$diseaseId?>"><?=$row['disease']?></option>
                    <?php
                    $diseaseId=$diseaseId+1;
                }
            }
        ?>
    </select></br>
    <!-- <input type="button" value="+"> -->

    
藥物用法/用量</br>

    <input type ="checkbox" id="breakfast" name="breakfast" value="true" onclick="mealTimeFunctionB()">早餐<span id="boxB"></span><br/>
    
    <input type ="checkbox" id="launch" name="launch" value="true" onclick="mealTimeFunctionL()">午餐<span id="boxL"></span><br/>

    <input type ="checkbox" id="dinner" name="dinner" value="true" onclick="mealTimeFunctionD()">晚餐<span id="boxD"></span><br/>

    <input type ="checkbox" id="sleep" name="sleep" value="true" onclick="mealTimeFunctionS()">睡前<span id="boxS"></span><br/>
    </br>
    <script>
        function mealTimeFunctionB(){
            const checkboxB = document.getElementById('breakfast');
            const boxsetB = document.getElementById("boxB");

            var mealTimeSelectorB=document.createElement("select");
            mealTimeSelectorB.setAttribute("name","mtsB");
            mealTimeSelectorB.options[0]=new Option("服用時間",null);
            mealTimeSelectorB.options[1]=new Option("飯前",1);
            mealTimeSelectorB.options[2]=new Option("飯中",2);
            mealTimeSelectorB.options[3]=new Option("飯後",3);
            mealTimeSelectorB.options[4]=new Option("空腹",0);


            var pillQuantitySelectorB=document.createElement("select");
            pillQuantitySelectorB.setAttribute("name","pqsB");
            pillQuantitySelectorB.options[0]=new Option("一次用量",null);
            pillQuantitySelectorB.options[1]=new Option("半顆",0);
            pillQuantitySelectorB.options[2]=new Option("1顆",1);
            pillQuantitySelectorB.options[3]=new Option("2顆",2);
            pillQuantitySelectorB.options[4]=new Option("3顆",3);


            var pillFrequancySelectorB=document.createElement("select");
            pillFrequancySelectorB.setAttribute("name","pfsB");
            pillFrequancySelectorB.options[0]=new Option("服用頻率",null);
            pillFrequancySelectorB.options[1]=new Option("1日1次",1);
            pillFrequancySelectorB.options[2]=new Option("2日1次",2);
            pillFrequancySelectorB.options[3]=new Option("3日1次",3);


            checkboxB.addEventListener('change', (e) => {
                if (e.target.checked) {
                    // boxset.innerText=`開 ${e.target.checked}`;
                    boxsetB.appendChild(mealTimeSelectorB);
                    boxsetB.appendChild(pillQuantitySelectorB);
                    boxsetB.appendChild(pillFrequancySelectorB);
                } else {
                    // boxTxt.innerText=`關 ${e.target.checked}`;
                    mealTimeSelectorB=null;
                    pillQuantitySelectorB=null;
                    pillFrequancySelectorB=null;
                    boxsetB.innerText=` `;
                }
            });
        }
        function mealTimeFunctionL(){
            const checkboxL = document.getElementById('launch');
            const boxsetL = document.getElementById("boxL");


            var mealTimeSelectorL=document.createElement("select");
            mealTimeSelectorL.setAttribute("name","mtsL");
            mealTimeSelectorL.options[0]=new Option("服用時間",null);
            mealTimeSelectorL.options[1]=new Option("飯前",0);
            mealTimeSelectorL.options[2]=new Option("飯中",1);
            mealTimeSelectorL.options[3]=new Option("飯後",2);
            mealTimeSelectorL.options[4]=new Option("空腹",3);


            var pillQuantitySelectorL=document.createElement("select");
            pillQuantitySelectorL.setAttribute("name","pqsL");
            pillQuantitySelectorL.options[0]=new Option("一次用量",null);
            pillQuantitySelectorL.options[1]=new Option("半顆",0);
            pillQuantitySelectorL.options[2]=new Option("1顆",1);
            pillQuantitySelectorL.options[3]=new Option("2顆",2);
            pillQuantitySelectorL.options[4]=new Option("3顆",3);


            var pillFrequancySelectorL=document.createElement("select");
            pillFrequancySelectorL.setAttribute("name","pfsL");
            pillFrequancySelectorL.options[0]=new Option("服用頻率",null);
            pillFrequancySelectorL.options[1]=new Option("1日1次",0);
            pillFrequancySelectorL.options[2]=new Option("2日1次",1);
            pillFrequancySelectorL.options[3]=new Option("3日1次",2);


            checkboxL.addEventListener('change', (e) => {
                if (e.target.checked) {
                    // boxset.innerText=`開 ${e.target.checked}`;
                    boxsetL.appendChild(mealTimeSelectorL);
                    boxsetL.appendChild(pillQuantitySelectorL);
                    boxsetL.appendChild(pillFrequancySelectorL);
                } else {
                    // boxTxt.innerText=`關 ${e.target.checked}`;
                    mealTimeSelectorL=null;
                    pillQuantitySelectorL=null;
                    pillFrequancySelectorL=null;
                    boxsetL.innerText=` `;
                }
            });
        }
        function mealTimeFunctionD(){
            const checkboxD = document.getElementById('dinner');
            const boxsetD = document.getElementById("boxD");


            var mealTimeSelectorD=document.createElement("select");
            mealTimeSelectorD.setAttribute("name","mtsD");
            mealTimeSelectorD.options[0]=new Option("服用時間",null);
            mealTimeSelectorD.options[1]=new Option("飯前",0);
            mealTimeSelectorD.options[2]=new Option("飯中",1);
            mealTimeSelectorD.options[3]=new Option("飯後",2);
            mealTimeSelectorD.options[4]=new Option("空腹",3);


            var pillQuantitySelectorD=document.createElement("select");
            pillQuantitySelectorD.setAttribute("name","pqsD");
            pillQuantitySelectorD.options[0]=new Option("一次用量",null);
            pillQuantitySelectorD.options[1]=new Option("半顆",0);
            pillQuantitySelectorD.options[2]=new Option("1顆",1);
            pillQuantitySelectorD.options[3]=new Option("2顆",2);
            pillQuantitySelectorD.options[4]=new Option("3顆",3);


            var pillFrequancySelectorD=document.createElement("select");
            pillFrequancySelectorD.setAttribute("name","pfsD");
            pillFrequancySelectorD.options[0]=new Option("服用頻率",null);
            pillFrequancySelectorD.options[1]=new Option("1日1次",0);
            pillFrequancySelectorD.options[2]=new Option("2日1次",1);
            pillFrequancySelectorD.options[3]=new Option("3日1次",2);

            checkboxD.addEventListener('change', (e) => {
                if (e.target.checked) {
                    // boxset.innerText=`開 ${e.target.checked}`;
                    boxsetD.appendChild(mealTimeSelectorD);
                    boxsetD.appendChild(pillQuantitySelectorD);
                    boxsetD.appendChild(pillFrequancySelectorD);
                } else {
                    // boxTxt.innerText=`關 ${e.target.checked}`;
                    mealTimeSelectorD=null;
                    pillQuantitySelectorD=null;
                    pillFrequancySelectorD=null;
                    boxsetD.innerText=` `;
                }
            });
        }
        function mealTimeFunctionS(){
            const checkboxS = document.getElementById('sleep');
            const boxsetS = document.getElementById("boxS");


            var mealTimeSelectorS=document.createElement("select");
            mealTimeSelectorS.setAttribute("name","mtsS");
            mealTimeSelectorS.options[0]=new Option("服用時間",null);
            mealTimeSelectorS.options[1]=new Option("飯前",0);
            mealTimeSelectorS.options[2]=new Option("飯中",1);
            mealTimeSelectorS.options[3]=new Option("飯後",2);
            mealTimeSelectorS.options[4]=new Option("空腹",3);


            var pillQuantitySelectorS=document.createElement("select");
            pillQuantitySelectorS.setAttribute("name","pqsS");
            pillQuantitySelectorS.options[0]=new Option("一次用量",null);
            pillQuantitySelectorS.options[1]=new Option("半顆",0);
            pillQuantitySelectorS.options[2]=new Option("1顆",1);
            pillQuantitySelectorS.options[3]=new Option("2顆",2);
            pillQuantitySelectorS.options[4]=new Option("3顆",3);


            var pillFrequancySelectorS=document.createElement("select");
            pillFrequancySelectorS.setAttribute("name","pfsS");
            pillFrequancySelectorS.options[0]=new Option("服用頻率",null);
            pillFrequancySelectorS.options[1]=new Option("1日1次",0);
            pillFrequancySelectorS.options[2]=new Option("2日1次",1);
            pillFrequancySelectorS.options[3]=new Option("3日1次",2);

            checkboxS.addEventListener('change', (e) => {
                if (e.target.checked) {
                    // boxset.innerText=`開 ${e.target.checked}`;
                    boxsetS.appendChild(mealTimeSelectorS);
                    boxsetS.appendChild(pillQuantitySelectorS);
                    boxsetS.appendChild(pillFrequancySelectorS);
                } else {
                    // boxTxt.innerText=`關 ${e.target.checked}`;
                    mealTimeSelectorS=null;
                    pillQuantitySelectorS=null;
                    pillFrequancySelectorS=null;
                    boxsetS.innerText=` `;
                }
            });
        }
        {   //參考程式碼
            // var oCheckbox=document.createElement("input");
            // Checkbox.setAttribute("type","checkbox");
            // Checkbox.setAttribute("id","mayi"); 
        }
    </script>
上一次領藥日期
    <?$today = date('Y-m-d');?>
    <input type ="date" name="lastTimeDate" value="<?=$today?>"><br/>
給藥日份
    <select name="dateofTreatment">
        <option value="1">	1</option>
        <option value="2">	2</option>
        <option value="3">	3</option>
        <option value="4">	4</option>
        <option value="5">	5</option>
        <option value="6">	6</option>
        <option value="7">	7</option>
        <option value="8">	8</option>
        <option value="9">	9</option>
        <option value="10">	10</option>
        <option value="11">	11</option>
        <option value="12">	12</option>
        <option value="13">	13</option>
        <option value="14">	14</option>
        <option value="15">	15</option>
        <option value="16">	16</option>
        <option value="17">	17</option>
        <option value="18">	18</option>
        <option value="19">	19</option>
        <option value="20">	20</option>
        <option value="21">	21</option>
        <option value="22">	22</option>
        <option value="23">	23</option>
        <option value="24">	24</option>
        <option value="25">	25</option>
        <option value="26">	26</option>
        <option value="27">	27</option>
        <option value="28">	28</option>
        <option value="29"> 29</option>
        <option value="30" selected> 30</option>
    </select><br/>
處方箋剩餘領藥次數
    <input type="radio" id="Radio2" name="Radio2" onclick="radioFunction2()">2次
    <input type="radio" id="Radio1" name="Radio1" onclick="radioFunction1()">1次
    <input type="radio" id="Radio0" name="Radio0" onclick="radioFunction0()" checked>0次<br/>

    <script>
        
        function radioFunction2() {
            document.getElementById("Radio1").checked = false;
            document.getElementById("Radio0").checked = false;
        }
        function radioFunction1() {
            document.getElementById("Radio2").checked = false;
            document.getElementById("Radio0").checked = false;
        }
        function radioFunction0() {
            document.getElementById("Radio1").checked = false;
            document.getElementById("Radio2").checked = false;
        }
    </script>
    <!-- <img src="photo/tempdesign.jpg"> --> 
    <!-- <input type ="" name="name"><br/> -->
    <input type ="submit" value="送出">
</form>