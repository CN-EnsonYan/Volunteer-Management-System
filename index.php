<!DOCTYPE HTML>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="UTF-8">
	<meta name="renderer" content="webkit">
    <meta name="theme-color" content="#5B9BD5">
    <meta http-equiv="Cache-Control" content="no-cache" />
    <script type="text/javascript">
　　var type = navigator.appName;
    lang_exist=document.cookie.indexOf("userLang=");//判断Cookie_userLang是否已存在
	if(lang_exist == -1){
　　if (type == "Netscape"){
    　　var lang = navigator.language;//获取浏览器配置语言，支持非IE浏览器
　　}else{
    　　var lang = navigator.userLanguage;//获取浏览器配置语言，支持IE5+ == navigator.systemLanguage
　　};
　　var lang = lang.substr(0, 2);//获取浏览器配置语言前两位
　　if (lang === "zh"){
   　　 document.cookie="userLang=cn; domain=.ensonyan.com; path=/";
　　}else if (lang === "en"){
   　　 document.cookie="userLang=en; domain=.ensonyan.com; path=/";
　　}else{//其他语言编码
   　　 document.cookie="userLang=en; domain=.ensonyan.com; path=/";
　　}

    location.reload();

    }

    </script>

<?php
error_reporting(E_ALL ^ E_NOTICE);
header("Cache-Control: no-cache");
$userLangF=$_COOKIE['userLang'];

function isRobot() {
    $agent= strtolower(isset($_SERVER['HTTP_USER_AGENT'])? $_SERVER['HTTP_USER_AGENT'] : '');
    if(!empty($agent)){
        $spiderSite= array(
            "TencentTraveler",
            "Baiduspider+",
            "BaiduGame",
            "Googlebot",
            "msnbot",
            "Sosospider+",
            "360Spider",
            "Sogou web spider",
            "ia_archiver",
            "Yahoo! Slurp",
            "YoudaoBot",
            "Yahoo Slurp",
            "MSNBot",
            "Java (Often spam bot)",
            "BaiDuSpider",
            "Voila",
            "Yandex bot",
            "BSpider",
            "twiceler",
            "Sogou Spider",
            "Speedy Spider",
            "Google AdSense",
            "Heritrix",
            "Python-urllib",
            "Alexa (IA Archiver)",
            "Ask",
            "Exabot",
            "Custo",
            "OutfoxBot/YodaoBot",
            "yacy",
            "SurveyBot",
            "legs",
            "lwp-trivial",
            "Nutch",
            "StackRambler",
            "The web archive (IA Archiver)",
            "Perl tool",
            "MJ12bot",
            "Netcraft",
            "MSIECrawler",
            "WGet tools",
            "larbin",
            "Fish search",
        );
        foreach($spiderSite as $val){
            $str = strtolower($val);
            if(strpos($agent, $str) !== false){
                return true;
            }
        }
    }

    return false;
}
if(isRobot()){
    //确认为Bot
include "./languages/zh_CN/lang-dict.php";
}else{
    //确认为非Bot
if ($userLangF == "cn"){
include "./languages/zh_CN/lang-dict.php";
} else if ($userLangF == "en"){
include "./languages/en_US/lang-dict.php";
} else {
include "./languages/en_US/lang-dict.php";
}
}

include('conn.php');//链接数据库
$sql1 = "SELECT status FROM system WHERE item='opstatus'";
$result1 = mysql_query($sql1);
$row = mysql_fetch_array($result1);

if(isset($_SESSION["vms-stat"]))
{} else {
session_start();
}
$gvmsgetstatfromsql = $row['status'];
$_SESSION['vms-stat'] = $gvmsgetstatfromsql;
$gvmsstat = $_SESSION['vms-stat'];

//系统主进程可用性辨别开始
if($gvmsstat == 'running'){
$langstatuslabel="label label-success";
$viewmainentrybtn=$langmainentrybtn;
$langbtnstatword=$langentrybtnstatrun; //已停用
$langstatusword=$langmainservicestatusrun;
} else if ($gvmsstat == 'stop'){
$langstatuslabel="label label-danger";
$langbtnstatword=$langentrybtnstatstop; //已停用
$langstatusword=$langmainservicestatusstop;
} else if ($gvmsstat == 'maintain'){
$langstatuslabel="label label-warning";
$langbtnstatword=$langentrybtnstatmaint; //已停用
$langstatusword=$langmainservicestatusmaint;
};

