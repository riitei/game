<?php
/**
 * Created by PhpStorm.
 * User: riitei
 * Date: 2018/3/12
 * Time: 16:56
 */


$myfile = fopen("json2.json", "w") or die("Unable to open file!");

$map = $_POST["map"];
//$txt = json_encode($map);

$save = array();
$save["vertical"] = 2;
$save["horizontal"] = 3;
$save["map"] = $map;

fwrite($myfile, json_encode($save,true));
fclose($myfile);

echo json_encode($save,true);