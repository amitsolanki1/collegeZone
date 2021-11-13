<?php
    session_start();
// unset($_SESSION['profile_error']);
    if(!isset($_SESSION['login_id'])){
        header("Location:sigin.php");
    }
    require "connection.php";
    if(isset($_POST['submit']))
    {
        $id=$_POST['id'];
        // echo "<script>alert('djkhks'.$id);</script>";
    //   echo $id;
        $file= $_FILES['file']['name']; 
           echo $file;     
            move_uploaded_file($_FILES['file']['tmp_name'],'user/'.$file);
            // $sql="UPDATE register SET pic=$file WHERE id=$id ";
            $createtime=date('Y-m-d h:i:s');
            $sql="insert into user_profile (id,pic,time) values('$id','$file','$createtime')";
            $insert=mysqli_query($con,$sql); 
            if($insert){
                ?>
                <script>alert("done");</script>
                <?php
                
                echo "<script>alert('done');</script>";
                 $_SESSION['profile_error']="Picture Sucessfully Add";
            }
            else{
                echo "eeror";
                ?>
                <script>alert("error");</script>
                <?php
                echo "<script>alert('error');</script>";
            }
        header("Location:myprofile.php");
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

        } 
        $res=mysqli_query($con,"select * from user_profile where id=$id_login");
        if($res){
            while($data=mysqli_fetch_assoc($res))
            {
                $pic =$data['pic'];
            }
        }
?>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="materialize.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name;?> Profile details </title>
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
<a href="user.php"><i class="small material-icons left">back</i></a> 
    <div class="container row ">
        <h3>User Profile</h3>
        <div class="section col l12 m12 s12">
        <?php if(isset($_SESSION['profile_error'])){?>
             <h6 class="text-white red darken-1 center" style="height:30px;padding-top:5px;">
                  <?php  echo $_SESSION['profile_error'];?>
            </h6>
        <?php
        }
        else{
            echo "";
        }
        ?>
        <br>
        <div class="box col s12 ">
                <form action="myprofile.php" method="POST" style="width: 100%;" enctype="multipart/form-data">
                    <div class="input-field ">
                        <img style="width:100px;height:100px;"src="user/<?php echo $pic; ?>" alt="" >
                    </div>
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
                    <label for="file">Add Profile Picture</label>
                    <div class="input-field">
                        <input type="file" name="file" id="file">
                    </div>
                    <div class="input-field">
                        <input type="submit" class="btn blue hoverable" name="submit"
                        value="Done"/> 
                    </div>
                </form>
            </div>
            <div class="section">
                <br>
                <button id="dlt_btn" onclick='done(<?php echo $id_login;?>)'; name="dlt_btn" class="btn red link"><i class="material-icons white-text ">close</i>Delete Account</button>
            </div>
        </div>
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


    function done(id){
        var response=confirm('Do you really want to delete this account?');
        console.log(response);
        console.log(id);
        if(response){
            $res=mysqli_query($con,"delete from register where id="+id);
                        if($res){
                            // unlink i used to delete file from folder
                            unlink("media/".$dfile);
                            unset($_SESSION['login_id']);
                            unset($_SESSION["login_name"]);
                            header("Location:signin.php");
                        }
                        else{
                            header("Location:myprfile.php");
                        }      
        }
    }
</script>
</body>
</html>
