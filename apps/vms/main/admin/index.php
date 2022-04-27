<?php
session_start();
if ( !$_SESSION['logged'] ) {
	//未登录日志记录
	//操作时间
date_timezone_set('PRC');
$illoptime=date('Y-m-d H:i:s', time());
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
mysql_query("INSERT into illegaloperation(module,optype,timestamp,ip,visiturl,eventID) values('vms','non_login_visit','$illoptime',\"$ip\",\"$illeurl\",\"$eventID\")",$link)or die('修改数据出错：'.mysql_error()); 
mysql_close();//关闭数据库
//记录成功并开始警告
	echo "<script>alert('System Standard Level Safety Inspection / 系统标准级安全检测\u000d\u000dYou must login first ! / 请先登录 !');</script>";
	echo "
        <script>
             setTimeout(function(){window.location.href='/apps/vms/account/login/index.html?type=al&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2main%2Findex.php?token=FoqXwKt0T59jDXrP';},100);
        </script>";
        exit;
}
if($_SESSION['admin'] === 'no'){
		$operator=$_SESSION['entry_name'];
	// 记录行为（非法）
//操作时间
date_timezone_set('PRC');
$illoptime=date('Y-m-d H:i:s', time());
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
mysql_query("INSERT into illegaloperation(module,optype,timestamp,operator,ip,visiturl,eventID) values('vms','illegal_admin_visit','$illoptime','$operator',\"$ip\",\"$illeurl\",\"$eventID\")",$link)or die('修改数据出错：'.mysql_error()); 
mysql_close();//关闭数据库
//记录成功并开始警告
  echo "<script>alert('High-Risk Operation Detect System / 系统最高级别安全提示\u000d\u000dYou have no permission to entry the Admin Control Panel ! （Operate Recorded） / 您无权访问超管系统！（行为已被记录）');</script>";
  echo "
        <script>
             setTimeout(function(){window.location.href='/apps/vms/main/index.php?type=warning&ref=acp_rejection';},100);
        </script>";
        exit;
    }
else {
  $username=$_SESSION['entry_name'];
  include('conn.php');//链接数据库

$sql="SELECT teachroom FROM user WHERE username='$username'";
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
$teachroom=$row["teachroom"];
}

@mysql_connect("localhost","credit","your_password_here")or die;    //链接数据库
@mysql_select_db("credit")or die;    //选择数据库
$query = @mysql_query("select * from user where homeroom = '$teachroom'")or die;    //查询‘works’表中的所有记录

$n=0;
while ($row = mysql_fetch_array($query))    //遍历‘works’表中的数据，并形成数组
{
    $mystudents = $row['username'];
   //显示所有本版用户名称：echo "$mystudents";$n++;
}
  mysql_close();//关闭数据库

    function safeStrings($str) {
      return str_replace("'","\\'",str_replace("\\","\\\\",(string)$str));
    }//安全字符串检测函数
?>
<!Doctype html>
<html lang="ch">
<head>
        <script type="text/javascript">
            function startMarquee() {
                $('.mq').marquee({
                    pauseOnHover: true
                });
            }
        </script>
        <meta charset="utf-8">
		<meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="由EnsonYan开发的志愿者信息管理系统，为枫叶教育集团提供志愿者管理服务">
        <meta name="keywords" content="EnsonYan,EN-NetworkProject,志愿者信息管理系统，志愿者">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <title>EN-NetworkProject | 管理员控制中心 - 志愿者信息管理系统. Powered By EnsonYan !</title>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
          <script src='../js/jquery.marquee.min.js'></script>
        <script src='../js/jquery.pause.js'></script>
        <script>
            $(function() {
                $(".meun-item").click(function() {
                    $(".meun-item").removeClass("meun-item-active");
                    $(this).addClass("meun-item-active");
                    var itmeObj = $(".meun-item").find("img");
                    itmeObj.each(function() {
                        var items = $(this).attr("src");
                        items = items.replace("_grey.png", ".png");
                        items = items.replace(".png", "_grey.png")
                        $(this).attr("src", items);
                    });
                    var attrObj = $(this).find("img").attr("src");
                    ;
                    attrObj = attrObj.replace("_grey.png", ".png");
                    $(this).find("img").attr("src", attrObj);
                });
                $("#topAD").click(function() {
                    $("#topA").toggleClass(" glyphicon-triangle-right");
                    $("#topA").toggleClass(" glyphicon-triangle-bottom");
                });
                $("#topBD").click(function() {
                    $("#topB").toggleClass(" glyphicon-triangle-right");
                    $("#topB").toggleClass(" glyphicon-triangle-bottom");
                });
                $("#topCD").click(function() {
                    $("#topC").toggleClass(" glyphicon-triangle-right");
                    $("#topC").toggleClass(" glyphicon-triangle-bottom");
                });
                $(".toggle-btn").click(function() {
                    $("#leftMeun").toggleClass("show");
                    $("#rightContent").toggleClass("pd0px");
                })
            })
        </script>
  <!--自定点击弹出层-->
  <style>
    .black_overlay{
    display: none;
    position: absolute;
    top: 0%;
    left: 0%;
    width: 100%;
    height: 100%;
    background-color: black;
    z-index:1001;
    -moz-opacity: 0.8;
    opacity:.80;
    filter: alpha(opacity=88);
    }
    .white_content {
      display: none;
      position: absolute;
      top: 2%;
      left: 25%;
      width: 50%;
      height:20%;
      padding: 20px;
      border: 10px solid orange;
      background-color: white;
      z-index:1002;
      overflow: auto;
    }
  </style>

        <!--[if lt IE 9]>
  <script src="js/html5shiv.min.js"></script>
  <script src="js/respond.min.js"></script>
<![endif]-->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/common.css" />
        <link rel="stylesheet" type="text/css" href="css/slide.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="css/flat-ui.min.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.nouislider.css">

<!-- Analytics -->
<script type="text/javascript">
  var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//analytics.ensonyan.com/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Analytics Code -->
    </head>

    <body onload="startMarquee()">
        <div id="wrap">
            <!-- 左侧菜单栏 -->
            <div class="leftMeun" style="overflow:auto" id="leftMeun">
                <div id="logoDiv">
                    <p id="logoP"><img id="logo" alt="Super Admin Control Panel" src="images/enlogo.svg"><span>系统管理控制中心</span></p>
                </div>
                <div id="personInfor">
                  <p id="userName"><?php echo $_SESSION['entry_name']; ?></br>Welcome / 欢迎！</p></br>
              <p><span>You are / 您的级别为:</br>
                  <font color="#FFFFE0">
				  <?php
				  if($_SESSION['suadmin'] === 'yes'){
					  echo "SuperAdmin - 超级管理员";
				  } else {echo "Admininistrator - 管理员";};
				  ?></font>
                  </span></p>
                  <p>
                    <a href="/apps/vms/account/logout/logout.php?token=FoqXwKt0T59jDXrP&uname=<?php echo $_SESSION['entry_name']; ?>">Log out / 退出登录</a>
                  </p>
				  <?php
				  if($_SESSION['suadmin'] == 'yes'){ echo "<a href='./system_controls/system_start.php' onClick=\"return confirm('High-Risk Operation Detect System / 系统最高级别安全提示\u000d\u000dConfirm to enable VMS Main Process? / 确认启动 VMS 系统主进程吗？');\">开启系统</a>&nbsp;&nbsp;<a href='./system_controls/system_stop.php' onClick=\"return confirm('High-Risk Operation Detect System / 系统最高级别安全提示\u000d\u000dConfirm to pause VMS Main Process? / 确认暂停 VMS 系统主进程吗？');\">停止系统</a></br><a href='./system_controls/system_reg-start.php' onClick=\"return confirm('High-Risk Operation Detect System / 系统最高级别安全提示\u000d\u000dConfirm to enable VMS Registeration Function? / 确认开启 VMS 系统注册功能吗？');\">允许注册</a>&nbsp;&nbsp;<a href='./system_controls/system_reg-stop.php' onClick=\"return confirm('High-Risk Operation Detect System / 系统最高级别安全提示\u000d\u000dConfirm to disable VMS Registeration Function? / 确认关闭 VMS 系统注册功能吗？');\">禁止注册</a>"; }
				  ?>
                </div>
                <div class="meun-title">Volunteers Management</br>志愿者管理</div>
                <div class="meun-item meun-item-active" href="#audit" aria-controls="audit" role="tab" data-toggle="tab"><img src="images/icon_source.png">Auditing - 审核中心</div>
                <div class="meun-item" href="#cert" aria-controls="cert" role="tab" data-toggle="tab"><img src="images/icon_user_grey.png">Certificate - 证明管理</div>
                <div class="meun-item" href="#rnauth" aria-controls="rnauth" role="tab" data-toggle="tab"><img src="images/icon_card_grey.png">R.N Auth - 实名管理</div>
                <div class="meun-item" href="#user" aria-controls="user" role="tab" data-toggle="tab"><img src="images/icon_chara_grey.png">Volunteers - 用户管理</div>
				<div class="meun-item" href="#chanclass" aria-controls="chanclass" role="tab" data-toggle="tab"><img src="images/icon_change_grey.png">Homeroom - 修改班级</div>
				<?php
				if($_SESSION['suadmin'] == 'yes'){
				echo "<div class=\"meun-title\">Teacher Management</br>教师管理</div>";
				echo "<div class=\"meun-item\" href=\"#teacherctrl\" aria-controls=\"teacherctrl\" role=\"tab\" data-toggle=\"tab\"><img src=\"images/icon_chara_grey.png\">Teachers - 教师管理</div>";
				echo "<div class=\"meun-item\" href=\"#setteacher\" aria-controls=\"setteacher\" role=\"tab\" data-toggle=\"tab\"><img src=\"images/icon_chara_grey.png\">Set Perm. - 用户提权</div>";
				} else {}
                ?>
				<div class="meun-title">Advanced / 其他</div>
                <div class="meun-item" href="#syslog" aria-controls="syslog" role="tab" data-toggle="tab"><img src="images/icon_rule_grey.png">System Log - 系统日志</div>
                <div class="meun-item" onclick="javascript:location.href='/apps/vms/main/index.php?ref=admin_panel'" aria-controls="/apps/vms/main/index.php?ref=admin_panel" role="tab" data-toggle="tab"><img src="images/icon_char_grey.png">Normal Panel / 普通后台</div> <!-- default href=#sitt -->
            </div>
            <!-- 右侧具体内容栏目 -->
            <div id="rightContent">
                <a class="toggle-btn" id="nimei">
                    <i class="glyphicon glyphicon-align-justify"></i>
                </a>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- 志愿管理模块 -->
                    <div role="tabpanel" class="tab-pane active" id="audit">
                        <div class="check-div form-inline">
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#addSource">Upload / 上传志愿证明</button><font color="FF0000">&nbsp;* Attention / 注意</font>&nbsp;Check the username properly. / 请认真核对用户名以免数据错误
                        </div>
                      
                      <div class="data-div">
                        
                            <div class="row tableHeader">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    UID
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>
                                    Name / 姓名
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>
                                    Place / 地点
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    Details / 内容
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>
                                    Time(Hrs) / 时间
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    Cr Wanted / 申请学时
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>
                                    Status / 状态
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    Act / 操作
                                </div>
                                 <!-- 此处第8列标题占位 -->
                              </div>                         
                           
                          <div class="tablebody">  <!-- 此处无数据应该隐藏 -->
