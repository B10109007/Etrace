<?php
include("mysql_connect.inc.php");
$MemberNo=$_SESSION['MemberNo'];
$sql = "SELECT * FROM profile where MemberNo = '$MemberNo'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
if($row==false){
    header("Location:profile1.php");
}
?>


