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
if($_SESSION['suadmin'] == 'no'){
  echo "<script>alert('ILLEGAL OPERATION DETECTED / 非法操作警告\u000d\u000dWARNING! HIGH RISK OPERATION DETECTED, STOP YOUR BEHAVIOR（Operate Recorded） / 警告！你正在进行危险操作！请立刻停止行为（行为已被记录）');</script>";
  echo "
        <script>
             setTimeout(function(){window.location.href='/apps/vms/main/index.php?type=warning_high_risk&ref=acp_rejection';},100);
        </script>";
        exit;
    }
?>
<HEAD>
<TITLE>系统提示 - System Information</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
<!--
body,input{font-size:12px;margin:0;	padding:0;font-family:verdana,Arial, Helvetica, sans-serif;	color:#000}
body{text-align:center; margin:0 auto}
.title{background-color:#E33F35;font-weight:bold;color:#fff;padding:6px 10px 8px 7px;}
.errMainArea{width:546px; margin:80px auto 0 auto;text-align:left; border:1px solid #aaa}	
	.errTxtArea{ padding:30px 34px 0 110px;}
		.errTxtArea .txt_title{	font-size:150%;	font-weight:bolder;	font-family:"Microsoft JhengHei","微軟正黑體","Microsoft YaHei","微软雅黑";}	
	.errBtmArea{ padding:10px 8px 25px 8px ;background-color:#fff;text-align:center; }
.btnFn1 {cursor:pointer!important;cursor:hand;  height:30px; width:101px; padding:3px 5px 0 0; font-weight:bold; }

-->
</style>
</HEAD>
  <script>
     setTimeout(function(){window.location.href='/apps/vms/main/admin/index.php?ref=admin_accountcenter_disable&token=FoqXwKt0T59jDXrP';},3000);
  </script>
<div class="errMainArea" >
	<div class="title" >系统提示 - System Information</div>
	<div class="errTxtArea">
    <p class="txt_title">VMS 系统功能启用成功，正在返回控制中心...</br><marquee direction=left scrolldelay=1>Account prohibiting succeessed, redirecting...</marquee></p></div><div class="errBtmArea">
    <input type="button" class="btnFn1" value="Go now..." onclick="window.location.href='/apps/vms/main/admin/index.php?ref=admin_accountcenter_disable&token=FoqXwKt0T59jDXrP'" />
  </div>

</div>

</body>
</html>