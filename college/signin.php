<!-- let theme = localStorage.removeItem('sucess', $data['email']); -->
<?php
require"connection.php";
session_start();

// ###############################################################################################
// login btn

if(isset($_POST['submit_login']))
{
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $pwd=mysqli_real_escape_string($con,$_POST['pwd']);
    if(empty($pwd) ||empty($email)  )
    {
        $_SESSION["error"]="Please enter * Field";
        header("Location:signin.php");
    }
    else{
        $sql="select * from register where email='$email'";
        $result=mysqli_query($con,$sql);
        $ans=mysqli_num_rows($result);
        if($ans==1){
            // $result=mysqli_query($con,"select * from register where  pwd='$pwd'") or die(mysqli_error($con));
            $data=mysqli_fetch_array($result);
            if(password_verify($pwd,$data['pwd']))
            {
                // set cookie for 1month
                setcookie('user',$email,time()+(86400*30),'/');
                $_SESSION['login']="yes";
                $_SESSION['login_id']=$data['id'];
                $_SESSION["login_name"]= $data['name'];
                header("Location:user.php");
            }
             else
             {
                // echo"<script>alert('not login');</script>";
                $_SESSION["error"]="Please enter valid password!!";
            }

             // code for admin panel
            if($email=='admin'||$email=='Admin'|| $email=='ADMIN')
            {
                if(password_verify($pwd,$data['pwd']))
                {
                    unset($_SESSION['login']);
                     // set cookie for 1month
                    setcookie('user',$email,time()+(86400*30),'/');
                    $_SESSION['admin']="yes";
                    $_SESSION['login_id']=$data['id'];
                    $_SESSION["login_name"]= $data['name'];
                    // echo"<script>alert('login');</script>";
                    header("Location:admin_panel.php");
                }
                 else
                 {
                    // echo"<script>alert('not login');</script>";
                    $_SESSION["error"]="Please enter valid password!!";
                }
            }
        }
        else
        {
            $_SESSION["error"]="Please enter valid email !";
        }
}
}


// ###############################################################################################
// registration

