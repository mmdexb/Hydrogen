<?php
header("Content-type: application/json;");
header('Access-Control-Allow-Origin:*');
require "function.php";
$db = db_connect_flight_track();
echo '[';
$id = $_GET['id'];

$sql = "SELECT * FROM flight_route where flight='" . $id . "' order by id";
mysqli_select_db($db, 'flight_route');
$retval = mysqli_query($db, $sql);

if (!$retval) {
    die('无法读取数据: ' . mysqli_error($conn));
}
//{"lat":22.6383,"lng":113.8117,"name":"SHENZHEN/BAOAN","type":"Airport","icon_url":"/assets/airport-e91142e842d5da7b82cfca5c7c9ef6ad.png","icon_center_x":13,"icon_center_y":13}
$n = 0;
while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
    $n += 1;
    if ($n % 3 == 0) {

        $lat = $row["lat"];
        $lon = $row["lng"];
        if ($lat != 0 and $lon != 0) {
            if (!isset($lat)) {
            } else {
                if (!isset($lon)) {
                } else {
                    echo "{";
                    echo '"lat":' . $lat . ',"lng":' . $lon . '},';
                }
            }
        }
    }
}
if ($lat != 0 and $lon != 0) {
    if (!isset($lat)) {
    } else {
        if (!isset($lon)) {
        } else {
            echo '{"lat":' . $lat . ',"lng":' . $lon . '}]';
        }
    }
}

//echo "]";