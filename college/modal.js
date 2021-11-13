$(document).ready(function () {
    $('#mymodal').hide();


    $('#loginbtn').click(function () {
        $('#mymodal').css("margin-top","80px",1000);
        // $('.navbar').css("backgroundcolor","rgba(0,0,0,.7)");
        // $(".header").css('backgroundColor','rgba(0,0,0,.7)');
        // document.body.style.backgroundColor="rgba(0,0,0,.7)";
        // document.body.style.filter="blur(5px)";
        var blu=document.getElementById('navbar');

        var thm= document.getElementById('theme');
        $('#mymodal').show();

        $('.close').click(function () {
            $('#mymodal').hide();
            // blu.classList.toggle('active');
            // thm.classList.toggle('active');
        });

        $('.btn1').click(function () {
            $('#mymodal').hide();
            // blu.classList.toggle('active');
            // thm.classList.toggle('active');
        });

    });

});
