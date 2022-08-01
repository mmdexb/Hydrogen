<?php
require "function.php";
session_start();
require "header.php";

?>

<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">手游综合系统-管制</h3>
    </div>
    <div id="main-wrapper">
        <?php
if (isset($_SESSION["user_website"])) {?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">手游综合系统-管制</h4>
                    </div>
                    <div class="panel-body">
                        <a href="mob_plan.php" class="btn btn-primary">返回系统</a>
                        <?php
//判断有无GET type=take
    if (isset($_GET["type"])) {
        $id = $_GET["id"];
        if ($_GET["type"] == "take") {
            $array_up = array(
                "status" => "已接管",
            );
            $array_where = array(
                "id" => $id,
            );
            pdo_updata("mob", $array_up, $array_where);
            //输出接管成功提示div
            echo "<div class='alert alert-success'>";
            echo "<strong>提示!</strong> 接管成功.";
            echo "</div>";
        }
        if ($_GET["type"] == "del") {
            $array_up = array(
                "status" => "删除",
            );
            $array_where = array(
                "id" => $id,
            );
            pdo_updata("mob", $array_up, $array_where);
            //输出接管成功提示div
            echo "<div class='alert alert-success'>";
            echo "<strong>提示!</strong> 删除成功.";
            echo "</div>";

        }
        if ($_GET["type"] == "or") {
            $array_up = array(
                "status" => "待接管",
            );
            $array_where = array(
                "id" => $id,
            );
            pdo_updata("mob", $array_up, $array_where);
            //输出接管成功提示div
            echo "<div class='alert alert-success'>";
            echo "<strong>提示!</strong> 移交成功.";
            echo "</div>";

        }

    }?>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">我的报名</h4>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <?php

    ?>
                            <div class="table-responsive invoice-table">
                                <?php
if ((int) (get_level()) >= 2) {
        //取当天时间
        $date = date("Y-m-d");
        echo pdo_search_table_mod_atc("mob", ["ID" => "id", "飞行呼号" => "flight_callsign", "起飞机场ICAO" => 'dep', "到达机场ICAO" => "arr", "航路" => "route", "航高" => "fl", "预计起飞时间" => "totime", "日期" => "datef", "状态" => 'status'], ["datef" => $date])
        ?>



                                <?php

    }

    ?>
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
        mob.classList.add("active-page");
        </script>