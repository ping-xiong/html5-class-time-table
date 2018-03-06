getSemester();
getClass();
getYear();

function getClass() {
    var grade = $("#select-year").val();
    if(grade == null){
        grade = 2017;
    }
    $.ajax({
        url: "common/api.php",
        type:"post",
        dataType: 'json',
        data:{api:"getClass", grade:grade},
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

function getYear() {
    $.ajax({
        url: "common/api.php",
        type:"post",
        dataType: 'json',
        data:{api:"getYear"},
        success: function (result) {
            // console.log(result);
            $("#select-year").html("");
            $.each(result, function (key, value) {
                $("<option>").attr("value", value).html(value).appendTo("#select-year");
            })
        }
    });
}