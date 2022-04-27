<?php
ini_set('session.cookie_domain', '.volunteer.ensonyan.com');
session_start();
if ( !$_SESSION['logged'] ) {
	echo "<script>alert('System Standard Level Safety Inspection / 系统标准级安全检测\u000d\u000dYou must login first ! / 请先登录 !');</script>";
	echo "
        <script>
             setTimeout(function(){window.location.href='/apps/vms/account/login/index.html?type=al&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2main%2Findex.php?token=FoqXwKt0T59jDXrP';},100);
        </script>";
	    session_unset();//free all session variable
        session_destroy();//销毁一个会话中的全部数据
        setcookie(session_name(),'',time()-3600);//销毁与客户端的卡号
	exit;
}
else {
  $username=$_SESSION['entry_name'];
  $adminornot=$_SESSION['admin'];

  $userLangF=$_COOKIE['userLang'];

if ($userLangF == "cn"){
include "../languages/zh_CN/lang-dict.php";
} else if ($userLangF == "en"){
include "../languages/en_US/lang-dict.php";
} else {
include "../languages/en_US/lang-dict.php";
}

include('conn.php');//链接数据库
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
  
  $psrnssysstat = mysql_query("select psvstat from user where username='$username'");
//echo "查询信息如下：";
while($row = mysql_fetch_array($psrnssysstat))

               //PowerSchool方式实名状态辨别开始
               if($row['psvstat'] == 'yes'){
                 
                 }else {
				  $ntrnssysstat = mysql_query("select verify from user where username='$username'");
//echo "查询信息如下：";
while($row = mysql_fetch_array($ntrnssysstat))

               //普通方式实名状态辨别开始
               if($row['verify'] == '已认证'){
                 
                 }else {
                  mysql_close();//关闭数据库
echo "<script>alert('Real name verification required before any operation, click OK to do the real name verification. / 在进行任何操作之前，你必须实名验证并等待校方通过审核！点击下方确定进行实名验证。');window.location.href='https://verify.volunteer.ensonyan.com/index.php?type=forced_rna&from=vms&token=FoqXwKt0T59jDXrP';</script>";
                $_SESSION['entry_name'] = "$name";
                $_SESSION['rnauthonly'] = "yes";
                exit;
			  }

			  }

    function safeStrings($str) {
      return str_replace("'","\\'",str_replace("\\","\\\\",(string)$str));
    }//安全字符串检测函数
  
  //从works列表中计算出当前用户所有已通过行getcredit值之总和
$sqlcredit = "SELECT sum( getcredit ) FROM `works` where username = '$username' AND status = '已通过'";
$querycredit = mysql_query($sqlcredit);
$finalcredit = mysql_result($querycredit,0);
  //将计算结果插入至user列表credit栏
mysql_query("UPDATE user SET credit = '$finalcredit' where username ='$username'");
  //检测该用户有效学分
$sql="SELECT credit FROM user WHERE username='$username'";
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
$credit=$row["credit"];
}
  //检测该用户所在行政班
$sql="SELECT homeroom FROM user WHERE username='$username'";
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
$homeroom=$row["homeroom"];

  //检测领事所执教行政班
$sql="SELECT teachroom FROM user WHERE username='$username'";
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
$teachroom=$row["teachroom"];

  //检测该用户是否认证
$sql="SELECT verify FROM user WHERE username='$username'";
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
$v=$row["verify"];

  //检测该用户是否领事
$sql="SELECT ls FROM user WHERE username='$username'";
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
$ls=$row["ls"];

  mysql_close();//关闭数据库
