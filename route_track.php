<?php
require "function.php";
session_start();
require "header.php";

?>

<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">航行记录</h3>
    </div>
    <div id="main-wrapper">
        <?php
if (isset($_SESSION["user_website"])) {?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">航行记录</h4>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive invoice-table">

                            <?php
if ($_SESSION['user_website']) {

    get_f_track($_SESSION["user_website"]);
} else {

    echo "未登陆，无法查看！";
}?>


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