function editsubmit(outputNO) {
    var arr = [];
    $("[name='resultblock']").each(function () {
        arr.push($(this).attr("id"));
    })
    var jsonString = JSON.stringify(arr);
    $.ajax({
        url: 'edit_finish.php',
        type: 'POST',
        data: {
            title: $("#title").val(),
            outputNO: outputNO,
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

