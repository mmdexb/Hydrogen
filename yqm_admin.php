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
        <h3 class="breadcrumb-header" id="act_manage">邀请码新增</h3>
        <?php echo $ab; ?>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">邀请码添加（一行一个）</h4>
                    </div>
                    <?php
//判断是否有type=add_yqm
if (isset($_GET["type"]) && $_GET["type"] == "add_yqm") {
//将code按行分割为数组
    $code = explode("\n", $_POST["code"]);
    $count = 0;
    foreach ($code as $key => $value) {
        $value = trim($value);
        if ($value != "") {
            $array_c = array(
                'yqm' => $value,
                'status' => '0',
            );
            $status = sql_count_out("yqm", $array_c);

            if ($status > 0) {
                echo "已存在" . $value . "</br>";
            } else {
                sql_insert_in('yqm', $array_c);
                echo "添加" . $value . "</br>";
                $count += 1;
            }

        }
    }
    echo "<script>alert('添加成功，共添加" . $count . "个邀请码');</script>";
}
?>


                    <div class="panel-body">
                        <div class="table-responsive invoice-table">
                            <form action="yqm_admin.php?type=add_yqm" method="post">
                                <div class="form-group">
                                    <textarea class="form-control" name="code" id="code" cols="30" rows="10"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">提交</button>

                            </form>
                            </br>

                            <hr>
                            </br>
                            <h2>可用邀请码列表</h2>
                            <?php
echo pdo_search_table("yqm", ["邀请码" => "yqm"], ["status" => "0"]);

?>
                        </div>
                    </div>

                </div>
            </div><!-- Main Wrapper -->
            <div class="page-footer">
                <p><?php echo $GLOBALS['websitename_copy']; ?></p>
            </div>
        </div><!-- /Page Inner -->
        <?php
require "footer.php";
?>
        <script>
        admin_yqm.classList.add("active-page");
        </script>