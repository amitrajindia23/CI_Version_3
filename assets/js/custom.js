////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// SIGNUP FORM VALIDATION //////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////

function signupFromValidation(){
    var emailRegx =  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var name = $('#name').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var repassword = $('#repassword').val();
    var dob = $('#dob').val();
   
    //alert(signupDob);
    var validation=1; 

    if (name == null || name == "") {                 
       //$("#name-error").html('Please enter name.');       
       $('#name').css( "border", "1px solid red" );
       var validation=0;
    }else{
        //$("#name-error").html('');
        $('#name').css( "border", "1px solid green" );
    }

    if (email == null || email == "" || !email.match(emailRegx)) {                 
       //$("#email-error").html('Please enter valid username (email).');
       $('#email').css( "border", "1px solid red" );
       var validation = 0;
    }else{
        //$("#email-error").html('');
        $('#email').css( "border", "1px solid green" );
    }

    if (password == null || password == "") {                 
       //$("#password-error").html('Please enter password.');
       $('#password').css( "border", "1px solid red" );
       var validation = 0;
    }else{
       // $("#password-error").html('');
        $('#password').css( "border", "1px solid green" );
    }

    if (repassword == null || repassword == "") {
       //$("#repassword-error").html('Please re-enter password.');
       $('#repassword').css( "border", "1px solid red" );
       var validation = 0;
    }else{
       //$("#repassword-error").html('');
       $('#repassword').css( "border", "1px solid green" );
    }

    if(password.length > 0){
        if(password != repassword){
          //$("#password-notmatched-error").html('Password not matched.');
          $('#password,#repassword').css( "border", "1px solid red" );
          var validation = 0;
        }
        else{
          //$("#password-notmatched-error").html('');
          $('#password,#repassword').css( "border", "1px solid green" );
        }
    }

    if (dob == null || dob == "" || dob.length < 8) {                 
       //$("#dob-error").html('Please select dob.');
         $('#dob').css( "border", "1px solid red" );
       var validation = 0;
    }else{
        //$("#dob-error").html('');
        $('#dob').css( "border", "1px solid green" );
    }

    if(validation == 1){
      return true;
    }
    else{
      return false;
    }

}

////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// SIGNIN FORM VALIDATION //////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////

function signinFromValidation(){
    var emailRegx =  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var email = $('#email').val();
    var password = $('#password').val();
   
    //alert(signupDob);
    var validation=1; 

    if (email == null || email == "" || !email.match(emailRegx)) {                 
       //$("#email-error").html('Please enter valid username (email).');
       $('#email').css( "border", "1px solid red" );
       var validation = 0;
    }else{
        //$("#email-error").html('');
        $('#email').css( "border", "1px solid green" );
    }

    if (password == null || password == "") {                 
       //$("#password-error").html('Please enter password.');
       $('#password').css( "border", "1px solid red" );
       var validation = 0;
    }else{
       // $("#password-error").html('');
        $('#password').css( "border", "1px solid green" );
    }

    if(validation == 1){
      return true;
    }
    else{
      return false;
    }

}

////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////// CHANGE PASSWORD FORM VALIDATION ////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////

function changePasswordFromValidation(){
   
    var oldPassword = $('#oldPassword').val();
    var newPassword = $('#newPassword').val();
    var renewPassword = $('#renewPassword').val();
   
    //alert(signupDob);
    var validation=1; 


    if (oldPassword == null || oldPassword == "") {                 
       $('#oldPassword').css( "border", "1px solid red" );
       var validation = 0;
    }else{
        $('#oldPassword').css( "border", "1px solid green" );
    }

    if (newPassword == null || newPassword == "") {
       $('#newPassword').css( "border", "1px solid red" );
       var validation = 0;
    }else{
       $('#newPassword').css( "border", "1px solid green" );
    }

    if (renewPassword == null || renewPassword == "") {
       $('#renewPassword').css( "border", "1px solid red" );
       var validation = 0;
    }else{
       $('#renewPassword').css( "border", "1px solid green" );
    }

    if(newPassword.length > 0){
        if(newPassword != renewPassword){
          $('#newPassword,#renewPassword').css( "border", "1px solid red" );
          var validation = 0;
        }
        else{
          $('#newPassword,#renewPassword').css( "border", "1px solid green" );
        }
    }

    if(validation == 1){
      return true;
    }
    else{
      return false;
    }

}

///////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////// Ready Function /////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function(){
    $("#dob").datepicker();
    $("#dob").datepicker( "option", "dateFormat", 'yy-mm-dd' );

    //Check availablity
    $('#signup-form #email').change(function(){
        var url = $('#siteUrl').val()+'/account/userCheck';
        var data = "userEmail="+$('#email').val();
        
        $.ajax({
            type:'POST',
            url: url,
            data: data,
            async: false,
            success: function(result){
                data = $.parseJSON(result);
                if(data != null){
                    $('#user-exist-error').fadeIn();
                } 
                else{
                    $('#user-exist-error').fadeOut();
                }              
            }
        });
        return false;
    });
});
