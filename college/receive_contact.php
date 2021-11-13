<?php
if(isset($_POST['contact_send']))
{
    $name=$_POST['name'];
    $subject=$_POST['subject'];
    $msg=$_POST['msg'];
    $email=$_POST['email'];

    $email_from="website@gmail.com";
    $email_subject= "New Form Submission";
    $email_body= "user name: $name. \n".
                    "user email: $email.\n".
                    "subject: $subject. \n".
                    "user message: $msg . \n";
    $to = "jaibholeki701@gmail.com";
    $headers ="From: $email_from \r\n";
    $headers .="Reply-To:$email \r\n";
    mail($to,$email_subject,$email_body,$headers);
    header("location:index.html");
}
?>