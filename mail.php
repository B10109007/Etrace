<?php
include("class.phpmailer.php"); //匯入PHPMailer類別
 
$name=$_POST['name'];
$email=$_POST['email'];
//$Subject=$_POST['subject'];
$message=$_POST['message'];
 
$mail= new PHPMailer(); //建立新物件
$mail->IsSMTP(); //設定使用SMTP方式寄信
$mail->SMTPAuth = true; //設定SMTP需要驗證
$mail->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線
$mail->Host = "smtp.gmail.com"; //Gamil的SMTP主機
$mail->Port = 465;  //Gamil的SMTP主機的埠號(Gmail為465)。
$mail->CharSet = "utf-8"; //郵件編碼
 
$mail->Username = "etrace12345@gmail.com"; //Gamil帳號
$mail->Password = "etrace4912"; //Gmail密碼
 
$mail->From = $email; //寄件者信箱
$mail->FromName = "給 ETrace 的新訊息"; //寄件者姓名
 
//$mail->Subject ="一封線上客服信";  //郵件標題
$mail->Body = "姓名:".$name."<br>信箱:".$email."<br>主題: 意見回饋"."<br>回應內容:".$message; //郵件內容
 
$mail->IsHTML(true); //郵件內容為html ( true || false)
$mail->AddAddress("etrace12345@gmail.com"); //收件者郵件及名稱
 
if(!$mail->Send()) {
	echo "發送錯誤";
} else {
	echo "<div align=center>感謝您的回覆，我們將會盡速處理!</div>";
	echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}
?>