function saveResult(resultNo, length) {
    $.ajax({
        url: '../ajaxResult.php',
        dataType: 'json',
        type: 'POST',
        async: false,
        data: {
            resultNo: resultNo
        },
        error: function () {
            alert('Ajax request 發生錯誤');
        },
        success: function (response) {
            var dom = '<div class="content" onclick="showresult(' + '\'../ajaxResult.php\'' + ',' + response['ResultNo'] + ');showedit(' + '\'../ajaxResult.php\'' + ',' + response['ResultNo'] + ')"  name="resultblock" id="' + response['ResultNo'] + '">';//左邊
            dom += '<div class="box">';
            if (response['FileType'].match("image")) {
                dom += '<a href="#"><img src="' + '../' + response['FileUrl'] + '" alt="" class="thumb"/></a>';
            } else {
                if (response['Youtube'] !== false) {
                    dom += '<a href="#"><img src="' + 'http://img.youtube.com/vi/' + response['Youtube'] + '/0.jpg' + '" alt="" class="thumb"/><i class="fa fa-youtube fa-4x" style="z-index: 999;position: absolute;right: 5%;bottom: 10%;"></i></a>';
                } else {
                    dom += '<a href="#"><img src="images/default.jpg" alt="" class="thumb"/></a>';
                }
            }

            dom += '<span class="caption simple-caption">';
            dom += '<p>' + response['Title'] + '</p>';
            dom += '</span>';
            dom += '</div>';
            dom += '</div>';
            $('#thumbcontainer').append(dom);
            var title
            if (length === 0) {
                title = '<h1 style="display:block;top:25px;" name="title' + response['ResultNo'] + '" >' + response['Title'] + '</h1>';
            } else {
                title = '<h1 name="title' + response['ResultNo'] + '" >' + response['Title'] + '</h1>';
            }

            $('#pg_title').append(title);
            var pg;
            if (length === 0) {
                if (response['FileType'].match("image")) {
                    pg = '<a href="'+'../' + response['FileUrl']+ '" data-lightbox="image-1" data-title="'+response['Title']+'"><img class="pg_thumb" style="display:block;z-index:9999;" name="pg' + response['ResultNo'] + '" src="' + '../' + response['FileUrl'] + '"/></a>';
                } else {
                    if (response['Youtube'] !== false) {
                        pg = '<img class="pg_thumb" style="display:block;z-index:9999;" name="pg' + response['ResultNo'] + '" src="' + 'http://img.youtube.com/vi/' + response['Youtube'] + '/0.jpg' + '" target="_blank" data-toggle="modal" data-target="#showyt"/>';
                    } else {
                        pg = '<a href="images/default.jpg" data-lightbox="image-1" data-title="'+response['Title']+'"><img class="pg_thumb" style="display:block;z-index:9999;" name="pg' + response['ResultNo'] + '" src="images/default.jpg" alt="images/default.jpg"/></a>';
                    }
                }
            } else {
                if (response['FileType'].match("image")) {
                    pg = '<a href="'+'../' + response['FileUrl']+ '" data-lightbox="image-1" data-title="'+response['Title']+'"><img class="pg_thumb" name="pg' + response['ResultNo'] + '" src="' + '../' + response['FileUrl'] + '" alt="' + '../' + response['FileUrl'] + '"/></a>';
                } else {
                    if (response['Youtube'] !== false) {
                        pg = '<img class="pg_thumb" name="pg' + response['ResultNo'] + '" src="' + 'http://img.youtube.com/vi/' + response['Youtube'] + '/0.jpg' + '" alt="' + 'http://img.youtube.com/vi/' + response['Youtube'] + '/0.jpg' + '" target="_blank" data-toggle="modal" data-target="#showyt"/>';
                    } else {
                        pg = '<a href="images/default.jpg" data-lightbox="image-1" data-title="'+response['Title']+'"><img class="pg_thumb" name="pg' + response['ResultNo'] + '" src="images/default.jpg" alt="images/default.jpg"/></a>';
                    }
                }
            }
            $('#pg_preview').append(pg);
            if (length === 0) {
                var pg_desc1 = '<div style="display:block;left:250px;" name="pg_desc1' + response['ResultNo'] + '">';
            } else {
                var pg_desc1 = '<div  name="pg_desc1' + response['ResultNo'] + '">';
            }
            pg_desc1 += '<h2>';
            pg_desc1 += '<button class="toolline" id="pic" target="_blank" data-toggle="modal"  data-target="#showpic"><i class="fa fa-picture-o" aria-hidden="true"></i></button>';
            pg_desc1 += '<button class="toolline" id="file" target="_blank" data-toggle="modal"  data-target="#showfile"><i class="fa fa-paperclip" aria-hidden="true"></i></button>';
            pg_desc1 += '<button class="toolline" id="youtube" target="_blank" data-toggle="modal"  data-target="#showyt"><i class="fa fa-youtube-play" aria-hidden="true"></i></button>';
            pg_desc1 += '<button type="button" class="style2-btn-del fa fa-trash-o" id="del" onclick="mymyfunction($(this).parent().parent().index())"></button>';
            pg_desc1 += '<button type="button" class="style2-btn-edit fa fa-pencil" id="edit" target="_blank" data-toggle="modal" onclick="showedit(' + '\'../ajaxResult.php\'' + ',' + response['ResultNo'] + ');$(\'#resultindex\').val($(this).parent().parent().index())"  data-target="#editachi"></button>';
            pg_desc1 += '<button type="button" class="style2-btn-more fa fa-info" target="_blank" data-toggle="modal" data-target="#moreachi"></button>';
            pg_desc1 += '</h2>';
            pg_desc1 += '<p>';
            pg_desc1 += '<i class="fa fa-clock-o" aria-hidden="true">&nbsp;&nbsp;' + response['StartTime'] + '</i>';
            pg_desc1 += '<br>';
            pg_desc1 += '<i style="line-height:30px;" class="fa fa-comment" aria-hidden="true">&nbsp;&nbsp;' + response['Content'] + '</i>';
            pg_desc1 += '</p>';
            pg_desc1 += '</div>';
            $('#pg_desc1').append(pg_desc1);
            if (length === 0) {
                showresult('../ajaxResult.php', response['ResultNo']);
                showedit('../ajaxResult.php', response['ResultNo']);
            }
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
            //showresult('../ajaxResult.php',response['ResultNo']);            
        }
    });
    loading();
}

