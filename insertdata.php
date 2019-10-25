<!-- This program is written by Pada Cherdchoothai,2019 -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Temp </title>
</head>
<body>
<form name="EventConfirmRedirection" method="post" action="search.php?Page=0">
    <input type="hidden" value="LPN" name="Select"></input>
    <input type="hidden" value=" " name="search"></input>
    <input type="submit" value="Start">
</form>
</body>
<script type="text/javascript">
    window.onload = function () {
        console.log('before');
        setTimeout(function () {
            console.log('after');
        }, 2000);
        document.forms["EventConfirmRedirection"].submit();
    }
</script>
</html>
<?php
include 'Config.php';

// Escape user inputs for security
$type = mysqli_real_escape_string($sqli, $_REQUEST['Type']);
$Veh = mysqli_real_escape_string($sqli, $_REQUEST['Vehicle']);
$LPN = mysqli_real_escape_string($sqli, $_REQUEST['LPN']);
$Pro = mysqli_real_escape_string($sqli, $_REQUEST['province']);
$first_name = mysqli_real_escape_string($sqli, $_REQUEST['first_name']);
$last_name = mysqli_real_escape_string($sqli, $_REQUEST['last_name']);
$tel = mysqli_real_escape_string($sqli, $_REQUEST['tel_num']);
$stN = mysqli_real_escape_string($sqli, $_REQUEST['childN']);

// Attempt insert query execution
$insert = "INSERT INTO $CarOwner (LPN,Vehicle,Province,Type,FirstName,Surname,TEL) VALUES ('$LPN','$Veh','$Pro','$type','$first_name', '$last_name', '$tel')";
if (mysqli_query($sqli, $insert)) {
    $id = mysqli_insert_id($sqli);
    echo "insertion complete with id " . $id;
    for ($i = 1; $i <= $stN; $i++) {
        echo "insert child" . $i;
        $cCN = "Class$i";
        $cFN = "st_first_name$i";
        $cLN = "st_last_name$i";
        $class = mysqli_real_escape_string($sqli, $_REQUEST[$cCN]);
        $st_first_name = mysqli_real_escape_string($sqli, $_REQUEST[$cFN]);
        $st_last_name = mysqli_real_escape_string($sqli, $_REQUEST[$cLN]);
        $insert_child = "INSERT INTO $ChildOwner (OwnerID,Grade,ChildName,ChildSurname) VALUES ('$id','$class','$st_first_name','$st_last_name')";
        if (mysqli_query($sqli, $insert_child)) {
            echo "<br>child" . $i . "inserted";
        } else {
            echo mysqli_error($sqli);
        }
    }
} else {
    echo "ERROR: Could not able to execute $insert. " . mysqli_error($sqli);
}
header('refresh: 2; url=/M6_project_CarOwner2');
exit(0);
mysqli_close($sqli);
?>