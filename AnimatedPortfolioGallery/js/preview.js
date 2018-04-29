function saveResult(resultNo) {
    $.ajax({
        url: '../ajaxResult.php',
        dataType: 'json',
        type: 'POST',
        data: {
            resultNo: resultNo
        },
        error: function () {
            alert('Ajax request 發生錯誤');
        },
        success: function (response) {
            var dom = '<div class="content"  onclick="showresult(' + '\'../ajaxResult.php\'' + ',' + response['ResultNo'] + ')"  name="resultblock" id="' + response['ResultNo'] + '">';//左邊
            dom += '<div class="box">';
            if (response['FileType'].match("image")) {
                dom += '<a href="#"><img src="' + '../' + response['FileUrl'] + '" alt="" class="thumb"/></a>';
            } else {
                dom += '<a href="#"><img src="images/thumbs/1.jpg" alt="" class="thumb"/></a>';
            }
            dom += '<span class="caption simple-caption">';
            dom += '<p>' + response['Title'] + '</p>';
            dom += '</span>';
            dom += '</div>';
            dom += '</div>';
            $('#thumbcontainer').append(dom);
            var title = '<h1 name="title' + response['ResultNo'] + '" style="display:block;top:25px;">' + response['Title'] + '</h1>';
            $('#pg_title').append(title);
            var pg;
            if (response['FileType'].match("image")) {
                pg = '<img class="pg_thumb" style="display:block;z-index:9998;" name="pg' + response['ResultNo'] + '" src="' + '../' + response['FileUrl'] + '" alt="' + '../' + response['FileUrl'] + '"/>';
            } else {
                pg = '<img class="pg_thumb" style="display:block;z-index:9998;"name="pg' + response['ResultNo']+'" src="images/medium/1.jpg" alt="images/medium/1.jpg"/>';
            }
            $('#pg_preview').append(pg);
            var pg_desc1 = '  <div style="display:block;left:250px;" name="pg_desc1' + response['ResultNo'] + '">';
            pg_desc1 += '<h2>';
            pg_desc1 += '<button class="toolline" id="pic" target="_blank" data-toggle="modal"  data-target="#showpic"><i class="fa fa-picture-o" aria-hidden="true"></i></button>';
            pg_desc1 += '<button class="toolline" id="file" target="_blank" data-toggle="modal"  data-target="#showfile"><i class="fa fa-paperclip" aria-hidden="true"></i></button>';
            pg_desc1 += '<button class="toolline" id="youtube" target="_blank" data-toggle="modal"  data-target="#showyt"><i class="fa fa-youtube-play" aria-hidden="true"></i></button>';
            pg_desc1 += '<button type="button" class="style2-btn-del fa fa-trash-o" id="del" onclick="mymyfunction(' + response['ResultNo'] + ')"></button>';
            pg_desc1 += '<button type="button" class="style2-btn-edit fa fa-pencil" id="edit" target="_blank" data-toggle="modal" onclick="showedit(' + '\'../ajaxResult.php\'' + ',' + response['ResultNo'] + ')"  data-target="#editachi"></button>';
            pg_desc1 += '<button type="button" class="style2-btn-more fa fa-info" target="_blank" data-toggle="modal" data-target="#moreachi"></button>';
            pg_desc1 += '</h2>';
            pg_desc1 += '<p>';
            pg_desc1 += '<i class="fa fa-clock-o" aria-hidden="true">&nbsp;&nbsp;' + response['StartTime'] + '</i>';
            pg_desc1 += '<br>';
            pg_desc1 += '<i style="line-height:30px;" class="fa fa-comment" aria-hidden="true">&nbsp;&nbsp;' + response['Content'] + '</i>';
            pg_desc1 += '</p>';
            pg_desc1 += '</div>';
            $('#pg_desc1').append(pg_desc1);
            /* if(response['Youtube'] !== false){             
             }
             else if(response['FileType'].match("image")){            
             }else{               
             }                
             if (response['FileType'].match("image")) {
             }
             if (response['Youtube'] !== false) {
             }
             dom += '<button type="button" class="btn btn-more" id="more" target="_blank" data-toggle="modal"  data-target="#moreachi" onclick="showresult(' + "'../ajaxResult.php'" + ',' + response['ResultNo'] + ')">More</button>&nbsp;';
             dom += '<button type="button" class="btn btn-edit" id="edit" target="_blank" data-toggle="modal"  data-target="#editachi" onclick="showedit(' + "'../ajaxResult.php'" + ',' + response['ResultNo'] + ')">修改</button>&nbsp;';            
             dom += '<span class="cd-date">' + response['StartTime'] + '</span>';
             dom += '</div> <!-- cd-timeline-content -->';
             dom += '</div> <!-- cd-timeline-block -->';                   
             */
            $('.modal').modal('hide');
            loading();
        }
    });
}

function showresult(url, resultNo) {
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'POST',
        data: {resultNo: resultNo},
        error: function () {
            alert('Ajax request 發生錯誤');
            alert(resultNo);
        },
        success: function (response) {
            $("#moreimage1").attr("src", "");
            $("#moreimage").attr("src", "");
            $("#moreclassify").text(response['Classify']);
            $("#moreLabel").text(response['Title']);
            $("#morestarttime").text(" " + response['StartTime']);
            $("#morecontent").text(" " + response['Content']);
            $("#edtia").attr("onclick", 'showedit("' + response['ResultNo'] + '")');
            $("#dela").attr("onclick", 'deleteresult("' + response['ResultNo'] + '")');

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
                $("#moreyoutube1").attr("src", "");
                $("#moreiframe1").attr("style", "display:none");
            } else {
                $("#moreyoutube").attr("src", 'https://www.youtube.com/embed/' + response['Youtube']);
                $("#moreiframe").attr("style", "");
                $("#moreyoutube1").attr("src", 'https://www.youtube.com/embed/' + response['Youtube']);
                $("#moreiframe1").attr("style", "");
            }
            if (response['FileType'].match("image")) {
                $("#moreimage1").attr("src", '../' + response['FileUrl']);
                $("#moreimage").attr("src", '../' + response['FileUrl']);
            } else {
                $("#morefile1").text(response['FileName']);
                $("#morefile1").attr("href", '../' + 'Download.php?No='+response['FileNo']+'&filename='+response['FileName']);
                $("#morefile").text(response['FileName']);
                $("#morefile").attr("href", '../' + 'Download.php?No='+response['FileNo']+'&filename='+response['FileName']);
            }
        }
    });
}