<?php
//申请认证模块
@mysql_connect("localhost","credit","your_password_here")or die;    //链接数据库
@mysql_select_db("credit")or die;    //选择数据库
if ($_SESSION['suadmin'] == 'yes'){
$query = @mysql_query("select * from works")or die;    //查询‘works’表中的所有记录
} else if ($_SESSION['suadmin'] == 'no'){
	$myteachroom=$_SESSION['teachroom'];
	$query = @mysql_query("select * from works where homeroom='$myteachroom'")or die;    //查询‘works’表中本账号执教班中学生的所有记录
}

$n=0;
while ($row = mysql_fetch_array($query))    //遍历‘works’表中的数据，并形成数组
{
    $uid = $row['uid'];
    $dbusername = $row['username'];
    $place = $row['place'];    //使用键获取数组中对应的值
    $details = $row['details'];
    $time = $row['time'];
    $wantcredit = $row['wantcredit'];
    $getcredit = $row['getcredit'];
    $status = $row['status'];
  
   if ($status == '待审核') {
     $statuscolor="#4169E1";
   }
   if ($status == '已通过') {
     $statuscolor="#228B22";
   }
   if ($status == '已驳回') {
     $statuscolor="#FF0000";
   }
  
    echo "<div class='row'>";
    echo "<div class='col-xs-1 '>{$uid}</div>";
    echo "<div class='col-xs-1 '>{$dbusername}</div>";
    echo "<div class='col-xs-2 ' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'><div class='mq' data-duration='2000' style='width:230px;overflow:hidden'><span>{$place}</span></div></div>";    //按照数据表的列在表格里输出对应数据
    echo "<div class='col-xs-2 ' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'><div class='mq' data-duration='2000' style='width:230px;overflow:hidden'><span>{$details}</span></div></div>";
    echo "<div class='col-xs-1 '>{$time}</div>";
    echo "<div class='col-xs-2 '>{$wantcredit} <button class='btn btn-info btn-xs' data-toggle='modal' onclick=\"location.href='edit.php?uid={$row['uid']}'\" data-target='#operate4edit'>Edit / 修改</button></div>";
    echo "<div class='col-xs-1 '><font color='$statuscolor'>{$status}</font></div>";
    echo "<div class='col-xs-2'>
                                <button type='button' class='btn btn-success btn-xs' onclick=\"location.href='action-conf.php?uid={$row['uid']}&username=$dbusername'\">CONF</button>
                                <button type='button' class='btn btn-danger btn-xs' onclick=\"location.href='action-rej.php?uid={$row['uid']}&username=$dbusername'\">REJ</button>
                            </div>";
    echo "</div>";
    $n++;
/*    if($n>14){
        return;
    }*/
}
mysql_free_result($result);
mysql_close();
?>
                                 <!-- 此处无数据应该隐藏 -->
                           </div>
                       </div>
                        <!--页码块-->
                        <footer class="footer">
                            <ul class="pagination">
                                <li>
                                    <select>
                                        <option>1</option>

                                    </select>
                                    页
                                </li>
                                <li class="gray">
                                    共1页
                                </li>
                                <li>
                                    <i class="glyphicon glyphicon-menu-left">
                                    </i>
                                </li>
                                <li>
                                    <i class="glyphicon glyphicon-menu-right">
                                    </i>
                                </li>
                            </ul>
                        </footer>
                                              <!--弹出窗口 对修改进行操作-->                      
                        <div class="modal fade" id="operate4edit" role="dialog" aria-labelledby="gridSystemModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="margin-left: -100px;margin-right: -100px;">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="gridSystemModalLabel">Modify Config / 更改数据</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <form class="form-horizontal" method="post" action="submit-cert.php">
                                                <div class="form-group">
                                                    <label for="uidfromurl" class="col-xs-3 control-label">UID</br><font size="2" color="FF0000">(* Auto Fill / 自动填写)</font></label>
                                                    <div class="col-xs-8">
                                                        <input type="text" name="uidfromurl" readonly unselectable="on" value="<script></script>" class="form-control input-sm duiqi" id="uidfromurl" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="getcredit" class="col-xs-3 control-label">Edit Credit / 修改学时：</label>
                                                    <div class="col-xs-8 ">
                                                        <input type="text" name="wantcredit" class="form-control input-sm duiqi" id="wantcredit" placeholder="">
                                                    </div>
                                                </div>
                                               
												<div class="modal-footer">
                                                     <button type="button" class="btn btn-xs btn-xs btn-white" data-dismiss="modal">取 消</button>
                                                     <button type="submit" onclick="location.href='action-edit.php?uid={$row['uid']}'" name="submit" id="submit" class="btn btn-xs btn-xs btn-green">提 交</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                   
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                        <!--弹出窗口 上传志愿证明-->
                        <div class="modal fade" id="addSource" role="dialog" aria-labelledby="gridSystemModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="margin-left: -100px;margin-right: -100px;">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="gridSystemModalLabel">Upload Certification / 上传志愿证明</br><font size="3" color="FF0000">All Blanks Required. 所有字段均需填写</font></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <form class="form-horizontal" method="post" action="submit-cert.php">
                                                <div class="form-group">
                                                    <label for="time" class="col-xs-3 control-label">Name / 真实姓名</br><font size="2" color="FF0000">(* Auto Fill / 自动填写)</font></label>
                                                    <div class="col-xs-8">
                                                        <input type="text" name="username" value="<?php echo $_SESSION['entry_name']; ?>" class="form-control input-sm duiqi" id="username" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="place" class="col-xs-3 control-label">Place / 志愿地点：</label>
                                                    <div class="col-xs-8 ">
                                                        <input type="text" name="place" class="form-control input-sm duiqi" id="place" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="details" class="col-xs-3 control-label">Details / 志愿内容：</label>
                                                    <div class="col-xs-8 ">
                                                        <input type="text" name="details" class="form-control input-sm duiqi" id="details" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="time" class="col-xs-3 control-label">Time(Duration) / 志愿时间(段)</label>
                                                    <div class="col-xs-8">
                                                        <input type="text" name="time" class="form-control input-sm duiqi" id="time" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="wantcredit" class="col-xs-3 control-label">Credits You Want / 期望学时数：</label>
                                                    <div class="col-xs-8">
                                                        <input type="text" name="wantcredit" class="form-control input-sm duiqi" id="wantcredit" placeholder="">
                                                    </div>
                                                </div>
                                               
												<div class="modal-footer">
                                                     <button type="button" class="btn btn-xs btn-xs btn-white" data-dismiss="modal">取 消</button>
                                                     <button type="submit" name="submit" id="submit" class="btn btn-xs btn-xs btn-green">提 交</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                   
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

                        <!--修改资源弹出窗口-->
                        <div class="modal fade" id="changeSource" role="dialog" aria-labelledby="gridSystemModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="gridSystemModalLabel">修改资源</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <form class="form-horizontal">
                                                <div class="form-group ">
                                                    <label for="sName" class="col-xs-3 control-label">名称：</label>
                                                    <div class="col-xs-8 ">
                                                        <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sLink" class="col-xs-3 control-label">链接：</label>
                                                    <div class="col-xs-8 ">
                                                        <input type="" class="form-control input-sm duiqi" id="sLink" placeholder="">
                                                    </div>7897777667676767667
                                                </div>
                                                <div class="form-group">
                                                    <label for="sOrd" class="col-xs-3 control-label">排序：</label>
                                                    <div class="col-xs-8">
                                                        <input type="" class="form-control input-sm duiqi" id="sOrd" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sKnot" class="col-xs-3 control-label">父节点：</label>
                                                    <div class="col-xs-8">
                                                        <input type="" class="form-control input-sm duiqi" id="sKnot" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInput1" class="col-xs-3 control-label">资源类型：</label>
                                                    <div class="col-xs-8">
                                                        <label class="control-label" for="anniu">
                                                            <input type="radio" name="leixing" id="anniu">菜单</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <label class="control-label" for="meun">
                                                            <input type="radio" name="leixing" id="meun"> 按钮</label>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                        <button type="button" class="btn btn-xs btn-green">保 存</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                        <!--弹出删除资源警告窗口-->
                        <div class="modal fade" id="deleteSource" role="dialog" aria-labelledby="gridSystemModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="gridSystemModalLabel">提示</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            确定要删除该资源？删除后不可恢复！
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                        <button type="button" class="btn btn-xs btn-danger">保 存</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </div>
                    <!-- 账号（账户）管理模块 -->
                    <div role="tabpanel" class="tab-pane" id="user">
                        <div class="check-div">
                          <font color="FF0000">*</font> Refresh page to ensure all the data is the latest ! / 刷新页面以确保所有数据为最新 ！
                        </div>
                        <div class="data-div">
                            <div class="row tableHeader">
                               <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    ID
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                                    Status / 账户状态
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                                    Username / 用户名
                                </div>
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                                    Homeroom / 行政班
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                                    Total Credits / 总学时
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                                    Notes / 备注
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                                    Operate / 操作
                                </div>
                                 <!-- 此处第六列标题占位 -->
                              </div>                         
                            
                            <div class="tablebody">
