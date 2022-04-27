<?php
session_start();
if ( !$_SESSION['logged'] ) {
	echo "<script>alert('System Standard Level Safety Inspection / 系统标准级安全检测\u000d\u000dYou must login first ! / 请先登录 !');</script>";
	echo "
        <script>
             setTimeout(function(){window.location.href='/apps/vms/account/login/index.html?type=al&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2main%2Findex.php?token=FoqXwKt0T59jDXrP';},100);
        </script>";
        exit;
}

$iuid = $_GET['uid'];
$_SESSION['imguid']=$iuid;
header("Location:/apps/vms/plugin/iu_module/upload.php?type=al&ref=uidrd&token=FoqXwKt0T59jDXrP");exit;
?>