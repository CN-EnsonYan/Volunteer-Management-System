<head>
    <meta name="theme-color" content="#5B9BD5">
</head>
<?php
error_reporting(E_ALL^E_NOTICE);
    header("Content-Type: text/html; charset=utf8");
    if(!isset($_POST["submit"])){
        exit("Unauthorized Access! / 非法访问！");
		header("Refresh:2;url=/apps/vms/account/login/index.html?type=sc&stat=passed&token=FoqXwKt0T59jDXrP");
    }//检测是否有submit操作 
 
    function safeStrings($str) {
      return str_replace("'","\\'",str_replace("\\","\\\\",(string)$str));
    }//安全字符串检测函数

session_start();
setcookie("session_id",session_id(),time()+3600*24*365*10,"/",".volunteer.ensonyan.com");
    include('conn.php');//链接数据库
    $name = safeStrings($_POST['entry_name']);//post获得用户名表单值
    $password = safeStrings($_POST['entry_password']);//post获得用户密码单值

               {
$rs = mysql_query("select * from user where username='$name'");
//echo "查询信息如下：";
while($row = mysql_fetch_array($rs))
               
               //admin辨别开始
               if($row['admin'] === 'yes'){
                $_SESSION['admin'] = "yes";
              }else {$_SESSION['admin'] = "no";}
               //admin辨别结束
             }

			 			                {
$rs = mysql_query("select * from user where username='$name'");
//echo "查询信息如下：";
while($row = mysql_fetch_array($rs))
               
               //suadmin辨别开始
               if($row['suadmin'] === 'yes'){
                $_SESSION['suadmin'] = "yes";
              }else {$_SESSION['suadmin'] = "no";}
               //suadmin辨别结束
             }

$rssysstat = mysql_query("select status from system where item='opstatus'");
//echo "查询信息如下：";
while($row = mysql_fetch_array($rssysstat))

               //系统主进程可用性辨别开始
               if($row['status'] == 'running'){
 
              }else {
				  if ($_SESSION['suadmin'] == 'yes') {} else {
				  session_unset();//free all session variable
                  session_destroy();//销毁一个会话中的全部数据
                  setcookie(session_name(),'',time()-3600);//销毁与客户端的卡号
                  mysql_close();//关闭数据库
// 记录行为（非法）
//操作时间
date_timezone_set('PRC');
function udate($format = 'u', $utimestamp = null)
{
    if (is_null($utimestamp)){
        $utimestamp = microtime(true);
    }
    $timestamp = floor($utimestamp);
    $milliseconds = round(($utimestamp - $timestamp) * 1000000);//改这里的数值控制毫秒位数
    return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
}
$illoptime=udate('Y-m-d H:i:s.u');
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
mysql_query("INSERT into illegaloperation(module,optype,timestamp,inputname,inputpass,ip,visiturl,eventID) values('vms','illegal_login','$illoptime','$name','$password',\"$ip\",\"$illeurl\",\"$eventID\")",$link)or die('修改数据出错：'.mysql_error()); 
mysql_close();//关闭数据库
//记录成功并开始警告
echo "<script>alert('High-Risk Operation Detect System / 高风险行为监测系统\u000d \u000dYour operation has been recorded as an illegal event. / 你的行为已被系统记录为非法操作。');</script>";
echo "<script>
        setTimeout(function(){window.location.href='/apps/vms/system-unavailable.html?type=st&dt=rej&hrsstat=recorded&hrstype=illegal_opt&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Faccount%2Flogin%2Fauth.php&token=FoqXwKt0T59jDXrP';},100);
     </script>";
        exit;
		// 记录行为（非法）结束
				  }
			  }

