<!-- This program is written by Pada Cherdchoothai,2019 -->
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
<?php
include 'Config.php';

$ID=$_GET["ID"];
$result = mysqli_query($sqli,"SELECT * from $CarOwner WHERE ID LIKE '$ID'");
if (mysqli_num_rows($result) > 0){
    echo "<table>                                                                                                                                                                                
      <tr><th><b>พาหนะ</th><th><b>เลขทะเบียน</th><th><b>จังหวัด</th><th><b>ตำแหน่ง</th><th><b>ชื่อ</th><th><b>นามสกุล</th><th><b>หมายเลขโทรศัพท์</th><th><b>แก้ไข</th><th><b>ลบ</th></tr>";
    while ($row = mysqli_fetch_array($result)) {
        $ID=$row['ID'];
        echo "<tr><td>".$row['Vehicle'] ."</td><td>".$row['LPN'] . "</td><td>" . $row['Province'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['FirstName'] . "</td><td>" .
            $row['Surname'] . "</td><td>" . $row['TEL'] .  "</td><td>".
            "<input type=\"button\" class='TableButton' value=\"แก้ไข\" onclick=\"window.location.href='edit.php?ID=$ID'\">"."</td><td>".
            "<input type=\"button\" class='TableButton' value=\"ลบ\" id=\"$ID\" onclick=\"DelConfirm(this.id)\">"."</td></tr>";
        echo "<br>";
    }
    echo "</table>";
}

$result = mysqli_query($sqli,"SELECT * from $ChildOwner WHERE OwnerID LIKE '$ID'");
if (mysqli_num_rows($result) > 0){
    echo "<table><tr><th><b>ชั้น</th><th><b>ชื่อ นร.</th><th><b>นามสกุล นร.</th></tr>";
    while ($row = mysqli_fetch_array($result)) {
        $ID=$row['ID'];
        echo "<tr><td>". $row['Grade'] . "</td><td>" . $row['ChildName'] . "</td><td>" . $row['ChildSurname']."</td></tr>";
        echo "<br>";
    }
    echo "</table>";
}
echo "
<br>
<div class=\"back\">
    <form class=\"back\" method=\"post\" action=\"search.php?Page=0\">
        <input type=\"hidden\" value=\" \" name=\"Select\"></input>
        <input type=\"hidden\" value=\" \"name=\"search\"></input>
        <input type=\"submit\" class=\"back\" value=\"กลับ\" >
    </form>
</div>";

$sqli->close();
?>