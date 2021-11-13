<?php
session_start();
require "connection.php";
if(!isset($_GET['eid']) || empty($_GET['eid']))
{
    header("Location:admin_panel.php");
}
else{
    $eid=$_GET['eid'];
    // <!-- fetch record form table -->
    $result= mysqli_query($con,"select * from notice where id='$eid' ") ;//or die(mysqli_error());
    
    if($result)
    {
        // <!-- fetch single row from table -->
        $data=mysqli_fetch_row($result);
    }
}

// <!-- when page post method apply -->
if(isset($_POST['update']))
{
    $id=$_POST['id'];
    $title =$_POST['title'];
    $notice_type=$_POST['notice_type'];
    $desc=$_POST['desc'];
    $old_file=$_POST['old_file'];
    // echo $_POST['old_file'];

    if($_FILES['file']['name']==''){
        $file=$old_file;
        // $_SESSION['notice_sucess']=$file;
    }
    else{
        $file=$_FILES['file']['name'];
        // $_SESSION['notice_sucess']=$_FILES['file']['name'];
    
        // $file=$new_file;

    // foreach($_FILES['file']['name'] as $key=>$val){
        $file_temp_store=$_FILES['file']['tmp_name'];
        $_SESSION['notice_sucess']=$file_temp_store;
        echo $file_temp_store;
        
        // $file=$val;
        // echo $file;
        // if(!file_exists('media/'.$file))
        // {
        //     $file_temp_store=$_FILES['file']['tmp_name'][$key];
        //     $file_destination='media/'.$file;
        //     move_uploaded_file($file_temp_store,$file_destination);
        //     // echo $_FILES['file']['tmp_name'][$key];
        // }
        // else{
        //     $rand=rand('111111','999999');
        //     $file=$rand."_".$file;
        //     $file_temp_store=$_FILES['file']['tmp_name'][$key];
        //     $file_destination='media/'.$file;
        //     move_uploaded_file($file_temp_store,$file_destination);
            
        
        $file_destination='media/'.$file;
         move_uploaded_file($file_temp_store,$file_destination);
        
    //  }
     }
      $create_time=date('Y-m-d h:i:s');
        echo $create_time;
        $sql="UPDATE notice SET title='$title',notice_type='$notice_type',description='$desc',time='$create_time',file='$file' WHERE id=$id ";
        $insert=mysqli_query($con,$sql); //or die(mysqli_error());
    if($insert){
        echo"update";
        // $_SESSION['notice_sucess']="Record Sucessfully Update";
    }
    else{
        echo "<script>alert('not update')</script>";
    }
    header("Location:admin_panel.php");

// }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="materialize.min.css">
    <title>update </title>
</head>
<body>
    <div class="container">
        <h5 class="purple-text center">Update Notice</h5>
        <div class="container">
            <p class="deep-orange white-text center">
                <?php 
                if(isset($_SESSION['notice_sucess'])){
                    echo $_SESSION['notice_sucess'];
            } ?></p>
        </div>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ; ?>"return false" method="POST" enctype="multipart/form-data">
            <div class="input-field">
                <input type="hidden" value="<?php echo $data[0] ;?>" name="id" >
            </div>
            <div class="input-field">
                <input type="text" value="<?php echo $data[2] ;?>" name="notice_type" id="type">
                <label for="type">Notice Type</label>
            </div>
            <div class="input-field">
                <input type="text" value="<?php echo $data[1] ;?>" name="title" id="title">
                <label for="title">Title</label>
            </div>
            <div class="input-field">
                <input type="text" value="<?php echo $data[3];?>" name="desc" id="desc">
                <label for="desc">Description</label>
            </div>

            <div class="input-field">
                <input type="text" name="old_file" value="<?php echo $data[5];?>">
                <input type="file" name="file" id="file" >
                <img src="<?php echo'media/'.$data[5] ;?> "style="min-width:50px;height:50px; border-radius:50%" />
            </div>
            <input type="submit" class="btn blue darken-3 " name="update"value="Update" />

        </form>

    </div>

    
</body>
<script src="materialize.min.js"></script>
</html>