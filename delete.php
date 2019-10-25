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
$ID=$_GET["ID"];
// sql to delete a record
$del = "DELETE FROM $CarOwner WHERE ID='$ID'";

if ($sqli->query($del) === TRUE) {
    echo "Record deleted successfully from CarOwner";
    $del = "DELETE FROM $ChildOwner WHERE OwnerID='$ID'";
    if ($sqli->query($del) === TRUE) {
        echo "Record deleted successfully from ChildOwner";
    } else {
        echo "Error deleting record: " . $sqli->error;
    }
} else {
    echo "Error deleting record: " . $sqli->error;
}
header( 'refresh: 500; url=/M6_project_CarOwner2/index.php' );
exit(0);
$sqli->close();
?>