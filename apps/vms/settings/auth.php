<?php
    header("Content-Type: text/html; charset=utf8");
    if(!isset($_POST["submit"])){
        exit("Unauthorized Access! / 非法访问！");
		header("Refresh:2;url=/account/login/index.html?type=sc&stat=passed&token=FoqXwKt0T59jDXrP");
    }//检测是否有submit操作
 
    function safeStrings($str) {
      return str_replace("'","\\'",str_replace("\\","\\\\",(string)$str));
    }//安全字符串检测函数

session_start();

setcookie("session_id",session_id(),time()+3600*24*365*10,"/",".volunteer.ensonyan.com");
    include('conn.php');//链接数据库
    $name = safeStrings($_POST['entry_name']);//post获得用户名表单值
    $password = safeStrings($_POST['entry_password']);//post获得用户密码单值

if($name == 'EnsonYan'){
} else {
  exit("High Risk Operation! You've been automatically recorded by the Firewall System! / 高危操作！您的行为已被系统防火墙自动记录！");
}

if(isset($_SESSION['logged'])){
  echo "<script>alert('你已经登录，请勿重复登录！');</script>";
  echo "
        <script>
             setTimeout(function(){window.location.href='/main/index.php?type=al&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Fsettings%2Fauth.php&token=FoqXwKt0T59jDXrP';},100);
        </script>";
        exit;
    }

    if ($name && $password){    //如果用户名和密码都不为空
@mysql_connect("localhost","credit","your_password_here")or die;    //链接数据库
@mysql_select_db("credit")or die;    //选择数据库
$query = @mysql_query("select * from user")or die;    //查询‘works’表中的所有记录

$n=0;
while ($row = mysql_fetch_array($query))    //遍历‘works’表中的数据，并形成数组

             $sql = "select * from user where username = '$name' and password='$password'";//检测数据库是否有对应的username和password的sql
             $result = mysql_query($sql);//执行sql
             $rows=mysql_num_rows($result);//返回一个数值
             if($rows){//0 false 1 true
			 
               {
$rs = mysql_query("select * from user where username='$name'");
//echo "查询信息如下：";
while($row = mysql_fetch_array($rs))

               //admin辨别开始
               if($row['status'] === '可用'){               
 
              }else {
				  echo "<script>alert('Account unavailable now, please contact your counseulor or the administrator. / 账号不可用，请联系你的领事或管理员');</script>";
                  mysql_close();//关闭数据库
echo "<script>
        setTimeout(function(){window.location.href='/main/index.php?type=al&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Faccount%2Flogin%2Fauth.php&token=FoqXwKt0T59jDXrP';},100);
     </script>";
        exit;
			  }
               //admin辨别结束
             }
	
               {
$sql="SELECT homeroom FROM user WHERE username='$name'";
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
$_SESSION['homeroom']=$row["homeroom"];
               }
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
			 
                $_SESSION['entry_name'] = "$name";
                $_SESSION['logged'] = "yes";
                   header("refresh:0;url=operate.php");//如果成功跳转至operate.html页面
                   exit;
             }else{
                echo "<script>alert('用户名或密码错误，请重试！');</script>";
                echo "
                    <script>
                            setTimeout(function(){window.location.href='index.html?type=wp&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Faccount%2Flogin%2Fauth.php&token=FoqXwKt0T59jDXrP';},100);
                    </script>

                ";//如果错误使用js 1秒后跳转到登录页面重试，DEF=1000;
             }
             

    }else{    //如果用户名或密码有空
	            session_destroy();
                echo "<script>alert('用户名或密码为空，请重新输入！');</script>";
                echo "
                      <script>
                            setTimeout(function(){window.location.href='index.html?type=blank&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Faccount%2Flogin%2Fauth.php&token=FoqXwKt0T59jDXrP';},100);
                      </script>";

                        //如果错误使用js 1秒后跳转到登录页面重试;
    }

    mysql_close();//关闭数据库
?>