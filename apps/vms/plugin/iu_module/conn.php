<? 
$host="localhost"; //数据库服务器名称 
$user="credit"; //用户名 
$pwd="your_password_here"; //密码 
$conn=mysql_connect($host,$user,$pwd); 
mysql_query("SET 
character_set_connection=UTF-8, 
character_set_results=UTF-8, 
character_set_client=binary",$conn); 

if ($conn==FALSE) 
{ 
echo "<center>服务器连接失败！<br>请刷新后重试。</center>"; 
return true; 
} 
$databasename="credit";//数据库名称 

do 
{ 
$con=mysql_select_db($databasename,$conn); 
}while(!$con); 

if ($con==FALSE) 
{ 
echo "<center>打开数据库失败！<br>请刷新后重试。</center>"; 
return true; 
} 

?>