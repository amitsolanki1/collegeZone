
$(document).ready(function(){
    
     
     $('#loginbtn').click(function(){
     
    //event.preventDefault();
    //   myclick();
    
 function myclick(){
     document.location.href="login.html";
 } 
 });
 // first start this 
 setInterval(()=>{
     console.log("interval");
     $('#loginbtn').css('margin-top','5px');
    $('#loginbtn').css('background-color','black');
    $('#loginbtn').css('padding','5px 5px'); 
    $('#loginbtn').css('border-Radius','10px');
     $('#loginbtn').css('border','1.5px inset red');
     $('#loginbtn').css('color','white');
      $('#loginbtn').show();  
 
 },500); 
 //after first start 
 setInterval(()=>{
     console.log("interval");
    
    $('#loginbtn').css('background-color','red');
    $('#loginbtn').css('padding','5px 5px'); 
    $('#loginbtn').css('border-Radius','10px');
     $('#loginbtn').css('border','1.5px inset black');
     $('#loginbtn').css('color','black');
     $('#loginbtn').css('font-weight','bold');
      $('#loginbtn').show();  
 
 },1000); 
 
// clearInterval(interval);
 
 });