$sql2 = "SELECT status FROM system WHERE item='regstatus'";
$result2 = mysql_query($sql2);
$row2 = mysql_fetch_array($result2);

$gvmsgetregstatfromsql = $row2['status'];
$_SESSION['vms-reg-stat'] = $gvmsgetregstatfromsql;
$gvmsregstat = $_SESSION['vms-reg-stat'];

//系统注册功能可用性辨别开始
if($gvmsregstat == 'on'){
$langregstatuslabel="label label-success";
$langregstatusword=$langregservicestatusrun;
} else if ($gvmsregstat == 'off'){
$langregstatuslabel="label label-danger";
$langregstatusword=$langregservicestatusstop;
}
?>
        <title><?php echo "$langtitle"; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="EN-NP VMS 志愿者信息管理系统，由 EnsonYan 独立进行开发，向全体枫叶国际学校学生开放，旨在简化志愿者学时申请的复杂步骤，规范化审核数据管理机制；系统目前仅面向上海枫叶国际学校学生开放。 Powered by EnsonYan's Studio !" />
        <meta name="keywords" content="EN-NetworkProject, EnsonYan, VMS, Volunteer Management System" />
        <meta name="author" content="EnsonYan" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <link href='/css/local-gfonts.css' rel='stylesheet' type='text/css'>
        <!-- <link href='https://fonts.lug.ustc.edu.cn/css?family=Rubik:400,700,700i' rel='stylesheet' type='text/css'> -->
        <link rel="stylesheet" type="text/css"  href='style.css' />
        <link rel="stylesheet" type="text/css"  href='server_status.css' />
      
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#818eff">
<meta name="theme-color" content="#ffffff">
      
<!-- Analytics --
<script type="text/javascript">
  var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//analytics.example.com/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '3']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Analytics Code -->

<script>
            var userAgent = navigator.userAgent; //取得浏览器userAgent字符串  
            var isIE = userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1; //判断是否IE<11
            var isEdge = userAgent.indexOf("Edge") > -1 && !isIE; //判断是否IE Edge
            var isIE11 = userAgent.indexOf('Trident') > -1 && userAgent.indexOf("rv:11.0") > -1;
            if(isIE) {
                var reIE = new RegExp("MSIE (\\d+\\.\\d+);");
                reIE.test(userAgent);
                var fIEVersion = parseFloat(RegExp["$1"]);
                if(fIEVersion == 7) {
                    alert("English : We don't recommend Internet Explorer because it is out of date and you may encounter some serious errors. For example, the page might not load correctly. Are you sure you want to continue using IE?\r\n\r\n中文 : 我们不推荐使用IE浏览器，因为它早已经过时，在浏览过程中很大几率会出现严重错误，例如无法正确加载页面等。确定使用IE继续访问吗？");
                } else if(fIEVersion == 8) {
                    alert("English : We don't recommend Internet Explorer because it is out of date and you may encounter some serious errors. For example, the page might not load correctly. Are you sure you want to continue using IE?\r\n\r\n中文 : 我们不推荐使用IE浏览器，因为它早已经过时，在浏览过程中很大几率会出现严重错误，例如无法正确加载页面等。确定使用IE继续访问吗？");
                } else if(fIEVersion == 9) {
                    alert("English : We don't recommend Internet Explorer because it is out of date and you may encounter some serious errors. For example, the page might not load correctly. Are you sure you want to continue using IE?\r\n\r\n中文 : 我们不推荐使用IE浏览器，因为它早已经过时，在浏览过程中很大几率会出现严重错误，例如无法正确加载页面等。确定使用IE继续访问吗？");
                } else if(fIEVersion == 10) {
                    alert("English : We don't recommend Internet Explorer because it is out of date and you may encounter some serious errors. For example, the page might not load correctly. Are you sure you want to continue using IE?\r\n\r\n中文 : 我们不推荐使用IE浏览器，因为它早已经过时，在浏览过程中很大几率会出现严重错误，例如无法正确加载页面等。确定使用IE继续访问吗？");
                } else {
                    alert("English : We don't recommend Internet Explorer because it is out of date and you may encounter some serious errors. For example, the page might not load correctly. Are you sure you want to continue using IE?\r\n\r\n中文 : 我们不推荐使用IE浏览器，因为它早已经过时，在浏览过程中很大几率会出现严重错误，例如无法正确加载页面等。确定使用IE继续访问吗？");
                }   
            } else if(isEdge) {
                //Edge 浏览器
            } else if(isIE11) {
                alert("English : We don't recommend Internet Explorer because it is out of date and you may encounter some serious errors. For example, the page might not load correctly. Are you sure you want to continue using IE?\r\n\r\n中文 : 我们不推荐使用IE浏览器，因为它早已经过时，在浏览过程中很大几率会出现严重错误，例如无法正确加载页面等。确定使用IE继续访问吗？");
            }else{
                //非 IE 浏览器
            }
