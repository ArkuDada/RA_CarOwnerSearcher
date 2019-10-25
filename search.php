<!-- This program is written by Pada Cherdchoothai,2019 -->
<?php
include 'Config.php';
$Sel = mysqli_real_escape_string($sqli, $_REQUEST['Select']);
$Sea = mysqli_real_escape_string($sqli, $_REQUEST['search']);
echo "
<div>
<input type=\"hidden\" value=\"$Sel\" id= 'KeepSelectValue'></input>
<input type=\"hidden\" value=\"$Sea\"id='KeepSearchValue'></input>
</div>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CarOwnerSearch</title>
    <style>
        @import "style.CSS";

        input, select {
            border-radius: 20px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
<div>
    <form name="EventConfirmRedirection" method="post" class='refresh' name='refresh' action="search.php?Page=0">
        <input type="hidden" value="" name="Select">
        <input type="hidden" value="" name="search">
        <input type="submit" class='refresh' name='refresh' value="รีโหลด">
    </form>
    <br>
    <form action="insert.php" method="post">
        <input type="hidden" value="" name="LPN"></input>
        <input type="hidden" value=" " name="province">
        <input type="submit" value="เพิ่มข้อมูล" class="insert">
    </form>
    <br>
    <form action="search.php?Page=0" class="search" method="post">
        <!--    create scearch form-->
        <p>
            <label for="Select" class="search"> Search:</label>
            <select name="Select" id="Select" class="search" oninput="optionChange()">
                <option value=" " selected>....</option>
                <option value="LPN">ทะเบียน</option>
                <option value="Vehicle">พาหนะ</option>
                <option value="Province">จังหวัด</option>
                <option value="Type">ประเภท</option>
                <option value="FirstName">ชื่อ ผปค</option>
                <option value="Surname">นามสกุล ผปค</option>
                <option value="TEL">Telephone</option>
                <option value="Grade">ระดับชั้น</option>
                <option value="ChildName">ชื่อ นร</option>
                <option value="ChildSurname">นามสกุล นร</option>
            </select>
            <br>
            <br>
            <input type="text" name="search" id="search" class="searchInput" oninput="inputCheck()" value="">
            <br>
            <br>
            <input type="submit" id="submit" class="searchButton" value="ค้นหา"></p>
    </form>
</div>
<div id="DelConfimrBox" class="DelConfirm">
    <div class="DelConfirm-content">
        <h1>ต้องการจะลบข้อมูลหรือไม่?</h1>
        <input type="button" value="ตกลง" id="deleteConfirm" class="DELBUTTON" onclick="CLICK()">
        <br>
        <br>
        <input type="button" value="ยกเลิก" id="deleteCancle" class="DELCANCLE" onclick=CLICK()>
    </div>
</div>
</body>
<script>
    src = "M6_project_CarOwner2/script.js";
    var sel = document.getElementById('Select');
    var KeepSelectValue = document.getElementById('KeepSelectValue').value;
    var KeepSearchValue = document.getElementById('KeepSearchValue').value;
    console.log(KeepSelectValue, KeepSearchValue);
    window.onload = function keepSearchValue() {
        var opts = sel.options;
        for (var opt, j = 0; opt = opts[j]; j++) {
            if (opt.value == KeepSelectValue) {
                sel.selectedIndex = j;
                optionChange();
                document.getElementById('search').value = KeepSearchValue;
                break;
            }
        }
    }

    function reload() {
        document.forms["EventConfirmRedirection"].submit();
    }

    function optionChange() {
        if (sel.value === "LPN") {
            $("#search").replaceWith('<input type="text" name="search" id="search" class="searchInput" value=""  oninput="inputCheck()">');
        }
        else if (sel.value == "Province") {
            $("#search").replaceWith('<select name="search" id="search" class="searchInput" oninput="inputCheck()">' + '<option value="" selected>Select</option>' +
                '<option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>' +
                '<option value="กระบี่">กระบี่ </option>' +
                '<option value="กาญจนบุรี">กาญจนบุรี </option>' +
                '<option value="กาฬสินธุ์">กาฬสินธุ์ </option>' +
                '<option value="กำแพงเพชร">กำแพงเพชร </option>' +
                '<option value="ขอนแก่น">ขอนแก่น</option>' +
                '<option value="จันทบุรี">จันทบุรี</option>' +
                '<option value="ฉะเชิงเทรา">ฉะเชิงเทรา </option>' +
                '<option value="ชัยนาท">ชัยนาท </option>' +
                '<option value="ชัยภูมิ">ชัยภูมิ </option>' +
                '<option value="ชุมพร">ชุมพร </option>' +
                '<option value="ชลบุรี">ชลบุรี </option>' +
                '<option value="เชียงใหม่">เชียงใหม่ </option>' +
                '<option value="เชียงราย">เชียงราย </option>' +
                '<option value="ตรัง">ตรัง </option>' +
                '<option value="ตราด">ตราด </option>' +
                '<option value="ตาก">ตาก </option>' +
                '<option value="นครนายก">นครนายก </option>' +
                '<option value="นครปฐม">นครปฐม </option>' +
                '<option value="นครพนม">นครพนม </option>' +
                '<option value="นครราชสีมา">นครราชสีมา </option>' +
                '<option value="นครศรีธรรมราช">นครศรีธรรมราช </option>' +
                '<option value="นครสวรรค์">นครสวรรค์ </option>' +
                '<option value="นราธิวาส">นราธิวาส </option>' +
                '<option value="น่าน">น่าน </option>' +
                '<option value="นนทบุรี">นนทบุรี </option>' +
                '<option value="บึงกาฬ">บึงกาฬ</option>' +
                '<option value="บุรีรัมย์">บุรีรัมย์</option>' +
                '<option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์ </option>' +
                '<option value="ปทุมธานี">ปทุมธานี </option>' +
                '<option value="ปราจีนบุรี">ปราจีนบุรี </option>' +
                '<option value="ปัตตานี">ปัตตานี </option>' +
                '<option value="พะเยา">พะเยา </option>' +
                '<option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา </option>' +
                '<option value="พังงา">พังงา </option>' +
                '<option value="พิจิตร">พิจิตร </option>' +
                '<option value="พิษณุโลก">พิษณุโลก </option>' +
                '<option value="เพชรบุรี">เพชรบุรี </option>' +
                '<option value="เพชรบูรณ์">เพชรบูรณ์ </option>' +
                '<option value="แพร่">แพร่ </option>' +
                '<option value="พัทลุง">พัทลุง </option>' +
                '<option value="ภูเก็ต">ภูเก็ต </option>' +
                '<option value="มหาสารคาม">มหาสารคาม </option>' +
                '<option value="มุกดาหาร">มุกดาหาร </option>' +
                '<option value="แม่ฮ่องสอน">แม่ฮ่องสอน </option>' +
                '<option value="ยโสธร">ยโสธร </option>' +
                '<option value="ยะลา">ยะลา </option>' +
                '<option value="ร้อยเอ็ด">ร้อยเอ็ด </option>' +
                '<option value="ระนอง">ระนอง </option>' +
                '<option value="ระยอง">ระยอง </option>' +
                '<option value="ราชบุรี">ราชบุรี</option>' +
                '<option value="ลพบุรี">ลพบุรี </option>' +
                '<option value="ลำปาง">ลำปาง </option>' +
                '<option value="ลำพูน">ลำพูน </option>' +
                '<option value="เลย">เลย </option>' +
                '<option value="ศรีสะเกษ">ศรีสะเกษ</option>' +
                '<option value="สกลนคร">สกลนคร</option>' +
                '<option value="สงขลา">สงขลา </option>' +
                '<option value="สมุทรสาคร">สมุทรสาคร </option>' +
                '<option value="สมุทรปราการ">สมุทรปราการ </option>' +
                '<option value="สมุทรสงคราม">สมุทรสงคราม </option>' +
                '<option value="สระแก้ว">สระแก้ว </option>' +
                '<option value="สระบุรี">สระบุรี </option>' +
                '<option value="สิงห์บุรี">สิงห์บุรี </option>' +
                '<option value="สุโขทัย">สุโขทัย </option>' +
                '<option value="สุพรรณบุรี">สุพรรณบุรี </option>' +
                '<option value="สุราษฎร์ธานี">สุราษฎร์ธานี </option>' +
                '<option value="สุรินทร์">สุรินทร์ </option>' +
                '<option value="สตูล">สตูล </option>' +
                '<option value="หนองคาย">หนองคาย </option>' +
                '<option value="หนองบัวลำภู">หนองบัวลำภู </option>' +
                '<option value="อำนาจเจริญ">อำนาจเจริญ </option>' +
                '<option value="อุดรธานี">อุดรธานี </option>' +
                '<option value="อุตรดิตถ์">อุตรดิตถ์ </option>' +
                '<option value="อุทัยธานี">อุทัยธานี </option>' +
                '<option value="อุบลราชธานี">อุบลราชธานี</option>' +
                '<option value="อ่างทอง">อ่างทอง </option>' +
                '</select>');
        }
        else if (sel.value == "Vehicle") {
            $("#search").replaceWith('<select name="search" id="search" class="searchInput"  oninput="inputCheck()">\n' +
                '           <option value="" selected >...</option> ' +
                '            <option value="รถยนต์" name="Car">รถยนต์</option>\n' +
                '            <option value="รถจักรยานยนต์" name="Bike">รถจักรยานยนต์</option>');
        }
        else if (sel.value == "Type") {
            $("#search").replaceWith('<select name="search" id="search" class="searchInput" oninput="inputCheck()">\n' +
                '           <option value="" selected >...</option> ' +
                '            <option value="ผู้ปกครอง" name="Parent">ผู้ปกครอง</option>\n' +
                '            <option value="ครู" name="Teacher">ครู</option>');
        }
        else if (sel.value == "FirstName") {
            $("#search").replaceWith('<input type="text" name="search" id="search" class="searchInput" value="" oninput="inputCheck()">');
        }
        else if (sel.value == "Surname") {
            $("#search").replaceWith('<input type="text" name="search" id="search" class="searchInput" value="" oninput="inputCheck()">');
        }
        else if (sel.value == "TEL") {
            $("#search").replaceWith('<input type="text" name="search" id="search" class="searchInput" value="" oninput="inputCheck()">');
        }
        else if (sel.value == "Grade") {
            $("#search").replaceWith('<select name="search" id="search" class="searchInput" oninput="inputCheck()"">\n' +
                '           <option value="" selected >...</option> ' +
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
                '        </select>');
        }
        else if (sel.value == "ChildName") {
            $("#search").replaceWith('<input type="text" name="search" id="search" class="searchInput" value="" oninput="inputCheck()">');
        }
        else if (sel.value == "ChildSurname") {
            $("#search").replaceWith('<input type="text" name="search" id="search" class="searchInput" value="" oninput="inputCheck()">');
        }
        //change input type from select

        document.getElementById("submit").disabled = true;
        //disable submit button for safety
    }


    function inputCheck() {
        var inputEmp = document.getElementById('search').value;
        var inputLength = document.getElementById('search').value.length;
        console.log(inputEmp, inputLength);
        if (inputEmp != 0 || inputLength != " ") {
            document.getElementById("submit").disabled = false;
        } else {
            document.getElementById("submit").disabled = true;
        }
    } //check if input is not empty


    var delBut = document.getElementById("deleteConfirm");
    var modal = document.getElementById("DelConfimrBox");
    modal.style.display = "none";

    function DelConfirm(DelID) {
        modal.style.display = "block";
        var link = "window.location.href='delete.php?ID=" + DelID + "'";
        $(delBut).attr('onclick', link);
        console.log(delBut, link, delBut.onclick);
    }

    function CLICK() {
        modal.style.display = 'none';
    }

</script>
</html>
<?php
$Page = $_GET["Page"];
$Limit = 5; //Number of record per page
$PageL = $Page * $Limit;
if ($Sel === 'Grade') {
    $TableSel = $ChildOwner;
} else if ($Sel === 'ChildName') {
    $TableSel = $ChildOwner;
} else if ($Sel === 'ChildSurname') {
    $TableSel = $ChildOwner;
} else {
    $TableSel = $CarOwner;
}
echo "<table><tr><th><b>พาหนะ</th><th><b>เลขทะเบียน</th><th><b>จังหวัด</th><th><b>ตำแหน่ง</th><th><b>ชื่อ</th><th><b>นามสกุล</th><th><b>หมายเลขโทรศัพท์</th><th><b>รายละเอียด</th></tr>";
if ($TableSel == $ChildOwner) {
    $selectOwner = mysqli_query($sqli, "SELECT * FROM $ChildOwner WHERE $Sel LIKE '%{$Sea}%' ");
    while ($LinkID = mysqli_fetch_array($selectOwner)) {
        $OwnerID = $LinkID['OwnerID'];
        $result = mysqli_query($sqli, "SELECT * FROM $CarOwner WHERE ID LIKE $OwnerID LIMIT $Limit OFFSET $PageL");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $ID = $row['ID'];
                echo "<tr><td>" . $row['Vehicle'] . "</td><td>" . $row['LPN'] . "</td><td>" . $row['Province'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['FirstName'] . "</td><td>" .
                    $row['Surname'] . "</td><td>" . $row['TEL'] . "</td><td>" .
                    "<input type=\"button\" class='TableButton' value=\"รายละเอียด\" onclick=\"window.location.href='detail.php?ID=$ID'\">" . "</td></tr>";
                echo "<br>";
            }
        }
    }
} else if ($TableSel == $CarOwner) {
    $result = mysqli_query($sqli, "SELECT * FROM $CarOwner WHERE $Sel LIKE '%{$Sea}%' LIMIT $Limit OFFSET $PageL");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $ID = $row['ID'];
            echo "<tr><td>" . $row['Vehicle'] . "</td><td>" . $row['LPN'] . "</td><td>" . $row['Province'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['FirstName'] . "</td><td>" .
                $row['Surname'] . "</td><td>" . $row['TEL'] . "</td><td>" .
                "<input type=\"button\" class='TableButton' value=\"รายละเอียด\" onclick=\"window.location.href='detail.php?ID=$ID'\">" . "</td></tr>";
            echo "<br>";
        }
    }
}
echo "</table>";
$sqli->close();
$PageN = $Page + 1;
$PageB = $Page - 1;