?>
<!Doctype html>
<html lang="zh-cmn-Hans">
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
		<meta name="theme-color" content="#5B9BD5">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="由EnsonYan开发的志愿者信息管理系统，为枫叶教育集团提供志愿者管理服务">
        <meta name="keywords" content="EnsonYan,EN-NetworkProject,志愿者信息管理系统，志愿者">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <title><?php echo "$langtitlewelcome"; ?> <?php echo "$username"; ?>, <?php echo "$langtitleafter"; ?></title>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src='js/jquery.marquee.min.js'></script>
        <script src='js/jquery.pause.js'></script>
		<script type="text/javascript" src="common/js/filter.js"></script>
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
            <!-- 左侧菜单栏Title块 -->
            <div class="leftMeun" style="overflow:auto" id="leftMeun">
                <div id="logoDiv">
                    <p id="logoP"><img id="logo" alt="Volunteer Management System - Powered by EnsonYan." title="Volunteer Management System - Powered by EnsonYan." src="images/enlogo.svg"><span><?php echo "$langlefttoptitle"; ?></span></p>
                </div>
                <div id="personInfor">
                  <p id="userName"><?php echo $_SESSION['entry_name']; ?><?php if ($v == '已认证') { echo "<a href='#rnauth' aria-controls='rnauth' role='tab' data-toggle='tab' target='_blank' style='text-decoration:none' title='$langauthyestitle' alt='$langauthyesalt'><img src='/apps/vms/img/verify.png' width='20px' style='padding-bottom: 5px;padding-left: 2px' title='$langauthyestitle' alt='$langauthyesalt'><font color='#faff00d4' size='1px'>&nbsp;$langauthyes</font></a>"; } else { echo "<a href='https://verify.volunteer.ensonyan.com/OAuth2/index.php?ref=vms-main-side_panel_top&token=FoqXwKt0T59jDXrP' target='_blank' style='text-decoration:none' title='$langauthnotitle' alt='$langauthnotitle'><img src='/apps/vms/img/non-verify.png' width='20px' style='padding-bottom: 5px;padding-left: 2px' title='$langauthnotitle' alt='$langauthnotitle'><font color='#888888' size='1px'>&nbsp;$langauthno</font></a>"; }?></br>
                                   <font color="#FFFFE0"><?php
								   if ($_SESSION['admin'] == 'yes') {
									   if ($_SESSION['suadmin'] == 'yes'){
									   echo "$langshenfencjgly";} else {
									   echo "$langshenfengly";}
                                   } else if ($ls == 'yes') {echo "$langshenfenls";} else { echo "$langshenfenzyz";} ?></font></p>
          </br>
          <p><span><?php echo $langcreditsltop; ?>:<?php echo $credit; ?></br><?php if($ls == 'yes'){echo "$langteachroomltop";} else if($ls == 'no'){echo "$langhomeroomltop";} ?>:<?php if($ls == 'yes'){echo "$teachroom";} else if($ls == 'no'){echo "$homeroom";} ?></span></p>
                    <p>
                        <a href="/apps/vms/account/logout/logout.php?token=FoqXwKt0T59jDXrP&uname=<?php echo $_SESSION['entry_name']; ?>"><?php echo "$langlogoutbtn"; ?></a>
                    </p>
                </div>
                <div class="meun-title"><?php echo $langleftmenu1; ?></div>
                <div class="meun-item meun-item-active" href="#volc" aria-controls="volc" role="tab" data-toggle="tab"><img src="images/icon_source.png"><?php echo $langleftmenu2; ?></div>
                <div class="meun-item" href="#cert" aria-controls="cert" role="tab" data-toggle="tab"><img src="images/icon_chara_grey.png"><?php echo $langleftmenu3; ?></div>
                <div class="meun-item" href="#rnauth" aria-controls="rnauth" role="tab" data-toggle="tab"><img src="images/icon_card_grey.png"><?php echo $langleftmenu4; ?></div>
                <div class="meun-item" href="#chan" aria-controls="chan" role="tab" data-toggle="tab"><img src="images/icon_change_grey.png"><?php echo $langleftmenu5; ?></div>
				<div class="meun-item" onclick="javascript:location.href='<?php echo "$langsidelangselecthref"; ?>'" role="tab" data-toggle="tab"><img src="/images/<?php echo "$langsidelangselectimg"; ?>" style="height:15px;padding-bottom: 0px;border-bottom-style: solid;border-bottom-width: 0px;margin-bottom: 3px;">Language / 切换语言</div>
                <!--<div class="meun-title">Advanced / 其他</div>
                <div class="meun-item" onclick="javascript:location.href='/notice/developing.php'" href="#scho" aria-controls="scho" role="tab" data-toggle="tab" style="text-decoration:line-through"><img src="images/icon_house_grey.png">Overview / 数据概览</div>
                <div class="meun-item" onclick="javascript:location.href='/notice/developing.php'" href="#stud" aria-controls="stud" role="tab" data-toggle="tab" style="text-decoration:line-through"><img src="images/icon_user_grey.png">Messages / 通知</div>
                <div class="meun-item" onclick="javascript:location.href='/notice/developing.php'" href="#regu" aria-controls="regu" role="tab" data-toggle="tab" style="text-decoration:line-through"><img src="images/icon_rule_grey.png">Settings / 设置</div>--->
