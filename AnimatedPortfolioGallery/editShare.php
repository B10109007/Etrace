<!DOCTYPE html>
<?php
session_start();
include('../logincheck.php');
include("../mysql_connect.inc.php");
$No = filter_input(INPUT_GET, "No");
$MemberNo = $_SESSION['MemberNo'];
$email = $_SESSION['UserName'];
$sql = "SELECT * FROM profile where MemberNo = '$MemberNo'";
$result = mysql_query($sql);
$profilerow = mysql_fetch_row($result);
$result = mysql_query("SELECT * FROM resultclassify where memberNo ='$MemberNo'");
$classrow = mysql_fetch_row($result);
$result = mysql_query("SELECT * FROM output where OutputNo ='$No'");
$outputrow = mysql_fetch_row($result);
if ($profilerow[3] == 0) {
    $image = 'image/photo.jpg';
} else {
    $sql = "SELECT ImageUrl FROM image where ImageNo = '$profilerow[3]'";
    $result = mysql_query($sql);
    $imagerow = mysql_fetch_row($result);
    $image = "$imagerow[0]";
}
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <link rel="Shortcut Icon" type="image/x-icon" href="../image/favicon.ico" />


        <title>新增分享 - ETrace</title>

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
        <link href="../css/lightbox.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>		
        <script src="js/cufon-yui.js" type="text/javascript"></script>
        <script src="js/Quicksand_Book_400.font.js" type="text/javascript"></script>
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
        <h1 class="title" style="padding: 0px;" ><input onmouseover="this.focus()" id="title" value="<?php echo $outputrow[1]?>" style="background-color:transparent; border: 0;width:300px;height:70px;" type="text" class="text-center"></h1>

        <div class=" profileframe">
            <?php
            echo '<img src="../' . "$image" . '" alt="..." class="photo size-a"></br></br>';
            ?>
            <div class="profilefont">
                <h3><?php echo "$profilerow[0] $profilerow[4]" ?></h3></br>
                <p><?php echo "$profilerow[5]" ?></p></br>
                <p><?php echo "$email"; ?></p>
            </div>
        </div>
        <button class="style2-addbtn fa fa-plus fa-3x" style="z-index:9999;" id="" data-toggle="modal" data-target="#addoptModal"></button> 
        <button type="submit" class="btn btn-info btn-summit" onclick="editsubmit(<?php echo filter_input(INPUT_GET, "No")?>)" style="bottom:0px;right:30px;position:absolute;">修改</button>
        <div class="pg_content">
            <div id="pg_title" class="pg_title">
            </div>
            <div id="pg_preview">
            </div>
            <div id="pg_desc1" class="pg_description">                
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
                            $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[0]' AND MemberNo= '$MemberNo'");
                            while ($resultrow = mysql_fetch_row($resultresult)) {
                                echo '<label class="resultname"><input name="result" type="radio" value="' . "$resultrow[0]" . '"/><i></i>&nbsp;' . "$resultrow[1]" . '</label></br>';
                            }
                            echo '<label class="classname">' . $classrow[1] . '</label></br>';
                            $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[1]' AND MemberNo= '$MemberNo'");
                            while ($resultrow = mysql_fetch_row($resultresult)) {
                                echo '<label class="resultname"><input name="result" type="radio" value="' . "$resultrow[0]" . '"/><i></i>&nbsp;' . "$resultrow[1]" . '</label></br>';
                            }
                            echo '<label class="classname">' . $classrow[2] . '</label></br>';
                            $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[2]' AND MemberNo= '$MemberNo'");
                            while ($resultrow = mysql_fetch_row($resultresult)) {
                                echo '<label class="resultname"><input name="result" type="radio" value="' . "$resultrow[0]" . '"/><i></i>&nbsp;' . "$resultrow[1]" . '</label></br>';
                            }
                            echo '<label class="classname">' . $classrow[3] . '</label></br>';
                            $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[3]' AND MemberNo= '$MemberNo'");
                            while ($resultrow = mysql_fetch_row($resultresult)) {
                                echo '<label class="resultname"><input name="result" type="radio" value="' . "$resultrow[0]" . '"/><i></i>&nbsp;' . "$resultrow[1]" . '</label></br>';
                            }
                            echo '<label class="classname">' . $classrow[4] . '</label></br>';
                            $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[4]' AND MemberNo= '$MemberNo'");
                            while ($resultrow = mysql_fetch_row($resultresult)) {
                                echo '<label class="resultname"><input name="result" type="radio" value="' . "$resultrow[0]" . '"/><i></i>&nbsp;' . "$resultrow[1]" . '</label></br>';
                            }
                            echo '<label class="classname">' . $classrow[5] . '</label></br>';
                            $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[5]' AND MemberNo= '$MemberNo'");
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
                            <input type="text" hidden="true" id="resultindex" name="resultindex">
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
                </div>
            </div>
        </div>	
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
        <script>
           function loading() {
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
                        if (cnt == scrollerContentCnt) {
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
                    $currentThumb.stop().animate({'left': '350px', 'opacity': '0'}, animSpeed, function () {
                        $(this).hide().css({
                            'left': '250px',
                            'opacity': 1,
                            'z-index': 1
                        });
                        $nextThumb.css({'z-index': 9998});
                    });                    
                    $nextThumb.show(); 
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

            } 
        </script>
        <script src="../js/sweetalert-dev.js"></script>
        <script src="../js/sweetalert.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../js/jquery.form.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/bootstrap-datepicker.min.js"></script>
        <script src="../js/tsai.js"></script>  
        <script src="js/edit.js"></script>
        <script src="../js/lightbox.js"></script>
        <script>          
            <?php
            $result = mysql_query("SELECT * FROM verticalexistresult where VerticalNo=$outputrow[0]");
            $count=0;
            while ($existrow = mysql_fetch_row($result)) {
                echo "saveResult(" . "$existrow[0]" . ","."$count".");";
                $count++;
            }
            ?>            
            loading();            
        </script>
    </body>
</html>