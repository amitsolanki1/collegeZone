
<!DOCTYPE html>
<html lang="en">
<head>
<?php 
session_start();
require "connection.php";
        $id_login=$_SESSION['login_id'];
        $response=mysqli_query($con,"select * from register where id=$id_login");
        if($response){
            while($data=mysqli_fetch_assoc($response))
            {
                $name=$data['name'];
            }
        } 
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- bootstrap -->
    <link rel="stylesheet" href="bootstrap.css">
    <!-- materialize  -->
    <link rel="stylesheet" href="materialize.min.css">
    <!-- login btn style -->
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>View Notice </title>
</head>
<style>
 input:focus{
     width:200px;
 }
 .right{
     margin-top: 30px;
     margin-right:100px ;
 }
 .box{
     border:1px solid red;
 }

</style>
<body>
    <div id="navbar" class="navbar navbar-expand navbar-dark fixed-top ">
        <div class="collapse navbar-collapse  " id="navbarSupportedContent">
            <ul>
                <li class="logo mt-3 ">BOOKS</l i>
            </ul>
            <ul class="navbar-nav ">
                <li class="nav-item ">
                    <span class="nav-link close">&times;</span>
                </li>
                <li class="nav-item  px-4 ml-lg-4">
                    <a href="notice.php" class="nav-link  " target="container">Notice</a>

                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="#contact">Announcement</a>
                </li>
                <li class="nav-item ml-lg-4">
                    <a href="#footer" class="nav-link">Exam</a>
                </li>
                <!-- darktheme -->
                <li class="nav-dark darktheme nav-item" onclick="darktheme(); ">
                    helo <ion-icon id="icon" name="sunny-outline"></ion-icon>
                    <!-- <i class="fas fa-bars"></i> -->
                </li>
                <li class="menu_dot">&#9776</li>
           
                
            </ul>
        </div>
    </div>
    
    <!-- profile  -->
    <div class="action">
        <div class="profile" id="profile" onclick="show();">
            <img src="img.jpg">
        </div>
        <div class="menu">
            <h3>Someone Famous<br><span>Website Designer</span></h3>
            <ul>
                <li><img src="profile.png" alt=""><a href="myprofile.php">My profile</a></img></li>
                <li><img src="edit.png" alt=""><a href="#">Edit Profile</a></img></li>
                <li><img src="inbox.png" alt=""><a href="#">Inbox</a></img></li>
                <li><img src="settings.png" alt=""><a href="change_pwd.php">Change Password</a></img></li>
                <!-- <li><img src="help.png" alt=""><a href="#">Help</a></img></li> -->
                <li><img src="logout.png" alt=""><a href="logout.php">Logout</a></img></li>
            </ul>
        </div>
    </div>
    <!-- prifile end -->
<div class="section">
    
    <!-- search btn  -->
    <div class="right" style="width:200px;">
        <input type="search" id="search" placeholder="Search"name="search" />
    </div>

    <!-- show notice -->
    <div class="container">
        <h4>View Notice</h4><br><br>    
        <div class="box">
            <!-- php code -->
            <div class="card-content">
                <h6>notice </h6>
                <span>date</span>
                <p>paragram</p>    
            </div>
        </div>
    </div>
</div>





<script src="materialize.min.js"></script>
<script>
function show() {
        let show_menu = document.querySelector('.menu');
        show_menu.classList.toggle('toggle');
    }

    // dark theme
    // let darktheme_btn = document.querySelector('#icon');
    //     darktheme_btn.onclick=()=>{
    //         darktheme_btn.style.backgroundColor="var(--white)";

    //      darktheme_btn.style.borderRadius="50%";  
    //     }

    // theme
    function darktheme() {
        var darktheme = document.body;
        let click = darktheme.classList.toggle('dark');
        if (click) {
            let theme = localStorage.setItem('theme', 'white');
            //  console.log("click");
            //  console.log(theme);
        }
        else {
            let theme = localStorage.removeItem('theme', 'white');
            //  console.log("remove");
            //  console.log(theme);
        }
    };
    // check theme is set to be dark or white
    function theme_check() {
        let theme = localStorage.getItem('theme');
        if (theme == "white") {
            console.log(theme);
            darktheme()
        }
    }
    theme_check();
    // theme end



    // 3_dot menu

    var menu_dot = document.querySelector('.menu_dot');
    menu_dot.onclick = () => {
        menu_dot.style.display = "none";
        var open = document.querySelector(".navbar-nav");
        open.style.left = "0%";
        // open.style.display=block;
    }

    var close_menu = document.querySelector('.close');
    close_menu.onclick = () => {
        menu_dot.style.display = "block";
        var open = document.querySelector(".navbar-nav");
        open.style.left = "-100%";
    }
    // 3_dot menu end


    // for scroll picture
    const bg = document.getElementById('header');
    // const rgba_bg=document.getElementById('overlay');

    window.addEventListener('scroll', function () {

        // var scroll=bg.offsetHeight
        bg.style.backgroundSize = 200 - +window.pageYOffset / 5 + '%';
        bg.style.opacity = 1 - +window.pageYOffset / 800 + '';
        // var height=bg.offsetHeight;


        // document.querySelector('.title').style.transform=`translateX(${scroll / height}*50 -10)px`;

        // console.log(bg.style.backgroundSize)

        // if (document.getElementById('section').style.backgroundSize <= 100) {
        //     document.getElementById('section').classList.toggle('a');
        // }

    });


    // fucntion for diaplay user profile icon
    function user_profile_show() {

        let show_user = document.getElementById('profile');
        let user = localStorage.getItem('user');
        console.log(user);

        if (user == 'login') {
            console.log('if');

            show_user.style.display = 'visible';

        }
        else {
            console.log('else');

            show_user.style.display = 'none';

        }
    }
    // user_profile_show();

    // prelaoder

    var preloader = document.getElementById("preloader");
    window.addEventListener("load", function () {
        preloader.style.display = "none";
    })

</script>

</body>
</html>