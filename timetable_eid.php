<?php
session_start();
require "connection.php";
if(!isset($_GET['eid']) || empty($_GET['eid']))
{
    header("Location:timetable_main.php");
}
else{
    $eid=$_GET['eid'];
    // <!-- fetch record form table -->
    $result= mysqli_query($con,"select * from timetable where id='$eid' ") or die(mysqli_error());
    if($result)
    {
        // <!-- fetch single row from table -->
        $data=mysqli_fetch_row($result);
        // echo $data[1];
    }
}

// <!-- when page post method apply -->
if(isset($_POST['update']))
{
    $id=$_POST['id'];
    $course=$_POST['course'];
    $time_from=$_POST['time'];
    $time_to=$_POST['time_to'];
    $day=$_POST['day'];
    $subject=$_POST['subject'];
    $room=$_POST['room'];
    $semester=$_POST['semester'];
    $old_file=$_POST['old_file'];
    if($_FILES['file']['name']==''){
        $file=$old_file;
    }
    else{
        $file=$_FILES['file']['name'];
        $file_temp_store=$_FILES['file']['tmp_name'];
        $_SESSION['notice_sucess']=$file_temp_store;
        $file_destination='media/'.$file;
         move_uploaded_file($file_temp_store,$file_destination);
     }
      $create_time=date('Y-m-d h:i');
    // $insert=mysqli_query($con,"update timetable set title='$title',notice_type='$notice_type',desc='$desc',file='$file' where id='$id' ") or die(mysqli_error());
    $insert=mysqli_query($con,"update timetable set course='$course',time_from='$time_from',time_to='$time_to',day='$day',
    subject='$subject',room='$room',semester='$semester',time='$create_time',file='$file'  WHERE id=$id "); 
    
    if($insert){
        $_SESSION['notice_sucess']="Record Sucessfully Update";
    }
    else{
        $_SESSION['notice_sucess']="some Error Occur!! Retry Again..";
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
    <title>Update Records</title>
</head>
<body>
    <div class="container">
        <h5 class="purple-text center">Update Time Table</h5>
        <div class="container">
            <p class="deep-orange white-text center"><?php if(isset($_SESSION['notice_sucess'])){
                                                            echo $_SESSION['notice_sucess'];
            } ?></p>
        </div>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ; ?>"return false" method="POST" enctype="multipart/form-data">
            <div class="input-field">
                <input type="hidden" value="<?php echo $data[0];?>" name="id" id="id">
            </div>
            <div class="input-field">
                <select name="course" id="title">
                        <option value="<?php echo $data[1];?>"><?php echo $data[1];?></option>
                        <option value="IT">IT</option>
                        <option value="BCA">BCA</option>
                        <option value="MLT">MLT</option>
                        <option value="BVOC">BVOC</option>
                    </select>
                <label for="type">Course</label>
            </div>
            <div class="input-field">
                <input type="time" value="<?php echo $data[2] ;?>" name="time" id="title">
                <label for="title">Time From:</label>
            </div>
            <div class="input-field">
                <input type="time" value="<?php echo $data[3] ;?>" name="time_to" id="desc">
                <label for="desc">Time To:</label>
            </div>
            <div class="input-field">
                <select name="day" id="day">
                    <option value="<?php echo $data[4] ;?>"><?php echo $data[4] ;?></option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thrusday">Thrusday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                </select>
                <label for="day">Day </label>
            </div>
            <div class="input-field">
                <select name="subject" id="subject">
                    <option value="<?php echo $data[5] ;?>" ><?php echo $data[5] ;?></option>
                    <option value="Computer Graphics" >Computer Graphics</option>
                    <option value="Java">Java</option>
                    <option value="Opps">Opps</option>
                    <option value="Engineering Drawing">Engineering Drawing</option>
                    <option value="Applied Math-2">Applied Math-2 </option>
                    <option value="Physics">Physics</option>
                    <option value="Ecom">Ecom</option>
                    <option value="Communication Skill">Communication Skill</option>
                    <option value="Personality Development">Personality Development</option>
                    <option value="TSM">TSM</option>
                    <option value="Cyber Security and Cyber Law">Cyber Security and Cyber Law</option>
                </select>
                <label for="subject">Subject:</label>
            </div>

            <div class="input-field">
                <input type="tel" value="<?php echo $data[6] ;?>" name="room" id="room">
                <label for="room">Room No:</label>
            </div>
            <div class="input-field">
                <select name="semester" id="semester">
                    <option value="<?php echo $data[7] ;?>"><?php echo $data[7] ;?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
                <label for="semester">Semeter:</label>
            </div>
            
            <div class="input-field">
                <input type="hidden" name="old_file" value="<?php echo $data[12];?>">
                <input type="file" name="file" id="file" >
                <a href="<?php echo'media/'.$data[12] ;?> ">File link here</a>   
            <!-- <input type="file"  value="<?php echo $data[12];?>" name="file[]" id="file" multiple> -->
            </div>
            <input type="submit" class="btn" name="update"value="Update" />

        </form>

    </div>

    
</body>
<script src="materialize.min.js"></script>
<script>
     // select option
     document.addEventListener('DOMContentLoaded', function(){
        var elms = document.querySelectorAll('select');
        M.FormSelect.init(elms);
    });
</script>
</html>