<?php 
session_start();

require("connection.php");
    // notice 
    if(isset($_SESSION['export_notice']))
    {   
        $html="";
        $res= mysqli_query($con,"select * from notice");
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
                header("Content-Disposition:attachment;filename=report_notice.xls");
                echo $html;
            }
            unset($_SESSION['export_notice']);
        }
        else{
            header("Location:admin_panel.php");
    
        }
            
?>