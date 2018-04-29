<?php
session_start();
$resultNo=filter_input(INPUT_POST,'resultNo');
include("mysql_connect.inc.php");
$sql = "delete FROM result where ResultNo='$resultNo'";
$result = mysql_query($sql);
echo "$result";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

