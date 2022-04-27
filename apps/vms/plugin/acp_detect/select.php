<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="theme-color" content="#5B9BD5">
<title>EN-NP VMS 管理登录选择 | Admin Login Mode Select. Powered By ENsonYan !</title>
<meta name="description" content="Welcome to EnsonYan's Homepage. 歡迎來到 Enson 的個人主頁。想详细了解 EnsonYan 的更多咨询? 请进入本站了解更多。">
<meta name ="keywords" content="EnsonYan,个人主页,Enson主页,门户站,IT,引导页,语言选择页面">
<style>
body {
  height:100%;
  margin: 0;
  padding: 0;
  background: #202124;
}

@-webkit-keyframes circle {
  0% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
    opacity: 0;
  }
  50% {
    opacity: 1;
  }
  80% {
    -webkit-transform: translateY(-100vh);
            transform: translateY(-100vh);
    opacity: 1;
  }
  100% {
    opacity: 0;
    -webkit-transform: translateY(-100vh);
            transform: translateY(-100vh);
  }
}

@keyframes circle {
  0% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
    opacity: 0;
  }
  50% {
    opacity: 1;
  }
  80% {
    -webkit-transform: translateY(-100vh);
            transform: translateY(-100vh);
    opacity: 1;
  }
  100% {
    opacity: 0;
    -webkit-transform: translateY(-100vh);
            transform: translateY(-100vh);
  }
}
@-webkit-keyframes shadow {
  0% {
    -webkit-transform: scaleY(0);
            transform: scaleY(0);
  }
  30% {
    -webkit-transform: scaleY(1);
            transform: scaleY(1);
  }
  100% {
    -webkit-transform: scaleY(0.5);
            transform: scaleY(0.5);
  }
}
@keyframes shadow {
  0% {
    -webkit-transform: scaleY(0);
            transform: scaleY(0);
  }
  30% {
    -webkit-transform: scaleY(1);
            transform: scaleY(1);
  }
  100% {
    -webkit-transform: scaleY(0.5);
            transform: scaleY(0.5);
  }
}
.shape {
  position: absolute;
  width: 40px;
  height: 40px;
  -webkit-animation: circle 5s linear infinite;
          animation: circle 5s linear infinite;
  -webkit-animation-fill-mode: both;
          animation-fill-mode: both;
  box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
}
.shape::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 260px;
  -webkit-transform-origin: top center;
          transform-origin: top center;
  -webkit-animation: inherit;
          animation: inherit;
  -webkit-animation-name: shadow;
          animation-name: shadow;
}

.circle {
  top: calc(100vh - 66px);
  left: calc(25vw - 66px);
  background: linear-gradient(45deg, #49E7C2 0%, #7AEC90 100%);
  border-radius: 100%;
}
.circle::after {
  background: linear-gradient(-180deg, rgba(73, 231, 194, 0.4) 0%, rgba(28, 28, 28, 0) 100%);
}

.rectangle {
  top: calc(100vh - 66px);
  left: calc(50vw - 66px);
  background: linear-gradient(45deg, #EA9F45 0%, #F4EE51 100%);
  -webkit-animation-delay: 2s;
          animation-delay: 2s;
}
.rectangle::after {
  background: linear-gradient(-180deg, rgba(234, 159, 69, 0.3) 0%, rgba(28, 28, 28, 0) 100%);
  top: 100%;
}

.triangle {
  top: calc(100vh - 66px);
  left: calc(75vw - 66px);
  background: linear-gradient(45deg, #22A0F9 0%, #71FDC8 100%);
  -webkit-clip-path: polygon(0 0, 100% 100%, 100% 0);
          clip-path: polygon(0 0, 100% 100%, 100% 0);
  -webkit-animation-delay: 1s;
          animation-delay: 1s;
}
.triangle::after {
  background: linear-gradient(-180deg, rgba(34, 223, 249, 0.4) 0%, rgba(28, 28, 28, 0) 100%);
  top: 0;
  will-change: transform;
}
a.button {
  position: relative;
  color: rgba(255,255,255,1);
  text-decoration: none;
  background-color: rgba(219,87,5,1);
  font-family: 'Yanone Kaffeesatz';
  font-weight: 700;
  font-size: 3em;
  display: block;
  padding: 4px;
  -webkit-border-radius: 8px;
  -moz-border-radius: 8px;
  border-radius: 8px;
  -webkit-box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
  -moz-box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
  box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
  margin: 100px auto;
  width: 260px;
  text-align: center;
			
  -webkit-transition: all .1s ease;
  -moz-transition: all .1s ease;
  -ms-transition: all .1s ease;
  -o-transition: all .1s ease;
  transition: all .1s ease;
}
a.button:active {
  -webkit-box-shadow: 0px 3px 0px rgba(219,31,5,1), 0px 3px 6px rgba(0,0,0,.9);
  -moz-box-shadow: 0px 3px 0px rgba(219,31,5,1), 0px 3px 6px rgba(0,0,0,.9);
  box-shadow: 0px 3px 0px rgba(219,31,5,1), 0px 3px 6px rgba(0,0,0,.9);
  position: relative;
  top: 6px;
}
  
.page{
    box-sizing: border-box;/*为元素指定的任何内边距和边框都将在已设定的宽度和高度内进行绘制*/
    min-height: 100%;
}
</style>
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#818eff">
<meta name="theme-color" content="#ffffff">
<!-- Matomo -->
<script type="text/javascript">
  var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//analytics.ensonyan.com/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '2']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->
</head>
<body>
    <div class="page">
       <div class="shape circle"></div>
       <div class="shape rectangle"></div>
       <div class="shape triangle"></div>
       <a href="/apps/vms/main/index.php?ref=acp_detect&token=FoqXwKt0T59jDXrP" class="button">普通后台</a>
       <a href="/apps/vms/main/admin/index.php?rel=acp_detect&token=FoqXwKt0T59jDXrP" class="button">管理后台</a>
    </div>
    <div style="position:absolute;bottom:0">
      <font color="#888888">&copy; 2019-2020 <a style=" text-decoration: none; color: #1E90FF;" href="https://www.ensonyan.com" target="_blank">EnsonYan</a>. All Rights Reserved.</font> <button onclick="javascript:window.location.href='https://redir.sh47.ensonyan.com/4/ecom/redir.htm?fp=ecom_b0a443b2533f7b3d292a92232646bc2e'">Visitors Rec.</button>
    </div>
</body>
</html>