<?php
//账号管理模块
error_reporting(0);                      
@mysql_connect("localhost","credit","your_password_here")or die;    //链接数据库
@mysql_select_db("credit")or die;    //选择数据库
if ($_SESSION['suadmin'] == 'yes'){
$query = @mysql_query("select * from user where ls='no'")or die;    //查询‘works’表中的所有记录
} else if ($_SESSION['suadmin'] == 'no'){
	$myteachroom=$_SESSION['teachroom'];
	$query = @mysql_query("select * from user where homeroom='$myteachroom'")or die;    //查询‘works’表中本账号执教班中学生的所有记录
}

$n=0;
while ($row = mysql_fetch_array($query))    //遍历‘works’表中的数据，并形成数组
{
    $id = $row['id'];    //使用键获取数组中对应的值
    $status = $row['status'];
    $username = $row['username'];
	$homeroom = $row['homeroom'];
    $totalcredit = $row['credit'];
    $note = $row['note'];
	$ls = $row['ls'];
	$ifadmin = $row['admin'];
	$ifsuadmin = $row['suadmin'];
   if ($status == '可用') {
     $statuscolor="#228B22";
     $statusview="Avail.可用";
   }
   else if ($status == '不可用') {
     $statuscolor="#4169e1";
     $statusview="Unavail.已停用";
   }
   
   if ($ls == 'yes') {
     $lsornot="<a href='https://verify.volunteer.ensonyan.com/OAuth2/myInfo/index.php?ref=vms-main-admcp&area=userlist&token=FoqXwKt0T59jDXrP' target='_blank' style='text-decoration:none' title='认证状态：领事认证' alt='认证状态：领事认证'><img src='/apps/vms/img/verify.png' width='20px' style='padding-bottom: 5px;padding-left: 2px' title='认证状态：领事认证' alt='认证状态：领事认证'><font color='#c18401' size='1px'>&nbsp;领事认证</font></a>";
   }
   else if ($ls == 'no') {
     $lsornot="";
   }
   
  if ($username == 'EnsonYan') {
    $maintenanceaccount = "<font color='#ff7d00'>M-运维&nbsp;</font>";
  } else if ($username == 'Admin') {
	  $maintenanceaccount = "<font color='#ff7d00'>M-运维&nbsp;</font>";
  } else {
    $maintenanceaccount = "";
  }
  
  $thisaccount=$_SESSION['entry_name'];
  
$sqlcredit = "SELECT sum( getcredit ) FROM `works` where username = '$username' AND status = '已通过'";
$querycredit = mysql_query($sqlcredit);
$finalcredit = mysql_result($querycredit,0);
mysql_query("UPDATE user SET credit = '$finalcredit' where username ='$username'");
    echo "<div class='row'>";
    echo "<div class='col-xs-1'>{$id}</div>";    //按照数据表的列在表格里输出对应数据
    echo "<div class='col-xs-1' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'><strong><font color='$statuscolor'>{$statusview}</font></strong></div>";
    echo "<div class='col-xs-2'>{$maintenanceaccount}{$username}{$lsornot}</div>";
	echo "<div class='col-xs-2'>{$homeroom} <button class='btn btn-info btn-xs' data-toggle='modal' onclick=\"location.href='edit-homeroom.php?uid={$row['id']}'\" data-target='#operate4edithomeroom'>Edit / 修改</button></div>";
    echo "<div class='col-xs-2'>{$totalcredit}</div>";
    echo "<div class='col-xs-2' style='white-space:nowrap;text-overflow:ellipsis;overflow:hidden;'><a href=\"javascript:alert('($note)');\">Click here. 点击查看备注</a></div>";
    if ($username == $thisaccount) { echo "This Account / 本账号"; } else if ($ifsuadmin == 'yes') { echo "No Permission / 无权限"; } else {
	echo "<div class='col-xs-2'><button type='button' class='btn btn-success btn-xs' onclick=\"location.href='account-enable.php?id={$row['id']}'\">Enable</button>
                                <button type='button' class='btn btn-danger btn-xs' onclick=\"location.href='account-stop.php?id={$row['id']}'\">Stop</button></div>";
	}
    echo "</div>";
    $n++;
/*    if($n>14){
        return;
    }*/
}    
?>
                      
                    </div>

                </div>
                <!--页码块-->
                <footer class="footer">
                    <ul class="pagination">
                        <li>
                            <select>
                                <option>1</option>

                            </select>
                            页
                        </li>
                        <li class="gray">
                            共1页
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-left">
                            </i>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-right">
                            </i>
                        </li>
                    </ul>
                </footer>
                <!--增加权限弹出窗口-->
                <div class="modal fade" id="addChar" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">添加权限</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form class="form-horizontal">
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">权限名：</label>
                                            <div class="col-xs-6 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sLink" class="col-xs-3 control-label">描述：</label>
                                            <div class="col-xs-6 ">
                                                <textarea class="form-control input-sm duiqi"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sOrd" class="col-xs-3 control-label">系统资源：</label>
                                            <div class="col-xs-6">
                                                <input type="" class="form-control input-sm duiqi" id="sOrd" placeholder="">
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-green">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!--修改权限弹出窗口-->
                <div class="modal fade" id="changeChar" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">修改权限</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form class="form-horizontal">
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">权限名：</label>
                                            <div class="col-xs-6 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sLink" class="col-xs-3 control-label">描述：</label>
                                            <div class="col-xs-6 ">
                                                <textarea class="form-control input-sm duiqi"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sOrd" class="col-xs-3 control-label">系统资源：</label>
                                            <div class="col-xs-6">
                                                <input type="" class="form-control input-sm duiqi" id="sOrd" placeholder="">
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-green">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!--弹出删除权限警告窗口-->
                <div class="modal fade" id="deleteChar" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">提示</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    确定要删除该权限？删除后不可恢复！
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-danger">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </div>
			
                    <!-- 领事（管理员）账号（账户）管理模块 -->
                    <div role="tabpanel" class="tab-pane" id="teacherctrl">
                        <div class="check-div">
                          <font color="FF0000">*</font> Refresh page to ensure all the data is the latest ! / 刷新页面以确保所有数据为最新 ！
                        </div>
                        <div class="data-div">
                            <div class="row tableHeader">
                               <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    ID
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                                    Status / 账户状态
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                                    Username / 领事姓名
                                </div>
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                                    Teachroom / 执教班
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                                    Notes / 备注
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                                    Operate / 操作
                                </div>
                                 <!-- 此处第六列标题占位 -->
                              </div>                         
                            
                            <div class="tablebody">
