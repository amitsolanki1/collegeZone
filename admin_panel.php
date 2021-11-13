<?php
require "admin_top.php";
?>
    <title>Admin page</title>
<style>
    
    /* media query */
/* ########### media query for medium device   */

@media (min-width:601px) and (max-width:1291px){
/* side nav */
    .sidenav-fixed li a{
        font-size:90%;
        width:100%;
    }
}

@media (min-width:601px ) and (max-width:891px){
    .sidenav-fixed li a{
        font-size:60%;
    }
}
    @media (max-width:600px){
   h4{
        display:flex;
        justify-content:center;
        align-items:center;
    }
    .table{
    margin-left:-15%;
    }
    .table th{
        display:none;
    }
     .table,.table tr,.table td{
        display:block;
        width:140%;
    }
    .table tr{
        margin-bottom:15px;
    }
    .table tr td{
        width:200%;
        text-align:right;
        padding-left:100%;
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
    .container .brand-logo{
        margin-top:-5px;
        margin-left:-30%;
    }
    #time{
        margin-top:20px;
        margin-left:-3%;
        font-size:8px;
    }
    #searchbtn{
        margin-right:0px;
        /* width:50px; */
    }
    .content{
        margin-left:0px;
    }
    
    .side{
        height:60vh;
    }
    .sidenav-fixed{
        /* padding:10px; */
        /* height:10vh; */
    }
    .sidenav-fixed li{
        display:flex;
        justify-content:center;
        align-items:center;
    }
    .sidenav-fixed li a{
        width:200px;
        /* color:red; */
    }


}

@media (max-width:520px){
    #export{
        margin-top:10px;
        margin-left:0%;
    }
}
</style>
        <div class="content col l10 m10 s12 ">
            <div class="section">
                <!-- publish notice btn -->
                <button class="btn  blue toggle_btn m3 " id="notice_add" onclick="toggle_form();"> <i
                        class="material-icons left">add_circle</i>Publish notice here</button>
               <!-- export btn -->
               <div class="right">
                    <button id="export" class="btn red hoverable darken-2">Export</button>
                </div>
</div>
            <p class="red lighten-2 white-text center">
                <?php 
                        if(isset($_SESSION['notice_sucess'])){
                        echo $_SESSION['notice_sucess'];
                        }
                         ?>
            </p>
            <form action="admin_panel.php" method="POST" class="form_btn " enctype="multipart/form-data">
                <div class="error bg-danger white-text">
                    <?php  if(isset($_SESSION["notice_publish_error"]))
                    {
                        echo $_SESSION['notice_publish_error'];
                    }
                    if(isset($_SESSION["notice_sucess"]))
                    {
                        echo $_SESSION['notice_sucess'];
                    }
                    ?>
                </div>
                <div class="input-field">
                    <input type="text" id="title" name="title">
                    <label for="title">Title *</label>
                </div>
                <div class="input-field">
                    <textarea id="desc" class="materialize-textarea" name="desc"></textarea>
                    <label for="desc">Description *</label>
                </div>
                <div class="input-field">
                    <input type="file" id="file" name="file[]" multiple />
                    <!-- <label for="file">Upload</label> -->
                </div>
                <input type="submit" name="publish_notice" class="btn blue" id="done_notice"value="Publish notice " />
            </form>
            <!-- view notice -->
            <div class="col l9 m9 s12">
                <h4>View Notice</h4>
                <br>
<!-- #############################################################################  select  -->
                <!-- <div class="select-style input-field">
                    <select name="selectoperation" id="select-style">
                        <option value="" selected disabled>10</option>

                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div> -->

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
                        $total_record=mysqli_num_rows(mysqli_query($con,"select * from notice"));
                        // ceil is used for round of the number in int
                        $pagi=ceil($total_record/$per_page_result);
                        // echo $pagi;
                         $sql="select * from notice ORDER BY time desc limit $start,$per_page_result ";
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
                    echo "<br>Total Notice : $total_record";
                    echo"<br>";
            ?>
        <div id="show_table_id" >
            <table class="table striped bordered highlight" id="table_timetable ">
            <?php
                echo "<tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th style='width:50px;height:40px'>File</th>
                    <th >Time</th>
                    <th style='width:100px;'>Action</th>
                </tr>";
                 $count=0;   
                while($data=mysqli_fetch_assoc($response)){
                //  print_r($data); 
                $count++;
                echo "<tr>
                <td data-label='Id' >$data[id]</td>
                <td data-label='Title' >$data[title]</td>
                <td data-label='Description' >$data[description]</td>
                <td data-label='File' ><img src='media/$data[file]' style='width:20;height:40px ;border-radius:50%'/> </td>
                <td data-label='Time' >$data[time]</td>
                <td data-label='Action' ><a href='edit.php?eid=$data[id]' class='btn btn-floating   blue lighten-1 ' id='loginbtn'><i class='material-icons left black-text'>edit</i></a>
                  <a href='delete_notice.php?did=$data[id]&dfile=$data[file] 'class='btn btn-floating btn-group-lg red'><i class='material-icons left black-text'>delete</i></a></td> ";
                echo"</tr>";
            }
        }
        else{
            if(isset($_GET['start'])){
                $start=$_GET['start'];
                if($start>$pagi){
                    echo "<h5>No Records Fund</h5>";
                 }
                }
                ?>
                <h5>No Records Fund</h5>
            <?php } 
        }
            echo "</table>";
            ?>
                    </div>
            </div>
            <div class="container">
                <div class="col s12 ">
                    <ul class="pagination">
                        <?php
            if($current_page==1){
                echo "<li class='disabled'>";
            }
            ?>
                        <a href="admin_panel.php?start=<?php echo $current_page-1;?>">
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
                        <a href="admin_panel.php?start=<?php echo $current_page+1;?>">
                            <i class="material-icons">chevron_right</i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php unset($_SESSION['notice_publish_error']);
                    unset($_SESSION['notice_sucess']);
                    ?>

</body>
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

    // select option
    document.addEventListener('DOMContentLoaded', function () {
        var elms = document.querySelectorAll('select');
        M.FormSelect.init(elms);
    });
    //###################################################3 jquery end

    function toggle_form() {
        var form_btn = document.querySelector('.form_btn');

        document.getElementById('notice_add').classList.toggle("green");
        form_btn.classList.toggle('active');
    }


    // var submitButton = document.getElementById("done_notice");
    //     var form = document.querySelector(".form_btn");
    //     form.addEventListener("submit", function (e) {
    //         setTimeout(function () {
    //             submitButton.value = "Done!";
    //             submitButton.disabled = false;
    //             form.value="";
    //         }, 2000);
            
    //         submitButton.value = "Wait...";
    //             submitButton.disabled = true;
    //     });


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
</html>