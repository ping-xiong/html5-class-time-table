getYear();

var new_year;

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

            });
            getSemester();
        }
    });
}

function getSemester() {
    var classcode = $("#select-class").val();
    if(classcode == null){
        classcode = new_year;
    }else{
        classcode = parseInt(classcode[0]+classcode[1]);
    }
    $.ajax({
        url: "common/api.php",
        type:"post",
        dataType: 'json',
        data:{api:"getSemester"},
        success: function (result) {
            // console.log(result);
            $("#select-semester").html("");
            $.each(result, function (key, value) {
                var x = parseInt(value[0]+value[1]);
                if(x < classcode || classcode < x-3){

                }else{
                    $("<option>").attr("value", value).html(value).appendTo("#select-semester");
                }

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
                if(key === 0){
                    new_year = parseInt(value[2]+value[3]);
                }
                $("<option>").attr("value", value).html(value).appendTo("#select-year");

            });
            getClass();
        }
    });
}