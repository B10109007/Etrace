<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
include("loadingPage.php");
$id = $_POST['email'];
$pw = $_POST['password'];
$pw2 = $_POST['confirm-password'];

//判斷帳號密碼是否為空值
//確認密碼輸入的正確性
if($id != null && $pw != null && $pw2 != null && $pw == $pw2)
{
        //新增資料進資料庫語法
        $sql = "insert into member_table (UserName, Password) values ('$id', '$pw')";
    if (mysql_query($sql)) {
        echo '<script>$("#text").text("註冊成功")</script>';
        $memberNo=mysql_insert_id();
        mysql_query("insert into resultclassify (memberNo) values('$memberNo')");  
        mysql_query("insert into profile (PhotoUrl,memberNo) values(0,'$memberNo')");  
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
    } else
        {
                echo '帳號重複!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
        }
}
else
{
        echo '資料有誤!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
}
?>