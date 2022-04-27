<HEAD>
<TITLE>系统提示 - System Information</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="theme-color" content="#5B9BD5">
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
        <script src="../../main/js/jquery.min.js"></script>
        <script src="../../main/js/bootstrap.min.js"></script>
        <script src='../../main/js/jquery.marquee.min.js'></script>
        <script src='../../main/js/jquery.pause.js'></script>
<script>
var lateHref;
function lvh() {
    mainF = setTimeout(function(){window.location.href='https://verify.volunteer.ensonyan.com/index.php?from=vms_acc_login&page=auth.php&type=ft_login&token=FoqXwKt0T59jDXrP';},2000);
}
</script>
</HEAD>
<body onload="startMarquee()">
<div class="errMainArea" >
	<div class="title" >系统提示 - System Information</div>
	<div class="errTxtArea" style="border-left-style: solid;border-left-width: 0px;padding-left: 0px;padding-right: 0px;">
    <div class='mq' data-duration='5000' style='width:546px;overflow:hidden'><span><p class="txt_title">在进行任何操作之前，你必须实名验证并等待校方通过审核哦！点击下方按钮，将会向你展示本系统的使用教程并引导你进入实名验证中心。</p></span></div></br><div class='mq' data-duration='4000' style='width:546px;overflow:hidden'><span>Before any operation, you must do the Real Name Authorization first~ Click "Go Now", we'll show you the Instruction Tutorial PDF of the VMS system, then you'll be redirect to Real Name Auth. Center.</span></div><div class="errBtmArea">
    <input type="button" class="btnFn1" value="Go now..." onclick="window.open('/apps/vms/tutorial/spdf_plugin<?php if ($userLangF == "cn"){} else if ($userLangF == "cn"){echo "-env";} ?>/web/viewer.html?from=vms_user_main&flogin=true&token=FoqXwKt0T59jDXrP','PDF','height=950,width=700,top=0,right=0,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no'); lvh()" />
  </div>
  </div>

</div>
  

</body>
</html>