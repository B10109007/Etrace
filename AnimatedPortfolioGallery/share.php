<!DOCTYPE html>
<?php
$No = filter_input(INPUT_GET, "No");
try {
    include('../pdo_connect.php');
    $sql = "SELECT * FROM output where OutputNo=?";
    $sth = $dbgo->prepare("$sql");
    $sth->execute(array("$No"));
    $output = $sth->fetchAll();
    if($output[0]['shareKey']!== filter_input(INPUT_GET, "Key")){
    header("Location:../error.php");
    }
    $sql = "SELECT * FROM verticalexistresult where VerticalNo=?";
    $sth = $dbgo->prepare("$sql");
    $sth->execute(array($output[0]['OutputNo']));
    $existresult = $sth->fetchAll();    
    $sql = "SELECT * FROM profile where MemberNo =?";
    $sth = $dbgo->prepare("$sql");
    $MemberNo=$output[0]['MemberNo'];
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
    $sql = "SELECT * FROM member_table where MemberNo=?";
    $sth = $dbgo->prepare("$sql");
    $sth->execute(array("$MemberNo"));
    $membertb = $sth->fetchAll();
    $email=$membertb[0]['UserName'];
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$dbgo = null;
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <link rel="Shortcut Icon" type="image/x-icon" href="../image/favicon.ico" />


        <title><?php echo $output[0]['Title']; ?> - ETrace</title>

        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/bootstrap-datepicker.css" rel="stylesheet">
        <link href="../css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/chi-style2.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="../css/chi-modal.css">	
        <link rel="stylesheet" href="../css/chi.css">
        <link rel="stylesheet" href="../css/animate.css">
        <link href="../css/checkbox-radio-button.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/sweetalert.css">			
        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>		
        <script src="js/cufon-yui.js" type="text/javascript"></script>
        <script src="js/Quicksand_Book_400.font.js" type="text/javascript"></script>
         <link href="../css/lightbox.css" rel="stylesheet">
        <!-- <script type="text/javascript">Cufon.replace('h1,h2');</script>-->		
        <style type="text/css">
            h1.title{
                position:absolute;
                width:300px;
                height:70px;
                right:0px;
                top:-20px;
                font-weight:normal;
                text-transform:uppercase;
                font-size:45px;
                color:#fff;
                background:transparent url(bg.png) repeat top left;
                padding:10px 15px 10px 15px;
                text-align:center;
            }	
            .video-container {
                position: relative;
                padding-bottom: 56.25%;
                padding-top: 30px;
                height: 0;
                overflow: hidden;
            }
            .video-container iframe {
                position: absolute;
                top:0;
                left: 0;
                width: 100%;
                height: 100%;
            }
        </style>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <h1 class="title"><?php echo $output[0]['Title']; ?></h1>

        <div class=" profileframe">
            <?php
            echo '<img src="../' . $image . '" alt="..." class="photo size-a"></br></br>';
            ?>
            <div class="profilefont">
                <h3><?php echo $profile[0]['Name'] . " " . $profile[0]['EngName'] ?></h3></br>
                <p><?php echo $profile[0]['Birth'] ?></p></br>
                <p><?php echo "$email"; ?></p>
            </div>
        </div>
        <?php
        $count = 0;
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
                $pg_title[] = $result[0]['Title'];
                $thumbcontainer[$count][0] = $result[0]['ResultNo'];
                $thumbcontainer[$count][1] = $result[0]['Title'];
                $thumbcontainer[$count][2] = $file['FileType'];
                if ($result[0]['MediaUrl'] !== "") {
                    $thumbcontainer[$count][4] = $result[0]['MediaUrl'];
                } else {
                    $thumbcontainer[$count][4] = "";
                }
                $pg_preview[$count]['title']=$result[0]['Title'];
                if (stripos($file['FileType'], "image") !== false) {
                    $pg_preview[$count]['url'] = $file['FileUrl'];
                    $thumbcontainer[$count][3] = $file['FileUrl'];
                } else {
                    if ($result[0]['MediaUrl'] !== "") {
                       $pg_preview[$count]['url'] = 'http://img.youtube.com/vi/' . substr($result[0]['MediaUrl'], 17) . '/0.jpg';
                    } else {
                       $pg_preview[$count]['url']= "";
                    }
                }

                $pg_desc1[$count][0] = $result[0]['Content'];
                $pg_desc1[$count][1] = $result[0]['StartTime'];
                $pg_desc1[$count][2] = $result[0]['ResultNo'];
                $count++;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        $dbgo = null;
        ?>   
        <div class="pg_content">
            <div id="pg_title" class="pg_title">
                <?php
                $count = 0;
                if(isset($pg_title)){
                foreach ($pg_title as $value) {
                    if ($count === 0) {
                        echo '<h1 style="display:block;top:25px;" name="title' . $value . '" >' . $value . '</h1>';
                    } else {
                        echo '<h1 name="title' . $value . '" >' . $value . '</h1>';
                    }
                    $count++;
                }
                }
                ?>
            </div>
            <div id="pg_preview">
                <?php
                $count = 0;
                if(isset($pg_preview)){
                foreach ($pg_preview as $value) {
                    if ($count === 0) {
                        if ($value['url'] !== "") {
                            echo '<a href="' . '../' . $value['url'] . '" data-lightbox="image-1" data-title="'.$value['title'].'"><img class="pg_thumb" style="display:block;z-index:9999;" src="' . '../' . $value['url'] . '"/></a>';
                        } elseif (strpos($value['url'], "img.youtube.com")) {
                            echo '<img class="pg_thumb" style="display:block;z-index:9999;" src="' . $value['url'] . '" alt="' . $value['url'] . '"target="_blank" data-toggle="modal" data-target="#showyt"/>';
                        }else {
                            echo '<a href="' . '../' . $value['url'] . '" data-lightbox="image-1" data-title="'.$value['title'].'"><img class="pg_thumb" style="display:block;z-index:9999;" src="images/default.jpg" alt="images/default.jpg"/></a>';
                        }
                    } else {
                        if ($value['url'] !== "" && !strpos($value['url'], "img.youtube.com")) {
                            echo '<a href="' . '../' . $value['url'] . '" data-lightbox="image-1" data-title="'.$value['title'].'"><img class="pg_thumb" src="' . '../' . $value['url'] . '" alt="' . '../' . $value['url'] . '"/></a>';
                        } elseif (strpos($value['url'], "img.youtube.com")) {
                            echo '<img class="pg_thumb" src="' . $value['url'] . '" alt="' . $value['url'] . '"target="_blank" data-toggle="modal" data-target="#showyt"/>';
                        } else {
                            echo '<a href="images/default.jpg" data-lightbox="image-1" data-title="'.$value['title'].'"><img class="pg_thumb" src="images/default.jpg" alt="images/default.jpg"/></a>';
                        }
                    }
                    $count++;
                }}
                ?>
            </div>
            <div id="pg_desc1" class="pg_description">  
                <?php
                $count = 0;
                if(isset($pg_desc1)){
                foreach ($pg_desc1 as $value) {
                    if ($count === 0) {
                        echo '<div style="display:block;left:250px;">';
                    } else {
                        echo '<div>';
                    }
                    echo '<h2>';
                    echo '<button class="toolline" id="pic" target="_blank" data-toggle="modal"  data-target="#showpic"><i class="fa fa-picture-o" aria-hidden="true"></i></button>';
                    echo '<button class="toolline" id="file" target="_blank" data-toggle="modal"  data-target="#showfile"><i class="fa fa-paperclip" aria-hidden="true"></i></button>';
                    echo '<button class="toolline" id="youtube" target="_blank" data-toggle="modal"  data-target="#showyt"><i class="fa fa-youtube-play" aria-hidden="true"></i></button>';
                    echo '<button type="button" class="style2-btn-more fa fa-info" target="_blank" data-toggle="modal" data-target="#moreachi"></button>';
                    echo '</h2>';
                    echo '<p>';
                    echo '<i class="fa fa-clock-o" aria-hidden="true">&nbsp;&nbsp;' . date('Y-m-d',strtotime($value[1])) . '</i>';
                    echo '<br>';
                    echo '<i style="line-height:30px;" class="fa fa-comment" aria-hidden="true">&nbsp;&nbsp;' . $value[0] . '</i>';
                    echo '</p>';
                    echo '</div>';
                    $count++;
                }}
                ?>
            </div>
        </div>	
        <!-- 選擇視窗 Start -->
        <div style="height: 100%;z-index:9999;" class="modal bs-example-modal-sm"  id="addoptModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm rubberBand animated" id="addoptdialog">
                <div class="modal-content" id="addoptcont">
                    <div class="modal-body text-center">
                        <button class="btn-add2" target="_blank" data-toggle="modal" data-target="#exampleModal">新增</button>
                        <!-- <button class="btn btn-info" data-toggle="modal" data-target="#addResultModal">選擇現有</button>-->
                        <!-- <button class="md-trigger btn btn-info" data-toggle="md-2-modal" data-target="#modal-2" data-modal="modal-2">choose</button> -->
                        <!-- <button class="md-trigger btn btn-info" data-toggle="md-3-modal" data-target="#modal-3" data-modal="modal-3">增特效成果</button> -->
                        <button class="btn-radius" data-toggle="modal" data-target="#addResultModal">選擇現有</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 選擇視窗 END -->
        <!-- 新增成果 -->
        <div class="modal fade" style="z-index:9999;" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog pull-left modal-sm slideInLeft animated" id="exampleModaldia">
                <div class="modal-content" id="exampleModalContent">
                    <form name="form1" id="form1" method="post" action="addResult.php" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">新增成果</h4>
                        </div>

                        <div class="modal-body">

                            <div class="form-group">
                                <label for="InputTitle">標題</label>
                                <input type="text" class="form-control"id="InputTitle" placeholder="Title" name="Title">
                            </div>
                            <div class="form-group">
                                <label for="InputClassify">分類</label>
                                <div class="form-group">
                                    <div class="btn-group" id="InputClassify" data-toggle="buttons">                                                  
                                        <?php
                                        if ($classrow[0] != NULL) {
                                            echo '<label class="btn btn-default">';
                                            echo '<input type="radio" name="classify" value="' . "$classrow[0]" . '"/>' . "$classrow[0]" . '</label> ';
                                        }
                                        if ($classrow[1] != NULL) {
                                            echo '<label class="btn btn-primary">';
                                            echo '<input type="radio" name="classify" value="' . "$classrow[1]" . '"/>' . "$classrow[1]" . '</label> ';
                                        }
                                        if ($classrow[2] != NULL) {
                                            echo '<label class="btn btn-success">';
                                            echo '<input type="radio" name="classify" value="' . "$classrow[2]" . '"/>' . "$classrow[2]" . '</label> ';
                                        }
                                        if ($classrow[3] != NULL) {
                                            echo '<label class="btn btn-info">';
                                            echo '<input type="radio" name="classify" value="' . "$classrow[3]" . '"/>' . "$classrow[3]" . '</label> ';
                                        }
                                        if ($classrow[4] != NULL) {
                                            echo '<label class="btn btn-warning">';
                                            echo '<input type="radio" name="classify" value="' . "$classrow[4]" . '"/>' . "$classrow[4]" . '</label> ';
                                        }
                                        if ($classrow[5] != NULL) {
                                            echo '<label class="btn btn-danger">';
                                            echo '<input type="radio" name="classify" value="' . "$classrow[5]" . '"/>' . "$classrow[5]" . '</label> ';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Time">時間</label><br>
                                <div id="sandbox-container">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="input-sm form-control" id="InputStartTime" name="StartTime" value="<?php echo date('Y-m-d'); ?>">
                                        <span class="input-group-addon">to</span>
                                        <input type="text" class="input-sm form-control" id="EndTime" name="EndTime" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="InputContext">描述</label>
                                <textarea class="form-control" id="InputContext" placeholder="Context" rows="8" style="resize: none" name="content"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="InputYoutube">Youtube影片網址</label>
                                <input type="text" class="form-control" id="InputYoutube" placeholder="https://youtu.be/" name="youtube">
                            </div>
                            <div class="form-group">
                                <label for="InputFile">檔案上傳</label>
                                <input type="file" id="InputFile" name="file">
                                <p class="help-block">支援圖片檔、壓縮檔</p>
                            </div> 
                        </div>
                        <div class="modal-footer">                 
                            <input type="submit" class="btn btn-primary" value="新增" />
                            <button type="button" class="btn btn-default" data-dismiss="modal" >取消</button>						
                        </div>
                    </form>
                </div>
            </div>
        </div>	
        <!-- 新增成果End -->
        <div class="modal fade" style="z-index:9999;" id="addResultModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog pull-right modal-sm  slideInRight animated" id="exampleModaldia">
                <div class="modal-content"  id="addResultContent">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">選擇現有成果</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container addresultstyle">
                            <?php
                            echo '<label class="classname">' . $classrow[0] . '</label></br>';
                            $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[0]'");
                            while ($resultrow = mysql_fetch_row($resultresult)) {
                                echo '<label class="resultname"><input name="result" type="radio" value="' . "$resultrow[0]" . '"/><i></i>&nbsp;' . "$resultrow[1]" . '</label></br>';
                            }
                            echo '<label class="classname">' . $classrow[1] . '</label></br>';
                            $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[1]'");
                            while ($resultrow = mysql_fetch_row($resultresult)) {
                                echo '<label class="resultname"><input name="result" type="radio" value="' . "$resultrow[0]" . '"/><i></i>&nbsp;' . "$resultrow[1]" . '</label></br>';
                            }
                            echo '<label class="classname">' . $classrow[2] . '</label></br>';
                            $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[2]'");
                            while ($resultrow = mysql_fetch_row($resultresult)) {
                                echo '<label class="resultname"><input name="result" type="radio" value="' . "$resultrow[0]" . '"/><i></i>&nbsp;' . "$resultrow[1]" . '</label></br>';
                            }
                            echo '<label class="classname">' . $classrow[3] . '</label></br>';
                            $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[3]'");
                            while ($resultrow = mysql_fetch_row($resultresult)) {
                                echo '<label class="resultname"><input name="result" type="radio" value="' . "$resultrow[0]" . '"/><i></i>&nbsp;' . "$resultrow[1]" . '</label></br>';
                            }
                            echo '<label class="classname">' . $classrow[4] . '</label></br>';
                            $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[4]'");
                            while ($resultrow = mysql_fetch_row($resultresult)) {
                                echo '<label class="resultname"><input name="result" type="radio" value="' . "$resultrow[0]" . '"/><i></i>&nbsp;' . "$resultrow[1]" . '</label></br>';
                            }
                            echo '<label class="classname">' . $classrow[5] . '</label></br>';
                            $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[5]'");
                            while ($resultrow = mysql_fetch_row($resultresult)) {
                                echo '<label class="resultname"><input name="result" type="radio" value="' . "$resultrow[0]" . '"/><i></i>&nbsp;' . "$resultrow[1]" . '</label></br>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="saveResult($('input:radio[name=result]:checked').val())">儲存</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Showpic -->
        <div class="modal fade" id="showpic" style="z-index:9999;" tabindex="-1" role="dialog" aria-labelledby="showpicLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="font-weight: bold" id="showpicLabel">圖片</h4>
                    </div>
                    <div class="modal-body">
                        <blockquote>

                            <span class="glyphicon glyphicon-picture" aria-hidden="true"></span><div><img id="moreimage1" class="im"></div>

                        </blockquote>       
                    </div>
                    <div class="modal-footer">                                         
                        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>                      
                    </div>
                </div>
            </div>
        </div>  
        <!-- Showpic End -->

        <!-- Showfile -->
        <div class="modal fade" id="showfile" style="z-index:9999;" tabindex="-1" role="dialog" aria-labelledby="showfileLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="font-weight: bold" id="showfileLabel">檔案</h4>
                    </div>
                    <div class="modal-body">
                        <blockquote>

                            <span class="glyphicon glyphicon-paperclip" aria-hidden="true"><div class="form-group fs" style="display:inline;">&nbsp;<a id="morefile1"></a></div></span>

                        </blockquote>       
                    </div>
                    <div class="modal-footer">                                         
                        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>                      
                    </div>
                </div>
            </div>
        </div>  
        <!-- Showfile End -->

        <!-- Showyt -->
        <div class="modal fade bs-example-modal-sm" id="showyt" style="z-index:9999;" tabindex="-1" role="dialog" aria-labelledby="showytLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="font-weight: bold" id="showytLabel">Youtube影片</h4>
                    </div>
                    <div class="modal-body">
                        <blockquote>

                            <span class="glyphicon glyphicon-film" aria-hidden="true"></span><div id="moreiframe1" class="video-container"><iframe id="moreyoutube1" src="https://www.youtube.com/embed/EwWWNuDdC20" frameborder="0" allowfullscreen></iframe></div>

                        </blockquote>       
                    </div>
                    <div class="modal-footer">                                         
                        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>                      
                    </div>
                </div>
            </div>
        </div>  
        <!-- Showyt End -->

        <!-- More -->
        <div class="modal fade bs-example-modal-lg" style="z-index:9999;" id="moreachi" tabindex="-1" role="dialog" aria-labelledby="moreLabel" aria-hidden="true">
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
                            <span class="glyphicon glyphicon-film" aria-hidden="true"></span><div id="moreiframe" class="video-container"><iframe id="moreyoutube" src="https://www.youtube.com/embed/EwWWNuDdC20" frameborder="0" allowfullscreen></iframe></div>
                        </blockquote>       
                    </div>
                    <div class="modal-footer">                                         
                        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>                      
                    </div>
                </div>
            </div>
        </div>  
        <!-- More End -->
        <!-- Edit Start -->
        <div class="modal fade" id="editachi" style="z-index:9999;" tabindex="-1" role="dialog" aria-labelledby="editachiLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="editachiLabel">編輯成果</h4>
                    </div>
                    <form name="editResult" id="editResult" method="post" action="editResult.php" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="InputTitle" >標題</label>
                                <input type="text" class="form-control"  placeholder="Title" id="edittitle" name="edittitle">
                            </div>
                            <div class="form-group">
                                <div class="btn-group" id="InputClassify" data-toggle="buttons">                                                  
                                    <?php
                                    if ($classrow[0] != NULL) {
                                        echo '<label class="btn btn-default">';
                                        echo '<input type="radio" name="editresultclass" value="', "$classrow[0]", '"/>' . "$classrow[0]" . '</label> ';
                                    }
                                    if ($classrow[1] != NULL) {
                                        echo '<label class="btn btn-primary">';
                                        echo '<input type="radio" name="editresultclass" value="', "$classrow[1]", '"/>' . "$classrow[1]" . '</label> ';
                                    }
                                    if ($classrow[2] != NULL) {
                                        echo '<label class="btn btn-success">';
                                        echo '<input type="radio" name="editresultclass" value="', "$classrow[2]", '"/>' . "$classrow[2]" . '</label> ';
                                    }
                                    if ($classrow[3] != NULL) {
                                        echo '<label class="btn btn-info">';
                                        echo '<input type="radio" name="editresultclass" value="', "$classrow[3]", '"/>' . "$classrow[3]" . '</label> ';
                                    }
                                    if ($classrow[4] != NULL) {
                                        echo '<label class="btn btn-warning">';
                                        echo '<input type="radio" name="editresultclass" value="', "$classrow[4]", '"/>' . "$classrow[4]" . '</label> ';
                                    }
                                    if ($classrow[5] != NULL) {
                                        echo '<label class="btn btn-danger">';
                                        echo '<input type="radio" name="editresultclass" value="', "$classrow[5]", '"/>' . "$classrow[5]" . '</label> ';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Time">時間</label><br>
                                <div id="sandbox-container">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="input-sm form-control" id="editStartTime" name="editStartTime" value="<?php echo date('m/d/Y'); ?>">
                                        <span class="input-group-addon">to</span>
                                        <input type="text" class="input-sm form-control" id="editEndTime" name="editEndTime" value="<?php echo date('m/d/Y'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="InputContext" >描述</label>
                                <textarea class="form-control" id="editcontent" placeholder="Context" rows="8" name="editcontent" style="resize:none"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="InputYoutube">Youtube影片網址</label>
                                <input type="text" class="form-control" id="edityoutube" name="edityoutube" placeholder="https://youtu.be/">
                            </div>
                            <div class="form-group">
                                <label for="InputFile">檔案上傳</label>
                                <input type="file" id="editfile" name="editfile">
                                <p class="help-block">支援圖片檔、壓縮檔</p>
                            </div>  

                        </div>
                        <div class="modal-footer">
                            <input type="text" hidden="true" id="editResultNo" name="editResultNo">
                            <input type="submit" class="btn btn-primary" value="編輯">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>						
                        </div>
                    </form>
                </div>
            </div>
        </div>	
        <!-- Edit End -->
        <div id="thumbContainter">
            <div id="thumbScroller">
                <div id="thumbcontainer" class="container"> 
                    <?php
                    if(isset($thumbcontainer)){
                    foreach ($thumbcontainer as $value) {
                        echo '<div class="content" onclick="showresult(' . '\'../ajaxResult.php\'' . ',' . $value[0] . ')"  name="resultblock" id="' . $value[0] . '">'; //左邊
                        echo '<div class="box">';
                        if (stripos($value[2], "image") !== false) {
                            echo '<a href="#"><img src="' . '../' . $value[3] . '" alt="" class="thumb"/></a>';
                        } else {
                            if ($value[4] !== "") {
                                echo '<a href="#"><img src="' . 'http://img.youtube.com/vi/' . substr("$value[4]", 17) . '/0.jpg' . '" alt="" class="thumb"/><i class="fa fa-youtube fa-4x" style="z-index: 999;position: absolute;right: 5%;bottom: 10%;"></i></a>';
                            } else {
                                echo '<a href="#"><img src="images/default.jpg" alt="" class="thumb"/></a>';
                            }
                        }
                        echo '<span class="caption simple-caption">';
                        echo '<p>' . $value[1] . '</p>';
                        echo '</span>';
                        echo '</div>';
                        echo '</div>';
                    }}
                    ?>
                </div>
            </div>
        </div>	
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <!--<script type="text/javascript">
                        $(function(){
                           // img_class 是要套用縮放裁切效果的圖片class名，width及height就是想期望它要變成的size。 
                                $('.size-a').muImageResize({width: 200, height:200});

                         });
                </script> -->
        <script>
                            function mymyfunction() {
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
                                    swal("Deleted!", "檔案已經被清掉了^_^叫破喉嚨也不會回來囉~", "success");
                                });
                            }
                            ;
        </script>
        <script type="text/javascript">
            $(function () {
<?php
echo 'showresult(\'../ajaxResult.php\',' . $thumbcontainer[0][0] . ');';
?>
                //index of current item
                var current = 0;
                //speeds / ease type for animations
                var fadeSpeed = 400;
                var animSpeed = 600;
                var easeType = 'easeOutCirc';
                //caching
                var $thumbScroller = $('#thumbScroller');
                var $scrollerContainer = $thumbScroller.find('.container');
                var $scrollerContent = $thumbScroller.find('.content');
                var $pg_title = $('#pg_title');
                var $pg_preview = $('#pg_preview');
                var $pg_desc1 = $('#pg_desc1');
                var $pg_desc2 = $('#pg_desc2');
                var $overlay = $('#overlay');
                //number of items
                var scrollerContentCnt = $scrollerContent.length;
                var sliderHeight = $(window).height();
                //we will store the total height
                //of the scroller container in this variable
                var totalContent = 0;
                //one items height
                var itemHeight = 0;

                //First let's create the scrollable container,
                //after all its images are loaded
                var cnt = 0;
                $thumbScroller.find('img').each(function () {
                    var $img = $(this);
                    $('<img/>').load(function () {
                        ++cnt;
                        if (cnt === scrollerContentCnt) {
                            //one items height
                            itemHeight = $thumbScroller.find('.content:first').height();
                            buildScrollableItems();
                            //show the scrollable container
                            $thumbScroller.stop().animate({'left': '0px'}, animSpeed);
                        }
                    }).attr('src', $img.attr('src'));
                });

                //when we click an item from the scrollable container
                //we want to display the items content
                //we use the index of the item in the scrollable container
                //to know which title / image / descriptions we will show
                $scrollerContent.bind('click', function (e) {
                    var $this = $(this);

                    var idx = $this.index();
                    //if we click on the one shown then return
                    if (current === idx)
                        return;

                    //if the current image is enlarged,
                    //then we will remove it but before
                    //we animate it just like we would do with the thumb
                    var $pg_large = $('#pg_large');
                    if ($pg_large.length > 0) {
                        $pg_large.animate({'left': '350px', 'opacity': '0'}, animSpeed, function () {
                            $pg_large.remove();
                        });
                    }

                    //get the current and clicked items elements
                    var $currentTitle = $pg_title.find('h1:nth-child(' + (current + 1) + ')');
                    var $nextTitle = $pg_title.find('h1:nth-child(' + (idx + 1) + ')');
                    var $currentThumb = $pg_preview.find('img.pg_thumb:eq(' + current + ')');
                    var $nextThumb = $pg_preview.find('img.pg_thumb:eq(' + idx + ')');
                    var $currentDesc1 = $pg_desc1.find('div:nth-child(' + (current + 1) + ')');
                    var $nextDesc1 = $pg_desc1.find('div:nth-child(' + (idx + 1) + ')');
                    var $currentDesc2 = $pg_desc2.find('div:nth-child(' + (current + 1) + ')');
                    var $nextDesc2 = $pg_desc2.find('div:nth-child(' + (idx + 1) + ')');

                    //the new current is now the index of the clicked scrollable item
                    current = idx;

                    //animate the current title up,
                    //hide it, and animate the next one down

                    $currentTitle.stop().animate({'top': '-50px'}, animSpeed, function () {
                        $(this).hide();
                        $nextTitle.show().animate({'top': '25px'}, animSpeed);
                    });

                    //show the next image,
                    //animate the current to the left and fade it out
                    //so that the next gets visible
                    $nextThumb.show();
                    $currentThumb.stop().animate({'left': '350px', 'opacity': '0'}, animSpeed, function () {
                        $(this).hide().css({
                            'left': '250px',
                            'opacity': 1,
                            'z-index': 1
                        });
                        $nextThumb.css({'z-index': 9999});
                    });

                    //animate both current descriptions left / right and fade them out
                    //fade in and animate the next ones right / left
                    $currentDesc1.stop().animate({'left': '205px', 'opacity': '0'}, animSpeed, function () {
                        $(this).hide();
                        $nextDesc1.show().animate({'left': '250px', 'opacity': '1'}, animSpeed);
                    });
                    $currentDesc2.stop().animate({'left': '295px', 'opacity': '0'}, animSpeed, function () {
                        $(this).hide();
                        $nextDesc2.show().animate({'left': '250px', 'opacity': '1'}, animSpeed);
                    });
                    e.preventDefault();
                });

                //when we click a thumb, the thumb gets enlarged,
                //to the sizes of the large image (fixed values).
                //then we load the large image, and insert it after
                //the thumb. After that we hide the thumb so that
                //the large one gets displayed
               

                //enlarges the thumb
               

                //resize window event:
                //the scroller container needs to update
                //its height based on the new windows height
                $(window).resize(function () {
                    var w_h = $(window).height();
                    $thumbScroller.css('height', w_h);
                    sliderHeight = w_h;
                });

                //create the scrollable container
                //taken from Manos :
                //http://manos.malihu.gr/jquery-thumbnail-scroller
                function buildScrollableItems() {
                    totalContent = (scrollerContentCnt - 1) * itemHeight;
                    $thumbScroller.css('height', sliderHeight)
                            .mousemove(function (e) {
                                if ($scrollerContainer.height() > sliderHeight) {
                                    var mouseCoords = (e.pageY - this.offsetTop);
                                    var mousePercentY = mouseCoords / sliderHeight;
                                    var destY = -(((totalContent - (sliderHeight - itemHeight)) - sliderHeight) * (mousePercentY));
                                    var thePosA = mouseCoords - destY;
                                    var thePosB = destY - mouseCoords;
                                    if (mouseCoords == destY)
                                        $scrollerContainer.stop();
                                    else if (mouseCoords > destY)
                                        $scrollerContainer.stop()
                                                .animate({
                                                    top: -thePosA
                                                },
                                                animSpeed,
                                                        easeType);
                                    else if (mouseCoords < destY)
                                        $scrollerContainer.stop()
                                                .animate({
                                                    top: thePosB
                                                },
                                                animSpeed,
                                                        easeType);
                                }
                            }).find('.thumb')
                            .fadeTo(fadeSpeed, 0.6)
                            .hover(
                                    function () { //mouse over
                                        $(this).stop(true).fadeTo(300, 1);
                                    },
                                    function () { //mouse out
                                        $(this).fadeTo(200, 0.6);
                                    }
                            );
                }
            });
        </script>
        <script src="../js/sweetalert-dev.js"></script>
        <script src="../js/sweetalert.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../js/jquery.form.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/bootstrap-datepicker.min.js"></script>
        <script src="../js/tsai.js"></script>
        <script src="js/preview.js"></script>
        <script src="../js/lightbox.js"></script>
    </body>
</html>