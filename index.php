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


        <title>ETrace</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="css/chi.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/theme.css" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
        <link href="css/chi-achieves-box.css" rel="stylesheet">
		<link href="css/fixed-positioning.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div  class= "wrapper" > 
            <nav class="navbar navbar-inverse navbar-fixed-top" data-0="display:block;z-index:9999;">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" >
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php"><img src="image/logo.png" height="50px" ></a>
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




            <!--Feedback Start-->
            <button type="button" class="btn btn-xs hidden-xs" style="font-family:sans-serif;z-index:9999;" id="feedback" target="_blank" data-toggle="modal" data-target="#exampleModal" data-whatever="ETrace">Feedback</button>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">給 ETrace 的新訊息</h4>
                        </div>
                        <div class="modal-body">
                            <form name="forum" id="forum" method="post" action="mail.php">
                                <div class="form-group">
                                    <label for="sender-name" class="control-label">姓名:</label>
                                    <input type="text" class="form-control" id="sender-name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="sender-email" class="control-label">E-mail:</label>
                                    <input type="text" class="form-control" id="sender-email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">訊息:</label>
                                    <textarea class="form-control" id="message-text" style="resize:none" name="message"></textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">傳送</button>
                            <button type="#" class="btn btn-default" data-dismiss="modal">取消</button>						
                        </div>
                        </form>
                    </div>
                </div>
            </div>	
            <!--Feedback End-->
            <br>

            <div id="opening">
                <img src="image/openlogo.jpg" id="openlogo" data-0="top:0%;right:50%;z-index:9999;" data-80="right:100%">
				<img src="image/openlogo.jpg" id="openlogo" data-0="top:0%;left:50%;z-index:9999;" data-80="left:100%">
				<img src="image/scroll.png" class="cloud-scroll " data-0="top:100%;z-index:10000;left:45%;opacity:.9;" data-100="opacity:0;">
            </div>
			
			<div id="opening2" data-50="top:0%;background:rgba(255,255,255,.2);" data-200="" data-300="top:-100%;">
				<div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-offset-1 col-xs-10" style="text-align:center;" >
					<img src="image/welcome.png" id="op2img" class="animated rollIn img-responsive" data-0="display:none;" data-50="display:block;">
									
	            </div>
				<div id="" class="animated zoomInLeft" data-0="display:none;" data-50="display:block;position:absolute;top:60%;left:75%;z-index:9999;" data-250="display:none;">
						<button class="btn" onclick="location.href='login.php'" style="height:75px;width:75px;border-radius:50%;background-color:skyblue;color:#fff;font-size:18px;border-color:white;border-style:outset;">註冊</a></button>
				</div>
				<h1 class="animated zoomInLeft" data-0="display:none;" data-100="display:block;top:80%;left:8%;color:#56aaff;">寫</h1>
				<h1 class="animated lightSpeedIn" data-0="display:none;" data-100="display:block;top:80%;left:17%;color:#56aaff;">下</h1>
				<h1 class="animated bounceInLeft" data-0="display:none;" data-100="display:block;top:80%;left:25%;color:gray;">你</h1>
				<h1 class="animated zoomInRight" data-0="display:none;" data-100="display:block;top:80%;left:33%;color:red;font-size:50px;">青</h1>
				<h1 class="animated bounceInDown" data-0="display:none;" data-100="display:block;top:80%;left:44%;color:#ffaad4;font-size:50px;">春</h1>
				<h1 class="animated fadeInUp" data-0="display:none;" data-100="display:block;top:80%;left:56%;color:gray;">的</h1>
				<h1 class="animated bounceInUp" data-0="display:none;" data-100="display:block;top:80%;left:64%;color:#9d67db;">那</h1>
				<h1 class="animated zoomInUp" data-0="display:none;" data-100="display:block;top:80%;left:72%;color:#9d67db;">一</h1>
				<h1 class="animated bounceInRight" data-0="display:none;" data-100="display:block;top:80%;left:81%;color:#9d67db;">頁</h1>
				<h1 class="animated shake" data-0="display:none;" data-100="display:block;top:80%;left:88%;color:gray;">！</h1>
            </div>

            
            <div id="feature" data-0="display:none;" data-250="opacity: 0;display:block;" data-300="opacity:1;" data-600="opacity: 0;">
                <div class="container">
                    <div class="row">
                        <a href="achieves2.php">
							<div class="col-md-3 col-xs-6 animated fadeInUp">
								<div class="bn__1">
									<i class="fa fa-th fa-4x"></i></br></br>
									<div class="bn-font">自訂分類</br>Customize</div>									
								</div>
							</div>
						</a>
                        <a href="timeline.php">
							<div class="col-md-3 col-xs-6 animated fadeInDown">
								<div class="bn__3">
									<i  class="fa fa-clock-o fa-4x"></i></br></br>
									<div class="bn-font">專屬時間軸</br>Timeline</div>								
								</div>
							</div>
						</a>
						<a href="share2.php">
							<div class="col-md-3 col-xs-6 animated fadeInRight">
								<div class="bn__5">
									<i class="fa fa-share-alt fa-4x"></i></br></br>
									<div class="bn-font">交流分享</br>Share</div>									
								</div>
							</div>
						</a>	
						<a href="profile1.php">	
							<div class="col-md-3 col-xs-6 animated fadeInLeft">
								<div class="bn__7">
									<i class="fa fa-thumbs-up fa-4x"></i></br></br>
									<div class="bn-font">介面簡單</br>Easy to Use</div>									
								</div>
							</div>
						</a>	
                    </div>
                </div>
            </div>
			
			<div id="foot" >
				 <picture data-500="opacity: 0;" data-600="opacity: 1;left:35%;top:10%" data-700="opacity: 0;">
						<source srcset="image/foot-register.png" media="(min-width: 720px)">
						<img src="image/foot-register-small.png" alt="">
				  </picture>
				  <picture data-600="opacity: 0;" data-700="opacity: 1;right:35%;top:25%" data-800="opacity: 0;">
						<source srcset="image/foot-login.png" media="(min-width: 720px)">
						<img src="image/foot-login-small.png" alt="">
				  </picture>
				  <picture data-700="opacity: 0;" data-800="opacity: 1;left:35%;top:40%" data-900="opacity: 0;">
						<source srcset="image/foot-record.png" media="(min-width: 720px)">
						<img src="image/foot-record-small.png" alt="">
				  </picture>
				  <picture data-800="opacity: 0;" data-900="opacity: 1;right:35%;top:55%" data-1000="opacity: 0;">
						<source srcset="image/foot-make.png" media="(min-width: 720px)">
						<img src="image/foot-make-small.png" alt="">
				  </picture>
				  <picture data-900="opacity: 0;" data-1000="opacity: 1;left:35%;top:70%" data-1100="opacity: 0;">
						<source srcset="image/foot-share.png" media="(min-width: 720px)">
						<img src="image/foot-share-small.png" alt="">
				  </picture>
			</div>
			
            <div  id="about" data-1050="top:20%;left:100%;" data-1100="top:20%;left:0%;">
                <div class="container">
					<div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
						<div class="jumbotron aboutus">						
							<blockquote>關於我們 About Us</blockquote>
							<div class="text-left scroll">
								<p>我們是四位由台科大資管系學生所組成的團隊，各自對資訊技術都擁有相當大的熱忱，也對能夠相互交流的社群網站充滿濃厚的興趣，因此想創造出獨一無二的歷程分享網並透過社群網站分享，讓使用者間互相觀看彼此分享的內容，更希望使用者在使用ETrace的同時，能享受在其中。</p>
							</div>
						</div>
					</div></br></br></br></br>
					<div class="row">
						<div class="col-md-2 col-md-offset-2 col-sm-2 col-sm-offset-2 col-xs-3">
							<img src="image/a.jpg" alt="" width="120" id="a" height="120" class="abc animated zoomIn" data-0="display:none;" data-1050="display:block;">
						</div>	
						<div class="col-md-2 col-sm-2 col-xs-3">
							<img src="image/b.jpg" alt="" width="120" id="b" height="120" class="abc animated zoomIn" data-0="display:none;" data-1050="display:block;">
						</div>	
						<div class="col-md-2 col-sm-2 col-xs-3">
							<img src="image/c.jpg" alt="" width="120" id="c" height="120" class="abc animated zoomIn" data-0="display:none;" data-1050="display:block;">
						</div>
						<div class="col-md-2 col-sm-2 col-xs-3">
							<img src="image/d.jpg" alt="" id="d"  class="abc animated zoomIn" data-0="display:none;" data-1050="display:block;">
						</div>	
					</div>
				</div>	
            </div>
            <div class="main"></div>
        </div>
        <footer class="footer"><div class="container text-center">© ETrace 2015. All right reserved.</div></footer>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/skrollr.min.js"></script>
		<script type="text/javascript">
		var s = skrollr.init({
			edgeStrategy: 'set',
			easing: {
				WTF: Math.random,
				inverted: function(p) {
					return 1-p;
				}
			}
		});
		</script>
    </body>
</html>