<?php
//领事账号管理模块（非超管只可修改自身信息）
error_reporting(0);                      
@mysql_connect("localhost","credit","your_password_here")or die;    //链接数据库
@mysql_select_db("credit")or die;    //选择数据库
$query = @mysql_query("select * from user where ls='yes'")or die;    //查询‘works’表中EnsonYan的所有记录

$n=0;
while ($row = mysql_fetch_array($query))    //遍历‘works’表中的数据，并形成数组
{
    $id = $row['id'];    //使用键获取数组中对应的值
    $status = $row['status'];
    $username = $row['username'];
	$teachroom = $row['teachroom'];
	$teachroom2 = $row['teachroom2'];
	$teachroom3 = $row['teachroom3'];
    $totalcredit = $row['credit'];
    $note = $row['note'];
	$ls = $row['ls'];
	$ifadmin = $row['admin'];
	$ifsuadmin = $row['suadmin'];
   if ($status == '可用') {
     $statuscolor="#228B22";
     $statusview="Avail.可用";
   }
   else if ($status == '不可用') {
     $statuscolor="#4169e1";
     $statusview="Unavail.已停用";
   }
   
   if ($ls == 'yes') {
     $lsornot="<a href='https://verify.volunteer.ensonyan.com/OAuth2/myInfo/index.php?ref=vms-main-admcp&area=userlist&token=FoqXwKt0T59jDXrP' target='_blank' style='text-decoration:none' title='认证状态：领事认证' alt='认证状态：领事认证'><img src='/apps/vms/img/verify.png' width='20px' style='padding-bottom: 5px;padding-left: 2px' title='认证状态：领事认证' alt='认证状态：领事认证'><font color='#c18401' size='1px'>&nbsp;领事认证</font></a>";
   }
   else if ($ls == 'no') {
     $lsornot="";
   }
   
  if ($username == 'EnsonYan') {
    $maintenanceaccount = "<font color='#ff7d00'>M-运维&nbsp;</font>";
  } else if ($username == 'Admin') {
	  $maintenanceaccount = "<font color='#ff7d00'>M-运维&nbsp;</font>";
  } else {
    $maintenanceaccount = "";
  }
  
  $thisaccount=$_SESSION['entry_name'];
  
$sqlcredit = "SELECT sum( getcredit ) FROM `works` where username = '$username' AND status = '已通过'";
$querycredit = mysql_query($sqlcredit);
$finalcredit = mysql_result($querycredit,0);
mysql_query("UPDATE user SET credit = '$finalcredit' where username ='$username'");
    echo "<div class='row'>";
    echo "<div class='col-xs-1'>{$id}</div>";    //按照数据表的列在表格里输出对应数据
    echo "<div class='col-xs-1' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'><strong><font color='$statuscolor'>{$statusview}</font></strong></div>";
    echo "<div class='col-xs-2'>{$maintenanceaccount}{$username}{$lsornot}</div>";
	echo "<div class='col-xs-2'><a href=\"javascript:alert('Teachroom List / 执教班列表\u000dTeachroom#1:$teachroom\u000dTeachroom#2:$teachroom2\u000dTeachroom#3:$teachroom3');\">See.查看</a><button class='btn btn-info btn-xs' data-toggle='modal' onclick=\"location.href='edit-teachroom.php?uid={$row['id']}'\" data-target='#operate4edithomeroom'>Edit/修改</button></div>";
    echo "<div class='col-xs-2' style='white-space:nowrap;text-overflow:ellipsis;overflow:hidden;'><a href=\"javascript:alert('($note)');\">Click here. 点击查看备注</a></div>";
    if ($username == $thisaccount) { echo "This Account / 本账号"; } else if ($ifsuadmin == 'yes') { echo "No Permission / 无权限"; } else if ($ifadmin == 'yes') { echo "No Permission / 无权限"; } else {
	echo "<div class='col-xs-2' style='background-color:#e74c3c;'><button type='button' class='btn btn-danger btn-xs' onclick=\"location.href='cancel_counselor.php?id={$row['id']}'\">Cancel Counselor / 取消领事权限</button></div>";
	}
    echo "</div>";
    $n++;
/*    if($n>14){
        return;
    }*/
}    
?>
                      
                    </div>

                </div>
                <!--页码块-->
                <footer class="footer">
                    <ul class="pagination">
                        <li>
                            <select>
                                <option>1</option>

                            </select>
                            页
                        </li>
                        <li class="gray">
                            共1页
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-left">
                            </i>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-right">
                            </i>
                        </li>
                    </ul>
                </footer>
                <!--增加权限弹出窗口-->
                <div class="modal fade" id="addChar" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">添加权限</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form class="form-horizontal">
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">权限名：</label>
                                            <div class="col-xs-6 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sLink" class="col-xs-3 control-label">描述：</label>
                                            <div class="col-xs-6 ">
                                                <textarea class="form-control input-sm duiqi"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sOrd" class="col-xs-3 control-label">系统资源：</label>
                                            <div class="col-xs-6">
                                                <input type="" class="form-control input-sm duiqi" id="sOrd" placeholder="">
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-green">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!--修改权限弹出窗口-->
                <div class="modal fade" id="changeChar" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">修改权限</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form class="form-horizontal">
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">权限名：</label>
                                            <div class="col-xs-6 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sLink" class="col-xs-3 control-label">描述：</label>
                                            <div class="col-xs-6 ">
                                                <textarea class="form-control input-sm duiqi"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sOrd" class="col-xs-3 control-label">系统资源：</label>
                                            <div class="col-xs-6">
                                                <input type="" class="form-control input-sm duiqi" id="sOrd" placeholder="">
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-green">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!--弹出删除权限警告窗口-->
                <div class="modal fade" id="deleteChar" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">提示</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    确定要删除该权限？删除后不可恢复！
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-danger">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </div>
			
			        <!-- 账号提权管理模块 -->
                    <div role="tabpanel" class="tab-pane" id="setteacher">
                        <div class="check-div">
                          <font color="FF0000">*</font> Refresh page to ensure all the data is the latest ! / 刷新页面以确保所有数据为最新 ！
                        </div>
                        <div class="data-div">
                            <div class="row tableHeader">
                               <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    ID
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                                    Status / 账户状态
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                                    Username / 用户名
                                </div>
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                                    Homeroom / 行政班
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                                    Normal Operate / 普通操作
                                </div>
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                                    Danger Zone / 危险区
                                </div>
                                 <!-- 此处第六列标题占位 -->
                              </div>                         
                            
                            <div class="tablebody">
<?php
//账号管理模块
error_reporting(0);                      
@mysql_connect("localhost","credit","your_password_here")or die;    //链接数据库
@mysql_select_db("credit")or die;    //选择数据库
if ($_SESSION['suadmin'] == 'yes'){
$query = @mysql_query("select * from user where ls='no'")or die;    //查询‘works’表中的所有记录
} else if ($_SESSION['suadmin'] == 'no'){
	$myteachroom=$_SESSION['teachroom'];
	$query = @mysql_query("select * from user where homeroom='$myteachroom'")or die;    //查询‘works’表中本账号执教班中学生的所有记录
}

