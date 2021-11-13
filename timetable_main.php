<?php
require "admin_top.php";
if(isset($_GET['did']))
{
    $did=$_GET['did'];
    // <!--delete record form table -->
    $res= mysqli_query($con,"delete from timetable where id='$did' ") ;
    if($res)
    {   
        echo "";
    }
    else{
        echo"<script>alert('some error occur!');</script>";
    }
}
?>
<title>Admin/TimeTable</title>
<style>
    
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
        <div class=" content col l10 m10 s12 " style="height: 100vh;">
            <div class="section">
<!-- publish timetable btn -->
                <button class="btn  blue toggle_btn m3 " id="timetable_add" onclick="toggle_form();"> <i
                        class="material-icons left">add_circle</i>Publish timetable here</button>
<!-- export btn -->
                <div class="right">
                    <button id="export" class="btn red hoverable darken-2">Export</button>
                </div>
            </div>
            <p class="red lighten-1 white-text center">
                <?php 
                        if(isset($_SESSION['timetable_sucess'])){
                        echo $_SESSION['timetable_sucess'];
                        }
                         ?>
            </p>
            <form action="timetable_main.php" method="POST" class="form_btn " enctype="multipart/form-data">
                <div class="error bg-danger white-text">
                    <?php  if(isset($_SESSION["timetable_publish_error"]))
                    {
                        echo $_SESSION['timetable_publish_error'];
                    }
                    if(isset($_SESSION["timetable_sucess"]))
                    {
                        echo $_SESSION['timetable_sucess'];
                    }
                    ?>
                </div>
                <div class="input-field">
                    <select name="title" id="title">
                        <option value="IT">IT</option>
                        <option value="BCA">BCA</option>
                        <option value="MLT">MLT</option>
                        <option value="BVOC">BVOC</option>
                    </select>
                    <label for="title">Course *</label>
                </div>
                <div class="input-field">
                    <input type="time" id="time"  name="time">
                    <label for="time">Timing From: *</label>
                </div>
                <div class="input-field">
                <select name="day" id="day">
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thrusday">Thrusday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                </select>
                    <label for="day">Lecture Day: *</label>
                </div>
                <div class="input-field">
                    <input type="tel" id="room"  name="room">
                    <label for="room">Room No: </label>
                </div>
                <div class="input-field">
                <select name="semester" id="semester">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
                    <label for="semester">Select Semester: *</label>
                </div>
                <div class="input-field">
                    <input type="time" id="time_to"  name="time_to">
                    <label for="time_to">Timing To: *</label>
                </div>
                <div class="input-field">
                <select name="subject" id="subject">
                    <option value="Computer Graphics">Computer Graphics</option>
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
                    <label for="subject">Select Subject: *</label>
                </div>
                
                <div class="input-field">
                    <input type="file" id="file" name="file[]" multiple />
                    <!-- <label for="file">Upload</label> -->
                </div>
                <input type="submit" name="publish_timetable" class="btn blue" id="done_notice" value="Publish timetable " />
            </form>
            <!-- view timetable -->
            <div class="col l9 m9 s12">
                <h4>View timetable</h4>
                <br>
            </div>
            <!-- display all timetable -->
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
                        $total_record=mysqli_num_rows(mysqli_query($con,"select * from timetable"));
                        // ceil is used for round of the number in int
                        $pagi=ceil($total_record/$per_page_result);
                        // echo $pagi;
                         $sql="select * from timetable ORDER BY time desc limit $start,$per_page_result ";
                        $response=mysqli_query($con,$sql) or die(mysqli_error($con));
                    ?>
        <!-- display search timetable result -->
                    <div id="show_table_timetable">
                    </div>
        <!-- display all timetable -->
          <?php 
                if($response){
                    // while($data=mysqli_fetech_assoc($response)){
                if($records=mysqli_num_rows($response)>0){
                    echo "<br>Total timetable : $total_record";
                    echo"<br>";
            ?>
        <div id="show_table_id">
            <table class="table striped highlight bordered" id="table_timetable ">
            <?php
                echo "
                <tr >
                    <th >ID</th>
                    <th style='width:80px; text-wrap:wrap'>Course</th>
                    <th >Time From</th>
                    <th >Time To</th>
                    <th >Day</th>
                    <th >Subject</th>
                    <th >Room No</th>
                    <th >Semester</th>
                    <th style='width:40px;'>File</th>
                    <th style='width:100px;'>Time</th>
                    <th style='min-width:70px;'>Action</th>
                </tr>";
                 $count=0;   
                while($data=mysqli_fetch_assoc($response)){
                //  echo"<pre>"; 
                //  print_r($data); 
                $count++;
                echo "<tr>";
                // echo "<td>$count</td>";
                echo" 
                <td data-label='Id'>$data[id]</td>
                <td data-label='Course'>$data[course]</td>
                <td data-label='Time From'>$data[time_from]</td>
                <td data-label='Time TO' >$data[time_to]</td>
                <td data-label='Day'>$data[day]</td>
                <td data-label='Subject'>$data[subject]</td>
                <td data-label='Room No.'>$data[room]</td>
                <td data-label='Semester'>$data[semester]</td>
                <td data-label='File'><img src='media/$data[file]' style='width:50;height:50px ;border-radius:50%'/> </td>
                <td data-label='Time'>$data[time]</td>
                <td data-label='Action'><a href='timetable_eid.php?eid=$data[id]'  class='btn btn-floating  blue lighten-1 ' id='loginbtn'><i class='material-icons left black-text'>edit</i></a>
                <button type='submit' onclick='done($data[id])'; class='btn btn-floating btn-group-lg red'><i class='material-icons left black-text'>delete</i>dlt</button>";
                echo"</tr>";
                //   <a href='delete_timetable.php?did=$data[id]&dfile=$data[file] 'class='btn btn-floating btn-group-lg red'><i class='material-icons left black-text'>delete</i></a></td> ";
            }
        }
        else{
            if(isset($_GET['start'])){
                $start=$_GET['start'];
                if($start>$pagi){
                    echo "<h5>No Records Fund</h5>";
                 }
              }
          } 
      }
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

