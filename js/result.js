function showresult(url,resultNo) {
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
            $("#moreimage").attr("src", "");
            $("#morefile").text(" ");
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
            } else {
                $("#moreyoutube").attr("src", 'https://www.youtube.com/embed/' + response['Youtube']);
                $("#moreiframe").attr("style", "");
            }
            if (response['FileType'].match("image")) {
                $("#moreimage").attr("src", '../'+'Download.php?No='+response['FileNo']+'&filename='+response['FileName']).css("display","block");
            } else {
                $("#morefile").text(response['FileName']);
                $("#morefile").attr("href",'../'+'Download.php?No='+response['FileNo']+'&filename='+response['FileName']);
            }
            if($("#moreimage").attr("src")==""){
                $("#moreimage").css("display","none");
            }
            $("#moreachi").modal();
        }
    });
}
function showedit(url,resultNo) {
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
                                                    $("#editachi").modal();
                                                }
                                            });
                                        }
                                        

