<!DOCTYPE html>
<?php
$No = filter_input(INPUT_GET, "No");
try {
    include('pdo_connect.php');
    $sql = "SELECT * FROM profile where MemberNo =?";
    $sth = $dbgo->prepare("$sql");
    $sth->execute(array("$No"));
    $profile = $sth->fetch();
    if ($profile['PhotoUrl'] == 0) {
        $image = 'image/photo.jpg';
    } else {
        $sql = "SELECT ImageUrl FROM image where ImageNo = ?";
        $sth = $dbgo->prepare("$sql");
        $sth->execute(array($profile['PhotoUrl']));
        $imageout = $sth->fetch();
        $image = $imageout['ImageUrl'];
    }
    $sql = "SELECT * FROM member_table where MemberNo=?";
    $sth = $dbgo->prepare("$sql");
    $sth->execute(array("$No"));
    $membertb = $sth->fetch();
    $email = $membertb['UserName'];
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$dbgo = null;
?>

<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="Shortcut Icon" type="image/x-icon" href="image/favicon.ico" />


        <title>ETrace</title>
        <meta name="author" content="Alvaro Trigo Lopez" />
        <meta name="description" content="fullPage fixed header and footer." />
        <meta name="keywords"  content="fullpage,jquery,demo,screen,fixed, header,footer, absolute, positioned,css" />
        <meta name="Resource-type" content="Document" />

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
            <!-- Bootstrap theme -->
            <link href="css/bootstrap-theme.min.css" rel="stylesheet">
                <!-- Custom styles for this template -->
                <link href="css/theme.css" rel="stylesheet">	
                    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
                        <link rel="stylesheet" type="text/css" href="css/jquery.fullPage.css"/>
                        <link rel="stylesheet" type="text/css" href="css/examples.css" />
                        <link rel="stylesheet" type="text/css" href="css/animate.css" />
                        <!--[if IE]>
                                <script type="text/javascript">
                                         var console = { log: function() {} };
                                </script>
                        <![endif]-->

                        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
                        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                        <!-- Include all compiled plugins (below), or include individual files as needed -->
                        <script src="js/bootstrap.min.js"></script>
                        <script type="text/javascript" src="js/jquery.fullPage.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $('#fullpage').fullpage({
                                    anchors: ['firstPage', 'secondPage', '3rdPage', '4thPage', '5thPage', '6thPage'],
                                    sectionsColor: ['#22b14c', 'rgba(134,205,215,.7)', 'rgba(255,187,187,.7)', 'rgba(134,205,215,.7)', 'rgba(255,187,187,.7)', 'rgba(134,205,215,.7)'],
                                    css3: true,
                                    continuousVertical: true,
                                    navigation: true,
                                    navigationPosition: 'right',
                                    navigationTooltips: ['個人介紹', '生日 / 年齡', '籍貫 / 現居地', '興趣', '專長', '學歷']
                                });
                            });
                        </script>
                        <script src="picturefill.js"></script>
                        </head>
                        <body>
                            <nav class="navbar navbar-inverse navbar-fixed-top">
                                <div class="container">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                        <a class="navbar-brand" href="index.php"><img src="image/logo.png" height="50px" ></a>
                                    </div> 
                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                                        <ul class="nav navbar-nav navbar-right">					

                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <div id="fullpage">
                                <div class="section " id="section0">
                                    <div class="intro">
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4 col-sm-12 col-xs-12 col-lg-offset-1 col-lg-4">
                                                <div class="row">
                                                    <?php
                                                    echo '<img src="' . "$image" . '" id="selfphoto">';
                                                    ?>
                                                </div>
                                                <div class="row">
                                                    </br>
                                                    <!--中文名字-->
                                                    <h1 style="text-align:center;">								
                                                        <?php
                                                        echo "$profile[0]";
                                                        ?></h1>	
                                                    <!--英文名字-->
													<p style="text-align:center;width:90%;" id="profile-name">
                                                        <?php
                                                        echo "$profile[4]";
                                                        ?></p>
                                                    <!--email-->
                                                    <p id="profile-name"><?php
                                                        echo "$email";
                                                        ?></p>		
                                                </div>
                                                <picture class="section1-img">
													<source srcset="image/contact-middle.png" media="(min-width: 990px)" >
														<source srcset="image/contact-middle.png" media="(min-width: 720px)">
															<source srcset="image/contact-small.png" media="(min-width: 500px)">
                                                                <source srcset="image/contact-small.png" media="(max-width: 480px)">
                                                                    <img src="image/contact-small.png" alt="">
                                                                        </picture>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6" style="text-align:center;">				  	  
                                                                            <div id="selfintro">
																				<p id="profile-intro" class="col-md-10 col-md-offset-2 scroll" style="word-wrap:break-word;">
																				    <!--自我介紹-->
																				    <?php
                                                                                    echo "$profile[11]";
                                                                                    ?>
																				</p>
																			</div>					 
                                                                        </div>
                                                                        </div>
                                                                        </div>
                                                                        </div>
                                                                        <div class="section" id="section1">
                                                                            <div class="intro">
                                                                                <div class="row">
                                                                                    <div class="col-md-offset-1 col-md-5 col-sm-12">
                                                                                        <div class="row">
                                                                                            <h1 id="bd">
                                                                                                <!--生日-->
                                                                                                <?php
                                                                                                echo "$profile[5]";
                                                                                                ?></h1>
                                                                                            <h1 id="age">
                                                                                                <!--年齡-->
                                                                                                <?php
                                                                                                if ($profile[5] != NULL) {
                                                                                                    $birthDate = explode("-", $profile[5]);
                                                                                                    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") ? ((date("Y") - $birthDate[0]) - 1) : (date("Y") - $birthDate[0]));
                                                                                                    echo "$age" . '歲';
                                                                                                }
                                                                                                ?></h1>
                                                                                        </div>					
                                                                                    </div>
                                                                                    <div class="col-md-5 col-sm-12">
                                                                                        <picture>
                                                                                            <source srcset="image/egg6-large.png" media="(min-width: 990px)">
                                                                                                <source srcset="image/egg6-middle.png" media="(min-width: 720px)">
                                                                                                    <source srcset="image/egg6-small.png" media="(min-width: 500px)">
                                                                                                        <source srcset="image/egg6-small.png" media="(max-width: 480px)">
                                                                                                            <img src="image/egg6-small.png" alt="">
                                                                                                                </picture>					  
                                                                                                                </div>
                                                                                                                </div>
                                                                                                                </div>
                                                                                                                </div>
                                                                                                                <div class="section" id="section2">
                                                                                                                    <div class="intro">
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-md-offset-1 col-md-5 col-sm-12">
                                                                                                                                <picture>
                                                                                                                                    <source srcset="image/mark-large.png" media="(min-width: 990px)">
                                                                                                                                        <source srcset="image/mark-middle.png" media="(min-width: 720px)">
                                                                                                                                            <source srcset="image/mark-small.png" media="(min-width: 500px)">
                                                                                                                                                <source srcset="image/mark-small.png" media="(max-width: 480px)">
                                                                                                                                                    <img src="image/mark-small.png" alt="">
                                                                                                                                                        </picture>
                                                                                                                                                        </div>
                                                                                                                                                        <div class="col-md-5 col-sm-12">
                                                                                                                                                            <!--籍貫/現居地-->
                                                                                                                                                            <h1 id="fromandlive">來自<?php
                                                                                                                                                                echo "$profile[8]";
                                                                                                                                                                ?></h1>
                                                                                                                                                            <h1>現居<?php
                                                                                                                                                                echo "$profile[7]";
                                                                                                                                                                ?></h1>
                                                                                                                                                        </div>
                                                                                                                                                        </div>
                                                                                                                                                        </div>
                                                                                                                                                        </div>
                                                                                                                                                        <div class="section" id="section3">
                                                                                                                                                            <div class="intro">
                                                                                                                                                                <div class="row ">

                                                                                                                                                                    <div class="col-md-offset-1 col-md-2 col-sm-12">
                                                                                                                                                                        <picture>
                                                                                                                                                                            <source srcset="image/interest-large.png" media="(min-width: 990px)">
                                                                                                                                                                                <source srcset="image/interest-middle.png" media="(min-width: 720px)">
                                                                                                                                                                                    <source srcset="image/interest-small.png" media="(min-width: 500px)">
                                                                                                                                                                                        <source srcset="image/interest-small.png" media="(max-width: 480px)">
                                                                                                                                                                                            <img src="image/interest-small.png" alt="">
                                                                                                                                                                                                </picture>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                <div  class="col-md-6 col-xs-offset-2 col-xs-8 col-sm-offset-2 col-sm-8">
                                                                                                                                                                                                    <!--興趣-->
                                                                                                                                                                                                    <h1 id="interest" class="scroll"><?php
                                                                                                                                                                                                        echo "$profile[9]";
                                                                                                                                                                                                        ?></h1>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                <div class="section" id="section4">
                                                                                                                                                                                                    <div class="intro">
                                                                                                                                                                                                        <div class="row">
                                                                                                                                                                                                        <div class="col-md-offset-1 col-md-2 col-sm-12">
                                                                                                                                                                                                        <picture>
                                                                                                                                                                                                        <source srcset="image/skill-large.png" media="(min-width: 990px)">
                                                                                                                                                                                                        <source srcset="image/skill-middle.png" media="(min-width: 720px)">
                                                                                                                                                                                                        <source srcset="image/skill-small.png" media="(min-width: 500px)">
                                                                                                                                                                                                        <source srcset="image/skill-small.png" media="(max-width: 480px)">
                                                                                                                                                                                                        <img src="image/skill-small.png" alt="">
                                                                                                                                                                                                        </picture>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                        <div class="col-md-6 col-xs-offset-2 col-xs-8 col-sm-offset-2 col-sm-8">
                                                                                                                                                                                                        <!--技能-->
                                                                                                                                                                                                        <h1 id="skill" class="scroll"><?php
                                                                                                                                                                                                                                                echo "$profile[10]";
                                                                                                                                                                                                                                                ?></h1>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                        <div class="section" id="section5">
                                                                                                                                                                                                        <div class="intro">
                                                                                                                                                                                                        <div class="row">
                                                                                                                                                                                                        <div class="col-md-5 col-sm-12">
                                                                                                                                                                                                        <!--學歷-->
                                                                                                                                                                                                        <h1 id="edu"><?php
																																																			echo "$profile[2]";
																																																			?></h1>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                        <div class="col-md-6 col-sm-12">
                                                                                                                                                                                                        <picture>
                                                                                                                                                                                                        <source srcset="image/education-figure-large.png" media="(min-width: 990px)">
                                                                                                                                                                                                        <source srcset="image/education-figure-middle.png" media="(min-width: 720px)">
                                                                                                                                                                                                        <source srcset="image/education-figure-small.png" media="(min-width: 500px)">
                                                                                                                                                                                                        <source srcset="image/education-figure-small.png" media="(max-width: 480px)">
                                                                                                                                                                                                        <img src="image/education-figure-small.png" alt="">
                                                                                                                                                                                                        </picture>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                        </div>

                                                                                                                                                                                                        <script src="js/friends.js"></script>
                                                                                                                                                                                                        <script type="text/javascript" src="js/storyjs-embed.js"></script>
                                                                                                                                                                                                        <script type="text/javascript" src="js/noty/packaged/jquery.noty.packaged.min.js"></script>
                                                                                                                                                                                                        </body>
                                                                                                                                                                                                        </html>