</script>

        <!--[if lt IE 9]>
                <script src="js/html5shiv.js"></script>
                <script src="js/respond.min.js"></script>
        <![endif]-->
</head>

    <body class="page-template-onepage">

        <div class="site-wrapper">   

            <!--<div class="doc-loader">
                <img src="images/preloader.gif" alt="Loading...">
            </div>-->

            <header class="header-holder">             
                <div class="menu-wrapper center-relative relative">             
                    <div class="header-logo">
                        <a href="index.html">
                            <img src="images/enlogo.svg" alt="EnsonYan's Studio" title="VMS - Powered by EnsonYan's Studio !">
                        </a>               
                    </div>

                    <div class="toggle-holder">
                        <div id="toggle">
                            <div class="first-menu-line"></div>
                            <div class="second-menu-line"></div>
                            <div class="third-menu-line"></div>
                        </div>
                    </div>

                    <div class="menu-holder">
                        <nav id="header-main-menu">
                            <ul class="main-menu sm sm-clean">
                                <li>
                                    <a href="#home"><?php echo "$langhome"; ?></a>
                                </li>
                                <li>
                                    <a href="#intro"><?php echo "$langintro"; ?></a>
                                </li>
                                <li>
                                    <a href="#about"><?php echo "$langabout"; ?></a>
                                </li>
                                <li>
                                    <a href="#developer"><?php echo "$langdeveloper"; ?></a>
                                </li>
                                <li>
                                    <a href="#status"><?php echo "$langstatus"; ?></a>
                                </li>
                                <li>
                                    <a href="#summary"><?php echo "$langsummary"; ?></a>
                                </li>
                                <li>
                                    <a href="#download"><?php echo "$langdownload"; ?></a>
                                </li>
								<li style="padding-bottom: -10px;padding-top: 1px;">
                                    <?php echo "$langflag"; ?>
                                </li>
                            </ul>
                        </nav>                       
                    </div>
                    <div class="clear"></div>   
                </div>
            </header>                  

            <div id="content" class="site-content center-relative">        

                <!-- Home Section -->
                <div id="home" class="section no-page-title">
                    <div class="section-wrapper block content-1170 center-relative">                                                
                        <div class="content-wrapper">                           
                            <h1 class="big-text">
                              <font size="5px" style=" -webkit-text-fill-color: white; -webkit-text-stroke: 0.7px black;"><?php echo "$langbanner1"; ?></font><br>                               
                                <?php echo "$langbanner2"; ?>
                            </h1>
                            <div class="button-holder text-left">
                                <a href="<?php error_reporting(E_ALL ^ E_NOTICE); if($gvmsstat==running){ echo '/apps/vms/account/login/index.html?type=redir&sc=passed&ref=vms_m_intp&token=FoqXwKt0T59jDXrP" target=\"_blank';} else { echo '/apps/vms/system-unavailable.html?type=st&dt=rej&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Findex.php&method=sys_paused&token=FoqXwKt0T59jDXrP';} ?>" class="button"><?php echo $langmainentrybtn; ?></a>
                            </div>
                        </div>                        
                    </div>
                </div> 

                <!-- Intro Section -->
                <div id="intro" class="section">
                    <div class="page-title-holder">
                        <h3 class="entry-title">
                            <?php echo "$langsecintro"; ?>             
                        </h3>
                    </div>
                    <div class="section-wrapper block content-1170 center-relative">                                                
                        <div class="content-wrapper">

                            <div class="one_third ">
                                <div class="intro-holder">
                                    <p class="intro-num">1</p>
                                    <div class="intro-txt">
                                        <h4><?php echo "$langreglog"; ?></h4>
                                        <p>
                                            <?php echo "$langreglogdetail"; ?>
                                        </p>
                                        <br>
                                        <div class="button-holder text-left">
                                            <a href="<?php error_reporting(E_ALL ^ E_NOTICE); if($gvmsstat==running){ echo '/apps/vms/account/login/index.html?type=redir&sc=passed&ref=vms_m_aboutfs1&token=FoqXwKt0T59jDXrP" target=\"_blank';} else { echo '/apps/vms/system-unavailable.html?type=st&dt=rej&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Findex.php&method=sys_paused&token=FoqXwKt0T59jDXrP';} ?>" target="_blank" class="button-dot">
                                                <span><?php echo "$langmainentrybtn"; ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="one_third ">
                                <div class="intro-holder">
                                    <p class="intro-num">2</p>
                                    <div class="intro-txt">
                                        <h4><?php echo "$langrnauth"; ?></h4>
                                        <p>
                                            <?php echo "$langrnauthdetail"; ?>
                                        </p>
                                        <br>
                                        <div class="button-holder text-left">
                                            <a href="https://verify.volunteer.ensonyan.com/index.php?type=redir&sc=passed&ref=vms_m_inp1&section=about&token=FoqXwKt0T59jDXrP" target="_blank" class="button-dot">
                                                <span><?php echo "$langmyrnauth"; ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="one_third last">
                                <div class="intro-holder">
                                    <p class="intro-num">3</p>
                                    <div class="intro-txt">
                                        <h4><?php echo "$langsubmitcert"; ?></h4>
                                        <p>
                                            <?php echo "$langsubmitcertdetail"; ?>
                                        </p>
                                        <br>
                                        <div class="button-holder text-left">
                                            <a href="<?php error_reporting(E_ALL ^ E_NOTICE); if($gvmsstat==running){ echo '/apps/vms/account/login/index.html?type=redir&sc=passed&ref=vms_m_inp1&token=FoqXwKt0T59jDXrP" target=\"_blank';} else { echo '/apps/vms/system-unavailable.html?type=st&dt=rej&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Findex.php&method=sys_paused&token=FoqXwKt0T59jDXrP';} ?>" target="_blank" class="button-dot">
                                                <span><?php echo "$langseemyprogressbtn"; ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="clear"></div>
                        </div>                        
                    </div>
                </div>

                <!-- About Section -->
                <div id="about" class="section">                   
                    <div class="page-title-holder">
                        <h3 class="entry-title">
                            <?php echo "$langsecabout"; ?>             
                        </h3>
                    </div>
                    <div class="section-wrapper block content-1170 center-relative">                                                
                        <div class="content-wrapper">

                            <div class="one_half">
                                <p class="title-description-up">
                                    <?php echo "$langsecusageupper"; ?>
                                </p>
                                <h2 class="entry-title medium-text">
                                    <?php echo "$langsecusagelower"; ?>
                                </h2>
                                <p>
                                    <?php echo "$langsecbyensonyan"; ?>
                                </p>
                                <br>
                                <div class="button-holder text-left">
                                    <a href="<?php error_reporting(E_ALL ^ E_NOTICE); if($gvmsstat==running){ echo '/apps/vms/account/register/sign-up.html?type=redir&sc=passed&ref=vms_m_usagebtn1&section=usage&token=FoqXwKt0T59jDXrP" target=\"_blank';} else { echo '/apps/vms/system-unavailable.html?type=st&dt=rej&ref=https%3A%2F%2Fvolunteer.ensonyan.com%2Findex.php&method=sys_paused&token=FoqXwKt0T59jDXrP';} ?>" target="_blank" class="button">
                                        <?php echo "$langmainentrybtn"; ?>
                                    </a>
                                </div>
                            </div>

                            <div class="one_half last" data-threshold="0 0" data-jarallax-element="120 0">
                                <img src="https://global.ecdn.ltd/vms/software_cr_cert(with-watermark).jpg" alt="" />
                            </div>
                            <div class="clear"></div>
                        </div>                        
                    </div>
                </div> 
               
                <!-- Developer Section -->
                <div id="developer" class="section">                   
                    <div class="page-title-holder">
                        <h3 class="entry-title">
                            <?php echo "$langsecdeveloper"; ?>
                        </h3>
                    </div>
                    <div class="section-wrapper block content-1170 center-relative">                                                
                        <div class="content-wrapper">
                            <div class="member member-left">
                                <img src="images/about_item_01.jpg" alt="" data-threshold="0 0" data-jarallax-element="60 0">
                                <div class="member-info">
                                    <p class="member-postition"><?php echo "$langsecdevintro1"; ?></p>
                                    <h5 class="member-name">Enson, Yan</h5>
                                    <div class="member-content">
                                        <p>
                                            <?php echo "$langmydetail"; ?>
                                        </p>
                                        <div class="member-social-holder" data-jarallax-element="0 30">
                                            <div class="social">
                                                <a href="https://wpa.qq.com/msgrd?V=3&uin=2903658324&Site=EN_VMS&Menu=yes&from=vms-intro-si" rel="nofollow" target="_blank">
                                                    <span class="fa fa-qq"></span>
                                                </a>
                                            </div>
                                           <div class="social">
                                                <a href="/sps/wechat.html?ref=vms-intro-si" target="_blank">
                                                    <span class="fa fa-wechat"></span>
                                                </a>
                                            </div>
                                            <div class="social">
                                                <a href="https://www.facebook.com/homepage.ensonyan?from=vms-intro-si" rel="nofollow" target="_blank">
                                                    <span class="fa fa-facebook"></span>
                                                </a>
                                            </div>
                                            <div class="social">
                                                <a href="https://twitter.com/Enson_Yan?from=vms-intro-si" rel="nofollow" target="_blank">
                                                    <span class="fa fa-twitter"></span>
                                                </a>
                                            </div>
                                            <div class="social">
                                                <a href="https://github.com/CN-EnsonYan?from=vms-intro-si" rel="nofollow" target="_blank">
                                                    <span class="fa fa-github"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>                        
                    </div>
                </div> 

                <!-- Status Section -->
                <div id="status" class="section">                   
                    <div class="page-title-holder">
                        <h3 class="entry-title">
                            <?php echo "$langserverstat"; ?>
                        </h3>
                    </div>
                 
                    <div class="section-wrapper block content-1170 center-relative">                                                
                        <div class="content-wrapper">

                            <div class="one_half ">
							<span class="<?php echo $langstatuslabel; ?>" style="font-size:100%"><?php echo $langmainservicestatus1; ?><?php echo $langstatusword; ?></span></br>
							<span class="<?php echo $langregstatuslabel; ?>" style="font-size:100%"><?php echo $langregservicestatus1; ?><?php echo $langregstatusword; ?></span>
                                <p class="title-description-up">
                                    <?php echo "$langstatusupper"; ?>
                                </p>
                                <h2 class="entry-title medium-text">
                                    <?php echo "$langstatuslower"; ?>
                                </h2>

                              <div class="sst" style="-webkit-filter: blur(5px);/* Chrome, Safari, Opera */filter: blur(5px);">
