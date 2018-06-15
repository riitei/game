<?php
/**
 * Created by PhpStorm.
 * User: riitei
 * Date: 2018/6/11
 * Time: 15:02
 */


include "DBConnection.php";

// 取得 vertical 最大值
class map
{

    public function mapInfo()
    {
        // 從DB的 vertical 資料欄位取得最大值
        $vertical_sql = 'SELECT max(map_vertical) as vertical FROM game.map_coordinate;';
        $vertical_sql_search = DBConnection::PDO()->query($vertical_sql)->fetch();
        $max_vertical_value = $vertical_sql_search['vertical'];
        // 從DB的 horizontal 資料欄位取得最大值
        $horizontal_sql = 'SELECT max(map_horizontal) as horizontal FROM game.map_coordinate;';
        $horizontal_sql_search = DBConnection::PDO()->query($horizontal_sql)->fetch();
        $max_horizontal_value = $horizontal_sql_search['horizontal'];
//
        $map_value = array();// 存放DB讀取座標值
        $photo_path = array();
//
        for ($i = 0; $i <= $max_vertical_value; $i++) { //  DB 中 map_vertical值 從 0 到 map_vertical 最大值
            for ($j = 0; $j <= $max_horizontal_value; $j++) {//  DB 中 map_vertical值 從 0 到 map_horizontal 最大值
                // 得知 map_vertical 和 map_horizontal 參數，產生 sql 語句
//                $sql = "SELECT map_value FROM game.map_coordinate where map_vertical = '" . $i . "' and map_horizontal='" . $j . "';";
                $sql2 = "SELECT map_coordinate.map_value,map_photo_path.map_photo_path FROM map_photo_path inner join map_coordinate on  map_photo_path.map_value = map_coordinate.map_value where map_vertical = '" . $i . "' and map_horizontal='" . $j . "'; ;";;
                $map = DBConnection::PDO()->query($sql2)->fetch();
                // 從 sql 語句得到 ﻿map_value 值
                // $map[vertical][horizontal] = $map_value['map_value'];
                $map_value[$i][$j] = $map['map_value'];
                $photo_path[$i][$j] = $map['map_photo_path'];
            }
        }
        return ['map' => json_encode($map_value,true), 'photo' => $photo_path];

    }
}

//
//$map = new map();
//$map = $map->mapInfo();
//
//echo "yan<br>";
//
//for ($i = 0; $i < count($map['photo']); $i++) {
//    for ($j = 0; $j < count($map['photo'][$i]); $j++) {
//        echo "<img src='".$map['photo'][$i][$j]."' width='100px' height='100px'>";
//    }
//    echo '<br>';
//}
//
//echo '<br><br>';
//
//$ii = count($map['map']) . '<br>';
//echo $ii . '<br>';
//(int)$ii = (int)$ii -1;
//echo count($map['map'][$ii]);
//
//
//

