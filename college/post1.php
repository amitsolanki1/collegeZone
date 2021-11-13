<?php
    require "connection.php";

    session_start(); 
    if(isset($_POST['post'])){

        $name=$_POST['bookname'];
        $desc= $_POST['desc'];
        $price=$_POST['price'];
        $phone=$_POST['mobile'];
        // $image= $_POST['photo'];
        $location=$_POST['location'];
        if(empty($name) || $price=="" || empty($phone) )
        {
            $_SESSION["login_msg"]="Please enter * Field";
            header("Location:post1.php");
                
            
        }
        else{
            // echo "<pre>";
            // print_r($_FILES);
            // echo "</pre>";
            foreach($_FILES['photo']['name'] as $key=>$val){
            $file=$val;
            echo $file;
            if(!file_exists('media/'.$file))
            {
                $file_temp_store=$_FILES['photo']['tmp_name'][$key];
                $file_destination='media/'.$file;
                move_uploaded_file($file_temp_store,$file_destination);
            }
            else{
                $rand=rand('111111','999999');
                $file=$rand."_".$file;
                $file_temp_store=$_FILES['photo']['tmp_name'][$key];
                $file_destination='media/'.$file;
                move_uploaded_file($file_temp_store,$file_destination);            }
            $create_time=date('Y-m-d h:i:s');
            // $sql = "INSERT INTO books (name, location, price)
            //         VALUES ('$name', '$location', '$price' ) ";
            // if ($con->query($sql) === TRUE) {
            //   echo "New record created successfully";
            // } else {
            //   echo "Error: " . $sql . "<br>" . $con->error;
            // }
            // $con->close();
            $sql="INSERT INTO BOOKS(name,description,price,location,phone,image,time) 
                 VALUES('$name','$desc','$price','$location','$phone','$file','$create_time') ";
            $ans=mysqli_query($con,$sql);
            if($ans){
            echo"sucess";
            }
            else{
                echo "error";
            }
            // insert data into database
            mysqli_query($con,"insert into product values('',$name,$p)");
            header("Location:index.html");
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
    <link rel="stylesheet" href="bootstrap.css">
    <title>post</title>
</head>
<style>
    .container form{
        line-height:.5rem;
    }
    .form-control {
        width: 40%;
        border: 1px solid black;
    }

    .form-control:focus {
        width: 70%;
        border: 2px solid blueviolet;
    }
</style>

<body>

    <div class="container">
        <h3 class="text-primary mt-5 ">Sell Your Book </h3>
        <p id="error" class="center text-danger bg-warning pl-4">
         <?php
         
        if(isset($_SESSION['login_msg'])){
            echo $_SESSION['login_msg'];
        }
       
        ?>
        </p>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ; ?>"return false method="POST" enctype="multipart/form-data" > 
<!-- <form  onsubmit="sell();return false" method="POST"> -->
<p id="error" class="center text-danger bg-warning pl-4"></p>
            <div class="form-group">
                <label>Enter Book Name <span class="text-danger d-lg">*</span></label>
                <input type="text" name="bookname" id="name"class="form-control">
            </div>
            <div class="form-group">
                <label for="">Description </label>
                <br>
                <textarea class="form-control" name="desc" id="desc" cols="20" rows="6"></textarea>
            </div>
            <div class="form-group">
                <label>picture <span class="text-danger d-lg">*</span></label>
                <input type="file" name="photo[]" class="form-control" multiple />
            </div>

            <div class="form-group">
                <label>Set a Price <span class="text-danger d-lg">*</span></label>
                <br>
                <input type="tel" name="price" placeholder="Example Rs. 100">
            </div>

            <div class="form-group">
                <label>Enter Your Location <span class="text-danger d-lg">*</span></label>
                <input type="text" name="location" class="form-control">
            </div>
            
            <div class="form-group">
                <label>Enter Your Phone no. <span class="text-danger d-lg">*</span></label>
                <input type="tel" name="mobile" class="form-control">
            </div>
            <div>
                <input type="submit" name="post" class="btn bt1 btn-secondary" value="Post Now" />
                <!-- <button type="button" onclick="post()" class="btn bt1 btn-secondary">Post Now</button> -->
            </div>
        </form>
    </div>


</body>
<script>
  
// function sell(){
//     var name = document.getElementsByTagName("input").bookname.value;
//     if (name==""){

//     document.getElementById('error').innerHTML="name required";
//     document.getElementsByTagName("input").bookname.focus();
   
//     }
//     else{
//     console.log("end");

//         window.location="post.php";
//     }
// }


//     function check()
//      {
//         // Retrieving the values of form elements 
//         var name = document.getElementsByTagName("input").bookname.value;
//         var price = document.getElementsByTagName("input").price.value;
//         var location = document.getElementsByTagName("input").location.value;
//         var photo =document.getElementsByTagName("input").photo.value;
//         var mobile =document.getElementsByTagName("input").mobile.value;

//         if (name == "") {
//                 document.getElementById("error").innerHTML = " * Please enter a valid name";
//             }

//             else if (photo == "") {
//                 document.getElementById("error").innerHTML = "* Please choose at least one picture";

//             }
//             else if (location == "") {
//                 document.getElementById("error").innerHTML = "* Please enter your location";

//             }

//             else if (mobile == ""){
//                 document.getElementById("error").innerHTML = "* Please enter mobile number";
//             }
//             else if (price == "") {
//                 document.getElementById("error").innerHTML = "* Please enter price of your product";
//                 }

//         else if(mobile !="")
//             {
//                 var regex = /^[0-9]\d{9}$/;
//                 if (regex.test(mobile) == false) {
//                     document.getElementById("error").innerHTML = "* Please enter a valid 10 digit mobile number";
//                 }
//                 else{
//                     alert("done");
//                     post();
                    
//                 }
//             }

//         }


</script>

</html>