<?php
    if($adminornot=="yes"){
        echo " <div class='meun-title'>Advanced / 其他</div><div class='meun-item' onclick=\"javascript:location.href='/apps/vms/main/admin/index.php?ref=user_norm_background'\" aria-controls='/apps/vms/main/admin/index.php?ref=norm_user_background' role='tab' data-toggle='tab'><img src='images/icon_char_grey.png'>Admin / 管理员后台</div> <!-- default href=#sitt -->
            ";
    }
?>
      </div>
            <!-- 右侧具体内容栏目 -->
            <div id="rightContent">
                <a class="toggle-btn" id="nimei">
                    <i class="glyphicon glyphicon-align-justify"></i>
                </a>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- 志愿管理模块 -->
                    <div role="tabpanel" class="tab-pane active" id="volc">
                        <div class="check-div form-inline">
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#addSource"><?php echo $langsec1topbtn; ?></button>
                          <font color="#888888" style="width:350px;height:60px;float:right">Copyright &copy; <script>document.write(new Date().getFullYear());</script> EnsonYan - 逸成. All Rights Reserved.</font>
                        </div>
                      
                      <div class="data-div">
                        
                            <div class="row tableHeader">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 ">
                                    <?php echo $langsec1tbt1; ?>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
                                    <?php echo $langsec1tbt2; ?>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <?php echo $langsec1tbt3; ?>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>
                                    <?php echo $langsec1tbt4; ?>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>
                                    <?php echo $langsec1tbt5; ?>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>
                                    <?php echo $langsec1tbt6; ?>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    <?php echo $langsec1tbt7; ?>
                                </div>
                                 <!-- 此处第七列标题占位 -->
                              </div>                         
                           
                          <div class="tablebody">  <!-- 此处无数据应该隐藏 -->
<?php
//申请审核模块
@mysql_connect("localhost","credit","your_password_here")or die;    //链接数据库
@mysql_select_db("credit")or die;    //选择数据库
$query = @mysql_query("select * from works where username= '$username'")or die;    //查询‘works’表中EnsonYan的所有记录