if(isset($_SESSION['logged'])){
  echo "<script>alert('你已经登录，请勿重复登录！');</script>";
  echo "
        <script>
             setTimeout(function(){window.location.href='/apps/vms/main/index.php?type=al&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Faccount%2Flogin%2Fauth.php&token=FoqXwKt0T59jDXrP';},100);
        </script>";
        exit;
    }

    if ($name && $password){    //如果用户名和密码都不为空==============================================================================================
@mysql_connect("localhost","credit","your_password_here")or die;    //链接数据库
@mysql_select_db("credit")or die;    //选择数据库
$query = @mysql_query("select * from user")or die;    //查询‘works’表中的所有记录

$n=0;
while ($row = mysql_fetch_array($query))    //遍历‘works’表中的数据，并形成数组

             $sql = "select * from user where username = '$name' and password='$password'";//检测数据库是否有对应的username和password的sql
             $result = mysql_query($sql);//执行sql
             $rows=mysql_num_rows($result);//返回一个数值
             if($rows){//0 false 1 true
			 
			 //===========================================================================================以下为账号密码核实正确后的操作

$rs = mysql_query("select * from user where username='$name'");
//echo "查询信息如下：";
while($rowls = mysql_fetch_array($rs))
	
               $teachroom=$rowls['teachroom'];
			   $teachroom2=$rowls['teachroom2'];
			   $teachroom3=$rowls['teachroom3'];
			   $fbcounselor=$rowls['firstbecounselor'];
			   
               //领事辨别开始
               if($rowls['ls'] === 'yes'){
                $_SESSION['ls'] = "yes";
				$_SESSION['teachroom'] = '$teachroom';
				$_SESSION['teachroom2'] = '$teachroom2';
				$_SESSION['teachroom3'] = '$teachroom3';
				$_SESSION['firstbecounselor'] = '$fbcounselor';
              } else {$_SESSION['ls'] = "no";}
               //领事辨别结束
			 
$rs = mysql_query("select * from user where username='$name'");
//echo "查询信息如下：";
while($row = mysql_fetch_array($rs))

               //帐号可用性辨别开始
               if($row['status'] === '可用'){
 
              }else {
				  session_unset();//free all session variable
                  session_destroy();//销毁一个会话中的全部数据
                  setcookie(session_name(),'',time()-3600);//销毁与客户端的卡号
				  echo "<script>alert('Account unavailable now, please contact your counseulor or the administrator. / 账号不可用，请联系你的领事或管理员');</script>";
                  mysql_close();//关闭数据库
echo "<script>
        setTimeout(function(){window.location.href='/apps/vms/main/index.php?type=al&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Faccount%2Flogin%2Fauth.php&token=FoqXwKt0T59jDXrP';},100);
     </script>";
        exit;
			  }
               //帐号可用性辨别结束

//领事首次登陆引导设置教学班辨别
$fbcounselorsearch = mysql_query("select firstbecounselor from user where username='$name'");
//echo "查询信息如下：";
while($rowfbcs = mysql_fetch_array($fbcounselorsearch))
if($rowfbcs['firstbecounselor'] == 'yes'){
	echo "<script>
        setTimeout(function(){window.location.href='/apps/vms/account/login/admin_operations/ftime_set-teachroom.php?type=al&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Faccount%2Flogin%2Fauth.php&token=FoqXwKt0T59jDXrP';},100);
     </script>";
	 exit;
} else {}
//领事首次登陆引导设置教学班辨别结束

//实名验证步骤开始
$psrnssysstat = mysql_query("select psvstat from user where username='$name'");
//echo "查询信息如下：";
while($row = mysql_fetch_array($psrnssysstat))

               //PowerSchool方式实名状态辨别开始
               if($row['psvstat'] == 'yes'){
                 
                 }else {
				  $ntrnssysstat = mysql_query("select verify from user where username='$name'");
//echo "查询信息如下：";
while($row = mysql_fetch_array($ntrnssysstat))

               //普通方式实名状态辨别开始
               if($row['verify'] == '已认证'){
                 
                 }else {
                  mysql_close();//关闭数据库
echo "<script>
        setTimeout(function(){window.location.href='/apps/vms/account/login/no_rnauth-redir.php?from=auth.php&token=FoqXwKt0T59jDXrP';},100);
      </script>";
                $_SESSION['entry_name'] = "$name";
                $_SESSION['rnauthonly'] = "yes";
                 exit;
			  }

			  }
//实名验证步骤结束
	
               {
$sql="SELECT homeroom FROM user WHERE username='$name'";
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
$_SESSION['homeroom']=$row["homeroom"];
               }
			 
                $_SESSION['entry_name'] = "$name";
                $_SESSION['logged'] = "yes";
               
$rsrd = mysql_query("select * from user where username='$name'");
//echo "查询信息如下：";
while($row = mysql_fetch_array($rsrd))


               //管理识别特殊引导开始
               if($row['admin'] === 'yes'){
 echo "<script>
        setTimeout(function(){window.location.href='/apps/vms/plugin/acp_detect/select.php?type=al&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Faccount%2Flogin%2Fauth.php&token=FoqXwKt0T59jDXrP';},100);
     </script>";
            exit;
              }
               //管理识别特殊引导结束
             

$sqlfirstlogin="SELECT firstlogin FROM user WHERE username='$name'";
$resultfirstlogin=mysql_query($sqlfirstlogin);
$rowfirstlogin=mysql_fetch_assoc($resultfirstlogin);
$rstphpfirstlogin=$rowfirstlogin["firstlogin"];
               
               //首次登陆辨别开始
               if($rstphpfirstlogin === 'yes'){
echo "<script>
        setTimeout(function(){window.location.href='/apps/vms/tutorial/first_login.php?type=al&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Faccount%2Flogin%2Fauth.php&token=FoqXwKt0T59jDXrP';},100);
      </script>";
            exit;
              }else {
                   header("refresh:0;url=redir.php");//如果成功跳转至redir.html页面}
               //首次登陆辨别结束
                   exit;
               //正常登陆步骤引导结束
               }
             }else{
				  session_unset();//free all session variable
                  session_destroy();//销毁一个会话中的全部数据
                  setcookie(session_name(),'',time()-3600);//销毁与客户端的卡号
                echo "<script>alert('Incorrect username or password, please try again! / 用户名或密码错误，请重试！');</script>";
                echo "
                    <script>
                            setTimeout(function(){window.location.href='index.html?type=wp&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Faccount%2Flogin%2Fauth.php&token=FoqXwKt0T59jDXrP';},100);
                    </script>

                ";//如果错误使用js 1秒后跳转到登录页面重试，DEF=1000;
             }
             

    }else{    //如果用户名或密码有空
				  session_unset();//free all session variable
                  session_destroy();//销毁一个会话中的全部数据
                  setcookie(session_name(),'',time()-3600);//销毁与客户端的卡号
                echo "<script>alert('Please fill in all the blanks! Try again. / 用户名或密码为空，请重新输入！');</script>";

                echo "
                      <script>
                            setTimeout(function(){window.location.href='index.html?type=blank&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Faccount%2Flogin%2Fauth.php&token=FoqXwKt0T59jDXrP';},100);
                      </script>";

                        //如果错误使用js 1秒后跳转到登录页面重试;
    }

    mysql_close();//关闭数据库
?>