function mymyfunction(index) {
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
        deleteResult(index);
        swal("Deleted!", "檔案已經被清掉了^_^叫破喉嚨也不會回來囉~", "success");
        loading();
    });
}

function deleteResult(index) {
    $("#thumbcontainer").children("div:eq(" + index + ")").remove();
    $("#pg_title").children("h1:eq(" + index + ")").remove();
    $("#pg_preview").children("a:eq(" + index + ")").remove();
    $("#pg_desc1").children("div:eq(" + index + ")").remove();
}
$(function () {
    $('#form1').ajaxForm({
        beforeSubmit: ShowRequest,
        success: SubmitSuccesful,
        error: AjaxError
    });
    $('#editResult').ajaxForm({
        beforeSubmit: ShowRequest,
        success: editSuccesful,
        error: AjaxError
    });
});

function ShowRequest(formData, jqForm, options) {
    //var queryString = $.param(formData);
    //alert('BeforeSend method: \n\nAbout to submit: \n\n' + queryString);
    $('#loading').show();
    return true;
}

function AjaxError() {
    alert("An AJAX error occured.");
}

function SubmitSuccesful(responseText, statusText) {
    //alert("SuccesMethod:\n\n" + responseText); 
    $('#loading').hide();
    $('#form1').resetForm();
    $('.modal').modal('hide');
    saveResult(responseText,$('#thumbcontainer').children().length);
}

function editSuccesful(responseText) {
    $('#loading').hide();
    $('.modal').modal('hide');
    deleteResult($("#resultindex").val());
    saveResult(responseText,$('#thumbcontainer').children().length);
}

function submit() {
    var arr = [];
    $("[name='resultblock']").each(function () {
        arr.push($(this).attr("id"));
    })
    var jsonString = JSON.stringify(arr);
    $.ajax({
        url: 'addshare_finish.php',
        type: 'POST',
        data: {
            title: $("#title").text(),
            arr: jsonString,
        },
        error: function () {
            alert('Ajax request 發生錯誤');
        },
        success: function (response) {
            window.location.href = '../share2.php';
        }
    });
}

function sortUsingNestedText(parent, childSelector, keySelector) {
    var items = parent.children(childSelector).sort(function (a, b) {
        var vA = $(keySelector, a).text();
        var vB = $(keySelector, b).text();
        return (vA < vB) ? -1 : (vA > vB) ? 1 : 0;
    });
    parent.append(items);
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

function showedit(url, resultNo) {
    $.ajax({
        url: url,
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
            if (response['Youtube'] !== false) {
                $("#edityoutube").attr("value", 'https://youtu.be/' + response['Youtube']);
            } else {
                $("#edityoutube").attr("value", '');
            }
            var classify = response['Classify'];
            $("[name='editresultclass']" + "[value='" + classify + "']").prop("checked", true);
            $("[name='editresultclass']" + "[value='" + classify + "']").parent().addClass("active");
            $("#editResultNo").attr("value", response['ResultNo']);
        }
    });

}

$(document).ready(function () {
    $('.modal').on('show.bs.modal', function () {
        if ($(document).height() > $(window).height()) {
            // no-scroll
            $('body').addClass("modal-open-noscroll");
        } else {
            $('body').removeClass("modal-open-noscroll");
        }
    })
    $('.modal').on('hide.bs.modal', function () {
        $('body').removeClass("modal-open-noscroll");
    })
}) //<!--ModalBugFixed-->   /* 





