<?php
session_start();
if(isset($_SESSION['logged'])){
	echo "Already passed, redirect soon... / 无需重复检查，即将跳转...";
   header("Refresh:1;url=/main/index.php?ref=rt_index.php&redir=yes&type=logged_scp&token=FoqXwKt0T59jDXrP");
} else {	
   echo "Safety Checking, redirect soon... / 环境安全检查中，即将跳转...";
   header("Refresh:2;url=/account/login/index.html?type=sc&stat=passed&token=FoqXwKt0T59jDXrP");
}
?>
<!Doctype HTML>
<title>Safety Checking... / 安全检查中...</title>
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#818eff">
<meta name="theme-color" content="#ffffff">
<!-- Analytics -->
<script type="text/javascript">
  var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//analytics.ensonyan.com/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '3']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Analytics Code -->