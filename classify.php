<?php
include("loadingPage.php");
session_start();
include("mysql_connect.inc.php");
$class = filter_input(INPUT_POST, 'InputClassify');
$MemberNo = $_SESSION['MemberNo'];
$result = mysql_query("SELECT * FROM resultclassify where memberNo ='$MemberNo'");
$row = mysql_fetch_row($result);
if ($row[0] == null) {
    mysql_query("update resultclassify set classone='$class' where memberNo ='$MemberNo'");
} elseif ($row[1] == null) {
    mysql_query("update resultclassify set classtwo='$class' where memberNo ='$MemberNo'");
} elseif ($row[2] == null) {
    mysql_query("update resultclassify set classthree='$class' where memberNo ='$MemberNo'");
} elseif ($row[3] == null) {
    mysql_query("update resultclassify set classfour='$class' where memberNo ='$MemberNo'");
} elseif ($row[4] == null) {
    mysql_query("update resultclassify set classfive='$class' where memberNo ='$MemberNo'");
} elseif ($row[5] == null) {
    mysql_query("update resultclassify set classsix='$class' where memberNo ='$MemberNo'");
} else {
    echo '最多自訂6個分類';   
}
  echo '<meta http-equiv=REFRESH CONTENT=1;url=achieves.php>';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

