<?php
session_start();
$MemberNo = $_SESSION['MemberNo'];
$friendNo = filter_input(INPUT_POST, 'friendNo');
$ans = filter_input(INPUT_POST, 'ans');
try {
    include('pdo_connect.php');
    if ($ans === "Y") {
        $sql = "INSERT INTO friend (memberNo,friendNo) VALUES (?,?)";
        $sth = $dbgo->prepare("$sql");
        if ($sth->execute(array("$MemberNo", "$friendNo")) && $sth->execute(array("$friendNo", "$MemberNo"))) {
            $sth=null;
            $sql = "DELETE FROM addfriend WHERE sendMember = ?";
            $sth = $dbgo->prepare("$sql");
            $sth->execute(array("$friendNo"));
            $sth=null;
            $sql = "SELECT Name FROM profile where MemberNo = ?";
            $sth = $dbgo->prepare("$sql");
            $sth->execute(array("$MemberNo"));
            $output = $sth->fetch();
            $sth=null;
            $sql = "INSERT INTO alert (context,receivedNo) VALUES (?,?)";
            $sth = $dbgo->prepare("$sql");
            $sth->execute(array($output['Name']."接受了你的邀請","$friendNo"));
            echo "Y";
        }
    } elseif ($ans === "N") {
        $sql = "DELETE FROM addfriend WHERE sendMember = ?";
        $sth = $dbgo->prepare("$sql");
        $sth->execute(array("$friendNo"));
        echo "Y";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$dbgo = null;
?>