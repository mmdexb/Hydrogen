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
        <h3 class="breadcrumb-header" id="act_manage">活动报名详细</h3>
        <?php echo $ab; ?>
    </div>
    <div id="main-wrapper">
        <?php
if (isset($_SESSION["user_website"])) {?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">活动报名详细</h4>
                    </div>

                    <?php
$act = $_GET["act"];
    echo pdo_search_table("activities_bm", array("用户" => "user", "连飞航班号[呼号]" => "callsign"), array('aid' => $act));
    ?>

                </div>
            </div>
            <?php }?>
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
admin_act.classList.add("active-page");
</script>