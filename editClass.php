<?php
session_start();
include("mysql_connect.inc.php");
$classval = filter_input(INPUT_POST, 'classval');
$classname=filter_input(INPUT_POST, '$classname');
$MemberNo = $_SESSION['MemberNo'];

switch ($classval) {
    case 0:
        $Classify = 'classone';
        break;
    case 1:
        $Classify = 'classtwo';
        break;
    case 2:
        $Classify = 'classthree';
        break;
    case 3:
        $Classify = 'classfour';
        break;
    case 4:
        $Classify = 'classfive';
        break;
    case 5:
        $Classify = 'classsix';
        break;
}
$sql = "SELECT "."$Classify"." FROM resultclassify WHERE memberNo= '$MemberNo'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
$sql = "UPDATE resultclassify SET "."$Classify='$classname'"." WHERE memberNo='$MemberNo'";
$result = mysql_query($sql);

$sql = "UPDATE result set Classify ='$classname' WHERE Classify ='$row[0]'";
$result = mysql_query($sql);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

