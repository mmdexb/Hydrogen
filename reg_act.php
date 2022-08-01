<?php
require "function.php";
session_start();
require "header.php";
?>

<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">活动</h3>
    </div>
    <div id="main-wrapper">

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">活动报名</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive invoice-table">

                            <?php
if (isset($_SESSION["user_website"])) {
    $aid = $_GET["aid"];
    $array_get = array(
        'aid' => $_GET["aid"],
        'status' => 1,
    );
    if (sql_count_out("activities", $array_get) > 0) {
        $start_time = sql_select_out("activities", ["start_time" => "start_time"], $array_get);
        if (time() < strtotime($start_time)) {
            echo '<div class="alert alert-success" role="alert">
                                                活动ID:' . $aid . '
                                            </div>';

            ?>

                            <form method="POST" action="./my_activities.php?type=reg_act">
                                <div class="form-group" hidden>
                                    <label for="username">活动ID</label>
                                    <input type="text" class="form-control" id="username" name="aid"
                                        value="<?php echo $aid; ?>" hidden>
                                </div>
                                <div class="form-group">
                                    <label for="username">连线呼号</label>
                                    <input type="text" class="form-control" id="username" name="callsign"
                                        placeholder="请输入连线呼号">
                                </div>
                                <br />
                                <button type="submit" class="btn btn-primary">报名</button>


                            </form>

                            <?php
} else {
            echo '<div class="alert alert-warning" role="alert">
                            活动过期
                        </div>';
        }

    } else {
        echo '<div class="alert alert-warning" role="alert">
                                活动不存在!或状态为激活
                            </div>';
    }
}
?>

                        </div>
                    </div>
                </div>
            </div>

        </div><!-- Row -->


    </div><!-- Main Wrapper -->
    <div class="page-footer">
        <p><?php echo $GLOBALS['websitename_copy']; ?></p>
    </div>
</div><!-- /Page Inner -->
<?php
require "footer.php";
?>
<script>
myact.classList.add("active-page");
</script>