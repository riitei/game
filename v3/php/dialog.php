<?php
/**
 * Created by PhpStorm.
 * User: riitei
 * Date: 2018/6/11
 * Time: 09:58
 */
// $dialog 連接資料庫需要改寫，座標＝角色 => 角色＝對話
$dialog = array();
// $dialog[vertical][horizontal][對話內容次數];
$dialog[5][1][0] = "yan";
$dialog[5][1][1] = "chongqing";
$dialog[1][3][0] = "ting";
$dialog[1][3][1] = "taipei";

$vertical = $_POST['vertical'];
$horizontal = $_POST['horizontal'];
//$vertical =5;
//$horizontal=1;

//foreach($dialog[$vertical][$horizontal] as $key => $value){
//    echo $key." ".$value."<br>";
//}
// array or db 轉成 json
$json = json_encode($dialog[$vertical][$horizontal],true);

echo $json;