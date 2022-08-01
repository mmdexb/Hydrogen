<?php
require "function.php";
session_start();
require "header.php";
$ab = "<br/>导航条：<a href='#act_manage'>活动管理</a> | <a href='#user_manage'>用户管理</a> | <a href='#value_look'>内容查看</a>";
if (is_admin()) {

} else {
    jump("./index.php");
    exit;
}
?>

<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header" id="act_manage">活动管理</h3>
        <?php echo $ab; ?>
    </div>
    <div id="main-wrapper">
        <?php
if (isset($_SESSION["user_website"])) {?>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">活动添加</h4>
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
if (is_array($_GET) && count($_GET) > 0) {
            if (isset($_GET["type"])) {
                if ($_GET["type"] == 'add_act') {
                    $array_insert = array(
                        'name' => $_POST["name"],
                        'airport1' => $_POST["airport1"],
                        'airport2' => $_POST["airport2"],
                        'route' => $_POST["route"],
                        'status' => $_POST["status"],
                        'start_time' => $_POST["start_time"],
                        'end_time' => $_POST["end_time"],
                        'detail' => $_POST["detail"],

                    );
                    sql_insert_in('activities', $array_insert);
                    echo '<div class="alert alert-success" role="alert">
                                                成功添加！
                                            </div>';
                }
            }
        }

        ?>




                            <form method="post" action="admin.php?type=add_act">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">活动名</label>
                                    <input name="name" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="活动名" value="">
                                </div>
                                <div class="form-group">
                                    <label for="airport1">机场1</label>
                                    <input name="airport1" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="起始机场" value="">
                                </div>
                                <div class="form-group">
                                    <label for="airport2">机场2</label>
                                    <input name="airport2" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="降落机场" value="">
                                </div>
                                <div class="form-group">
                                    <label for="route">航路</label>
                                    <input name="route" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="跑道" value="">
                                </div>
                                <div class="form-group">
                                    <label for="status">状态</label>
                                    <input name="status" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="活动时间" value="">
                                </div>
                                <div class="form-group">
                                    <label for="status">详细内容</label>
                                    <input name="detail" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="活动时间" value="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">起始时间(关闭报名时间)</label>
                                    <input name="start_time" type="datetime-local" id="txtDate" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">起始时间(活动结束时间)</label>
                                    <input name="end_time" type="datetime-local" id="txtDate" class="form-control" />
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">活动删除</h4>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <?php
if (is_array($_GET) && count($_GET) > 0) {
        if (isset($_GET["type"])) {
            if ($_GET["type"] == 'del_act') {
                $array_con = array(

                    'aid' => $_POST["id"],

                );
                sql_delete_in('activities', $array_con);
                echo '<div class="alert alert-success" role="alert">
                                                成功删除！
                                            </div>';
            }
        }
    }

    ?>
                            <form method="post" action="admin.php?type=del_act">
                                <div class="form-group">
                                    <label for="id">AID:</label>
                                    <select name="id" placeholder="" class="form-control">
                                        <?php
$array_t = array(
        'aid' => 'aid',
        'name' => 'name',

    );

    $b = pdo_search_select_nc('activities', $array_t);
    // print_r($b);
    foreach ($b as $value) {
        echo "<option value ='{$value['aid']}'>{$value['name']}";
        echo "</option>";
    }
    ?>
                                    </select>

                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">活动禁用</h4>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <?php
if (is_array($_GET) && count($_GET) > 0) {
        if (isset($_GET["type"])) {
            if ($_GET["type"] == 'jy_act') {
                $array = array(

                    'status' => 0,

                );
                $array_con = array(

                    'aid' => $_POST['id'],

                );
                pdo_updata('activities', $array, $array_con);
                echo '<div class="alert alert-success" role="alert">
                                                成功修改！
                                            </div>';
            }
        }
    }

    ?>
                            <form method="post" action="admin.php?type=jy_act">
                                <div class="form-group">
                                    <label for="id">AID:</label>
                                    <select name="id" placeholder="" class="form-control">
                                        <?php
$array_t = array(
        'aid' => 'aid',
        'name' => 'name',

    );

    $b = pdo_search_select_nc('activities', $array_t);
    // print_r($b);
    foreach ($b as $value) {
        echo "<option value ='{$value['aid']}'>{$value['name']}";
        echo "</option>";
    }
    ?>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">活动启用</h4>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <?php
if (is_array($_GET) && count($_GET) > 0) {
        if (isset($_GET["type"])) {
            if ($_GET["type"] == 'qy_act') {
                $array = array(

                    'status' => 1,

                );
                $array_con = array(

                    'aid' => $_POST['id'],

                );
                pdo_updata('activities', $array, $array_con);
                echo '<div class="alert alert-success" role="alert">
                                                成功修改！
                                            </div>';
            }
        }
    }

    ?>
                            <form method="post" action="admin.php?type=qy_act">
                                <div class="form-group">
                                    <label for="id">AID:</label>
                                    <select name="id" placeholder="" class="form-control">
                                        <?php
$array_t = array(
        'aid' => 'aid',
        'name' => 'name',

    );

    $b = pdo_search_select_nc('activities', $array_t);
    // print_r($b);
    foreach ($b as $value) {
        echo "<option value ='{$value['aid']}'>{$value['name']}";
        echo "</option>";
    }
    ?>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="page-title col-lg-12 col-md-12">
                <h3 class="breadcrumb-header" id="user_manage">用户管理</h3>
                <?php echo $ab; ?>
            </div>

            <div class="col-lg-3 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">设置管制</h4>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <?php
if (is_array($_GET) && count($_GET) > 0) {
        if (isset($_GET["type"])) {
            if ($_GET["type"] == 'atc_act') {

                $array_t = array(
                    'pwd' => 'pwd',
                );
                $array_c = array(
                    'user' => $_POST["uid"],
                );
                $pwd = sql_select_out('user', $array_t, $array_c);

                $array_insert = array(
                    'user' => $_POST["uid"],
                    'level' => $_POST["atcid"],
                    'status' => 1,
                );
                sql_insert_in('atc', $array_insert);
                edit_user_level($_POST["uid"], $_POST["atcid"]);
                del_txt(read_txt($_POST["uid"]));
                $l_id = array_search($_POST["atcid"], $GLOBALS["fsd_level"]);
                //echo $l_id;
                add_dj($_POST["uid"], $pwd, $l_id);
                qckh();
                $array_up = array(
                    'is_atc' => $l_id,
                );
                $array_con = array(
                    'user' => $_POST['uid'],
                );
                pdo_updata('user', $array_up, $array_con);
                echo '<div class="alert alert-success" role="alert">
                                                成功设置！
                                            </div>';
            }
        }
    }

    ?>
                            <form method="post" action="admin.php?type=atc_act">
                                <div class="form-group">
                                    <label for="id">用户:</label>
                                    <select name="uid" placeholder="" class="form-control">
                                        <?php
$array_t = array(
        'id' => 'id',
        'user' => 'user',
        'email' => 'email',
        'qq' => 'qq',
    );

    $b = pdo_search_select_nc('user', $array_t);
    // print_r($b);
    foreach ($b as $value) {
        echo "<option value ='{$value['user']}'>ID:{$value['id']} | 呼号:{$value['user']} | 邮箱:{$value['email']} | QQ:{$value['qq']}";
        echo "</option>";
    }
    ?>
                                    </select>
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
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">用户密码</h4>
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
                    'user' => $_POST['ft_id'],
                );
                pdo_updata('user', $array, $array_con);

                $array_b = array(
                    'is_atc' => 'is_atc',
                );
                $array_c = array(
                    'user' => $_POST["ft_id"],
                );
                $is_atc = sql_select_out('user', $array_b, $array_c);

                if ($is_atc == '0') {
                    $is_atc = "1";
                } else {
                    $is_atc = $is_atc;
                }

                del_txt(read_txt($_POST["ft_id"]));
                add_dj($_POST["ft_id"], $_POST["password"], $is_atc);
                //echo $is_atc;
                edit_user_pwd($_POST['ft_id'], $_POST["password"], $is_atc);
                qckh();
                echo '<div class="alert alert-success" role="alert">
                                                成功修改！
                                            </div>';
            }
        }
    }

    ?>
                            <form method="post" action="admin.php?type=pwd_user">
                                <div class="form-group">
                                    <label for="id">用户:</label>
                                    <select name="ft_id" placeholder="" class="form-control">
                                        <?php
