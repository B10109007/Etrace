<?php
$OutputNo = filter_input(INPUT_POST, 'OutputNo');
$style = filter_input(INPUT_POST, 'style');
try {
    include('pdo_connect.php');
    $sql = "DELETE FROM output where OutputNo=?";;
    $sth = $dbgo->prepare("$sql");
    $count1 = $sth->execute(array("$OutputNo"));
    if ($style === 1||$style === 2) {
        $sql = "DELETE FROM verticalexistresult where VerticalNo=?";
    }
    $sth = $dbgo->prepare("$sql");
    $count2 = $sth->execute(array("$OutputNo"));
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$dbgo = null;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

