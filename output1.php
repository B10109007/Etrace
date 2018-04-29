<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
include('logincheck.php');
$email = $_SESSION['UserName'];
include("mysql_connect.inc.php");
$MemberNo = $_SESSION['MemberNo'];
$sql = "SELECT * FROM profile where MemberNo = '$MemberNo'";
$result = mysql_query($sql);
$profilerow = mysql_fetch_row($result);
$result = mysql_query("SELECT * FROM image where ImageNo = '$profilerow[3]'");
$imagerow = mysql_fetch_row($result);
$result = mysql_query("SELECT * FROM resultclassify where memberNo ='$MemberNo'");
$classrow = mysql_fetch_row($result);
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <link rel="Shortcut Icon" type="image/x-icon" href="image/favicon.ico" />


        <title>匯出 - ETrace</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="css/chi.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/theme.css" rel="stylesheet">
        <link href="css/bootstrap-datepicker.css" rel="stylesheet">
        <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="css/chi-achieves-box.css" rel="stylesheet">
        <link href="css/todostyle.css" rel="stylesheet">

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
                            include("menu.php");
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <div  id="outputfile">
                <div class="container theme-showcase" role="main">
                    <form name="form" id="form" method="post" action="output2.php" enctype="multipart/form-data">
                        <div class="row">
                            <!--1基本資料-->
                            <div class="col-md-4 col-sm-12">
                                <div class="bn__7" style="height: 500px;">
                                    <span class="glyphicon glyphicon-th-list"></span> 基本資料<br><br>
                                    <div  class="form-group text-left">
                                        <div class="row">
                                            <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
                                                <div class="form-group fs">									
                                                    <label><input type="checkbox" checked="checked" value="1" class="form-checkbox" name=""><span> 大頭貼：&nbsp;&nbsp;</span><img src="<?php echo "$imagerow[4]" ?>" alt="..." class="img-thumbnail" height="100" width="100"></label><br><br>
                                                    <label><input type="checkbox" checked="checked" value="1" class="form-checkbox" name=""><span> 中文姓名：<?php echo "$profilerow[0]" ?></span></label><br><br>
                                                    <label><input type="checkbox" checked="checked" value="1" class="form-checkbox" name=""><span> 英文姓名：<?php echo "$profilerow[4]" ?></span></label><br><br>
                                                    <label><input type="checkbox" checked="checked" value="1" class="form-checkbox" name=""><span> 性別：<?php echo "$profilerow[1]" ?></span></label><br><br>
                                                    <label><input type="checkbox" checked="checked" value="1" class="form-checkbox" name=""><span> 生日：<?php echo "$profilerow[5]" ?></span></label><br><br>
                                                    <label><input type="checkbox" checked="checked" value="1" class="form-checkbox" name=""><span> 婚姻狀況：</span></label><br>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="marriage" value="single"> 未婚
                                                    <input type="radio" name="marriage" value="married"> 已婚<br><br>
                                                </div>	
                                            </div>								
                                        </div>  	
                                    </div>                                  
                                </div>                
                            </div><!--1基本資料END-->

                            <!--2聯絡資料-->
                            <div class="col-md-4 col-sm-12">
                                <div class="bn__5" style="height: 500px;">
                                    <span class="glyphicon glyphicon-th-list"></span> 聯絡資料<br><br>
                                    <div class="row text-left">
                                        <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
                                            <div class="form-group fs">									
                                                <label><input type="checkbox" checked="checked" value="1" class="form-checkbox" name=""><span> 電話號碼：<?php echo "$profilerow[6]" ?></span></label><br><br>
                                                <label><input type="checkbox" checked="checked" value="1" class="form-checkbox" name=""><span> Email：<br><br><p style="line-height: 18px;margin-left: 1em;"><?php echo "$email" ?></p></span></label><br>
                                                <input type="checkbox" checked="checked" value="1" class="form-checkbox" name=""> 現居地址：<br><br><input type="text" class="form-control" id=""><br>
                                            </div>                     
                                        </div>
                                    </div>  
                                </div>               
                            </div><!--2聯絡資料END-->

                            <!--3學歷-->
                            <div class="col-md-4 col-sm-12">
                                <div class="bn__6" style="height: 500px;">
                                    <span class="glyphicon glyphicon-th-list"></span> 學歷<br><br>
                                    <div class="row text-left">
                                        <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
                                            <div class="form-group fs">									
                                                <label><input type="checkbox" checked="checked" value="1" class="form-checkbox" name=""><span> 學歷：<?php echo "$profilerow[5]" ?></span></label><br><br><br>

                                                <input type="checkbox" checked="checked" value="1" class="form-checkbox" name=""> 科系：<br><br><input type="text" class="form-control" id=""><br><br><br>

                                                <label><input type="checkbox" checked="checked" value="1" class="form-checkbox" name=""><span> 在學期間：</span></label>
                                                <div id="sandbox-container">
                                                    <div class="input-daterange input-group" id="datepicker">
                                                        <input type="text" class="input-sm form-control" name="start">
                                                        <span class="input-group-addon">to</span>
                                                        <input type="text" class="input-sm form-control" name="end">
                                                    </div>
                                                </div>																				
                                            </div>                     
                                        </div>
                                    </div>     						
                                </div> 
                            </div><!--3學歷END-->
                        </div><!--ROW1 END-->
                        <br>
                        <div class="row">
                            <!--4語言能力-->
                            <div class="col-md-4 col-sm-12">
                                <div class="bn__8" style="height: 500px;">
                                    <span class="glyphicon glyphicon-th-list"></span> 語言能力<br><br>
                                    <div class="row text-left">
                                        <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
                                            <div class="form-group fs">	

                                                <input type="checkbox" checked="checked" value="1" class="form-checkbox" name=""> 外文：<br><br><textarea class="form-control" id="" placeholder="e.g. 英文；日文"  rows="6" style="resize:none" name="" ></textarea><br>
                                                <input type="checkbox" checked="checked" value="1" class="form-checkbox" name=""> 方言：<br><br><textarea class="form-control" id="" placeholder="e.g. 台語；客語"  rows="6" style="resize:none" name="" ></textarea>

                                            </div>                     
                                        </div>
                                    </div>						                                  
                                </div>                
                            </div><!--4語言能力END-->

                            <!--5技能專長-->
                            <div id="sk" class="col-md-4 col-sm-12">
                                <div class="bn__2" style="height: 500px;">
                                    <span class="glyphicon glyphicon-th-list"></span> 技能專長<br><br>
                                    <div class="form-group text-left">
                                        <div class="row">
                                            <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
                                                <div class="form-group fs">									

                                                    <input type="checkbox" checked="checked" value="1" class="form-checkbox" name=""> 擅長工具：<br><br><p>(放技能放技能放技能放技能放技能放技能放技能放技能放技能)</p><br><br><br>
                                                    <input type="checkbox" checked="checked" value="1" class="form-checkbox" name=""> 證照資格：<br><br><textarea class="form-control" id="" placeholder="e.g. 全民英檢高級；TOEIC 990"  rows="6" style="resize:none" name="" ></textarea>

                                                </div>	
                                            </div>								
                                        </div>  	
                                    </div>
                                </div>               
                            </div><!--5技能專長END-->

                            <!--6學習經歷-->
                            <div id="learn" class="col-md-4 col-sm-12">
                                <div class="bn__1" style="height: 500px;">
                                    <span class="glyphicon glyphicon-th-list"></span> 學習經歷<br><br>
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
                                            <div class="form-group fs">									
                                                <select multiple class="form-control selectform">
                                                    <?php
                                                    $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[0]'");
                                                    echo '<optgroup label=' . "'$classrow[0]'" . '>';
                                                    while ($resultrow = mysql_fetch_row($resultresult)) {
                                                        echo '<option value="' . $resultrow[0] . '">' . $resultrow[1] . '</option>';
                                                    }
                                                    echo '<optgroup label=' . "'$classrow[1]'" . '>';
                                                    $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[1]'");
                                                    while ($resultrow = mysql_fetch_row($resultresult)) {
                                                        echo '<option value="' . $resultrow[0] . '">' . $resultrow[1] . '</option>';
                                                    }
                                                    echo '<optgroup label=' . "'$classrow[2]'" . '>';
                                                    $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[2]'");
                                                    while ($resultrow = mysql_fetch_row($resultresult)) {
                                                        echo '<option value="' . $resultrow[0] . '">' . $resultrow[1] . '</option>';
                                                    }
                                                    echo '<optgroup label=' . "'$classrow[3]'" . '>';
                                                    $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[3]'");
                                                    while ($resultrow = mysql_fetch_row($resultresult)) {
                                                        echo '<option value="' . $resultrow[0] . '">' . $resultrow[1] . '</option>';
                                                    }
                                                    echo '<optgroup label=' . "'$classrow[4]'" . '>';
                                                    $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[4]'");
                                                    while ($resultrow = mysql_fetch_row($resultresult)) {
                                                        echo '<option value="' . $resultrow[0] . '">' . $resultrow[1] . '</option>';
                                                    }
                                                    echo '<optgroup label=' . "'$classrow[5]'" . '>';
                                                    $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[5]'");
                                                    while ($resultrow = mysql_fetch_row($resultresult)) {
                                                        echo '<option value="' . $resultrow[0] . '">' . $resultrow[1] . '</option>';
                                                    }
                                                    ?>

                                                </select>
                                                <h5 class="help-block text-left" style="color:red;">*按[Ctrl]及左鍵選擇多個項目</h5>

                                                <textarea class="form-control" id="" placeholder="我想新增學習經歷...                e.g. 網頁製作(2015/07/01-2015/08/31)"  rows="7" style="resize:none" name="" ></textarea>

                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div><!--6學習經歷END-->
                        </div><!--ROW2 END-->

                        <br>
                        <div class="row">
                            <!--7工作經驗-->
                            <div id="work" class="col-md-4 col-sm-12">
                                <div class="bn__22" style="height: 500px;">
                                    <span class="glyphicon glyphicon-th-list"></span> 工作經驗<br><br>
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
                                            <div class="form-group fs">							
                                                <select multiple class="form-control selectform">
                                                    <?php
                                                    $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[0]'");
                                                    echo '<optgroup label=' . "'$classrow[0]'" . '>';
                                                    while ($resultrow = mysql_fetch_row($resultresult)) {
                                                        echo '<option value="' . $resultrow[0] . '">' . $resultrow[1] . '</option>';
                                                    }
                                                    echo '<optgroup label=' . "'$classrow[1]'" . '>';
                                                    $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[1]'");
                                                    while ($resultrow = mysql_fetch_row($resultresult)) {
                                                        echo '<option value="' . $resultrow[0] . '">' . $resultrow[1] . '</option>';
                                                    }
                                                    echo '<optgroup label=' . "'$classrow[2]'" . '>';
                                                    $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[2]'");
                                                    while ($resultrow = mysql_fetch_row($resultresult)) {
                                                        echo '<option value="' . $resultrow[0] . '">' . $resultrow[1] . '</option>';
                                                    }
                                                    echo '<optgroup label=' . "'$classrow[3]'" . '>';
                                                    $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[3]'");
                                                    while ($resultrow = mysql_fetch_row($resultresult)) {
                                                        echo '<option value="' . $resultrow[0] . '">' . $resultrow[1] . '</option>';
                                                    }
                                                    echo '<optgroup label=' . "'$classrow[4]'" . '>';
                                                    $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[4]'");
                                                    while ($resultrow = mysql_fetch_row($resultresult)) {
                                                        echo '<option value="' . $resultrow[0] . '">' . $resultrow[1] . '</option>';
                                                    }
                                                    echo '<optgroup label=' . "'$classrow[5]'" . '>';
                                                    $resultresult = mysql_query("SELECT * FROM result where Classify ='$classrow[5]'");
                                                    while ($resultrow = mysql_fetch_row($resultresult)) {
                                                        echo '<option value="' . $resultrow[0] . '">' . $resultrow[1] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <h5 class="help-block text-left" style="color:red;">*按[Ctrl]及左鍵選擇多個項目</h5>

                                                <textarea class="form-control" id="" placeholder="我想新增工作經歷...                e.g. 王品工讀生(2015/07/01-2015/08/31)"  rows="7" style="resize:none" name="" ></textarea>

                                            </div>
                                        </div>
                                    </div>       
                                </div>                
                            </div><!--7工作經驗END-->

                            <!--8附件-->
                            <div id="attachment" class="col-md-4 col-sm-12">
                                <div class="bn__3" style="height: 500px;">
                                    <span class="glyphicon glyphicon-th-list"></span> 附件<br><br>
                                    <div class="row text-left">
                                        <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
                                            <div class="form-group fs">
                                                <select multiple="multiple" class="form-control" form="">
                                                    <?php
                                                    $sql = "SELECT A1.Title, A2.FileNo,A2.FileName FROM result as A1, file as A2 WHERE A1.ResultNo=A2.ResultNo AND A1.MemberNo='$MemberNo'";
                                                    $result = mysql_query($sql);
                                                    while ($filerow = mysql_fetch_row($result)) {
                                                        echo '<optgroup label=' . "'$filerow[0]'" . '>';
                                                        echo '<option value="' . $filerow[1] . '">' . $filerow[2] . '</option>';
                                                    }
                                                    ?>                                                 
                                                </select>
                                                <h5 class="help-block text-left" style="color:red;">*按[Ctrl]及左鍵選擇多個項目</h5>
                                                <button class="btn btn-default" target="_blank" data-toggle="modal"  data-target="#uploadab">編輯自傳</button>
                                            </div>                     
                                        </div>
                                    </div> 
                                </div>               
                            </div><!--8附件END-->

                            <!-- ABmodal Start -->
                            <div class="modal fade" id="uploadab" tabindex="-1" role="dialog" aria-labelledby="uploadabLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="uploadabLabel">編輯自傳</h4>
                                        </div>
                                        <div class="modal-body">
                                            寫下專屬於你自己的自傳吧...
                                            <textarea class="form-control" id="" placeholder=""  rows="20" style="resize:none" name="" ></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="deleteresult" onclick="">提交</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>						
                                        </div>
                                    </div>
                                </div>
                            </div>	
                            <!-- ABmodal End -->

                            <!--9其他-->
                            <div id="other" class="col-md-4 col-sm-12">
                                <div class="bn__4" style="height: 500px;">
                                    <span class="glyphicon glyphicon-th-list"></span> 其他<br><br>
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
                                            <div class="form-group fs">		
                                                <p>
                                                    <input id="new-task" class="form-control" type="text">
                                                    <button id="add" type="button">Add</button>
                                                </p>
                                                <p  class="self-add">自訂</p>
                                                <ul id="incomplete-tasks">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div> 
                            </div><!--9其他END-->
                        </div><!--ROW2 END-->


                        <br>
                        <br>
                        <div style="text-align:center">
                            <div class="form-group fs">
                                <input type="submit" class="btn2" id="check" style="" value="Finish">
                            </div>
                        </div>	
                    </form>
                </div>
            </div>
            <div class="main"></div>
        </div>

        <div class="footer"><div class="container text-center">© ETrace 2015. All right reserved.</div></div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap-datepicker.js"></script>
        <script src="js/bootstrap-datepicker.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/tsai.js"></script>
        <script src="js/app.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="js/friends.js"></script>
    </body>
</html>