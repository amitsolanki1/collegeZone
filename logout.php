<?php
session_start();
session_destroy();
// delete cookie 
setcookie('user','user',time()-3600,'/');
header("Location:signin.php");
?>