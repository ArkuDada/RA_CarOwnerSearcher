
<?php
include 'Config.php';

$LPN = mysqli_real_escape_string($sqli, $_REQUEST['LPN']);
$Pro = mysqli_real_escape_string($sqli, $_REQUEST['province']);

$result = mysqli_query($sqli, "SELECT * FROM CarOwner WHERE LPN LIKE '%{$LPN}%' AND Province LIKE '%{$Pro}%'  ");
$spam = mysqli_num_rows($result);
echo "
<script>
console.log($spam);
</script>
";
