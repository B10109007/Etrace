<!DOCTYPE html>
<?php session_start(); ?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <link rel="Shortcut Icon" type="image/x-icon" href="image/favicon.ico" />


        <title>分享 - ETrace</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="css/chi.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/theme.css" rel="stylesheet">
        <link href="css/chi-achieves-box.css" rel="stylesheet">
        <link href="css/todostyle.css" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
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
                            <?php
                            if (isset($_SESSION['UserName'])) {
                                include("menu.php");
                            } else {
                                echo "<li><a href=\"login.php\">登入</a></li>\n";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>


            <br>
            <!--Slider Start-->
            <div id="operate">
                <div class="container">				
                    <label class="step">Step1：選擇樣式</label>
                    <style>
                        .carousel-inner > .item > img,
                        .carousel-inner > .item > a > img {
                            margin: auto;
                        }
                    </style>	
                    <div class="container">
                        <div id="myCarousel" class="carousel" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel"></li>
                                <li data-target="#myCarousel"></li>
                                <li data-target="#myCarousel"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active" name="style1">
                                    <img src="image/style1.png" alt="slider1" width="460" height="200">
                                </div>

                                <div class="item" name="style2">
                                    <img src="image/style2.png" alt="slider2" width="460" height="200">
                                </div>

                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control  slide" href="#myCarousel" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right  slide" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>                    
                </div> 
            </div><!--Slider End-->
            </br></br>
            <!--要input的內容Start-->            
            <div class="container">
                <div class="form-group">
                    <label class="step">Step2：輸入分享名稱</label>
                    <input type="text" id="title" class="form-control">
                </div>            
            </div>
            <!--要input的內容End-->                
            <div style="text-align:center">
                <button type="button" class="btn btn-info btn-summit" onclick="stylesubmit()">送出 
            </div>
            <div class="main"></div>
        </div>
        <footer class="footer"><div class="container text-center">© ETrace 2015. All right reserved.</div></footer>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>       
        <script>
                    function stylesubmit() {
                        if ($(".item.active").attr("name") === "style1") {
                            window.location.href = 'vertical-timeline/Add.php?title=' + $("#title").val();
                        }
                        if ($(".item.active").attr("name") === "style2") {
                            window.location.href = 'AnimatedPortfolioGallery/Add.php?title=' + $("#title").val();
                        }
                    }
        </script>
        <script src="js/friends.js"></script>
		<script type="text/javascript" src="js/noty/packaged/jquery.noty.packaged.min.js"></script>
    </body>
</html>