$n=0;
while ($row = mysql_fetch_array($query))    //遍历‘works’表中的数据，并形成数组
{
    $id = $row['id'];    //使用键获取数组中对应的值
    $status = $row['status'];
    $username = $row['username'];
	$homeroom = $row['homeroom'];
    $totalcredit = $row['credit'];
    $note = $row['note'];
	$ls = $row['ls'];
	$ifadmin = $row['admin'];
	$ifsuadmin = $row['suadmin'];
   if ($status == '可用') {
     $statuscolor="#228B22";
     $statusview="Avail.可用";
   }
   else if ($status == '不可用') {
     $statuscolor="#4169e1";
     $statusview="Unavail.已停用";
   }
   
   if ($ls == 'yes') {
     $lsornot="<a href='https://verify.volunteer.ensonyan.com/OAuth2/myInfo/index.php?ref=vms-main-admcp&area=userlist&token=FoqXwKt0T59jDXrP' target='_blank' style='text-decoration:none' title='认证状态：领事认证' alt='认证状态：领事认证'><img src='/apps/vms/img/verify.png' width='20px' style='padding-bottom: 5px;padding-left: 2px' title='认证状态：领事认证' alt='认证状态：领事认证'><font color='#c18401' size='1px'>&nbsp;领事认证</font></a>";
   }
   else if ($ls == 'no') {
     $lsornot="";
   }
   
  if ($username == 'EnsonYan') {
    $maintenanceaccount = "<font color='#ff7d00'>M-运维&nbsp;</font>";
  } else if ($username == 'Admin') {
	  $maintenanceaccount = "<font color='#ff7d00'>M-运维&nbsp;</font>";
  } else {
    $maintenanceaccount = "";
  }
  
  $thisaccount=$_SESSION['entry_name'];
  
$sqlcredit = "SELECT sum( getcredit ) FROM `works` where username = '$username' AND status = '已通过'";
$querycredit = mysql_query($sqlcredit);
$finalcredit = mysql_result($querycredit,0);
mysql_query("UPDATE user SET credit = '$finalcredit' where username ='$username'");
    echo "<div class='row'>";
    echo "<div class='col-xs-1'>{$id}</div>";    //按照数据表的列在表格里输出对应数据
    echo "<div class='col-xs-1' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'><strong><font color='$statuscolor'>{$statusview}</font></strong></div>";
    echo "<div class='col-xs-2'>{$maintenanceaccount}{$username}{$lsornot}</div>";
	echo "<div class='col-xs-2'>{$homeroom} <button class='btn btn-info btn-xs' data-toggle='modal' onclick=\"location.href='edit-homeroom.php?uid={$row['id']}'\" data-target='#operate4edithomeroom'>Edit / 修改</button></div>";
    if ($username == $thisaccount) { echo "<div class='col-xs-2' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>This Account / 本账号</div>"; } else if ($ifsuadmin == 'yes') { echo "<div class='col-xs-2' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>No Permission / 无权限</div>"; } else {
	echo "<div class='col-xs-2'><button type='button' class='btn btn-success btn-xs' onclick=\"location.href='account-enable.php?id={$row['id']}'\">Enable</button>
                                <button type='button' class='btn btn-danger btn-xs' onclick=\"location.href='account-stop.php?id={$row['id']}'\">Stop</button></div>";
	}
	echo "<div class='col-xs-2' style='background-color:#d97b7194;'><button type='button' class='btn btn-danger btn-xs' onclick=\"location.href='set_counselor.php?id={$row['id']}'\">Set Counselor / 设为领事</button></div>";
    echo "</div>";
    $n++;
/*    if($n>14){
        return;
    }*/
}    
?>
                      
                    </div>

                </div>
                <!--页码块-->
                <footer class="footer">
                    <ul class="pagination">
                        <li>
                            <select>
                                <option>1</option>

                            </select>
                            页
                        </li>
                        <li class="gray">
                            共1页
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-left">
                            </i>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-right">
                            </i>
                        </li>
                    </ul>
                </footer>
                <!--增加权限弹出窗口-->
                <div class="modal fade" id="addChar" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">添加权限</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form class="form-horizontal">
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">权限名：</label>
                                            <div class="col-xs-6 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sLink" class="col-xs-3 control-label">描述：</label>
                                            <div class="col-xs-6 ">
                                                <textarea class="form-control input-sm duiqi"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sOrd" class="col-xs-3 control-label">系统资源：</label>
                                            <div class="col-xs-6">
                                                <input type="" class="form-control input-sm duiqi" id="sOrd" placeholder="">
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-green">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!--修改权限弹出窗口-->
                <div class="modal fade" id="changeChar" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">修改权限</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form class="form-horizontal">
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">权限名：</label>
                                            <div class="col-xs-6 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sLink" class="col-xs-3 control-label">描述：</label>
                                            <div class="col-xs-6 ">
                                                <textarea class="form-control input-sm duiqi"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sOrd" class="col-xs-3 control-label">系统资源：</label>
                                            <div class="col-xs-6">
                                                <input type="" class="form-control input-sm duiqi" id="sOrd" placeholder="">
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-green">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!--弹出删除权限警告窗口-->
                <div class="modal fade" id="deleteChar" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">提示</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    确定要删除该权限？删除后不可恢复！
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-danger">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </div>
			
            <!--证明管理模块-->
            <div role="tabpanel" class="tab-pane" id="cert">
                <div class="check-div form-inline">
                    <font color="FF0000">* Attention / 注意</font>&nbsp;Operation here is same as the Auditing panel. / 此处审核操作与审核模块操作互通
                </div>
                <div class="data-div">
                    <div class="row tableHeader">
                        <div class="col-xs-2 ">
                            ID
                        </div>
                        <div class="col-xs-2">
                            Name / 姓名
                        </div>
                        <div class="col-xs-2">
                            Status / 状态
                        </div>
                        <div class="col-xs-3">
                            File / 文件
                        </div>
                        <div class="col-xs-3">
                            Operate / 操作
                        </div>
                    </div>
                    <div class="tablebody">

<?php
//证明文件模块
@mysql_connect("localhost","credit","your_password_here")or die;    //链接数据库
@mysql_select_db("credit")or die;    //选择数据库
$query = @mysql_query("select * from works where status = '待审核'")or die;    //查询‘works’表中的所有记录 (如需每班单独设置管理员账号，此处应该改为 "select * from works where homeroom='$teachroom'")

$n=0;
while ($row = mysql_fetch_array($query))    //遍历‘works’表中的数据，并形成数组
{
    $uid = $row['uid'];
	$un = $row['username'];
    $status = $row['status'];
    $photodirfromdb = $row['photo'];
  
   if ($status == '待审核') {
     $statuscolor="#4169E1";
   }
   if ($status == '已通过') {
     $statuscolor="#228B22";
   }
   if ($status == '已驳回') {
     $statuscolor="#FF0000";
   }
  
   if ($photodirfromdb == '无证明文件') {
     $photodir="<a href=\"javascript:alert('User didn\'t upload certification file for this application. / 申请人未上传图片或其他证明文件');\">No file. 无证明文件</a>";
   } else {
     $photodir="<a href=\"/apps/vms/plugin/iu_module/$photodirfromdb\" target='_blank'>Click to view. 点击查看附件</a>";
   }
  
    echo "<div class='row'>";
    echo "<div class='col-xs-2'>{$uid}</div>";
	echo "<div class='col-xs-2'>{$un}</div>";
    echo "<div class='col-xs-2'><font color='$statuscolor'>{$status}</font></div>";
    echo "<div class='col-xs-3'><font color='#05a'>{$photodir}</font></div>";
    echo "<div class='col-xs-3'><button type='button' class='btn btn-success btn-xs' onclick=\"location.href='action-conf.php?uid={$row['uid']}&username=$dbusername'\">CONF</button>
                                <button type='button' class='btn btn-danger btn-xs' onclick=\"location.href='action-rej.php?uid={$row['uid']}&username=$dbusername'\">REJ</button></div>";
    echo "</div>";
    $n++;
/*    if($n>14){
        return;
    }*/
}
mysql_free_result($result);
mysql_close();
?>

                    </div>

                </div>
                <!--页码块-->
                <footer class="footer">
                    <ul class="pagination">
                        <li>
                            <select>
                                <option>1</option>
                            </select>
                            页
                        </li>
                        <li class="gray">
                            共1页
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-left">
                            </i>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-right">
                            </i>
                        </li>
                    </ul>
                </footer>

                <!--弹出添加用户窗口-->
                <div class="modal fade" id="addUser" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">添加用户</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form class="form-horizontal">
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">用户名：</label>
                                            <div class="col-xs-8 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sLink" class="col-xs-3 control-label">真实姓名：</label>
                                            <div class="col-xs-8 ">
                                                <input type="" class="form-control input-sm duiqi" id="sLink" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sOrd" class="col-xs-3 control-label">电子邮箱：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm duiqi" id="sOrd" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sKnot" class="col-xs-3 control-label">电话：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm duiqi" id="sKnot" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sKnot" class="col-xs-3 control-label">地区：</label>
                                            <div class="col-xs-8">
                                                <select class=" form-control select-duiqi">
                                                    <option value="">国际关系地区</option>
                                                    <option value="">Area</option>
                                                    <option value="">Place</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sKnot" class="col-xs-3 control-label">权限：</label>
                                            <div class="col-xs-8">
                                                <select class=" form-control select-duiqi">
                                                    <option value="">管理员</option>
                                                    <option value="">普通用户</option>
                                                    <option value="">游客</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="situation" class="col-xs-3 control-label">状态：</label>
                                            <div class="col-xs-8">
                                                <label class="control-label" for="anniu">
                                                    <input type="radio" name="situation" id="normal">正常</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <label class="control-label" for="meun">
                                                    <input type="radio" name="situation" id="forbid"> 禁用</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-green">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!--弹出修改用户窗口-->
                <div class="modal fade" id="reviseUser" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">修改用户</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form class="form-horizontal">
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">用户名：</label>
                                            <div class="col-xs-8 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sLink" class="col-xs-3 control-label">真实姓名：</label>
                                            <div class="col-xs-8 ">
                                                <input type="" class="form-control input-sm duiqi" id="sLink" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sOrd" class="col-xs-3 control-label">电子邮箱：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm duiqi" id="sOrd" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sKnot" class="col-xs-3 control-label">电话：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm duiqi" id="sKnot" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sKnot" class="col-xs-3 control-label">地区：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm duiqi" id="sKnot" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sKnot" class="col-xs-3 control-label">权限：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm duiqi" id="sKnot" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="situation" class="col-xs-3 control-label">状态：</label>
                                            <div class="col-xs-8">
                                                <label class="control-label" for="anniu">
                                                    <input type="radio" name="situation" id="normal">正常</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <label class="control-label" for="meun">
                                                    <input type="radio" name="situation" id="forbid"> 禁用</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-green">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!--弹出删除用户警告窗口-->
                <div class="modal fade" id="deleteUser" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">提示</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    确定要删除该用户？删除后不可恢复！
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn  btn-xs btn-danger">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </div>
            <!-- 修改行政班模块 -->
            <div role="tabpanel" class="tab-pane" id="chanclass">
                <div class="check-div">
                    Change Homeroom - 批量修改学生所在行政班
                </div>
                <div style="padding: 50px 0;margin-top: 50px;background-color: #fff; text-align: right;width: 420px;margin: 50px auto;">
                    <form class="form-horizontal" method="post" action="change-homeroom.php" onsubmit="return alter()">
                        <div class="form-group">
                          <label for="sKnot" class="col-xs-4 control-label">Original Homeroom - 原行政班</label>
                            <div class="col-xs-5">
                        <select name="oldhomeroom">
                            <option value="Homeroom" style="display: none">Homeroom 选择行政班</option>
                            <option value="Pre10-01">Pre10-01</option>
                            <option value="Pre10-02">Pre10-02</option>
                            <option value="Pre10-03">Pre10-03</option>
                            <option value="1001">1001</option>
                            <option value="1002">1002</option>
                            <option value="1003">1003</option>
                            <option value="1004">1004</option>
                            <option value="1005">1005</option>
                            <option value="1006">1006</option>
                            <option value="1007">1007</option>
                            <option value="1101">1101</option>
                            <option value="1102">1102</option>
                            <option value="1103">1103</option>
                            <option value="1104">1104</option>
                            <option value="1105">1105</option>
                            <option value="1106">1106</option>
                            <option value="1107">1107</option>
                            <option value="1201">1201</option>
                            <option value="1202">1202</option>
                            <option value="1203">1203</option>
                            <option value="1204">1204</option>
                            <option value="1205">1205</option>
                            <option value="1206">1206</option>
                            <option value="1207">1207</option>
                        </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sKnot" class="col-xs-4 control-label">Target Homeroom - 新行政班</label>
                            <div class="col-xs-5">
                        <select name="newhomeroom">
                            <option value="Homeroom" style="display: none">Homeroom 选择行政班</option>
                            <option value="Pre10-01">Pre10-01</option>
                            <option value="Pre10-02">Pre10-02</option>
                            <option value="Pre10-03">Pre10-03</option>
                            <option value="1001">1001</option>
                            <option value="1002">1002</option>
                            <option value="1003">1003</option>
                            <option value="1004">1004</option>
                            <option value="1005">1005</option>
                            <option value="1006">1006</option>
                            <option value="1007">1007</option>
                            <option value="1101">1101</option>
                            <option value="1102">1102</option>
                            <option value="1103">1103</option>
                            <option value="1104">1104</option>
                            <option value="1105">1105</option>
                            <option value="1106">1106</option>
                            <option value="1107">1107</option>
                            <option value="1201">1201</option>
                            <option value="1202">1202</option>
                            <option value="1203">1203</option>
                            <option value="1204">1204</option>
                            <option value="1205">1205</option>
                            <option value="1206">1206</option>
                            <option value="1207">1207</option>
                        </select>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <div class="col-xs-offset-4 col-xs-5" style="margin-left: 169px;">
                                <button type="reset" class="btn btn-xs btn-white">Cancel / 取消</button>
                                <button type="submit" class="btn btn-xs btn-green">OK / 提交</button>
                            </div>
                        </div>
                    </form>
    <script type="text/javascript"> 
      document.getElementById("username").value="<?php echo $username; ?>"
    </script>
