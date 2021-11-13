<?php
session_start();
require "connection.php";
if(!isset($_GET['did']) || empty($_GET['did']))
{
    header("Location:admin_panel.html");
}
else{
    $eid=$_GET['did'];
    <!--delete record form table -->
    $result= mysqli_query($con,"delete from notice where id='$did' ") or die(mysqli_error());
    if($result)
    {
        $_SESSION['notice_sucess']="Record Sucessfully Delete";
        header("Location:admin_panel.php");
    }
}

<!-- when page post method apply -->
if(isset($_POST['update'])
{
    $id=$_POST['id']
    $title=$_POST['title'];
    $notice_type=$_POST['notice_type'];
    $desc=$_POST['desc']

    foreach($_FILES['photo']['name'] as $key=>$val){
        $file=$val;
        // echo $file;
        if(!file_exists('media/'.$file))
        {
        move_uploaded_file($_FILES['photo']['tmp_name'][$key],'media/'.$file);
        // echo $_FILES['photo']['tmp_name'][$key];
        }
        else{
            $rand=rand('111111','999999');
            $file=$rand."_".$file;
            move_uploaded_file($_FILES['photo']['tmp_name'][$key],'media/'.$file);
        }
        $create_time=date('Y-m-d h:i:s');
    $insert=mysqli_query($con,"update notice set title='$title',notice_type='$notice_type',desc='$desc',file='$file' where id='$id' ") die(mysqli_error());
    if($insert){
        $_SESSION['notice_sucess']="Sucessfully Update";
    }
    else{
        $_SESSION['notice_sucess']="some Error Occur Check your internt connect";
    }
}


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
            <p class="deep-orange white-text center"><?php if(isset($_SESSION['notice_sucess']){
                                                            echo $_SESSION['notice_sucess'];
            } ?></p>
        </div>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ; ?>"return false" method="POST" enctype="multipart/form-data">
            <div class="input-field">
                <input type="hidden" value="<?php echo '$data[0] ';?>" name="id" id="id">
            </div>
            <div class="input-field">
                <input type="text" value="<?php echo '$data[2] ';?>" name="notice_type" id="type">
                <label for="type">Notice Type</label>
            </div>
            <div class="input-field">
                <input type="text" value="<?php echo '$data[1] ';?>" name="title" id="title">
                <label for="title">Title</label>
            </div>
            <div class="input-field">
                <input type="text" value="<?php echo '$data[3] ';?>" name="desc" id="desc">
                <label for="desc">Description</label>
            </div>
            <div class="input-field">
                <input type="file"  value="<?php echo '$data[4] ';?>" name="photo[]" id="file" multiple>
            </div>
            <input type="submit" class="btn"value="Update" />

        </form>

    </div>

    
</body>
<script src="materialize.min.js"></script>
</html>