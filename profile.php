<?php
require "function.php";
session_start();
require "header.php";
?>

<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">个人信息</h3>
    </div>
    <div id="main-wrapper">
        <?php
if (isset($_SESSION["user_website"])) {?>
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">个人信息</h4>
                    </div>
                    <div class="panel-body">
                        <style type="text/css">
                        .cc {
                            color: #FFF;
                            width: 100%;
                            border-radius: 15px;
                            background: url(./assets/images/bp.png) repeat-y;
                        }
                        </style>
                        <div class="table-responsive invoice-table">
                            <div class="cc"><br />
                                <center>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false"><img
                                            src="http://q2.qlogo.cn/headimg_dl?dst_uin=<?php echo get_qq(); ?>&spec=100"
                                            alt="" class="img-circle"></a>

                                    <br /><br />连飞用户UID：<span><?php get_uid();?></span></br>
                                    连线呼号：<span><?php echo $_SESSION["user_website"]; ?></span>
                                    <br />
                                    <br /> <br />




                                    <?php

    ?>
                                </center>
                            </div>
                            <?php
$array_t = array(

        '管制等级' => 'atc_level_name',
        '飞行等级' => 'pilot_level',
    );
    $array_c = array(
        'user' => $_SESSION["user_website"],

    );

    echo pdo_search_table('user_view', $array_t, $array_c);?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">呼号状态</h4>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <?php
$array_t = array(
        '呼号' => 'user',

        '状态' => 'status_name',
    );
    $array_c = array(
        'user' => $_SESSION["user_website"],

    );

    echo pdo_search_table('user_view', $array_t, $array_c);?>

                        </div>
                        <hr>
                        <center>
                            <a href="./route_track.php"> <button class="btn waves-effect waves-light btn-success"
                                    style="width:30%">飞行记录</button>
                                <br /><br /><a href="./metar.php"><button class="btn waves-effect waves-light btn-info"
                                        style="width:30%">气象查询</button></a>
                                <br /><br /><a href="./atc_an.php"><button
                                        class="btn waves-effect waves-light btn-warning"
                                        style="width:30%">管局公示</button></a>
                        </center>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">资料修改</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive invoice-table">
                            <?php
//判断是否有TYPE数据
    if (isset($_GET["type"])) {
        //判断type值
        if ($_GET["type"] == "renew") {
            $email = $_POST["email"];
            $qq = $_POST["qq"];
            $error = 0;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 1;
                echo '<div class="alert alert-warning" role="alert">
                无效的电子邮箱！请重新输入
            </div>';
                //echo "<script>alert('邮箱格式不正确！');</script>";
            }
            if (!is_numeric($qq)) {
                $error = 2;
                echo '<div class="alert alert-warning" role="alert">
                QQ格式错误！请重新输入
            </div>';
            }
            if ($error == 0) {
                $arr = array(
                    'email' => $email,
                    'qq' => $qq,
                );
                $con = array(
                    'user' => $_SESSION["user_website"],
                );
                pdo_updata('user', $arr, $con);
                echo '<div class="alert alert-success" role="alert">
                成功修改！
            </div>';
            }
        }
    }
    ?>
                            <form action="profile.php?type=renew" method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">邮箱</label>
                                    <input type="text" class="form-control" name="email"
                                        value="<?php echo get_email(); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">QQ</label>
                                    <input type="text" class="form-control" name="qq" value="<?php echo get_qq(); ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">修改</button>
                            </form>



                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">我的时长</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive invoice-table">
                            <?php

    $array_get = array(
        '用户名' => 'user',
        '时长' => 'time',
        '原因' => 'text',

    );
    $array_pt = array(
        'time' => 'time',
    );
    $array_where = array(
        'user' => $_SESSION["user_website"],

    );
    $b = pdo_search_table("time", $array_get, $array_where);
    print($b);
    $array_t = pdo_search_array("time", $array_pt, $array_where);
//print_r($array_t);
//循环数组array_t
    $time_p = 0.00;
    foreach ($array_t as $key => $value) {
        $time_p = $time_p + ((float) $value["time"]);
    }
    ?><?php
echo "<h3> 总时长：" . $time_p . "h</h3>";

    ?>




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