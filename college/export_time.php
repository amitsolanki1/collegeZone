<?php 
session_start();

require("connection.php");
    

    if(isset($_SESSION['export']))
    {
    $res= mysqli_query($con,"select * from timetable");
    if($res){
        $html="<table>
        <tr><th>Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>File</th>
        <th>Time</th>
        </tr>";
        while($data=mysqli_fetch_assoc($res)){
            $html.="<tr><td>".$data['id']."</td><td>".$data['title']."</td><td>".$data['description']."</td><td>".$data['file']."</td><td>".$data['time']."</td></tr>";
        }
            $html.="</table>";
            header("Content-Type:application/xls");
            header("Content-Disposition:attachment;filename=report.xls");
            echo $html;
        }
        unset($_SESSION['export']);
    }
    else{
        header("Location:timetable_main.php");

    }
    
?>