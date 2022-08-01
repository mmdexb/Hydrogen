<?php
require "function.php";
session_start();
require "header.php";

?>

<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">航行记录</h3>
    </div>
    <div id="main-wrapper">
        <?php
if (isset($_SESSION["user_website"])) {?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">航行记录</h4>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive invoice-table">


                            <h2>

                                # 地图</h2>

                            <?php
$fid = $_GET["fid"];
    if ($_SESSION['user_website']) {

        $handle = fopen("http://fly.chbsim.cn/fdata.php?id=" . $fid, "rb");

        $contents = stream_get_contents($handle);

        fclose($handle);

        //echo $contents;

        ?>



                            <style type="text/css">
                            #allmap {

                                width: 100%;

                                height: 300px;

                                overflow: hidden;

                                margin: 0;

                                font-family: "微软雅黑";

                            }
                            </style>

                            <script type="text/javascript"
                                src="//api.map.baidu.com/api?type=webgl&v=1.0&ak=hKK5SGCS2tDMTGkw6Kmp8Q61cagHhkT2">
                            </script>

                            <script type="text/javascript" src="//api.map.baidu.com/library/LuShu/gl/src/LuShu_min.js">
                            </script>

                            <div id="allmap"></div>



                            <script type="text/javascript">
                            var data = <?php echo $contents; ?>;

                            var arr = new Array()





                            var path = arr;



                            console.log(path)

                            // 百度地图API功能

                            var map = new BMapGL.Map("allmap");



                            var point = new BMapGL.Point(116.404, 39.925);

                            map.centerAndZoom(point, 4);

                            map.enableScrollWheelZoom();



                            for (let i = 0; i < data.length; i++) {



                                delete data[i]["type"];

                                delete data[i]["icon_url"];

                                delete data[i]["icon_url"];

                                delete data[i]["icon_center_x"];

                                delete data[i]["icon_center_y"];



                                arr.push(new BMapGL.Point(data[i]["lng"], data[i]["lat"]));

                                //console.log(data[i])

                            }



                            function startLushu() {



                            }

                            var path1 = [];



                            var polyline = new BMapGL.Polyline(path, {

                                clip: false,

                                geodesic: true,

                                strokeWeight: 3

                            });

                            map.addOverlay(polyline);

                            startLushu();
                            </script>







                            <br />

                            <hr><br />

                            <h2>

                                # 记录</h2>

                            <?php

        get_f_track_d($fid);

    } else {

        echo "未登陆，无法查看！";

    }?>

                        </div>

                    </div>
                </div>
            </div>


        </div><!-- Row -->

        <?php }?>
    </div><!-- Main Wrapper -->
    <div class="page-footer">
        <p><?php echo $GLOBALS['websitename_copy']; ?></p>
    </div>
</div><!-- /Page Inner -->
<?php
require "footer.php";
?>
<script>
profile.classList.add("active-page");
</script>