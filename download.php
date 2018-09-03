<?php
/**
 * Created by PhpStorm.
 * User: https://pingxonline.com/
 * Date: 2018-08-15
 * Time: 11:52
 *
 * 下载excel版本的课表
 *
 */

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include_once "common/connect.php";
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

// 初始化
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$week = ['','星期一','星期二','星期三','星期四','星期五','星期六','星期天'];
$sheet->fromArray(
        $week,   // The data to set
        'NULL',
        'A1'         // Top left coordinate of the worksheet range where
    //    we want to set these values (default is A1)
    );
$count = 2;
$col = 2;
while ($row = mysqli_fetch_assoc($arr_address)) {
    if ($count == 7 || $count == 13){
        $count+=1;
    }
    $time_table_sub_arr = array();
    $time_table_sub_arr[] = $col-1;
    $time_table_sub_arr[] = ($row["one"] == "none\n"?'':$row["one"]);
    $time_table_sub_arr[] = ($row["two"] == "none\n"?'':$row["two"]);
    $time_table_sub_arr[] = ($row["three"] == "none\n"?'':$row["three"]);
    $time_table_sub_arr[] = ($row["four"] == "none\n"?'':$row["four"]);
    $time_table_sub_arr[] = ($row["five"] == "none\n"?'':$row["five"]);
    $time_table_sub_arr[] = ($row["six"] == "none\n"?'':$row["six"]);
    $time_table_sub_arr[] = ($row["seven"] == "none\n"?'':$row["seven"]);
    $sheet->fromArray(
            $time_table_sub_arr,   // The data to set
            'none',
            'A'.$count         // Top left coordinate of the worksheet range where
        //    we want to set these values (default is A1)
        );
    $col++;
    $count++;
}

for ($i = 0; $i < count($note_address_arr); $i++){
    $sheet->setCellValue('B'.(17+$i), $note_address_arr[$i]);
}

$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);
$sheet->getColumnDimension('G')->setAutoSize(true);
$sheet->getColumnDimension('H')->setAutoSize(true);

$styleArray = [
    'borders' => [
        'outline' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '00000000'],
        ],
        'inside'=> [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '00000000'],
        ]
    ],
];

$sheet->getStyle('A1:H16')->applyFromArray($styleArray);

$writer = new Xlsx($spreadsheet);
$writer->save("excel/{$classcode}_{$semester}.xlsx");

$spreadsheet->disconnectWorksheets();
unset($spreadsheet);

header("Location: excel/{$classcode}_{$semester}.xlsx");

