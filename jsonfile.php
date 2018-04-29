<?php 
session_start(); 
include("mysql_connect.inc.php");
$sql = "SELECT * FROM result where MemberNo='{$_SESSION['MemberNo']}';";
$result = mysql_query($sql);
$json = array(
    "title" => array(
        "media" => array(
            "caption" => "",
            "credit" => "",
            "url" => "image/opening-logo.png",
            "thumb" => ""
        ),
        "text" => array(
            "headline" => "Welcome to Etrace",
            "text" => "<p>在使用本功能前請至成果頁面新增成果 豐富你的時間軸</p>"
        )
    )
);
$count=0;
while ($row = mysql_fetch_row($result)) {
    $sql2 = "SELECT * FROM file where ResultNo='$row[0]'";
    $result2 = mysql_query($sql2);
    $filerow = mysql_fetch_row($result2);
    $json['events'][$count]['start_date']['year'] = date("Y",strtotime($row[3]));
    $json['events'][$count]['start_date']['month'] =date("m",strtotime($row[3]));
    $json['events'][$count]['start_date']['day'] = date("d",strtotime($row[3]));
    $json['events'][$count]['start_date']['hour'] = "";
    $json['events'][$count]['start_date']['minute'] = "";
    $json['events'][$count]['start_date']['second'] = "";
    $json['events'][$count]['start_date']['millisecond'] = "";
    $json['events'][$count]['start_date']['format'] = "";
    $json['events'][$count]['end_date']['year'] = date("Y",strtotime($row[4]));
    $json['events'][$count]['end_date']['month'] =date("m",strtotime($row[4]));
    $json['events'][$count]['end_date']['day'] = date("d",strtotime($row[4]));
    $json['events'][$count]['end_date']['hour'] = "";
    $json['events'][$count]['end_date']['minute'] = "";
    $json['events'][$count]['end_date']['second'] = "";
    $json['events'][$count]['end_date']['millisecond'] = "";
    $json['events'][$count]['end_date']['format'] = "";
    $json['events'][$count]['group'] = "$row[5]";
  
    $json['events'][$count]['media']['credit'] = "";
    if("$row[8]"!=""){
    $json['events'][$count]['media']['url'] = "$row[8]";
    }else if(strpos("$filerow[2]", 'image') !== false){
    $json['events'][$count]['media']['url'] = "$filerow[4]";    
    $json['events'][$count]['media']['caption'] = "<a href="."$filerow[4]"." download="."$filerow[4]".">$filerow[1]</a>";
    }else{
    $json['events'][$count]['media']['url'] = ""; 
    }
    $json['events'][$count]['text']['headline'] = "$row[1]".'<span class="slide-tag">'.$row[5]."</span>";
    $json['events'][$count]['text']['text'] = "$row[6]";
    $count++;
}
echo json_encode($json, JSON_UNESCAPED_SLASHES);
//header('Content-Type: application/json; charset=utf-8');

?>
