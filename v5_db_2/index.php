<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>讀取DB座標資訊</title>
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>

    <style type="text/css">
        /*圖片*/
        .photo {
            position: absolute;
            margin-top: 100px;
            margin-left: 100px;
            overflow: hidden;
            width: 100px;
            height: 100px;
        }

        /*地圖範圍*/
        .map {
            position: absolute;
            padding-top: 100px;
            padding-left: 100px;
            overflow: hidden;
            z-index: 0;
        }
    </style>
    <?php
    include "php/map.php";
    $map = new map();
    $my_map = $map->mapInfo();
    $my_map_array_value = $my_map['map'];// 讀取 map array 值
    $my_map_photo_path = array();
    $my_map_photo_path = $my_map['photo'];// 讀取 map array 地圖路徑
    $my_map_vertical_Length = count($my_map_photo_path);// 欄
    $my_map_horizontal_Length = count($my_map_photo_path[count($my_map_photo_path) - 1]);// 列
    ?>

    <script type="text/javascript">
        // var map = [
        //     [0, 0, 0, 0, 0],
        //     [0, 1, 0, 2, 0],
        //     [0, 1, 0, 1, 0],
        //     [0, 1, 0, 1, 0],
        //     [0, 0, 0, 1, 0],
        //     [0, 2, 0, 0, 0]];
        var map = <?=$my_map_array_value?>;
        var verticalLength = <?=$my_map_vertical_Length?>;// 欄
        var horizontalLength = <?=$my_map_horizontal_Length?>;// 列
        var vertical = 5;// 圖片初始位置 陣列 欄
        var horizontal = 0;// 圖片初始位置 陣列 列
        var stop = false;// 控制是否能行走，預設可以行走
        //
        $(function () {
            // 四張圖片重疊，初始座標位置
            $("#start").css("top", vertical * 100);// 圖片初始位置 陣列 欄
            $("#start").css("left", horizontal * 100);// 圖片初始位置 陣列 列
            $("#top").css("top", vertical * 100);// 圖片初始位置 陣列 欄
            $("#top").css("left", horizontal * 100);// 圖片初始位置 陣列 列
            $("#down").css("top", vertical * 100);// 圖片初始位置 陣列 欄
            $("#down").css("left", horizontal * 100);// 圖片初始位置 陣列 列
            $("#left").css("top", vertical * 100);// 圖片初始位置 陣列 欄
            $("#left").css("left", horizontal * 100);// 圖片初始位置 陣列 列
            $("#right").css("top", vertical * 100);// 圖片初始位置 陣列 欄
            $("#right").css("left", horizontal * 100);// 圖片初始位置 陣列 列
            $("#map").css("height", verticalLength * 100);// 透過陣列 橫 得知地圖最大高度範圍
            $("#map").css("width", horizontalLength * 100);//透過陣列 列 得知地圖最大長度範圍
        });
        $(document).keydown(function (event) {
            $("#start").css("display", "none");
            //
            var move_place;
            switch (event.which) {
                case 37:// 鍵盤 左按鍵
                    // 顯上左邊圖片
                    photo_show("左", stop);
                    // 移動
                    move_place = move("左", vertical, horizontal);

                    break;
                case 38:// 鍵盤 上按鍵
                    // 顯上上面圖片
                    photo_show("上", stop);
                    // 移動
                    move_place = move("上", vertical, horizontal);
                    break;
                case 39:// 鍵盤 右按鍵
                    // 顯上右邊圖片
                    photo_show("右", stop);
                    // 移動
                    move_place = move("右", vertical, horizontal);
                    break;
                case 40:// 鍵盤 下按鍵
                    // 顯上下面圖片
                    photo_show("下", stop);
                    // 移動
                    move_place = move("下", vertical, horizontal);
                    break;
                default:
                    break;
            }// switch

            if (move_place) {
                var direction = pass(
                    map[move_place["new_vertical"]][move_place["new_horizontal"]],
                    move_place["new_vertical"],
                    move_place["new_horizontal"],
                    move_place["place_direction"],
                    move_place["old_vertical"],
                    move_place["old_horizontal"]);
                vertical = direction.now_vertical;
                horizontal = direction.now_horizonta;
            }

        });// keydown

        // 圖片移動是否超出界線
        function move(direction, vertical, horizontal) {
            var coordinate = new Array();
            // 紀錄原座標
            coordinate["old_vertical"] = vertical;
            coordinate["old_horizontal"] = horizontal;
            // 初始新座標
            coordinate["new_vertical"] = vertical;
            coordinate["new_horizontal"] = horizontal;

            switch (direction) {
                case "左":
                    if (horizontal > 0) { // 防止超過界線
                        coordinate["new_horizontal"] = horizontal - 1; // 陣列向左移動
                        coordinate["place_direction"] = "left"
                    } else {
                        coordinate = null;
                    }
                    break;
                case "上":
                    if (vertical > 0) { // 防止超過界線
                        coordinate["new_vertical"] = vertical - 1;// 陣列向上移動
                        coordinate["place_direction"] = "top";
                    } else {
                        coordinate = null;
                    }
                    break;
                case"右":

                    if (horizontal < horizontalLength - 1) { // 防止超過界線
                        coordinate["new_horizontal"] = horizontal + 1;// 陣列向右移動
                        coordinate["place_direction"] = "left";
                    } else {
                        coordinate = null;
                    }
                    break;
                case"下":
                    if (vertical < verticalLength - 1) { // 防止超過界線
                        coordinate ["new_vertical"] = vertical + 1;// 陣列向下移動
                        coordinate ["place_direction"] = "top";
                    } else {
                        coordinate = null;
                    }
                    break;
            }//switch
            return coordinate;

        } // move

        // 圖片顯示
        function photo_show(direction, stop) {
            if (stop == false) {
                switch (direction) {
                    case"左":
                        $("#left").css("display", "inline");
                        $("#top,#down,#right").css("display", "none");
                        break;
                    case "上":
                        $("#top").css("display", "inline");
                        $("#down,#left,#right").css("display", "none");
                        break;
                    case "右":
                        $("#right").css("display", "inline");
                        $("#top,#down,#left").css("display", "none");
                        break;
                    case "下":
                        $("#down").css("display", "inline");
                        $("#top,#left,#right").css("display", "none");
                        break;
                }
            }

        }

        // 判斷是否通行
        function pass(map, new_vertical, new_horizontal, place_direction, old_vertical, old_horizontal) {
            var now_vertical;
            var now_horizonta;
            if (map == 0 && stop == false) {// 可以通行
                switch (place_direction) {
                    case "top":
                        // 四個圖片同時移動
                        $("#top").css("top", new_vertical * 100 + "px");
                        $("#down").css("top", new_vertical * 100 + "px");
                        $("#left").css("top", new_vertical * 100 + "px");
                        $("#right").css("top", new_vertical * 100 + "px");
                        break;
                    case "left":
                        $("#top").css("left", new_horizontal * 100 + "px");
                        $("#down").css("left", new_horizontal * 100 + "px");
                        $("#left").css("left", new_horizontal * 100 + "px");
                        $("#right").css("left", new_horizontal * 100 + "px");
                        break;
                }
                // 更新目前座標
                now_vertical = new_vertical;
                now_horizonta = new_horizontal;

            } else if (map == 2) { // 角色
                stop = true;// 鎖住鍵盤移動
                photo_show("", stop);// 鎖定圖片顯示
                $("#dialog").empty();
                dialog(new_vertical, new_horizontal);
                $("#dialog").css("display", "inline");
                // 存放未移動座標位置
                now_vertical = old_vertical;
                now_horizonta = old_horizontal;
            }
            else { // 不可通行
                // 存放未移動座標位置
                now_vertical = old_vertical;
                now_horizonta = old_horizontal;
            }

            return {"now_vertical": now_vertical, "now_horizonta": now_horizonta};

        }

        // 對話框
        function dialog(vertical, horizontal) {
            if (vertical == 5 && horizontal == 1) {// 對話框座標
                // 添加對話框內容
                $("#dialog").append(
                    "yan" +
                    "    <img src='photo/obstacle.jpg' class='dialog_photo'>" +
                    "<br><br>" +
                    "    <button id='t_close_01' type='button'>關閉</button>");
            }
            if (vertical == 1 && horizontal == 3) {// 對話框座標
                // 添加對話框內容
                $("#dialog").append(
                    "ting" +
                    "    <img src='photo/obstacle.jpg' class='dialog_photo'>" +
                    "<br><br>" +
                    "    <button id='t_close_01' type='button'>關閉</button>");
            }
        }

    </script>

