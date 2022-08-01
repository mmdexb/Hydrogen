<?php
require "function.php";
session_start();
require "header.php";

?>

<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">手游综合系统-机组</h3>
    </div>
    <div id="main-wrapper">
        <?php
if (isset($_SESSION["user_website"])) {?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">手游综合系统-机组</h4>
                    </div>
                    <div class="panel-body">
                        <a href="mob_plan.php" class="btn btn-primary">返回系统</a>
                        <?php
//判断是否有GET TYPE=tj
    if (isset($_GET['type']) && $_GET['type'] == "tj") {
        ?>
                        <div class="table-responsive invoice-table">
                            <?php
$flight_callsign = $_POST['flight_callsign'];
        $dep = $_POST['dep'];
        $arr = $_POST['arr'];
        $totime = $_POST['totime'];
        $route = $_POST['route'];
        $datef = $_POST['datef'];
        $fl = $_POST['fl'];
        $array_insert = array(
            'flight_callsign' => $flight_callsign,
            'dep' => $dep,
            'arr' => $arr,
            "route" => $route,
            'totime' => $totime,
            'datef' => $datef,
            "user" => $_SESSION["user_website"],
            "status" => "待接管",
            "fl" => $fl,

        );
        sql_insert_in("mob", $array_insert);
        //输出成功提示div
        echo "<div class='alert alert-success'>";
        echo "<strong>提示!</strong> 提交成功.";
        echo "</div>";

        ?>
                        </div>
                        <?php }?>


                        <div class="table-responsive invoice-table">
                            <h3>我的信息：</h3><br />

                            <?php
echo pdo_search_table("mob_view", ["飞行呼号" => "flight_callsign", "起飞机场ICAO" => 'dep', "到达机场ICAO" => "arr", "航路" => "route", "预计起飞时间" => "totime", "日期" => "datef", "状态" => 'status'], ["user" => $_SESSION["user_website"]]);

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