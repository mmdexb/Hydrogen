<?php
require_once "Net/Telnet.php";
//##全局变量
//管理员密码
$GLOBALS["admin_password"] = "";
//站点名称
$GLOBALS["websitename"] = " ";
//站点显示名
$GLOBALS["websitename_main"] = " ";
//站点介绍
$GLOBALS["websitename_des"] = " ";
//站点关键词
$GLOBALS["websitename_keyword"] = " ";
//版权信息
$GLOBALS["websitename_copy"] = " ";
//QQ加群链接
$GLOBALS["add_qqun"] = " ";
//管理员QQ
$GLOBALS["add_qq_admin"] = " ";
//管理员QQ
$GLOBALS["map_url"] = " ";
//FSD服务器
$GLOBALS["fsd_server"] = " ";
//FSD密码
$GLOBALS["fsd_password"] = " ";
//FSD显示名称
$GLOBALS["fsd_name"] = " ";
//FSD等级（无需修改）
$GLOBALS["fsd_level"] = array(
    '1' => 'OBSPILOT',
    '2' => 'Student1',
    '3' => 'Student2',
    '4' => 'Student3',
    '5' => 'Controller1',
    '6' => 'Controller2',
    '7' => 'Controller3',
    '8' => 'Instructor1',
    '9' => 'Instructor2',
    '10' => 'Instructor3',
    '11' => 'Supervisor',
    '12' => 'Administrator',
);
//飞行员等级（无需修改）
$GLOBALS["p_level"] = array(
    '1' => '飞行学员',
    '2' => '见习飞行员',
    '3' => '初级飞行员',
    '4' => '副机长',
    '5' => '机长',
    '6' => '五星教员',
);
//--------------------------------------------------------
//##数据库操作
//数据库连接信息
//数据库类型 //fly数据库
$GLOBALS["db_Type"] = "mysql";
//数据库地址
$GLOBALS["host"] = "localhost";
//数据库名
$GLOBALS["dbName"] = "fly";
//数据库用户名
$GLOBALS["userName"] = " ";
//数据库密码
$GLOBALS["password"] = " ";
//连接字符串
$GLOBALS["dsn"] = "" . $GLOBALS["db_Type"] . ":host=" . $GLOBALS["host"] . ";dbname=" . $GLOBALS["dbName"] . "";
//--------------------------------------------------------
//数据库类型 //track数据库
$GLOBALS["t_db_Type"] = "mysql";
//数据库地址
$GLOBALS["t_host"] = "localhost";
//数据库名
$GLOBALS["t_dbName"] = "track";
//数据库用户名
$GLOBALS["t_userName"] = "";
//数据库密码
$GLOBALS["t_password"] = " ";
//连接字符串
$GLOBALS["t_dsn"] = "" . $GLOBALS["t_db_Type"] . ":host=" . $GLOBALS["t_host"] . ";dbname=" . $GLOBALS["t_dbName"] . "";
//--------------------------------------------------------
//连接数据库函数
function pdo_connect_1()
{
    //设置编码
    $_opts_values = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => 2, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    //创建一个连接对象
    $pdo = @new PDO($GLOBALS["dsn"], $GLOBALS["userName"], $GLOBALS["password"], $_opts_values);
    //返回PDO连接信息
    return $pdo;
}
function pdo_connect()
{
    $dsn = $GLOBALS["dsn"];
    $userName = $GLOBALS["userName"];
    $password = $GLOBALS["password"];
    $_opts_values = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => 2, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $pdo = @new PDO($dsn, $userName, $password, $_opts_values); //创建一个连接对象
    return $pdo; //返回PDO连接信息

}
function db_connect()
{
    $dsn = $GLOBALS["dsn"];
    $userName = $GLOBALS["userName"];
    $password = $GLOBALS["password"];
    $_opts_values = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => 2, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $pdo = @new PDO($dsn, $userName, $password, $_opts_values); //创建一个连接对象
    return $pdo; //返回PDO连接信息

}
function db_connect_track()
{
    $dsn = $GLOBALS["t_dsn"];
    $userName = $GLOBALS["t_userName"];
    $password = $GLOBALS["t_password"];
    $_opts_values = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => 2, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $pdo = @new PDO($dsn, $userName, $password, $_opts_values); //创建一个连接对象
    return $pdo; //返回PDO连接信息

}
function db_connect_flight_track()
{

    $result = new mysqli($GLOBALS["t_host"], $GLOBALS["t_userName"], $GLOBALS["t_password"], $GLOBALS["t_dbName"]);

    if (!$result) {

        throw new Exception('不能连接到数据库！');
    } else {

        return $result;
    }
}
function db_connect_t()
{

    $result = new mysqli($GLOBALS["host"], $GLOBALS["userName"], $GLOBALS["password"], $GLOBALS["dbName"]);

    if (!$result) {

        throw new Exception('不能连接到数据库！');
    } else {

        return $result;
    }
}
//SQL输出查询信息
function sql_select_out($database, $array_t, $array_c)
{
    //database为表名（string）
    //array_t为搜索内容（array）
    //array_c为搜索条件（array）
    $t_column = pdo_get_condition($array_t);
    $t_name = pdo_get_column($array_t);
    $column = pdo_get_column($array_c);
    $condition = pdo_get_condition($array_c);
    $num_column = count($column);
    $sqlcondition = "";
    for ($i = 0; $i < $num_column; $i++) {
        if ($i == 0) {
            $sqlcondition .= "" . $column[$i] . "  ='" . $condition[$i] . "'";
        } else {
            $sqlcondition .= " and " . $column[$i] . "  ='" . $condition[$i] . "'";
        }
    }
    $num_t_column = count($t_column);
    $sqlselect = "";
    $tablename = "";
    for ($i = 0; $i < $num_t_column; $i++) {
        if ($i == 0) {
            $sqlselect .= $t_column[$i];
        } else {
            $sqlselect .= "," . $t_column[$i];
        }
        $tablename .= "<th>" . $t_name[$i] . "</th>";
    }
    $sql = "SELECT " . $sqlselect . " FROM `" . $database . "` where  " . $sqlcondition . " ";
    //echo $sql;
    pdo_connect()->exec('set names utf8');
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as $value) {
        $output = $value[$t_column[0]];
    }
    return $output;
    $res = null;
    $stmt = null;
}
//SQL输出查询信息
function sql_select_out_bb($database, $array_t, $array_c)
{
    //database为表名（string）
    //array_t为搜索内容（array）
    //array_c为搜索条件（array）
    $t_column = pdo_get_condition($array_t);
    $t_name = pdo_get_column($array_t);
    $column = pdo_get_column($array_c);
    $condition = pdo_get_condition($array_c);
    $num_column = count($column);
    $sqlcondition = "";
    for ($i = 0; $i < $num_column; $i++) {
        if ($i == 0) {
            $sqlcondition .= "" . $column[$i] . "  ='" . $condition[$i] . "'";
        } else {
            $sqlcondition .= " and " . $column[$i] . "  ='" . $condition[$i] . "'";
        }
    }
    $num_t_column = count($t_column);
    $sqlselect = "";
    $tablename = "";
    for ($i = 0; $i < $num_t_column; $i++) {
        if ($i == 0) {
            $sqlselect .= $t_column[$i];
        } else {
            $sqlselect .= "," . $t_column[$i];
        }
        $tablename .= "<th>" . $t_name[$i] . "</th>";
    }
    $sql = "SELECT " . $sqlselect . " FROM `" . $database . "` where  " . $sqlcondition . " ";
    //echo $sql;
    pdo_connect()->exec('set names utf8');
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as $value) {
        $output = $value[$t_column[0]];
    }
    return $output;
    $res = null;
    $stmt = null;
}
//pdo查询数据库$database有条件$condition，返回一个数组
function pdo_select($database, $condition)
{
    $column = pdo_get_column($condition);
    $condition = pdo_get_condition($condition);
    $num_column = count($column);
    $sqlcondition = "";
    for ($i = 0; $i < $num_column; $i++) {
        if ($i == 0) {
            $sqlcondition .= "" . $column[$i] . "  ='" . $condition[$i] . "'";
        } else {
            $sqlcondition .= " and " . $column[$i] . "  ='" . $condition[$i] . "'";
        }
    }
    $sql = "SELECT * FROM `" . $database . "` where  " . $sqlcondition . " ";
    //echo $sql;
    pdo_connect()->exec('set names utf8');
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $res;
    $res = null;
    $stmt = null;
}
//SQL查询返回表格-无条件
function pdo_search_table_nc($database, $array_t)
{
    $t_column = pdo_get_condition($array_t);
    $t_name = pdo_get_column($array_t);

    $num_t_column = count($t_column);
    $sqlselect = "";
    $tablename = "";
    for ($i = 0; $i < $num_t_column; $i++) {
        if ($i == 0) {
            $sqlselect .= $t_column[$i];
        } else {
            $sqlselect .= "," . $t_column[$i];
        }
        $tablename .= "<th>" . $t_name[$i] . "</th>";
    }
    $sql = "SELECT " . $sqlselect . " FROM `" . $database . "` ";
    pdo_connect()->exec('set names utf8');
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = "<table class='table' >" . "<thead>" . $tablename . "</thead><tbody>";
    foreach ($res as $value) {
        $output .= "<tr>";
        for ($i = 0; $i < $num_t_column; $i++) {
            $t = "";
            $t = $value[$t_column[$i]];
            $output .= "<td>{$t}</td>";
        }
        $output .= "</tr>";
    }
    $output .= "</tbody></table>";
    return $output;
    $stmt = null;
    $res = null;
}
//SQL查询返回表格-无条件
function pdo_search_table_nc_b($database, $array_t)
{
    $t_column = pdo_get_condition($array_t);
    $t_name = pdo_get_column($array_t);

    $num_t_column = count($t_column);
    $sqlselect = "";
    $tablename = "";
    for ($i = 0; $i < $num_t_column; $i++) {
        if ($i == 0) {
            $sqlselect .= $t_column[$i];
        } else {
            $sqlselect .= "," . $t_column[$i];
        }
        $tablename .= "<th>" . $t_name[$i] . "</th>";
    }
    $sql = "SELECT " . $sqlselect . " FROM `" . $database . "` ";
    pdo_connect()->exec('set names utf8');
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = "<table class='table' >" . "<thead>" . $tablename . "</thead><tbody>";
    foreach ($res as $value) {
        $output .= "<tr>";
        for ($i = 0; $i < $num_t_column; $i++) {
            $t = "";
            $t = $value[$t_column[$i]];
            $output .= "<td>{$t}</td>";
        }
        $output .= "<td><a href=\"./user_admin.php?bi=1&userbb={$value["user"]}\">管理</a></td>";
        $output .= "</tr>";
    }
    $output .= "</tbody></table>";
    return $output;
    $stmt = null;
    $res = null;
}
//SQL查询返回表格-无条件
function pdo_search_table_nc_b_user($database, $array_t)
{
    $t_column = pdo_get_condition($array_t);
    $t_name = pdo_get_column($array_t);

    $num_t_column = count($t_column);
    $sqlselect = "";
    $tablename = "";
    for ($i = 0; $i < $num_t_column; $i++) {
        if ($i == 0) {
            $sqlselect .= $t_column[$i];
        } else {
            $sqlselect .= "," . $t_column[$i];
        }
        $tablename .= "<th>" . $t_name[$i] . "</th>";
    }
    $sql = "SELECT " . $sqlselect . " FROM `" . $database . "` ";
    pdo_connect()->exec('set names utf8');
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = "<table class='table' >" . "<thead>" . $tablename . "</thead><tbody>";
    foreach ($res as $value) {
        $output .= "<tr>";
        for ($i = 0; $i < $num_t_column; $i++) {
            if ($i == 3) {

                $t = $value[$t_column[$i]];
                if ($t != '0') {
                    $output .= "<td>{$GLOBALS["fsd_level"][$t]}</td>";
                } else {
                    $output .= "<td>OBSPILOT</td>";
                }

            } elseif ($i == 5) {
                $t = $value[$t_column[$i]];
                if ($t == '2') {
                    $output .= "<td>是</td>";
                } else {
                    $output .= "<td>否</td>";
                }

            } elseif ($i == 6) {
                $t = $value[$t_column[$i]];
                if ($t == '1') {
                    $output .= "<td>是</td>";
                } else {
                    $output .= "<td>否</td>";
                }

            } else {
                $t = "";
                $t = $value[$t_column[$i]];
                $output .= "<td>{$t}</td>";}
        }
        $output .= "<td><a href=\"./user_admin.php?bi=1&userbb={$value["user"]}\">管理</a></td>";
        $output .= "</tr>";
    }
    $output .= "</tbody></table>";
    return $output;
    $stmt = null;
    $res = null;
}
//SQL查询返回表格-无条件
function pdo_search_table_nc_b_act($database, $array_t)
{
    $t_column = pdo_get_condition($array_t);
    $t_name = pdo_get_column($array_t);

    $num_t_column = count($t_column);
    $sqlselect = "";
    $tablename = "";
    for ($i = 0; $i < $num_t_column; $i++) {
        if ($i == 0) {
            $sqlselect .= $t_column[$i];
        } else {
            $sqlselect .= "," . $t_column[$i];
        }
        $tablename .= "<th>" . $t_name[$i] . "</th>";
    }
    $sql = "SELECT " . $sqlselect . " FROM `" . $database . "` ";
    pdo_connect()->exec('set names utf8');
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = "<table class='table' >" . "<thead>" . $tablename . "</thead><tbody>";
    foreach ($res as $value) {
        $output .= "<tr>";
        for ($i = 0; $i < $num_t_column; $i++) {
            $t = "";
            $t = $value[$t_column[$i]];
            $output .= "<td>{$t}</td>";
        }
        $output .= "<td><a href=\"./act_admin.php?bi=1&act={$value["aid"]}\">修改内容</a> | <a href=\"./act_admin.php?bi=2&act={$value["aid"]}\">修改时间</a>| <a href=\"./act_admin_detail.php?act={$value["aid"]}\" target=\"_blank\">报名表</a></td>";
        $output .= "</tr>";
    }
    $output .= "</tbody></table>";
    return $output;
    $stmt = null;
    $res = null;
}
function get_act()
{
    $sql = "SELECT * FROM `activities` where  status=1 ";
    pdo_connect()->exec('set names utf8');
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = "<table class='table' >" . "<thead><th>活动ID</th><th>活动名称</th><th>机场1</th><th>机场2</th><th>开始</th><th>结束</th><th>操作</th></thead><tbody>";
    foreach ($res as $value) {
        $array_u = array("user" => $_SESSION["user_website"], "aid" => $value["aid"]);
        if (sql_count_out('activities_bm', $array_u) > 0) {
            $output .= "<tr><td>{$value["aid"]}</td><td>{$value["name"]}</td><td>{$value["airport1"]}</td><td>{$value["airport2"]}</td><td>{$value["start_time"]}</td><td>{$value["end_time"]}</td><td>您已经报名</td></tr>";
        } else {
            if (time() < strtotime($value["start_time"])) {
                $output .= "<tr><td>{$value["aid"]}</td><td>{$value["name"]}</td><td>{$value["airport1"]}</td><td>{$value["airport2"]}</td><td>{$value["start_time"]}</td><td>{$value["end_time"]}</td><td><a class='btn btn-info' href='./reg_act.php?aid={$value["aid"]}'>报名</a></td></tr>";} else { $output .= "<tr><td>{$value["aid"]}</td><td>{$value["name"]}</td><td>{$value["airport1"]}</td><td>{$value["airport2"]}</td><td>{$value["start_time"]}</td><td>{$value["end_time"]}</td><td>报名已经截至</td></tr>";}
        }
    }

    $output .= "</tbody></table>";
    return $output;
    $res = null;
    $stmt = null;
}
//SQL查询返回表格-无条件
function pdo_search_select_nc($database, $array_t)
{
    $t_column = pdo_get_condition($array_t);
    $t_name = pdo_get_column($array_t);

    $num_t_column = count($t_column);
    $sqlselect = "";

    $sql = "SELECT * FROM `" . $database . "` ";
    //echo $sql;
    pdo_connect()->exec('set names utf8');
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $res;
    $stmt = null;
    $res = null;
}
//SQL查询返回表格-无条件
function pdo_search_select_nc_actb($database, $array_t)
{
    $t_column = pdo_get_condition($array_t);
    $t_name = pdo_get_column($array_t);

    $num_t_column = count($t_column);
    $sqlselect = "";

    $sql = "SELECT * FROM `" . $database . "` ";
    //echo $sql;
    pdo_connect()->exec('set names utf8');
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $res;
    $stmt = null;
    $res = null;
}
//SQL查询返回表格-有条件
function pdo_search_table($database, $array_t, $array_c)
{
    $t_column = pdo_get_condition($array_t);
    $t_name = pdo_get_column($array_t);
    $column = pdo_get_column($array_c);
    $condition = pdo_get_condition($array_c);
    $num_column = count($column);
    $sqlcondition = "";
    for ($i = 0; $i < $num_column; $i++) {
        if ($i == 0) {
            $sqlcondition .= $column[$i] . "  ='" . $condition[$i] . "'";
        } else {
            $sqlcondition .= " and " . $column[$i] . "  ='" . $condition[$i] . "'";
        }
    }
    $num_t_column = count($t_column);
    $sqlselect = "";
    $tablename = "";
    for ($i = 0; $i < $num_t_column; $i++) {
        if ($i == 0) {
            $sqlselect .= $t_column[$i];
        } else {
            $sqlselect .= "," . $t_column[$i];
        }
        $tablename .= "<th>" . $t_name[$i] . "</th>";
    }
    $sql = "SELECT " . $sqlselect . " FROM `" . $database . "` where  " . $sqlcondition . " ";
    pdo_connect()->exec('set names utf8');
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = "<table class='table' >" . "<thead>" . $tablename . "</thead><tbody>";
    foreach ($res as $value) {
        $output .= "<tr>";
        for ($i = 0; $i < $num_t_column; $i++) {
            $t = "";
            $t = $value[$t_column[$i]];
            $output .= "<td>{$t}</td>";
        }
        $output .= "</tr>";
    }
    $output .= "</tbody></table>";
    return $output;
    $res = null;
    $stmt = null;
}
function pdo_search_table_mod_atc($database, $array_t, $array_c)
{
    $t_column = pdo_get_condition($array_t);
    $t_name = pdo_get_column($array_t);
    $column = pdo_get_column($array_c);
    $condition = pdo_get_condition($array_c);
    $num_column = count($column);
    $sqlcondition = "";
    for ($i = 0; $i < $num_column; $i++) {
        if ($i == 0) {
            $sqlcondition .= $column[$i] . "  ='" . $condition[$i] . "'";
        } else {
            $sqlcondition .= " and " . $column[$i] . "  ='" . $condition[$i] . "'";
        }
    }
    $num_t_column = count($t_column);
    $sqlselect = "";
    $tablename = "";
    for ($i = 0; $i < $num_t_column; $i++) {
        if ($i == 0) {
            $sqlselect .= $t_column[$i];
        } else {
            $sqlselect .= "," . $t_column[$i];
        }
        $tablename .= "<th>" . $t_name[$i] . "</th>";
    }
    $sql = "SELECT " . $sqlselect . " FROM `" . $database . "` where  " . $sqlcondition . " and status!='删除' order by totime ";
    pdo_connect()->exec('set names utf8');
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = "<table class='table' >" . "<thead>" . $tablename . "</thead><tbody>";
    foreach ($res as $value) {
        $output .= "<tr>";
        for ($i = 0; $i < $num_t_column; $i++) {
            $t = "";
            $t = $value[$t_column[$i]];
            $output .= "<td>{$t}</td>";
        }
        $output .= "<td><a href='mob_plan_atc.php?id={$value['id']}&type=take'>接管</a> | <a href='mob_plan_atc.php?id={$value['id']}&type=or'>移交</a> | ";
        $output .= "<a href='mob_plan_atc.php?id={$value['id']}&type=del'>删除</a></td>";
        $output .= "</tr>";
    }
    $output .= "</tbody></table>";
    return $output;
    $res = null;
    $stmt = null;
}
function pdo_search_table_mod_c($database, $array_t, $array_c)
{
    $t_column = pdo_get_condition($array_t);
    $t_name = pdo_get_column($array_t);
    $column = pdo_get_column($array_c);
    $condition = pdo_get_condition($array_c);
    $num_column = count($column);
    $sqlcondition = "";
    for ($i = 0; $i < $num_column; $i++) {
        if ($i == 0) {
            $sqlcondition .= $column[$i] . "  ='" . $condition[$i] . "'";
        } else {
            $sqlcondition .= " and " . $column[$i] . "  ='" . $condition[$i] . "'";
        }
    }
    $num_t_column = count($t_column);
    $sqlselect = "";
    $tablename = "";
    for ($i = 0; $i < $num_t_column; $i++) {
        if ($i == 0) {
            $sqlselect .= $t_column[$i];
        } else {
            $sqlselect .= "," . $t_column[$i];
        }
        $tablename .= "<th>" . $t_name[$i] . "</th>";
    }
    $sql = "SELECT " . $sqlselect . " FROM `" . $database . "` where  " . $sqlcondition . " and status!='删除' order by totime ";
    pdo_connect()->exec('set names utf8');
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = "<table class='table' >" . "<thead>" . $tablename . "</thead><tbody>";
    foreach ($res as $value) {
        $output .= "<tr>";
        for ($i = 0; $i < $num_t_column; $i++) {
            $t = "";
            $t = $value[$t_column[$i]];
            $output .= "<td>{$t}</td>";
        }
        $output .= "</tr>";
    }
    $output .= "</tbody></table>";
    return $output;
    $res = null;
    $stmt = null;
}
function pdo_search_table_track($database, $array_t, $array_c, $kb)
{
    $t_column = pdo_get_condition($array_t);
    $t_name = pdo_get_column($array_t);
    $column = pdo_get_column($array_c);
    $condition = pdo_get_condition($array_c);
    $num_column = count($column);
    $sqlcondition = "";
    for ($i = 0; $i < $num_column; $i++) {
        if ($i == 0) {
            $sqlcondition .= $column[$i] . "  ='" . $condition[$i] . "'";
        } else {
            $sqlcondition .= " and " . $column[$i] . "  ='" . $condition[$i] . "'";
        }
    }
    $num_t_column = count($t_column);
    $sqlselect = "";
    $tablename = "";
    for ($i = 0; $i < $num_t_column; $i++) {
        if ($i == 0) {
            $sqlselect .= $t_column[$i];
        } else {
            $sqlselect .= "," . $t_column[$i];
        }
        $tablename .= "<th>" . $t_name[$i] . "</th>";
    }
    $sql = "SELECT " . $sqlselect . " FROM `" . $database . "` where  " . $sqlcondition . " $kb";
    pdo_connect()->exec('set names utf8');
    $stmt = db_connect_track()->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = "<table class='table' >" . "<thead>" . $tablename . "</thead><tbody>";
    foreach ($res as $value) {
        $output .= "<tr>";
        for ($i = 0; $i < $num_t_column; $i++) {
            $t = "";
            $t = $value[$t_column[$i]];
            $output .= "<td>{$t}</td>";
        }
        $output .= "</tr>";
    }
    $output .= "</tbody></table>";
    return $output;
    $res = null;
    $stmt = null;
}
//PDO
function pdo_updata($database, $array, $conditiong)
{
    $t_name = pdo_get_condition($array);
    $t_column = pdo_get_column($array);
    $column = pdo_get_column($conditiong);
    $condition = pdo_get_condition($conditiong);
    $num_column = count($column);
    $sqlcondition = "";
    for ($i = 0; $i < $num_column; $i++) {
        if ($i == 0) {
            $sqlcondition .= $column[$i] . "  ='" . $condition[$i] . "'";
        } else {
            $sqlcondition .= " and " . $column[$i] . "  ='" . $condition[$i] . "'";
        }
    }
    $num_t = count($t_column);
    $c = "";

    for ($i = 0; $i < $num_t; $i++) {
        if ($i == 0) {
            $c .= "`" . $t_column[$i] . "`=" . "'" . $t_name[$i] . "'";
        } else {
            $c .= ",`" . $t_column[$i] . "`" . "='" . $t_name[$i] . "'";
        }
    }
    $sql = "UPDATE `$database` SET " . $c . " WHERE " . $sqlcondition . ";
    ";
    //echo $sql;
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $stmt = null;
}
//PDO查询返回数组_有条件
function pdo_search_array($database, $array_t, $array_c)
{
    $t_column = pdo_get_condition($array_t);
    $t_name = pdo_get_column($array_t);
    $column = pdo_get_column($array_c);
    $condition = pdo_get_condition($array_c);
    $num_column = count($column);
    $sqlcondition = "";
    for ($i = 0; $i < $num_column; $i++) {
        if ($i == 0) {
            $sqlcondition .= $column[$i] . "  ='" . $condition[$i] . "'";
        } else {
            $sqlcondition .= " and " . $column[$i] . "  ='" . $condition[$i] . "'";
        }
    }
    $num_t_column = count($t_column);
    $sqlselect = "";
    $tablename = "";
    for ($i = 0; $i < $num_t_column; $i++) {
        if ($i == 0) {
            $sqlselect .= $t_column[$i];
        } else {
            $sqlselect .= "," . $t_column[$i];
        }
        $tablename .= "<th>" . $t_name[$i] . "</th>";
    }
    $sql = "SELECT " . $sqlselect . " FROM `" . $database . "` where  " . $sqlcondition . " ";
    pdo_connect()->exec('set names utf8');
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $res;
    $stmt = null;
    $res = null;
}
//PDO查询返回表格_有条件_带按钮
function pdo_search_table_b($database, $array_t, $array_c, $array_b)
{
    $t_column = pdo_get_condition($array_t);
    $t_name = pdo_get_column($array_t);
    $column = pdo_get_column($array_c);
    $condition = pdo_get_condition($array_c);
    $num_column = count($column);

    $button_name = pdo_get_column($array_b);
    $button_value = pdo_get_condition($array_b);
    $num_button = count($button_name);

    $sqlcondition = "";
    for ($i = 0; $i < $num_column; $i++) {
        if ($i == 0) {
            $sqlcondition .= $column[$i] . "  ='" . $condition[$i] . "'";
        } else {
            $sqlcondition .= " and " . $column[$i] . "  ='" . $condition[$i] . "'";
        }
    }
    $num_t_column = count($t_column);
    $sqlselect = "";
    $tablename = "";
    for ($i = 0; $i < $num_t_column; $i++) {
        if ($i == 0) {
            $sqlselect .= $t_column[$i];
        } else {
            $sqlselect .= "," . $t_column[$i];
        }
        $tablename .= "<th>" . $t_name[$i] . "</th>";
    }
    $sql = "SELECT " . $sqlselect . " FROM `" . $database . "` where  " . $sqlcondition . " ";
    pdo_connect()->exec('set names utf8');
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = "<table class='table' >" . "<thead>" . $tablename . "<th>操作</th></thead><tbody>";
    foreach ($res as $value) {
        $output .= "<tr>";
        for ($i = 0; $i < $num_t_column; $i++) {
            $t = "";
            $t = $value[$t_column[$i]];
            $output .= "<td>{$t}</td>";
        }
        $b = "";
        for ($i = 0; $i < $num_button; $i++) {

            $b = $b . "<a class='" . $button_value[$i][2] . "' href='./" . $button_value[$i][3] . "?" . $button_value[$i][1] . "=" . $value[$button_value[$i][0]] . "'>" . $button_name[$i] . "</a> ";
        }
        $output .= "<td>{$b}</td>";
        $output .= "</tr>";
    }

    $output .= "</tbody></table>";
    return $output;
    $res = null;
    $stmt = null;
}
//PDO删除指定条件的表
function pdo_delete_table($database, $array)
{
    $column = pdo_get_column($array);
    $condition = pdo_get_condition($array);
    $num_column = count($column);
    $sqlcondition = "";
    for ($i = 0; $i < $num_column; $i++) {
        if ($i == 0) {
            $sqlcondition .= $column[$i] . "  ='" . $condition[$i] . "'";
        } else {
            $sqlcondition .= " and " . $column[$i] . "  ='" . $condition[$i] . "'";
        }
    }
    $sql = "DELETE FROM `$database` WHERE " . $sqlcondition . ";
    ";
    //echo $sql;
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $stmt = null;
}
//SQL输出查询行数
function sql_count_out($database, $array_get)
{
    //database为表名（string）
    //array_get为搜索条件（array）
    $column = pdo_get_column($array_get);
    $condition = pdo_get_condition($array_get);
    $num = count($column);
    $sqlcondition = "";
    for ($i = 0; $i < $num; $i++) {

        if ($i == 0) {
            $sqlcondition .= $column[$i] . "  ='" . $condition[$i] . "'";
        } else {
            $sqlcondition .= " and " . $column[$i] . "  ='" . $condition[$i] . "'";
        }
    }
    $sql = "SELECT * FROM `" . $database . "` where  " . $sqlcondition . "";
    //echo $sql;
    pdo_connect()->exec('set names utf8');
    //echo $sql;
    $results = pdo_connect()->query($sql)->rowCount();
    return $results;
    $results = null;
}
//SQL导入内容
function sql_insert_in($database, $array)
{
    //database为表名（string）
    //array为注入内容（array）
    $t_name = pdo_get_condition($array);
    $t_column = pdo_get_column($array);
    $num_t = count($t_column);
    $c = "(";
    $v = "(";
    for ($i = 0; $i < $num_t; $i++) {
        if ($i == 0) {
            $c .= "`" . $t_column[$i] . "`";
            $v .= "'" . $t_name[$i] . "'";
        } elseif ($i == $num_t - 1) {
            $c .= ",`" . $t_column[$i] . "`)";
            $v .= ",'" . $t_name[$i] . "')";
        } else {
            $c .= ",`" . $t_column[$i] . "`";
            $v .= ",'" . $t_name[$i] . "'";
        }
    }
    $sql = "INSERT INTO `" . $database . "` " . $c . " VALUES " . $v . ";";
    //echo $sql;
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $stmt = null;
}
//SQL导入内容传统
function sql_insert_in_traditional($database, $a, $b)
{
    //database为表名（string）
    //a为列（string）
    //b为内容（string）
    $sql = "INSERT INTO `" . $database . "` " . $a . " VALUES " . $b . ";";
    //echo $sql;
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $stmt = null;
}
//SQL删除内容
function sql_delete_in($database, $array)
{
    //database为表名（string）
    //array为删除条件内容（array）
    $t_name = pdo_get_condition($array);
    $t_column = pdo_get_column($array);
    $num_t = count($t_column);
    $c = "(";
    $v = "(";
    $sqlcondition = "";
    for ($i = 0; $i < $num_t; $i++) {
        if ($i == 0) {
            $sqlcondition .= $t_column[$i] . "  ='" . $t_name[$i] . "'";
        } else {
            $sqlcondition .= " and " . $t_column[$i] . "  ='" . $t_name[$i] . "'";
        }
    }
    $sql = "DELETE  FROM  `" . $database . "` where {$sqlcondition};";
    //echo $sql;
    $stmt = pdo_connect()->prepare($sql);
    $stmt->execute();
    $stmt = null;
}
//SQL查询转换1
function pdo_get_column($arr)
{
    return array_keys($arr);
}
//SQL查询转换2
function pdo_get_condition($arr)
{
    $array_k = array_keys($arr);
    $num = count(array_keys($arr));
    $arr_new = [];
    for ($i = 0; $i < $num; $i++) {
        $arr_new[$i] = $arr[$array_k[$i]];
    }
    return $arr_new;
}

