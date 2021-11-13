<?php
session_start();
sleep(1);
unset($_SESSION['update_error']);
unset($_SESSION['announcement_sucess']);

if(!isset($_SESSION["admin"])) 
{
    header("Location:signin.php");
}
else{
require "connection.php";

// #####################################################################################################
//  insert timetable data
if(isset($_POST['publish_timetable']))
{
    $time_from=$_POST['time'];
    $time_to=$_POST['time_to'];
    $subject=$_POST['subject'];
    $semester=$_POST['semester'];
    $course=$_POST['title'];
    $day=$_POST['day'];
    $room=$_POST['room'];

    // echo "<pre>";
    // print_r( $_FILES);
    // echo "</pre>";
    if( $time_from=="" ||empty($time_to) || empty($subject) ||empty($semester) )
    {   
        $_SESSION["timetable_publish_error"]="Please enter * Field";
    }
    else{
        foreach($_FILES['file']['name'] as $key=>$val){
            $file=$val;
            // echo $file;
            if(!file_exists('media/'.$file))
            {
            move_uploaded_file($_FILES['file']['tmp_name'][$key],'media/'.$file);
            // echo $_FILES['photo']['tmp_name'][$key];
            }
            else{
                $rand=rand('111111','999999');
                $file=$rand."_".$file;
                move_uploaded_file($_FILES['file']['tmp_name'][$key],'media/'.$file);
            }
        $create_time=date('Y-m-d h:i');
        $insert=mysqli_query($con,"INSERT into timetable(course,time_from,time_to,day,subject,room,semester,time,file) 
        VALUES('$course','$time_from','$time_to','$day','$subject','$room','$semester','$create_time','$file')");// or die(mysqli_error());
        if($insert){
            echo "<script>alert('publish timetable');</script>";
            $_SESSION['timetable_sucess']="Sucessfully Publish";
            // echo"timetable publish ";
        }
        else{
            echo"timetaxble publish error";
            // echo "<script>alert(' timetable error');</script>";
        }
        // else{
        //     $_SESSION['timetable_sucess']="some Error Occur Check your internt connect";
        // }
    }
header("Location:timetable_main.php");
}

}
}


// #####################################################################################################
//  insert timetable data
if(isset($_POST['notes']))
{
    $subject=$_POST['subject'];
    $topic=mysqli_real_escape_string($con,$_POST['topic']);
    $semester=$_POST['semester'];

    if( $subject=="" ||$_FILES['file']['size']=="" || empty($topic))
    {   
        $_SESSION["timetable_publish_error"]="Please enter * Field";
    }
    else{
        foreach($_FILES['file']['name'] as $key=>$val){
            $file=$val;
        
            echo $file;
            if(!file_exists('media/'.$file))
              {
            move_uploaded_file($_FILES['file']['tmp_name'][$key],'media/'.$file);
            // echo $_FILES['photo']['tmp_name'][$key];
            }
            else{
                $rand=rand('111111','999999');
                $file=$rand."_".$file;
                move_uploaded_file($_FILES['file']['tmp_name'][$key],'media/'.$file);
            }
        $create_time=date('Y-m-d h:i');
        $insert=mysqli_query($con,"INSERT into notes(subject,topic,semester,time,file) 
        VALUES('$subject','$topic','$semester','$create_time','$file')");// or die(mysqli_error());
        if($insert){
            $_SESSION['timetable_sucess']="Sucessfully Publish";
        }
        else{
            echo"";
        }
        // else{
        //     $_SESSION['timetable_sucess']="some Error Occur Check your internt connect";
        // }
    }
}
header("Location:admin_notes.php");
}






// ###############################################################################################
//  insert announcement
if(isset($_POST['publish_announcement']))
{
    $anno=mysqli_real_escape_string($con,$_POST['announcement']);
    if(empty($anno))
    {   
        $_SESSION["announcement_sucess"]="Please enter * Field";
    }
    else{
        $create_time=date('Y-m-d h:i');
        $insert=mysqli_query($con,"INSERT into announcement(announcement,time) 
        VALUES('$anno','$create_time')");
        if($insert){
            // echo "<script>alert('publish announcement');</script>";
            $_SESSION['announcement_sucess']="Announcement Sucessfully Add";
        }
        else{
            header("Location:announcement.php");
        }
    }
header("Location:announcement.php");
}


// #####################################################################################################
//  insert notice data
if(isset($_POST['publish_notice']))
{
    $title=mysqli_real_escape_string($con,$_POST['title']);
    $desc=mysqli_real_escape_string($con,$_POST['desc']);
    
    // echo "<pre>";
    // print_r( $_FILES);
    // echo "</pre>";
    if( $title=="" )
    {   
        $_SESSION["notice_publish_error"]="Please enter * Field";
        // <!-- header("Location:admin_panel.html"); -->
    }
    else{
        foreach($_FILES['file']['name'] as $key=>$val)
        {
            $file=$val;
            // echo $file;
            if(!file_exists('media/'.$file))
            {
            move_uploaded_file($_FILES['file']['tmp_name'][$key],'media/'.$file);
            // echo $_FILES['photo']['tmp_name'][$key];
            }
            else{
                $rand=rand('111111','999999');
                $file=$rand."_".$file;
                move_uploaded_file($_FILES['file']['tmp_name'][$key],'media/'.$file);
            }
            $create_time=date('Y-m-d h:i');
            // echo $create_time;
            $insert=mysqli_query($con,"INSERT into NOTICE(title,description,time,file) 
            VALUES('$title','$desc','$create_time','$file')");// or die(mysqli_error());
            if($insert){
                echo "<script>alert('publish notice');</script>";
                $_SESSION['notice_sucess']="Sucessfully Publish";
                $desc="";
                $title="";
            }
            else{
                // echo"notice publish error";
                echo "<script>alert(' notice error');</script>";
            }
        }
    }
    header("Location:admin_panel.php");

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- cdn link for materialize css  -->
    <link rel="stylesheet" href="materialize.min.css">
    <!-- for favicon  -->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
     <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!--cdn cloudfare link Jquery 3.6 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<style>
    html {
        scroll-behavior: smooth;
    }
    .row .content {
        padding: 0 100px 10px;
    }
    .row .main {
        display: inline;
        display: flex;
        width: 100%;
        background: #000;
        height: 3rem;
        justify-content: center;
    }
    .row .main a {
        position: relative;
        top: .5rem;
        text-decoration: none;
        color: #fff;
        padding: 100px 20px;
        opacity: .8;
    }
    .row .main a:hover {
        opacity: 1;

    }
    form {
        display: none;
    }
/* form click btn */
    .active.form_btn {
        display: block;
    }

    .btn a {
        cursor: pointer;
        user-select: none;
    }
/* search btn  */
    #searchbtn{
        margin-top:10px;
    }
    .content{
        /* position:absolute; */
        margin-left:200px;
    }
    /* table style border */
    .table tr th{
        background: grey;
        color:white;
    }
    .table tr,th,td{
        border:.6px solid black;
    }
    /* time for admin below admin panel  */
    .small_time{
        position: absolute;
        margin-left:6rem;
        margin-top:14px;
        font-size:12px;
        color:rgba(255,255,255,.7);
    }

    #navbar li {
        padding :10px 25px;
        width:100px;
        height: 40px;
        color:rgba(255,255,255,.5);
    }

    #navbar li a:hover{
        transform:perspective(900)  rotateY(30deg);
        transition:.5s;
        color:purple;
        background: rgba(255,0,0,.5);
        height: 40px;
    }
    #sidenav {
        background: grey;
        height:100vh;
    }
/* navbar  */
    .side{
        height:100vh;
    }
    .sidenav-fixed li a{
        width:200px;
    }

    /* media query */
/* ########### media query for medium device   */

@media (min-width:601px) and (max-width:1291px){
/* side nav */
    .sidenav-fixed li a{
        font-size:90%;
        width:100%;
    }
}

@media (min-width:601px ) and (max-width:891px){
    .sidenav-fixed li a{
        font-size:60%;
    }
}
    @media (max-width:600px){
   h4{
        display:flex;
        justify-content:center;
        align-items:center;
    }
    .table{
    margin-left:-15%;
    }
    .table th{
        display:none;
    }
     .table,.table tr,.table td{
        display:block;
        width:140%;
    }
    .table tr{
        margin-bottom:20px;
    }
    .table tr td{
        text-align:right;
        padding-left:100%;
        position: relative;
    }
    .table td:before{
        content:attr(data-label);
        position: absolute;
        left:0;
        width:50%;
        padding-left:15px;
        font-weight:600;
        font-size:15px;
        text-align:left;
        background: red;
    }
    .container .brand-logo{
        margin-top:-5px;
        margin-left:-30%;
    }
    #time{
        margin-top:20px;
        margin-left:-3%;
        font-size:8px;
    }
    #searchbtn{
        margin-right:0px;
        /* width:50px; */
    }
    .content{
        margin-left:0px;
    }
    
    .side{
        height:60vh;
    }
    .sidenav-fixed{
        /* padding:10px; */
        /* height:10vh; */
    }
    .sidenav-fixed li{
        display:flex;
        justify-content:center;
        align-items:center;
    }
    .sidenav-fixed li a{
        width:200px;
        /* color:red; */
    }


}

