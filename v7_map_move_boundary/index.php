<!DOCTYPE html>
<head>
    <meta charset="UTF-8">

    <title>demo</title>
    <style type="text/css">
        /*圖片*/
        .photo {
            position: absolute;
            padding-top: 100px;
            padding-left: 100px;
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
            left: 0px; /*去除邊框*/
            top: 0px; /*去除邊框*/
        }

        /*通行*/
        .pass {
            height: 100px;
            width: 100px;
            background: yellow;
            float: left;
        }

        /*障礙*/
        .obstacle {
            height: 100px;
            width: 100px;
            background: blueviolet;
            float: left;
        }

        /*頂部圖片*/
        .top {
            position: absolute;
            z-index: 10;
            height: 100px;
            width: 100%;
            background-image: url("/photo/background.jpg");
            top: 0px; /*去除邊框*/
            left: 0px; /*去除邊框*/
        }

        /*左邊圖片*/
        .left {
            position: absolute;
            z-index: 10;
            background-image: url("/photo/background.jpg"); /*抓取圖片url*/
            height: 2000px;
            width: 100px;
            left: 0px; /*去除邊框*/

        }

        /*底圖圖片*/
        .background {
            position: absolute;
            z-index: -1;
            background-image: url("/photo/background.jpg"); /*抓取圖片url*/
            height: 1200px;
            width: 1200px;
        }
    </style>
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        var map = [
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0]];
        // map陣列值為 0 可以圖片通行
        // map陣列值為 1 可以圖片通行
        var verticalLength = map.length;// 欄
        var horizontalLength = map[map.length - 1].length;// 列
        var vertical = 3;// 圖片初始位置 陣列 欄
        var horizontal = 4;// 圖片初始位置 陣列 列
        var map_vertical = 0;
        var map_horizontal = 0;
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
                        $("#map").append("<div class='obstacle'>" + i + "," + j + "</div>");
                        // 障礙物
                    } else {
                        $("#map").append("<div class='pass'>" + i + "," + j + "</div>");
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
                            $("#start").css("left", horizontal * 100 + "px");
                            $("#top").css("left", horizontal * 100 + "px");
                            $("#down").css("left", horizontal * 100 + "px");
                            $("#left").css("left", horizontal * 100 + "px");
                            $("#right").css("left", horizontal * 100 + "px");
                            //
                            map_horizontal += 1;
                            var map_h = map_horizontal * parseInt($("#map").css("padding-left"));
                            $("#map").css("margin-left", map_h);
                            console.log("m_h-> " + map_h);
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
                            $("#start").css("top", vertical * 100 + "px");
                            $("#top").css("top", vertical * 100 + "px");
                            $("#down").css("top", vertical * 100 + "px");
                            $("#left").css("top", vertical * 100 + "px");
                            $("#right").css("top", vertical * 100 + "px");
                            //
                            map_vertical += 1;
                            var map_v = map_vertical * parseInt($("#map").css("padding-top"));
                            $("#map").css("margin-top", map_v);
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
                            $("#start").css("left", horizontal * 100 + "px");
                            $("#top").css("left", horizontal * 100 + "px");
                            $("#down").css("left", horizontal * 100 + "px");
                            $("#left").css("left", horizontal * 100 + "px");
                            $("#right").css("left", horizontal * 100 + "px");
                            //
                            map_horizontal -= 1;
                            var map_h = map_horizontal * parseInt($("#map").css("padding-left"));
                            $("#map").css("margin-left", map_h);
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
                            $("#start").css("top", vertical * 100 + "px");
                            $("#top").css("top", vertical * 100 + "px");
                            $("#down").css("top", vertical * 100 + "px");
                            $("#left").css("top", vertical * 100 + "px");
                            $("#right").css("top", vertical * 100 + "px");
                            //
                            map_vertical -= 1;
                            var map_v = map_vertical * parseInt($("#map").css("padding-top"));
                            $("#map").css("margin-top", map_v);
                            console.log("m_v-> " + map_v);

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
                    $("#start").css("display", "inline");
                    break;
            }
        });
    </script>

</head>

<div class="top"></div>
<div class="left"></div>
<!--地圖-->
<div id="map" class="map">
    <!--圖片-->
    <img id="start" class="photo" src="photo/start.jpg">
    <img id="top" class="photo" src="photo/top.png" style="display: none">
    <img id="down" class="photo" src="photo/down.png" style="display: none">
    <img id="left" class="photo" src="photo/left.png" style="display: none">
    <img id="right" class="photo" src="photo/right.png" style="display: none">
</div>
<div class="background"></div>

</body>
</html>