if(isset($_POST['submit_registration']))
{
    $name=mysqli_real_escape_string($con,$_POST['name']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $pwd=mysqli_real_escape_string($con,password_hash($_POST['pwd'],PASSWORD_BCRYPT));
    // $pwd=mysqli_real_escape_string($con,$_POST['pwd']);
    // $phone=mysqli_real_escape_string($con,$_POST['phone']);
    $dob=mysqli_real_escape_string($con,$_POST['dob']);
    if(empty($name) || $email=="" || empty($pwd) )
    {
        $_SESSION['error']="Please enter * Field";
    }
    else{
        $sql=mysqli_query($con,"select email from register where email='$email'");
        $ans=mysqli_num_rows($sql);
        // echo "<script>alert($ans);</script>";
        if($ans>0){
            $_SESSION['error']="Email Already Exist !!";
        }
        else{
            $insert=mysqli_query($con,"insert into register(name,email,pwd,dob) values('$name','$email','$pwd','$dob')");// or die(mysqli_error($con));
            if($insert){
                $_SESSION['error']="Account Created Successfully ";
            }
        }
        header("Location:signin.php");
       
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="materialize.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registraion</title>
</head>
<style>
    body {
        background-image: url(4.jpg);
        overflow-y: hidden;
    }

    .row .col {
        margin-top: 5%;

        display: flex;
        justify-content: center;
        align-items: center;

    }

    .row .col .login {
        background: rgba(255, 255, 255, .2);
        backdrop-filter: blur(5px);
        padding: 100px 50px;
        border-top: 1px solid rgba(255, 255, 255, .7);
        border-left: 1px solid rgba(255, 255, 255, .7);

        width: 400px;
    }

    .heading {
        /* cursor: pointer; */
        pointer-events: none;
        user-select: none;
        transition: .5s ease-in;
        color: rgba(255, 255, 255, 1);
        font-size: 6rem;
    }

    label .text {
        /* background: red; */
        color: rgba(255, 255, 255, .8);
    }

    input {
        color: rgba(255, 255, 255, .9);
    }

    .row .col .registration_hide {
        position: relative;
        transition: 2s ease-in-out;
        display: none;
        height: 400px;
    }

    @media (max-width:786px) {
        .login {
            margin-top: 15%;
        }

        .btn {
            font-size: 90%;
        }

        .heading {
            font-size: 200%;
        }
    }
</style>

<body>
    <div class="container s12">
        <div class="row ">
            <div class="col s12">
                <div class="login">
                    <div class="">
                        <button class="btn hoverable red" id="loginbtn">Login</button>
                        <button class="btn hoverable " id="registrationbtn">Registraion</button>
                    </div>
                    <div class="login_hide">
                        <h5 class="heading">Login</h5>
                        <div class="error red-text" id="error">
                            <?php if(isset($_SESSION['error'])){
                            echo $_SESSION['error'];
                        }
                        ?>
                        </div>
                        <form action="signin.php" method="post">
                            <div class="input-field">
                                <input type="text" id="email" name="email">
                                <label class="white-text" for="email"><i
                                        class="material-icons left black-text">email</i>Email ID</label>
                            </div>
                            <div class="input-field">
                                <input type="password" id="pwd" name="pwd" />
                                <label class="white-text" for="pwd"><i
                                        class="material-icons left black-text">lock</i>Password</label>
                            </div>
                            <input type="submit" class="btn waves-effect waves-light pulse red hoverable"
                                name="submit_login" value="LogIn" /><i class="material-icons left black-text">login</i>
                        </form>
                    </div>

                    <div class=" registration_hide">
                        <h5 class="heading">Register</h5>
                        <div class="error red-text" id="error">
                            <?php if(isset($_SESSION['error'])){
                            echo $_SESSION['error'];
                        }
                        ?>
                        </div>
                        <form action="signin.php" method="post">

                            <div class="input-field  ">
                                <input type="text" id="name" name="name">
                                <label class="white-text" for="name"><i
                                        class="material-icons left black-text">contacts</i>Name</label>
                            </div>
                            <!-- <div class="input-field  hoverable col s6"> -->
                            <div class="input-field">
                                <input type="text" id="email" name="email">
                                <label for="email" class="white-text validate"><i
                                        class="material-icons left black-text">email</i>Email ID</label>
                            </div>
                            <div class="input-field">
                                <input type="password" id="pwd" name="pwd">
                                <label for="pwd" class="white-text"> <i
                                        class="material-icons left black-text">vpn_key</i>Password</label>
                            </div>
                            <div class="input-field">
                                <input type="date" id="dob" name="dob">
                                <label for="dob" class="white-text">Date OF Birth</label>
                            </div>
                            <div class="input-field">
                                <button type="submit" class="waves-effect waves-light btn red pulse hoverable"
                                    name="submit_registration"><i
                                        class="large material-icons left">done</i>Registartion</button>
                                <!-- value="Registraion" /><i class="small material-icons left">done</i> -->
                            </div>
                        </form>
                    </div>
                    <br>
                    <div class="divider"></div>
                    <a href="index.php">HOME</a>
                </div>
            </div>
        </div>

        <script src="materialize.min.js"></script>
        <script>
            var reg = document.querySelector('#registrationbtn');
            var login = document.querySelector('#loginbtn');
            let login_form = document.querySelector('.login_hide');
            let reg_form = document.querySelector('.registration_hide');
            reg.onclick = () => {
                reg.classList.add('red');
                login.classList.remove('red');
                reg_form.style.display = 'block';
                // login_form.style.transition = '1s';
                login_form.style.display = 'none';
            }
            login.onclick = () => {
                login.classList.add('red');
                reg.classList.remove('red');
                reg_form.style.display = 'none';
                login_form.style.display = 'block';
            }
        </script>
</body>

</html>