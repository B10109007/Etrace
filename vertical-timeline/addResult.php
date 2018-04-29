<?php
session_start();
include("../mysql_connect.inc.php");
$Title = filter_input(INPUT_POST, 'Title');
$Classify = filter_input(INPUT_POST, 'classify');
$StartTime = filter_input(INPUT_POST, 'StartTime');
$EndTime = filter_input(INPUT_POST, 'EndTime');
$Youtube = filter_input(INPUT_POST, 'youtube');
$Content = filter_input(INPUT_POST, 'content');

$MemberNo = $_SESSION['MemberNo'];
$sql = "INSERT INTO result (Title,StartTime,EndTime,Classify,Content,MediaUrl,MemberNo)
            VALUES ('$Title','$StartTime','$EndTime','$Classify','$Content','$Youtube','$MemberNo')";
if (mysql_query($sql)) {
    // echo '成果新增成功!';
    $resultNo = mysql_insert_id();
    echo $resultNo;
} else {
    //echo '成果新增失敗!';
    //echo "$sql";
}
//if (isset($_FILES['file'])) {
    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileSize = $_FILES['file']['size'];
    $fileTemp = $_FILES['file']['tmp_name'];
    $fileResult = $_FILES['file']['error'];
    if ($fileResult == 0) {
        $opendir = $_SERVER['DOCUMENT_ROOT'] . "/Etrace/uploadfile/";
        $handle = @opendir($opendir) or die("<BR><BR>無法開啟資料夾" . $opendir . "此目錄可能不存在");
        $savepathname = "uploadfile/" . $resultNo . "_" . $fileName;
        move_uploaded_file($fileTemp, '../' . iconv("utf-8", "big5", $savepathname));
        $sql = "INSERT INTO file (FileName,FileType,FileSize,FileUrl,ResultNo) VALUES ('$fileName','$fileType','$fileSize','$savepathname',$resultNo)";
        if (mysql_query($sql)) {
            // echo '檔案新增成功!';        
        } else {
            //echo '檔案新增失敗!';       
        }
    }
//}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

