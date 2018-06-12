<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>demo</title>
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

        /*通行*/
        .pass {
            height: 100px;
            width: 100px;
            float: left;
            background-image: url("photo/pass.jpg"); /*抓取圖片url*/
            background-size: 100px 100px; /*定義圖片長寬*/
        }

        /*障礙*/
        .obstacle {
            height: 100px;
            width: 100px;
            float: left;
            background-image: url("photo/obstacle.jpg"); /*抓取圖片url*/
            background-size: 100px 100px; /*定義圖片長寬*/
        }

        /*角色*/
        .character {
            height: 100px;
            width: 100px;
            float: left;

            background-image: url("photo/character.jpg"); /*抓取圖片url*/
            background-size: 100px 100px; /*定義圖片長寬*/
        }
    </style>
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <?php
    include "php/DBConnection.php";
    $my_map_sql = "SELECT map_array FROM game.map where checkpoint ='test';";
    $my_map_search = DBConnection::PDO()->query($my_map_sql)->fetch();
    $my_map_array_value = $my_map_search['map_array'];// 抓 DB 地圖資料
    $my_mapy_json = json_encode($my_map_array_value);
    ?>
    <script type="text/javascript">
        // var map = [
        //     [0, 0, 0, 0, 0],
        //     [0, 1, 0, 2, 0],
        //     [0, 1, 0, 1, 0],
        //     [0, 1, 0, 1, 0],
        //     [0, 0, 0, 1, 0],
        //     [0, 2, 0, 0, 0]];
        var map = <?=$my_map_array_value?>
        //var map = JSON.parse(<?//=$my_mapy_json?>//);
        // map陣列值為 0 圖片通行
        // map陣列值為 1 障礙物
        // map陣列值為 2 角色
        var verticalLength = map.length;// 欄
        var horizontalLength = map[map.length - 1].length;// 列
        var vertical = 5;// 圖片初始位置 陣列 欄
        var horizontal = 0;// 圖片初始位置 陣列 列
        var stop = false;// 控制是否能行走，預設可以行走

        $(function () {
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
            //
            for (var i = 0; i < verticalLength; i++) {
                for (var j = 0; j < horizontalLength; j++) {
                    if (map[i][j] == 1) {
                        $("#map").append("<div class='obstacle'></div>");
                        // 障礙物
                    } else if (map[i][j] == 2) {
                        $("#map").append("<div class='character'></div>");
                        // 角色
                    } else {
                        $("#map").append("<div class='pass'></div>");
                        // 可通行
                    }
                }
            }
        });
        $(document).keydown(function (event) {
            switch (event.which) {
                case 37:// 鍵盤 左按鍵
                    move("左", horizontal, vertical);
                    break;
                case 38:// 鍵盤 上按鍵
                    move("上", horizontal, vertical);
                    break;
                case 39:// 鍵盤 右按鍵
                    move("右", horizontal, vertical);
                    break;
                case 40:// 鍵盤 下按鍵
                    move("下", horizontal, vertical);
                    break;
                default:
                    break;
            }
            // }
        });

        // 圖片移動
        function move(direction, horizontal, vertical) {
            $("#start").css("display", "none");
            switch (direction) {
                case "左":
                    // 顯上左邊圖片

                    photo_show("左", stop);
                    if (horizontal > 0) {
                        this.horizontal = horizontal - 1; // 陣列向左移動
                        var obstacle = pass(map[this.vertical][this.horizontal], "left", this.horizontal, this.vertical);

                        // 無法通行
                        if (obstacle) {
                            this.horizontal += 1;// 不能通行，將陣列向右移動。設為原來位置
                        }

                    }


                    break;
                case "上":
                    // 顯上上面圖片
                    photo_show("上", stop);

                    if (vertical > 0) {
                        this.vertical = vertical - 1;// 陣列向上移動
                        var obstacle = pass(map[this.vertical][this.horizontal], "top", this.horizontal, this.vertical);

                        // 無法通行
                        if (obstacle) {

                            this.vertical += 1;// 不能通行，將陣列向上移動。設為原來位置
                        }

                    }
                    //

                    break;
                case"右":
                    // 顯上右邊圖片
                    photo_show("右", stop);
                    if (horizontal < horizontalLength - 1) {
                        this.horizontal = horizontal + 1;// 陣列向右移動
                        var obstacle = pass(map[this.vertical][this.horizontal], "left", this.horizontal, this.vertical);
                        // 無法通行
                        if (obstacle) {
                            this.horizontal -= 1;// 不能通行，將陣列向右移動。設為原來位置
                        }
                        //
                    }


                    break;
                case"下":
                    // 顯上下面圖片
                    photo_show("下", stop);
                    if (vertical < verticalLength - 1) {
                        this.vertical = vertical + 1;// 陣列向下移動
                        var obstacle = pass(map[this.vertical][this.horizontal], "top", this.horizontal, this.vertical);

                        // 無法通行
                        if (obstacle) {
                            this.vertical -= 1;// 不能通行，將陣列向下移動。設為原來位置
                        }

                    }

                    break;
            }//switch

        } // move
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
        function pass(map, direction, horizontal, vertical) {
            if (map == 0 && stop == false) {// 可以通行
                switch (direction) {
                    case "top":
                        // 四個圖片同時移動
                        $("#top").css("top", vertical * 100 + "px");
                        $("#down").css("top", vertical * 100 + "px");
                        $("#left").css("top", vertical * 100 + "px");
                        $("#right").css("top", vertical * 100 + "px");
                        break;
                    case "left":
                        $("#top").css("left", horizontal * 100 + "px");
                        $("#down").css("left", horizontal * 100 + "px");
                        $("#left").css("left", horizontal * 100 + "px");
                        $("#right").css("left", horizontal * 100 + "px");
                        break;
                }
                console.log("可通行 " + vertical + "," + horizontal);
            } else if (map == 2) {
                stop = true;// 鎖住鍵盤移動
                photo_show("", stop);// 鎖定圖片顯示
                $("#dialog").empty();
                dialog(vertical, horizontal);
                $("#dialog").css("display", "inline");
                console.log("角色 " + vertical + "," + horizontal);
                return true;// 不可通行
            } else {// 不可通行
                console.log("不可通行 " + vertical + "," + horizontal);
                return true;// 不可通行
            }
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

yan
<!--地圖-->
<div id="map" class="map">
    <!--圖片-->

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
            console.log("close");
        });
    });
</script>

<div id="dialog" class="dialog"></div>
</body>
</html>