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
        <h3 class="breadcrumb-header" id="act_manage">用户时长-<?php echo $_GET["userbb"]; ?>
    </div>



    <div id="main-wrapper">
        <?php
if (isset($_SESSION["user_website"])) {?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">用户时长</h4>
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
            '时长' => 'time',
            '原因' => 'text',

        );
        $array_pt = array(
            'time' => 'time',
        );
        $array_where = array(
            'user' => $_GET["userbb"],

        );
        $b = pdo_search_table("time", $array_get, $array_where);
        print($b);
        $array_t = pdo_search_array("time", $array_pt, $array_where);
        //print_r($array_t);
        //循环数组array_t
        $time_p = 0;
        foreach ($array_t as $key => $value) {
            $time_p = $time_p + ((float) $value["time"]);
        }
        ?><?php
echo "<h1> 总时长：" . $time_p . "h";

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