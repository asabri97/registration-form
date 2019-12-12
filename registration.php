<?php
require_once('config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<div class="contact-form">
    <form method="post" action="registration.php" onsubmit="return submitUserForm();">
    <!--
        Registration form with username and email and google recaptcha with Bootstrap. 
    -->

            <h1>Registration</h1>
            <hr class="mb-3">
            <label for ="username">Username</label>
            <input class="form-control" type="text" id="username" name="username" required>
            <label for="email">Email</label>
            <input class="form-control" type="email" id="email" name="email" required>

            <p>Registration confirmation will be emailed to you</p>
            <div class="text-center"> 
                <div class="g-recaptcha" data-sitekey="6Le15MYUAAAAAFXgm5I5V5SEgoBsqzh6sY1EHnwo" data-callback="verifyCaptcha" 
                style="transform:scale(0.88);-webkit-transform:scale(0.88);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                <div id="g-recaptcha-error"></div>
            </div>
            <hr class="mb-3">
            <input class="btn btn-primary btn-lg btn-block" type="submit" id="register" name="submit"  value="Register">
        
    </form>
</div>

   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!--
Javascript sweet alert send after recaptcha is verified. 
Also checks if username and email are added to the field. 
Data used from process.php that checks for email verification via Kickbox
After the alert, the page is redirected to the welcome page with registered users displayed
-->
<script type="text/javascript">
    $(function(){
        $('#register').click(function(e){
            
           var response = grecaptcha.getResponse();

           if(response.length == 0) {
               document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">Invalid ReCaptcha. Please confirm you are not a robot.</span>';
               return false;
            }
            else {
                var valid = this.form.checkValidity();
           if (valid){

            var username = $('#username').val();
            var email = $('#email').val();

            
               e.preventDefault();
               $.ajax({
                type: 'POST',
                url: 'process.php',
                data: {username: username,email:email},
                success: function(data){
                    Swal.fire({
                        'title': 'Recaptcha Successful',
                        'text': data,
                        'type': 'success'
                        }).then(function(){
                            window.location.href = "index.php";
                        })
                        
                       
                },
                error: function(data){
                    Swal.fire({
                        'title': 'Error',
                        'text': 'Registeration unsuccessful',
                        'type': 'error'
                        })
                }
               });        
           } 
            }
        
           
               
        });
       
    });

</script>
</body>
</html>
