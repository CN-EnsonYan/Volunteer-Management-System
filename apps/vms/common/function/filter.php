<?php
function filter(str) { 
  var pattern=/[`~!@#$^&*()=|{}':;',\\\[\]\.<>\/?~！@#￥……&*（）——|{}【】'；：""'。，、？]/g;
  return str.replace(pattern,"");
}
?>