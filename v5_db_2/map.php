<?php
/**
 * Created by PhpStorm.
 * User: riitei
 * Date: 2018/6/11
 * Time: 15:02
 */


include "php/DBConnection.php";

// 取得 vertical 最大值
class map
{

    public function mapInfo()
    {
        // 使用SQL函式取得vertical資料欄位最大值
        $vertical_sql = 'SELECT max(map_vertical) as vertical FROM game.map_coordinate;';
        $vertical_sql_search = DBConnection::PDO()->query($vertical_sql)->fetch();
        // 從DB的 vertical 資料欄位取得最大值
        $max_vertical_value = $vertical_sql_search['vertical'];
        // 使用SQL函式取得horizontal資料欄位最大值
        $horizontal_sql = 'SELECT max(map_horizontal) as horizontal FROM game.map_coordinate;';
        $horizontal_sql_search = DBConnection::PDO()->query($horizontal_sql)->fetch();
        $max_horizontal_value = $horizontal_sql_search['horizontal'];// 從DB的 horizontal 資料欄位取得最大值
//
        $map_value = array();// 存放DB讀取座標值
        $photo_path = array();// 存放圖片路徑
//
        for ($vertical = 0; $vertical <= $max_vertical_value; $vertical++) { //  DB 中 map_vertical值 從 0 到 map_vertical 最大值
            for ($horizontal = 0; $horizontal <= $max_horizontal_value; $horizontal++) {//  DB 中 map_vertical值 從 0 到 map_horizontal 最大值
                // 得知 map_vertical 和 map_horizontal 參數，產生 sql 語句
                $sql = "SELECT map_coordinate.map_value,map_photo_path.map_photo_path FROM map_photo_path inner join map_coordinate on  map_photo_path.map_value = map_coordinate.map_value where map_vertical = '" . $i . "' and map_horizontal='" . $j . "'; ;";;
                $map = DBConnection::PDO()->query($sql)->fetch();
                //
                $map_value[$vertical][$horizontal] = $map['map_value'];
                // 取得座標值為0通行、1障礙、2角色(大於2都是角色)
                $photo_path[$vertical][$horizontal] = $map['map_photo_path'];
                // 取得座標值為0通行的圖片路徑、1障礙的圖片路徑、2角色的圖片路徑(大於2都是角色圖片路徑)
            }
        }
        return ['map' => json_encode($map_value, true), 'photo' => $photo_path];

    }
}
