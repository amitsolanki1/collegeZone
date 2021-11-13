<?php
require "admin_top.php";
?>
<title>Admin/Notes</title>
        <div class="content col l10 m10 s12 " style="height: 100vh;">
            <div class="section">
<!-- Add notes btn -->
                <button class="btn  blue toggle_btn m3 " id="timetable_add" onclick="toggle_form();"> <i
                        class="material-icons left">add_circle</i>Add Notes</button>
<!-- export btn -->
                <div class="right">
                    <button id="export" class="btn red hoverable darken-2">Export</button>
                </div>
            </div>

            <p class="red lighten-1 white-text center">
                <?php 
                        if(isset($_SESSION['timetable_sucess'])){
                        echo $_SESSION['timetable_sucess'];

                            usleep(1000);
                            unset($_SESSION['timetable_sucess']);
                    }
                         ?>
            </p>
            <form action="admin_top.php" method="POST" class="form_btn " enctype="multipart/form-data">
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
                <select name="subject" id="subject">
                    <option value="Computer Graphics">Computer Graphics</option>
                    <option value="Java">Java</option>
                    <option value="AI">AI</option>
                    <option value="DBMS">DBMS</option>
                    <option value="COMPUTER BASIC">COMPUTER BASIC</option>
                    <option value="DATA STRUCTURE">DATA STRUCTURE</option>
                    <option value="ML">ML</option>
                    <option value="PYTHON">PYTHON</option>
                    <option value="NETWORKING">NETWORKING</option>
                    <option value="c">c</option>
                    <option value="c++">c++</option>
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
                    <input type="text" name="topic" id="topic" />
                    <label for="topic">Topic*</label>
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
                    <input type="file" id="file" name="file[]" multiple />
                    <!-- <label for="file">Upload</label> -->
                </div>
                <input type="submit" name="notes" class="btn blue" id="done_notice" value="Add Notes" />
            </form>
            <!-- view notes-->
            <div class=" col l9 m9 s12">
                <h4>View Notes</h4>
                <br>
            </div>
            <!-- display all notes -->
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
                        $total_record=mysqli_num_rows(mysqli_query($con,"select * from notes"));
                        // ceil is used for round of the number in int
                        $pagi=ceil($total_record/$per_page_result);
                        // echo $pagi;
                         $sql="select * from notes ORDER BY time desc limit  $start,$per_page_result ";
                        $response=mysqli_query($con,$sql) or die(mysqli_error($con));
                    ?>
        <!-- display search notes result -->
                    <div id="show_table_timetable">
                    </div>
        <!-- display all notes -->
          <?php 
                if($response){
                    // while($data=mysqli_fetech_assoc($response)){
                if($records=mysqli_num_rows($response)>0){
                    echo "<br>Total notes: $total_record";
                    echo"<br>";
            ?>
        <div id="show_table_id" >
            <table class="table striped bordered highlight" id="table_timetable ">
            <?php
                echo "
                <tr >
                    <th >ID</th>
                    <th >Subject</th>
                    <th >Topic</th>
                    <th >Semester</th>
                    <th style='width:100px;'>Time</th>
                    <th style='width:10px;'>File</th>
                    <th style='min-width:70px;'>Action</th>
                </tr>";
                while($data=mysqli_fetch_assoc($response)){
                echo "<tr>";
                echo" 
                <td data-label='Id'>$data[id]</td>
                <td data-label='Subject'>$data[subject]</td>
                <td data-label='Topic'>$data[topic]</td>
                <td data-label='Semester'>$data[semester]</td>
                <td data-label='Time'>$data[time]</td>
                <td data-label='File'><a href='media/$data[file]' >file link here</a> </td>
                <td data-label='Action'><a href='timetable_eid.php?eid=$data[id]'  class='btn btn-floating  blue lighten-1 ' id='loginbtn'><i class='material-icons left black-text'>edit</i></a>
                 | <a href='delete_timetable.php?did=$data[id]&dfile=$data[file] 'class='btn btn-floating btn-group-lg red'><i class='material-icons left black-text'>delete</i></a></td> ";
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
          } 
      }
            echo "</table>";
            ?>
                    </div>
            </div>
<!-- pagination -->
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

</body>

<script src="materialize.min.js"></script>
<!-- ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="jquery.js"></script>
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
                submitButton.value = "uploading...";
                submitButton.disabled = true;
                form.value="";
            }, 1000);
    });
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