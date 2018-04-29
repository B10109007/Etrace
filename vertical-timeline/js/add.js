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
            var dom = '<div class="cd-timeline-block" name="resultblock" id="' + response['ResultNo'] + '">';
            if(response['Youtube'] !== false){
                 dom += '<div class="cd-timeline-img cd-movie">';
                 dom += '<img src="img/cd-icon-movie.svg" alt="Movie">';                              
                 dom += '</div>';                  
            }
            else if(response['FileType'].match("image")){
                dom += '<div class="cd-timeline-img cd-picture">';
                dom += '<img src="img/cd-icon-picture.svg" alt="Picture">';                              
                dom += '</div>';
            }else{
                dom += '<div class="cd-timeline-img cd-location">';
                dom += '<img src="img/cd-icon-location.svg" alt="Location">';
                dom += '</div>';
            }         
            dom += '<div class="cd-timeline-content">';
            dom += '<h2 class="ellipsis" >' + response['Title'] + '</h2>';
            dom += '<button type="button" class="close" onclick="mymyfunction($(\'#' + response['ResultNo'] + '\'))")"><span aria-hidden="true">&times;</span></button>';
            dom += '<p class="ellipsis">' + response['Content'] + '</p>';
            if (response['FileType'].match("image")) {
                dom += '<img class="imgsize" src="' + '../' + response['FileUrl'] + '"></br></br>';
            }
            if (response['Youtube'] !== false) {
                dom += ' <div class="video-container"><iframe src="' + 'https://www.youtube.com/embed/' + response['Youtube'] + '" frameborder="0" allowfullscreen></iframe></div></br>';
            }
            dom += '<button type="button" class="btn btn-more" id="more" target="_blank" data-toggle="modal"  data-target="#moreachi" onclick="showresult(' + "'../ajaxResult.php'" + ',' + response['ResultNo'] + ')">More</button>&nbsp;';
            dom += '<button type="button" class="btn btn-edit" id="edit" target="_blank" data-toggle="modal"  data-target="#editachi" onclick="showedit(' + "'../ajaxResult.php'" + ',' + response['ResultNo'] + ')">修改</button>&nbsp;';            
            dom += '<span class="cd-date">' + response['StartTime'] + '</span>';
            dom += '</div> <!-- cd-timeline-content -->';
            dom += '</div> <!-- cd-timeline-block -->';            
            $('#addbtn').after(dom);
            sortUsingNestedText($('#cd-timeline'), "div", "span.cd-date");
            $('.modal').modal('hide');
        }
    });
}

function mymyfunction(obj){
	swal({   
		 title: "Are you sure?",  
		 text: "刪了就沒囉給我想清楚^^",
		 type: "warning",
		   showCancelButton: true,   
		   cancelButtonText: "不，偶狠不下心", 
		   confirmButtonColor: "#DD6B55",   
		   confirmButtonText: "好，就刪了吧!",   
		   closeOnConfirm: false }, 
		   function(){   
                        deleteResult(obj);
			swal("Deleted!", "檔案已經被清掉了^_^叫破喉嚨也不會回來囉~", "success"); 
			});
	};
	
function deleteResult(obj) {
    obj.remove();
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
    saveResult(responseText);
}

function editSuccesful(responseText) {
    $('#loading').hide();
    $('.modal').modal('hide');
    var obj = '#' + responseText.trim();
    deleteResult($(obj));
    saveResult(responseText);
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
    var items = parent.children(childSelector).sort(function(a, b) {
        var vA = $(keySelector, a).text();
        var vB = $(keySelector, b).text();
        return (vA < vB) ? -1 : (vA > vB) ? 1 : 0;
    });
    parent.append(items);
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
     


