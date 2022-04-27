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
	
// 处理编辑操作的页面 
require "dbconfig.php";
// 连接mysql
$link = @mysql_connect(HOST,USER,PASS) or die("提示：数据库连接失败！");
// 选择数据库
mysql_select_db(DBNAME,$link);
// 编码设置
mysql_set_charset('utf8',$link);
// 更新数据
mysql_query("UPDATE system SET status='on' WHERE item='regstatus'",$link) or die('VMS - 主警告 : 功能启动失败！错误详情：'.mysql_error()); 
header("Location:succeed-start.php");
?>