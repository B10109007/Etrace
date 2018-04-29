<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
include 'logincheck.php';
?>

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
        <link href="css/sweetalert.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/chi-share.css" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>.btn-facebook {
                background: #3b5998;
                border-radius: 0;
                color: #fff
            }
            .btn-facebook:link, .btn-facebook:visited {
                color: #fff
            }
            .btn-facebook:active, .btn-facebook:hover {
                background: #30477a;
                color: #fff
            }
			#animationSandbox {
				display: block;
				background-color: transparent;
			}</style>
    </head>
    <body style="background-image:url('image/bg-middle.png');background-position:bottom;">
        <div  class= "wrapper"> 
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container" >
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

            <div id="share2" class="container col-sm-10 col-md-10 col-md-offset-1 col-sm-offset-1" style="display:none">          
                <span id="animationSandbox" class="jumbotron" style="padding:0;">
                    <div class="col-md-8">
                        <input class="search" type="search" id="bar" placeholder="Search" />
                    </div></br></br></br>
                    <table class="table table-hover text-right">
                        <thead>
                            <tr>
                                <td class="sort" data-sort="no"> # <b class="caret"></b></td>
                                <td class="sort" data-sort="sharename"> 分享名稱 <b class="caret"></b></td>
                                <td class="sort" data-sort="editdate"> 修改日期 <b class="caret"></b></td>
                                <td class="sort" data-sort="template"> 套用樣式 <b class="caret"></b></td>
                                <td> <a href="share1.php"><button class="btn btn-add" id="" style=""><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增</button></a></td>
                            </tr>
                        </thead>
                        <tbody id="myTable" class="list">
                            <?php
                            include('pdo_connect.php');
                            $MemberNo = $_SESSION['MemberNo'];
                            $sql = 'SELECT * FROM output WHERE MemberNo = ?';
                            $sth = $dbgo->prepare("$sql");
                            $sth->execute(array($MemberNo));
                            $output = $sth->fetchAll();
                            $count = 0;
                            foreach ($output as $row) {
                                $count++;
                                echo '<tr class="bounceInRight animated">';
                                echo '<td class="no">' . "$count" . '</td>';
                                echo '<td class="sharename">' . "$row[1]" . '</td>';
                                echo '<td class="editdate">' . "$row[3]" . '</td>';
                                echo '<td class="template"> 樣式' . "$row[2]" . '</td>';
                                echo '<td>';
                                echo '<button type="button" class="btn btn-pre" id="" style="" onclick="preview(' . "$row[0]" . ',' . "$row[2]" . ')">預覽</button>';
                                echo '&nbsp;';
                                echo '&nbsp;';
                                echo '<button type="button" class="btn btn-edit" id="" style="" onclick="edit(' . "$row[0]" . ',' . "$row[2]" . ')">編輯</button>';
                                echo '&nbsp;';
                                echo '&nbsp;';
                                echo '<button type="button" class="btn btn-del" id="" onclick="mymyfunction(' . "$row[0]" . ',' . "$row[2]" . ')">刪除</button>';
                                echo '&nbsp;';
                                echo '&nbsp;';
                                echo '<button type="button" class="btn btn-share" id="" target="_blank" data-toggle="modal" onclick="sharemodal(' . "$row[0]" . ',' . "$row[2]" . ',' . "'$row[4]'" . ')">分享</button>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            ?>       
                        </tbody>                  
                    </table>
                    <div class="text-center">
                        <ul class="pagination"></ul>
                    </div>
                </span>
            </div>
            <div class="main"></div>
        </div>
        <footer class="footer"><div class="container text-center">© ETrace 2015. All right reserved.</div></footer>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/utils.js"></script>
        <!-- TimelineJS -->
        <script type="text/javascript" src="js/storyjs-embed.js"></script>
        <script type="text/javascript" src="js/share2.js"></script>
        <script type="text/javascript" src="js/list.js"></script>
        <script type="text/javascript" src="js/sweetalert.min.js"></script>
        <script type="text/javascript" src="js/sweetalert-dev.js"></script>
        <script src="http://listjs.com/no-cdn/list.pagination.js"></script>
        <script>
            var options = {
                valueNames: ['no', 'sharename', 'editdate', 'template'],
                page: 6,
                plugins: [
                    ListPagination({
                        innerWindow: 5,
                        outerWindow: 1,
                    })
                ]
            };
            var userList = new List('share2', options);
            $("#share2").css("display","block");
        </script>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '907452876002255',
      xfbml      : true,
      version    : 'v2.4'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
        <script>
        // del btn的特效
            function mymyfunction(OutputNo, style) {
                swal({
                    title: "Are you sure?",
                    text: "刪了就沒囉給我想清楚^^",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "不，偶狠不下心",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "好，就刪了吧!",
                    closeOnConfirm: false},
                function () {
                    deleteshare(OutputNo, style);
                    swal("Deleted!", "檔案已經被清掉了^_^叫破喉嚨也不會回來囉~", "success");
                });
            }
            function sharemodal(OutputNo, style, key) {
                if (style === 1) {
                    url = location.href;
                    herf = url.substring(0, url.indexOf('share2.php')) + 'vertical-timeline/share.php?No=' + OutputNo + '&Key=' + key;
                } else if (style === 2) {
                    url = location.href;
                    herf = url.substring(0, url.indexOf('share2.php')) + 'AnimatedPortfolioGallery/share.php?No=' + OutputNo + '&Key=' + key;
                }
                swal({
                    title: "我要分享~~~~",
                    //text: '<div class="fb-share-button" data-href="http://www.your-domain.com/your-page.html" data-layout="button_count"></div>',
                    text: '<a onclick="postToFeed(\''+herf+'\')" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>',
                    imageUrl: 'image/share.png',
                    type: "input",
                    animation: "slide-from-top",
                    inputPlaceholder: "",
                    inputValue: herf,
                    html: true});
            }
            function postToFeed(herf) {
                FB.ui(
                {
                  method: 'share',
                  href: herf,
                },
                // callback
                function(response) {
                }
              );
            }
        </script>
            <div id="fb-root"></div>
       <script>(function(d, s, id) {
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) return;
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));</script>

        <script src="js/friends.js"></script>
        <script type="text/javascript" src="js/noty/packaged/jquery.noty.packaged.min.js"></script>

    </body>
</html>