$array_t = array(
        'id' => 'id',
        'user' => 'user',
        'email' => 'email',
        'qq' => 'qq',
    );

    $b = pdo_search_select_nc('user', $array_t);
    // print_r($b);
    foreach ($b as $value) {
        echo "<option value ='{$value['user']}'> 呼号:{$value['user']} ";
        echo "</option>";
    }
    ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="id">新密码:</label>
                                    <input name="password" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="新密码" value="">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">用户禁用</h4>
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

                    'user' => $_POST['ft_id'],

                );
                pdo_updata('user', $array, $array_con);
                echo '<div class="alert alert-success" role="alert">
                                                成功修改！
                                            </div>';
            }
        }
    }

    ?>
                            <form method="post" action="admin.php?type=jy_user">
                                <div class="form-group">
                                    <label for="id">用户:</label>
                                    <select name="ft_id" placeholder="" class="form-control">
                                        <?php
$array_t = array(
        'id' => 'id',
        'user' => 'user',
        'email' => 'email',
        'qq' => 'qq',
    );

    $b = pdo_search_select_nc('user', $array_t);
    // print_r($b);
    foreach ($b as $value) {
        echo "<option value ='{$value['user']}'>呼号:{$value['user']}";
        echo "</option>";
    }
    ?>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">用户启用</h4>
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

                    'user' => $_POST['ft_id'],

                );
                pdo_updata('user', $array, $array_con);
                echo '<div class="alert alert-success" role="alert">
                                                成功修改！
                                            </div>';
            }
        }
    }

    ?>
                            <form method="post" action="admin.php?type=qy_user">

                                <div class="form-group">
                                    <label for="id">用户:</label>
                                    <select name="ft_id" placeholder="" class="form-control">
                                        <?php