<script type="text/javascript"> 

    function alter() { 

        

      var username=document.getElementById("username").value; 

      var oldpassword=document.getElementById("oldpassword").value; 

      var newpassword=document.getElementById("newpassword").value; 

      var assertpassword=document.getElementById("assertpassword").value; 

      var regex=/^[/s]+$/; 

      if(regex.test(username)||username.length==0){ 

        alert("Username format error. / 用户名格式错误"); 

        return false; 

      } 

      if(regex.test(oldpassword)||oldpassword.length==0){ 

        alert("Password format error. / 密码格式错误"); 

        return false; 

      } 

      if(regex.test(newpassword)||newpassword.length==0) { 

        alert("New password format error. / 新密码格式错误"); 

        return false; 

      } 

      if (assertpassword != newpassword||assertpassword==0) { 

        alert("New password retype check failed. / 两次密码输入不一致"); 

        return false; 

      } 

      return true; 

  

    } 

  </script>
                </div>

            </div>
            <!--地区管理模块-->
            <div role="tabpanel" class="tab-pane" id="scho">

                <div class="check-div form-inline">
                    <div class="col-xs-3">
                        <button class="btn btn-yellow btn-xs" data-toggle="modal" data-target="#addSchool">添加地区 </button>
                    </div>
                    <div class="col-lg-4 col-xs-5">
                        <input type="text" class=" form-control input-sm " placeholder="输入文字搜索">
                        <button class="btn btn-white btn-xs ">查 询 </button>
                    </div>
                    <div class="col-lg-3 col-lg-offset-1 col-xs-3" style="padding-right: 40px;text-align: right;float: right;">
                        <label for="paixu">排序:&nbsp;</label>
                        <select class="form-control">
                            <option>地区</option>
                            <option>排名</option>
                        </select>
                    </div>
                </div>
                <div class="data-div">
                    <div class="row tableHeader">
                        <div class="col-xs-1 ">
                            编码
                        </div>
                        <div class="col-xs-2 ">
                            地区
                        </div>
                        <div class="col-xs-1">
                            1
                        </div>
                        <div class="col-xs-1">
                            2
                        </div>
                        <div class="col-xs-2">
                            Info
                        </div>
                        <div class="col-xs-2">
                            人员列表
                        </div>
                        <div class="col-xs-2">
                            操作
                        </div>
                    </div>
                    <div class="tablebody">

                        <div class="row">
                            <div class="col-xs-1 ">
                                1
                            </div>
                            <div class="col-xs-2">
                                地区
                            </div>
                            <div class="col-xs-1">
                                45.0
                            </div>
                            <div class="col-xs-1">
                                95.90
                            </div>
                            <div class="col-xs-2">
                                <a class="linkCcc">查看</a>
                            </div>
                            <div class="col-xs-2">
                                <a class="linkCcc">查看</a>
                            </div>
                            <div class="col-xs-2">
                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#reviseSchool">修改</button>
                                <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteSchool">删除</button>
                            </div>
                        </div>

                    </div>

                </div>
                <!--页码块-->
                <footer class="footer">
                    <ul class="pagination">
                        <li>
                            <select>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                            页
                        </li>
                        <li class="gray">
                            共20页
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-left">
                            </i>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-right">
                            </i>
                        </li>
                    </ul>
                </footer>

                <!--弹出添加用户窗口-->
                <div class="modal fade" id="addSchool" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">添加地区</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form class="form-horizontal">
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">地区名称：</label>
                                            <div class="col-xs-8 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">1：</label>
                                            <div class="col-xs-8 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sLink" class="col-xs-3 control-label">2：</label>
                                            <div class="col-xs-8 ">
                                                <input type="" class="form-control input-sm duiqi" id="sLink" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sOrd" class="col-xs-3 control-label">简称：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm duiqi" id="sOrd" placeholder="">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-green">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!--弹出修改用户窗口-->
                <div class="modal fade" id="reviseSchool" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">修改地区</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form class="form-horizontal">
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">地区名称：</label>
                                            <div class="col-xs-8 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">1：</label>
                                            <div class="col-xs-8 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sLink" class="col-xs-3 control-label">2：</label>
                                            <div class="col-xs-8 ">
                                                <input type="" class="form-control input-sm duiqi" id="sLink" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sOrd" class="col-xs-3 control-label">简称：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm duiqi" id="sOrd" placeholder="">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-green">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!--弹出删除用户警告窗口-->
                <div class="modal fade" id="deleteSchool" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">提示</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    确定要删除该地区？删除后不可恢复！
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-danger">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </div>
            <!--规则管理模块-->
            <div role="tabpanel" class="tab-pane" id="rule" style="padding-top: 50px;">
                <div class="data-div">
                    <div class="tablebody col-lg-10 col-lg-offset-1">
                        <div class="row">
                            <div class="col-xs-3" style="padding-right: 0;">签到超时时间</div>
                            <div class="col-xs-7 expand-col">
                                <div class="slider-minmax1">
                                </div>
                                <div class="row top100">
                                    <span class="left">0</span>
                                    <span class="right">30</span>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <button class="btn btn-xs btn-white">默认值</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3" style="padding-right: 0;">超时时间</div>
                            <div class="col-xs-7 expand-col">
                                <div class="slider-minmax2">
                                </div>
                                <div class="row top100">
                                    <span class="left">0</span>
                                    <span class="right">15</span>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <button class="btn btn-xs btn-white">默认值</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-3" style="padding-right: 0;">2超时时间</div>
                            <div class="col-xs-7 expand-col">
                                <div class="slider-minmax3">
                                </div>
                                <div class="row top100">
                                    <span class="left">0</span>
                                    <span class="right">60</span>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <button class="btn btn-xs btn-white">默认值</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3" style="padding-right: 0;">冻结上限</div>
                            <div class="col-xs-7 expand-col">
                                <div class="slider-minmax4">
                                </div>
                                <div class="row top100">
                                    <span class="left">0</span>
                                    <span class="right">100</span>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <button class="btn btn-xs btn-white">默认值</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3" style="padding-right: 0;">可预约数</div>
                            <div class="col-xs-7 expand-col">
                                <div class="slider-minmax5">
                                </div>
                                <div class="row top100">
                                    <span class="left">0</span>
                                    <span class="right">7</span>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <button class="btn btn-xs btn-white">默认值</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3" style="padding-right: 0;">最大未完成预约数</div>
                            <div class="col-xs-7 expand-col">
                                <div class="slider-minmax6">
                                </div>
                                <div class="row top100">
                                    <span class="left">0</span>
                                    <span class="right">10</span>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <button class="btn btn-xs btn-white">默认值</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                            <button type="button" class="btn btn-xs btn-green">保 存</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--证明管理模块-->
            <div role="tabpanel" class="tab-pane" id="syslog">
                <div class="check-div form-inline">
                    <font color="FF0000">* Attention / 注意</font>&nbsp;In safety considerations, system log cannot be deleted manually. / 出于安全考量，系统日志将会永久保存，无法人为删除。
                </div>
                <div class="data-div">
                    <div class="row tableHeader">
                        <div class="col-xs-1 ">
                            ID
                        </div>
                        <div class="col-xs-2">
                            Time / 操作时间
                        </div>
                        <div class="col-xs-1" style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>
                            Client(客户端) IP
                        </div>
                        <div class="col-xs-1" style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>
                            Module / 模块
                        </div>
                        <div class="col-xs-2">
                            OP Type / 行为类型
                        </div>
						<div class="col-xs-2">
                            Event(事件) ID
                        </div>
						<div class="col-xs-2">
                            Visit URL / 访问路径
                        </div>
                    </div>
                    <div class="tablebody">