<table class="bordered">
<!-- 自动状态检测功能已移除，并使用HTML占位 -->
    <thead>
    <tr>
        <th>Server ID / 服务器编号</th>
        <th>Executing Instance / 所承载实例</th>
        <th>Status / 状态</th>
    </tr>
    </thead>
    <tr>
        <td>SH-ALI-A 47.***.59</td>
        <td><?php echo "$langlistofstat1"; ?></td>
        <td><span class="label label-success">N/A</span></td>
    </tr>
    <tr>
        <td>SH-ALI-A 49.***.131</td>         
        <td><?php echo "$langlistofstat2"; ?></td>
        <td><span class="label label-default">N/A</span></td>
    </tr>
    <tr>
        <td>SH-ALI-C 101.***.135</td>
        <td><?php echo "$langlistofstat3"; ?></td>
        <td><span class="label label-warning">N/A</span></td>
    </tr>
    <tr>
        <td>SH-ALI-A 47.***.196</td>
        <td><?php echo "$langlistofstat4"; ?></td>
        <td><span class="label label-success">N/A</span></td>
    </tr>
    <tr>
        <td>SH-ALI-A 47.***.208</td> 
        <td><?php echo "$langlistofstat5"; ?></td>
        <td><span class="label label-success">N/A</span></td>
    </tr>
    <tr>
        <td>ZJ-CLC 183.***.56</td>
        <td><?php echo "$langlistofstat6"; ?></td>
        <td><span class="label label-success">N/A</span></td>
    </tr>
    <tr>
        <td>ZJ-CLC 59.***.66</td>
        <td><?php echo "$langlistofstat7"; ?></td>
        <td><span class="label label-success">N/A</span></td>
    </tr>    
    <tr>
        <td>HK-ALI-C 144.***.203</td> 
        <td><?php echo "$langlistofstat8"; ?></td>
        <td><span class="label label-danger">N/A</span></td>
    </tr>
