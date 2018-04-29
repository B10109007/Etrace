<?php
session_start();
$MemberNo = $_SESSION['MemberNo'];
$friendNo = filter_input(INPUT_POST, 'friendNo');
try {
    include('pdo_connect.php');
        $sql = "DELETE FROM friend WHERE memberNo = ? AND friendNo = ?";
        $sth = $dbgo->prepare("$sql");
        $sth->execute(array("$MemberNo", "$friendNo"));
        $sth->execute(array("$friendNo", "$MemberNo"));                
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$dbgo = null;