<?php
//证明文件模块
@mysql_connect("localhost","credit","your_password_here")or die;    //链接数据库
@mysql_select_db("credit")or die;    //选择数据库
$query = @mysql_query("select * from illegaloperation")or die;

$n=0;
while ($row = mysql_fetch_array($query))    //遍历‘works’表中的数据，并形成数组
{
    $uid = $row['uid'];
	$time = $row['timestamp'];
    $ip = $row['ip'];
    $module = $row['module'];
	$optype = $row['optype'];
	$operator = $row['operator'];
	$eventID = $row['eventID'];
	$visiturl = $row['visiturl'];
  
    echo "<div class='row'>";
    echo "<div class='col-xs-1'>{$uid}</div>";
	echo "<div class='col-xs-2' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>{$time}</div>";
    echo "<div class='col-xs-1' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>{$ip}</font></div>";
    echo "<div class='col-xs-1'><font color='#05a'>{$module}</font></div>";
    echo "<div class='col-xs-2'>{$optype}</div>";
	echo "<div class='col-xs-2' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>{$eventID}</div>";
	echo "<div class='col-xs-2' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'><a href=\"javascript:alert('($visiturl)');\">Click to view. 点击查看完整路径</a></div>";
    echo "</div>";
    $n++;
/*    if($n>14){
        return;
    }*/
}
mysql_free_result($result);
mysql_close();
?>

                    </div>

                </div>
                <!--页码块-->
                <footer class="footer">
                    <ul class="pagination">
                        <li>
                            <select>
                                <option>1</option>
                            </select>
                            页
                        </li>
                        <li class="gray">
                            共1页
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-left">
                            </i>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-right">
                            </i>
                        </li>
                    </ul>
                </footer>

                <!--弹出增加时间段窗口-->
                <div class="modal fade" id="addTime" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">时间段设置</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form class="form-horizontal">
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">开始时间：</label>
                                            <div class="col-xs-8 ">
                                                <input type="email" class="form-control input-sm" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">结束时间：</label>
                                            <div class="col-xs-8 ">
                                                <input type="email" class="form-control input-sm" id="sName" placeholder="">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-green">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!--修改增加时间段窗口-->
                <div class="modal fade" id="changeTime" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">修改时间段</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form class="form-horizontal">
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">开始时间：</label>
                                            <div class="col-xs-8 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">结束时间：</label>
                                            <div class="col-xs-8 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-green btn-xs">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!--弹出删除时间段警告窗口-->
                <div class="modal fade" id="deleteTime" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">提示</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    确定要删除该时间段？
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-danger btn-xs">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </div>
            <!--座位管理模块-->
            <div role="tabpanel" class="tab-pane" id="sitt">

                <div class="check-div form-inline" style="">
                    <div class="col-lg-4 col-xs-7 col-md-6">
                        <button class="btn btn-yellow btn-xs" data-toggle="modal" data-target="#addBuilding">添加 </button>
                        <label for="paixu">楼宇:&nbsp;</label>
                        <select class=" form-control">
                            <option>第一</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                        <button class="btn btn-white btn-xs ">修 改</button>
                    </div>
                    <div class="col-lg-4 col-lg-offset-4 col-xs-4 col-md-5 " style="padding-right: 40px;text-align: right;">
                        <input type="text" class=" form-control input-sm " placeholder="输入文字搜索">
                        <button class="btn btn-white btn-xs ">查 询 </button>
                    </div>
                </div>
                <div class="data-div">
                    <div class="row tableHeader">
                        <div class="col-xs-2 "style="padding-left: 20px;">
                            1
                        </div>
                        <div class="col-xs-3"style="padding-left: 20px;">
                            2
                        </div>
                        <div class="col-xs-2" style="padding-left: 2px;">
                            3
                        </div>
                        <div class="col-xs-2">
                            4
                        </div>
                        <div class="col-xs-3">
                            操作
                        </div>
                    </div>
                    <div class="tablebody">

                        <div class="sitTable">
                            <table class="table  table-responsive">
                                <tr>
                                    <td valign="middle" class="col-xs-2" rowspan="3">A1</td>
                                    <td class="col-xs-3">1</td>
                                    <td class="col-xs-2">2</td>
                                    <td class="col-xs-2" style="padding-left: 40px!important;">3</td>
                                    <td class="col-xs-3"style="padding-left: 50px!important;">
                                        <a class="linkCcc" href="#sitDetail" aria-controls="char" role="tab" data-toggle="tab">信息</a>
                                        <a class="linkCcc" href="#time" aria-controls="char" role="tab" data-toggle="tab">设置</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-xs-3">1</td>
                                    <td class="col-xs-2">2</td>
                                    <td class="col-xs-2" style="padding-left: 40px!important;">3</td>
                                    <td class="col-xs-3"style="padding-left: 50px!important;">
                                        <a class="linkCcc" href="#sitDetail" aria-controls="char" role="tab" data-toggle="tab">信息</a>
                                        <a class="linkCcc" href="#time" aria-controls="char" role="tab" data-toggle="tab">设置</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-xs-3">1</td>
                                    <td class="col-xs-2">2</td>
                                    <td class="col-xs-2" style="padding-left: 40px!important;">3</td>
                                    <td class="col-xs-3"style="padding-left: 50px!important;">
                                        <a class="linkCcc" href="#sitDetail" aria-controls="char" role="tab" data-toggle="tab">信息</a>
                                        <a class="linkCcc" href="#time" aria-controls="char" role="tab" data-toggle="tab">设置</a>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>

                </div>
                <!--页码块-->
                <footer class="footer">
                    <ul class="pagination">
                        <li>
                            <select>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                            页
                        </li>
                        <li class="gray">
                            共20页
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-left">
                            </i>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-right">
                            </i>
                        </li>
                    </ul>
                </footer>

                <!--弹出添加楼宇窗口-->
                <div class="modal fade" id="addBuilding" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">添加</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form class="form-horizontal">
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">A：</label>
                                            <div class="col-xs-8 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sLink" class="col-xs-3 control-label">域：</label>
                                            <div class="col-xs-8 ">
                                                <input type="" class="form-control input-sm duiqi" id="sLink" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sOrd" class="col-xs-3 control-label">位数：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm duiqi" id="sOrd" placeholder="">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-green">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!--弹出修改用户窗口-->
                <div class="modal fade" id="reviseUser" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">修改用户</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form class="form-horizontal">
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">用户名：</label>
                                            <div class="col-xs-8 ">
                                                <input type="email" class="form-control input-sm" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sLink" class="col-xs-3 control-label">真实姓名：</label>
                                            <div class="col-xs-8 ">
                                                <input type="" class="form-control input-sm" id="sLink" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sOrd" class="col-xs-3 control-label">电子邮箱：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm" id="sOrd" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sKnot" class="col-xs-3 control-label">电话：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm" id="sKnot" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sKnot" class="col-xs-3 control-label">地区：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm" id="sKnot" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sKnot" class="col-xs-3 control-label">权限：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm" id="sKnot" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="situation" class="col-xs-3 control-label">状态：</label>
                                            <div class="col-xs-8">
                                                <label class="control-label" for="anniu">
                                                    <input type="radio" name="situation" id="normal">正常</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <label class="control-label" for="meun">
                                                    <input type="radio" name="situation" id="forbid"> 禁用</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-green">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!--弹出删除用户警告窗口-->
                <div class="modal fade" id="deleteUser" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">提示</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    确定要删除该用户？删除后不可恢复！
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-green btn-xs">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>
            <!--座位详情模块-->
            <div role="tabpanel" class="tab-pane" id="sitDetail">
                <div class="check-div form-inline">
                    <span href="#sitt" aria-controls="sitt" role="tab" data-toggle="tab" style="cursor: pointer;"><span class="glyphicon glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;返回上一页</span>
                </div>
                <div class="data-div">
                    <div class="row tableHeader">
                        <div class="col-xs-6 ">
                            编码
                        </div>
                        <div class="col-xs-6 ">
                            名称
                        </div>

                    </div>
                    <div class="tablebody">

                        <div class="row">
                            <div class="col-xs-6 ">
                                sad2345fas345533
                            </div>
                            <div class="col-xs-6">
                                ka
                            </div>

                        </div>

                    </div>

                </div>
                <!--页码块-->
                <footer class="footer">
                    <ul class="pagination">
                        <li>
                            <select>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                            页
                        </li>
                        <li class="gray">
                            共20页
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-left">
                            </i>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-right">
                            </i>
                        </li>
                    </ul>
                </footer>

            </div>
            <!--实名管理模块-->
            <div role="tabpanel" class="tab-pane" id="rnauth">
                <div class="check-div form-inline">
                   <font color="FF0000">*</font> Only the content which is waiting for audit or rejected will show here. / 本页面仅显示待审核与未通过条目
                </div>
                <div class="data-div">
                    <div class="row tableHeader">
                        <div class="col-xs-1" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                            Username / 帐号
                        </div>
                        <div class="col-xs-1" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                            Type / 证件类型
                        </div>
                        <div class="col-xs-2">
                            NO. / 证件号
                        </div>
                        <div class="col-xs-1" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                            Name / 姓名
                        </div>
                        <div class="col-xs-1" style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>
                            Stu NO. / 学号
                        </div>
                        <div class="col-xs-2" style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>
                            PowerSchool 密码(PWD)
                        </div>
                        <div class="col-xs-2">
                            Status / 状态
                        </div>
                        <div class="col-xs-2">
                            Operate / 操作
                        </div>
                    </div>
                    <div class="tablebody">
              