</table>
                          </div>
<!-- TPA #1.1 -->
                            </div>
<!-- TPA #1.2 -->
                            <div class="clear"></div>
                        </div>                        
                    </div>
                </div> 

                <!-- Summary Section -->
                <div id="summary" class="section">                   
                    <div class="page-title-holder">
                        <h3 class="entry-title">
                            <?php echo "$langsecsummary"; ?>
                        </h3>
                    </div>
                    <div class="section-wrapper block content-1170 center-relative">                                                
                        <div class="content-wrapper">
                            <ul class="milestones-holder">

                                <li class="summary">
                                    <div class="summary-info-left">
                                        <p class="summary-num">13K</p>
                                    </div>
                                    <div class="summary-info-right">
                                        <h5><?php echo "$langlinesofcodes"; ?></h5>
                                        <p class="summary-text">
                                            <?php echo "$langlinesofcodesdetail"; ?>
                                        </p>
                                    </div>
                                </li>

                                <li class="summary">
                                    <div class="summary-info-left">
                                        <p class="summary-num">500</p>
                                    </div>
                                    <div class="summary-info-right">
                                        <h5><?php echo "$langhrsofdev"; ?></h5>
                                        <p class="summary-text">
                                          <?php echo "$langhrsofdevpart1"; ?> “<span class="php-example">&lt;?php</span>” <?php echo "$langhrsofdevpart2"; ?>
                                        </p>
                                    </div>
                                </li>

                                <li class="summary">
                                    <div class="summary-info-left">
                                        <p class="summary-num">6</p>
                                    </div>
                                    <div class="summary-info-right">
                                        <h5><?php echo "$langservers"; ?></h5>
                                        <p class="summary-text">
                                            <?php echo "$langserversdetail"; ?>
                                        </p>
                                    </div>
                                </li>

                                <li class="summary">
                                    <div class="summary-info-left">
                                        <p class="summary-num">3</p>
                                    </div>
                                    <div class="summary-info-right">
                                        <h5><?php echo "$langprotections"; ?></h5>
                                        <p class="summary-text">
                                            <?php echo "$langprotectionsdetail"; ?>
                                        </p>
                                    </div>
                                </li>

                            </ul>
                        </div>                        
                    </div>
                </div> 

                <!-- Download Section -->
                <div id="download" class="section">                   
                    <div class="page-title-holder">
                        <h3 class="entry-title">
                            <?php echo "$langsecdownload"; ?>
                        </h3>
                    </div>
                    <div class="section-wrapper block content-1170 center-relative">                                                
                        <div class="content-wrapper">
                            <div class="one_half ">
                                <p class="title-description-up">EnsonYan's Studio</p>
                                <h2 class="entry-title medium-text">
                                    <?php echo "$langsecdownload"; ?>
                                </h2>
                                <p>
                                    <?php echo "$langdowninfo"; ?>
                                </p>
                                <br>
                               <div class="dlimg">
							   <img src="/images/dl_badges/google-play-badge-<?php echo $langappbadgelanguage; ?>.png" onclick="alert('<?php echo $langdlalertandroid; ?>')" alt="Get it on GooglePlay" title="Get it on GooglePlay" style="max-width:40%"></img>
							   <img src="/images/dl_badges/appstore-<?php echo $langappbadgelanguage; ?>.svg" onclick="alert('<?php echo $langdlalertios; ?>')" alt="Download on the AppStore" title="Download on the AppStore" style="width:32.8%"></img>
							   </div>
                            </div>
