<?php

 if($_session['time']+14>time()){

    $_session['time']=time();

}else{

session_destory();

exit;

} 

?>