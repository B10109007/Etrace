<?php
$sentmember = filter_input(INPUT_POST, 'sentmember');
$receivemember = filter_input(INPUT_POST, 'receivemember');
try {
    include('pdo_connect.php');
    $sql = "INSERT INTO addfriend (sendMember, receiveMember) VALUES (:sent, :receive);";
    $sth = $dbgo->prepare("$sql");
    $sth->bindParam(':sent', $sentmember);
    $sth->bindParam(':receive', $receivemember);
    if ($sth->execute()) {
        $sth = null;
        $sql = "SELECT Name FROM profile where MemberNo = ?";
        $sth = $dbgo->prepare("$sql");
        $sth->execute(array("$sentmember"));
        $output = $sth->fetch();
        $sth = null;
        $sql = "INSERT INTO alert (context,receivedNo) VALUES (?,?)";
        $sth = $dbgo->prepare("$sql");
        $sth->execute(array($output['Name'] . "對你發出了好友邀請", "$receivemember"));
        echo "Success";
    }
} catch (PDOException $e) {
    echo "Fail";
    echo "Error: " . $e->getMessage();
}
$dbgo = null;
?>