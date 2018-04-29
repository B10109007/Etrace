<!DOCTYPE html>
<?php
session_start();
include("logincheck.php");
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include("mysql_connect.inc.php");
$MemberNo = $_SESSION['MemberNo'];
$sql = "SELECT * FROM profile where MemberNo = '$MemberNo'";
$result = mysql_query($sql);
$profilerow = mysql_fetch_row($result);
$result = mysql_query("SELECT * FROM image where ImageNo = '$profilerow[3]'");
$imagerow = mysql_fetch_row($result);
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <link rel="Shortcut Icon" type="image/x-icon" href="image/favicon.ico" />



        <title>個人資料 - ETrace</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="css/chi.css" rel="stylesheet">
        <!-- Custom styles for profile2.php -->
        <link href="css/showprofile.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/theme.css" rel="stylesheet">

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
                            <?php
                            include("menu.php");
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container theme-showcase" role="main">

                <div class="hexagon gap">
                    <div class="caption1">
                        <?php
                        echo '<img src="'."$imagerow[4]".'" class="img-rounded center-block" height="120px">';
                        ?>
                    </div>	
                </div>	

                <div class="hexagon-1">		
                    <div class="caption1 scroll">
                        <h1>
                            <?php
                            echo "$profilerow[0]";
                            ?>
                        </h1>
                    </div>
                    <div class="caption fade-caption">
                        <h4>中文姓名</h4>
                    </div>							
                </div>

                <div class="hexagon-2">		
                    <div class="caption1 scroll">
                        <h3> <?php
                            echo "$profilerow[4]";
                            ?></h3>
                    </div>
                    <div class="caption fade-caption">
                        <h4>英文姓名</h4>
                    </div>	
                </div>


                <div class="hexagon-3">		
                    <div class="caption1 scroll">
                        <?php
                        if ($profilerow[1] == '男') {
                            echo '<img src="image/boy.png" class="img-rounded center-block" height="120px">';
                        } elseif ($profilerow[1] == '女') {
                            echo '<img src="image/girl.png" class="img-rounded center-block" height="120px">';
                        }
                        ?>                       
                    </div>
                    <div class="caption fade-caption">
                        <h4>性別</h4>
                    </div>			
                </div>	

                <div class="hexagon-4">		
                    <div class="caption1 scroll">
                        <h1>
                            <?php
                            if($profilerow[5]!=NULL){
                            $birthDate = explode("-", $profilerow[5]);
                            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") ? ((date("Y") - $birthDate[0]) - 1) : (date("Y") - $birthDate[0]));
                            echo "$age" . '歲';
                            }
                            ?>
                        </h1>
                    </div>
                    <div class="caption fade-caption">
                        <h4>年齡</h4>
                    </div>	
                </div>

                <div class="hexagon-5">	
                    <div class="caption1 scroll">
                        <h3> <?php
                            echo "$profilerow[9]";
                            ?></h3>
                    </div>
                    <div class="caption fade-caption">
                        <h4>興趣</h4>
                    </div>			
                </div>

                <div class="hexagon-6">	
                    <div class="caption1 scroll">
                        <h1> <?php
                            echo "$profilerow[8]";
                            ?></h1>
                    </div>
                    <div class="caption fade-caption">
                        <h4>籍貫</h4>
                    </div>
                </div>

                <div class="hexagon-7">	
                    <div class="caption1 scroll">
                        <h3> <?php
                            echo "$profilerow[2]";
                            ?></h3>
                    </div>
                    <div class="caption fade-caption">
                        <h4>學歷</h4>
                    </div>				
                </div>

                <div class="hexagon-8">	
                    <div class="caption1 scroll">
                        <h3> <?php
                            echo "$profilerow[10]";
                            ?></h3>
                    </div>
                    <div class="caption fade-caption">
                        <h4>技能</h4>
                    </div>
                </div>

                <div class="hexagon-9 gap">	
                    <div class="caption1 scroll">
                        <h1> <?php
                            echo "$profilerow[7]";
                            ?></h1>
                    </div>
                    <div class="caption fade-caption">
                        <h4>現居地</h4>
                    </div>		
                </div>

                <div class="hexagon-10">	
                    <div class="caption1 scroll">
                        <h3> <?php
                            echo "$profilerow[5]";
                            ?></h3>
                    </div>
                    <div class="caption fade-caption">
                        <h4>生日</h4>
                    </div>	
                </div>

                <div class="hexagon-11">	
                    <div class="caption1 scroll">
                        <p><?php
                        $email = $_SESSION['UserName'];
                        echo "$email";
                        ?></p>
                    </div>
                    <div class="caption fade-caption">
                        <h4>聯絡方式</h4>
                    </div>		
                </div>

                <div class="hexagon-12">	
                    <div class="caption1 scroll">
                        <p><?php
                            echo "$profilerow[11]";
                            ?></p>
                    </div>
                    <div class="caption fade-caption">
                        <h4>自我介紹</h4>
                    </div>		
                </div>

            </div>	
            <div style="text-align:center">
				<a class="editbtn btn btn-default" href="">加好友</a>
            </div>

        </div>			


        <div class="main"></div>
    </div>

    <div class="footer"><div class="container text-center">© ETrace 2015. All right reserved.</div></div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- TimelineJS -->
    <script type="text/javascript" src="js/storyjs-embed.js"></script>
</body>
</html>