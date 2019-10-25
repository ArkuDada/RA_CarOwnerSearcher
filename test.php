<?php
include 'Config.php';

$ID=$_GET["ID"];
$result = mysqli_query($sqli,"SELECT * from CarOwner2 WHERE ID LIKE '34'");
if (mysqli_num_rows($result) > 0){
    echo "<table>                                                                                                                                                                                
      <tr><th><b>เลขทะเบียน</th><th><b>จังหวัด</th><th><b>ตำแหน่ง</th><th><b>ชื่อ</th><th><b>นามสกุล</th><th><b>หมายเลขโทรศัพท์</th><th><b>แก้ไข</th><th><b>ลบ</th></tr>";
    while ($row = mysqli_fetch_array($result)) {
        $ID=$row['ID'];
        echo "<tr><td>".$row['LPN'] . "</td><td>" . $row['Province'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['FirstName'] . "</td><td>" .
            $row['Surname'] . "</td><td>" . $row['TEL'] .  "</td><td>".
            "<input type=\"button\" class='TableButton' value=\"แก้ไข\" onclick=\"window.location.href='edit.php?ID=$ID'\">"."</td><td>".
            "<input type=\"button\" class='TableButton' value=\"ลบ\" id=\"$ID\" onclick=\"DelConfirm(this.id)\">"."</td></tr>";
        echo "<br>";
    }
    echo "</table>";
}

$result = mysqli_query($sqli,"SELECT * from ChildOwner WHERE OwnerID LIKE '34'");
if (mysqli_num_rows($result) > 0){
    echo "<table><tr><th><b>ชั้น</th><th><b>ชื่อ นร.</th><th><b>นามสกุล นร.</th></tr>";
$autoID=1;
    while ($row = mysqli_fetch_array($result)) {
        $ID=$row['ID'];
//        echo $row['ChildID']." ".$autoID;
        $cDN ="st$autoID";
        $cDC ="childDiv$autoID";
        $cCN ="Class$autoID";
        $cFN ="st_first_name$autoID";
        $cLN ="st_last_name$autoID";
        $class = $row['Grade'];
        $st_first_name = $row['ChildName'];
        $st_last_name =$row['ChildSurname'];
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
        $autoID++;
//        $repeat = count($row)/5;
//        for ($i=1;$i<=$repeat;$i++){
//        echo "<tr><td>". $row['Grade'] . "</td><td>" . $row['ChildName'] . "</td><td>" . $row['ChildSurname']."</td></tr>"."<br>";
//        echo $i;
//        echo "yeet<br><br>";
//        }
    }
//    echo "</table>";
}
echo "
<br>
<div class=\"back\">
    <form class=\"back\" method=\"post\" action=\"search.php?Page=0\">
        <input type=\"hidden\" value=\"LPN\" name=\"Select\"></input>
        <input type=\"hidden\" value=\" \"name=\"search\"></input>
        <input type=\"submit\" class=\"back\" value=\"กลับ\" >
    </form>
</div>";

$sqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CarOwnerSearch</title>
    <style>
        @import "style.CSS";
    </style>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
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
<SCRIPT>
    var delBut = document.getElementById("deleteConfirm");
    var modal = document.getElementById("DelConfimrBox");
    modal.style.display= "none";
    function DelConfirm(DelID) {
        modal.style.display= "block";
        var link = "window.location.href='delete.php?ID="+DelID+"'";
        $(delBut).attr('onclick',link);
        console.log(delBut, link , delBut.onclick);
    }

    function CLICK() {
        modal.style.display= 'none';
    }
</SCRIPT>
</html>

