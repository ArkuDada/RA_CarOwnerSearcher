
<?php
include 'Config.php';
echo "<button value=\"รีโหลด\" class=\"refresh\" onClick=\"window.location.reload();\"></button>";
$LPN = mysqli_real_escape_string($sqli, $_REQUEST['LPN']);
$Pro = mysqli_real_escape_string($sqli, $_REQUEST['province']);
$Veh = mysqli_real_escape_string($sqli, $_REQUEST['Vehicle']);

$result = mysqli_query($sqli, "SELECT * FROM $CarOwner WHERE LPN LIKE '%{$LPN}%' AND Province LIKE '%{$Pro}%' AND Vehicle LIKE '%{$Veh}%'  ");
$spam = mysqli_num_rows($result);
echo "
<script>
console.log($spam);
if ($spam == 0){
    var spam = 0;
}else{
    var spam = 1;
}
</script>
";
$firstTime = $spam == 0 && $LPN == null;
$insertCorrect = $spam == 0;
$insertFalse = $spam == 1;
if ($firstTime){
    $type = null;
    $Veh = null;
    $LPN = null;
    $Pro = null;
    $first_name = null;
    $last_name = null;
    $tel = null;
    $childN = 0;
    echo "<form name=\"input\" action=\"insert.php\" method=\"post\" >";
}else if ($insertFalse){
    $type = mysqli_real_escape_string($sqli, $_REQUEST['Type']);
    $Veh = mysqli_real_escape_string($sqli, $_REQUEST['Vehicle']);
    $LPN = mysqli_real_escape_string($sqli, $_REQUEST['LPN']);
    $Pro = mysqli_real_escape_string($sqli, $_REQUEST['province']);
    $first_name = mysqli_real_escape_string($sqli, $_REQUEST['first_name']);
    $last_name = mysqli_real_escape_string($sqli, $_REQUEST['last_name']);
    $tel = mysqli_real_escape_string($sqli, $_REQUEST['tel_num']);
    $childN = mysqli_real_escape_string($sqli, $_REQUEST['childN']);
    echo "<script> alert('เลขทะเบียนนี้มีในระบบแล้ว'); </script>
<form name=\"input\" action=\"insert.php\" method=\"post\" >";
}
else if ($insertCorrect){
    $type = mysqli_real_escape_string($sqli, $_REQUEST['Type']);
    $Veh = mysqli_real_escape_string($sqli, $_REQUEST['Vehicle']);
    $LPN = mysqli_real_escape_string($sqli, $_REQUEST['LPN']);
    $Pro = mysqli_real_escape_string($sqli, $_REQUEST['province']);
    $first_name = mysqli_real_escape_string($sqli, $_REQUEST['first_name']);
    $last_name = mysqli_real_escape_string($sqli, $_REQUEST['last_name']);
    $tel = mysqli_real_escape_string($sqli, $_REQUEST['tel_num']);
    $childN = mysqli_real_escape_string($sqli, $_REQUEST['childN']);
    echo "<form name=\"input\" action=\"insertdata.php\" method=\"post\" >";
}

echo "
<script>
    var cDivCount = $childN;
