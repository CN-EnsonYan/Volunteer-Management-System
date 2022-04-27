<?php
error_reporting(E_ALL ^ E_DEPRECATED);
if($_SESSION['admin'] === 'no'){
  echo "<script>alert('High-Risk Operation Detect System / 系统最高级别安全提示\u000d\u000dYou have no permission to entry the Admin Control Panel ! （Operate Recorded） / 您无权访问超管系统！（行为已被记录）');</script>";
  echo "
        <script>
             setTimeout(function(){window.location.href='/apps/vms/main/index.php?type=warning&ref=acp_rejection';},100);
        </script>";
        exit;
    }
    $server="localhost";//主机
    $db_username="credit";//你的数据库用户名
    $db_password="your_password_here";//你的数据库密码

    $con = mysql_connect($server,$db_username,$db_password);//链接数据库
    if(!$con){
        die("can't connect".mysql_error());//如果链接失败输出错误
    }
    
    mysql_select_db('credit',$con);//选择数据库
?>