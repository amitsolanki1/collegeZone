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
    <title>HomePage/
        <?php echo ucwords($name);?>
    </title>
</head>
<style>
    h4 {
        margin-top: 15%;
        /* display:flex; */
        /* justify-content:center; */
        /* align-items:center; */
        color: red;
    }

    .box {
        padding: 10px 20px;
        color: red;
        font-size: 16px;
        border: 1px dotted var(--white);
        /* height: 100px; */
        width: 300px;
        overflow: hidden;
    }

    .search {
        margin-top: 20px;
        margin-bottom: 40px;
        margin-right: 50px;
    }

    @media (min-width:768px) and(max-width:1295px) {
        .container .material {
            position: relative;
            margin-left: 10%;
        }
    }

    @media (max-width:768px) {
        h4 {
            margin-top: 15%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container-fluid .box {
            /* position:absolute; */
            /* margin-left:100px; */
            display: flex;
            justify-content: center;
            align-items: center;
        }

    }

    .container .material>h4 {
        margin-top: -2%;
    }

    .small {

        font-size: 12px;
        /* color:red; */
    }

    :root {
        white: black;
        black: white;
    }

    .card {
        border: .2px dotted var(--white);
        padding: 10px 20px;
        background: var(--black);
        color: var(--white);
    }

    .card .card-header {
        font-size:140%;
        font-weight:900;
        /* background: rgba(255, 0, 0, .8); */
    }

    @media (min-width:601px) and (max-width:1303px) {
        h4 {
            margin-top: 20%;
        }

        .box {
            width: 90%;
        }

        .search {
            margin-right: 0%;
        }

        .container {
            margin-left: 20%;
        }
    }
</style>
<body>
    <div id="navbar" class="navbar navbar-expand navbar-dark fixed-top ">
        <div class="collapse navbar-collapse  " id="navbarSupportedContent">
            <ul>
                <li class="logo mt-0">
                    <img src="logo.jpg" style="margin-top:-1%;width:80px;height:100%;"alt="">
                </li>
            </ul>
            <ul class="navbar-nav ml-4 px-4 ">
                <li class="nav-item ">
                    <span class="nav-link close">&times;</span>
                </li>
                <li class="nav-item px-4 ml-lg-4">
                    <a href="user.php" class="nav-link">Notice</a>
                </li>
                <li class="nav-item ">
                    <a href="notes.php" class="nav-link">Notes</a>
                </li>
                <li class="nav-item ">
                    <a href="timetable.php" class="nav-link">Time Table</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link grey lighten-1 white-text" href="#box">Announcement</a>
                </li>
                <li class="nav-item logout">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                <!-- darktheme -->
                <li class="nav-dark darktheme nav-item px-4" onclick="darktheme(); ">
                    <i class="material-icons purple-text mt-1 px-1 py-1 red" id="icon" style="width:30px;height:30px;border-radius:50%;" >light</i>
                    <!-- <ion-icon id="icon" name="sunny-outline"></ion-icon> -->
                </li>
                <li class="menu_dot">&#9776</li>
            </ul>
        </div>
        <p class='username right px-4 mt-2'>Hi!<br> <?php echo ucwords($name);?></p> 
    </div>
    
    <!-- user profile  -->
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
            <h3>
                <?php echo ucwords($name);?> <br><span>
                    <?php echo ucfirst($email); ?>
                </span>
            </h3>
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
            <!-- announcement -->
            <div class="col l3 m4 s12">
                <h4>Announcement</h4>
                <div class="box">
                    <!-- behavior=slide -->
                    <!-- direction=right -->
                    <!-- direction=up  -->
                    <!-- scrollamount=50 -->
                    <!-- bgcolor=red -->
                    <marquee direction=up>
                        <?php 
                $res=mysqli_query($con,"select * from announcement ORDER BY announcement DESC");
                if($res){
                    $id =1;
                    while($data=mysqli_fetch_assoc($res))
                    {
                        echo "<p><span class='small'>".$id.") ".$data['time']."</span><br>";
                        echo $data['announcement']."</p>";
                        $id++;
                    }
                }
                ?>
                    </marquee>
                </div>
            </div>
            <!-- search btn  -->
            <br>
            <div class="search  col s12 " style="width:200px;">
                <input type="search" id="search" placeholder="Search" name="search" />
            </div>
            <div class="container ">
                <!-- #################################################view notice -->
                <div class="material col l9 m8 s12 ">
                    <h4>Notice Board</h4>
                    <?php
                         $sql="select * from notice ORDER BY time DESC";
                        $response=mysqli_query($con,$sql);
                    ?>
                    <!-- display all notice -->
                    <?php 
                if($response){
            ?>
                    <div id="show_table_id">
                        <?php
                while($data=mysqli_fetch_assoc($response)){
                    ?>
                        <div class="card ">
                            <div class="card-header">
                                <?php echo ucwords($data['title']);?>
                            </div>
                            <div class="card-title ">
                                <span class="small">
                                    <?php echo"Date: <b>".$data['time']."</b>";?>
                                </span>
                            </div>
                            <div class="card-content ">
                                <?php if(strlen($data['file'])!=0){
                            ?>
                                <a href="media/<?php echo $data['file'];?>" target="_blank" class="btn small blue">file
                                    link here</a>
                                <br>
                                <?php 
                        }
                        ?>
                                <?php echo ucfirst($data['description']);?>
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

    <!-- <script src="jquery.js"></script> -->
    <script src="materialize.min.js"></script>
    <script>

        //  $(document).ready(function() {
        //     // search box   
        //     $("#search").on("keyup", function() {
        //         // e.preventDefault();
        //         var search_term = $(this).val();
        //          if(search_term!="") {
        //             $('#show_table_notice').show();//search
        //             $('#show_table_id').hide();
        //         }
        //         else{
        //             $("#show_table_notice").hide();
        //             $('#show_table_id').show();
        //         }
        //         $.ajax({
        //             url: "search.php",
        //             method: "GET",
        //             dataType: "json",
        //             data: { search: search_term },
        //             success: function(data) {
        //                 console.log(data);
        //                 $('.card').html(data);
        //             },
        //             error: function (data) {
        //                 console.log("error");
        //             }
        //         });
        //     });
        //     // end of search box

        // });

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