<?php
    error_reporting(0);                      
@mysql_connect("localhost","credit","your_password_here")or die;    //链接数据库
@mysql_select_db("credit")or die;    //选择数据库
$query = @mysql_query("select * from user where verify = '待审核' or verify = '未通过'")or die;    //查询‘works’表中EnsonYan的所有记录

$n=0;
while ($row = mysql_fetch_array($query))    //遍历‘works’表中的数据，并形成数组
{
    $un = $row['username'];    //使用键获取数组中对应的值
    $vstatusdb = $row['verify'];
    $vt = $row['vtype'];
    $vno = $row['vnumber'];
    $vn = $row['vname'];
    $vs = $row['vsno'];
    $pspw = $row['pspassword'];
	$ls = $row['ls'];
  
   if ($vt == 'idcard') {
     $vtxs = "ID Card / 身份证";
   } else if ($vt == 'passport') {
     $vtxs = "Passport / 护照";
   } else if ($vt == 'other') {
     $vtxs = "Others / 其他";
   }
  
   if ($vstatusdb == '待审核') {
     $vstatuscolor="#05a";
     $vstatusview="Auditing.待审核";
   }
   else if ($vstatusdb == '未通过') {
     $vstatuscolor="#FF0000";
     $vstatusview="Rejected.未通过";
   }
   
   if ($ls == 'yes') {
     $lsornot="<a href='https://verify.volunteer.ensonyan.com/OAuth2/myInfo/index.php?ref=vms-main-admcp&area=userlist&token=FoqXwKt0T59jDXrP' target='_blank' style='text-decoration:none' title='认证状态：领事认证' alt='认证状态：领事认证'><img src='/apps/vms/img/verify.png' width='20px' style='padding-bottom: 5px;padding-left: 2px' title='认证状态：领事认证' alt='认证状态：领事认证'><font color='#c18401' size='1px'>&nbsp;领事认证</font></a>";
   }
   else if ($ls == 'no') {
     $lsornot="";
   }
   
    echo "<div class='row'>";
    echo "<div class='col-xs-1'>{$un}</div>";    //按照数据表的列在表格里输出对应数据
    echo "<div class='col-xs-1' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'><strong><font color='#05a'>{$vtxs}</font></strong></div>";
    echo "<div class='col-xs-2'>{$vno}</div>";
    echo "<div class='col-xs-1'>{$vn}</div>";
    echo "<div class='col-xs-1'>{$vs}</div>";
    echo "<div class='col-xs-2' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'><a href=\"javascript:alert('Password (密码) : {$pspw}\u000dNotice (提示) : You can check it in PowerSchool. 你可在PowerSchool中测试账号的可用性.');\">Show Password. 点击显示密码.</a></div>";
    echo "<div class='col-xs-2' style='white-space:nowrap;text-overflow:ellipsis;overflow:hidden;'><font color='$vstatuscolor'>{$vstatusview}</font></div>";
    echo "<div class='col-xs-2'><button type='button' class='btn btn-success btn-xs' onclick=\"location.href='rnauth-ok.php?id={$row['id']}'\">通过</button>
                                <button type='button' class='btn btn-danger btn-xs' onclick=\"location.href='rnauth-no.php?id={$row['id']}'\">拒绝</button></div>";
    echo "</div>";
    $n++;
/*    if($n>14){
        return;
    }*/
}    
?>
                    </div>

                </div>
                <!--页码块-->
                <footer class="footer">
                    <ul class="pagination">
                        <li>
                            <select>
                                <option>1</option>
                            </select>
                            页
                        </li>
                        <li class="gray">
                            共1页
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-left">
                            </i>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-menu-right">
                            </i>
                        </li>
                    </ul>
                </footer>

                <!--弹出删除违约记录警告窗口-->

                <div class="modal fade" id="deleteObey" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">提示</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    确定要删除该违约记录？删除后不可恢复！
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                                <button type="button" class="btn btn-xs btn-danger">保 存</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </div>
        </div>
    </div>
</div>
<!-- 滑块js -->
<!--	<script type="text/javascript">
        scale = function(btn, bar, title, unit) {
                this.btn = document.getElementById(btn);
                this.bar = document.getElementById(bar);
                this.title = document.getElementById(title);
                this.step = this.bar.getElementsByTagName("div")[0];
                this.unit = unit;
                this.init();
        };
        scale.prototype = {
                init: function() {
                        var f = this,
                                g = document,
                                b = window,
                                m = Math;
                        f.btn.onmousedown = function(e) {
                                var x = (e || b.event).clientX;
                                var l = this.offsetLeft;
//						var max = f.bar.offsetWidth - this.offsetWidth;
                                var max = f.bar.offsetWidth-20 ;
                                g.onmousemove = function(e) {
                                        var thisX = (e || b.event).clientX;
                                        var to = m.min(max, m.max(-2, l + (thisX - x)));
                                        f.btn.style.left = to+ 'px';
                                        f.ondrag(m.round(m.max(0, to / max) * 100), to);
                                        b.getSelection ? b.getSelection().removeAllRanges() : g.selection.empty();
                                };
                                g.onmouseup = new Function('this.onmousemove=null');
                        };
                },
                ondrag: function(pos, x) {
                        this.step.style.width = Math.max(0, x) +2+ 'px';
                        this.title.innerHTML = pos / 10 + this.unit + "";
                }
        }
        new scale('btn0', 'bar0', 'title0', "分钟");
        new scale('btn1', 'bar1', 'title1', "分钟");
        new scale('btn2', 'bar2', 'title2', "天");
        new scale('btn3', 'bar3', 'title3', "次");
</script>
-->
<script src="js/jquery.nouislider.js"></script>

<!-- this page specific inline scripts -->
<script>
                                                //min/max slider
                                                function huadong(my, unit, def, max) {
                                                    $(my).noUiSlider({
                                                        range: [0, max],
                                                        start: [def],
                                                        handles: 1,
                                                        connect: 'upper',
                                                        slide: function() {
                                                            var val = Math.floor($(this).val());
                                                            $(this).find(".noUi-handle").text(
                                                                    val + unit
                                                                    );
                                                            console.log($(this).find(".noUi-handle").parent().parent().html());
                                                        },
                                                        set: function() {
                                                            var val = Math.floor($(this).val());
                                                            $(this).find(".noUi-handle").text(
                                                                    val + unit
                                                                    );
                                                        }
                                                    });
                                                    $(my).val(def, true);
                                                }
                                                huadong('.slider-minmax1', "分钟", "5", 30);
                                                huadong('.slider-minmax2', "分钟", "6", 15);
                                                huadong('.slider-minmax3', "分钟", "10", 60);
                                                huadong('.slider-minmax4', "次", "2", 10);
                                                huadong('.slider-minmax5', "天", "3", 7);
                                                huadong('.slider-minmax6', "天", "8", 10);
</script>
</body>

</html>