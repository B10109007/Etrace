<?php
session_start();
$No = filter_input(INPUT_GET, "No");
$MemberNo = $_SESSION['MemberNo'];
$email = $_SESSION['UserName'];
try {
    include('../pdo_connect.php');
    $sql = "SELECT * FROM output where OutputNo=?";
    $sth = $dbgo->prepare("$sql");
    $sth->execute(array("$No"));
    $output = $sth->fetchAll();
    $sql = "SELECT * FROM verticalexistresult where VerticalNo=?";
    $sth = $dbgo->prepare("$sql");
    $sth->execute(array($output[0]['OutputNo']));
    $existresult = $sth->fetchAll();
    $sql = "SELECT * FROM profile where MemberNo =?";
    $sth = $dbgo->prepare("$sql");
    $sth->execute(array("$MemberNo"));
    $profile = $sth->fetchAll();
    if ($profile[0]['PhotoUrl'] == 0) {
        $image = 'image/photo.jpg';
    } else {
        $sql = "SELECT ImageUrl FROM image where ImageNo = ?";
        $sth = $dbgo->prepare("$sql");
        $sth->execute(array($profile[0]['PhotoUrl']));
        $imageout = $sth->fetchAll();           
        $image =$imageout[0]['ImageUrl'];
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$dbgo = null;
?>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="Shortcut Icon" type="image/x-icon" href="../image/favicon.ico" />
        <style>
            body.modal-open-noscroll {
                margin-right: 0!important;
                overflow: hidden;
            }
            .modal-open-noscroll .navbar-fixed-top, .modal-open .navbar-fixed-bottom {
                margin-right: 0!important;
            }
        </style> <!--ModalBugFixed-->
        <link href='http://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'>
        <link href="../css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap core CSS -->
        <link href="../css/theme.css" rel="stylesheet"> <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
        <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
        <link rel="stylesheet" href="css/custo.css"> <!-- new style -->
        <script src="js/modernizr.js"></script> <!-- Modernizr -->
        <link href="../css/bootstrap-datepicker.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.css" rel="stylesheet">
        <title>新增分享 - ETrace</title>
    </head>
    <body>
        
		<header>
		<div class="row">
		<div class="col-md-4 col-sm-8 col-xs-12  col-lg-4">
            <div id="header-left">
                <h1 id="title"><?php echo $output[0]['Title']; ?></h1>
            </div>
		</div>
		<div class="col-md-offset-5 col-md-3 col-sm-4 col-xs-12 col-lg-5 col-lg-offset-3">
            <div id="header-right">
                <?php
                echo '<img src="../' . $image . '" alt="..." class="abc" height="100" width="100"></br></br>';
                ?>
                <h2><?php echo $profile[0]['Name'] . " " . $profile[0]['EngName'] ?></h2></br>
                <p><?php echo $profile[0]['Birth'] ?></p></br>
                <p><?php echo "$email" ?></p>
            </div>	
		</div>	
		</div>	
        </header>

        <section id="cd-timeline" class="cd-container">
            <?php
            foreach ($existresult as $row) {
                try {
                    include('../pdo_connect.php');
                    $sql = "SELECT * FROM result where ResultNo=?";
                    $sth = $dbgo->prepare("$sql");
                    $sth->execute(array("$row[0]"));
                    $result = $sth->fetchAll();
                    $sql = "SELECT * FROM file where ResultNo=?";
                    $sth = $dbgo->prepare("$sql");
                    $sth->execute(array("$row[0]"));
                    $file = $sth->fetch();
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                $dbgo = null;                
                echo '<div class="cd-timeline-block" name="resultblock" id="' . $row[0] . '">';
                if ($result[0]['MediaUrl'] !== ""){
                echo '<div class="cd-timeline-img cd-movie">';
                echo '<img src="img/cd-icon-movie.svg" alt="Movie">';                              
                echo '</div>';    
                } else if(preg_match("/image/",$file['FileType'])) {
                echo '<div class="cd-timeline-img cd-picture">';
                echo '<img src="img/cd-icon-picture.svg" alt="Picture">';                              
                echo '</div>';
                } else {
                echo '<div class="cd-timeline-img cd-location">';
                echo '<img src="img/cd-icon-location.svg" alt="Location">';                              
                echo '</div>';    
                }
                echo '<div class="cd-timeline-content">';              
                echo '<h2 class="ellipsis" >' . $result[0]['Title'] . '</h2>';
                echo '<p class="ellipsis">' . $result[0]['Content'] . '</p>';               
                if (stripos($file['FileType'], "image")!==FALSE) {                    
                    echo '<img class="imgsize" src="' . '../' . $file['FileUrl'] . '"></br></br>';
                }
                if ($result[0]['MediaUrl'] !== "") {
                    echo ' <div class="video-container"><iframe src="' . 'https://www.youtube.com/embed/' . substr($result[0]['MediaUrl'], 17) . '" frameborder="0" allowfullscreen></iframe></div></br>';
                }
                echo '<button type="button" class="btn btn-more" id="more" target="_blank" data -toggle="modal"  data-target="#moreachi" onclick="showresult(' . "'../ajaxResult.php'" . ',' . "$row[0]" . ')">More</button>&nbsp;';
                echo '<span class="cd-date">' . date('Y/m/d',strtotime($result[0]['StartTime'])) . '</span>';
                echo '</div> <!-- cd-timeline-content -->';
                echo '</div> <!-- cd-timeline-block -->';
            }
            ?>


        </section> <!-- cd-timeline -->

        <!-- More -->
        <div class="modal fade bs-example-modal-lg" id="moreachi" tabindex="-1" role="dialog" aria-labelledby="moreLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="font-weight: bold" id="moreLabel">太白粉路跑</h4>
                    </div>
                    <div class="modal-body">
                        <blockquote>
                            <span class="glyphicon glyphicon-flag" aria-hidden="true"></span> <div style="display:inline">&nbsp;<span class="label label-success" id="moreclassify">運動</span></div>
                            <hr>
                            <span class="glyphicon glyphicon-calendar" aria-hidden="true" ></span><div id="morestarttime" style="display:inline">&nbsp;2014/09/16</div>
                            <hr>
                            <span class="glyphicon glyphicon-comment" aria-hidden="true"></span><div id="morecontent" style="display:inline;word-wrap:break-word;line-height:20px;">&nbsp;大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。</div>
                            <hr>
                            <span class="glyphicon glyphicon-paperclip" aria-hidden="true"><div class="form-group fs" style="display:inline;">&nbsp;<a id="morefile"></a></div></span>
                            <hr>
                            <span class="glyphicon glyphicon-picture" aria-hidden="true"></span><div><img id="moreimage" class="im"></div>
                            <hr>
                            <span class="glyphicon glyphicon-film" aria-hidden="true"></span><div id="moreiframe" style="display:inline" class="video-container"><iframe id="moreyoutube" src="https://www.youtube.com/embed/EwWWNuDdC20" frameborder="0" allowfullscreen></iframe></div>
                        </blockquote>       
                    </div>
                    <div class="modal-footer">                                         
                        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>                      
                    </div>
                </div>
            </div>
        </div>  
        <!-- More End -->

        <div style="text-align:center">
            <a href="../share2.php"><button type="button" class="btn btn-info btn-summit">返回</button></a> 
        </div>	
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/main.js"></script> <!-- Resource jQuery -->
        <script src="../js/bootstrap.min.js"></script>        
        <script src="../js/jquery.form.js"></script>
        <script src="../js/result.js"></script>        
        <script src="js/preview.js"></script>
        <script src="../js/bootstrap-datepicker.min.js"></script>
        <script src="../js/tsai.js"></script>
    </body>
</html>