</head>
<body>
<!--地圖-->
<div id="map" class="map">
    <!--繪製地圖的圖片-->
    <?php
    for ($vertical = 0; $vertical < $my_map_vertical_Length; $vertical++) {
        for ($horizontal = 0; $horizontal < $my_map_horizontal_Length; $horizontal++) {
            echo "<img src='" . $my_map_photo_path[$vertical][$horizontal] . "'class = 'map_photo'>";
        }
    }
    ?>
    <img id="start" class="photo" src="photo/start.jpg">
    <img id="top" class="photo" src="photo/top.png" style="display: none">
    <img id="down" class="photo" src="photo/down.png" style="display: none">
    <img id="left" class="photo" src="photo/left.png" style="display: none">
    <img id="right" class="photo" src="photo/right.png" style="display: none">
    <!--區塊-->
    <div id="block"></div>
</div>

<style type="text/css">
    /*提示框*/
    .dialog {
        margin-left: 100px;
        margin-top: 720px;
        position: absolute;
        width: 250px;
        height: 100px;
        background-color: #7b76a8;
        display: none;
        z-index: 1;
    }

    .dialog_photo {
        position: absolute;
        float: left;
        width: 50px;
        height: 50px;
    }

</style>

<script>
    $(function () {
        $(document).on('click', '#t_close_01', function () {
            stop = false;
            $("#dialog").css("display", "none");
        });
    });
</script>

<div id="dialog" class="dialog"></div>
</body>
</html>