<?php
/**
 * Created by PhpStorm.
 * User: https://pingxonline.com/
 * Date: 2018/3/5 0005
 * Time: 18:03
 */

include_once  "common/connect.php";
$db = new connectDataBase();

if (isset($_GET['semester']) && isset($_GET["classcode"])){

}else{
    header("Location: index.php");
}

$classcode = $db->test_input($_GET['classcode']);
$semester = $db->test_input($_GET['semester']);

$mysql = "SELECT * FROM `gxust_timetable` WHERE classCode = '{$classcode}' AND semester = '{$semester}'";
$arr_address = mysqli_query($db->link, $mysql);

$mysql = "SELECT note FROM `gxust_timetablenote` WHERE classCode = '{$classcode}' AND semester = '{$semester}'";
$note_address = mysqli_query($db->link, $mysql);
$note_address_arr = null;
if ($note_address == null){

}else{
    while ($row = mysqli_fetch_assoc($note_address)){
        $note = $row["note"];
        $note_address_arr = explode("//", $note);
    }
}


?>

<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
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
    <link rel="stylesheet" href="css/index.css">
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
            广科大课程表
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
    <table class="am-table am-table-bordered am-table-striped am-text-nowrap am-table-compact">
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
        $count = 1;
        while ($row = mysqli_fetch_assoc($arr_address)){

            $section = $row["section"];
            $one = $row["one"];
            $two = $row["two"];
            $three = $row["three"];
            $four = $row["four"];
            $five = $row["five"];
            $six = $row["six"];
            $seven = $row["seven"];

            echo "<tr>";
            echo "<td>".$count."</td>";
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

        ?>
    </table>
</div>

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
<div class="am-panel am-panel-default">
    <div class="am-panel-hd">备注</div>
    <div class="am-panel-bd">{$single_note}</div>
</div>
HTML;
}
?>



<footer data-am-widget="footer"
        class="am-footer am-footer-default"
        data-am-footer="{  }">
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

</body>
</html>