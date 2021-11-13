<?php
session_start();
if(!isset($_SESSION['login']))
{
 header("Location:signin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php 
require "connection.php";
        $id_login=$_SESSION['login_id'];
        $response=mysqli_query($con,"select * from register where id=$id_login");
        if($response){
            while($data=mysqli_fetch_assoc($response))
            {
                $name=$data['name'];
                $email=$data['email'];
            }
        } 
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- for favicon  -->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- materialize  -->
    <link rel="stylesheet" href="materialize.min.css">
    <!-- custom css style -->
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>HomePage/Notes </title>
</head>
<style>

     h4{
    margin-top:15%;
    color:red;
}
   .box{

        /* margin-top:10rem; */
        padding: 10px 20px;
        color: red;
        font-size:16px;
        border: 1px dotted  var(--white);
        /* height: 100px; */
        width: 300px;
        overflow: hidden;
}

/* search  */
input:focus{
     width:200px;
 }
 .right{
     margin-top: -50px;
     margin-right:50px ;
 }

/* 
.container .material >h4 {
    margin-top:-5%;
} */

.material {
    /* margin-top:-8%; */
}

.small{

    font-size:12px;
    /* color:red; */
}
:root{
    white:black;
    black:white;
}
.card{
    border: .2px dotted var(--white);
    /* padding:10px 200px; */
    margin-left:20px;
    background: var(--black);
    color:var(--white);

}

.card .card-header{
    font-size:120%;
    font-weight:900;
    /* border-bottom:1px solid var(--white); */
}

@media and (min-width:768px){
    .material h4{
        margin-top:-8%;
    }
}
</style>
<body>
    <div id="navbar" class="navbar navbar-expand navbar-dark fixed-top ">
        <div class="collapse navbar-collapse  " id="navbarSupportedContent">
            <ul>
                <li class="logo  mt-0">
                    <!-- //mt-3 "> -->
                <img src="logo.jpg" style="margin-top:-1%;width:80px;height:100%;"alt="">
                    <!-- CollegeZone -->
                </li>
            </ul>
            <ul class="navbar-nav ml-4 px-4">
                <li class="nav-item ">
                    <span class="nav-link close">&times;</span>
                </li>
                <li class="nav-item ml-lg-4 px-4 ">
                    <a href="user.php" class="nav-link active">Notice</a>
                </li>
                <li class="nav-item ">
                    <a href="notes.php" class="nav-link grey lighten-1 white-text" >Notes</a>
                </li>
                <li class="nav-item ">
                    <a href="timetable.php" class="nav-link">Time Table</a>
                </li>
                <li class="nav-item ">
                    <a href="user.php"class="nav-link " >Announcement</a>
                </li>
                <!-- darktheme -->
                <li class="nav-dark darktheme nav-item" onclick="darktheme(); ">
                    <i class="material-icons right purple-text mt-1 px-1 py-1 red" id="icon" style="width:30px;height:30px;border-radius:50%;" >light</i>
                </li>
                <li class="menu_dot">&#9776</li>
            </ul>
        </div>
        <p class='username left px-4 mt-2'>Hi!<br> <?php echo ucwords($name);?></p> 
    </div>
    
    <!-- profile  -->
    <div class="action">
        <div class="profile" id="profile" onclick="show();">
        <?php 
        $res=mysqli_query($con,"select * from user_profile where id=$id_login");
        if($res){
            while($data=mysqli_fetch_assoc($res))
            {
                $pic=$data['pic'];
                if($pic=="" ){
            ?>
                 <img style="width:50px;height:40px;" src="profile.png" alt="user_pic">
        <?php 
                }
                else{
            ?>
                <img style="width:50px;height:40px;" src="user/<?php echo $pic;?>" alt="">
        
        <?php }
            }
        }
        ?>
        </div>
        <div class="menu">
        <img class="center" style="width:100px;height:100px;" src="user/<?php echo $pic; ?>" alt="">
            <h3 ><?php echo ucwords($name);?> <br><span><?php echo ucfirst($email); ?></span></h3>
            <ul>
                <li><img src="profile.png" alt=""><a href="myprofile.php">My profile</a></img></li>
                <!-- <li><img src="edit.png" alt=""><a href="#">Edit Profile</a></img></li> -->
                <!-- <li><img src="inbox.png" alt=""><a href="#">Inbox</a></img></li> -->
                <li><img src="settings.png" alt=""><a href="change_pwd.php">Change Password</a></img></li>
                <!-- <li><img src="help.png" alt=""><a href="#">Help</a></img></li> -->
                <li><img src="logout.png" alt=""><a href="logout.php">Logout</a></img></li>
            </ul>
        </div>
    </div>
    <!-- prifile end -->

<div class="row">
    <div class="container-fluid">
    
    <!-- <div class="container"> -->
              <!-- #################################################view notice -->
              <div class=" material col l9 m9 s12">
                <h4>Notes</h4>
                    <?php
                         $sql="select Distinct subject from notes ORDER BY subject ASC";
                         $sql1="select * from notes";
                        $response=mysqli_query($con,$sql);
                        $response1=mysqli_query($con,$sql1);
                    ?>
                </div>
        <!-- display all notes -->
          <?php 
                if($response){
                    while($data=mysqli_fetch_assoc($response)){
            ?>
            <div class="col s12 m6 l4 ">
                <div class="card ">
                    <div class="card-header">
                        <?php echo ucwords($data['subject']);?> 
                    </div>
                    <div class="card-action ">
                        <a href="subject_notes.php?subj=<?php echo $data['subject'];?>" class=" center btn blue">Open</a>
                    </div>
                </div>
            </div>
        <?php
        }
    }
        else{
            echo "<h5>No Records Fund</h5>";
            }   
            ?>
        </div>
            </div>
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
    }

    var close_menu = document.querySelector('.close');
    close_menu.onclick = () => {
        menu_dot.style.display = "block";
        var open = document.querySelector(".navbar-nav");
        open.style.left = "-100%";
    }
    // 3_dot menu end


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