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
        include_once "get.php";
        $get = new get($db);

        switch ($api){
            case 'getClass':
//                根据年份获取班级列表
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
                $get->get_Semester();
                break;
            case 'getYear':
//                获取数据库现存的学年
                $get->get_year();
                break;
            case 'get_class_in_one_day':
                // 获取每个年级某个星期上课的数量
                $get->get_class_in_one_day();

                break;

            case 'get_have_most_class_today':
                // 获取今日上课数量的排名

                $get->get_have_most_class_today();

                break;
        }
    }else{
        die('api参数缺失');
    }
}