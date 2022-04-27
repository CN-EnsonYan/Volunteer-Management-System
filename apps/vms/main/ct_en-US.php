<?php
include('conn.php');//链接数据库
session_start();
$name=$_SESSION['entry_name'];
$rssysstat = mysql_query("select status from system where item='opstatus'");
//echo "查询信息如下：";
while($row = mysql_fetch_array($rssysstat))

               //系统主进程可用性辨别开始
               if($row['status'] == 'running'){
 
              }else {
				  if ($name == 'EnsonYan') {} else {
				  session_unset();
				  session_destroy();
                  mysql_close();//关闭数据库
echo "<script>
        setTimeout(function(){window.location.href='/apps/vms/system-unavailable.html?type=st&dt=rej&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Faccount%2Flogin%2Fauth.php&token=FoqXwKt0T59jDXrP';},100);
     </script>";
        exit;
				  }
			  }
ini_set('session.cookie_domain', '.ensonyan.com');
if ( !$_SESSION['logged'] ) {
    header("Location:/apps/vms/account/login/index.html?type=al&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Fapps%2Fvms%2Flanguages&token=FoqXwKt0T59jDXrP");exit;
}
?>
<html>
<script type="text/javascript">
document.cookie = "userLang = en; domain=.ensonyan.com; path=/";
window.location.href='/apps/vms/main/index.php?type=cls&st=success&ol=zh-CN&token=FoqXwKt0T59jDXrP';
</script>
</html>