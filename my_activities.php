<?php
require "function.php";
session_start();
require "header.php";
?>

<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">活动</h3>
    </div>
    <div id="main-wrapper">

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">活动报名</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive invoice-table">

                            <?php

if (isset($_SESSION["user_website"])) {
    $array_t = array(
        '活动ID' => 'aid',
        '活动名称' => 'name',
        '机场1' => 'airport1',
        '机场2' => 'airport2',

        '起始时间' => 'start_time',
        '结束时间' => 'end_time',
    );
    $array_c = array(
        'status' => 1,

    );
    $array_b = array(
        '报名' => ['aid', 'aid', 'btn btn-info', 'reg_act.php'],

    );
    echo get_act('activities', $array_t, $array_c, $array_b);
}
?>

                        </div>
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
if (isset($_SESSION["user_website"])) {
    if (is_array($_GET) && count($_GET) > 0) {
        if (isset($_GET["type"])) {
            if ($_GET["type"] == 'reg_act') {

                $start_time = sql_select_out("activities", ["start_time" => "start_time"], ["aid" => $_POST["aid"]]);
                if (time() < strtotime($start_time)) {

                    $array_get = array(
                        'aid' => $_POST["aid"],
                        'status' => 1,
                    );
                    //print_r($array_get);
                    if (sql_count_out("activities", $array_get) > 0) {

                        $array_get_b = array(
                            'callsign' => $_POST["callsign"],
                            'aid' => $_POST["aid"],

                        );
                        if (sql_count_out("activities_bm", $array_get_b) > 0) {
                            echo '<div class="alert alert-warning" role="alert">
                                                    呼号已经存在！
                                                </div>';
                        } else {

                            $array_get_user = array(
                                'aid' => $_POST["aid"],
                                'user' => $_SESSION["user_website"],
                            );
                            if (!sql_count_out("activities_bm", $array_get_user) > 0) {
                                $array_insert = array(
                                    'callsign' => $_POST["callsign"],
                                    'aid' => $_POST["aid"],
                                    'user' => $_SESSION["user_website"],
                                    'status' => 1,
                                );
                                sql_insert_in("activities_bm", $array_insert);
                                echo '<div class="alert alert-success" role="alert">
                                                成功报名！
                                            </div>';
                            } else {
                                echo '<div class="alert alert-warning" role="alert">
                                                您已经报名过此活动
                                            </div>';
                            }
                        }
                    } else {
                        echo '<div class="alert alert-warning" role="alert">
                                            活动不存在!或状态为激活
                                        </div>';
                    }
                } else {
                    echo '<div class="alert alert-warning" role="alert">
                    活动过期
                </div>';
                }
            }
        }
    }

    ?>
                            <?php
$array_t = array(
        '活动名' => 'name',
        '连线呼号' => 'callsign',
        '机场1' => 'airport1',
        '机场2' => 'airport2',
        '航路' => 'route',
        '状态' => 'status_name',
    );
    $array_c = array(
        'user' => $_SESSION["user_website"],

    );

    echo pdo_search_table('user_activities', $array_t, $array_c);
}?>

                        </div>

                    </div>
                </div>
            </div>
        </div><!-- Row -->


    </div><!-- Main Wrapper -->
    <div class="page-footer">
        <p><?php echo $GLOBALS['websitename_copy']; ?></p>
    </div>
</div><!-- /Page Inner -->
<?php
require "footer.php";
?>
<script>
myact.classList.add("active-page");
</script>