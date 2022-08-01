<?php
require "function.php";
session_start();
require "header.php";

?>

<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">手游综合系统-机组</h3>
    </div>
    <div id="main-wrapper">
        <?php
if (isset($_SESSION["user_website"])) {?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">

                        <h4 class="panel-title">手游综合系统-机组</h4>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive invoice-table">
                            <a href="mob_plan.php" class="btn btn-primary">返回系统</a>

                            <h3>提交信息：</h3><br />
                            <form action="mob_plan_pil.php?type=tj" method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">航班呼号</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                        name="flight_callsign">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">起飞机场</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                        name="dep">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">到达机场</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                        name="arr">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">航路</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                        name="route">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">航高</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                        name="fl">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">计划起飞时间</label>
                                    <input type="time" class="form-control" id="exampleInputEmail1" placeholder=""
                                        name="totime">

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">计划起飞日期</label>
                                    <input type="date" class="form-control" id="exampleInputEmail1" placeholder="机组名称"
                                        name="datef">

                                </div>
                                <button type="submit" class="btn btn-primary">提交</button>
                            </form>
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
        mob.classList.add("active-page");
        </script>