<?php
session_start();
$MemberNo = $_SESSION['MemberNo'];
$alertNo = filter_input(INPUT_POST, 'alertNo');
try {
    include('pdo_connect.php');
        $sql = "DELETE FROM alert WHERE alertNo = ? AND receivedNo = ?";
        $sth = $dbgo->prepare("$sql");
        $sth->execute(array("$alertNo",$MemberNo));      
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$dbgo = null;


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

