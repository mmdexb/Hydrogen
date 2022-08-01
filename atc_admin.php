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
        <h3 class="breadcrumb-header" id="act_manage">管局公示</h3>
        <?php echo $ab; ?>
    </div>
    <div id="main-wrapper">
        <?php
if (isset($_SESSION["user_website"])) {?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">管局公示</h4>
                    </div>


                    <?php
//判断是否有get type=edit
    if (isset($_GET["type"])) {
        if ($_GET["type"] == "edit") {
            $up = array(
                'context' => $_POST["html"],
            );

            $where = array(
                "ud" => 'gg',
            );
            pdo_updata("setting", $up, $where);
        }
    }

    ?>


                    <form method="post" action="atc_admin.php?type=edit">
                        <script id="container" name="html" type="text/plain" placeholder="内容">
                            <?php echo sql_select_out("setting", ["context"], ["ud" => "gg"]); ?></script>
                        <!-- 配置文件 -->
                        <script type="text/javascript" src="./ueditor/ueditor.config.js"></script>
                        <!-- 编辑器源码文件 -->
                        <script type="text/javascript" src="./ueditor/ueditor.all.js"></script>
                        <!-- 实例化编辑器 -->
                        <script type="text/javascript">
                        var ue = UE.getEditor('container');
                        </script>
                        <button type="submit" class="btn btn-primary">提交</button>
                    </form>

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
admin_atc.classList.add("active-page");
</script>