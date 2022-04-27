<?php
    header("Content-Type: text/html; charset=utf8");
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
             setTimeout(function(){window.location.href='/apps/vms/account/login/index.html?type=al&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2main%2Findex.php?token=FoqXwKt0T59jDXrP';},100);
        </script>";
        exit;  
}
    if(!isset($_POST["submit"])){
        exit("非法访问！");
    }//检测是否有submit操作
if($_SESSION['admin'] === 'no'){
  echo "<script>alert('High-Risk Operation Detect System / 系统最高级别安全提示\u000d\u000dYou have no permission to entry the Admin Control Panel ! （Operate Recorded） / 您无权访问超管系统！（行为已被记录）');</script>";
  echo "
        <script>
             setTimeout(function(){window.location.href='/apps/vms/main/index.php?type=warning&ref=acp_rejection';},100);
        </script>";
        exit;
    }
$username=$_POST['username'];
$place=$_POST['place'];    //利用POST超全局变量 获取表单信息
$details=$_POST['details'];
$time=$_POST['time'];
$wantcredit=$_POST['wantcredit'];
$servername='localhost';        //以下四行为数据库信息
$user='credit';            //用户名
$password='your_password_here';            //密码
$data='credit';                //要使用的数据库名称
  
$con = new mysqli($servername,$user,$password,$data);        //连接到数据库(面向对象)
if($con->connect_error){
	die("连接失败".$con->connect_error);
}
echo "连接成功"."<br/>";        //连接数据库成功显示的信息

$sql="SELECT users where WHERE username='$username'";
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);

$sql = "INSERT into works(username,place,details,time,wantcredit,status) values('$username','$place','$details','$time','$wantcredit','待审核')";  //插入数据到数据库语句
if($con->query($sql)===true){        //插入成功显示的信息
	echo "数据输入成功！";
mysql_close();//关闭数据库
    header("Location: https://volunteer.ensonyan.com/apps/vms/main/admin/response/submit-succeed.php");
    //确保重定向后，后续代码不会被执行
exit;
}else {
	echo "数据输入失败"."<br/>".$con->error;
}
$con->close();
?>