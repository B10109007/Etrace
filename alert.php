<?php
session_start();
$MemberNo = $_SESSION['MemberNo'];
try {
    include('pdo_connect.php');
    $sql = "SELECT * FROM alert where receivedNo=?";
    $sth = $dbgo->prepare("$sql");
    $sth->bindValue(1, $MemberNo, PDO::PARAM_INT);
    $sth->execute();
    $alert = $sth->fetchAll();
    $arr = null;
    foreach ($alert as $value) {
        $arr[] = array(
            'alertNo' => $value['alertNo'],
            'context' => $value['context'],
        );
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$dbgo = null;
$json_string = json_encode($arr);
echo $json_string;
