<?php session_start(); ?>
<?php
include("mysql_connect.inc.php");
$MemberNo = $_SESSION['MemberNo'];
$result = mysql_query("SELECT * FROM resultclassify where memberNo ='$MemberNo'");
$classrow = mysql_fetch_row($result);
$resultresult = mysql_query("SELECT * FROM result where memberNo ='$MemberNo'");
?>

<!DOCTYPE html>
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


        <title>成果 - ETrace</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <!-- Custom styles for this template -->
        <link href="css/theme.css" rel="stylesheet">
        <link href="css/chi.css" rel="stylesheet">
        <link href="css/chi-achieves-box.css" rel="stylesheet">

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
                            include("menu.php")
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>


            <!-- start -->	
            <div class="container theme-showcase" role="main">

                <!-- tablists -->		
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a aria-controls="" role="tab" data-toggle="tab" onclick="filter($(this))">All</a></li>                    
                    <?php
                    if ($classrow[0] != NULL) {
                        echo '<li role="presentation"><a href="#classone" id="class1" aria-controls="classone" role="tab" data-toggle="tab" onclick="filter($(this))">' . "$classrow[0]" . '</a></li>';
                    }
                    if ($classrow[1] != NULL) {
                        echo '<li role="presentation"><a href="#classtwo" id="class2" aria-controls="classtwo" role="tab" data-toggle="tab" onclick="filter($(this))">' . "$classrow[1]" . '</a></li>';
                    }
                    if ($classrow[2] != NULL) {
                        echo '<li role="presentation"><a href="#classone" id="class3" aria-controls="classone" role="tab" data-toggle="tab" onclick="filter($(this))">' . "$classrow[2]" . '</a></li>';
                    }
                    if ($classrow[3] != NULL) {
                        echo '<li role="presentation"><a href="#classtwo" id="class4" aria-controls="classtwo" role="tab" data-toggle="tab" onclick="filter($(this))">' . "$classrow[3]" . '</a></li>';
                    }
                    if ($classrow[4] != NULL) {
                        echo '<li role="presentation"><a href="#classone" id="class5" aria-controls="classone" role="tab" data-toggle="tab" onclick="filter($(this))">' . "$classrow[4]" . '</a></li>';
                    }
                    if ($classrow[5] != NULL) {
                        echo '<li role="presentation"><a href="#classtwo" id="class6" aria-controls="classtwo" role="tab" data-toggle="tab" onclick="filter($(this))">' . "$classrow[5]" . '</a></li>';
                    }
                    if ($classrow[0] == NULL || $classrow[1] == NULL || $classrow[2] == NULL || $classrow[3] == NULL || $classrow[4] == NULL || $classrow[5] == NULL) {
                        echo '<li role="presentation"><a href="#customize" aria-controls="customize" role="tab" data-toggle="modal" data-target="#cusachi" data-whatever="ETrace"> <span class="glyphicon glyphicon-plus"></span></a></li>';
                    }
                    if ($classrow[0] != NULL || $classrow[1] != NULL || $classrow[2] != NULL || $classrow[3] != NULL || $classrow[4] != NULL || $classrow[5] != NULL) {
                        echo '<li role="presentation"><a href="#customize" aria-controls="customize" role="tab" data-toggle="modal" data-target="#DelClassify" data-whatever="ETrace"> <span class="glyphicon glyphicon-minus"></span></a></li>';
                    }
                    if ($classrow[0] != NULL || $classrow[1] != NULL || $classrow[2] != NULL || $classrow[3] != NULL || $classrow[4] != NULL || $classrow[5] != NULL) {
                        echo '<li role="presentation"><a href="#customize" aria-controls="customize" role="tab" data-toggle="modal" data-target="#EditClassify" data-whatever="ETrace"> <span class="glyphicon glyphicon-edit"></span></a></li>';
                    }
                    ?>
                </ul>

                <!-- Tab panes -->
                <div id="hacker-list" class="tab-content">
                    <!-- 自訂分類 Start -->
                    <div class="modal fade" id="cusachi" tabindex="-1" role="dialog" aria-labelledby="cusachiLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="cusachiLabel">自訂分類</h4>
                                </div>
                                <form action="classify.php" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="InputClassify">名稱:</label>
                                            <input type="text" class="form-control" name="InputClassify" placeholder="Classify">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>						
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>	
                    <!-- 自訂分類 End -->
                    <!-- 刪除分類 Start -->
                    <div class="modal fade" id="DelClassify" tabindex="-1" role="dialog" aria-labelledby="delclassifyLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="delclassifyLabel">刪除分類</h4>
                                </div>
                                <form action="classify.php" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="DelClassify">分類</label>
                                            <div class="btn-group" id="DelClass" data-toggle="buttons">                                                  
                                                <?php
                                                if ($classrow[0] != NULL) {
                                                    echo '<label class="btn btn-default">';
                                                    echo '<input type="radio" name="declass" value="0" />' . "$classrow[0]" . '</label> ';
                                                }
                                                if ($classrow[1] != NULL) {
                                                    echo '<label class="btn btn-primary">';
                                                    echo '<input type="radio" name="declass" value="1"/>' . "$classrow[1]" . '</label> ';
                                                }
                                                if ($classrow[2] != NULL) {
                                                    echo '<label class="btn btn-success">';
                                                    echo '<input type="radio" name="declass" value="2"/>' . "$classrow[2]" . '</label> ';
                                                }
                                                if ($classrow[3] != NULL) {
                                                    echo '<label class="btn btn-info">';
                                                    echo '<input type="radio" name="declass" value="3"/>' . "$classrow[3]" . '</label> ';
                                                }
                                                if ($classrow[4] != NULL) {
                                                    echo '<label class="btn btn-warning">';
                                                    echo '<input type="radio" name="declass" value="4"/>' . "$classrow[4]" . '</label> ';
                                                }
                                                if ($classrow[5] != NULL) {
                                                    echo '<label class="btn btn-danger">';
                                                    echo '<input type="radio" name="declass" value="5"/>' . "$classrow[5]" . '</label> ';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <label for="DelNotice" style="color:red;">請注意!!!一旦刪除分類，會連再那個刪除分類裡的成果一起刪除!!</label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="deleteclassbtn" onclick="deleteclass()">我確定拉通通都給它刪了!!!!!</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>                      
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>  
                    <!-- 刪除分類 End -->
                    <!-- 編輯分類 Start -->
                    <div class="modal fade" id="EditClassify" tabindex="-1" role="dialog" aria-labelledby="EditClassifyLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="EditClassifyLabel">編輯分類</h4>
                                </div>
                                <form action="classify.php" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="EditClass">分類</label>
                                            <div class="btn-group" data-toggle="buttons">                                                  
                                                <?php
                                                if ($classrow[0] != NULL) {
                                                    echo '<label class="btn btn-default">';
                                                    echo '<input type="radio" name="editclass" value="0" />' . "$classrow[0]" . '</label> ';
                                                }
                                                if ($classrow[1] != NULL) {
                                                    echo '<label class="btn btn-primary">';
                                                    echo '<input type="radio" name="editclass"  value="1" />' . "$classrow[1]" . '</label> ';
                                                }
                                                if ($classrow[2] != NULL) {
                                                    echo '<label class="btn btn-success">';
                                                    echo '<input type="radio" name="editclass"  value="2" />' . "$classrow[2]" . '</label> ';
                                                }
                                                if ($classrow[3] != NULL) {
                                                    echo '<label class="btn btn-info">';
                                                    echo '<input type="radio" name="editclass"  value="3" />' . "$classrow[3]" . '</label> ';
                                                }
                                                if ($classrow[4] != NULL) {
                                                    echo '<label class="btn btn-warning">';
                                                    echo '<input type="radio" name="editclass"  value="4" />' . "$classrow[4]" . '</label> ';
                                                }
                                                if ($classrow[5] != NULL) {
                                                    echo '<label class="btn btn-danger">';
                                                    echo '<input type="radio" name="editclass"  value="5" />' . "$classrow[5]" . '</label> ';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="EditClassify">修改名稱:</label>
                                            <input type="text" class="form-control" name="EditClassify" placeholder="Classify" id="editname">
                                        </div>
                                    </div>
                                    <div class="modal-footer">                                                         
                                        <button type="button" class="btn btn-primary" >確定</button>           
                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>                      
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>  
                    <!-- 編輯分類 End -->
                    <!-- 新增成果 -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form name="form1" id="form1" method="post" action="result_finish.php" enctype="multipart/form-data">
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
                                            <label for="InputStartTime">開始時間</label><br>
                                            <input type="date" id="InputStartTime" name="StartTime" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="InputEndTime">結束時間</label><br>
                                            <input type="date" id="EndTime" name="EndTime" value="<?php echo date('Y-m-d'); ?>">
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
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> 確認送出
                                            </label>
                                        </div>   
                                    </div>
                                    <div class="modal-footer">                                        
                                        <input type="submit" class="btn btn-primary" value="新增">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>						
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>	
                    <!-- 新增成果End -->
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
                                        <span class="glyphicon glyphicon-flag" aria-hidden="true"></span> <div style="display:inline"><span class="label label-success" id="moreclassify">運動</span></div>
                                        <hr>
                                        <span class="glyphicon glyphicon-calendar" aria-hidden="true" ></span><div id="morestarttime" style="display:inline">2014/09/16</div>
                                        <hr>
                                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span><div id="morecontent" style="display:inline;word-wrap:break-word;">&nbsp;&nbsp;大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。 大家一起去路跑，然後多運動有益身體健康。</div>
                                        <hr>
                                        <span class="glyphicon glyphicon-paperclip" aria-hidden="true"><div class="form-group fs" style="display:inline">&nbsp;&nbsp;<a id="morefile"></a></div></span>
                                        <hr>
                                        <span class="glyphicon glyphicon-picture" aria-hidden="true"></span><div><img id="moreimage" class="im"></div>
                                        <hr>
                                        <span class="glyphicon glyphicon-film" aria-hidden="true"></span><div id="moreiframe" style="display:inline" class="video-container"><iframe id="moreyoutube" src="https://www.youtube.com/embed/EwWWNuDdC20" frameborder="0" allowfullscreen></iframe></div>
                                    </blockquote>       
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info" id="edtia" target="_blank" data-toggle="modal"  data-target="#editachi" onclick="showedit()"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                                    <button type="button" class="btn btn-danger" id="dela" target="_blank" data-toggle="modal"  data-target="#delachi"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                          
                                    <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>                      
                                </div>
                            </div>
                        </div>
                    </div>  
                    <!-- More End -->
                    <!-- Del Start -->
                    <div class="modal fade" id="delachi" tabindex="-1" role="dialog" aria-labelledby="delachiLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="delachiLabel">刪除成果</h4>
                                </div>
                                <div class="modal-body">
                                    您確定要將這個成果刪除嗎?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="deleteresult" onclick="deleteresult()">是</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">否</button>						
                                </div>
                            </div>
                        </div>
                    </div>	
                    <!-- Del End -->
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
                                                    echo '<input type="radio" name="editresultclass" value="',"$classrow[0]",'"/>' . "$classrow[0]" . '</label> ';
                                                }
                                                if ($classrow[1] != NULL) {
                                                    echo '<label class="btn btn-primary">';
                                                    echo '<input type="radio" name="editresultclass" value="',"$classrow[1]",'"/>' . "$classrow[1]" . '</label> ';
                                                }
                                                if ($classrow[2] != NULL) {
                                                    echo '<label class="btn btn-success">';
                                                    echo '<input type="radio" name="editresultclass" value="',"$classrow[2]",'"/>' . "$classrow[2]" . '</label> ';
                                                }
                                                if ($classrow[3] != NULL) {
                                                    echo '<label class="btn btn-info">';
                                                    echo '<input type="radio" name="editresultclass" value="',"$classrow[3]",'"/>' . "$classrow[3]" . '</label> ';
                                                }
                                                if ($classrow[4] != NULL) {
                                                    echo '<label class="btn btn-warning">';
                                                    echo '<input type="radio" name="editresultclass" value="',"$classrow[4]",'"/>' . "$classrow[4]" . '</label> ';
                                                }
                                                if ($classrow[5] != NULL) {
                                                    echo '<label class="btn btn-danger">';
                                                    echo '<input type="radio" name="editresultclass" value="',"$classrow[5]",'"/>' . "$classrow[5]" . '</label> ';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputStartTime" >開始時間</label><br>
                                            <input type="date" id="editStartTime" name="editStartTime">
                                        </div><div class="form-group">
                                            <label for="InputEndTime">結束時間</label><br>
                                            <input type="date" id="editEndTime" name="editEndTime">
                                        </div>
                                        <div class="form-group">
                                            <label for="InputContext" >描述</label>
                                            <textarea class="form-control" id="editcontent" placeholder="Context" rows="8" name="editcontent"></textarea>
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
                    <!-- tab/all -->                    
                    <div role="tabpanel" class="tab-pane active" id="all">
                        <div id="hacker-list">                                                   
                            <!--搜尋跟新增按鈕-->                             
                            <div class="row">         
                                <div class="input-group" style="padding-top:15px;padding-bottom:15px;">
                                    <div class="col-md-8">
                                        <input class="search" type="search" id="bar" placeholder="Search" />
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-default" id="adda2" target="_blank" data-toggle="modal" data-target="#exampleModal" data-whatever="ETrace"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增</button>
                                    </div>
                                </div>
                            </div>      
                            <!-- 成果Start -->
                            <div class="row"> 
                                <ul class="list">
                                    <?php
                                    while ($resultrow = mysql_fetch_row($resultresult)) {
                                        $boximage = "";
                                        $sql = "SELECT * FROM file where ResultNo='$resultrow[0]'";
                                        $result = mysql_query($sql);
                                        $filerow = mysql_fetch_row($result);
                                        $music = array('mkv', 'mp3', 'flac', 'wav', 'mid', 'wma', 'wav');
                                        $doc = array('doc', 'docx', 'ppt', 'pptx', 'pdf', 'xls');
                                        $Compressed = array('rar', 'zip', '7z');
                                        $temp = explode(".", "$filerow[1]");
                                        $extension = strtolower(end($temp));

                                        if (in_array($extension, $Compressed)) {
                                            $boximage = "image/result/zip3.ico";
                                        } elseif (strpos("$filerow[2]", 'image') !== false) {
                                            $boximage = "$filerow[4]";
                                        } elseif (in_array($extension, $doc)) {
                                            $boximage = "image/document.png";
                                        } elseif (in_array($extension, $music)) {
                                            $boximage = "image/result/music1.png";
                                        } else {
                                            $boximage = "image/result/none.png";
                                        }
                                        echo '<div class="col-sm-6 col-md-4">';
                                        echo '<li>';
                                        echo '<div class="box">';
                                        echo '<span class="captionAchi1">';
                                        echo '<img src="' . "$boximage" . '" alt="..." height="150" width="150"><br>';

                                        if ("$resultrow[5]" == "$classrow[0]") {
                                            $labelcss = 'category label label-default';
                                        } elseif ("$resultrow[5]" == "$classrow[1]") {
                                            $labelcss = 'category label label-primary';
                                        } elseif ("$resultrow[5]" == "$classrow[2]") {
                                            $labelcss = 'category label label-success';
                                        } elseif ("$resultrow[5]" == "$classrow[3]") {
                                            $labelcss = 'category label label-info';
                                        } elseif ("$resultrow[5]" == "$classrow[4]") {
                                            $labelcss = 'category label label-warning';
                                        } elseif ("$resultrow[5]" == "$classrow[5]") {
                                            $labelcss = 'category label label-danger';
                                        }
                                        echo '<blockquote>';
                                        echo '<h4 class="name  title">' . "$resultrow[1]" . '</h4> ';
                                        echo '<i class="fa fa-flag" aria-hidden="true"></span> <span class="' . "$labelcss" . '">' . "$resultrow[5]" . '</i><br>';
                                        echo '<i class="atime fa fa-calendar" aria-hidden="true"><div class="mmm"> ' . date('Y/m/d', strtotime($resultrow[3])) . ' - ' . date('Y/m/d', strtotime($resultrow[4])) . '</div></i><br>';
                                        echo '<i class="achcontent fa fa-comment" aria-hidden="true"><h4 id="chichi">' . $resultrow[6] . '</h4></i>';
                                        echo '</blockquote>';
                                        echo '</span>';
                                        echo '<span class="captionAchi fade-captionAchi">';
                                        echo '<button type="button" class="btn btn-success" id="morea" target="_blank" onclick="ajaxresult(',"$resultrow[0]",')"> <i class="fa fa-comment" aria-hidden="true"></i></button>';
                                        echo '<button type="button" class="btn btn-info" id="edtia" target="_blank" onclick="showedit(',"$resultrow[0]",')"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                                        echo '<button type="button" class="btn btn-danger" id="dela" target="_blank" data-toggle="modal"  data-target="#delachi" onclick="passresultNo(', "$resultrow[0]", ')"><i class="fa fa-trash" aria-hidden="true"></i></span></button>';
                                        echo '</span>';
                                        echo '</div>';
                                        echo '<div><br><br><br><br><br><br><br><br><br><br></div>';
                                        echo '</li>';
                                        echo '</div>';
                                    }
                                    ?>                                                                         
                                </ul>                               
                            </div>
                        </div>	
                    </div>	
                </div>	
            </div>           
        </div>
        <footer class="footer"><div class="container text-center">© ETrace 2015. All right reserved.</div></footer>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/list.js"></script>
        <script>
                                        var options = {
                                            valueNames: ['name', 'achcontent', 'atime', 'category']
                                        };
                                        var hackerList = new List('hacker-list', options);
                                        function filter(obj) {
                                            if (obj.text() === "All") {
                                                hackerList.filter();
                                            } else {
                                                hackerList.filter(function (item) {
                                                    if (item.values().category === obj.text()) {
                                                        return true;
                                                    } else {
                                                        return false;
                                                    }
                                                });
                                            }
                                        }
                                        function ajaxresult(resultNo) {
                                            $.ajax({
                                                url: 'ajaxResult.php',
                                                dataType: 'json',
                                                type: 'POST',
                                                data: {resultNo: resultNo},
                                                error: function () {
                                                    alert('Ajax request 發生錯誤');
                                                },
                                                success: function (response) {
                                                    $("#moreimage").attr("src", "");
                                                    $("#moreclassify").text(response['Classify']);
                                                    $("#moreLabel").text(response['Title']);
                                                    $("#morestarttime").text(" " + response['StartTime']);
                                                    $("#morecontent").text(" " + response['Content']);
                                                    $("#edtia").attr("onclick",'showedit("'+response['ResultNo']+'")');
                                                    $("#dela").attr("onclick",'deleteresult("'+response['ResultNo']+'")');

                                                    if (response['Classify'] === $("#class1").text()) {
                                                        $("#moreclassify").attr("class", "label label-default");
                                                    } else if (response['Classify'] === $("#class2").text()) {
                                                        $("#moreclassify").attr("class", "label label-primary");
                                                    } else if (response['Classify'] === $("#class3").text()) {
                                                        $("#moreclassify").attr("class", "label label-success");
                                                    } else if (response['Classify'] === $("#class4").text()) {
                                                        $("#moreclassify").attr("class", "label label-info");
                                                    } else if (response['Classify'] === $("#class5").text()) {
                                                        $("#moreclassify").attr("class", "label label-warning");
                                                    } else if (response['Classify'] === $("#class6").text()) {
                                                        $("#moreclassify").attr("class", "label label-danger");
                                                    }


                                                    if (response['Youtube'] === false) {
                                                        $("#moreyoutube").attr("src", "");
                                                        $("#moreiframe").attr("style", "display:none");
                                                    } else {
                                                        $("#moreyoutube").attr("src", 'https://www.youtube.com/embed/' + response['Youtube']);
                                                        $("#moreiframe").attr("style", "");
                                                    }
                                                    if (response['FileType'].match("image")) {
                                                        $("#moreimage").attr("src", response['FileUrl']);
                                                    } else {
                                                        $("#morefile").text(response['FileName']);
                                                        $("#morefile").attr("href", response['FileUrl']);
                                                    }
                                                    $("#moreachi").modal();
                                                }
                                            });
                                        }
                                        function passresultNo(resultNo) {
                                            $("#deleteresult").attr("onclick", 'deleteresult("' + resultNo + '")');
                                        }
                                        function deleteresult(resultNo) {
                                            $.ajax({
                                                url: 'deleteResult.php',
                                                type: 'POST',
                                                data: {resultNo: resultNo},
                                                error: function () {
                                                    alert('Ajax request 發生錯誤');
                                                },
                                                success: function () {
                                                    location.reload();
                                                }
                                            });
                                        }
                                        function editClass() {
                                            var classval = $('input:radio[name=editclass]:checked').val();
                                            var classname = $("#editname").val();
                                            $.ajax({
                                                url: 'editClass.php',
                                                type: 'POST',
                                                data: {classval: classval, $classname: classname
                                                },
                                                error: function () {
                                                    alert('Ajax request 發生錯誤');
                                                },
                                                success: function () {
                                                    location.reload();
                                                }
                                            });
                                        }
                                        function deleteclass() {
                                            var classval = $('input:radio[name=declass]:checked').val();
                                            $.ajax({
                                                url: 'deleteClass.php',
                                                type: 'POST',
                                                data: {classval: classval},
                                                error: function () {
                                                    alert('Ajax request 發生錯誤');
                                                },
                                                success: function () {
                                                    location.reload();
                                                }
                                            });

                                        }
                                        function showedit(resultNo) {
                                            $.ajax({
                                                url: 'ajaxResult.php',
                                                dataType: 'json',
                                                type: 'POST',
                                                data: {resultNo: resultNo},
                                                error: function () {
                                                    alert('Ajax request 發生錯誤');
                                                },
                                                success: function (response) {
                                                    $('input:radio[name=editresultclass]:checked').parent().removeClass("active");                                                                                      
                                                    $("#edittitle").attr("value", response['Title']);
                                                    $("#editStartTime").attr("value", response['StartTime'].replace(/\//g, "-"));
                                                    $("#editEndTime").attr("value", response['EndTime'].replace(/\//g, "-"));                                                    
                                                    $("#editcontent").text(response['Content']);
                                                    if(response['Youtube']!==false){
                                                          $("#edityoutube").attr("value", 'https://youtu.be/' + response['Youtube']); 
                                                    }else{
                                                          $("#edityoutube").attr("value",''); 
                                                    }
                                                    var classify = response['Classify'];                                                    
                                                    $("[name='editresultclass']"+"[value='"+classify+"']").prop("checked", true);
                                                    $("[name='editresultclass']"+"[value='"+classify+"']").parent().addClass("active");                                                    
                                                    $("#editResultNo").attr("value",response['ResultNo']);
                                                    $("#editachi").modal();
                                                }
                                            });
                                        }
                                      


        </script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
