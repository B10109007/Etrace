<?php session_start(); ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
if (isset($_SESSION['UserName'])){
  header("Location:timeline.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <link rel="Shortcut Icon" type="image/x-icon" href="image/favicon.ico" />
        <title>登入 - ETrace</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <!-- Login-Register-form theme -->
        <link href="css/Login-Register-form.css" rel="stylesheet">
		<link href="css/chi.css" rel="stylesheet">
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
                    echo "<li class=\"dropdown\">\n";
                    echo "<a href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\"><img src=\"image/photo.jpg\" class=\"img-rounded\" height=\"35px\" > 文琪 <b class=\"caret\"></b></a>\n";
                    echo "<ul class=\"dropdown-menu\">\n";
                    echo "<li><a href=\"profile.php\">個人資料</a></li>\n";
                    echo "<li><a href=\"achievements.php\">成果</a></li>\n";
                    echo "<li><a href=\"skills2.php\">技能</a></li>\n";
                    echo "<li><a href=\"timeline.php\">時間軸</a></li>\n";
                    echo "<li><a href=\"output1.php\">匯出</a></li>\n";
                    echo "<li role=\"presentation\" class=\"divider\"></li>\n";
                    echo "<li><a href=\"logout.php\">登出</a></li>\n";
                    echo "</ul>\n";
                    echo "</li>\n";
                    } else {
                        echo "<li><a href=\"login.php\">登入</a></li>\n";
                    }
                    ?>
                    </ul>
                </div>
            </div>
          </nav>
        
        <div class="container theme-showcase" role="main">
            </style>
                <div class="col-md-4 col-md-offset-4">
                  <div calss="jumbotron">  
                    <div class="panel panel-login">
                        <div class="panel-heading">
                          </br>
                          <div style="text-align:center">
                             <img style="width:200px" src="image/logo.png" class="img-rounded">
                          </div>
                         <style>
                            #login-panel input[type=submit] {
                          width: 100%;
                          }   
                             #login-panel input[type=button] {
                         width: 100%;
                         }
                       </style> 
                       </br></br>
                            <div class="row">
                                <div class="col-md-4 col-md-offset-2">
                                    <a href="#" class="active" id="login-form-link">Login</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="#" id="register-form-link">Register</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-10  col-md-offset-1">
                                    <form id="login-form"  action="connect.php" method="post" role="form"  style="display: block;">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="form-group text-center">
                                            <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                            <label for="remember"> Remember Me</label>
                                        </div>
                                        <div class="form-group">
                                                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn-login" value="Log In">
										</div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form id="register-form" action="register_finish.php" method="post" role="form" style="display: none;">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                                        </div>
                                        <div class="form-group">
                                                    <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div> <!--jumEND-->
                </div>

        </div>
      </div><!--wrapperEND-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Login-Register-form -->
        <script src="js/Login-Register-form.js"></script>
    
    </body>

</html>