echo "<div class=\"page\">

<form class=\"return \" method=\"post\" action=\"search.php?Page=$PageB\">
    <br>
        <input type=\"hidden\" value=\"$Sel\" name=\"Select\">
        <input type=\"hidden\" value=\"$Sea\"name=\"search\">
        <input type=\"hidden\" value=\"$PageB\"name=\"Page\">
        <input type=\"submit\" class=\"return \" id='return' value=\" <<< \" >
</form>
<form class=\"next\" method=\"post\" id='PageG' action=\"search.php?Page=$Page\">
    <br>
        <input type=\"number\" value=\"$Page\" class=\"PageG\" id='page' name=\"Page\" onclick='this.select();' oninput='updatePage()'>
        <input type=\"hidden\" value=\"$Sel\" name=\"Select\">
        <input type=\"hidden\" value=\"$Sea\"name=\"search\">
    <br>
        <input type=\"submit\" class=\"Page\" value=\"เปลี่ยนหน้า\" >
</form>
<form class=\"next\" method=\"post\" action=\"search.php?Page=$PageN\">
    <br>
        <input type=\"hidden\" value=\"$Sel\" name=\"Select\">
        <input type=\"hidden\" value=\"$Sea\"name=\"search\">
        <input type=\"hidden\" value=\"$PageN\"name=\"Page\">
        <input type=\"submit\" class=\"next\" value=\" >>> \" >
</form>


</div>";
echo "<script>

    if ($Page==0) {
        document.getElementById(\"return\").disabled = true;
    }
    
    function focusText() {
        this.focus()  
    }
    
    function updatePage() {
        var page = document.getElementById('page').value;
        if (page <= 0){
            document.getElementById('page').value = 0;
        } 
        console.log(page);
        document.getElementById('PageG').action = 'search.php?Page='+page;
    }
 
</script>";
echo "<div class=\"back\">
    <form class=\"back\" method=\"GET\" action=\"allresult.php?Page=0\">
    <br>
        <input type='hidden' name='Page' value='0'>
        <input type=\"submit\" class=\"back\" value=\"แสดงข้อมูลทั้งหมด\" >
    </form>
</div>";
?>
