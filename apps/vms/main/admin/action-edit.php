<?php
// 本文件作用为：管理后台审核编辑学时功能实现
session_start();
if ( !$_SESSION['logged'] ) {
		//未登录日志记录
	//操作时间
date_timezone_set('PRC');
$illoptime=date('Y-m-d H:i:s', time());
//生成随机事件 EventID
function generateRandomString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
  $randomString = ''; 
  for ($i = 0; $i < $length; $i++) { 
    $randomString .= $characters[rand(0, strlen($characters) - 1)]; 
  } 
  return $randomString; 
}
$eventID=generateRandomString(20);
//获取客户端真实 IP
function getIp()
{
    if ($_SERVER["HTTP_CLIENT_IP"] && strcasecmp($_SERVER["HTTP_CLIENT_IP"], "unknown")) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } else {
        if ($_SERVER["HTTP_X_FORWARDED_FOR"] && strcasecmp($_SERVER["HTTP_X_FORWARDED_FOR"], "unknown")) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            if ($_SERVER["REMOTE_ADDR"] && strcasecmp($_SERVER["REMOTE_ADDR"], "unknown")) {
                $ip = $_SERVER["REMOTE_ADDR"];
            } else {
                if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'],
                        "unknown")
                ) {
                    $ip = $_SERVER['REMOTE_ADDR'];
                } else {
                    $ip = "unknown";
                }
            }
        }
    }
    return ($ip);
}
$ip=getIp();
//当前访问的 URL
$illeurl='https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
require "dbconfig.php";
// 连接mysql
$link = @mysql_connect(HOST,USER,PASS) or die("提示：数据库连接失败！");
// 选择数据库
mysql_select_db(DBNAME,$link);
// 编码设置
mysql_set_charset('utf8',$link);
// 更新数据
mysql_query("INSERT into illegaloperation(module,optype,timestamp,ip,visiturl,eventID) values('vms','non_login_visit','$illoptime',\"$ip\",\"$illeurl\",\"$eventID\")",$link)or die('修改数据出错：'.mysql_error()); 
mysql_close();//关闭数据库
//记录成功并开始警告
	echo "<script>alert('System Standard Level Safety Inspection / 系统标准级安全检测\u000d\u000dYou must login first ! / 请先登录 !');</script>";
	echo "
        <script>
             setTimeout(function(){window.location.href='/apps/vms/account/login/index.html?type=al&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2main%2Fadmin%2Faction-edit.php?token=FoqXwKt0T59jDXrP';},100);
        </script>";
        exit;  
}
if($_SESSION['admin'] === 'no'){
  echo "<script>alert('High-Risk Operation Detect System / 系统最高级别安全提示\u000d\u000dYou have no permission to entry the Admin Control Panel ! （Operate Recorded） / 您无权访问超管系统！（行为已被记录）');</script>";
  echo "
        <script>
             setTimeout(function(){window.location.href='/apps/vms/main/index.php?type=warning&ref=acp_rejection';},100);
        </script>";
        exit;
    }

    function safeStrings($str) {
      return str_replace("'","\\'",str_replace("\\","\\\\",(string)$str));
    }//安全字符串检测函数

// 处理编辑操作的页面 
require "dbconfig.php";
// 连接mysql
$link = @mysql_connect(HOST,USER,PASS) or die("提示：数据库连接失败！");
// 选择数据库
mysql_select_db(DBNAME,$link);
// 编码设置
mysql_set_charset('utf8',$link);

// 获取修改的学分
$uid = safeStrings($_POST['uid']);
$wantcredit = safeStrings($_POST['wantcredit']);
// 更新数据
mysql_query("UPDATE works SET wantcredit='$wantcredit' WHERE uid=$uid",$link) or die('修改数据出错：'.mysql_error()); 
header("Location:response/edit-succeed.php");