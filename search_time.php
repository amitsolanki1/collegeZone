<?php
require"connection.php";

// ###################################### time table
if(isset($_GET['search_timetable']))
{   
    $search=mysqli_real_escape_string($con,$_GET['search_timetable']);
    $result=mysqli_query($con,"select * from timetable where title  LIKE '%{$search}%' ");
    if($result){
        $count=mysqli_num_rows($result);
        if($count>0){
     
        $html="<table class='table responsive-table striped table_notice highlight' >
            <tr >
                <th >ID</th>
                <th>Title</th>
                <th style='width:80px; text-wrap:wrap'>Description</th>
                <th style='width:100px;'>Time</th>
                <th style='min-width:70px;'>Action</th>
                </tr>";
                $arr=array();
                while($data=mysqli_fetch_assoc($result)){
            $html.="<tr>
                        <td>$data[id]</td>
                        <td>$data[title]</td>
                        <td>$data[description]</td>
                        <td>$data[time]</td>
                        <td><a href='edit.php?eid=$data[id]' class='btn btn-floating  blue lighten-1 ' id='loginbtn'><i class='material-icons left black-text'>edit</i></a>
                        | <a href='delete_notice.php?did=$data[id]&dfile=$data[file] 'class='btn btn-floating btn-group-lg red'><i class='material-icons left black-text'>delete</i></a></td>
                    </tr>";
                // $arr[]=$data;
                }
        $html.="</table>";
        // convert data into json formate 
                // echo json_encode($arr);
        echo json_encode( $html);
    }
    else{
        $html="<h4>No Record Found!</h4>";
        print json_encode($html);     
    }
}
}
else{
header("Location:index.php");
}    
?>
