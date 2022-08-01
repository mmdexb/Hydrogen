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
                if ($_GET["type"] == 'edit_act') {
                    $array_insert = array(
                        'start_time' => $_POST["start_time"],
                        'end_time' => $_POST["end_time"],
                    );
                    $array_where = array("aid" => $_GET["aid"]);
                    pdo_updata("activities", $array_insert, $array_where);

                    echo '<div class="alert alert-success" role="alert">
                    成功修改！
                </div>';
                }
                if ($_GET["type"] == 'edit_time_act') {
                    $array_insert = array(
                        'name' => $_POST["name"],
                        'airport1' => $_POST["airport1"],
                        'airport2' => $_POST["airport2"],
                        'route' => $_POST["route"],
                        'status' => $_POST["status"],
                        'detail' => $_POST["detail"],
                    );
                    $array_where = array("aid" => $_GET["aid"]);
                    pdo_updata("activities", $array_insert, $array_where);

                    echo '<div class="alert alert-success" role="alert">
                    成功修改！
                </div>';
                }
            }
        }

        ?>




                            <form method="post" action="act_admin.php?type=add_act">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">活动名</label>
                                    <input name="name" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="" value="">
                                </div>
                                <div class="form-group">
                                    <label for="airport1">机场1</label>
                                    <input name="airport1" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="" value="">
                                </div>
                                <div class="form-group">
                                    <label for="airport2">机场2</label>
                                    <input name="airport2" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="" value="">
                                </div>
                                <div class="form-group">
                                    <label for="route">航路</label>
                                    <input name="route" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="" value="">
                                </div>
                                <div class="form-group">
                                    <label for="status">状态</label>
                                    <input name="status" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="" value="">
                                </div>
                                <div class="form-group">
                                    <label for="status">详细内容</label>
                                    <input name="detail" type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="" value="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">起始时间(关闭报名时间)</label>
                                    <input name="start_time" type="datetime-local" id="txtDate" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">结束时间(活动结束时间)</label>
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
                            <form method="post" action="act_admin.php?type=del_act">
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
                            <form method="post" action="act_admin.php?type=jy_act">
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
                            <form method="post" action="act_admin.php?type=qy_act">
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
            <?php

//判断有无GET参数
    if (is_array($_GET) && count($_GET) > 0) {
        if (isset($_GET["bi"])) {
            if ($_GET["bi"] == '1') {
                $array = array(

                    'name' => 'name',
                    'start_time' => 'start_time',
                    'end_time' => 'end_time',
                    'route' => 'route',
                    'detail' => 'detail',
                    'airport1' => 'airport1',
                    'airport2' => 'airport2',
                    'status' => 'status',

                );
                $dataact = pdo_select("activities", array("aid" => $_GET["act"]));
                $act_name = $dataact[0]["name"];
                $act_start_time = $dataact[0]["start_time"];
                $act_end_time = $dataact[0]["end_time"];
                $act_route = $dataact[0]["route"];
                $act_detail = $dataact[0]["detail"];
                $act_airport1 = $dataact[0]["airport1"];
                $act_airport2 = $dataact[0]["airport2"];
                $act_status = $dataact[0]["status"];
                ?>


            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">活动编辑</h4>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <form method="post" action="act_admin.php?type=edit_act&aid=<?php echo $_GET["act"]; ?>">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">活动名</label>
                                    <input name="name" type="text" class="form-control" id="exampleInputPassword1"
                                        value="<?php echo $act_name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="airport1">机场1</label>
                                    <input name="airport1" type="text" class="form-control" id="exampleInputPassword1"
                                        value="<?php echo $act_airport1; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="airport2">机场2</label>
                                    <input name="airport2" type="text" class="form-control" id="exampleInputPassword1"
                                        value="<?php echo $act_airport2; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="route">航路</label>
                                    <input name="route" type="text" class="form-control" id="exampleInputPassword1"
                                        value="<?php echo $act_route; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="status">状态</label>
                                    <input name="status" type="text" class="form-control" id="exampleInputPassword1"
                                        value="<?php echo $act_status; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="status">详细内容</label>
                                    <input name="detail" type="text" class="form-control" id="exampleInputPassword1"
                                        value="<?php echo $act_detail; ?>">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>



            <?php
}
            if ($_GET["bi"] == '2') {
                $array = array(

                    'name' => 'name',
                    'start_time' => 'start_time',
                    'end_time' => 'end_time',
                    'route' => 'route',
                    'detail' => 'detail',
                    'airport1' => 'airport1',
                    'airport2' => 'airport2',
                    'status' => 'status',

                );
                $dataact = pdo_select("activities", array("aid" => $_GET["act"]));
                $act_name = $dataact[0]["name"];
                $act_start_time = $dataact[0]["start_time"];
                $act_end_time = $dataact[0]["end_time"];
                $act_route = $dataact[0]["route"];
                $act_detail = $dataact[0]["detail"];
                $act_airport1 = $dataact[0]["airport1"];
                $act_airport2 = $dataact[0]["airport2"];
                $act_status = $dataact[0]["status"];
                ?>


            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">时间编辑</h4>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <form method="post"
                                action="act_admin.php?type=edit_time_act&aid=<?php echo $_GET["act"]; ?>">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">起始时间(关闭报名时间)</label>
                                    <input name="start_time" type="datetime-local" id="txtDate" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">结束时间(活动结束时间)</label>
                                    <input name="end_time" type="datetime-local" id="txtDate" class="form-control" />
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>



            <?php
}
        }
    }
    ?>

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

    echo pdo_search_table_nc_b_act('activities', $array_t);?>
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
admin_act.classList.add("active-page");
</script>