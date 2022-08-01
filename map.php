<?php
require("function.php");
session_start();
require("header.php");
?>

<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">地图</h3>
    </div>
    <div id="main-wrapper">


        <iframe frameborder="0" width="100%" scrolling="no" height="1000" src="<?php echo $GLOBALS["map_url"]; ?>"></iframe>





    </div><!-- Main Wrapper -->
    <div class="page-footer">
        <p><?php echo $GLOBALS['websitename_copy']; ?></p>
    </div>
</div><!-- /Page Inner -->
<?php
require("footer.php");
?>
<script>
    map.classList.add("active-page");
</script>