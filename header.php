<?php
//php防注入和XSS攻击通用过滤
$_GET && SafeFilter($_GET);
$_POST && SafeFilter($_POST);
$_COOKIE && SafeFilter($_COOKIE);

function SafeFilter(&$arr)
{
    $ra = array(
        '/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '/script/', '/javascript/', '/vbscript/', '/expression/', '/applet/', '/meta/', '/xml/', '/blink/', '/link/', '/style/', '/embed/', '/object/', '/frame/', '/layer/', '/title/', '/bgsound/', '/base/', '/onload/', '/onunload/', '/onchange/', '/onsubmit/', '/onreset/', '/onselect/', '/onblur/', '/onfocus/',
        '/onabort/', '/onkeydown/', '/onkeypress/', '/onkeyup/', '/onclick/', '/ondblclick/', '/onmousedown/', '/onmousemove/', '/onmouseout/', '/onmouseover/', '/onmouseup/', '/onunload/',
    );

    if (is_array($arr)) {
        foreach ($arr as $key => $value) {
            if (!is_array($value)) {
                /*if (!get_magic_quotes_gpc())  //不对magic_quotes_gpc转义过的字符使用addslashes(),避免双重转义。
                {
                $value  = addslashes($value); //给单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符）
                #加上反斜线转义
                }*/
                $value = preg_replace($ra, '', $value); //删除非打印字符，粗暴式过滤xss可疑字符串
                $arr[$key] = htmlentities(strip_tags($value)); //去除 HTML 和 PHP 标记并转换为 HTML 实体
            } else {
                SafeFilter($arr[$key]);
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $GLOBALS["websitename_des"]; ?>">
    <meta name="keywords" content="<?php echo $GLOBALS["websitename_keyword"]; ?>">
    <meta name="author" content="Yushi">
    <!-- Title -->
    <title><?php echo $GLOBALS["websitename"]; ?></title>
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/plugins/icomoon/style.css" rel="stylesheet">
    <link href="assets/plugins/uniform/css/default.css" rel="stylesheet" />
    <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
    <link href="assets/plugins/nvd3/nv.d3.min.css" rel="stylesheet">
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
        <!-- Page Sidebar -->
        <div class="page-sidebar">
            <a class="logo-box" href="index.php">
                <span><?php echo $GLOBALS["websitename_main"]; ?></span>
                <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
                <i class="icon-close" id="sidebar-toggle-button-close"></i>
            </a>
            <div class="page-sidebar-inner">
                <div class="page-sidebar-menu">
                    <ul class="accordion-menu">
                        <li id="dashbord">
                            <a href="index.php">
                                <i class="menu-icon icon-home4"></i><span>控制台</span>
                            </a>
                        </li>
                        <?php if (login()) {?>
                        <li id="profile">
                            <a href="profile.php">
                                <i class="menu-icon icon-inbox"></i><span>个人信息</span>
                            </a>
                        </li>
                        <li id="myact">
                            <a href="my_activities.php">
                                <i class="menu-icon icon-flash_on"></i><span>我的活动</span>
                            </a>

                        </li>
                        <li id="mob">
                            <a href="mob_plan.php">
                                <i class="menu-icon icon-format_list_bulleted"></i><span>手游综合</span>
                            </a>

                        </li>
                        <?php } else {?>

                        <li>
                            <a href="login.php">
                                <i class="menu-icon icon-layers"></i><span>登陆注册</span>
                            </a>
                        </li>


                        <?php }?>
                        <li id="map">
                            <a href="map.php">
                                <i class="menu-icon icon-my_location"></i><span>连飞地图</span>
                            </a>

                        </li>
                        <li id="time">
                            <a href="time.php">
                                <i class="menu-icon icon-show_chart"></i><span>时长排名</span>
                            </a>

                        </li>
                        <?php
$array_get = array(
    'user' => $_SESSION["user_website"],
    'level' => 2,

);
if (sql_count_out("user", $array_get) > 0) {

    ?>

                        <li id="admin_user">
                            <a href="user_admin.php">
                                <i class="menu-icon icon-code"></i><span>用户管理</span>
                            </a>
                        </li>
                        <li id="admin_act">
                            <a href="act_admin.php">
                                <i class="menu-icon icon-code"></i><span>活动管理</span>
                            </a>
                        </li>
                        <li id="admin_yqm">
                            <a href="yqm_admin.php">
                                <i class="menu-icon icon-code"></i><span>邀请码管理</span>
                            </a>
                        </li>
                        <li id="admin_atc">
                            <a href="atc_admin.php">
                                <i class="menu-icon icon-code"></i><span>管局公示信息</span>
                            </a>
                        </li>
                        <?php
}
?>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon icon-star"></i><span>关于我们</span><i
                                    class="accordion-icon fa fa-angle-left"></i>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo $GLOBALS["add_qqun"]; ?>">加入QQ群</a></li>
                                <li><a href="<?php echo $GLOBALS["add_qq_admin"]; ?>">联系管理员</a></li>
                            </ul>
                        </li>
                        <li class="menu-divider"></li>
                        <li id="soft">
                            <a href="software.php">
                                <i class="menu-icon icon-help_outline"></i><span>连飞软件</span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <i class="menu-icon icon-public"></i><span>CHB联飞系统</span><span
                                    class="label label-danger">0.2</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- /Page Sidebar -->
        <div class="page-content">
            <div class="page-header">
                <div class="search-form">
                    <form action="#" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control search-input" placeholder="我是个无用的搜索框">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="close-search" type="button"><i
                                        class="icon-close"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <div class="logo-sm">
                                <a href="javascript:void(0)" id="sidebar-toggle-button"><i class="fa fa-bars"></i></a>
                                <a class="logo-box"
                                    href="./index.php"><span><?php echo $GLOBALS["websitename_main"]; ?></span></a>
                            </div>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <i class="fa fa-angle-down"></i>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="javascript:void(0)" id="collapsed-sidebar-toggle-button"><i
                                            class="fa fa-bars"></i></a></li>
                                <li><a href="javascript:void(0)" id="toggle-fullscreen"><i class="fa fa-expand"></i></a>
                                </li>
                                <li><a href="javascript:void(0)" id="search-button"><i class="fa fa-search"></i></a>
                                </li>
                            </ul>
                            <?php if (isset($_SESSION["user_website"])) {?>
                            <ul class="nav navbar-nav navbar-right">
                                <?php

    function get_qq()
    {
        $array_conditon = array(
            'user' => $_SESSION["user_website"],
        );
        $array_get = array(
            'qq' => "qq",
        );
        echo sql_select_out("user", $array_get, $array_conditon);
    }
    ?>
                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false"><img
                                            src="http://q2.qlogo.cn/headimg_dl?dst_uin=<?php echo get_qq(); ?>&spec=100"
                                            alt="" class="img-circle"></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="./profile.php">个人信息</a></li>
                                        <li><a href="./my_activities.php">活动中心</a></li>

                                        <li><a href="./logout.php">退出</a></li>
                                    </ul>
                                </li>
                            </ul><?php }?>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div><!-- /Page Header -->