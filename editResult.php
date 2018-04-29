<?php
include("loadingPage.php");
session_start();
include("mysql_connect.inc.php");
$MemberNo = $_SESSION['MemberNo'];
$title = filter_input(INPUT_POST, 'edittitle');
$resultclass = filter_input(INPUT_POST, 'editresultclass');
$StartTime = filter_input(INPUT_POST, 'editStartTime');
$EndTime = filter_input(INPUT_POST, 'editEndTime');
$content = filter_input(INPUT_POST, 'editcontent');
$youtube = filter_input(INPUT_POST, 'edityoutube');
$resultNo = filter_input(INPUT_POST, 'editResultNo');
$fileName = $_FILES['editfile']['name'];
$fileType = $_FILES['editfile']['type'];
$fileSize = $_FILES['editfile']['size'];
$fileTemp = $_FILES['editfile']['tmp_name'];
$fileResult = $_FILES['editfile']['error'];
if(stristr($youtube,"www.youtube.com")){
    parse_str( parse_url( $youtube, PHP_URL_QUERY ), $my_array_of_vars );
    $youtube='https://youtu.be/'.$my_array_of_vars['v'];    
}
if ($fileResult == 0) {
    $result = mysql_query("SELECT FileUrl FROM file where ResultNo='$resultNo'");
    $row = mysql_fetch_row($result);
    $opendir = $_SERVER['DOCUMENT_ROOT'] . "/Etrace/uploadfile/";
    $handle = @opendir($opendir) or die("<BR><BR>無法開啟資料夾" . $opendir . "此目錄可能不存在");
    $savepathname = "uploadfile/" . $resultNo . "_" . $fileName;
    move_uploaded_file($fileTemp, iconv("utf-8", "big5", $savepathname));
    $sql = "update file set FileName='$fileName',FileType='$fileType',FileSize='$fileSize',FileUrl='$savepathname' where ResultNo='$resultNo'";
   
    if (mysql_query($sql) && mysql_affected_rows() != 0) {
        //echo "檔案更新";
        unlink("$row[0]");
    } else {
        mysql_query("INSERT INTO file (FileName,FileType,FileSize,FileUrl,ResultNo) VALUES ('$fileName','$fileType','$fileSize','$savepathname','$resultNo')");
        //echo "檔案新增";
    }
}
$sql = "update result set Title='$title',StartTime='$StartTime',EndTime='$EndTime',Classify='$resultclass' ,Content='$content' ,MediaUrl='$youtube' where ResultNo='$resultNo' and MemberNo='$MemberNo'";
if (mysql_query($sql)) {
    //echo "更新成功";
} else {
    //echo "更新失敗";
}

echo '<meta http-equiv=REFRESH CONTENT=1;url=achieves.php>';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

