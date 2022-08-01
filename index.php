<?php
require("function.php");
session_start();
require("header.php");
?>

<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">控制台</h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-white stats-widget">
                    <div class="panel-body">
                        <div class="pull-left">
                            <span class="stats-number"><?php
                                                        $array = array(
                                                            'active' => '1'
                                                        );;
                                                        echo sql_count_out('user', $array);

                                                        ?></span>
                            <p class="stats-info">注册用户</p>
                        </div>
                        <div class="pull-right">
                            <i class="fa fa-user-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-white stats-widget">
                    <div class="panel-body">
                        <div class="pull-left">
                            <span class="stats-number"><?php
                                                        $array = array(
                                                            'active' => '1'
                                                        );;
                                                        echo sql_count_out('user', $array);

                                                        ?></span>
                            <p class="stats-info">注册呼号</p>
                        </div>
                        <div class="pull-right">
                            <i class="fa fa-address-card"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-white stats-widget">
                    <div class="panel-body">
                        <div class="pull-left">
                            <span class="stats-number"><?php
                                                        $array = array(
                                                            'status' => '0'
                                                        );;
                                                        echo sql_count_out('activities', $array);

                                                        ?></span>
                            <p class="stats-info">归档活动</p>
                        </div>
                        <div class="pull-right">
                            <i class="fa fa-calendar-check-o"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-white stats-widget">
                    <div class="panel-body">
                        <div class="pull-left">
                            <span class="stats-number"><?php
                                                        $array = array(
                                                            'status' => '1'
                                                        );;
                                                        echo sql_count_out('atc', $array);

                                                        ?></span>
                            <p class="stats-info">注册管制</p>
                        </div>
                        <div class="pull-right">
                            <i class="fa fa-headphones"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">近期活动</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive invoice-table">

                            <?php
                            $array_t = array(
                                '活动ID' => 'aid',
                                '活动名称' => 'name',
                                '机场1' => 'airport1',
                                '机场2' => 'airport2',
                                '类型' => 'type',
                                '起始时间' => 'start_time',
                                '结束时间' => 'end_time'
                            );;

                            echo pdo_search_table_nc('last_5_activities', $array_t); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">服务器状态</h4>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <div class="server-load row">
                                <div class="server-stat col-sm-4">
                                    <p>正常</p>
                                    <span>连飞状态</span>
                                </div>
                                <div class="server-stat col-sm-4">
                                    <p>正常</p>
                                    <span>语音状态</span>
                                </div>
                                <div class="server-stat col-sm-4">
                                    <p>正常</p>
                                    <span>网站状态</span>
                                </div>
                            </div>
                        </div>
                        <div id="chart2"><svg></svg></div>
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
require("footer.php");
?>
<script>
    dashbord.classList.add("active-page");
</script>