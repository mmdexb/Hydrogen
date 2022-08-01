<?php
require("function.php");
session_start();
require("header.php");
?>

<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">退出登陆</h3>
    </div>
    <div id="main-wrapper">
        <?php
        if (isset($_SESSION["user_website"])) {
            $old_user = $_SESSION['valid_user'];

            //注销会话
            unset($_SESSION['valid_user']);
            $result_dest = session_destroy();


            echo ' ';
            echo "<h3>提示：<code>您已经退出登陆</code></h3><br/>";
            echo "<a href='./index'  class='btn waves-effect waves-light btn-warning ' style='width: 100%;'>进入首页</a>";
        } ?>
    </div><!-- Main Wrapper -->
    <div class="page-footer">
        <p><?php echo $GLOBALS['websitename_copy']; ?></p>
    </div>
</div><!-- /Page Inner -->
<?php
require("footer.php");
?>
<script>
    profile.classList.add("active-page");
</script>