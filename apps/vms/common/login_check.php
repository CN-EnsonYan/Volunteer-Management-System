<?php
if(isset($_SESSION['expiretime'])) {
    if($_SESSION['expiretime'] < time()) {
        unset($_SESSION['expiretime']);
        echo "<script type=\"text/javascript\">";
        echo "alert('Login timeout! Your account was automatically logged out. / 账户登陆超时！已被服务器自动注销，请重新登录。')";
        echo "window.location.href = 'https://volunteer.ensonyan.com'";
        </script>
        exit(0);
    } else {
        $_SESSION['expiretime'] = time() + 900; // 刷新时间戳
    }
}
?>