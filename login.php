<!DOCTYPE html>
<html lang="en">
<?php

require("function.php");
session_start();
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $GLOBALS["websitename_des"]; ?>">
    <meta name="keywords" content="<?php echo $GLOBALS["websitename_keyword"]; ?>">
    <meta name="author" content="Yushi">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title><?php echo $GLOBALS["websitename"]; ?></title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/plugins/icomoon/style.css" rel="stylesheet">
    <link href="assets/plugins/uniform/css/default.css" rel="stylesheet" />
    <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

    <!-- Theme Styles -->
    <link href="assets/css/ecaps.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>

    <!-- Page Container -->
    <div class="page-container">
        <!-- Page Inner -->
        <div class="page-inner login-page">
            <div id="main-wrapper" class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 col-md-3 login-box">
                        <h4 class="login-title">登陆</h4>
                        <?php
                        if (is_array($_GET) && count($_GET) > 0) {
                            if (isset($_GET["type"])) {
                                if ($_GET["type"] == 'login') {
                                    if (valid_user($_POST["username"], $_POST["password"])) {
                                        echo '<div class="alert alert-success" role="alert">
                                                成功登陆！请等待跳转
                                            </div>';
                                        echo " <script language = 'javascript' type = 'text/javascript'> ";
                                        echo " window.location.href = './index.php' ";
                                        echo " </script> ";
                                    } else {
                                        echo '<div class="alert alert-warning" role="alert">
                                                登陆失败！请重新登陆
                                            </div>';
                                    }
                                }
                            }
                        }

                        ?>
                        <form method="POST" action="./login.php?type=login">
                            <div class="form-group">
                                <label for="username">呼号</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="请输入您的四位呼号">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">密码</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="请输入您的密码">
                            </div><br />
                            <button type="submit" class="btn btn-primary">登陆</button>
                            <a href="reg.php" class="btn btn-default">注册</a><br>

                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /Page Content -->
    </div><!-- /Page Container -->


    <!-- Javascripts -->
    <script src="assets/plugins/jquery/jquery-3.1.0.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/uniform/js/jquery.uniform.standalone.js"></script>
    <script src="assets/plugins/switchery/switchery.min.js"></script>
    <script src="assets/js/ecaps.min.js"></script>
</body>

</html>