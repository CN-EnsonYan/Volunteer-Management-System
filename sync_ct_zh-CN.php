<?php
$enc_web_id=$_GET['enc_web_id'];

if ($enc_web_id == 'encom_main'){
    $go_to_url="www.ensonyan.com";
} else if ($enc_web_id == 'yyc_hk_cn'){
    $go_to_url="www.yyc.hk";
} else {
    //重定向浏览器 
header("Location: https://www.ensonyan.com"); 
//确保重定向后，后续代码不会被执行 
exit;
}


echo "<html>
<script type=\"text/javascript\">
document.cookie = \"userLang = cn; domain=.ensonyan.com; path=/\";
//返回上一页 window.location.href=document.referrer;
window.location.href=\"https://$go_to_url\";
</script>
</html>"
?>