<!-- TPA #2.1 -->                       
                            <div class="clear"></div>

                        </div>                        
                    </div>
                </div> 
            </div>

            <!-- Footer -->
            <footer class="footer">
                <div class="footer-content center-relative">
                    <div class="footer-logo">
                        <img src="images/footer_logo.png" alt="EN-NetworkProject" />
                    </div>        
                    <div class="footer-logo-divider"></div>
                    <div class="footer-mail">            
                        <a href="mailto:admin#ensonyan.com">admin#ensonyan.com</a>
                    </div>
                    <div class="footer-social-divider"></div>
                    <div class="footer-area-enc">

          <?php echo "$langicpfilling"; ?><a href="https://beian.miit.gov.cn" target="_blank" rel="nofollow noreferrer"><?php echo "$langicpfillingnum"; ?></a></br>
          <img data-src="//img.alicdn.com/tfs/TB1..50QpXXXXX7XpXXXXXXXXXX-40-40.png" style="height:25px;width:25px" src="//img.alicdn.com/tfs/TB1..50QpXXXXX7XpXXXXXXXXXX-40-40.png" data-spm-anchor-id="5176.12825654.7y9jhqsfz.i0.e9392c4aW65E8d"><a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=31011702005532" target="_blank" title="Click to show Shanghai Public Security Network Security DEPT. - Filing Details / 查看网安联网备案信息" alt="Shanghai Public Security Network Security DEPT. - Filing Details / 网安联网备案信息" rel="nofollow"><?php echo "$langmpsfillingnum"; ?></a></br></br>
  <a target="_blank" href="https://www.w3.org/WAI/WCAG2AA-Conformance" rel="nofollow">
  <img src="/apps/vms/img/footer/wcag2AA.gif" alt="Explanation of WCAG 2.0 Level Double-A Conformance" title="Explanation of WCAG 2.0 Level Double-A Conformance"></a>
