$.ajax({
    url: "common/api.php",
    type:"post",
    dataType: 'json',
    data:{api:"get_have_most_class_today"},
    success: function (result) {
        // console.log(result);
        var h = template('tpl-total-rank', result);
        document.getElementById('total-rank-container').innerHTML = h;
    }
});

$.ajax({
    url: "common/api.php",
    type:"post",
    dataType: 'json',
    data:{api:"get_class_in_one_day"},
    success: function (result) {
        console.log(result);
        // 获取横向标签
        var label_arr = [];
        var value_arr = [];
        $.each(result, function (index, value) {
            label_arr.push(index);
            value_arr.push(value);
        });
        var ctx = document.getElementById("today_rank");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: label_arr,
                datasets: [{
                    label: '课程数',
                    data: value_arr,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    }
});