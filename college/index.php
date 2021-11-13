<?php
    if(isset($_COOKIE['user']))
    {
        $name=$_COOKIE['user'];
        require_once"connection.php";
        session_start();
        // for admin
        if($name=="Admin" || $name=="ADMIN" || $name=="admin"){
            $sql="select * from register where email='$name'";
            $result=mysqli_query($con,$sql);
            $ans=mysqli_num_rows($result);
            if($ans==1){
                $data=mysqli_fetch_array($result);
                {
                    $_SESSION['admin']="yes";
                    $_SESSION['login_id']=$data['id'];
                    $_SESSION["login_name"]= $data['name'];
                    header("Location:admin_panel.php");
                }        
            }
        }
        // for user 
        else{
        $sql="select * from register where email='$name'";
        $result=mysqli_query($con,$sql);
            $ans=mysqli_num_rows($result);
            if($ans==1){
                $data=mysqli_fetch_array($result);
                {
                    $_SESSION['login']="yes";
                    $_SESSION['login_id']=$data['id'];
                    $_SESSION["login_name"]= $data['name'];
                    header("Location:user.php");
                }        
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="College-Zone is an easy and simple method for the teachers and students
     to come closer to each other with follow some simple steps teacher(admin) can upload useful information for 
     students and students can view the information.">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
	<title>CollegeZone</title>
    <!-- cdn bootstrap link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="bootstrap.css" type="text/css"> -->
    <!-- cdn javascriptbootstrap link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <!-- materialize css link -->
    <link rel="stylesheet" href="materialize.min.css">
    <!-- custom file css link -->
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div id="preloader">
    </div>
    <div id="navbar" class="navbar navbar-expand navbar-dark fixed-top ">
        <div class="collapse navbar-collapse  " id="navbarSupportedContent">
            <ul>
                <li class="logo mt-0" style="font-size:1.5rem;font-family: 'Lucida Grande';">
                <img src="logo.jpg" style="margin-top:-1%;width:80px;height:100%;"alt="">
                <!-- CollegeZone -->
            </li>
            </ul>
            <ul class="navbar-nav ml-4 px-4">
                <li class="nav-item ">
                    <span class="nav-link close">&times;</span>
                </li>
                <li class="nav-item  px-4 ml-lg-4">
                    <a href="#header" class="nav-link  ">Home</a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link " href="#contact">Contact
                    </a>
                </li>
                <li class="nav-item ml-lg-4">
                    <a href="#footer" class="nav-link">About</a>
                </li>
                <li class="nav-item loginbtn ml-4 mt-2">
                    <a href="signin.php" id="loginbtn" class=" modal-trigger">LogIn</a>
                </li>

                <!-- darktheme -->
                <li class="nav-dark darktheme nav-item" onclick="darktheme(); ">
                    <i class="material-icons right purple-text mt-1 px-1 py-1 red" id="icon" style="width:30px;height:30px;border-radius:50%;" >light</i>
                </li>

                <li class="menu_dot">&#9776</li>
            </ul>
        </div>
    </div>

    <header id="header">
         <div class="overlay" id="overlay">
        </div>
        <div class="title">
            <h1>CollgeZone</h1>
        </div>
    </header>
    <section id="section" >
        <p class="p-4 ">College-Zone is an easy and simple method for the teachers and students to come closer to each other
             with follow some simple steps teacher(admin) can upload useful information for 
                    students and students can view the information.
        </p>
    </section>

    <!-- contact -us  -->
    <div class="row">
    <div class="contact-us container col l9 m9 s12" id="contact">
        <h1>Contact Us</h1>
        <hr></hr>
        <div class="contact-form">
        <form action="https://postmail.invotes.com/send" method="post" id="email_form">
            <div class="input-field">
                <input type="text" id="name" name="extra_fullname" />
                <label for="name"><i class="material-icons left">person</i>Name</label>
            </div>
            <div class="input-field">
                <input type="email" id="email" name="extra_email" />
                <label for="email"><i class="material-icons left">email</i>Email ID</label>
            </div>
            <div class="input-field">
                <input type="text" id="subject" name="subject" />
                <label for="subject"><i class="material-icons left">subject</i>Subject</label>
            </div>
            <div class="input-field">
                <input type="text" name="text" id="message">
                <label for="message"><i class="material-icons left">details</i>Message</label>
            </div>
            <input type="hidden" name="access_token" value="z2fjc6djdcdmwu5ntffv192y" />
            <input type="hidden" name="success_url" value="amazon.com" />
            <input type="hidden" name="error_url" value=".?message=Email+could+not+be+sent.&isError=1" />
            <input type="submit"  id="submit_form"  class="btn btn1 btn1-block pt-0 hoverable " value="Send" />
    <br><br>          
      <!-- <span>Powered by <a href="https://postmail.invotes.com" target="_blank">PostMail</a></span> -->
        </form>
        </div>
    </div>
    </div>
    <script>
        var submitButton = document.getElementById("submit_form");
        var form = document.getElementById("email_form");
        form.addEventListener("submit", function (e) {
            setTimeout(function () {
                submitButton.value = "Sending...";
                submitButton.disabled = true;
            }, 1);
        });
    </script>
<!-- add footer page -->
    <?php include("footer.php");  ?>
    </div>
    <!-- <h4 id="demo"></h4> -->
    </body>
    <script src="jquery.js"></script>
    <script src="loginjs.js"></script>
    <!-- ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
    // function post() {
    //     window.location = "post1.php";
    // }
    function show() {
        let show_menu = document.querySelector('.menu');
        show_menu.classList.toggle('toggle');
    }

    // dark theme
    // let darktheme_btn1 = document.querySelector('#icon');
    //     darktheme_btn1.onclick=()=>{
    //         darktheme_btn1.style.backgroundColor="var(--white)";

    //      darktheme_btn1.style.borderRadius="50%";  
    //     }

    // theme
    function darktheme() {
        var darktheme = document.body;
        let click = darktheme.classList.toggle('dark');
        if (click) {
            let theme = localStorage.setItem('theme', 'white');
        }
        else {
            let theme = localStorage.removeItem('theme', 'white');
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

</html>