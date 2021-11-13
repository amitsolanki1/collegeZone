<?php
require"connection.php";
if(isset($_GET['search']))
{   
    $search=mysqli_real_escape_string($con,$_GET['search']);
    $result=mysqli_query($con,"select * from notice where title  LIKE '%{$search}%' ") ;
    if($result){
        $count=mysqli_num_rows($result);
        if($count>0){
        $html="<table class='table striped table_notice highlight' >
            <tr >
                <th >ID</th>
                <th>Title</th>
                <th style='width:80px; text-wrap:wrap'>Description</th>
                <th style='width:100px;'>Time</th>
                <th style='min-width:70px;'>Action</th>
                </tr>";
        while($data=mysqli_fetch_assoc($result)){
            $html.="<tr>
                        <td data-label='ID'  >$data[id]</td>
                        <td data-label='Title' >$data[title]</td>
                        <td data-label='Description' >$data[description]</td>
                        <td data-label='Time'  >$data[time]</td>
                        <td data-label='Action' ><a href='edit.php?eid=$data[id]' class='btn btn-floating  blue lighten-1 ' id='loginbtn'><i class='material-icons left black-text'>edit</i></a>
                        | <a href='delete_notice.php?did=$data[id]&dfile=$data[file] 'class='btn btn-floating btn-group-lg red'><i class='material-icons left black-text'>delete</i></a></td>
                    </tr>";
            }
        $html.="</table>";
        // convert data into json formate 
        print json_encode( $html);
     }
    else{
        $html="<h4>No Record Found!</h4>";
        print json_encode($html);     
    }
    }
}
else{
header("Location:admin_panel.php");
}    
