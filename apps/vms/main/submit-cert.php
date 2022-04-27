<head>
<meta name="theme-color" content="#5B9BD5">
</head>
<?php
include('conn.php');//链接数据库
session_start();
if ( !$_SESSION['logged'] ) {
	echo "<script>alert('System Standard Level Safety Inspection / 系统标准级安全检测\u000d\u000dYou must login first ! / 请先登录 !');</script>";
	echo "
        <script>
             setTimeout(function(){window.location.href='/apps/vms/account/login/index.html?type=al&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2main%2Findex.php?token=FoqXwKt0T59jDXrP';},100);
        </script>";
        exit;
}
$name=$_SESSION['entry_name'];
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
echo "<script>
        setTimeout(function(){window.location.href='/apps/vms/system-unavailable.html?type=st&dt=rej&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Faccount%2Flogin%2Fauth.php&token=FoqXwKt0T59jDXrP';},100);
     </script>";
        exit;
				  }
			  }

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
echo "<script>alert('Real name verification required before any operation, click OK to do the real name verification. / 在进行所有操作之前，你必须实名验证并等待校方通过审核！点击下方确定进行实名验证。');window.location.href='https://verify.volunteer.ensonyan.com/index.html?type=forced_rna&token=FoqXwKt0T59jDXrP';</script>";
                $_SESSION['entry_name'] = "$name";
                $_SESSION['rnauthonly'] = "yes";
                 exit;
			  }

			  }

header("Content-Type: text/html; charset=utf8");
    if(!isset($_POST["submit"])){
        exit("非法访问！");
    }//检测是否有submit操作 

    function safeStrings($str) {
      return str_replace("'","\\'",str_replace("\\","\\\\",(string)$str));
    }//安全字符串检测函数

$username=safeStrings($_POST['username']);
$homeroom=safeStrings($_POST['homeroom']);
$place=safeStrings($_POST['place']);    //利用POST超全局变量 获取表单信息
$details=safeStrings($_POST['details']);
$time=safeStrings($_POST['time']);
$wantcredit=safeStrings($_POST['wantcredit']);
$servername='localhost';        //以下四行为数据库信息
$user='credit';            //用户名
$password='your_password_here';            //密码
$data='credit';                //要使用的数据库名称
  
$con = new mysqli($servername,$user,$password,$data);        //连接到数据库(面向对象)
if($con->connect_error){
	die("连接失败".$con->connect_error);
}
echo "连接成功"."<br/>";        //连接数据库成功显示的信息

$sql = "INSERT into works(username,homeroom,place,details,time,wantcredit,status) values('$username','$homeroom','$place','$details','$time','$wantcredit','待审核')";  //插入数据到数据库语句
if($con->query($sql)===true){        //插入成功显示的信息
	echo "数据输入成功！";
mysql_close();//关闭数据库
    header("Location: https://volunteer.ensonyan.com/apps/vms/main/submit-succeed.php"); 
    //确保重定向后，后续代码不会被执行 
exit;
}else {
	echo "数据输入失败"."<br/>".$con->error;
}
$con->close();
?>