</body>
<!-- ionicons -->
<script src="materialize.min.js"></script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="jquery.js"></script>
<script src="modal.js"></script>
<script>
    $(document).ready(function () {
        // $('select').formSelect();

        // search box
        $("#search").on("keyup", function() {
            // e.preventDefault();
            var search_term = $(this).val();
            if (search_term !=""){
                $('#show_table_timetable').show();//search
                $('#show_table_id').hide();
            }
            else{
                $("#show_table_timetable").hide();
                $('#show_table_id').show();
            }
            $.ajax({
                url: "search_time.php",
                method: "GET",
                dataType: "JSON",
                data: {search_timetable: search_term },
                success: function (data) {
                    $('#show_table_timetable').html(data);
                },
                error: function (data) {
                    console.log("error");
                }
            });
        });


    });
    //###################################################3 jquery end

    // select option
    document.addEventListener('DOMContentLoaded', function(){
        var elms = document.querySelectorAll('select');
        M.FormSelect.init(elms);
    });

// timetable publish btn
    function toggle_form() {
        var form_btn = document.querySelector('.form_btn');
        document.getElementById('timetable_add').classList.toggle("green");
        form_btn.classList.toggle('active');
    var submitButton = document.getElementById("done_notice");
    var form = document.querySelector(".form_btn");
    document.getElementById('timetable_add').innerHTML = "Back";
    form.addEventListener("submit", function(e) {
        setTimeout(function () {
                submitButton.value = "Publish...";
                submitButton.disabled = true;
                form.value="";
            }, 1000);
    });
    }

// delete timetable 
function done(id){
    var response=confirm('Do you really want to delete this row?');
    if(response){
        window.location="timetable_main.php?did="+id;
    }
   }
    
     // export btn
     var export_btn=document.getElementById("export");
    export_btn.addEventListener("click", function(){
        console.log("");
<?php
   $_SESSION['export']="yes";
    ?>
        setTimeout(function(){
                export_btn.innerHTML = "Export";
                export_btn.disabled = false;
                window.location="export_time.php";    
            },1000);
            export_btn.innerHTML = "Wait...";
            export_btn.disabled = true;            
    });            


   
</script>

</html>