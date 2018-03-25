<?php
/**
 * Created by PhpStorm.
 * User: https://pingxonline.com/
 * Date: 2018/3/6 0006
 * Time: 8:30
 */

ini_set('date.timezone','Asia/Shanghai');

class get
{
    private $link;
    private $now_semester;
    private $now_classYear_arr;

    public function __construct($db){
        $this->link = $db->link;

        // 选择这个学期
        $sql = "SELECT * FROM `gxust_semester` LIMIT 1";
        $this->now_semester = mysqli_fetch_assoc(mysqli_query($this->link, $sql))['semester'];

        // 选出年级
        $sql ="SELECT `grade` FROM `gxust_class` GROUP BY `grade` ORDER BY `grade` DESC LIMIT 4";
        $result = mysqli_query($this->link, $sql);
        $this->now_classYear_arr = array();
        while ($row = mysqli_fetch_assoc($result)){
            $this->now_classYear_arr[] = $row['grade'];
        }

    }

    // 通过学年获取班级
    public function get_class_by_grade($grade){
        $sql = "SELECT * FROM `gxust_class` WHERE `grade` = {$grade}";
        $result = mysqli_query($this->link, $sql);
        $arr = array();
        while ($row = mysqli_fetch_assoc($result)){
            $sub_arr = array();
            $sub_arr[$row['classCode']] = $row['className'];
            $arr[] = $sub_arr;
        }
        echo json_encode($arr);
    }

    // 获取学期
    public function  get_Semester(){
        $sql = "SELECT * FROM `gxust_semester` WHERE 1";
        $result = mysqli_query($this->link, $sql);
        $arr = array();
        while ($row = mysqli_fetch_assoc($result)){
            $arr[] = $row['semester'];
        }
        echo json_encode($arr);
    }

    //获取所有学年
    public function get_year(){
        $sql = "SELECT `grade` FROM `gxust_class` WHERE 1 GROUP BY `grade` DESC ";
        $result = mysqli_query($this->link, $sql);
        $arr = array();
        while ($row = mysqli_fetch_assoc($result)){
            $arr[] = $row['grade'];
        }
        echo json_encode($arr);
    }

    // 获取每个年级某个星期上课的数量
    public function get_class_in_one_day($today = ""){
        // 获取英文星期

        // 如果为空，获取今天的
        if ($today == ""){
            $week_array = array("seven","one","two","three","four","five","six"); //先定义一个数组
            $today = $week_array[date("w")];
        }

        $json = array();

        for ($i=0;$i<count($this->now_classYear_arr);$i++){
            $now_year = str_split($this->now_classYear_arr[$i],2)[1];
            $now_semester = $this->now_semester;
            $sql = "SELECT COUNT(*) AS total FROM `gxust_timetable` WHERE `semester` = '{$now_semester}' AND `classCode` LIKE '{$now_year}%' AND `{$today}` <> 'none\n'";
            $result = mysqli_query($this->link, $sql);
            $row = mysqli_fetch_assoc($result);
            $json["{$this->now_classYear_arr[$i]}"] = $row['total'];
        }

        echo json_encode($json);
    }

    // 获取正在上课的班级
    public function get_having_class(){

    }

    // 获取今日上课排名
    public function get_have_most_class_today(){

        $now_semester = $this->now_semester;

        $week_array = array("seven","one","two","three","four","five","six"); //先定义一个数组
        $today = $week_array[date("w")];

        $sql = "SELECT `gxust_timetable`.`classCode`,`gxust_class`.`className`, COUNT( `gxust_timetable`.`{$today}`) as total FROM `gxust_timetable`, `gxust_class` WHERE `gxust_timetable`.`classCode`=`gxust_class`.`classCode` AND  `semester` = '$now_semester' AND (`{$today}` <> 'none\n') GROUP BY `classCode` ORDER BY total DESC LIMIT 10";
        $result = mysqli_query($this->link, $sql);
        $rank = array();
        while ($row = mysqli_fetch_assoc($result)){
            $rank_sub = array();
            $rank_sub['classCode'] = $row['classCode'];
            $rank_sub['semester'] = $now_semester;
            $rank_sub['className'] = $row['className'];
            $rank_sub['total'] = $row['total'];
            $rank[] = $rank_sub;
        }

        echo json_encode($rank);

    }

    // 获取全校的排课排名
    public function get_have_most_class(){
        // 获取星期一课程数排名
        $sql = "SELECT `classCode`,COUNT(`one`) as total FROM `gxust_timetable` WHERE `semester` = \"17-18-2\" AND (`one` <> 'none\n') GROUP BY `classCode` ORDER BY total DESC";

    }


}