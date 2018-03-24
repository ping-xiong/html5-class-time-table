<?php
/**
 * Created by PhpStorm.
 * User: https://pingxonline.com/
 * Date: 2018/3/5 0005
 * Time: 18:03
 */

include_once  "common/connect.php";
$db = new connectDataBase();

// 检测是否存在url参数
if (isset($_GET['semester']) && isset($_GET["classcode"])){

}else{
    header("Location: index.php");
}

// 获取url参数
$classcode = $db->test_input($_GET['classcode']);
$semester = $db->test_input($_GET['semester']);
// 获取课程表
$mysql = "SELECT * FROM `gxust_timetable` WHERE classCode = '{$classcode}' AND semester = '{$semester}'";
$arr_address = mysqli_query($db->link, $mysql);
// 获取备注
$mysql = "SELECT note FROM `gxust_timetablenote` WHERE classCode = '{$classcode}' AND semester = '{$semester}'";
$note_address = mysqli_query($db->link, $mysql);
$note_address_arr = null;
if ($note_address == null){

}else{
    // 根据字符'//'分割备注字符串
    while ($row = mysqli_fetch_assoc($note_address)){
        $note = $row["note"];
        $note_address_arr = explode("//", $note);
    }
}

// 版本号
$version = 0.6;

?>

<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="广西科技大学课程表">
    <meta name="keywords" content="课程表助手">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>广西科技大学课程表</title>

    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">

    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <link rel="icon" type="image/png" href="Amaze%20UI/assets/i/favicon.png">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="Amaze%20UI/assets/i/app-icon72x72@2x.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <link rel="apple-touch-icon-precomposed" href="Amaze%20UI/assets/i/app-icon72x72@2x.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="Amaze%20UI/assets/i/app-icon72x72@2x.png">
    <meta name="msapplication-TileColor" content="#0e90d2">

    <link rel="stylesheet" href="Amaze%20UI/assets/css/amazeui.min.css">
    <link rel="stylesheet" href="Amaze%20UI/assets/css/app.css">
    <link rel="stylesheet" href="css/index.css<?php echo "?v=".$version;?>">
    <link rel="stylesheet" href="css/timetable.css<?php echo "?v=".$version;?>">
</head>
<body>
<header data-am-widget="header"
        class="am-header am-header-default am-header-fixed">
    <div class="am-header-left am-header-nav">
        <a href="index.php" class="">

            <i class="am-header-icon am-icon-home"></i>
        </a>
    </div>

    <h1 class="am-header-title">
        <a href="#title-link" class="">
            广科大课程表<a style="color: #e3e3e3; font-size: 11px; margin-left: 2px;" href="https://gitee.com/LiangJiaping/html5_curriculum"><?php echo "v".$version;?> 公测版</a>
        </a>
    </h1>

    <div class="am-header-right am-header-nav">
        <a href="#right-link" class="" data-am-offcanvas="{target: '#doc-oc-demo3'}">

            <i class="am-header-icon am-icon-bars"></i>
        </a>
    </div>
</header>

<!-- 侧边栏内容 -->
<div id="doc-oc-demo3" class="am-offcanvas">
    <div class="am-offcanvas-bar am-offcanvas-bar-flip">
        <div class="am-offcanvas-content">
            <a class="offcanvas-a" href="https://pingxonline.com/">站长博客</a>

            <a class="offcanvas-a" href="https://pingxonline.com/app/transcript/">成绩查询</a>

            <a class="offcanvas-a" href="help.html">使用帮助</a>

            <a class="offcanvas-a" href="history.html">更新历史</a>

            <a class="offcanvas-a" href="about.html">关于本站</a>

            <a class="offcanvas-a" href="index_old.html">返回旧版</a>
        </div>
    </div>
</div>


