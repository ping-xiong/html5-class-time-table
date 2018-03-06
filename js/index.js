getSemester();
getClass();

function getClass() {
    $.ajax({
        url: "common/api.php",
        type:"post",
        dataType: 'json',
        data:{api:"getClass"},
        success: function (result) {
            $("#select-class").html("");
            $.each(result, function (key, value) {
                // console.log(value);
                $.each(value, function (key2, value2) {
                    $("<option>").attr("value", key2).html(value2).appendTo("#select-class");
                });

            })
        }
    });
}

function getSemester() {
    $.ajax({
        url: "common/api.php",
        type:"post",
        dataType: 'json',
        data:{api:"getSemester"},
        success: function (result) {
            // console.log(result);
            $("#select-semester").html("");
            $.each(result, function (key, value) {
                $("<option>").attr("value", value).html(value).appendTo("#select-semester");
            })
        }
    });
}