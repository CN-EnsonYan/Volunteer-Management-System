<?php
if($_SESSION['admin'] === 'no'){
  echo "<script>alert('You have no permission to entry the Admin Control Panel ! / 您无权访问超管系统！');</script>";
  echo "
        <script>
             setTimeout(function(){window.location.href='/apps/vms/main/index.php?type=warning&ref=acp_rejection';},100);
        </script>";
        exit;
    }
?>
<HEAD>
<TITLE>系统提示 - System Information</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
<!--
body,input{font-size:12px;margin:0;	padding:0;font-family:verdana,Arial, Helvetica, sans-serif;	color:#000}
body{text-align:center; margin:0 auto}
.title{background-color:#35AEE3;font-weight:bold;color:#fff;padding:6px 10px 8px 7px;}
.errMainArea{width:546px; margin:80px auto 0 auto;text-align:left; border:1px solid #aaa}	
	.errTxtArea{ padding:30px 34px 0 110px;}
		.errTxtArea .txt_title{	font-size:150%;	font-weight:bolder;	font-family:"Microsoft JhengHei","微軟正黑體","Microsoft YaHei","微软雅黑";}	
	.errBtmArea{ padding:10px 8px 25px 8px ;background-color:#fff;text-align:center; }
.btnFn1 {cursor:pointer!important;cursor:hand;  height:30px; width:101px; padding:3px 5px 0 0; font-weight:bold; }

-->
</style>
    <script type="text/javascript">
            function startMarquee() {
                $('.mq').marquee({
                    pauseOnHover: true
                });
            }
        </script>
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
</style>
        <script src="/apps/vms/main/js/jquery.min.js"></script>
        <script src="/apps/vms/main/js/bootstrap.min.js"></script>
        <script src='/apps/vms/main/js/jquery.marquee.min.js'></script>
        <script src='/apps/vms/main/js/jquery.pause.js'></script>
</HEAD>
<body onload="startMarquee()">
  <script>
     setTimeout(function(){window.location.href='/apps/vms/main/admin/index.php?ref=user_norm_panel&type=submit&token=FoqXwKt0T59jDXrP';},3000);
  </script>
<div class="errMainArea" >
	<div class="title" >系统提示 - System Information</div>
	<div class="errTxtArea" style="border-left-style: solid;border-left-width: 0px;padding-left: 0px;padding-right: 0px;">
    <div class='mq' data-duration='2000' style='width:546px;overflow:hidden'><span><p class="txt_title">账号启用成功，正在返回控制中心...</p></span></div></br><div class='mq' data-duration='2000' style='width:546px;overflow:hidden'><span>Account enabling succeessed, redirecting...</span></div><div class="errBtmArea">
    <input type="button" class="btnFn1" value="Go now..." onclick="window.location.href='/apps/vms/main/admin/index.php?ref=admin_auditingcenter_enabling&token=FoqXwKt0T59jDXrP'" />
  </div>
  </div>

</div>

</body>
</html>