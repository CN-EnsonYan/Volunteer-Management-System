<?php

error_reporting(0);

if ($_GET['action'] == "save"){
include_once('conn.php'); 
include_once('uploadclass.php');
  session_start();
$insertuid=$_SESSION['imguid'];
$pic=$uploadfile;

$sql="UPDATE works SET photo = '$pic' where uid = '$insertuid'"; 
$result=mysql_query($sql,$conn);
//echo"<Script>window.alert('信息添加成功');location.href='upload.php'</Script>"; 
} 
?>
<html>
<head>
<title>VMS - Image Upload. 志愿证明文件上传. Powered By EnsonYan !</title>
</head> 
<body>
<form method="post" action="?action=save" enctype="multipart/form-data"> 
<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%"> 
<tr> 
<td width="55" height="20" align="center"> </td> 
<td height="16">

<table width="48%" height="93" border="0" cellpadding="0" cellspacing="0"> 
<tr>
<td>上传文件(图片或压缩包)： </td> 
<td><label>
<input name="file" type="file" value="浏览">
</label></td> 
</tr> 
<tr> 
<td> </td> 
<td><input type="submit" value="上 传" name="upload"></td> 
</tr> 
</table></td> 
</tr> 
</table> 
</form> 

</body> 
</html>