//--------------------------------------------------------
//##验证用户
//验证管理员
function valid_admin($user, $pwd)
{
    $array_get = array(
        'user' => $user,
        'pwd' => $pwd,
    );
    if (sql_count_out("admin", $array_get) > 0) {
        //成功登陆
        $_SESSION["user_admin"] = $user;
        return true;
    } else {
        //错误登陆
        return false;
    }
}
//验证用户
function valid_user($user, $pwd)
{
    $array_get = array(
        'user' => $user,
        'pwd' => $pwd,
        'active' => 1,
    );
    if (sql_count_out("user", $array_get) > 0) {
        //成功登陆
        $_SESSION["user_website"] = $user;
        return true;
    } else {
        //错误登陆
        return false;
    }
}
//未登陆提示
function login()
{
    if (isset($_SESSION["user_website"])) {
        return true;
    } else {
        return false;
    }
}
//用户注册
function reg($callsign, $password, $email, $qq, $yqm)
{
    //判断格式
    $callsign_len = strlen($callsign);
    //echo $callsign_len;

    $status = sql_count_out("yqm", ["yqm" => $yqm, "status" => "0"]);

    if ($status > 0) {

    } else {
        return "10"; //邀请码没有返回码
        exit;
    }
    if (!is_numeric($callsign)) {
        return "2"; //呼号不是数字返回码
        exit;
    }
    if ($callsign_len != 4) {
        return "3"; //长度错误返回码
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "4"; //无效电子邮箱返回码
        exit;
    }
    if (!is_numeric($qq)) {
        return "5"; //QQ不是数字返回码
        exit;
    }
    if (!preg_match('/(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,16}/', $password)) {
        return "6"; //密码强度不够返回码
        exit;
    }
    //判断是否重复
    //echo read_txt($callsign);
    if (read_txt($callsign) != -1) {
        return "7"; //呼号存在于CERT文件中
        exit;
    }
    $array_email = array(
        'email' => $email,
    );
    if (sql_count_out('user', $array_email)) {
        return "8"; //邮箱已经存在
        exit;
    }
    $array_qq = array(
        'qq' => $qq,
    );
    if (sql_count_out('user', $array_qq)) {
        return "9"; //QQ号已经存在
        exit;
    }
    $array_name = array(
        'user' => $callsign,
    );
    if (sql_count_out('user', $array_name)) {
        return "11"; //呼号已经存在
        exit;
    }
    $array_insert = array(
        'user' => $callsign,
        'pwd' => $password,
        'email' => $email,
        'qq' => $qq,
        'active' => 1,
        'is_atc' => 0,
        'level' => 1,
    );
    sql_insert_in("user", $array_insert);
    add_user($callsign, $password, 1);
    add_u($callsign, $password);
    qckh();
    $array_insert_p_l = array(
        'user' => $callsign,
        'pilot_level_id' => 1,
        'pilot_level' => $GLOBALS["p_level"][1],
    );
    sql_insert_in('pilot', $array_insert_p_l);

    pdo_updata("yqm", ["status" => '1'], ["yqm" => $yqm]);
    return "12";
}
//--------------------------------------------------------
//##文本操作
//计入LOG文件
function text_add_log()
{
}
//读用户名所在行数
function read_txt($userb)
{
    $file = fopen("./fsd/cert.txt", "r");
    $user = array();
    $i = 0;
    //输出文本中所有的行，直到文件结束为止。
    while (!feof($file)) {

        $user[$i] = fgets($file); //fgets()函数从文件指针中读取一行
        $str_arr = explode(" ", $user[$i]);
        if ($str_arr[0] == $userb) {
            return $i;
            //break;
            exit;
        }
        $i++;
    }
    fclose($file);
    return -1;
}
//删除txt指定行数
function del_txt($hs)
{

    $savestr = "";
    $num = $hs; //要删除的行序号
    $fp = file("./fsd/cert.txt");
    $total = count($fp); //取得文件总行数
    foreach ($fp as $line) {
        //按行分解内容并
        $tmp[] = $line; //逐行写入数组
    }
    for ($i = 0; $i < $total; $i++) { //若$i的值不等于要删除的行序号
        if ($i != $num) {
            $savestr .= $tmp[$i];
        }
    }
    //写入文件
    $fp = fopen("./fsd/cert.txt", "w");
    fwrite($fp, $savestr);
    fclose($fp);
}
//添加指定行数
function add_dj($h, $p, $level)
{

    //write to cert.txt
    $handle = fopen('./fsd/cert.txt', 'ab+');
    if ($handle) {
        $exits = false;
        while (($buffer = fgets($handle)) !== false) {
            $match = preg_match('/.*:(.*?)-/', $buffer, $array);
            //first write
            if (!$match) {
                break;
            }
            //exist in txt
            if ($match && $array[1] == $h) {
                $exits = true;
            }
        }
    } else {
        echo 'fail to open file';
    }
    if (!$exits) {
        fwrite($handle, "\n" . $h . ' ' . '' . $p . " " . $level . "\n");
    } else {
        echo 'user exist';
    }
    fclose($handle);
}
function add_u($h, $p)
{

    //write to cert.txt
    $handle = fopen('./fsd/cert.txt', 'ab+');
    if ($handle) {
        $exits = false;
        while (($buffer = fgets($handle)) !== false) {
            $match = preg_match('/.*:(.*?)-/', $buffer, $array);
            //first write
            if (!$match) {
                break;
            }
            //exist in txt
            if ($match && $array[1] == $h) {
                $exits = true;
            }
        }
    } else {
        echo 'fail to open file';
    }
    if (!$exits) {
        fwrite($handle, "\n" . $h . ' ' . '' . $p . " 1\n");
    } else {
        echo 'user exist';
    }
    fclose($handle);
}
//TXT整形
function qckh()
{
    $str = file_get_contents('./fsd/cert.txt');
    $str = explode(PHP_EOL, $str); //分割为数组，每行为一个数组元素
    //print_r($str);
    $str = array_filter($str); //去除数组中的空元素
    //print_r($str);
    $str = implode(PHP_EOL, $str); //用换行符连结数组为字符串
    //print_r($str);
    file_put_contents('./fsd/cert.txt', $str);
}
//--------------------------------------------------------
//##FSD通信
//FSD操作模板
function fsd($information)
{
    //require_once "Net/Telnet.php";
    $t = new Net_Telnet($GLOBALS["fsd_server"]);
    $t->connect();
    $t->page_prompt("\n --More-- ", " ");
    $t->cmd('-----------------------');
    $t->cmd('-----------------------');
    $t->cmd('-----------------------');
    $t->cmd('-----------------------');
    $t->cmd('pwd ' . $GLOBALS["fsd_password"]);
    $t->cmd($information);
    $t->disconnect();
    $m = $t->get_data();
    $m = str_replace("Syntax error.", "", $t->get_data());
    $m = str_replace("Password correct.", "", $m);
    $m = str_replace("XNATC Dynamic Server system interface ready.", "", $m);
    $m = str_replace("#", "", $m);
    $m = str_replace(", but the certificate file has not been updated. Please update this file if your change should be permanent. ", "", $m);
    $m = str_replace("FSD>", "", $m);
    $m = str_replace(":", "", $m);
    $m = str_replace(",", "", $m);
    $m = str_replace("Logs", "", $m);
    $m = str_replace("Emerg", "", $m);
    $m = str_replace("Alert", "", $m);
    $m = str_replace("Crit", "", $m);
    $m = str_replace("Err", "", $m);
    $m = str_replace("Warn", "", $m);
    $m = str_replace("Info", "", $m);
    $m = str_replace("Debug", "", $m);
    $m = str_replace("0", "", $m);
    $m = str_replace("1", "", $m);
    $m = str_replace("2", "", $m);
    $m = str_replace("3", "", $m);
    $m = str_replace("4", "", $m);
    $m = str_replace("5", "", $m);
    $m = str_replace("6", "", $m);
    $m = str_replace("7", "", $m);
    $m = str_replace("8", "", $m);
    $m = str_replace("9", "", $m);
    $m = str_replace("-", "", $m);
    $m = str_replace("pwd", "", $m);
    $m = str_replace($GLOBALS["fsd_password"], "", $m);
    $m = str_replace('show version', "", $m);
    $m = str_replace('traceroute github.com', "", $m);
    $m = str_replace("Type 'help' for help.", "", $m);
    $m = str_replace(PHP_EOL, '', $m);
    $m = str_replace("                 ", '', $m);
    $m = str_replace("" . $GLOBALS["fsd_name"] . ">", "\n " . $GLOBALS["fsd_name"] . ">", $m);
    return "服务器反馈:" . $m;
    //echo $m;
}
//增加呼号
function add_user($callsign, $password, $level_id)
{
    $id = (int) $level_id;
    $level = $GLOBALS["fsd_level"][$id];
    fsd("cert add " . $callsign . " " . $password . " OBSPILOT");
}
//增加呼号P
function add_user_p($callsign, $password, $level_id)
{
    //echo $level_id;
    $id = (int) $level_id;
    //echo $id;

    $level = $GLOBALS["fsd_level"][$id];
    //echo $level;
    fsd("cert add " . $callsign . " " . $password . " " . $level . "");
    //echo "cert add " . $callsign . " " . $password . " " . $level . "";
}
//删除呼号
function delete_user($callsign)
{
    fsd("cert delete " . $callsign . "");
}
//修改呼号等级
function edit_user_level($callsign, $level_id)
{

    fsd("cert modify " . $callsign . " " . $level_id . "");
}
//修改呼号密码
function edit_user_pwd($callsign, $password, $level_id)
{
    delete_user($callsign);
    add_user_p($callsign, $password, $level_id);
}

