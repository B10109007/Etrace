
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function friendrequest(){
    $("#friendmenu").empty();
    $.ajax({
            url: 'ShowMemRequest.php',
            dataType: 'json',
            async:false,
            data: {
            },
            error: function () {
                alert('Ajax request 發生錯誤');
            },
            success: function (response) {
                if(response!=null){
                var NumOfJData = response.length;
                for (var i = 0; i < NumOfJData; i++) {
                    var str="";
                    str +='<li><a><img src="'+response[i].photourl+'" class="" height="35px">'+response[i].Name+'提出朋友邀請&nbsp;';
                    str +='<button type="button" class="nav-btn nav-accept-btn" onclick="accept(' + response[i].MemberNo + "," + '\'' + response[i].Name + '\'' + ')">接受</button>&nbsp;';
                    str +='<button type="button" class="nav-btn nav-reject-btn" onclick="decline(' + response[i].MemberNo + "," + '\'' + response[i].Name + '\'' + ')">拒絕</button>';
                    str += '</a></li>';
                    $("#friendmenu").append(str);
                }
            }
            }
        });
}
function accept(friendNo, name) {
    $.ajax({
        url: 'FriendDecision.php',
        dataType: 'text',
        type: 'POST',
        async:false,
        data: {
            friendNo: friendNo,
            ans: "Y",
        },
        error: function () {
            alert('Ajax request 發生錯誤');
        },
        success: function (response) {
            if (response == "Y") {
                swal({
                    title: "耐斯!",
                    text: "你成功與 " + name + "成為好友",
                    type: "success"
                },
                function () {
                    window.location.reload();
                });
            }
        }
    });
}
function decline(friendNo, name) {
    $.ajax({
        url: 'FriendDecision.php',
        dataType: 'text',
        type: 'POST',
        async:false,
        data: {
            friendNo: friendNo,
            ans: "N",
        },
        error: function () {
            alert('Ajax request 發生錯誤');
        },
        success: function (response) {
            if (response == "Y") {
                 swal({
                    title: "耐斯!",
                    text: "你成功拒絕與 " + name + "成為好友",
                    type: "error"
                },
                function () {
                    window.location.reload();
                });
            }
        }
    });
}

function mynoty(alertNo,context) {
    noty({
        text: context,
        layout: 'bottomRight',
        type: 'success',
        theme: 'bootstrapTheme',
        maxVisible: 7,
        animation: {
            open: 'animated bounceInLeft', // Animate.css class names
            close: 'animated flipOutX', // Animate.css class names
            easing: 'swing', // unavailable - no need
            speed: 500 // unavailable - no need
        },
        callback: {
            onCloseClick: function() {
                 $.ajax({
                    url: 'deleteAlert.php',
                    type: 'POST',                   
                    data:{
                        alertNo:alertNo,
                    },
                    error: function () {
                        alert('Ajax request 發生錯誤');
                    },
                });
            },
        }
    });
}

$(document).ready(function () {
    $.ajax({
        url: 'alert.php',
        dataType: 'json',
        async:false,
        data: {
        },
        error: function () {
            alert('Ajax request 發生錯誤');
        },
        success: function (response) {
            if(response!=null){
            var NumOfJData = response.length;
            for (var i = 0; i < NumOfJData; i++) {
                mynoty(response[i].alertNo,response[i].context);
            }
            }
        }
    });
});
