<?php
session_start();
require "connection.php";
if(!isset($_GET['did']) || empty($_GET['did']))
{
    header("Location:admin_panel.html");
}
else{
    $did=$_GET['did'];
    $dfile=$_GET['dfile'];
    echo $dfile;
   
    // <!--delete record form table -->
    $result= mysqli_query($con,"delete from notice where id='$did' ") or die(mysqli_error($con));
    if($result)
    {   
        // unlink i used to delete file from folder
        unlink("media/".$dfile);
        header("Location:admin_panel.php");
    }
}

?>