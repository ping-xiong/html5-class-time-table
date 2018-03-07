getYear();

var new_year;

// 开启本地存储
var store = $.AMUI.store;

if (!store.enabled) {
    $(".history").hide();
}else{
    var data = store.get('timetable');
    console.log(data);
    if(data == null){
        data = [];
        $(".history").hide();
    }
    $(".history-list").html("");
    for(var i=0; i < data.length; i++){
        $("<a>").attr("href", "timetable.php?classcode="+data[i].classcode+"&semester="+data[i].semester).addClass("am-badge am-badge-warning am-radius am-text-sm").text(data[i].classname+"#"+data[i].semester).appendTo(".history-list");
    }
}

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

function submit_table() {
    var class_code = $("#select-class").val();
    var class_name = $("[value='"+class_code+"']").text();
    var semester = $("#select-semester").val();


    if (!store.enabled) {

    }else{
        var data = store.get('timetable');
        if(data == null){
            data = [];
        }
        var obj = { classcode: class_code, semester: semester, classname:class_name };
        var canBeAdded = 0;
        for(var i=0; i < data.length; i++){
            if(class_code === data[i].classcode && semester === data[i].semester){
                canBeAdded = 1;
            }
        }
        if(canBeAdded === 0){
            data.push(obj);
            store.set("timetable", data);
        }

    }
    window.location.href = "timetable.php?classcode="+class_code+"&semester="+semester;
}

