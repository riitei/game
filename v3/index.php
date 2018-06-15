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
            /*width: 100px;*/
            /*height: 100px;*/
        }

        /*通行*/
        .pass {
            height: 100px;
            width: 100px;
            /*background: yellow;*/
            float: left;
            background-image: url("photo/pass.jpg"); /*抓取圖片url*/
            background-size: 100px 100px; /*定義圖片長寬*/
        }

        /*障礙*/
        .obstacle {
            height: 100px;
            width: 100px;
            /*background: blueviolet;*/
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
    include "php/DBConnection.php"; // 載入DB連線設定


    $map_sql = "SELECT map_array FROM map_v0 where Checkpoint = 'test';";// sql 查詢語句

    $result = mysqli_query($conn, $map_sql);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result)) {
            $map_array = $row['map_array'];
        }
    }
    ?>

    <script type="text/javascript">

        // var map = [
        //     [0, 0, 0, 0, 0],
        //     [0, 1, 0, 1, 0],
        //     [0, 1, 0, 1, 0],
        //     [0, 1, 0, 1, 0],
        //     [1, 1, 0, 1, 0],
        //     [0, 0, 0, 0, 0]];
        var map = <?=$map_array?> // php array
        // map陣列值為 0 可以圖片通行
        // map陣列值為 1 可以圖片通行
        var verticalLength = map.length;// 欄
        var horizontalLength = map[map.length - 1].length;// 列
        var vertical = 5;// 圖片初始位置 陣列 欄
        var horizontal = 0;// 圖片初始位置 陣列 列
        $(function () {
            $("#start").css("top", vertical * 100 + "px");// 圖片初始位置 陣列 欄
            $("#start").css("left", horizontal * 100 + "px");// 圖片初始位置 陣列 列
            $("#top").css("top", vertical * 100 + "px");// 圖片初始位置 陣列 欄
            $("#top").css("left", horizontal * 100 + "px");// 圖片初始位置 陣列 列
            $("#down").css("top", vertical * 100 + "px");// 圖片初始位置 陣列 欄
            $("#down").css("left", horizontal * 100 + "px");// 圖片初始位置 陣列 列
            $("#left").css("top", vertical * 100 + "px");// 圖片初始位置 陣列 欄
            $("#left").css("left", horizontal * 100 + "px");// 圖片初始位置 陣列 列
            $("#right").css("top", vertical * 100 + "px");// 圖片初始位置 陣列 欄
            $("#right").css("left", horizontal * 100 + "px");// 圖片初始位置 陣列 列
            $("#map").css("height", verticalLength * 100 + "px");// 透過陣列 橫 得知地圖最大高度範圍
            $("#map").css("width", horizontalLength * 100 + "px");//透過陣列 列 得知地圖最大長度範圍
            //
            for (var i = 0; i < verticalLength; i++) {
                for (var j = 0; j < horizontalLength; j++) {
                    if (map[i][j] == 1) {
                        $("#map").append("<div class='obstacle'></div>");
                        // 障礙物
                    } else {
                        $("#map").append("<div class='pass'></div>");
                        // 可通行
                    }
                }
            }
        });
        $(document).keydown(function (event) {
            $("#start").css("display", "none");
            $("#top").css("display", "none");
            $("#down").css("display", "none");
            $("#left").css("display", "none");
            $("#right").css("display", "none");
            switch (event.which) {
                case 37:// 鍵盤 左按鍵
                    if (horizontal > 0) {
                        //
                        horizontal -= 1; // 陣列向左移動
                        if (map[vertical][horizontal] == 0) { // 可以通行
                            // 四個圖片同時移動
                            $("#top").css("left", horizontal * 100 + "px");
                            $("#down").css("left", horizontal * 100 + "px");
                            $("#left").css("left", horizontal * 100 + "px");
                            $("#right").css("left", horizontal * 100 + "px");
                            //
                        } else {
                            horizontal += 1;// 不能通行，將陣列向右移動。設為原來位置
                        }
                        //
                        console.log(vertical + "," + horizontal);
                    }
                    // 顯上左邊圖片
                    $("#left").css("display", "inline");
                    break;
                case 38:// 鍵盤 上按鍵
                    if (vertical > 0) {
                        //
                        vertical -= 1;// 陣列向上移動
                        if (map[vertical][horizontal] == 0) {// 可以通行
                            // 四個圖片同時移動
                            $("#top").css("top", vertical * 100 + "px");
                            $("#down").css("top", vertical * 100 + "px");
                            $("#left").css("top", vertical * 100 + "px");
                            $("#right").css("top", vertical * 100 + "px");
                            //
                        } else {
                            vertical += 1;// 不能通行，將陣列向上移動。設為原來位置
                        }
                        //
                        console.log(vertical + "," + horizontal);
                    }
                    // 顯上上面圖片
                    $("#top").css("display", "inline");
                    break;
                case 39:// 鍵盤 右按鍵
                    if (horizontal < horizontalLength - 1) {
                        //
                        horizontal += 1;// 陣列向右移動
                        if (map[vertical][horizontal] == 0) {// 可以通行
                            // 四個圖片同時移動
                            $("#top").css("left", horizontal * 100 + "px");
                            $("#down").css("left", horizontal * 100 + "px");
                            $("#left").css("left", horizontal * 100 + "px");
                            $("#right").css("left", horizontal * 100 + "px");
                            //
                        } else {
                            horizontal -= 1;// 不能通行，將陣列向右移動。設為原來位置
                        }
                        //
                        console.log(vertical + "," + horizontal);
                    }
                    // 顯上右邊圖片
                    $("#right").css("display", "inline");
                    break;
                case 40:// 鍵盤 下按鍵
                    if (vertical < verticalLength - 1) {
                        // tempVertical = vertical;
                        // tempHorizontal = horizontal;
                        //
                        vertical += 1;// 陣列向下移動
                        if (map[vertical][horizontal] == 0) {// 可以通行
                            // 四個圖片同時移動
                            $("#top").css("top", vertical * 100 + "px");
                            $("#down").css("top", vertical * 100 + "px");
                            $("#left").css("top", vertical * 100 + "px");
                            $("#right").css("top", vertical * 100 + "px");
                            //
                        } else {
                            vertical -= 1;// 不能通行，將陣列向下移動。設為原來位置
                        }
                        //
                        console.log(vertical + "," + horizontal);
                    }
                    // 顯上下面圖片
                    $("#down").css("display", "inline");
                    break;
                default:
                    break;
            }
        });
    </script>

</head>
<body>


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
</body>
</html>