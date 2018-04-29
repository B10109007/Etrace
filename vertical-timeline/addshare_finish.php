<?php
session_start();
$title = filter_input(INPUT_POST, 'title');
$resultarr = json_decode(stripslashes(filter_input(INPUT_POST, 'arr')));
$memberNo = $_SESSION['MemberNo']; 
$random=20;
for ($i=1;$i<=$random;$i=$i+1)
{
    $c=rand(1,3);
    if($c==1){$a=rand(97,122);$b=chr($a);}
    if($c==2){$a=rand(65,90);$b=chr($a);}
    if($c==3){$b=rand(0,9);}
    $randoma=$randoma.$b;
}

try {
    include('../pdo_connect.php');
    $sql = "INSERT INTO output (Title,Style,shareKey,MemberNo) VALUES (?,1,?,?)";
    $sth = $dbgo->prepare("$sql");
    $sth->execute(array("$title","$randoma","$memberNo"));
    $shareNo=$dbgo->lastInsertId();
    $sql = "INSERT INTO verticalexistresult (ResultNo,VerticalNo) VALUES (?,?)";
    $sth = $dbgo->prepare("$sql");
    foreach ($resultarr as $value){
    $sth->execute(array("$value", "$shareNo"));   
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$dbgo = null;


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