</script>
";
echo "
    <p>
        <label for=\"Type\">ตำแหน่ง:</label>
        <select name=\"Type\" id=\"Type\">
            <option value=\"$type\" selected>$type</option>
            <option value=\"ผู้ปกครอง\" name=\"Parent\">ผู้ปกครอง</option>
            <option value=\"ครู\" name=\"Teacher\">ครู</option>
        </select><br><br>
        <label for=\"Vehicle\">พาหนะ:</label>
        <select name=\"Vehicle\" id=\"Vehicle\">
            <option value=\"$Veh\" selected>$Veh</option>
            <option value=\"รถยนต์\" name=\"Car\">รถยนต์</option>
            <option value=\"รถจักรยานยนต์\" name=\"Motercycle\">รถจักรยานยนต์</option>
        </select><br><br>
        <label for=\"plateNumber\">เลขทะเบียน:</label>
        <input type=\"text\" name=\"LPN\" id=\"plateNumber\" maxlength=\"7\" size=\"7\" oninput=\"inputCheck()\" placeholder=\"*1กข1234\" value=\"$LPN\"><br><br>
        <label for=\"pro\">จังหวัด:</label>
        <select name=\"province\" id=\"pro\" oninput=\"inputCheck()\">
            <option value=\"$Pro\" selected >$Pro</option>
            <option value=\"กรุงเทพมหานคร\">กรุงเทพมหานคร</option>
            <option value=\"กระบี่\">กระบี่ </option>
            <option value=\"กาญจนบุรี\">กาญจนบุรี </option>
            <option value=\"กาฬสินธุ์\">กาฬสินธุ์ </option>
            <option value=\"กำแพงเพชร\">กำแพงเพชร </option>
            <option value=\"ขอนแก่น\">ขอนแก่น</option>
            <option value=\"จันทบุรี\">จันทบุรี</option>
            <option value=\"ฉะเชิงเทรา\">ฉะเชิงเทรา </option>
            <option value=\"ชัยนาท\">ชัยนาท </option>
            <option value=\"ชัยภูมิ\">ชัยภูมิ </option>
            <option value=\"ชุมพร\">ชุมพร </option>
            <option value=\"ชลบุรี\">ชลบุรี </option>
            <option value=\"เชียงใหม่\">เชียงใหม่ </option>
            <option value=\"เชียงราย\">เชียงราย </option>
            <option value=\"ตรัง\">ตรัง </option>
            <option value=\"ตราด\">ตราด </option>
            <option value=\"ตาก\">ตาก </option>
            <option value=\"นครนายก\">นครนายก </option>
            <option value=\"นครปฐม\">นครปฐม </option>
            <option value=\"นครพนม\">นครพนม </option>
            <option value=\"นครราชสีมา\">นครราชสีมา </option>
            <option value=\"นครศรีธรรมราช\">นครศรีธรรมราช </option>
            <option value=\"นครสวรรค์\">นครสวรรค์ </option>
            <option value=\"นราธิวาส\">นราธิวาส </option>
            <option value=\"น่าน\">น่าน </option>
            <option value=\"นนทบุรี\">นนทบุรี </option>
            <option value=\"บึงกาฬ\">บึงกาฬ</option>
            <option value=\"บุรีรัมย์\">บุรีรัมย์</option>
            <option value=\"ประจวบคีรีขันธ์\">ประจวบคีรีขันธ์ </option>
            <option value=\"ปทุมธานี\">ปทุมธานี </option>
            <option value=\"ปราจีนบุรี\">ปราจีนบุรี </option>
            <option value=\"ปัตตานี\">ปัตตานี </option>
            <option value=\"พะเยา\">พะเยา </option>
            <option value=\"พระนครศรีอยุธยา\">พระนครศรีอยุธยา </option>
            <option value=\"พังงา\">พังงา </option>
            <option value=\"พิจิตร\">พิจิตร </option>
            <option value=\"พิษณุโลก\">พิษณุโลก </option>
            <option value=\"เพชรบุรี\">เพชรบุรี </option>
            <option value=\"เพชรบูรณ์\">เพชรบูรณ์ </option>
            <option value=\"แพร่\">แพร่ </option>
            <option value=\"พัทลุง\">พัทลุง </option>
            <option value=\"ภูเก็ต\">ภูเก็ต </option>
            <option value=\"มหาสารคาม\">มหาสารคาม </option>
            <option value=\"มุกดาหาร\">มุกดาหาร </option>
            <option value=\"แม่อ่องสอน\">แม่อ่องสอน </option>
            <option value=\"ยโสธร\">ยโสธร </option>
            <option value=\"ยะลา\">ยะลา </option>
            <option value=\"ร้อยเอ็ด\">ร้อยเอ็ด </option>
            <option value=\"ระนอง\">ระนอง </option>
            <option value=\"ระยอง\">ระยอง </option>
            <option value=\"ราชบุรี\">ราชบุรี</option>
            <option value=\"ลพบุรี\">ลพบุรี </option>
            <option value=\"ลำปาง\">ลำปาง </option>
            <option value=\"ลำพูน\">ลำพูน </option>
            <option value=\"เลย\">เลย </option>
            <option value=\"ศรีสะเกษ\">ศรีสะเกษ</option>
            <option value=\"สกลนคร\">สกลนคร</option>
            <option value=\"สงขลา\">สงขลา </option>
            <option value=\"สมุทรสาคร\">สมุทรสาคร </option>
            <option value=\"สมุทรปราการ\">สมุทรปราการ </option>
            <option value=\"สมุทรสงคราม\">สมุทรสงคราม </option>
            <option value=\"สระแก้ว\">สระแก้ว </option>
            <option value=\"สระบุรี\">สระบุรี </option>
            <option value=\"สิงห์บุรี\">สิงห์บุรี </option>
            <option value=\"สุโขทัย\">สุโขทัย </option>
            <option value=\"สุพรรณบุรี\">สุพรรณบุรี </option>
            <option value=\"สุราษฎร์ธานี\">สุราษฎร์ธานี </option>
            <option value=\"สุรินทร์\">สุรินทร์ </option>
            <option value=\"สตูล\">สตูล </option>
            <option value=\"หนองคาย\">หนองคาย </option>
            <option value=\"หนองบัวลำภู\">หนองบัวลำภู </option>
            <option value=\"อำนาจเจริญ\">อำนาจเจริญ </option>
            <option value=\"อุดรธานี\">อุดรธานี </option>
            <option value=\"อุตรดิตถ์\">อุตรดิตถ์ </option>
            <option value=\"อุทัยธานี\">อุทัยธานี </option>
            <option value=\"อุบลราชธานี\">อุบลราชธานี</option>
            <option value=\"อ่างทอง\">อ่างทอง </option>
        </select><br><br>
        <label for=\"firstName\">ชื่อ:</label>
        <input type=\"text\" name=\"first_name\" id=\"firstName\" oninput=\"inputCheck()\" placeholder=\"*\" value=\"$first_name\" ><br><br>
        <label for=\"lastName\">นามสกุล:</label>
        <input type=\"text\" name=\"last_name\" id=\"lastName\" oninput=\"inputCheck()\" placeholder=\"*\" value=\"$last_name\"><br><br>
        <label for=\"telephoneNumber\">หมายเลขโทรศัพท์:</label>
        <input type=\"number\" name=\"tel_num\" id=\"telephoneNumber\"  value=\"$tel\" minlength=\"10\" maxlength=\"10\" size=\"10\" oninput=\"inputCheck()\" placeholder=\"*0123456789\"><br><br>
    </p>
    <div class='childInput'>
        <input type=\"hidden\" value=\"$childN\"name=\"childN\" id=\"childN\">
        <label for=\"st\">จำนวน นร</label>
        <input type=\"number\" name=\"st\" id=\"st\" oninput=\"createChildInput()\" value='$childN'>
        ";
        for ($i=1;$i<=$childN;$i++){
        $cDN ="st$i";
        $cDC ="childDiv$i";
        $cCN ="Class$i";
        $cFN ="st_first_name$i";
        $cLN ="st_last_name$i";
        $class = mysqli_real_escape_string($sqli, $_REQUEST[$cCN]);
        $st_first_name = mysqli_real_escape_string($sqli, $_REQUEST[$cFN]);
        $st_last_name = mysqli_real_escape_string($sqli, $_REQUEST[$cLN]);
        echo "<div name=\"$cDN\" class=\"$cDC\">
            <p>
                <label for=\"Class\"> ชั้น:</label>
                <select name=\"$cCN\">
                    <option value=\"$class\" selected=\"$class\">$class</option>
                    <option value=\"อ.1\">อ.1</option>
                    <option value=\"อ.2\">อ.2</option>
                    <option value=\"อ.3\">อ.3</option>
                    <option value=\"ป.1\">ป.1</option>
                    <option value=\"ป.2\">ป.2</option>
                    <option value=\"ป.3\">ป.3</option>
                    <option value=\"ป.4\">ป.4</option>
                    <option value=\"ป.5\">ป.5</option>
                    <option value=\"ป.6\">ป.6</option>
                    <option value=\"ม.1\">ม.1</option>
                    <option value=\"ม.2\">ม.2</option>
                    <option value=\"ม.3\">ม.3</option>
                    <option value=\"ม.4\">ม.4</option>
                    <option value=\"ม.5\">ม.5</option>
                    <option value=\"ม.6\">ม.6</option>
                </select>
                <label for=\"stFirstName\">ชื่อ นร:</label>
                <input type=\"text\" name=\"$cFN\" value='$st_first_name'>
                <label for=\"stLastName\">นามสกุล นร:</label>
                <input type=\"text\" name=\"$cLN\"  value='$st_last_name'>
            </p></div>
        ";
        }

        echo" </div><br>
    <div class=\"button\">
        <input type=\"submit\" value=\"เพิ่มข้อมูล\" id=\"submit\"  class=\"submit\" disabled>
        <span class=\"buttontext\">กรุณาเติมทุกคำตอบที่มี *</span>
    </div>";
        if ($insertCorrect){
echo" <script>
      document.getElementById(\"submit\").disabled = false;
      document.getElementById('submit').click();
      </script>";

}?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert</title>

    <style>
        @import "style.CSS";

    </style>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>

</form>
<div class="back">
    <form class="back" method="post" action="search.php?Page=0">
        <br>
        <input type="hidden" value="LPN" name="Select">
        <input type="hidden" value=" " name="search">
        <input type="submit" class="back" value="กลับ" >
    </form>
</div>
</body>
<script>
    window.onload = function () {

    };
    var lpnEmp = null;

    function createChildInput(){
        var stN = document.getElementById("st").value;
        document.getElementById("childN").value = stN;
        if(stN <= 0){
            document.getElementById('st').value = 0;
        }else{
            if (stN > cDivCount){
                for (i = cDivCount+1; i<=stN ; i++){
                    var $cDN ="st"+i;
                    var $cDC ="childDiv"+i;
                    var $cCN ="Class"+i;
                    var $cFN ="st_first_name"+i;
                    var $cLN ="st_last_name"+i;
                    $childDiv=$('<div name="' + $cDN + '"class='+ $cDC +'>\n' +
                        '        <label for="Class"> ชั้น:</label>\n' +
                        '        <select name='+ $cCN +'>\n' +
                        '        <option value=" " selected >Select</option>' +
                        '            <option value="อ.1">อ.1</option>\n' +
                        '            <option value="อ.2">อ.2</option>\n' +
                        '            <option value="อ.3">อ.3</option>\n' +
                        '            <option value="ป.1">ป.1</option>\n' +
                        '            <option value="ป.2">ป.2</option>\n' +
                        '            <option value="ป.3">ป.3</option>\n' +
                        '            <option value="ป.4">ป.4</option>\n' +
                        '            <option value="ป.5">ป.5</option>\n' +
                        '            <option value="ป.6">ป.6</option>\n' +
                        '            <option value="ม.1">ม.1</option>\n' +
                        '            <option value="ม.2">ม.2</option>\n' +
                        '            <option value="ม.3">ม.3</option>\n' +
                        '            <option value="ม.4">ม.4</option>\n' +
                        '            <option value="ม.5">ม.5</option>\n' +
                        '            <option value="ม.6">ม.6</option>\n' +
                        '        </select>\n' +
                        '        <label for="stFirstName">ชื่อ นร:</label>\n' +
                        '        <input type="text" name='+ $cFN +'>\n' +
                        '        <label for="stLastName">นามสกุล นร:</label>\n' +
                        '        <input type="text" name='+ $cLN +'>\n' +
                        '    </div>');
                    $(".childInput").append($childDiv);
                    cDivCount++;
                } //adding new div to
            }else if (stN<cDivCount){
                for (i=cDivCount;i>stN;i--){
                    var $cDC =".childDiv"+i;
                    $($cDC).remove();
                    cDivCount--;
                }
            }

        }
    }
    function inputCheck(){

        lpnSplitCheck(lpnEmp);
        var proEmp = document.forms['input']['province'].value;
        var fnEmp = document.forms['input']['first_name'].value.length;
        var lnEmp = document.forms['input']['last_name'].value.length;
        var telEmp = document.forms['input']['tel_num'].value.length;

        console.log(lpnEmp , proEmp , fnEmp , lnEmp ,telEmp);
        if(lpnEmp && proEmp !="" && fnEmp !=0 && fnEmp !=0 && lnEmp !=0 && telEmp ==10){

            document.getElementById("submit").disabled = false ;
        }
        else {
            document.getElementById("submit").disabled = true ;
        }
    }

    function lpnSplitCheck() {
        var VehType = document.getElementById("Vehicle").value;
        if (document.getElementById("Vehicle").value=='รถยนต์'){
        var lpnCheck = document.forms['input']['LPN'].value;
        var lpnSplit = lpnCheck.split("");
        var letters = /[ก-ฮ]/;
        for (i = lpnSplit.length; i < 7; i++) {
            lpnSplit.push(null);
        }
        //if (lpnSplit.length >= 3){}
        console.log(lpnSplit);
        var intA = Number.isInteger(parseInt(lpnSplit[0]));
        var charA =letters.test(lpnSplit[0]);

        var charB =letters.test(lpnSplit[1]);

        var intC = Number.isInteger(parseInt(lpnSplit[2]));
        var charC =letters.test(lpnSplit[2]);


        var intD = Number.isInteger(parseInt(lpnSplit[3]));
        var empD = Boolean(lpnSplit[3]  == null);
        if (intD || empD) {
            var resultD = true;
        }else {
            var resultD = false;
        }

        var intE = Number.isInteger(parseInt(lpnSplit[4]));
        var empE = Boolean(lpnSplit[4] == null);
        if (intE || empE) {
            var resultE = true;
        }else {
            var resultE = false;
        }

        var intF = Number.isInteger(parseInt(lpnSplit[5]));
        var empF = Boolean(lpnSplit[5]== null);
        if (intF || empF) {
            var resultF = true;
        }else {
            var resultF = false;
        }

        var intG = Number.isInteger(parseInt(lpnSplit[6]));
        var empG = Boolean(lpnSplit[6] == null);
        if (intG || empG) {
            var resultG = true;
        }else {
            var resultG = false;
        }

        if (intC) {

            if (charA && charB && intC && resultD && resultE && resultF && empG){
                console.log(charA , charB , intC , resultD , resultE , resultF , empG);
                console.log("YES!");
                lpnEmp = true;
            }else {lpnEmp = false;}

        } else if (charC) {

            if (intA && charB && charC && intD && resultE && resultF && resultG) {
                console.log(intA , charB , charC , intD , resultE , resultF , empG);
                console.log("YES!");
                lpnEmp = true;
            }else { lpnEmp = false;}

        }}
        else if (document.getElementById("Vehicle").value=='รถจักรยานยนต์'){
            var lpnCheck = document.forms['input']['LPN'].value;
            var lpnSplit = lpnCheck.split("");
            var letters = /[ก-ฮ]/;
            for (i = lpnSplit.length; i < 7; i++) {
                lpnSplit.push(null);
            }
            //if (lpnSplit.length >= 3){}
            console.log(lpnSplit);
            var intA = Number.isInteger(parseInt(lpnSplit[0]));
            var charA =letters.test(lpnSplit[0]);
            if (intA || charA) {
                var resultA = true;
            }else {
                var resultA = false;
            }


            var charB =letters.test(lpnSplit[1]);

            var intC = Number.isInteger(parseInt(lpnSplit[2]));
            var charC =letters.test(lpnSplit[2]);


            var intD = Number.isInteger(parseInt(lpnSplit[3]));
            var empD = Boolean(lpnSplit[3]  == null);
            if (intD || empD) {
                var resultD = true;
            }else {
                var resultD = false;
            }

            var intE = Number.isInteger(parseInt(lpnSplit[4]));
            var empE = Boolean(lpnSplit[4] == null);
            if (intE || empE) {
                var resultE = true;
            }else {
                var resultE = false;
            }

            var intF = Number.isInteger(parseInt(lpnSplit[5]));
            var empF = Boolean(lpnSplit[5]== null);
            if (intF || empF) {
                var resultF = true;
            }else {
                var resultF = false;
            }

            var intG = Number.isInteger(parseInt(lpnSplit[6]));
            var empG = Boolean(lpnSplit[6] == null);
            if (intG || empG) {
                var resultG = true;
            }else {
                var resultG = false;
            }

            if (intC) {

                if (charA && charB && intC && resultD && resultE && resultF && empG){
                    console.log(charA , charB , intC , resultD , resultE , resultF , empG);
                    console.log("YES!");
                    lpnEmp = true;
                }else {lpnEmp = false;}

            } else if (charC) {

                if (resultA && charB && charC && intD && resultE && resultF && resultG) {
                    console.log(resultA , charB , charC , intD , resultE , resultF , resultG);
                    console.log("YES!");
                    lpnEmp = true;
                }else { lpnEmp = false;}

            }}
        console.log(VehType);
    }
</script>
</html>




