<?php
require "function.php";
session_start();
require "header.php";

?>

<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">时长排名</h3>
    </div>
    <div id="main-wrapper">

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">时长排名</h4>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive invoice-table">
                            <script type="text/javascript"
                                src="https://cdn.jsdelivr.net/npm/echarts@5.3.0/dist/echarts.min.js"></script>
                            <div class="col-12">

                                <div id="container" style="height: 360px;"></div>

                            </div>





                            <script type="text/javascript">
                            var dom = document.getElementById("container");
                            var myChart = echarts.init(dom);
                            var app = {};

                            var option;



                            option = {
                                tooltip: {
                                    trigger: 'axis',
                                    axisPointer: {
                                        type: 'shadow'
                                    }
                                },
                                grid: {
                                    left: '3%',
                                    right: '4%',
                                    bottom: '3%',
                                    containLabel: true
                                },
                                xAxis: [{
                                    type: 'category',

                                    data: <?php echo get_user_p_huhao(); ?>,


                                    axisLabel: {
                                        interval: 0,
                                        rotate: 15
                                    }
                                }],
                                yAxis: [{
                                    type: 'value'
                                }],
                                series: [{
                                    name: '时长（小时）',
                                    type: 'bar',
                                    barWidth: '60%',
                                    data: <?php echo get_user_p_time(); ?>
                                }]
                            };

                            if (option && typeof option === 'object') {
                                myChart.setOption(option);
                            }
                            </script>
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
    time.classList.add("active-page");
    </script>