<?php
/**
 * Created by PhpStorm.
 * User: https://pingxonline.com/
 * Date: 2018/3/5 0005
 * Time: 17:43
 */

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

            <a class="offcanvas-a" href="history.html">更新历史</a>

            <a class="offcanvas-a" href="about.html">关于本站</a>
        </div>
    </div>
</div>

<!--在这里编写你的代码-->
<main class="search am-panel am-panel-secondary">
    <div class="am-panel-hd" style="text-align: center">
        开始查询
    </div>
    <div class="am-panel-bd">
        <label for="select-class">选择班级</label><br>
        <select id="select-class" data-am-selected="{btnWidth: '100%', searchBox: 1}">

        </select>
        <br>
        <label for="select-semester">选择学期</label><br>
        <select id="select-semester" data-am-selected="{btnWidth: '100%', searchBox: 1}">

        </select>
        <button type="button" class="am-btn am-btn-primary start-search">查询</button>
    </div>
</main>

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="js/jquery-3.2.1.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="Amaze%20UI/assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script src="Amaze%20UI/assets/js/amazeui.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>
