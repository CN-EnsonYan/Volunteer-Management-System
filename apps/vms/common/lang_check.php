<?php

$userLangF=$_COOKIE['userLang'];

if ($userLangF == "cn"){
include "../languages/zh_CN/lang-dict.php";
} else if ($userLangF == "en"){
include "../languages/en_US/lang-dict.php";
} else {
include "../languages/en_US/lang-dict.php";
}

echo "$userLang";
?>