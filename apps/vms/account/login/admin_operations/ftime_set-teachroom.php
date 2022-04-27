<!DOCTYPE html>
<?php
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
    header("Location:/apps/vms/account/login/index.html?type=al&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2main%2Findex.php?token=FoqXwKt0T59jDXrP");exit;
}
if($_SESSION['ls'] === 'no'){
  echo "<script>alert('High-Risk Operation Detect System / 系统最高级别安全提示\u000d\u000dYou have no permission to entry the Admin Control Panel ! （Operate Recorded） / 您无权访问超管系统！（行为已被记录）');</script>";
  echo "
        <script>
             setTimeout(function(){window.location.href='/apps/vms/main/index.php?type=warning&ref=acp_rejection';},100);
        </script>";
        exit;
    }
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Set Teachroom / 设置执教班</title>
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
session_start();
  include('conn.php');//链接数据库
  
    function safeStrings($str) {
      return str_replace("'","\\'",str_replace("\\","\\\\",(string)$str));
    }//安全字符串检测函数
  
$uid = $_GET['uid'];

$sql="SELECT * FROM user WHERE id='$uid'";
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
  
  mysql_close();//关闭数据库
?>

  <div style="padding: 100px 100px 10px;">
	<form action="ftime_set-teachroom-do.php" method="post" class="bs-example bs-example-form" role="form">
      </br>
		<div class="input-group">
			<span class="input-group-addon">Set Teachroom #1 / 设置执教班 #1</span>
			<select name="setteachroom">
                            <option value="无" style="display: none">Teachroom #1 选择执教班 #1</option>
                            <option value="Pre10-01">Pre10-01</option>
                            <option value="Pre10-02">Pre10-02</option>
                            <option value="Pre10-03">Pre10-03</option>
                            <option value="1001">1001</option>
                            <option value="1002">1002</option>
                            <option value="1003">1003</option>
                            <option value="1004">1004</option>
                            <option value="1005">1005</option>
                            <option value="1006">1006</option>
                            <option value="1007">1007</option>
                            <option value="1101">1101</option>
                            <option value="1102">1102</option>
                            <option value="1103">1103</option>
                            <option value="1104">1104</option>
                            <option value="1105">1105</option>
                            <option value="1106">1106</option>
                            <option value="1107">1107</option>
                            <option value="1201">1201</option>
                            <option value="1202">1202</option>
                            <option value="1203">1203</option>
                            <option value="1204">1204</option>
                            <option value="1205">1205</option>
                            <option value="1206">1206</option>
                            <option value="1207">1207</option>
                        </select>
		</div>
		</br>
		<div class="input-group">
			<span class="input-group-addon">Set Teachroom #2 / 设置执教班 #2</span>
			<select name="setteachroom2">
                            <option value="无" style="display: none">Teachroom #2 选择执教班 #2</option>
							<option value="无">无</option>
                            <option value="Pre10-01">Pre10-01</option>
                            <option value="Pre10-02">Pre10-02</option>
                            <option value="Pre10-03">Pre10-03</option>
                            <option value="1001">1001</option>
                            <option value="1002">1002</option>
                            <option value="1003">1003</option>
                            <option value="1004">1004</option>
                            <option value="1005">1005</option>
                            <option value="1006">1006</option>
                            <option value="1007">1007</option>
                            <option value="1101">1101</option>
                            <option value="1102">1102</option>
                            <option value="1103">1103</option>
                            <option value="1104">1104</option>
                            <option value="1105">1105</option>
                            <option value="1106">1106</option>
                            <option value="1107">1107</option>
                            <option value="1201">1201</option>
                            <option value="1202">1202</option>
                            <option value="1203">1203</option>
                            <option value="1204">1204</option>
                            <option value="1205">1205</option>
                            <option value="1206">1206</option>
                            <option value="1207">1207</option>
                        </select>
		</div>
		</br>
		<div class="input-group">
			<span class="input-group-addon">Set Teachroom #3 / 设置执教班 #3</span>
			<select name="setteachroom3">
                            <option value="无" style="display: none">Teachroom #3 选择执教班 #3</option>
							<option value="无">无</option>
                            <option value="Pre10-01">Pre10-01</option>
                            <option value="Pre10-02">Pre10-02</option>
                            <option value="Pre10-03">Pre10-03</option>
                            <option value="1001">1001</option>
                            <option value="1002">1002</option>
                            <option value="1003">1003</option>
                            <option value="1004">1004</option>
                            <option value="1005">1005</option>
                            <option value="1006">1006</option>
                            <option value="1007">1007</option>
                            <option value="1101">1101</option>
                            <option value="1102">1102</option>
                            <option value="1103">1103</option>
                            <option value="1104">1104</option>
                            <option value="1105">1105</option>
                            <option value="1106">1106</option>
                            <option value="1107">1107</option>
                            <option value="1201">1201</option>
                            <option value="1202">1202</option>
                            <option value="1203">1203</option>
                            <option value="1204">1204</option>
                            <option value="1205">1205</option>
                            <option value="1206">1206</option>
                            <option value="1207">1207</option>
                        </select>
		</div>
    </br>
    <button type="submit" value="提交" class="btn btn-success active" onClick="return confirm('System Notice / 系统提示\u000d\u000dConfirm to set Teachroom? The wrong Teachroom will unbind the Counselor from Students.\u000d确认执教班选择吗?错误的执教班可能导致领事与学生丢失绑定关系。');">Submit / 提交</button>
	</form>
</div>
</body>
</html>