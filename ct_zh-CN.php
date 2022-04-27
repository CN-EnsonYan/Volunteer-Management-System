<?php

$final_url_raw = $_SERVER["HTTP_REFERER"];
$final_url = urlencode($final_url_raw); # GET参数 最终回到的URL
echo "<script type=\"text/javascript\">window.location.href=\"https://passport.ensonyan.com/encom_main/encas/public_actions/ct_zh-CN.php?src=$final_url&lang_chg_traceid=1\";</script>";
?>