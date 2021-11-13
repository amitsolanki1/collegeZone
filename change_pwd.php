<?php
    session_start();
    if(!isset($_SESSION['login_id'])){
        header("Location:sigin.php");
    }
    require "connection.php";
    if(isset($_POST['submit']))
    {
        $id=$_POST['id'];
        $pwd=mysqli_real_escape_string($con,password_hash($_POST['new_pwd'],PASSWORD_BCRYPT));
        $re_pwd=mysqli_real_escape_string($con,$_POST['re_pwd']);
        if(empty($pwd)|| empty($re_pwd))
        {
            echo "black";
            $_SESSION['update_error']="Please enter password!";
        }
        // else if($pwd==$re_pwd){
            else if(password_verify($re_pwd,$pwd))
            {
            echo"<script>alert('login');</script>";
            $sql="UPDATE register SET pwd='$pwd' WHERE id=$id ";
            $insert=mysqli_query($con,$sql); 
            if($insert){
                 $_SESSION['update_error']="Password Sucessfully Update";
            }
        }
        // <!-- for password unmatch -->
        else{
            echo "<script>alert('not update')</script>";
            $_SESSION['update_error']="Please enter correct password!";
        }
        header("Location:change_pwd.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php 
        $id_login=$_SESSION['login_id'];
        $response=mysqli_query($con,"select * from register where id=$id_login");
        if($response){
            while($data=mysqli_fetch_assoc($response))
            {
                $name=$data['name'];
                $email=$data['email'];
                $pwd=$data['pwd'];
            }
        ?>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="materialize.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $name."/Password change"?></title>
</head>
<style>
    #name,#pwd,#email{
        background: rgb(207, 207, 32);     
    }
    .small{
        color:rgba(0,0,0,.4);
        font-size:11px;
    }
</style>
<body class="grey lighten-3">
    <!-- <a href="user.html">
        <i class="material-icons">chevron_left</i>
    </a> -->
    <div class="container row ">
        <h3>Change Password</h3>

        
       
        <div class="section col l12 m12 s12">
        <?php if(isset($_SESSION['update_error'])){?>
         <h6 class="text-white red darken-1 center" style="height:30px;padding-top:5px;">
                  <?php  echo $_SESSION['update_error'];?>
        </h6>
    <?php
}?>
    <br>
        <div class="box ">
                <form action="change_pwd.php" method="POST" style="width: 100%; ">
                    <div class="input-field ">
                        <input type="hidden" name="id" value="<?php echo $id_login; ?>" id="id">
                    </div>
                    <div class="input-field ">
                        <input type="text"  readonly name="name" value="<?php echo $name; ?>" id="name">
                        <label for="name">Name</label>
                    </div>
                    <div class="input-field">
                        <input type="email"  readonly name="email" value="<?php echo $email; ?>"  id="email">
                        <label for="name">Email ID</label>
                    </div>
                    <div class="input-field">
                        <span class="small">password in encrypted form</span>
                        <input type="password" readonly name="pwd" value="<?php echo $pwd; ?>"" id="pwd">
                        <label for="name">Password</label>
                    </div>
                    <div class="input-field">
                        <input type="password" name="new_pwd" id="new_pwd">
                        <label for="new_pwd">New Password</label>
                    </div>
                    <div class="input-field">
                        <input type="password" name="re_pwd" id="new_pwd">
                        <label for="new_pwd">Re-Password</label>
                    </div>
                    <div class="input-field">
                        <button type="submit"id="pwd_done"class="btn blue hoverable" name="submit"
                        ><i class="medium material-icons left">done</i>Done</button> 
                        <!-- <input type="submit" name="submit" value="Done" class="btn blue"/> -->
                    </div>
                                       
                </form>
            </div>
        </div>
        <?php }
        else{
            echo "";
        }
        ?>
    </div>
<script src="materialize.min.js"></script>
<script>
     // pwd change btn
    //  var pwd_btn=document.getElementById("pwd_done");
    // pwd_btn.addEventListener("click", function(){
    //     console.log("");
    //             setTimeout(function(){
    //             pwd_btn.innerHTML = "Done";
    //             pwd_btn.disabled = false;
    //             window.location="change_pwd.php";    
    //         },1000);
    //         pwd_btn.innerHTML = "Wait...";
    //         pwd_btn.disabled = true;            
    // });
</script>
</body>
</html>
