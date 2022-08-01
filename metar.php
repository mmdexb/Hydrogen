<?php
require "function.php";
session_start();
require "header.php";

?>

<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">气象查询</h3>
    </div>
    <div id="main-wrapper">
        <?php
if (isset($_SESSION["user_website"])) {?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">METAR报文查询</h4>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive invoice-table">
                            <form action="metar.php?type=metar" method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">METAR报文</label>
                                    <input type="text" class="form-control" name="metar" placeholder="请输入查询的机场">
                                </div>
                                <button type="submit" class="btn btn-primary">查询</button>
                            </form>


                            <?php

//判断是否有TYPE数据
    if (isset($_GET["type"])) {
        //判断type值

        $metar = $_POST["metar"];
        //取网页内容file
        $file = "http://metar.vatsim.net/$metar";
        //取网页内容file
        $file = file_get_contents($file);
        echo "<br/><br/><h3>查询结果：</h3>";
        echo $file . "</br></br>";

    }

    ?>
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