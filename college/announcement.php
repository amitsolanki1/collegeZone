<?php 
require "admin_top.php";

if(isset($_GET['did']))
{
    $did=$_GET['did'];
    // <!--delete record form table -->
    $res= mysqli_query($con,"delete from announcement where id='$did' ") ;
    if($res)
    {   
        echo "";
    }
    else{
        echo"<script>alert('some error occur!');</script>";
    }
}
?>
    <title>Admin/Announcemnet</title>
<style>

@media (max-width:600px){
    
    .table{
        margin-left:-20%;
    }.table th{
    
        display:none;
    }
     .table,.table tr,.table td{
        display:block;
        width:110%;
    }
    .table tr{
        margin-bottom:20px;
    }
    .table tr td{
        text-align:right;
        text-wrap:wrap;
        width:130%;
        padding-left:50%;
        position: relative;
    }
    .table td:before{
        content:attr(data-label);
        position: absolute;
        left:0;
        width:50%;
        padding-left:15px;
        font-weight:600;
        font-size:15px;
        text-align:left;
        background: red;
    }
}

@media (max-width:520px){
    #export{
        margin-top:10px;
        margin-left:0%;
    }
    h4{
        font-size:180%;
    }
}

</style>

        <!-- /* ######################################################################################  content  */ -->
        <div class="content col l10 m10 s12 ">
            <div class="section">
                <!-- publish notice btn -->
                <button class="btn  blue toggle_btn m3 " id="notice_add" onclick="toggle_form();"> <i
                        class="material-icons left">add_circle</i>Add your announcement</button>
               <!-- export btn -->
               <div class="right">
                    <button id="export" class="btn red hoverable darken-2">Export</button>
                </div>
