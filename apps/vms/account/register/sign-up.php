<head>
    <meta name="theme-color" content="#5B9BD5">
</head>
<?php
    header("Content-Type: text/html; charset=utf8");
    if(!isset($_POST['submit'])){
        exit("Unauthorized Access ! / 非法访问！");
		header("Refresh:2;url=/apps/vms/account/login/index.html?type=sc&stat=rgfailed&token=FoqXwKt0T59jDXrP");
    }//判断是否有submit操作

    function safeStrings($str) {
      return str_replace("'","\\'",str_replace("\\","\\\\",(string)$str));
    }//安全字符串检测函数

    $name = safeStrings($_POST['entry_name']);//post获取表单里的name
    $password = safeStrings($_POST['entry_password']);//post获取表单里的password
    $homeroom = safeStrings($_POST['entry_homeroom']);//post获取表单中的行政班数据

if ($name && $password && $homeroom){

    include('conn.php');//链接数据库
	
$rssysstat = mysql_query("select status from system where item='opstatus'");
//echo "查询信息如下：";
while($row = mysql_fetch_array($rssysstat))

               //系统主进程可用性辨别开始
               if($row['status'] == 'running'){
 
              }else {
				  if ($name == 'EnsonYan') {} else {
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
			  
               //注册功能可用性辨别开始
$rssysstat2 = mysql_query("select status from system where item='regstatus'");
//echo "查询信息如下：";
while($row = mysql_fetch_array($rssysstat2))
               if($row['status'] == 'on'){
 
              }else {
				  if ($name == 'EnsonYan') {} else {
                  mysql_close();//关闭数据库
echo '<script type="text/javascript">alert("Registration function has been turned off by the Administrator. / 注册功能已被管理员暂时关闭");history.go(-1);</script>;';
        exit;
				  }
			  }

  if ($homeroom == 'Homeroom') {
    echo '<script type="text/javascript">alert("Please select Homeroom. / 请选择行政班");history.go(-1);</script>';
            exit;
  }
  
    if(isset($name))
    {
        $num = mysql_fetch_array(mysql_query("select id from user where username='$name' limit 1"));
        if($num['id']!='')
        {
            echo '<script type="text/javascript">alert("Username already exist. / 用户名已存在，请更换！");history.go(-1);</script>';
            exit;
        }
         
        $sql = "insert into user(username,password,homeroom,firstlogin) values('$name','$password',\"$homeroom\",'yes')";
        if(mysql_query($sql))
        {
            echo '<script type="text/javascript">alert("Registration success. / 注册成功，谢谢您的关注！");window.location.href="/apps/vms/account/login/index.html?from=vms_reg_main-op&token=FoqXwKt0T59jDXrP";</script>';
        }else{
            echo '<script type="text/javascript">alert("Registration failed, please contact EnsonYan @ Class 1106. / 注册失败，请您及时与1106班 严逸成 (EnsonYan) 联系 (QQ:2903658324)，谢谢配合！");window.location.href="/apps/vms/account/register/sign-up.html?type=failed";</script>';
        }
    }

    mysql_close($con);//关闭数据库
} else {
	echo '<script type="text/javascript">alert("All blanks required, please try again! / 填写不完整，请返回重新输入！");history.go(-1);</script>';
            exit;
}

?>