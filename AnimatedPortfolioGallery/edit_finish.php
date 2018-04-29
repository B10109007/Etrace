<?php
session_start();
$title = filter_input(INPUT_POST, 'title');
$outputNO=filter_input(INPUT_POST, 'outputNO');
$resultarr = json_decode(stripslashes(filter_input(INPUT_POST, 'arr')));
try {
    include('../pdo_connect.php');
    $sql = "UPDATE output SET Title = ?,LastUpdate = ? WHERE OutputNo =?";
    $sth = $dbgo->prepare("$sql");
    $sth->execute(array("$title",date("Y-m-d H:i:s"), "$outputNO"));
    
    $sql = "DELETE FROM verticalexistresult where VerticalNo=?";
    $sth = $dbgo->prepare("$sql");
    $sth->execute(array("$outputNO"));
    
    $sql = "INSERT INTO verticalexistresult (ResultNo,VerticalNo) VALUES (?,?)";
    $sth = $dbgo->prepare("$sql");
    foreach ($resultarr as $value){
    $sth->execute(array("$value", "$outputNO"));   
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$dbgo = null;
