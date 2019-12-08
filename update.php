<!-- This program is written by Pada Cherdchoothai,2019 -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Temp </title>
</head>
<body>
<form name="EventConfirmRedirection" method="post" action="search.php?Page=0">
    <input type="hidden" value="LPN" name="Select"></input>
    <input type="hidden" value=" "name="search"></input>
    <input type="submit" value="Start" >
</form>
</body>
<script type="text/javascript">
    window.onload = function() {
        console.log('before');
        setTimeout(function(){
            console.log('after');
        },2000);
        document.forms["EventConfirmRedirection"].submit();
    }
</script>
</html>
<?php
include 'Config.php';


$ID = $_POST["ID"];
$type = mysqli_real_escape_string($sqli, $_REQUEST['Type']);
$LPN = mysqli_real_escape_string($sqli, $_REQUEST['LPN']);
$Pro = mysqli_real_escape_string($sqli, $_REQUEST['province']);
$first_name = mysqli_real_escape_string($sqli, $_REQUEST['first_name']);
$last_name = mysqli_real_escape_string($sqli, $_REQUEST['last_name']);
$tel = mysqli_real_escape_string($sqli, $_REQUEST['tel_num']);
$stN = mysqli_real_escape_string($sqli, $_REQUEST['childN']);

$allChild = mysqli_query($sqli, "SELECT * from $ChildOwner WHERE OwnerID LIKE '$ID'");
$childN = mysqli_num_rows($allChild);

// Escape user inputs for security

$update = "UPDATE $CarOwner SET LPN = '$LPN' ,Province = '$Pro' ,Type = '$type' ,FirstName = '$first_name' ,Surname = '$last_name' ,TEL = '$tel' WHERE id='$ID'";
if(mysqli_query($sqli, $update)){
    echo "Records updated successfully.";
    if ($stN>=$childN){

        for ($i=1;$i<=$childN;$i++){
            echo "update child".$i;
            $cID ="childID$i";
            $cCN ="Class$i";
            $cFN ="st_first_name$i";
            $cLN ="st_last_name$i";
            $childID = mysqli_real_escape_string($sqli, $_REQUEST[$cID]);
            $class = mysqli_real_escape_string($sqli, $_REQUEST[$cCN]);
            $st_first_name = mysqli_real_escape_string($sqli, $_REQUEST[$cFN]);
            $st_last_name = mysqli_real_escape_string($sqli, $_REQUEST[$cLN]);
            $update_child ="UPDATE $ChildOwner SET Grade = '$class',ChildName = '$st_first_name' ,ChildSurname = '$st_last_name'WHERE childID = '$childID'";
            if (mysqli_query($sqli, $update_child)){
                echo "<br>child".$i ."updated";
            }else{echo mysqli_error($sqli);}
        }
        for ($i = $childN+1; $i <= $stN; $i++) {
            echo "insert child" . $i;
            $cCN = "Class$i";
            $cFN = "st_first_name$i";
            $cLN = "st_last_name$i";
            $class = mysqli_real_escape_string($sqli, $_REQUEST[$cCN]);
            $st_first_name = mysqli_real_escape_string($sqli, $_REQUEST[$cFN]);
            $st_last_name = mysqli_real_escape_string($sqli, $_REQUEST[$cLN]);
            $insert_child = "INSERT INTO $ChildOwner (OwnerID,Grade,ChildName,ChildSurname) VALUES ('$ID','$class','$st_first_name','$st_last_name')";
            if (mysqli_query($sqli, $insert_child)) {
                echo "<br>child" . $i . "inserted";
            } else {
                echo mysqli_error($sqli);
            }
        }
    }
} else{
    echo "ERROR: Could not able to execute $update. " . mysqli_error($sqli);
}
header( 'refresh: 500; url=/M6_project_CarOwner2/index.php' );
 exit(0);

// Close connection
mysqli_close($sqli);




?>

