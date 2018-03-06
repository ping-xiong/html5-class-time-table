<?php
/**
 * Created by PhpStorm.
 * User: https://pingxonline.com/
 * Date: 2018/3/6 0006
 * Time: 8:30
 */

class get
{
    private $link;

    public function __construct($db){
        $this->link = $db->link;
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


}