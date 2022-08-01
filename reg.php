<!DOCTYPE html>
<html lang="en">
<?php

require "function.php";
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

                        <?php
if (is_array($_GET) && count($_GET) > 0) {
    if (isset($_GET["type"])) {
        if ($_GET["type"] == 'reg') {
            if ($_POST["yzc"] == $_SESSION["yx_yzm"]) {
                if ($_POST["password"] == $_POST["password1"]) {
                    $a = reg($_POST["username"], $_POST["password"], $_POST["email"], $_POST["qq"], $_POST["yqm"]);
                    if ($a == "2") {
                        echo '<div class="alert alert-warning" role="alert">
                                        呼号不是数字！请重新输入
                                    </div>';
                    }
                    if ($a == "3") {
                        echo '<div class="alert alert-warning" role="alert">
                                        呼号长度错误！请重新输入
                                    </div>';
                    }
                    if ($a == "4") {
                        echo '<div class="alert alert-warning" role="alert">
                                        无效的电子邮箱！请重新输入
                                    </div>';
                    }
                    if ($a == "5") {
                        echo '<div class="alert alert-warning" role="alert">
                                        QQ格式错误！请重新输入
                                    </div>';
                    }
                    if ($a == "6") {
                        echo '<div class="alert alert-warning" role="alert">
                                        密码强度不够！请重新输入
                                    </div>';
                    }
                    if ($a == "7") {
                        echo '<div class="alert alert-warning" role="alert">
                                        呼号已经存在于系统中！请重新输入[代码1]
                                    </div>';
                    }
                    if ($a == "8") {
                        echo '<div class="alert alert-warning" role="alert">
                                        邮箱已经存在于系统中！请重新输入
                                    </div>';
                    }
                    if ($a == "9") {
                        echo '<div class="alert alert-warning" role="alert">
                                        QQ已经存在于系统中！请重新输入
                                    </div>';
                    }
                    if ($a == "11") {
                        echo '<div class="alert alert-success" role="alert">
                                            呼号已经存在于系统中！请重新输入[代码2]
                                    </div>';
                    }
                    if ($a == "10") {
                        echo '<div class="alert alert-warning" role="alert">
                                        无效邀请码
                                    </div>';
                    }
                    if ($a == "12") {
                        echo '<div class="alert alert-success" role="alert">
                                        成功注册！呼号已经自动开通！<a href="./login.php">登陆</a>
                                    </div>';
                    }
                } else {
                    echo '<div class="alert alert-warning" role="alert">
                                        两次密码不一致！请重新输入
                                    </div>';
                }
            } else {
                echo '<div class="alert alert-warning" role="alert">
               验证码错误
            </div>';
            }
        }
    }
} else {

    ?>
                        <h4 class="login-title">注册</h4>
                        <?php
}

?>
                        <form method="POST" action="./reg.php?type=reg">
                            <div class="form-group">

                                <input type="text" class="form-control" id="yqm" name="yqm" placeholder="请输入您的邀请码">
                            </div>
                            <div class="form-group">

                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="请输入您的四位呼号">
                            </div>
                            <div class="form-group">

                                <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                                    placeholder="请输入您的密码">
                            </div>
                            <div class="form-group">

                                <input type="password" class="form-control" id="exampleInputPassword2" name="password1"
                                    placeholder="请重复您的密码">
                            </div>
                            <div class="form-group">

                                <input type="email" class="form-control" id="email" name="email" placeholder="请输入您的邮箱">
                            </div>
                            <div class="form-group">

                                <input type="text" class="form-control" id="qq" name="qq" placeholder="请输入您的QQ">
                            </div>
                            <div class="form-group">

                                <input type="text" id="yzc" name="yzc" class="form-control" placeholder="请输入验证码">
                                <a
                                    onclick="document.getElementById('captcha_img').src='./captcha.php?r='+Math.random()">
                                    <img id="captcha_img" border='1' src='./captcha.php?r=<?php echo rand(); ?>'
                                        style="width:100px; height:30px" /></a>
                            </div>
                            <br />
                            <button type="submit" class="btn btn-primary">注册</button>
                            <a href="login.php" class="btn btn-default">登陆</a><br>

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