$n=0;
while ($row = mysql_fetch_array($query))    //遍历‘works’表中的数据，并形成数组
{
    $uid = $row['uid'];
    $place = $row['place'];    //使用键获取数组中对应的值
    $details = $row['details'];
    $time = $row['time'];
    $wantcredit = $row['wantcredit'];
    $getcredit = $row['getcredit'];
    $status = $row['status'];
   if ($status == '待审核') {
     $statuscolor="#4169E1";
	 $xianshistatus="$langsec1statusdaishenhe";
   }
   if ($status == '已通过') {
     $statuscolor="#228B22";
	 $xianshistatus="$langsec1statusyitongguo";
   }
   if ($status == '已驳回') {
     $statuscolor="#FF0000";
	 $xianshistatus="$langsec1statusyibohui";
   }
    echo "<div class='row'>";
    echo "<div class='col-xs-1 '>{$uid}</div>";
    echo "<div class='col-xs-3 '><div class='mq' data-duration='2000' style='width:240px;overflow:hidden'><span>{$place}</span></div></div>";    //按照数据表的列在表格里输出对应数据
    echo "<div class='col-xs-3 '><div class='mq' data-duration='2000' style='width:240px;overflow:hidden'><span>{$details}</span></div></div>";
    echo "<div class='col-xs-1 ' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>{$time}</div>";
    echo "<div class='col-xs-1 ' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>{$wantcredit}</div>";
    echo "<div class='col-xs-1 ' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>{$getcredit}</div>";
    echo "<div class='col-xs-2 '><strong><font color='$statuscolor'>{$xianshistatus}</font></strong></div>";
    echo "</div>";
    $n++;
/*    if($n>14){
        return;
    }*/
}    
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
                                    Page
                                </li>
                                <li class="gray">
                                    1 / 1
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
                        <!--弹出窗口 上传志愿证明-->
                        <div class="modal fade" id="addSource" role="dialog" aria-labelledby="gridSystemModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="margin-right: 0px;margin-left: 0px;padding-right: 0px;">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $languploaddivtitle1; ?></br><font size="3" color="FF0000"><?php echo $languploaddivtitle2; ?></font></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <form class="form-horizontal" method="post" action="submit-cert.php">
                                                <div class="form-group">
                                                    <label for="time" class="col-xs-4 control-label"><?php echo $languploaddivline1; ?></br><font size="2" color="FF0000"><?php echo $languploaddivline1note; ?></font></label>
                                                    <div class="col-xs-7">
                                                        <input type="text" name="username" readonly unselectable="on" value="<?php echo $_SESSION['entry_name']; ?>" class="form-control input-sm duiqi" id="username" onkeypress="Filter()" onpaste="return false" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="time" class="col-xs-4 control-label"><?php echo $languploaddivline2; ?></br><font size="2" color="FF0000"><?php echo $languploaddivline2note; ?></font></label>
                                                    <div class="col-xs-7">
                                                        <input type="text" name="homeroom" readonly unselectable="on" value="<?php echo $_SESSION['homeroom']; ?>" class="form-control input-sm duiqi" id="homeroom" onkeypress="Filter()" onpaste="return false" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="place" class="col-xs-4 control-label"><?php echo $languploaddivline3; ?></label>
                                                    <div class="col-xs-7 ">
                                                        <input type="text" name="place" class="form-control input-sm duiqi" id="place" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="details" class="col-xs-4 control-label"><?php echo $languploaddivline4; ?></label>
                                                    <div class="col-xs-7 ">
                                                        <input type="text" name="details" class="form-control input-sm duiqi" id="details" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="time" class="col-xs-4 control-label"><?php echo $languploaddivline5; ?></label>
                                                    <div class="col-xs-7">
                                                        <input type="text" name="time" class="form-control input-sm duiqi" id="time" onkeypress="Filter()" onpaste="return false" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="wantcredit" class="col-xs-4 control-label"><?php echo $languploaddivline6; ?></label>
                                                    <div class="col-xs-7">
                                                        <input type="text" name="wantcredit" class="form-control input-sm duiqi" id="wantcredit" onkeypress="Filter()" onpaste="return false" placeholder="">
                                                    </div>
                                                </div>
                                               
												<div class="modal-footer">
                                                     <button type="button" class="btn btn-xs btn-xs btn-white" data-dismiss="modal"><?php echo $languploaddivcancelbtn; ?></button>
                                                     <button type="submit" name="submit" id="submit" class="btn btn-xs btn-xs btn-green"><?php echo $languploaddivsubmitbtn; ?></button>
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

            </div>
            <!--实名管理模块-->
            <div role="tabpanel" class="tab-pane" id="rnauth">
                <div class="check-div form-inline">
                        <button class="btn btn-info btn-xs" data-toggle="modal" onclick="window.open('https://verify.volunteer.ensonyan.com/OAuth2/index.php?ref=vms-main-side_panel_rnauth&token=FoqXwKt0T59jDXrP')"><?php echo "$langsec2topbtn"; ?></button><!--原：data-target="#addUser"-->
                </div>
                <div class="data-div">
                    <div class="row tableHeader">
                        <div class="col-xs-2">
                            <?php echo $langsec2tbt1; ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $langsec2tbt2; ?>
                        </div>
                        <div class="col-xs-2">
                            <?php echo $langsec2tbt3; ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $langsec2tbt4; ?>
                        </div>
                        <div class="col-xs-2">
                            <?php echo $langsec2tbt5; ?>
                        </div>
                    </div>
                    <div class="tablebody">

<?php
//实名认证模块
@mysql_connect("localhost","credit","your_password_here")or die;    //链接数据库
@mysql_select_db("credit")or die;    //选择数据库
$query = @mysql_query("select * from user where username= '$username'")or die;    //查询‘works’表中EnsonYan的所有记录

