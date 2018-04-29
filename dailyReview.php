<?php
session_start();
$MemberNo = $_SESSION['MemberNo'];
try {
    include 'pdo_connect.php';
    $sql = "SELECT * FROM result where MemberNo=?";
    $sth = $dbgo->prepare("$sql");
    $sth->bindValue(1, $MemberNo, PDO::PARAM_INT);
    if ($sth->execute()) {
        $resultrow = $sth->fetchAll();
    }
    $sql = "SELECT todayNo FROM member_table where MemberNo=?";
    $sth = $dbgo->prepare("$sql");
    $sth->bindValue(1, $MemberNo, PDO::PARAM_INT);
    if ($sth->execute()) {
        $memberrow = $sth->fetch();
    }
    $TodayNo = $memberrow['todayNo'];
    if (isset($resultrow[$TodayNo])) {
        $todayresult = $resultrow[$TodayNo];
        $sql = "SELECT * FROM file where ResultNo=?";
        $sth = $dbgo->prepare("$sql");
        $sth->bindValue(1, $todayresult['ResultNo'], PDO::PARAM_INT);
        if ($sth->execute()) {
            $filerow = $sth->fetch();
        }
        $sth = null;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$dbgo = null;
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <link rel="Shortcut Icon" type="image/x-icon" href="image/favicon.ico" />
        <title>每日回顧 - ETrace</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="css/chi.css" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <!-- Custom styles for this template -->
        <link href="css/theme.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/sweetalert.css" rel="stylesheet">
        <link href="css/turnjs.css" rel="stylesheet">
        <link href='//fonts.googleapis.com/css?family=Cardo:400italic' rel='stylesheet' type='text/css'><script src="//s3-ap-northeast-1.amazonaws.com/justfont-user-script/jf-36073.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
	<style>
	 		   @media only screen and (max-width: 760px) {
			   .review-title{font-size:15px;line-height:30px;}
				.hard.index img{height:25px;} 
			   }
	</style>
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
                            include("menu.php")
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="col-md-offset-2 animated zoomIn" >
                <div id="zoom-viewport" class="zoom-viewport">
                    <div class="flipbook-viewport">
                        <div class="container">
                            <div id="flipbook" class="flipbook">
                                <div class="hard index" style="text-align: center"><img src="image/opening-logo-no.png"></div>
                                <div>
                                    <?php
                                    if (isset($todayresult)) {
                                        echo '<h1 class="review-title">' . date('Y-m-d', strtotime($todayresult['StartTime'])) . '</h1>';
                                        echo '</br>';
                                        echo '<h1 class="review-title">' . $todayresult['Title'] . '</h1>';
                                        echo '</br>';
                                        echo '<div>' . $todayresult['Content'] . '</div>';
                                    }else{
                                        echo '<h1 style="margin-top:100px">請先新增成果才能使用本功能</h1>';
                                    }
                                    ?>
                                </div>		
                                <div style="padding: 40px">
                                    <?php                                   
                                    if (isset($todayresult)) {
                                    echo '<div id="photo" class="multiple-borders widthfull">';
                                        if (strpos("$filerow[2]", 'image') !== false) {
                                            echo '<img src="' . $filerow['FileUrl'] . '" style="width: 100%;">';
                                        }
                                    echo '</div>';
                                    }
                                    ?>
                                </div>
                                <div class="hard"></div>			
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/sweetalert.min.js"></script>
        <script type="text/javascript" src="js/noty/packaged/jquery.noty.packaged.min.js"></script>
        <script src="js/friends.js"></script>
        <script src="js/jquery-ui-1.8.20.custom.min.js"></script>
        <script src="js/jquery.mousewheel.min.js"></script>
        <script src="js/jgestures.min.js"></script>
        <script src="js/turn.min.js"></script>
        <script src="js/zoom.min.js"></script>
        <script src="js/scissor.min.js"></script>
        <script>
					$("#flipbook").turn({
						width: 800,
						height: 500,
						duration: 3000,
						//elevation: 0,
						// autoCenter: true
            });			
            $(function () {
                $('.flipbook').mouseover(function () {
                    $('.flipbook').turn("page", 2);
                });
                $(".flipbook").bind("turning", function (event, page, view) {
                    if (page == 2) {
                        $(".flipbook").turn("disable", true);
                        $("#photo").fadeIn(1500);
                    }
                });
            });
        </script>
		
		
    </body>
</html>
