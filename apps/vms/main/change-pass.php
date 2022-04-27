<!doctype html> 
<html> 
<head> 
<meta charset="UTF-8">
<meta name="theme-color" content="#5B9BD5">
<title>Changing Password. 正在修改密码</title>
<script type="text/javascript" src="common/js/filter.js"></script>
</head> 
<body> 
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
			  
      if(!isset($_POST["oldpassword"])){
        exit("Unauthorized Access! / 非法访问！");
    }//检测是否有submit操作 
  error_reporting(E_ALL ^ E_DEPRECATED);
  
    function safeStrings($str) {
      return str_replace("'","\\'",str_replace("\\","\\\\",(string)$str));
    }//安全字符串检测函数
  
  $username = $_SESSION["entry_name"]; 
  $oldpassword = safeStrings($_REQUEST ["oldpassword"]); 
  $newpassword = safeStrings($_REQUEST ["newpassword"]); 
    
  $con = mysql_connect ( "localhost", "credit", "your_password_here" ); 
  if (! $con) {
    die ( '数据库连接失败' . $mysql_error () ); 
  } 
  mysql_select_db ( "credit", $con ); 
  $dbusername = null; 
  $dbpassword = null; 
  $result = mysql_query ( "select * from user where username ='{$username}' and status = '可用';" ); 
  while ( $row = mysql_fetch_array ( $result ) ) { 
    $dbusername = $row ["username"]; 
    $dbpassword = $row ["password"]; 
  } 
  if (is_null ( $dbusername )) {

echo "
  <script type=\"text/javascript\"> 

    alert(\"Username not found ! / 用户名不存在\"); 

    window.location.href=\"/apps/vms/main/index.php?ref=change_pass&met=username_notfound\"; 

  </script>";  



  }

  if ($oldpassword != $dbpassword) {


echo "
  <script type=\"text/javascript\"> 

    alert(\"Old password wrong ! / 旧密码输入错误\"); 

    window.location.href=\"/apps/vms/main/index.php?ref=change_pass&met=old_pass_wrong\"; 

  </script>"; 


  } else {//系统主进程可用性辨别开始
include('conn.php');//链接数据库
  $rssysstat = mysql_query("select status from system where item='opstatus'");
//echo "查询信息如下：";
while($row = mysql_fetch_array($rssysstat))
	
               if ($row['status'] == 'running') {
				    mysql_query ( "update user set password='{$newpassword}' where username='{$username}'" ) or die ( "存入数据库失败" . mysql_error () );//如果上述用户名密码判定不错，则update进数据库中 

				  mysql_close ( $con );
				    echo "<script type=\"text/javascript\">

    alert(\"Password changed successfully. / 密码修改成功\"); 

    window.location.href=\"/apps/vms/main/index.php?ref=change_pass&met=password_change_ok\"; 

  </script>";
			   }
				  else if ($row['status'] == 'stop') {
				  session_unset();
				  session_destroy();
                  mysql_close();//关闭数据库
				  header('Location:/apps/vms/system-unavailable.html?type=st&dt=rej&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Faccount%2Flogin%2Fauth.php&token=FoqXwKt0T59jDXrP');
                  exit;}
				  

 
  }
  ?>

</body> 

</html>