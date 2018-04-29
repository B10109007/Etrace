<?php
session_start();
$MemberNo = $_SESSION['MemberNo'];
try {
    include('pdo_connect.php');
    $sql = "SELECT sendMember FROM addfriend where receiveMember=?";
    $sth = $dbgo->prepare("$sql");
    $sth->bindValue(1, $MemberNo, PDO::PARAM_INT);
    $sth->execute();
    $sendMember = $sth->fetchAll();
    $sql = "SELECT * FROM profile where MemberNo=?";
    $sth = $dbgo->prepare("$sql");
    $arr = null;
    foreach ($sendMember as $value) {
        $sth->bindValue(1, $value['sendMember'], PDO::PARAM_INT);
        $sth->execute();
        $output = $sth->fetch();
        if ($output['PhotoUrl'] == 0) {
        $image = 'image/photo.jpg';
        } else {
        $sql = "SELECT ImageUrl FROM image where ImageNo = ?";
        $sth = $dbgo->prepare("$sql");
        $sth->execute(array($output['PhotoUrl']));
        $imageout = $sth->fetch();
        $image=$imageout['ImageUrl'];
        }
        $arr[] = array(
            'MemberNo' => $value['sendMember'],
            'Name' => $output['Name'],
            'photourl' =>$image,
        );
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$dbgo = null;
$json_string = json_encode($arr);
echo $json_string;

