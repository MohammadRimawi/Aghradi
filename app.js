$(document).ready(function(){
   Statues();
   //$(document).on('mouseover','.Parts',function(){
      $('.Parts').mouseenter(function(){
            $(this).velocity( 
              { 
                  width:'+=110px'
              },{
                  duration: 500,
                  easing: "easeOutSine"
              }) ; 
      }); 


    $('.Parts').mouseleave(function(){
            $(this).velocity( 
            { 
                width:'-=110px'
            },{
                duration: 500,
                easing: "easeOutSine"
            }) ; 
        
    }); 

    


    $('tr').mouseenter(function(){
        console.log("TEST");
        $(this).velocity( 
          { 
            backgroundColor:'#F5f5f5',
        },{
              duration: 200,
              easing: "easeOutSine"
          }) ; 
  }); 


$('tr').mouseleave(function(){
        $(this).velocity( 
        { 
            backgroundColor:'#ffffff',
            
        
        },{
            duration: 200,
            easing: "easeOutSine"
        }) ; 
    
}); 



  
});

function Statues(){

    var Statues=document.getElementsByClassName("Statues");
    
    for(var i=0;i<Statues.length;i++){
        console.log("tt");
        if(Statues[i].innerHTML=="Order was submited")
        Statues[i].style.backgroundColor='rgba(0,255,0,30%)';
        else if(Statues[i].innerHTML=="Waiting to be collected")
        Statues[i].style.backgroundColor='rgba(255,229,124,30%)';
    }
}

function validate(){
    var FirstName =document.getElementById("FirstName").value;
    var LastName =document.getElementById("LastName").value;
    var Email =document.getElementById("Email").value;
    var Username =document.getElementById("Username").value;
    var Password =document.getElementById("Password").value;
    var Phone =document.getElementById("Phone").value;
    var Country =document.getElementById("Country").value;
    var City =document.getElementById("City").value;
    var Street =document.getElementById("Street").value;
    
    var valid=false;
    
    if(((/\w{3,}/).test(FirstName))&& !((/\W/).test(FirstName)))
    if(((/\w{4,}/).test(LastName))&& !((/\W/).test(LastName)))
    if(((/[@]/).test(Email)))
    if( ((/\w{8,}/).test(Username)) && !((/\W/).test(Username)) )
    if( ((/[a-z0-9]{4,}/).test(Password)) && ((/[A-Z]/).test(Password)) && ((/[#@!%]/).test(Password)) && !((/ /).test(PasswordInput.value)) )
    if(((/\[0-9]{10,10}/).test(Phone)))
    if(((/\w{5,}/).test(Country)) && !((/\W/).test(Country)))
    if(((/\w{8,}/).test(FirstName)) && !((/\W/).test(FirstName)))
    valid=true;

    
   // document.getElementsByTagName("form")[0].submit();
if(valid){
return true;
}
else{
return false;
}
    //alert(valid);

}