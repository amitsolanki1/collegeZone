<script>
    $(document).ready(function () {
        // $('select').formSelect();
        
        // search box
        $("#search").on("keyup", function() {
            // e.preventDefault();
            var search_term = $(this).val();
            concole.log(search_term);
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

    
    // select option
    document.addEventListener('DOMContentLoaded', function () {
        var elms = document.querySelectorAll('select');
        M.FormSelect.init(elms);
    });
    // export btn
    var export_btn=document.getElementById("export");
    export_btn.addEventListener("click", function(){
<?php
   $_SESSION['export']="yes";
    ?>
        setTimeout(function(){
                export_btn.innerHTML = "Export";
                export_btn.disabled = false;
                window.location="export.php";    
            },1000);
            export_btn.innerHTML = "Wait...";
            export_btn.disabled = true;            
    });            
   
    //###################################################3 jquery end
    function toggle_form() {
        var form_btn = document.querySelector('.form_btn');
        document.getElementById('timetable_add').classList.toggle("green");
        form_btn.classList.toggle('active');
        var submitButton = document.getElementById("done_notice");
        var form = document.querySelector(".form_btn");
        document.getElementById('timetable_add').innerHTML = "Back";
        form.addEventListener("submit", function (e) {
            setTimeout(function() {
                submitButton.value = "Publish...";
                    submitButton.disabled = true;
                    form.value="";
                }, 5);
        // });
    }

    // show time
    let time=document.getElementById("time");
    let a=new Date();
    time.innerHTML="Today Date="+a.getDate()+ ":" +a.getMonth()+ ":"+a.getFullYear();
    time.innerHTML+="Today Time="+a.getHours()+ ":" +a.getMinutes()+ ":"+a.getSeconds();
    time.classList.add("small_time");
    time.style.fontSize="16px";
</script>