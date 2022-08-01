<?php
require "function.php";
session_start();
require "header.php";

?>

<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">软件下载</h3>
    </div>
    <div id="main-wrapper">
        <?php
?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">软件下载</h4>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive invoice-table">
                            ECHO连飞软件下载
                            <br />
                            <a class="btn btn-success" href="./soft/echo_setup.exe">下载</a>
                            <br /><br />
                            TEAMSPEAK语音软件下载
                            <br />
                            <a class="btn btn-success" href="./soft/TeamSpeak_3.5.6_win64.exe">下载</a>
                        </div>
                    </div>
                </div>


            </div><!-- Row -->

            <?php ?>
        </div><!-- Main Wrapper -->
        <div class="page-footer">
            <p><?php echo $GLOBALS['websitename_copy']; ?></p>
        </div>
    </div><!-- /Page Inner -->
    <?php
require "footer.php";
?>
    <script>
    soft.classList.add("active-page");
    </script>