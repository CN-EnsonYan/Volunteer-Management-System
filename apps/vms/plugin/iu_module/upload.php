<?php
session_start();
error_reporting(0);

include('conn.php');//链接数据库

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
				  if ($_SESSION == 'EnsonYan') {} else {
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
			  
$userLangF=$_COOKIE['userLang'];

if ($userLangF == "cn"){
include "./languages/zh_CN/lang-dict.php";
} else if ($userLangF == "en"){
include "./languages/en_US/lang-dict.php";
} else {
include "./languages/en_US/lang-dict.php";
}

if ($_GET['action'] == "save"){
include_once('conn.php'); 
include_once('uploadclass.php');
$insertuid=$_SESSION['imguid'];
$pic=$uploadfile;

$p = '/certimg/';
if (preg_match($p, $pic)) {
    $sql="UPDATE works SET photo = '$pic' where uid = '$insertuid'";
} else {
	$sql="UPDATE works SET photo = '无证明文件' where uid = '$insertuid'";
}
$result=mysql_query($sql,$conn);
//echo"<Script>window.alert('信息添加成功');location.href='upload.php'</Script>"; 
} 
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo "$langtitle"; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="theme-color" content="#5B9BD5">
<meta name="keywords" content="" />
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#818eff">
<meta name="theme-color" content="#ffffff">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="https://fonts.lug.ustc.edu.cn/css?family=Raleway:400,500,600,700,800,900" rel="stylesheet">
<style>.select {
		display: inline-block;
		width: 300px;
		position: relative;
		vertical-align: middle;
		padding: 0;
		overflow: hidden;
		background-color: #fff;
		color: #555;
		border: 1px solid #aaa;
		text-shadow: none;
		border-radius: 4px;	
		transition: box-shadow 0.25s ease;
		z-index: 2;
	}
 
	.select:hover {
		box-shadow: 0 1px 4px rgba(0, 0, 0, 0.15);
	}
 
	.select:before {
		content: "";
		position: absolute;
		width: 0;
		height: 0;
		border: 10px solid transparent;
		border-top-color: #ccc;
		top: 14px;
		right: 10px;
		cursor: pointer;
		z-index: -2;
	}
	.select select {
		cursor: pointer;
		padding: 10px;
		width: 100%;
		border: none;
		background: transparent;
		background-image: none;
		-webkit-appearance: none;
		-moz-appearance: none;
	}
 
	.select select:focus {
		outline: none;
	}
</style>
<style type="text/css">
    select{width:50px;}
</style>
<script>
fuction bvms(){
    window.location.href='/apps/vms/main/index.php?from=vms_mds&mname=iu_module&token=FoqXwKt0T59jDXrP'
}
</script>
</head>
<body>
<div class="signupform">
<h1></h1>
	<div class="container">
		
		<div class="agile_info">
			<div class="w3l_form">
				<div class="left_grid_info">
				<img src="https://volunteer.ensonyan.com/apps/vms/img/enlogo.svg" style="width:60px" />
					<h3><?php echo $langmoduletitle; ?></h3>
					<h4><?php echo $langmodulehello; ?><?php echo $_SESSION['entry_name']; ?></h4>
					<p> <?php echo $langdesc1; ?><a href="http://www.zuohaotu.com/image-merge.aspx" target="_blank"><font color="#01cd74"><?php echo $langdesc2; ?></font></a><?php echo $langdesc3; ?></br></br><?php echo $langcontactdev; ?>:</p>
					<ul class="social_section_1info">
						<li><a href="https://wpa.qq.com/msgrd?V=3&uin=2903658324&Site=Hi-Res%E8%A7%86%E5%90%AC%E5%8F%91%E7%83%A7%E8%AE%BA%E5%9D%9B&Menu=yes&from=ENNP-VMSV" target="_blank" class="w3_qq"><i class="fa fa-qq"></i></a></li>
						<li><a href="https://volunteer.ensonyan.com/sps/wechat.html?ref=vmsv-main-l_side" target="_blank" class="w3_wechat"><i class="fa fa-wechat"></i></a></li>
						<li><a href="https://github.com/CN-EnsonYan/?ref_ident=ENNP-VMSV" target="_blank" class="w3_github"><i class="fa fa-github"></i></a></li>
						<li><a href="https://www.facebook.com/rortege/?ref_ident=ENNP-VMSV" target="_blank" class="w3_facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#" target="_blank" class="w3_twitter"><i class="fa fa-twitter"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="w3_info">
				<h2><?php echo $langlefttitle; ?></h2>
				<p><font color="#FF0000" size="4px">☺☛</font> <?php echo $langfilesupport; ?></p>
						<form method="post" name="VerifyForm" action="?action=save" enctype="multipart/form-data">

							<input type="file" id="file" name="file" style="margin-bottom: 15px; padding: 0px 10px; border: 1px solid #bbb;font-size: 15px;
font-weight: 500;
text-align: left;
text-transform: capitalize;
letter-spacing: 1px;
padding: 12px 10px 12px 10px;
width: 100%;
display: inline-block;
box-sizing: border-box;
background: transparent;
font-family: 'Raleway', sans-serif;">
		
							<h4><?php echo $langsubagree1; ?><a href="https://docs.ensonyan.com/" target="_blank"><?php echo $langsubagree2; ?></a></h4>        
							<button type="submit" name="upload" class="btn btn-danger btn-block"><?php echo $langsubmitbtn; ?></button>
					</form>
					<button value="按钮" name="Back to vms" class="btn btn-danger btn-block" onclick="location='/apps/vms/main/index.php?from=vms_mds&mname=iu_module&token=FoqXwKt0T59jDXrP'"><?php echo $langbackvms; ?></button>
			</div>
			<div class="clear"></div>
			</div>
			
		</div>
		<div class="footer">

 <p><font color="#000000">Copyright &copy; 2019 <a target="_blank" href="https://www.ensonyan.com" style="color:#888888">EnsonYan</a>. All rights reserved.</font></p>
 </div>
	</div>
	</body>
</html>