<img src="https://global.ecdn.ltd/direct_path/public/images/ssl_logos/globalsign/oem/white/medium.png" style="height:31px" onclick="window.open('https://myssl.com/seal/detail?domain=volunteer.ensonyan.com','Secured by GlobalSign | 由 GlobalSign SSL提供加密服务','height=800,width=470,top=0,right=0,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no')" title="CLICK TO VERIFY: This site uses a GlobalSign SSL Certificate to secure your personal information.">
  </br>
  <a target="_blank" href="https://www.upyun.com" rel="nofollow">
  <img src="/images/z_aff_upyun_logo6.png" style="height:40px;" alt="Upyun" title="Upyun"></a>
    </div>

                    </div>

                    <div class="copyright-holder">
                        Copyright © 2019-<script>document.write(new Date().getFullYear());</script> EnsonYan. All Rights Reserved.</br>
						<a href="https://docs.ensonyan.com/index.php/archives/12/?ref=vms_main&plc=bottom_footer&btn=terms" target="_blank"><?php echo $langfooterterms; ?></a>
						</br>
						<?php echo $langsoftwareauth; ?><a href="/images/software_cr_cert(with-watermark).jpg" target="_blank"><?php echo $langsoftwareauthno; ?></a>
                    </div>
                </div>
            </footer>
        </div>

        <!--Load JavaScript-->
        <script src="js/??jquery.js,jquery.sticky.js,tipper.js,jarallax.js,jarallax-element.min.js,imagesloaded.pkgd.js,jquery.fitvids.js,jquery.smartmenus.min.js,isotope.pkgd.js,owl.carousel.min.js,jquery.sticky-kit.min.js,main.js"></script>
        <script type="text/javascript" src="//js.users.51.la/the_user_id.js"></script>
    </body>
</html>