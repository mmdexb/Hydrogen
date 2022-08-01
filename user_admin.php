<?php
require "function.php";
session_start();
require "header.php";
//$ab = "<br/>导航条：<a href='#act_manage'>活动管理</a> | <a href='#user_manage'>用户管理</a> | <a href='#value_look'>内容查看</a>";
if (is_admin()) {

} else {
    jump("./index.php");
    exit;
}

?>

<div class="page-inner">
    <?php if ($_GET["bi"] == '1') {?>
    <div class="page-title col-lg-12 col-md-12">
        <h3 class="breadcrumb-header" id="user_manage">用户管理</h3>
        <?php echo $ab; ?>
    </div>

    <div class="col-lg-3 col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">设置管制- <?php echo $_GET["userbb"]; ?></h4>
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    <?php
if (is_array($_GET) && count($_GET) > 0) {
    if (isset($_GET["type"])) {
        if ($_GET["type"] == 'atc_act') {

            $array_t = array(
                'pwd' => 'pwd',
                'user' => 'user',
            );
            $array_c = array(
                'user' => $_GET["userbb"],
            );
            $pwd = sql_select_out_bb('user', $array_t, $array_c);
            //echo $pwd;

            if (sql_count_out('atc', array('user' => $_GET["userbb"])) > 0) {
                pdo_updata("atc", array('level' => $_POST["atcid"], 'status' => 1), array('user' => $_GET["userbb"]));
                if ($_POST["atcid"] == 'OBSPILOT') {
                    pdo_delete_table("atc", array('user' => $_GET["userbb"]));
                }
            } else {
                $array_insert = array(
                    'user' => $_GET["userbb"],
                    'level' => $_POST["atcid"],
                    'status' => 1,
                );
                sql_insert_in('atc', $array_insert);
                if ($_POST["atcid"] == 'OBSPILOT') {
                    pdo_delete_table("atc", array('user' => $_GET["userbb"]));
                }
            }

            edit_user_level($_GET["userbb"], $_POST["atcid"]);
            del_txt(read_txt($_GET["userbb"]));
            $l_id = array_search($_POST["atcid"], $GLOBALS["fsd_level"]);
            //echo $l_id;
            add_dj($_GET["userbb"], $pwd, $l_id);
            qckh();
            $array_up = array(
                'is_atc' => $l_id,
            );
            $array_con = array(
                'user' => $_GET["userbb"],
            );
            pdo_updata('user', $array_up, $array_con);
            echo '<div class="alert alert-success" role="alert">
                                                成功设置！
                                            </div>';
        }
    }
}

    ?>
                    <form method="post" action="user_admin.php?type=atc_act&bi=1&userbb=<?php echo $_GET["userbb"] ?>">

                        <div class="form-group">
                            <label for="id">当前等级:</label>

                            <?php
$atc_level_id = sql_select_out("user", array('is_atc' => 'is_atc'), array('user' => $_GET["userbb"]));
    echo $atc_level = $GLOBALS["fsd_level"][$atc_level_id];
    ?>
                        </div>
                        <div class="form-group">
                            <label for="id">管制级别:</label>
                            <select name="atcid" placeholder="" class="form-control">
                                <?php

    $c = $GLOBALS["fsd_level"];
//print_r($b);
    foreach ($c as $value) {
        echo "<option value ='{$value}'>等级:{$value}";
        echo "</option>";
    }
    ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">提交</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">设置飞行等级- <?php echo $_GET["userbb"]; ?></h4>
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    <?php
if (is_array($_GET) && count($_GET) > 0) {
        if (isset($_GET["type"])) {
            if ($_GET["type"] == 'pilot_level') {

                if (sql_count_out('pilot', array('user' => $_GET["userbb"])) > 0) {
                    pdo_updata("pilot", array('pilot_level_id' => $_POST["atcid"], 'pilot_level' => $GLOBALS["p_level"][$_POST["atcid"]]), array('user' => $_GET["userbb"]));

                } else {
                    $array_insert = array(
                        'user' => $_GET["userbb"],
                        'pilot_level_id' => $_POST["atcid"],
                        'pilot_level' => $GLOBALS["p_level"][$_POST["atcid"]],
                    );
                    sql_insert_in('pilot', $array_insert);

                }

                echo '<div class="alert alert-success" role="alert">
                                                成功设置！
                                            </div>';
            }
        }
    }

    ?>
                    <form method="post"
                        action="user_admin.php?type=pilot_level&bi=1&userbb=<?php echo $_GET["userbb"] ?>">

                        <div class="form-group">
                            <label for="id">当前等级:</label>

                            <?php
$pilot_level = sql_select_out("pilot", array('pilot_level' => 'pilot_level'), array('user' => $_GET["userbb"]));
    echo $pilot_level;
    ?>
                        </div>
                        <div class="form-group">
                            <label for="id">设置级别:</label>
                            <select name="atcid" placeholder="" class="form-control">
                                <?php

    $c_p = $GLOBALS["p_level"];
    //print_r($c_p);
    //print_r($GLOBALS["pilot_level"]);
    foreach ($c_p as $key => $value) {
        echo "<option value ='{$key}'>等级:{$value}";
        echo "</option>";
    }
    ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">提交</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">用户密码- <?php echo $_GET["userbb"]; ?></h4>
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    <?php
if (is_array($_GET) && count($_GET) > 0) {
        if (isset($_GET["type"])) {
            if ($_GET["type"] == 'pwd_user') {
                $array = array(
                    'pwd' => $_POST['password'],
                );
                $array_con = array(
                    'user' => $_GET["userbb"],
                );
                pdo_updata('user', $array, $array_con);

                $array_b = array(
                    'is_atc' => 'is_atc',
                );
                $array_c = array(
                    'user' => $_GET["userbb"],
                );
                $is_atc = sql_select_out('user', $array_b, $array_c);

                if ($is_atc == '0') {
                    $is_atc = "1";
                } else {
                    $is_atc = $is_atc;
                }

                del_txt(read_txt($_GET["userbb"]));
                add_dj($_GET["userbb"], $_POST["password"], $is_atc);
                //echo $is_atc;
                edit_user_pwd($_GET["userbb"], $_POST["password"], $is_atc);
                qckh();
                echo '<div class="alert alert-success" role="alert">
                                                成功修改！
                                            </div>';
            }
        }
    }

    ?>
                    <form method="post" action="user_admin.php?type=pwd_user&bi=1&userbb=<?php echo $_GET["userbb"] ?>">

                        <div class="form-group">
                            <label for="id">新密码:</label>
                            <input name="password" type="text" class="form-control" id="exampleInputPassword1"
                                placeholder="新密码" value="">
                        </div>
                        <button type="submit" class="btn btn-primary">提交</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">用户禁用- <?php echo $_GET["userbb"]; ?></h4>
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    <?php
if (is_array($_GET) && count($_GET) > 0) {
        if (isset($_GET["type"])) {
            if ($_GET["type"] == 'jy_user') {
                $array = array(

                    'active' => 0,

                );
                $array_con = array(

                    'user' => $_GET["userbb"],

                );
                pdo_updata('user', $array, $array_con);
                echo '<div class="alert alert-success" role="alert">
                                                成功修改！
                                            </div>';
            }
        }
    }

    ?>
                    <form method="post" action="user_admin.php?type=jy_user&bi=1&userbb=<?php echo $_GET["userbb"] ?>">


                        <button type=" submit" class="btn btn-primary">提交</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">用户时长- <?php echo $_GET["userbb"]; ?></h4>
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    <?php
if (is_array($_GET) && count($_GET) > 0) {
        if (isset($_GET["type"])) {
            if ($_GET["type"] == 'add_user_time') {
                if ($_POST["typep"] == "a") {
                    //增加
                    $p = "+";

                } else {
                    $p = "-";
                }
                $array_insert_time = array(
                    "user" => $_GET["userbb"],
                    "time" => (float) ($p . $_POST["hour"]),
                    "type" => $_POST["typep"],
                    "text" => $_POST["text"],
                );
                sql_insert_in('time', $array_insert_time);

                echo '<div class="alert alert-success" role="alert">
                                                成功增加！
                                            </div>';
            }
        }
    }

    ?>
                    <form method="post"
                        action="user_admin.php?type=add_user_time&bi=1&userbb=<?php echo $_GET["userbb"] ?>">

                        <div class="form-group">
                            <label for="id">时长:</label>
                            <select name="typep" class="form-control">
                                <option value="d">减少</option>
                                <option value="a" selected>增加</option>
                            </select>

                            <input name="hour" type="text" class="form-control" id="exampleInputPassword1"
                                placeholder="小时（整数）" value="">
                        </div>
                        <div class="form-group">
                            <label for="id">说明:</label>

                            <input name="text" type="text" class="form-control" id="exampleInputPassword1"
                                placeholder="说明" value="">
                        </div>
                        <button type="submit" class="btn btn-primary">提交</button>
                        <a class="btn btn-info" href="user_admin_time.php?&userbb=<?php echo $_GET["userbb"] ?>"
                            target="_blank">时长记录</a>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">用户启用- <?php echo $_GET["userbb"]; ?></h4>
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    <?php
if (is_array($_GET) && count($_GET) > 0) {
        if (isset($_GET["type"])) {
            if ($_GET["type"] == 'qy_user') {
                $array = array(

                    'active' => 1,

                );
                $array_con = array(

                    'user' => $_GET["userbb"],

                );
                pdo_updata('user', $array, $array_con);
                echo '<div class="alert alert-success" role="alert">
                                                成功修改！
                                            </div>';
            }
        }
    }

    ?>
                    <form method="post" action="user_admin.php?type=qy_user&bi=1&userbb=<?php echo $_GET["userbb"] ?>">


                        <button type="submit" class="btn btn-primary">提交</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php } else {

    ?>
    <div class="page-title">
        <h3 class="breadcrumb-header" id="act_manage">用户管理</h3>
        <?php echo $ab; ?>
    </div>

    <?php
}?>




    <div id="main-wrapper">
        <?php
if (isset($_SESSION["user_website"])) {?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">用户管理</h4>
                    </div>
                    <?php
$array_get = array(
    'user' => $_SESSION["user_website"],
    'level' => 2,

);
    if (sql_count_out("user", $array_get) > 0) {

        ?>
                    <div class="panel-body">
                        <div class="table-responsive invoice-table">


                            <?php

        $array_get = array(
            '用户名' => 'user',
            '邮箱' => 'email',
            'QQ' => 'qq',
            '管制等级' => 'is_atc',
            '飞行等级' => 'pilot_level',
            '是否管理' => 'level',
            '是否激活' => 'active',

        );
        $b = pdo_search_table_nc_b_user("user_view", $array_get);
        print($b);
        ?>






                        </div>
                    </div>
                    <?php }?>
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
admin_user.classList.add("active-page");
</script>