$array_t = array(
        'id' => 'id',
        'user' => 'user',
        'email' => 'email',
        'qq' => 'qq',
    );

    $b = pdo_search_select_nc('user', $array_t);
    // print_r($b);
    foreach ($b as $value) {
        echo "<option value ='{$value['user']}'>ID:{$value['id']} | 呼号:{$value['user']} | 邮箱:{$value['email']} | QQ:{$value['qq']}";
        echo "</option>";
    }
    ?>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="page-title col-lg-12 col-md-12">
                <h3 class="breadcrumb-header" id=“value_look”>内容查看</h3>
                <?php echo $ab; ?>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">用户</h4>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <?php
$array_t = array(
        '用户ID' => 'id',
        '用户名' => 'user',
        '邮箱' => 'email',
        'QQ' => 'qq',
        '用户状态' => 'active',
    );

    echo pdo_search_table_nc('user', $array_t);?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">活动</h4>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <?php
$array_t = array(
        '活动ID' => 'aid',
        '活动名' => 'name',
        '活动航路' => 'route',
        '机场1' => 'airport1',
        '机场2' => 'airport2',
        '状态' => 'status',
        '起始时间' => 'start_time',
        '终止时间' => 'end_time',
        '详细内容' => 'detail',
    );

    echo pdo_search_table_nc('activities', $array_t);?>
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
admin.classList.add("active-page");
</script>