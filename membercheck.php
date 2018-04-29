<?php
session_start();
$MemberNo = $_SESSION['MemberNo'];
$email = filter_input(INPUT_POST, 'email');
try {
    include('pdo_connect.php');
    $sql = "SELECT MemberNo FROM member_table where UserName=?";
    $sth = $dbgo->prepare("$sql");
    $sth->bindValue(1, $email, PDO::PARAM_STR);
    $sth->execute();
    $output = $sth->fetch();
    if(!empty($output)){
        $sql = "SELECT friendNo FROM friend where memberNo=? AND friendNo=?";
        $sth = $dbgo->prepare("$sql");
        $sth->execute(array("$MemberNo",$output['MemberNo']));
        $output2 = $sth->fetch();        
        if(empty($output2)){
            echo $output['MemberNo'];//成功
        }else{
            echo "A";//已經是好友
        }
    }else{
        echo "N";//無此帳號
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$dbgo = null;
?>