@media (max-width:520px){
    #export{
        margin-top:-60px;
        margin-left:50%;
    }
    h4{
        font-size:180%;
    }
}
/* media query end */
</style>
<body>
    <nav class="navbar-fixed">
        <div class="nav-wrapper grey darken-3 ">
            <div class="container">
                <a class=" brand-logo center purple-text ">Admin Panel</a>
                <!-- search btn  -->
                <div class="input-field right white lighten-1 " id="searchbtn" style="width:200px;">
                    <input type="search" id="search" class="left"placeholder="Search" name="search" />
                    <!-- <label for="search"><i class="material-icons left black-text">search</i>Search</label> -->
                </div>
            <div>
                    <span id="time"></span>
                </div>
            </div>
        </div>
    </nav>
    <div class="row ">
        <!-- ###################################################################################   side nav bar-->
        <div class="side col l2 m2 s12 grey darken-3" style="">
            <ul class="sidenav-fixed grey darken-3 " id="navbar  " >
            <li><a href="admin_panel.php" class="btn white-text">Notice</a></li><br>
            <li><a href="announcement.php" class=" btn white-text ">Announcement</a></li><br>
            <li><a href="timetable_main.php" class="btn white-text " >TimeTable</a></li><br>
            <li><a href="admin_notes.php" class="btn white-text ">Notes</a></li><br>
            <br>
            <li><a href="myprofile.php" class="btn blue white-text">Profile</a><li>
            <li><a href="change_pwd.php" class="btn blue white-text ">Password</a></li>
            <li><a href="logout.php" class="btn blue white-text  ">Logout</a></li>
            </ul>
        </div>
<script>
    // show time
    let time=document.getElementById("time");
    let a=new Date();
    time.innerHTML ="Today Date "+a.getDate()+ ":" +a.getMonth()+ ":"+a.getFullYear();
    // time.innerHTML+="Today Time="+a.getHours()+ ":" +a.getMinutes()+ ":"+a.getSeconds();
    time.classList.add("small_time");
    time.style.fontSize="16px";
</script>