//##随机派号
//随机字符函数
function getRandomStr($len, $special = true)
{
    $chars = array(
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
        "3", "4", "5", "6", "7", "8", "9",
    );

    if ($special) {
        $chars = array_merge($chars, array(
            "!", "@", "#", "$", "?", "|", "{", "/", ":", ";",
            "%", "^", "&", "*", "(", ")", "-", "_", "[", "]",
            "}", "<", ">", "~", "+", "=", ",", ".",
        ));
    }

    $charsLen = count($chars) - 1;
    shuffle($chars); //打乱数组顺序
    $str = '';
    for ($i = 0; $i < $len; $i++) {
        $str .= $chars[mt_rand(0, $charsLen)]; //随机取出一位
    }
    return $str;
}
//分配飞行员呼号
function give_pilot()
{
    $callsign = "99" . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
}
//分配管制员账户
function give_atc()
{
    $callsign = "88" . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
}
//分配SUP账户
function give_sup()
{
    $callsign = "77" . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
}
//验证是否为管理员账户
function is_admin()
{
    $array_get = array(
        'user' => $_SESSION["user_website"],
        'level' => 2,

    );
    if (sql_count_out("user", $array_get) > 0) {
        return true;
    } else {
        return false;
    }
}
//用script方法跳转到$url
function jump($urls)
{
    echo "<script>window.location.href='" . $urls . "'</script>";
}
//获取用户QQ的函数
function get_qq_b()
{
    $array_conditon = array(
        'user' => $_SESSION["user_website"],
    );
    $array_get = array(
        'qq' => "qq",
    );
    echo sql_select_out("user", $array_get, $array_conditon);
}
//获取uid
function get_uid()
{
    $array_conditon = array(
        'user' => $_SESSION["user_website"],
    );
    $array_get = array(
        'id' => "id",
    );
    echo sql_select_out("user", $array_get, $array_conditon);
}
//获取邮箱
function get_email()
{
    $array_conditon = array(
        'user' => $_SESSION["user_website"],
    );
    $array_get = array(
        'email' => "email",
    );
    echo sql_select_out("user", $array_get, $array_conditon);
}
function get_f_track($huhao)
{

    $conn = db_connect_flight_track();
    if (!$conn) {
        die('Could not connect: ' . mysqli_error($conn));
    }

    mysqli_query($conn, "set names utf8");

    $sql = "SELECT flight FROM flight_route where callsign = '" . $huhao . "'  group by flight";

    mysqli_select_db($conn, 'flight_route');
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('无法读取数据: ' . mysqli_error($conn));
    }

    echo '<table class="table" id="datatable-default"> <thead><tr><td>航班号</td><td>起始</td><td>终止</td><td>飞行轨迹</td></tr> </thead><tbody>';
    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
        if (strlen($row['flight']) >= 10) {
            $rtime = substr($row['flight'], 0, 10);
            $c = substr($row['flight'], 10);
            $rtime = date('Y-m-d H:i:s', $rtime);
            $sqlc = "SELECT * FROM flight_route where flight = '" . $row['flight'] . "'  LIMIT 1";
            $retvalc = mysqli_query($conn, $sqlc);
            while ($rowc = mysqli_fetch_array($retvalc, MYSQLI_ASSOC)) {
                $start_time = $rowc["data"];
            }
            echo " <tr> " . "<td>" . $c . " </td><td>" . $start_time . "</td><td>" . $rtime . "</td> " . "<td><a href='./ftrack_d.php?fid={$row['flight']}'> {$row['flight']}</a></td> </tr> ";
        } else {
            echo " <tr> <td>" . $c . " </td>" . "<td>-</td><td>-</td> " . "<td><a href='./ftrack_d.php?fid={$row['flight']}'>当前：{$row['flight']}</a></td> </tr> ";
        }
    }
    echo '<tbody></table>';
    mysqli_close($conn);
}
function get_f_track_d($id)
{
    $conn = db_connect_flight_track();
    if (!$conn) {
        die('Could not connect: ' . mysqli_error($conn));
    }

    mysqli_query($conn, "set names utf8");

    $sql = "SELECT * FROM flight_route where flight = '" . $id . "'  order by id desc";

    mysqli_select_db($conn, 'flight_route');
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('无法读取数据: ' . mysqli_error($conn));
    }

    echo '<table class="table" id="datatable-default"> <thead><tr><td>时间</td><td>经度</td><td>纬度</td><td>高度</td><td>地速</td><td>航向</td><td>出发到达</td></tr> </thead><tbody>';
    $n = 0;
    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {

        $n += 1;
        if ($n % 3 == 0) {
            echo " <tr><td> {$row['data']}</td> " . "<td>{$row['lng']}</td> " . "<td>{$row['lat']} </td> <td>{$row['flightid']} </td><td>{$row['speed']} </td><td>{$row['heading']} </td><td>{$row['dep']}-{$row['arr']} </td></tr> ";
        }
    }
    echo '<tbody></table>';
    mysqli_close($conn);
}
//查询用户等级的函数
function get_level()
{

    $array_conditon = array(
        'user' => $_SESSION["user_website"],
    );
    $array_get = array(
        'is_atc' => "is_atc",
    );
    return sql_select_out("user", $array_get, $array_conditon);
}
function get_user_p_time()
{
    $conn = db_connect_t();

    mysqli_set_charset($conn, 'utf8');
    if ($conn) {
        $sql = 'select * from user_time_pm;'; // SQL 语句
        $result = mysqli_query($conn, $sql); // 执行 SQL 语句，并返回结果

        $b = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $b[] = $row["time_all"];
        }

        $b = implode(',', $b);
        $b = "[" . $b . "]";
        return $b;
    } else {
        return '数据库连接失败！';
    }
    mysqli_close($conn);
}
function get_user_p_huhao()
{
    $conn = db_connect_t();

    mysqli_set_charset($conn, 'utf8');
    if ($conn) {
        $sql = 'select * from user_time_pm;'; // SQL 语句
        $result = mysqli_query($conn, $sql); // 执行 SQL 语句，并返回结果

        $b = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $b[] = '"' . $row["user"] . '"';
        }

        $b = implode(',', $b);
        $b = "[" . $b . "]";
        return $b;
    } else {
        return '数据库连接失败！';
    }
    mysqli_close($conn);
}