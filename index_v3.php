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

    </style>
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>

</head>
<body>
<?php

$myfile = fopen("json2.json", "r") or die("Unable to open file!");
$json = fread($myfile, filesize("json2.json"));
fclose($myfile);
$json = json_decode($json, true);

?>
<!--地圖-->
<div id="map" class="map">
    <img id="start" class="photo" src="photo/start.jpg">
    <img id="top" class="photo" src="photo/top.png" style="display: none">
</div>
<script type="text/javascript">

    var map = <?=$json["map"]?>;

    var verticalLength = <?=$json["vertical"]?>;// 欄
    var horizontalLength = <?=$json["horizontal"]?>;// 列

    $("#map").css("height", verticalLength * 100);// 透過陣列 橫 得知地圖最大高度範圍
    $("#map").css("width", horizontalLength * 100);//透過陣列 列 得知地圖最大長度範圍

    for (var i = 0; i < map.length; i++) {
        if (map[i] == 1) {
            $("#map").append("<div class='obstacle'>" + i + "</div>");
            // 障礙物
        } else {
            $("#map").append("<div class='pass'>" + i + "</div>");
            // 可通行
        }
    }


    var vertical = 0;// 圖片初始位置 陣列 欄
    var horizontal = 0;// 圖片初始位置 陣列 列
    $(function () {
       $("#start").css("top", vertical * 100);// 圖片初始位置 陣列 欄
       $("#start").css("left", horizontal * 100);// 圖片初始位置 陣列 列
       $("#top").css("top", vertical * 100);// 圖片初始位置 陣列 欄
       $("#top").css("left", horizontal * 100);// 圖片初始位置 陣列 列
       //
       // $("#map").css("height", verticalLength * 100);// 透過陣列 橫 得知地圖最大高度範圍
       // $("#map").css("width", horizontalLength * 100);//透過陣列 列 得知地圖最大長度範圍
       //
       // for (var i = 0; i < verticalLength; i++) {
       //     for (var j = 0; j < horizontalLength; j++) {
       //         if (map[i][j] == 1) {
       //             $("#block").append("<div class='obstacle'>" + i + "," + j + "</div>");
       //             // 障礙物
       //         } else {
       //             $("#block").append("<div class='pass'>" + i + "," + j + "</div>");
       //             // 可通行
       //         }
       //     }
       // }


    });

        $(document).keydown(function (event) {
            $("#start").css("display", "none");
            $("#top").css("display", "inline");

            switch (event.which) {
                case 37:// 鍵盤 左按鍵
                    // 圖片選轉 270 度
                    rotate(270);
                    //
                    if (horizontal > 0) {
                        //
                        horizontal -= 1; // 陣列向左移動
                        if (map[vertical][horizontal] == 0) { // 可以通行
    //
                            $("#top").css("left", horizontal * 100 + "px");

                        } else {
                            horizontal += 1;// 不能通行，將陣列向右移動。設為原來位置
                        }
                        //
                        console.log(vertical + "," + horizontal);
                    }


                    break;
                case 38:// 鍵盤 上按鍵
                    //  圖片選轉 0 度
                    rotate(0);
                    if (vertical > 0) {
                        //
                        vertical -= 1;// 陣列向上移動
                        if (map[vertical][horizontal] == 0) {// 可以通行
                            //
                            $("#top").css("top", vertical * 100 + "px");

                        } else {
                            vertical += 1;// 不能通行，將陣列向上移動。設為原來位置
                        }
                        //
                        console.log(vertical + "," + horizontal);
                    }

                    break;
                case 39:// 鍵盤 右按鍵
                    // 圖片選轉 90 度
                    rotate(90);
                    //
                    if (horizontal < horizontalLength - 1) {
                        //
                        horizontal += 1;// 陣列向右移動
                        if (map[vertical][horizontal] == 0) {// 可以通行
                            //
                            $("#top").css("left", horizontal * 100 + "px");
                        } else {
                            horizontal -= 1;// 不能通行，將陣列向右移動。設為原來位置
                        }
                        //
                        console.log(vertical + "," + horizontal);

                    }
                    break;
                case 40:// 鍵盤 下按鍵
                    // 圖片選轉 180 度
                    rotate(180);
                    //
                    if (vertical < verticalLength - 1) {
                        //
                        vertical += 1;// 陣列向下移動
                        if (map[vertical][horizontal] == 0) {// 可以通行
                            //
                            $("#top").css("top", vertical * 100 + "px");

                        } else {
                            vertical -= 1;// 不能通行，將陣列向下移動。設為原來位置
                        }
                        //
                        console.log(vertical + "," + horizontal);
                    }
                    break;
                default:
                    break;
            }

        });

    // 選轉圖片
    function rotate(rotate) {
        $("#top").css("transform", "rotate(" + rotate + "deg)");
        $("#top").css("-ms-transform", "rotate(" + rotate + "deg)");
        $("#top").css("-moz-transform", "rotate(" + rotate + "deg)");
        $("#top").css("-webkit-transform", "rotate(" + rotate + "deg)");
        $("#top").css("-o-transform", "rotate(" + rotate + "deg)");
    }
</script>

</body>
</html>
