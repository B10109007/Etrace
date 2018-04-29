<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
include 'logincheck.php';
$MemberNo = $_SESSION['MemberNo'];
try {
    include 'pdo_connect.php';
    $sql = "SELECT COUNT(*) FROM friend WHERE memberNo =?";
    $sth = $dbgo->prepare("$sql");
    $sth->bindValue(1, $MemberNo, PDO::PARAM_INT);
    if ($sth->execute()) {
        $friendcount = $sth->fetch();
    }
    $sth = null;
    $sql = "SELECT friendNo FROM friend WHERE memberNo =?";
    $sth = $dbgo->prepare("$sql");
    $sth->bindValue(1, $MemberNo, PDO::PARAM_INT);
    if ($sth->execute()) {
        $friend = $sth->fetchAll();
    }
    $sth = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <link rel="Shortcut Icon" type="image/x-icon" href="image/favicon.ico" />
        <title>好友管理 - ETrace</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="css/chi.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/theme.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/sweetalert.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
		
		<style>
		   @media only screen and (min-width: 990px) {
			.container .jumbotron, .container-fluid .jumbotron {
				padding-left: 30px;
		   }}
		</style>
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
                            include("menu.php")
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container col-sm-10 col-md-10  col-sm-offset-1">            

                <span id="animationSandbox" class="jumbotron">
                    <div id="hacker-list"> 
                        <div class="row">
                            <div class="col-md-9">
                                <input class="search" type="search" id="bar" placeholder="Search" />
                            </div>
                            <div class="col-md-2 friend-total">
                                共有<?php echo "$friendcount[0]" ?>位朋友
                            </div>
                            <div class="col-md-1">
                                <button class="addfriend-btn" onclick="myswal()"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <!-- <div id="userList"> -->
                        <div id="friend-pagelist" class="row ">                             
                                <div class="row">
                                    <ul class="list">
                                    <?php
                                    try {
                                        include 'pdo_connect.php';
                                        $sql = "SELECT * FROM profile WHERE memberNo =?";
                                        $sth = $dbgo->prepare("$sql");
                                        $sql2 = "SELECT ImageUrl FROM image WHERE ImageNo =?";
                                        $sth2 = $dbgo->prepare("$sql2");
                                        foreach ($friend as $value) {
                                            $sth->execute(array($value['friendNo']));
                                            $profile = $sth->fetch();
                                            $sth2->execute(array($profile['PhotoUrl']));
                                            $imagerow = $sth2->fetch();
                                            $image = $imagerow['ImageUrl'];
                                            echo '<li>';
                                            echo '<div class="col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1 col-xs-8 col-xs-offset-2 friend-box" >';

                                            echo '<img src="' . $image . '" class="imgsize" onclick="window.location.href=\'profile3.php?No=' . $value['friendNo'] . '\'">';
                                            echo '<span class="simple-caption caption name">' . $profile['Name'] . '</span>';
                                            echo '<button class="caption del-caption fa fa-times" onclick="deletefriend(' . $value['friendNo'] . ',' . '\'' . $profile['Name'] . '\'' . ')"></button>';
                                            echo '</br>';

                                            echo '</div>';
                                            echo '</li>';
                                        }
                                    } catch (PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }
                                    $dbgo = null;
                                    ?>
                                     </ul>           
                                </div>
                            <div class="text-center">
                                <ul class="pagination pagination-lg pager" id=""></ul>
                            </div>
                        </div>
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
        <script type="text/javascript" src="js/list.js"></script>
        <script src="http://listjs.com/no-cdn/list.pagination.js"></script>
        <script type="text/javascript" src="js/sweetalert.min.js"></script>
        <script type="text/javascript" src="js/sweetalert-dev.js"></script>
        <script type="text/javascript" src="js/noty/packaged/jquery.noty.packaged.min.js"></script>
        <script>
                                    function myswal() {
                                        swal({title: "加好友囉!", text: "請輸入好友帳號:", type: "input", showCancelButton: true, closeOnConfirm: false, animation: "slide-from-top", inputPlaceholder: "快給我輸入~~~~~"}, function (inputValue) {
                                            if (inputValue === false)
                                                return false;
                                            if (inputValue === "") {
                                                swal.showInputError("欸要輸入帳號啦!!不要偷懶!");
                                                return false
                                            }
                                            $.ajax({
                                                url: 'membercheck.php',
                                                dataType: 'text',
                                                type: 'POST',
                                                async: false,
                                                data: {
                                                    email: inputValue
                                                },
                                                error: function () {
                                                    alert('Ajax request 發生錯誤');
                                                },
                                                success: function (response) {
                                                    if (response == "N") {
                                                        swal("Oops!", "無法對此會員發出邀請", "error");
                                                    } else if (response == "A") {
                                                        swal("Oops...", "此帳號已經是你的好友", "error");
                                                    } else if (response ==<?php echo $_SESSION['MemberNo'] ?>) {
                                                        swal("Oops...", "不能加自己好友", "error");
                                                    } else {
                                                        $.ajax({
                                                            url: 'FriendRequest.php',
                                                            dataType: 'text',
                                                            type: 'POST',
                                                            async: false,
                                                            data: {
                                                                sentmember: '<?php echo $_SESSION['MemberNo'] ?>',
                                                                receivemember: response
                                                            },
                                                            error: function () {
                                                                alert('Ajax request 發生錯誤');
                                                            },
                                                            success: function (response) {
                                                                if (response == "Success") {
                                                                    swal("耐斯!", "你成功對 " + inputValue + "發出邀請", "success");
                                                                } else {
                                                                    swal("Oops!", "你對 " + inputValue + "發出邀請失敗", "error");
                                                                }
                                                            }
                                                        });
                                                    }
                                                }
                                            });
                                        });
                                    }
                                    function deletefriend(friendNo, name) {
                                        swal({
                                            title: "你有這麼討厭他嗎?",
                                            text: "Do you really hate him/her ?",
                                            type: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#DD6B55",
                                            confirmButtonText: "我就是討厭",
                                            closeOnConfirm: false
                                        }, function () {
                                            $.ajax({
                                                url: 'deleteFriend.php',
                                                dataType: 'text',
                                                type: 'POST',
                                                async: false,
                                                data: {
                                                    friendNo: friendNo,
                                                },
                                                error: function () {
                                                    alert('Ajax request 發生錯誤');
                                                },
                                                success: function () {
                                                    swal({
                                                        title: "耐斯!",
                                                        text: "你成功刪除好友" + name,
                                                        type: "success"
                                                    },
                                                    function () {
                                                        window.location.reload();
                                                    });
                                                }
                                            });
                                        });
                                    }
        </script>
        <script src="js/friends.js"></script>
        <script>
            var options = {
                valueNames: ['name'],
                page: 3,
                plugins: [
                    ListPagination({})
                ]
            };
            var friendList = new List('hacker-list', options);
        </script>

    </body>
</html>




