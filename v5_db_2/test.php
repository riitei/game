<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<style type="text/css">
    .map {
        /*position: absolute;*/
        /*width: auto;*/
        /*display: table;*/
        /*margin-left: auto;*/
        /*margin-right: auto;*/
        margin-top: 100px;
        margin-left: 100px;
    }

    .photo {
        width: 100px;
        height: 100px;
        float: left;
    }
</style>
<body>
<?php
//
include "php/map.php";
$map = new map();
$my_map = $map->mapInfo();
//echo count($my_map['photo']).'<br>';
//echo count($my_map['photo'][count($my_map['photo'])-1]);
//
$ii = 500;
$iii = (string)$ii."px";
?>

<div class="map" style="width: <?=$iii?>">
<!--    <div class="map">-->


    <?php
    for ($i = 0; $i < count($my_map['photo']); $i++) {
        for ($j = 0; $j < count($my_map['photo'][$i]); $j++) {
            echo "<img src='" . $my_map['photo'][$i][$j] . "'class = 'photo'>";
        }
    }
    ?>
//axq9750

</div>

</body>
</html>