</div>
           
                    <?php 
                        if(isset($_SESSION['announcement_sucess'])){
               ?>
            <h6 class="red darken-2 white-text center">
                 <?php       echo $_SESSION['announcement_sucess'];
                      }?>
            </h6>
           
                    <form action="announcement.php" method="POST" class="form_btn">
                <div class="input-field">
                    <input type="text" id="announcement"  name="announcement" >
                    <label for="announcement">Announcement *</label>
                </div>
                <input type="submit" name="publish_announcement" class="btn blue" id="done_notice"value="Publish Announcement " />

            </form>

     
            <!-- view announcement -->
            <div class="col l9 m9 s12">
                <h4>View Announcements</h4>
                <br>

                <div class="container-fluid">
        <!-- pagination code  -->
                <?php
                        $per_page_result=5;
                        $start=0;
                        $current_page=1;
                        if(isset($_GET['start'])){
                            $start=$_GET['start'];
                            if($start<=0){
                                $start=0;
                                $current_page=1;
                            }
                            else{
                                $current_page=$start;
                                $start=$start-1;
                                // echo $start;
                                // $start=$start*5;
                                $start=$start*$per_page_result;
                            }
                        }
                        $total_record=mysqli_num_rows(mysqli_query($con,"select * from announcement"));
                        // ceil is used for round of the number in int
                        $pagi=ceil($total_record/$per_page_result);
                        // echo $pagi;
                         $sql="select * from announcement ORDER BY time desc limit $start,$per_page_result ";
                        $response=mysqli_query($con,$sql) or die(mysqli_error($con));
                    ?>
        <!-- display search notice result -->
                    <div id="show_table_notice">
                    </div>
        <!-- display all notice -->
          <?php 
                if($response){
                    // while($data=mysqli_fetech_assoc($response)){
                if($records=mysqli_num_rows($response)>0){
                    echo "<br>Total Announcement : $total_record";
                    echo"<br>";
            ?>
        <div id="show_table_id">
            <table class="table striped bordered highlight" id="table_notice ">
            <?php
                echo "
                <tr >
                    <th >ID</th>
                    <th style='text-wrap:wrap;' >Announcement</th>
                    <th style='width:40px;text-wrap:wrap;'>Time</th>
                    <th>Action</th>
                </tr>";
                while($data=mysqli_fetch_assoc($response)){
                echo "<tr>";
                echo"
                <td data-label='Id' >$data[id]</td>
                <td data-label='Announcement' style='text-wrap:wrap;'>$data[announcement]</td>
                <td data-label='Time' style='text-wrap:wrap;'>$data[time]</td>
                <td data-label='Action'><a href='edit.php?eid=$data[id]' class='btn btn-floating  blue lighten-1 ' id='loginbtn'><i class='material-icons left black-text'>edit</i></a>
                    <button type='submit' onclick='done($data[id])'; class='btn btn-floating btn-group-lg red'><i class='material-icons left black-text'>delete</i>dlt</button>";
                    echo"</tr>";
                // | <a href='delete_announcement.php?did=$data[id] 'class='btn btn-floating btn-group-lg red'><i class='material-icons left black-text'>delete</i></a></td> ";
                // echo"</tr>";
            }
        }
        else{
            if(isset($_GET['start'])){
                $start=$_GET['start'];
                if($start>$pagi){
                    echo "<h5>No Records Fund</h5>";
                 }
                }
                   }   }
            echo "</table>";
            ?>
                    </div>
            </div>
            <div class="container">
                <!-- <h2>pagination</h2> -->
                <div class="col s12 ">
                    <ul class="pagination">
                        <?php
            if($current_page==1){
                echo "<li class='disabled'>";
            }
            ?>
                        <a href="announcement.php?start=<?php echo $current_page-1;?>">
                            <i class="material-icons">chevron_left</i></a>
                        </li>
                        <?php
                    for($i=1;$i<=$pagi;$i++){
                        $class='';
                        // <!-- check click btn is equal to $i -->
                        if($current_page==$i){
                            $class='active';
                        }
                    ?>
                        <li class="waves-effect <?php echo $class; ?>"><a href="?start=<?php echo $i;?>">
                                <?php echo $i;?>
                            </a></li>
                        <?php
            }
            if($current_page==$pagi){
                echo "<li class='disabled'>";
            }
                ?>
                        <a href="announcement.php?start=<?php echo $current_page+1;?>">
                            <i class="material-icons">chevron_right</i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</body>
<!-- ionicons -->
<script src="materialize.min.js"></script>
<script src="jquery.js"></script>
<script>
    $(document).ready(function() {
        // search box   
        $("#search").on("keyup", function() {
            // e.preventDefault();
            var search_term = $(this).val();
             if(search_term!="") {
                $('#show_table_notice').show();//search
                $('#show_table_id').hide();
            }
            else{
                $("#show_table_notice").hide();
                $('#show_table_id').show();
            }
            $.ajax({
                url: "search.php",
                method: "GET",
                dataType: "json",
                data: { search: search_term },
                success: function(data) {
                    // console.log("success");
                    console.log(data);
                    $('#show_table_notice').html(data);
                },
                error: function (data) {
                    console.log("error");
                }
            });
        });
        // end of search box

    });

    //###################################################3 jquery end

    function done(id){
    var response=confirm('Do you really want to delete this post?');
    console.log(response);
    console.log(id);
    if(response){
        window.location="announcement.php?did="+id;
    }
    }
    function toggle_form() {
        var form_btn = document.querySelector('.form_btn');

        document.getElementById('notice_add').classList.toggle("green");
        form_btn.classList.toggle('active');
    }

     // export notice databtn
     var export_btn=document.getElementById("export");
    export_btn.addEventListener("click", function(){
        console.log("");
<?php
   $_SESSION['export_notice']="yes";
    ?>
        setTimeout(function(){
                export_btn.innerHTML = "Export";
                export_btn.disabled = false;
                window.location="export_notice.php";    
            },1000);
            export_btn.innerHTML = "Wait...";
            export_btn.disabled = true;            
    });            
</script>