<!doctype html>
<?php
session_start();
include('../logincheck.php');
include("../mysql_connect.inc.php");
$MemberNo = $_SESSION['MemberNo'];
$email = $_SESSION['UserName'];
$sql = "SELECT * FROM profile where MemberNo = '$MemberNo'";
$result = mysql_query($sql);
$profilerow = mysql_fetch_row($result);
$result = mysql_query("SELECT * FROM resultclassify where memberNo ='$MemberNo'");
$classrow = mysql_fetch_row($result);
if ($profilerow[3] == 0) {
    $image = 'image/photo.jpg';
} else {
    $sql = "SELECT ImageUrl FROM image where ImageNo = '$profilerow[3]'";
    $result = mysql_query($sql);
    $imagerow = mysql_fetch_row($result);
    $image = "$imagerow[0]";
}
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
		<link href="../css/checkbox-radio-button.css" rel="stylesheet">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link href="../css/bootstrap-datepicker.css" rel="stylesheet">
        <link href="../css/bootstrap-datepicker.min.css" rel="stylesheet">

        <link rel="stylesheet" href="css/default.css" />
		<link rel="stylesheet" href="css/component.css" />
        <link rel="stylesheet" href="css/sweetalert.css">
        <link rel="stylesheet" href="../css/chi-modal.css">
        <link rel="stylesheet" href="css/animate.css">
                  <!-- This is what you need -->
        <script src="js/sweetalert-dev.js"></script>
        
        <script src="js/modernizr.custom.js"></script>
        <script src="js/modernizr.js"></script> <!-- Modernizr -->
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <title>新增分享 - ETrace</title>
    </head>
    <body>
	  <header>
		<div class="row">
			<div class="col-md-4 col-sm-8 col-xs-12  col-lg-4">
				<div id="header-left">
					<h1 id="title"><?php echo filter_input(INPUT_GET,"title"); ?></h1>
				</div>
			</div>
			<div class="col-md-offset-5 col-md-3 col-sm-4 col-xs-12 col-lg-5 col-lg-offset-3">
				<div id="header-right">
					<?php
					echo '<img src="../' . "$image" . '" alt="..." class="abc" height="100" width="100"></br></br>';
					?>
					<h2><?php echo "$profilerow[0] $profilerow[4]" ?></h2></br>
					<p><?php echo "$profilerow[5]" ?></p></br>
					<p><?php echo "$email"; ?></p>
				</div>	
			</div>	
		</div>	
        </header>

        <section id="cd-timeline" class="cd-container">

            <div class="cd-timeline-block" id="addbtn">
                <div class="cd-timeline-img cd-picture" style="cursor:pointer" data-toggle="modal" data-target="#addoptModal">
                    <img src="img/Clip-43.png" alt="Picture">
                </div> <!-- cd-timeline-img -->
                <div class="cd-timeline-content" >
                    <h2>新增內容</h2>
                    <p>This is the content of the last section</p>                    
                </div> <!-- cd-timeline-content -->
            </div> <!-- cd-timeline-block -->

        </section> <!-- cd-timeline -->
        <div id="loading" style="display: none">
            <img src="../image/ajax-loader.gif" />
        </div>

        <!-- 選擇視窗 Start -->
			<div style="height: 100%;" class="modal bs-example-modal-sm"  id="addoptModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <div class="modal fade" id="addResultModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog pull-right modal-sm  slideInRight animated" id="addResultDialog">
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
                                echo '<label class="resultname"><input name="result" type="radio" value="' . "$resultrow[0]"  . '"/><i></i>&nbsp;' . "$resultrow[1]" . '</label></br>';
                            }
                            echo '<label class="classname">' . $classrow[1] . '</label></br>';
                            $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[1]' AND MemberNo= '$MemberNo'");
                            while ($resultrow = mysql_fetch_row($resultresult)) {
                                echo '<label class="resultname"><input name="result" type="radio" value="' . "$resultrow[0]"  . '"/><i></i>&nbsp;' . "$resultrow[1]" . '</label></br>';
                            }
                            echo '<label class="classname">' . $classrow[2] . '</label></br>';
                            $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[2]' AND MemberNo= '$MemberNo'");
                            while ($resultrow = mysql_fetch_row($resultresult)) {
                                echo '<label class="resultname"><input name="result" type="radio" value="' . "$resultrow[0]"  . '"/><i></i>&nbsp;' . "$resultrow[1]" . '</label></br>';
                            }
                            echo '<label class="classname">' . $classrow[3] . '</label></br>';
                            $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[3]' AND MemberNo= '$MemberNo'");
                            while ($resultrow = mysql_fetch_row($resultresult)) {
                                echo '<label class="resultname"><input name="result" type="radio" value="' . "$resultrow[0]"  . '"/><i></i>&nbsp;' . "$resultrow[1]" . '</label></br>';
                            }
                            echo '<label class="classname">' . $classrow[4] . '</label></br>';
                            $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[4]' AND MemberNo= '$MemberNo'");
                            while ($resultrow = mysql_fetch_row($resultresult)) {
                                echo '<label class="resultname"><input name="result" type="radio" value="' . "$resultrow[0]"  . '"/><i></i>&nbsp;' . "$resultrow[1]" . '</label></br>';
                            }
                            echo '<label class="classname">' . $classrow[5] . '</label></br>';
                            $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[5]' AND MemberNo= '$MemberNo'");
                            while ($resultrow = mysql_fetch_row($resultresult)) {
                                echo '<label class="resultname"><input name="result" type="radio" value="' . "$resultrow[0]"  . '"/><i></i>&nbsp;' . "$resultrow[1]" . '</label></br>';
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

        <!-- Edit Start -->
        <div class="modal fade" id="editachi" tabindex="-1" role="dialog" aria-labelledby="editachiLabel" aria-hidden="true">
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
                            <input type="submit" class="btn btn-primary" value="修改">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>						
                        </div>
                    </form>
                </div>
            </div>
        </div>	
        <!-- Edit End -->  

        <div style="text-align:center">
            <button type="submit" class="btn btn-info btn-summit" onclick="submit()">送出 
        </div>	

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/main.js"></script> <!-- Resource jQuery -->
        <script src="../js/bootstrap.min.js"></script>        
        <script src="../js/jquery.form.js"></script>
        <script src="../js/result.js"></script>        
        <script src="js/add.js"></script>
        <script src="../js/bootstrap-datepicker.min.js"></script>
        <script src="../js/tsai.js"></script>
    </body>
</html>