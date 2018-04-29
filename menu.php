<?php
include("mysql_connect.inc.php");
$MemberNo = $_SESSION['MemberNo'];
//搜尋資料庫資料
$sql = "SELECT * FROM profile where MemberNo = '$MemberNo'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
if ($row[0] == NULL) {
    $Name = '使用者';
} else {
    $Name = $row[0];
}
if ($row[3] == 0) {
    $image = 'image/photo.jpg';
} else {
    $sql = "SELECT * FROM image where ImageNo = '$row[3]'";
    $result = mysql_query($sql);
    $imagerow = mysql_fetch_row($result);
    $image = "$imagerow[4]";
}

try {
    include('pdo_connect.php');
    $sql = "SELECT COUNT(*) FROM addfriend WHERE receiveMember =?";
    $sth = $dbgo->prepare("$sql");
    $sth->bindValue(1, $MemberNo, PDO::PARAM_INT);
    if($sth->execute()){
        $sendcount = $sth->fetch();
    }        
    $sth=null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$dbgo = null;

//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
echo '<li><a href="dailyReview.php"><i class="fa fa-history fa-lg"></a></i></li>';
echo '<li class="dropdown"><a href="#" id="friend"  data-toggle="dropdown" class="dropdown-toggle" onclick="friendrequest()"><i class="fa fa-users fa-lg"></i></a><div class="nav-informs">'."$sendcount[0]".'</div>';
if($sendcount[0]>0){
    echo '<ul id="friendmenu" class="dropdown-menu">';
    echo '</ul>';
}
echo '</li>';
echo '<li class="dropdown">';
echo '<a href="#" data-toggle="dropdown" class="dropdown-toggle"><img src="' . "$image" . '" class="img-rounded" height="35px">' . " $Name" . '<span class="caret"></span></a>';
echo '<ul class="dropdown-menu">';
echo '<li><a href="profile2.php">個人資料</a></li>';
echo '<li><a href="achieves.php">成果上傳</a></li>';
echo '<li><a href="timeline.php">時間軸</a></li>';
echo '<li><a href="friendmanager.php">好友管理</a></li>';
//echo '<li><a href="output1.php">匯出</a></li>';
echo '<li><a href="share2.php">樣式分享</a></li>';
echo '<li role="presentation" class="divider"></li>';
echo '<li><a href="logout.php">登出</a></li>';
echo '</ul>';
echo '</li>';
?>