<div class="am-scrollable-horizontal">
<!--    am-text-nowrap-->
    <table class="am-table am-table-bordered am-table-striped am-text-nowrap am-table-compact timetable">
        <tr>
            <th></th>
            <th>星期一</th>
            <th>星期二</th>
            <th>星期三</th>
            <th>星期四</th>
            <th>星期五</th>
            <th>星期六</th>
            <th>星期日</th>
        </tr>

        <?php
        // 遍历输出课程表
        $time_table_arr = array();
        $count = 1;
        while ($row = mysqli_fetch_assoc($arr_address)){

            $time_table_sub_arr = array();
            $time_table_sub_arr["one"] = $row["one"];
            $time_table_sub_arr["two"] = $row["two"];
            $time_table_sub_arr["three"] = $row["three"];
            $time_table_sub_arr["four"] = $row["four"];
            $time_table_sub_arr["five"] = $row["five"];
            $time_table_sub_arr["six"] = $row["six"];
            $time_table_sub_arr["seven"] = $row["seven"];
            $time_table_arr[$count] = $time_table_sub_arr;

            $section = $row["section"];
            $one = $row["one"];
            $two = $row["two"];
            $three = $row["three"];
            $four = $row["four"];
            $five = $row["five"];
            $six = $row["six"];
            $seven = $row["seven"];

            if ($one == "none\n"){
                $one = "&#12288;";
            }
            if ($two == "none\n"){
                $two = "&#12288;";
            }
            if ($three == "none\n"){
                $three = "&#12288;";
            }
            if ($four == "none\n"){
                $four = "&#12288;";
            }
            if ($five == "none\n"){
                $five = "&#12288;";
            }
            if ($six == "none\n"){
                $six = "&#12288;";
            }
            if ($seven == "none\n"){
                $seven = "&#12288;";
            }

            echo "<tr>";
            echo "<td class='floating-td'>".$count."</td>";
            echo "<td>".$one."</td>";
            echo "<td>".$two."</td>";
            echo "<td>".$three."</td>";
            echo "<td>".$four."</td>";
            echo "<td>".$five."</td>";
            echo "<td>".$six."</td>";
            echo "<td>".$seven."</td>";
            echo "</tr>";
            $count++;
            if ($count > 13){
                break;
            }
        }


//        组装，合并连续课程
        $col = 7;
        $row = 13;
        for ($i=0;$i<count($time_table_arr);$i++){
            for ($y=0;$y<$col;$y++){

            }
        }

        ?>
    </table>
</div>
<p style="text-align: center; color: #535353;">向下滑动,查看更多信息...</p>
<!--输出备注-->
<?php
$single_note = "";
for ($i = 0; $i < count($note_address_arr); $i++){
    if ($note_address_arr[$i] == ""){
        continue;
    }
    $single_note.="<p>".$note_address_arr[$i]."</p>";
}
if ($single_note != "" && $single_note != null){
    echo <<<HTML
<div class="am-panel am-panel-secondary">
    <div class="am-panel-hd">备注</div>
    <div class="am-panel-bd">{$single_note}</div>
</div>
HTML;
}
?>

<!--统计图表-->

<!--排行榜-->
<div id="total-rank-container" class="am-panel am-panel-secondary">

</div>

<div class="am-panel am-panel-success">
    <div class="am-panel-hd">每个年级今日上课数量</div>
    <div class="am-panel-bd">
        <canvas class="canvas-class" id="today_rank"></canvas>
    </div>
</div>




<p style="text-align: center; color: #535353;">蹭课助手开发中，敬请期待...</p>

<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more">喜欢我的网站？请支持网站发展，分享给朋友：</a><br/><br/><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间">QQ空间</a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博">新浪微博</a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博">腾讯微博</a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信">微信</a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友">QQ好友</a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"广科大班级课表-全方位的查课助手","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"16"},"share":{"bdSize":16}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>


<footer data-am-widget="footer"
        class="am-footer am-footer-default"
        data-am-footer="{  }">

    <div class="am-footer-switch" style="width: 332px;margin: 0 auto;overflow: hidden;">

    </div>
    <br>
    <div class="am-footer-miscs ">
        <p>由 <a href="https://pingxonline.com/" title="梁嘉平"
                target="_blank" class="">国教院@梁嘉平</a>
            提供技术支持</p>

        <p><a href="help.html">使用帮助</a></p>
    </div>
</footer>


<!--[if (gte IE 9)|!(IE)]><!-->
<script src="js/jquery-3.2.1.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="Amaze%20UI/assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script src="Amaze%20UI/assets/js/amazeui.min.js"></script>

<!--绘图插件-->
<script src="js/Chart.min.js"></script>
<!--模板引擎-->
<script src="js/template-web.js"></script>

<!--渲染JS-->
<script src="js/render.js<?php echo "?v=".$version;?>"></script>

<!--排行榜模板-->
<script id="tpl-total-rank" type="text/html">
    <div class="am-panel-hd">今日课程数量排行榜</div>
    <div class="am-panel-bd">
        <ul class="am-list total-rank">
            {{each}}

            <li>
                <div class="am-g padding-top-bottom">
                    <div class="am-u-sm-2">{{$index+1}}</div>
                    <div class="am-u-sm-7 underline" onclick="window.location.href='timetable.php?classcode={{$value.classCode}}&semester={{$value.semester}}'">{{$value.className}}</div>
                    <div class="am-u-sm-3">{{$value.total}}</div>
                </div>
            </li>

            {{/each}}
        </ul>
    </div>
</script>

</body>
</html>