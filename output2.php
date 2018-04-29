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

		
        <title>匯出 - ETrace</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
		<link href="css/chi.css" rel="stylesheet">
		<link href="css/chi-achieves-box.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/theme.css" rel="stylesheet">
        <link href="css/todostyle.css" rel="stylesheet">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

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
						<li class="dropdown">
							<a href="#" data-toggle="dropdown" class="dropdown-toggle"><img src="image/photo.jpg" class="img-rounded" height="35px" > 文琪 <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="profile2.php">個人資料</a></li>
									<li><a href="achieves2.php">成果</a></li>
									<li><a href="timeline.php">時間軸</a></li>
									<li><a href="output1.php">匯出</a></li>
									<li><a href="share1.php">分享</a></li>
									<li role="presentation" class="divider"></li>
									<li><a href="logout.php">登出</a></li>
								</ul>
						</li>	
                    </ul>
                </div>
            </div>
        </nav>
        <!--Let's us make Resume!-->
            <!-- 將你的表格資料放在 DIV 標籤之間。每一個項目用一個空白行隔開。 -->
            <!-- 在下面的 <scipt> 中，只要修改  TBcols 成為你要的直行數即可。 -->
		<div class="col-md-offset-2 col-md-8 col-sm-12">
			<div id ="te" class="container theme-showcase output" role="main">  
				<table class="rtable">
					<caption>2015-履歷表-test</caption>
						 <tr>
							  <td class="text-center oname" width="148.75" height="70">蔡文琪</td>
							  <td class="text-center oname" width="148.75" height="70">Betty</td>
							  <td></td>
							  <td height="70" class="text-left"><div class="hehe">附件</div> <hr>                         
							   <ul>
									<li>- 自傳</li>
									<li>- 作品集</li>
									<li>- 推薦函</li>    
								</ul>
							  </td>
						 </tr>

						<tr class="bottomborder">
							<td class="text-center"><img src="image/photo.jpg" width="140px;" height="auto"></td>
							<td class="text-center">
								<ul>
									<li class="otitle">21歲</li><br>
									<li class="otitle">女性</li><br>
									<li class="otitle">未婚</li>    
								</ul>
							</td>
							<td colspan="2" class="top">
								 </br></br>
								<p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>&nbsp;0912345678</p>
								<p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;abc123@gmail.com</p>
								<p><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;地址地址地址地址地址地址</p>                  
							</td>
						</tr>


						  <tr>
							  <td colspan="2"  class="hehe" width="148.75" height="50">學歷</td>
							  <td colspan="2" class="hehe" width="148.75" height="50" >語言能力</td>
						  </tr>
						  <tr>
							<td colspan="2" class=" top">
								<p>台灣科技大學</p>
								<p>資訊管理系</p>
								<p>2012/09/01 - 2016/06/30</p>
							</td>
							<td colspan="2" class="top">
								<p style="font-weight:bold">外文：</p>
								<p>英文；日文</p>
								<p style="font-weight:bold">方言：</p>
								<p>台語</p>
							</td>
							
						</tr>
						<tr>
							  <td colspan="2"  class="hehe" width="148.75" height="50" >技能專長</td>
							  <td colspan="2" class="hehe" width="148.75" height="50">學習經歷</td>
						 </tr>
						<tr>
							<td colspan="2" class=" top">
								<p>
									<canvas id="mm" width="150" height="150"></canvas>
								</p>
							</td>
							<td colspan="2" class="top">
								<p>這放啥(2015/07/01-2015/08/31)</p>
							</td>
						</tr>
						<tr class="hehe">
							  <td colspan="2"  class="hehe" width="148.75" height="50" >工作經驗</td>
							  <td colspan="2" class="hehe" width="148.75" height="50" >其他</td>
						</tr>
						<tr>
							<td colspan="2" class=" top">
								<p>十杯(2015/07/01-2015/08/31)</p>
								<p>九杯(2015/07/01-2015/08/31)</p>
								<p>八杯(2015/07/01-2015/08/31)</p>
							</td>
							<td colspan="2" height="30px" class=" top">
								<p>什麼都賣什麼都不奇怪 雅虎奇摩拍賣</p>
								<p>駕照</p>
							
							</td>
						</tr>
		 
				</table>
			<br><br><br>
			</div>
			<div id ="output2" class="container theme-showcase output" role="main">  
				<table class="rtable">
					<caption>2015-履歷表-蔡文琪</caption>
					
						<tr>
							<td class="text-center oname">蔡文琪</td>
							<td class="text-center oname">Betty Cai</td>
							<td></td>
							<td>
								<span class="otitle">附件</span><hr>
								<ul>
									<li>- 自傳</li>
									<li>- 作品集</li>
									<li>- 推薦函</li>    
								</ul>
							</td>
						</tr>
						<tr>
							<td class="selfborder text-center"><img src="image/photo.jpg" width="140px;" height="auto"></td>
							<td class="selfborder text-center">
								<ul>
									<li class="otitle">21歲</li><br>
									<li class="otitle">女性</li><br>
									<li class="otitle">未婚</li>    
								</ul>
							</td>
							<td colspan="2" class="selfborder top">
								<span class="otitle">聯絡資料</span><hr>
								<p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>&nbsp;0912345678</p>
								<p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;abc123@gmail.com</p>
								<p><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;地址地址地址地址地址地址</p>					
							</td>
						</tr>
						<tr>
							<td colspan="2" class="selfborder top">
								<span class="otitle">學歷</span><hr>
								<p>台灣科技大學</p>
								<p>資訊管理系</p>
								<p>2012/09/01 - 2016/06/30</p>
							</td>
							<td colspan="2" class="selfborder top">
								<span class="otitle">語言能力</span><hr>
								<p style="font-weight:bold">外文：</p>
								<p>英文；日文</p>
								<p style="font-weight:bold">方言：</p>
								<p>台語</p>
							</td>
							
						</tr>
						<tr>
							<td colspan="2" class="selfborder top">
								<span class="otitle">技能專長</span><hr>
								<p style="font-weight:bold">擅長工具：</p>
								<p>中打70字；英打40字；MS Office；PS；AI；DW</p>
								<p style="font-weight:bold">證照資格：</p>
								<p>TOEIC 900；軟體應用 乙級；TQC WORD</p>
							</td>
							<td colspan="2" class="selfborder top">
								<span class="otitle">學習經歷</span><hr>
								<p>這放啥(2015/07/01-2015/08/31)</p>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="selfborder top">
								<span class="otitle">工作經驗</span><hr>
								<p>十杯(2015/07/01-2015/08/31)</p>
								<p>九杯(2015/07/01-2015/08/31)</p>
								<p>八杯(2015/07/01-2015/08/31)</p>
							</td>
							<td colspan="2" height="30px" class="selfborder top">
								<span class="otitle">其他</span><hr>
								<p>什麼都賣什麼都不奇怪 雅虎奇摩拍賣</p>
							
							</td>
						</tr>
				</table>
				<br><br><br>
				<table class="rtable">                
					<tr>
						<td colspan="2" class="selfborder top">					
							<span class="otitle">自傳</span><hr>
							<p>放自傳很多字</p>
						</td>                    
				</table>
			</div>
			<br><br><br><br><br>
		</div>	
		<div class="text-center" style="clear:left">
            <button type="submit" class="btn2" id="check" style="">Finish  
        </div>
		<br><br><br><br><br>
		
		</div>
		
        <footer class="footer"><div class="container text-center">© ETrace 2015. All right reserved.</div></footer>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type='text/javascript'>
            var TBcols=4; //你可以在此修改表格的直行數。
            var DTlist;
            var oTD=document.getElementById('TBdata');
            if(oTD.textContent != undefined)
              DTlist=oTD.textContent.split("\n\n"); //FF newline twice
            else
              DTlist=oTD.innerText.split("\r\n\r\n"); //IE newline twice.

            for(var i=0; i < DTlist.length; i++)
            {
              if((i%TBcols)==0) document.write('<tr>');
              document.write('<td>'+DTlist[i]+'</td>');
            }
        </script>
        <script type='text/JavaScript'>
            var mm=document.getElementById("mm");
            var c=mm.getContext("2d");
            var a=mm.getContext("2d");
            var b=mm.getContext("2d");
            var d=mm.getContext("2d");
            c.moveTo(75,75);
            c.arc(75,75,75,Math.PI*1,Math.PI*1.3,false);
            c.fillStyle="rgb(0,255,0)";
            c.fill();
            a.beginPath();
            a.moveTo(75,75);
            a.arc(75,75,75,Math.PI*0.4,Math.PI*1,false);
            a.fillStyle="rgb(255,255,0)";
            a.fill();
            b.beginPath();
            b.moveTo(75,75);
            b.fillStyle="rgb(0,255,255)";
            b.arc(75,75,75,Math.PI*0,Math.PI*0.4,false);
            b.fill();
            d.beginPath();
            d.moveTo(75,75);
            d.fillStyle="rgb(255,0,255)";
            d.arc(75,75,75,Math.PI*1.3,Math.PI*0,false);
            d.fill();

            c.font="10pt 微軟正黑體";
            c.fillStyle="rgb(50,50,50)";
            c.fillText("HTML",10,60);
            a.fillText("多益999",7,105);
            b.fillText("PS",90,105);
            d.fillText("中打1千字",80,60);

        </script>

    </body>
</html>