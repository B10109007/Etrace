/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function preview(shareNo, style) {
    if (style === 1) {
        window.location.href = 'vertical-timeline/preview.php?No=' + shareNo;
    } else if (style === 2) {
        window.location.href = 'AnimatedPortfolioGallery/preview.php?No=' + shareNo;
    }
}
function deleteshare(OutputNo, style) {
    $.ajax({
        url: 'deleteshare.php',
        type: 'POST',
        data: {
            OutputNo: OutputNo,
            style: style,
        },
        error: function () {
            alert('Ajax request 發生錯誤');
        },
        success: function (response) {
            location.reload();
        }
    });

}
function passshareNo(shareNo, style) {
    $("#deletebtn").attr("onclick", "deleteshare(" + shareNo + "," + style + ")");
}
function edit(shareNo, style) {
    if (style === 1) {
        window.location.href = 'vertical-timeline/editShare.php?No=' + shareNo;
    } else if (style === 2) {
        window.location.href = 'AnimatedPortfolioGallery/editShare.php?No=' + shareNo;
    }
}
function copyURL(url) {
    if (window.clipboardData.setData("Text","www.google.com"))
        alert("已複製網址");
    else
        alert("複製失敗");
}  
function notyFriend(){
    
}