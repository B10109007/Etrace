<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include("mysql_connect.inc.php");
include ("loadingPage.php");
$id = $_POST['email'];
$pw = $_POST['password'];
//搜尋資料庫資料
$sql = "SELECT * FROM member_table where UserName = '$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if($id != null && $pw != null && $row[1] == $id && $row[2] == $pw)
{       
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['UserName'] = $id;
        $_SESSION['MemberNo'] = $row[0];
        $memberNo=$row[0];
        $sql = "SELECT COUNT(*) FROM result WHERE memberNo =$row[0]";//計算result數目
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
        $resultcount=$row[0]-1;                
        $sql = "SELECT Lastlogin FROM `member_table`";//檢查是否今天登入過
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
        $lastlogin=$row[0];   
        if(date("Ymd")>date("Ymd",strtotime($lastlogin))){
             $TodayNo =rand(0,$resultcount);    
             $sql = "Update member_table set todayNo='$TodayNo' WHERE MemberNo =$memberNo";//更新每日數字            
             mysql_query($sql);
        }        
        $now=date("Y-m-d H:i:s");
        $sql = "Update member_table set Lastlogin='$now' WHERE MemberNo =$memberNo";
        mysql_query($sql);  
        echo '<meta http-equiv=REFRESH CONTENT=1;url=dailyReview.php>';
}
else
{
        echo '<script>$("#text").text("登入失敗")</script>';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=login.php>';
}
?>