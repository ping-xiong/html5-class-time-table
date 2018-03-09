<?php
/**
 * Created by PhpStorm.
 * User: https://pingxonline.com/
 * Date: 2018/3/6 0006
 * Time: 8:19
 */

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['api'])){
        include_once "connect.php";
        // 初始化数据库连接
        $db = new connectDataBase();

        $api = $db->test_input($_POST['api']);

        switch ($api){
            case 'getClass':
//                根据年份获取班级列表
                include_once "get.php";
                $get = new get($db);
                $grade = null;
                if (isset($_POST['grade']) && $_POST['grade']!= "" && $_POST['grade'] != null){
                    $grade = $db->test_input($_POST['grade']);
                }else{
                    $grade = 2017;
                }
                $get->get_class_by_grade($grade);
                break;
            case 'getSemester':
//                获取学期
                include_once "get.php";
                $get = new get($db);
                $get->get_Semester();
                break;
            case 'getYear':
//                获取数据库现存的学年
                include_once "get.php";
                $get = new get($db);
                $get->get_year();
                break;
        }
    }else{
        die('api参数缺失');
    }
}