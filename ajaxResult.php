<?php
session_start();
$resultNo=filter_input(INPUT_POST,'resultNo');
include("mysql_connect.inc.php");
$sql = "SELECT * FROM result where ResultNo='$resultNo';";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
$sql = "SELECT * FROM file where ResultNo='$resultNo';";
$result = mysql_query($sql);
$filerow = mysql_fetch_row($result);
$arr = array(
    'Title' => "$row[1]",
    'Classify'=> "$row[5]",
    'StartTime' => date('Y/m/d',strtotime($row[3])),
    'Content'=> "$row[6]",
    'Youtube' => substr("$row[8]",17),
    'FileName'=> "$filerow[1]",
    'FileType'=> "$filerow[2]",
    'FileUrl'=> "$filerow[4]",
    'EndTime' => date('Y/m/d',strtotime($row[4])),
    'ResultNo'=> "$row[0]",
    'FileNo'=>"$filerow[0]",
);
$json_string = json_encode($arr);
echo $json_string;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