$n=0;
while ($row = mysql_fetch_array($query))    //遍历‘user’表中的数据，并形成数组
{
    $vtype = $row['vtype'];    //实名证件类型，前台显示
    $vnumber = $row['vnumber'];    //使用键获取数组中对应的值
    $vname = $row['vname'];    //真实姓名，前台显示
    $vsno = $row['vsno'];    //学号，前台显示
    $verify = $row['verify'];    //是否实名，根据此条判断其他栏是否需要显示未实名，前台通栏占位

if ($ls == 'yes') { $vstat = "<img src='/apps/vms/img/verify.png' width='20px' style='padding-bottom: 5px;padding-left: 2px' title='领事认证' alt='领事认证'><font color='#05a' size='1px'>&nbsp;领事认证</font>";
                  } else if ($ls == 'no') { if ($verify == '已认证') { $vstat = "<img src='/apps/vms/img/verify.png' width='20px' style='padding-bottom: 5px;padding-left: 2px' title='已实名认证' alt='已实名认证'><font color='#05a' size='1px'>&nbsp;已实名认证</font>";
                                                                  }
                                           else if ($verify == '未实名') {
											   $vssecxianshistatus="$langsec2weishiming";
                                             $vstat = "<img src='/apps/vms/img/non-verify.png' width='20px' style='padding-bottom: 5px;padding-left: 2px' title='$vssecxianshistatus' alt='$vssecxianshistatus'><font color='#05a' size='1px'>&nbsp;$vssecxianshistatus</font>";
                                           } else if ($verify == '待审核') {
											   $vssecxianshistatus="$langsec2daishenhe";
                                           $vstat = "<img src='/apps/vms/img/non-verify.png' width='20px' style='padding-bottom: 5px;padding-left: 2px' title='$vssecxianshistatus' alt='$vssecxianshistatus'><font color='#05a' size='1px'>&nbsp;$vssecxianshistatus</font>";
                                           } else if ($verify == '未通过') {
											   $vssecxianshistatus="$langsec2weitongguo";
                                           $vstat = "<img src='/apps/vms/img/non-verify.png' width='20px' style='padding-bottom: 5px;padding-left: 2px' title='$vssecxianshistatus' alt='$vssecxianshistatus'><font color='#FF0000' size='1px'>&nbsp;$vssecxianshistatus</font>";
                                           } else {
										   $vssecxianshistatus="$langsec2weishenqing";
										   $vstat = "<img src='/apps/vms/img/non-verify.png' width='20px' style='padding-bottom: 5px;padding-left: 2px' title='$vssecxianshistatus' alt='$vssecxianshistatus'><font color='#05a' size='1px'>&nbsp;$vssecxianshistatus</font>";  
										   }
}

if ($ls == 'yes') {
  $vtallow = "领事无需填写信息";
  } else if ($ls == 'no') { if ($verify == 'yes') {
  $vtallow = "";
}
}
  
if ($adminornot == 'yes') {
  $vstat = "<img src='/apps/vms/img/verify.png' width='20px' style='padding-bottom: 5px;padding-left: 2px' title='管理员' alt='管理员'><font color='#05a' size='1px'>&nbsp;管理员</font>";
  $vtallow = "管理员无需填写信息";
}

if ($vtype == 'idcard') {
  $vtypexs = "ID Card / 身份证";
} else if ($vtype == 'passport') {
  $vtypexs = "Passport / 护照";
} else if ($vtype == 'others') {
  $vtypexs = "Others / 其他";
} else {
  $vtypexs = "";
}
  
    echo "<div class='row'>";
    echo "<div class='col-xs-2 '><marquee direction='left' scrolldelay='1'>{$vtypexs}</marquee></div>";    //按照数据表的列在表格里输出对应数据
    echo "<div class='col-xs-3 '><marquee direction='left' scrolldelay='1'>{$vnumber}</marquee></div>";
    echo "<div class='col-xs-2 ' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>{$vname}</div>";
    echo "<div class='col-xs-3 ' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>{$vsno}</div>";
    echo "<div class='col-xs-2 ' style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>{$vstat}</div>";
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
                            Page
                        </li>
                        <li class="gray">
                            1 / 1
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
                                                <input type="email" class="form-control input-sm duiqi" id="sName" onkeypress="Filter()" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sLink" class="col-xs-3 control-label">真实姓名：</label>
                                            <div class="col-xs-8 ">
                                                <input type="" class="form-control input-sm duiqi" id="sLink" onkeypress="Filter()" onpaste="return false" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sOrd" class="col-xs-3 control-label">电子邮箱：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm duiqi" id="sOrd" onkeypress="Filter()" onpaste="return false" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sKnot" class="col-xs-3 control-label">电话：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm duiqi" id="sKnot" onkeypress="Filter()" onpaste="return false" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sKnot" class="col-xs-3 control-label">地区：</label>
                                            <div class="col-xs-8">
                                                <select class=" form-control select-duiqi">
                                                    <option value="">A</option>
                                                    <option value="">B</option>
                                                    <option value="">CA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sKnot" class="col-xs-3 control-label">权限：</label>
                                            <div class="col-xs-8">
                                                <select class=" form-control select-duiqi">
                                                    <option value="">管理员</option>
                                                    <option value="">普通用户</option>
                                                    <option value="">VISITOR</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="situation" class="col-xs-3 control-label">状态：</label>
                                            <div class="col-xs-8">
                                                <label class="control-label" for="anniu">
                                                    <input type="radio" name="situation" id="normal" onkeypress="Filter()" onpaste="return false">正常</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <label class="control-label" for="meun">
                                                    <input type="radio" name="situation" id="forbid" onkeypress="Filter()" onpaste="return false"> 禁用</label>
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
                                                <input type="email" class="form-control input-sm duiqi" id="sName" onkeypress="Filter()" onpaste="return false" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sLink" class="col-xs-3 control-label">真实姓名：</label>
                                            <div class="col-xs-8 ">
                                                <input type="" class="form-control input-sm duiqi" id="sLink" onkeypress="Filter()" onpaste="return false" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sOrd" class="col-xs-3 control-label">电子邮箱：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm duiqi" id="sOrd" onkeypress="Filter()" onpaste="return false" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sKnot" class="col-xs-3 control-label">QQ：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm duiqi" id="sKnot" onkeypress="Filter()" onpaste="return false" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sKnot" class="col-xs-3 control-label">地区：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm duiqi" id="sKnot" onkeypress="Filter()" onpaste="return false" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sKnot" class="col-xs-3 control-label">权限：</label>
                                            <div class="col-xs-8">
                                                <input type="" class="form-control input-sm duiqi" id="sKnot" onkeypress="Filter()" placeholder="" onpaste="return false">
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
			
<!-- 志愿证明管理模块 -->
                    <div role="tabpanel" class="tab-pane" id="cert">

                        <div class="check-div">

                        </div>
                        <div class="data-div">
                            <div class="row tableHeader">
                                <div class="col-xs-1 ">
                                    <?php echo "$langsec3tbt1"; ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo "$langsec3tbt2"; ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo "$langsec3tbt3"; ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo "$langsec3tbt4"; ?>
                                </div>
                            </div>
                            <div class="tablebody">

<?php
//证明文件模块
@mysql_connect("localhost","credit","your_password_here")or die;    //链接数据库
@mysql_select_db("credit")or die;    //选择数据库
$query = @mysql_query("select * from works where username = '$username'")or die;    //查询‘works’表中的所有记录 (如需每班单独设置管理员账号，此处应该改为 "select * from works where homeroom='$teachroom'")

$n=0;
while ($row = mysql_fetch_array($query))    //遍历‘works’表中的数据，并形成数组
{
    $uid = $row['uid'];
    $status = $row['status'];
    $photodirfromdb = $row['photo'];
  
   if ($status == '待审核') {
     $statuscolor="#4169E1";
	 $sec3xianshistatus="$langsec3ststusdaishenhe";
   }
   if ($status == '已通过') {
     $statuscolor="#228B22";
	 $sec3xianshistatus="$langsec3ststusyitongguo";
   }
   if ($status == '已驳回') {
     $statuscolor="#FF0000";
	 $sec3xianshistatus="$langsec3ststusyibohui";
   }
  
   if ($photodirfromdb == '无证明文件') {
     $photodir="<a href=\"javascript:alert('$langsec3nofilejsalert');\">$langsec3nofile</a>";
   } else {
     $photodir="<a href=\"/apps/vms/plugin/iu_module/$photodirfromdb\" target='_blank'>$langsec3checkfile</a>";
   }
  
    echo "<div class='row'>";
    echo "<div class='col-xs-1 '>{$uid}</div>";
    echo "<div class='col-xs-4 '><font color='$statuscolor'>{$sec3xianshistatus}</font></div>";
    echo "<div class='col-xs-3'><font color='#05a'>{$photodir}</font></div>";
    echo "<div class='col-xs-3'><button type='button' class='btn btn-info btn-xs' onclick=\"location.href='/apps/vms/plugin/iu_module/imguid_redir.php?uid={$row['uid']}'\">$langsec3editanduploadbtn</button></div>";
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
                            Page
                        </li>
                        <li class="gray">
                            1 / 1
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
			
            <!-- 修改密码模块 -->
            <div role="tabpanel" class="tab-pane" id="chan">
                <div class="check-div">
                    <?php echo "$langsec4title"; ?>
                </div>
                <div style="padding: 50px 0;margin-top: 50px;background-color: #fff; text-align: right;width: 420px;margin: 50px auto;">
                    <form class="form-horizontal" method="post" action="change-pass.php" onsubmit="return alter()">
                        <div class="form-group">
                          <label for="sKnot" class="col-xs-4 control-label"><?php echo "$langsec4tbt1"; ?></label>
                            <div class="col-xs-5">
                                <input type="password" class="form-control input-sm duiqi" id="oldpassword" name="oldpassword" onkeypress="Filter()" onpaste="return false" placeholder="" style="margin-top: 7px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sKnot" class="col-xs-4 control-label"><?php echo "$langsec4tbt2"; ?></label>
                            <div class="col-xs-5">
                                <input type="password" class="form-control input-sm duiqi" id="newpassword" name="newpassword" onkeypress="Filter()" onpaste="return false" placeholder="" style="margin-top: 7px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sKnot" class="col-xs-4 control-label"><?php echo "$langsec4tbt3"; ?></label>
                            <div class="col-xs-5">
                                <input type="password" class="form-control input-sm duiqi" id="assertpassword" name="assertpassword" onkeypress="Filter()" onpaste="return false" placeholder="" style="margin-top: 7px;">
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <div class="col-xs-offset-4 col-xs-5" style="margin-left: 169px;">
                                <button type="reset" class="btn btn-xs btn-white"><?php echo "$langsec4cancelbutton"; ?></button>
                                <button type="submit" class="btn btn-xs btn-green"><?php echo "$langsec4submitbutton"; ?></button>
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
            <!--预置管理模块-->
            <div role="tabpanel" class="tab-pane" id="scho">

                <div class="check-div form-inline">
                    <div class="col-xs-3">
                        <button class="btn btn-yellow btn-xs" data-toggle="modal" data-target="#addSchool">添加 </button>
                    </div>
                    <div class="col-lg-4 col-xs-5">
                        <input type="text" class=" form-control input-sm " placeholder="输入文字搜索">
                        <button class="btn btn-white btn-xs ">查 询 </button>
                    </div>
                    <div class="col-lg-3 col-lg-offset-1 col-xs-3" style="padding-right: 40px;text-align: right;float: right;">
                        <label for="paixu">排序:&nbsp;</label>
                        <select class="form-control">
                            <option>area</option>
                            <option>rank</option>
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
                            1
                        </div>
                        <div class="col-xs-2">
                            信息
                        </div>
                        <div class="col-xs-2">
                            列表
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
                                TEXT
                            </div>
                            <div class="col-xs-1">
                                TEXT
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
                <div class="modal fade" id="addSchool" role="dialog" aria-labelledby="gridSystemModalLabel">
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
                                            <label for="sName" class="col-xs-3 control-label">名称：</label>
                                            <div class="col-xs-8 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">D1：</label>
                                            <div class="col-xs-8 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sLink" class="col-xs-3 control-label">D2：</label>
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
                                <h4 class="modal-title" id="gridSystemModalLabel">修改</h4>
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
                                        <div class="form-group ">
                                            <label for="sName" class="col-xs-3 control-label">D1：</label>
                                            <div class="col-xs-8 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sLink" class="col-xs-3 control-label">D2：</label>
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
                                    确定要删除该校区？删除后不可恢复！
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
            <div role="tabpanel" class="tab-pane" id="regu" style="padding-top: 50px;">
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
                            <div class="col-xs-3" style="padding-right: 0;">时间</div>
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
                            <div class="col-xs-3" style="padding-right: 0;">违约次数冻结上限</div>
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
                            <div class="col-xs-3" style="padding-right: 0;">可预约天数</div>
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
            <!--时间段管理模块-->
            <div role="tabpanel" class="tab-pane" id="time">
                <div class="check-div form-inline">
                    <span href="#sitt" aria-controls="sitt" role="tab" data-toggle="tab" style="cursor: pointer;"><span class="glyphicon glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;返回上一页</span>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-yellow btn-xs " data-toggle="modal" data-target="#addTime">添加时间段 </button>

                </div>
                <div class="data-div">
                    <div class="row tableHeader">
                        <div class="col-xs-3 ">
                            编码
                        </div>
                        <div class="col-xs-3">
                            开始
                        </div>
                        <div class="col-xs-3">
                            结束
                        </div>

                        <div class="col-xs-3">
                            操作
                        </div>
                    </div>
                    <div class="tablebody">

                        <div class="row">
                            <div class="col-xs-3 ">
                                6426398978
                            </div>
                            <div class="col-xs-3">
                                10:10
                            </div>
                            <div class="col-xs-3">
                                19:30
                            </div>
                            <div class="col-xs-3">
                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#changeTime">修改</button>
                                <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteTime">删除</button>
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
            <!--#1管理模块-->
            <div role="tabpanel" class="tab-pane" id="sitt">

                <div class="check-div form-inline" style="">
                    <div class="col-lg-4 col-xs-7 col-md-6">
                        <button class="btn btn-yellow btn-xs" data-toggle="modal" data-target="#addBuilding">添加 </button>
                        <label for="paixu">bu:&nbsp;</label>
                        <select class=" form-control">
                            <option>一区</option>
                            <option>D1</option>
                            <option>D2</option>
                            <option>D3</option>
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
                            D1
                        </div>
                        <div class="col-xs-3"style="padding-left: 20px;">
                            区域
                        </div>
                        <div class="col-xs-2" style="padding-left: 2px;">
                            位数
                        </div>
                        <div class="col-xs-2">
                            D2
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
                                    <td class="col-xs-3">D1</td>
                                    <td class="col-xs-2">2</td>
                                    <td class="col-xs-2" style="padding-left: 40px!important;">3</td>
                                    <td class="col-xs-3"style="padding-left: 50px!important;">
                                        <a class="linkCcc" href="#sitDetail" aria-controls="char" role="tab" data-toggle="tab">信息</a>
                                        <a class="linkCcc" href="#time" aria-controls="char" role="tab" data-toggle="tab">设置</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-xs-3">D2</td>
                                    <td class="col-xs-2">2</td>
                                    <td class="col-xs-2" style="padding-left: 40px!important;">3</td>
                                    <td class="col-xs-3"style="padding-left: 50px!important;">
                                        <a class="linkCcc" href="#sitDetail" aria-controls="char" role="tab" data-toggle="tab">信息</a>
                                        <a class="linkCcc" href="#time" aria-controls="char" role="tab" data-toggle="tab">设置</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-xs-3">D3</td>
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
                                            <label for="sName" class="col-xs-3 control-label">D1：</label>
                                            <div class="col-xs-8 ">
                                                <input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sLink" class="col-xs-3 control-label">D2：</label>
                                            <div class="col-xs-8 ">
                                                <input type="" class="form-control input-sm duiqi" id="sLink" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sOrd" class="col-xs-3 control-label">D3：</label>
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
                                KA
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
            <!--人员管理模块-->
            <div role="tabpanel" class="tab-pane" id="stud">
                <div class="check-div form-inline">
                    <div class="col-xs-5">
                        <input type="text" class=" form-control input-sm" placeholder="输入文字搜索" style="	!height: 40px!important;">
                        <button class="btn btn-white btn-xs ">查 询 </button>
                    </div>
                    <div class="col-xs-4 col-lg-4  col-md-5" style="padding-right: 40px;text-align: right;float: right;">
                        <label for="daoru">导入人员信息:&nbsp;</label>
                        <button class="btn btn-white btn-xs " id="daoru">选取文件 </button>
                        <button class="btn btn-white btn-xs ">导入 </button>
                    </div>

                </div>
                <div class="data-div">
                    <div class="row tableHeader">
                        <div class="col-xs-2 ">
                            学号
                        </div>
                        <div class="col-xs-1 ">
                            姓名
                        </div>
                        <div class="col-xs-2">
                            校区
                        </div>
                        <div class="col-xs-2">
                            年年
                        </div>
                        <div class="col-xs-2 ">
                            学习时长
                        </div>
                        <div class="col-xs-2">
                            次数
                        </div>
                        <div class="col-xs-1">
                            操作
                        </div>
                    </div>
                    <div class="tablebody">

                        <div class="row">
                            <div class="col-xs-2 ">
                                6426398978
                            </div>
                            <div class="col-xs-1">
                                name
                            </div>
                            <div class="col-xs-2">
                                地区
                            </div>
                            <div class="col-xs-2">
                                2019
                            </div>
                            <div class="col-xs-2">
                                15
                            </div>
                            <div class="col-xs-2">
                                2
                            </div>
                            <div class="col-xs-1">
                                <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteObey">清除</button>
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

                <!--弹出删除记录警告窗口-->

                <div class="modal fade" id="deleteObey" role="dialog" aria-labelledby="gridSystemModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">提示</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    确定要删除该记录？删除后不可恢复！
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