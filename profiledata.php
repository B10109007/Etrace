<?php session_start(); ?>
<?php
include ("loadingPage.php");
//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include("mysql_connect.inc.php");
$chtName = filter_input(INPUT_POST, 'chtName');
$engName = filter_input(INPUT_POST, 'engName');
$gender = filter_input(INPUT_POST, 'gender');
$edu = filter_input(INPUT_POST, 'edu');
$phoneNum = filter_input(INPUT_POST, 'phoneNum');
$birth = filter_input(INPUT_POST, 'birth');
$liveplace = filter_input(INPUT_POST, 'liveplace');
$bornplace = filter_input(INPUT_POST, 'bornplace');
$interest = filter_input(INPUT_POST, 'interest');
$skill = filter_input(INPUT_POST, 'skill');
$selfintro = filter_input(INPUT_POST, 'selfintro');

$fileName = $_FILES['file']['name'];
$fileType = $_FILES['file']['type'];
$fileSize = $_FILES['file']['size'];
$fileTemp = $_FILES['file']['tmp_name'];
$fileResult = $_FILES['file']['error'];

$MemberNo = $_SESSION['MemberNo'];
$sql = "SELECT * FROM profile where MemberNo = '$MemberNo'";
$result = mysql_query($sql);
$profilerow = mysql_fetch_row($result);
if ($fileResult == 0) {
    $opendir = $_SERVER['DOCUMENT_ROOT'] . "/Etrace/image/upload/";
    $handle = @opendir($opendir) or die("<BR><BR>無法開啟資料夾" . $opendir . "此目錄可能不存在");
    $savepathname = "image/upload/" . time() . $fileName;
    move_uploaded_file($fileTemp,iconv("utf-8", "big5",$savepathname));
    $dbimageNo = $profilerow[3];
    if ($profilerow == false || $dbimageNo == 0) {
        $sql2 = "INSERT INTO image (ImageName,ImageType,ImageSize,ImageUrl) VALUES ('$fileName','$fileType','$fileSize','$savepathname')";
        if (mysql_query($sql2)) {
            $imageNo = mysql_insert_id();
            //echo '圖片新增成功!';
            if($dbimageNo==0){
                mysql_query("update profile set PhotoUrl='$imageNo' where MemberNo='$MemberNo'");
            }
        } else {
            //echo '圖片新增失敗!';
            //echo "$sql2";
        }
    } else {
        $sql2 = "update image set ImageName='$fileName',ImageType='$fileType',ImageSize='$fileSize',ImageUrl='$savepathname' where ImageNo='$dbimageNo'";
        $result=mysql_query("SELECT ImageUrl FROM image where ImageNo='$dbimageNo'");
        $row=mysql_fetch_row($result);      
        if (mysql_query($sql2)) {
            //echo '圖片更新成功!';
            unlink("$row[0]");
        } else {
            //echo '圖片更新失敗!';
        }
    }
}else{
    $imageNo=0;
}

if ($profilerow == false) {
    $sql3 = "INSERT INTO profile (Name,Gender,Background,PhotoUrl,EngName,Birth,phoneNum,liveplace,bornplace,interest,skill,selfintro,MemberNo)
            VALUES ('$chtName','$gender','$edu','$imageNo','$engName','$birth','$phoneNum','$liveplace','$bornplace','$interest','$skill','$selfintro','$MemberNo')";
    if (mysql_query($sql3)) {
        //echo '文字新增成功!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=profile2.php>';
    } else {
        //echo '文字新增失敗!';
        //echo "$sql3";
    }
} else {
    $sql3 = "update profile set Name='$chtName',Gender='$gender',Background='$edu',EngName='$engName',Birth='$birth',phoneNum='$phoneNum',
            liveplace='$liveplace',bornplace='$bornplace',interest='$interest',skill='$skill',selfintro='$selfintro'
            where MemberNo='$MemberNo'";
    if (mysql_query($sql3)) {
        //echo '文字更新成功!';       
        echo '<meta http-equiv=REFRESH CONTENT=1;url=profile2.php>';
    } else {
        //echo '文字更新失敗!';
        //echo "$sql3";
    }
}
?>


