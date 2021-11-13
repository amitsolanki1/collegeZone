<?php
session_start();
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
   

</head>
<style>
       html{scroll-behavior: smooth;}
    .row .container .main {
        /* text-align: center; */
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
        /* padding-left: 10px; */

    }

    .row .main a:hover {
        opacity: 1;

    }

    form {
        display: none;
    }

    .active.form_btn {
        display: block;
    }

</style>
<body>
    <nav class="navbar-fixed">
        <div class="nav-wrapper bg-dark">
            <div class="container">

                <a class=" brand-logo center purple-text ">Admin Panel</a>
                <a href="" class="button-collapse" data-activates="sidenav"><i class="material-icons">menu</i></a>
                <ul class="hide-on-small-and-down right">
                    <li><a href="">Home</a></li>
                    <li><a href="">contact</a></li>
                    <li><a href="">about</a></li>
                    <li><a href="">Home</a></li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- <ul id="sidenav" class="side-nav">
    <li><a href="">Home</a></li>
<div class="divider"></div>
    <li><a href="">contact</a></li>
<div class="divider"></div>
<li><a href="">about</a></li>
<div class="divider"></div>
    <li><a href="">Home</a></li>

    </ul> -->
    <!-- <div class="container">  -->
    <div class="row ">
        <div class="container">
            <div class="col s12  bg-dark">
                <ul class="center main  white-text">
                    <li><a href="admin_panel.html">Notice</a></li>
                    <li><a href="#timetable" class="active nav-content">TimeTable</a></li>
                    <li><a href="">Exam</a></li>
                    <!-- <li><a href="">Home</a></li> -->

            </div>
</div>
</div>
        </body>
<!-- ionicons -->
<script src="materialize.min.js"></script>

</html>
    
</body>
</html>