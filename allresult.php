<!-- This program is written by Pada Cherdchoothai,2019 -->
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
<div id="DelConfimrBox" class="DelConfirm">
    <div class="DelConfirm-content">
        <h1>ต้องการจะลบข้อมูลหรือไม่?</h1>
        <input type="button" value="ตกลง" id="deleteConfirm" class="DELBUTTON" onclick="CLICK()">
        <br>
        <br>
        <input type="button" value="ยกเลิก" id="deleteCancle" class="DELCANCLE" onclick=CLICK()>
    </div>
</div>
<script>

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

</body>
</html>
<?php
include 'Config.php';

$Page = $ID = $_GET["Page"];
$Limit = 10; //Number of record per page
$PageL = $Page * $Limit;


$result = mysqli_query($sqli, "SELECT * FROM $CarOwner LIMIT $Limit OFFSET $PageL");
echo "<table>                                                                                                                                                                                
      <tr><th><b>พาหนะ</th><th><b>เลขทะเบียน</th><th><b>จังหวัด</th><th><b>ตำแหน่ง</th><th><b>ชื่อ</th><th><b>นามสกุล</th><th><b>หมายเลขโทรศัพท์</th><th><b>รายละเอียด</th></tr>";
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {
        $ID = $row['ID'];
        echo "<tr><td>" . $row['Vehicle'] . "</td><td>" . $row['LPN'] . "</td><td>" . $row['Province'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['FirstName'] . "</td><td>" .
            $row['Surname'] . "</td><td>" . $row['TEL'] . "</td><td>" .
            "<input type=\"button\" class='TableButton' value=\"รายละเอียด\" onclick=\"window.location.href='detail.php?ID=$ID'\">" . "</td></tr>";
        echo "<br>";
    }
}
echo "</table>";
$sqli->close();

$PageN = $Page + 1;
$PageB = $Page - 1;


echo "<div class=\"page\">
<form class=\"return \" method=\"GET\" action=\"allresult.php?Page=$Page\">
    <br>
        <input type=\"hidden\" value=\"$PageB\"name=\"Page\"></input>
        <input type=\"submit\" class=\"return\" id=\"return\" value=\" <<< \" >
</form>

<form class=\"next\" method=\"GET\" action=\"allresult.php?Page=$Page\">
    <br>
        <input type=\"number\" value=\"$Page\" class=\"PageG\" id='page' name=\"Page\" oninput='updatePage()'>
    <br>
        <input type=\"submit\" class=\"Page\" value=\"เปลี่ยนหน้า\" >
</form>

<form class=\"next\" method=\"GET\" action=\"allresult.php?Page=$Page\">
    <br>
        <input type=\"hidden\" value=\"$PageN\"name=\"Page\"></input>
        <input type=\"submit\" class=\"next\" value=\" >>> \" >
</form>

</div>";
echo "<script>
    if ($Page==0) {
        document.getElementById(\"return\").disabled = true;
    }
     function updatePage() {
        var page = document.getElementById('page').value;
        if (page <= 0){
            document.getElementById('page').value = 0;
        } 
        console.log(page);
    }
</script>";


echo "<div class=\"back\">
    <form class=\"back\" method=\"post\" action=\"search.php?Page=0\">
    <br>
        <input type=\"hidden\" value=\" \" name=\"Select\"></input>
        <input type=\"hidden\" value=\" \"name=\"search\"></input>
        <input type=\"submit\" class=\"back\" value=\"กลับ\" >
    </form>
</div>";
?>
