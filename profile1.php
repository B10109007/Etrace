<!DOCTYPE html>
<?php
session_start();
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
include('logincheck.php');
$email = $_SESSION['UserName'];

include("mysql_connect.inc.php");
$MemberNo = $_SESSION['MemberNo'];
$sql = "SELECT * FROM profile where MemberNo = '$MemberNo'";
$result = mysql_query($sql);
$profilerow = mysql_fetch_row($result);
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <link rel="Shortcut Icon" type="image/x-icon" href="image/favicon.ico" />
        <title>編輯個人資料 - ETrace</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
		<link href="css/bootstrap-datepicker.css" rel="stylesheet">
        <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="css/chi.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/theme.css" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="css/chi-achieves-box.css" rel="stylesheet">
		<link href="css/sweetalert.css" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div  class= "wrapper" > 
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php"><img src="image/logo.png" class="img-rounded center-block" height="50px" ></a>
                    </div> 
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">				    				
                        <?php include('menu.php') ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <!--nav ba結束-->
            <!--內容開始-->
            <div  id="addprofile">
                <div class="container">
                    <form name="form1" id="form1" method="post" action="profiledata.php" enctype="multipart/form-data">
                        <div class="row">
                            <!--ROW1-->
                            <!--左上姓名男女-->
                            <div class="col-md-4 col-sm-12">
                                <div class="bn__1" style="height: 250px;">
                                    <span class="glyphicon glyphicon-user"></span><br>
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control"id="InputTitle" placeholder="中文姓名" <?php echo 'value="' . "$profilerow[0]" . '"'; ?> name="chtName">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control"id="InputTitle" placeholder="英文姓名" <?php echo 'value="' . "$profilerow[4]" . '"'; ?> name="engName">
                                            </div>                 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="btn-group" id="InputGender" data-toggle="buttons">
                                                <?php
                                                if ($profilerow[1] == "男") {
                                                    echo '<label class="btn active">';
                                                    echo '<input type="radio" name="gender" value="男" checked><img src="image/boy.png" width="50" height="50"></label>';
                                                    
                                                } else {
                                                    echo '<label class="btn">';
                                                    echo '<input type="radio" name="gender" value="男"><img src="image/boy.png" width="50" height="50"></label>';
                                                }
                                                ?>             
                                                <?php
                                                if ($profilerow[1] == "女") {
                                                    echo '<label class="btn active">';
                                                    echo '<input type="radio" name="gender" value="女" checked> <img src="image/girl.png" width="50" height="50"></label>';
                                                } else {
                                                    echo '<label class="btn">';
                                                    echo '<input type="radio" name="gender" value="女"> <img src="image/girl.png" width="50" height="50"></label>';
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>


                                </div>                
                            </div>
                            <!--左上END-->
                            <!--中上連絡-->
                            <div class="col-md-4 col-sm-12">
                                <div class="bn__2" style="height: 250px;">
                                    <span class="glyphicon glyphicon-envelope" ></span><br>
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control"id="InputEmail" placeholder="<?php echo $email; ?>" disabled="false">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control"id="InputPhoneNum" placeholder="電話號碼" <?php echo 'value="' . "$profilerow[6]" . '"'; ?> name="phoneNum">
                                            </div>                 
                                        </div>
                                    </div>
                                </div>               
                            </div>
                            <!--中上END-->
                            <!--右上興趣技能-->
                            <div class="col-md-4 col-sm-12">
                                <div class="bn__3" style="height: 250px;">
                                    <span class="glyphicon glyphicon-th-list"></span><br>
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
                                            <div class="form-group fs">
                                                <input type="text" class="form-control"id="InputInterest" placeholder="興趣" <?php echo 'value="' . "$profilerow[9]" . '"'; ?> name="interest"></div>
                                            <div class="form-group fs">
                                                <input type="text" class="form-control"id="InputSkill" placeholder="技能" <?php echo 'value="' . "$profilerow[10]" . '"'; ?> name="skill"></div>              
                                        </div>
                                    </div>

                                </div> 
                            </div>
                            <!--右上END-->

                        </div><!--ROW1 END-->
                        <br>
                        <div class="row"><!--ROW2-->
                            <!--左下畢業-->
                            <div class="col-md-4 col-sm-12">
                                <div class="bn__4" style="height: 250px;">
                                    <span class="glyphicon glyphicon-education" aria-hidden="true"></span><br>
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2 fs">
                                            <div class="form-group">
                                                <input type="text" class="form-control"id="InputTitleEducation" placeholder="學歷" <?php echo 'value="' . "$profilerow[2]" . '"'; ?> name="edu">
                                            </div>  
                                            <div class="form-group "></br>
                                                <i class="fa fa-camera-retro fa-2x"> </i>
                                                </br></br>
                                                <input type="file" id="InputFile" name="file" accept="image/*">
                                                <p class="help-block" style="color:#ff4444;">&nbsp上傳大頭貼</p>
                                            </div>                 
                                        </div>
                                    </div>
                                </div>                
                            </div>
                            <!--左下END-->
                            <!--中下生日出生地-->
                            <div class="col-md-4 col-sm-12">
                                <div class="bn__5" style="height: 250px;">
                                    <img src="image/birthday_cake.png" alt="" style="padding:0px 18px 18px 18px;"><br>
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">

                                            <div id="sandbox-container">
												<div class="input-daterange input-group" id="datepicker">
													<input type="text" class="input-sm form-control" id="InputBirthDay" placeholder="生日" <?php echo 'value="' . "$profilerow[5]" . '"'; ?> name="birth">
												</div>
                                            </div>
                                            <div class="form-group fs">
                                                <input type="text" class="form-control"id="InputNowPlace" placeholder="現居地" <?php echo 'value="' . "$profilerow[7]" . '"'; ?> name="liveplace">
                                            </div>
                                            <div class="form-group fs">
                                                <input type="text" class="form-control"id="InputBirthPlace" placeholder="籍貫" <?php echo 'value="' . "$profilerow[8]" . '"'; ?> name="bornplace">
                                            </div>              
                                        </div>
                                    </div>
                                </div>               
                            </div>
                            <!--中下END-->
                            <!--右下自我介紹-->
                            <div class="col-md-4 col-sm-12">
                                <div class="bn__6" style="height: 250px;">
                                    <span class="glyphicon glyphicon-edit"></span><br>
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
                                            <div class="form-group">
                                                <textarea class="form-control" id="InputIntroduce" placeholder="自我介紹"  rows="5" style="resize:none" name="selfintro" ><?php echo "$profilerow[11]"; ?></textarea>
                                            </div>               
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <!--右下END-->
                        </div><!--ROW2 END-->

                        <br>
                        <br>
                        <div style="text-align:center">
                            <button type="submit" class="btn2" id="check" style="">Finish  
                        </div>
                    </form>  
                </div><!--container END-->
            </div><!--addprofile END-->
            <!--內容結束-->


            <div class="main"></div>
        </div><!--wrapper結束-->
        <footer class="footer"><div class="container text-center">© ETrace 2015. All right reserved.</div></footer>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<script src="js/tsai.js"></script>
        <script src="js/bootstrap-datepicker.min.js"></script>
        <script src="js/friends.js"></script>
		<script type="text/javascript" src="js/noty/packaged/jquery.noty.packaged.min.js"></script>
       
    </body>
</html>