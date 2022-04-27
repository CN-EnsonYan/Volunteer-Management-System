<!DOCTYPE html>
<?php
session_start();
if ( !$_SESSION['logged'] ) {
    header("Location:/account/login/index.html?type=al&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2main%2Findex.php?token=FoqXwKt0T59jDXrP");exit;
}
if($_SESSION['admin'] === 'no'){
  echo "<script>alert('You have no permission to entry the Admin Control Panel ! / 您无权访问超管系统！');</script>";
  echo "
        <script>
             setTimeout(function(){window.location.href='/main/index.php?type=warning&ref=acp_rejection';},100);
        </script>";
        exit;
    }
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>EN-NP VMS-Settings | 系统设置. Powered By EnsonYan!</title>
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

$sql="SELECT * FROM works WHERE uid='$uid'";
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
  
  mysql_close();//关闭数据库
?>

  <div style="padding: 100px 100px 10px;">
	<form action="action-edit.php" method="post" class="bs-example bs-example-form" role="form">
		<div class="input-group">
          <span class="input-group-addon">UID <font color="#FF0000" size="2">* Auto Fill / 自动填写</font></span>
			<input type="text" name="uid" readonly unselectable="on" value="<?php echo safeStrings($row['uid']); ?>" class="form-control" placeholder="twitterhandle">
		</div>
      </br>
		<div class="input-group">
			<span class="input-group-addon">Credits / 学时</span>
			<input type="text" name="wantcredit" value="<?php echo safeStrings($row['wantcredit']); ?>" class="form-control" placeholder="twitterhandle">
		</div>
    </br>
    <button type="submit" value="提交" class="btn btn-success active">Submit / 提交</button>
	</form>
</div>
</body>
</html>