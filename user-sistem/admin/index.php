<?php

    session_start();
    if(isset($_SESSION['username'])) {
        header('location: admin-dashboard.php');
    }

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets\css\style.css">
        
        <title>USIS | Log-in Admin Panel</title>
    </head>
    <body>
        
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <!-- Tabs Titles -->

                <!-- Icon -->
                <div class="fadeIn first" style="margin-top: 15px; margin-bottom: 15px;">
                    <i class="fas fa-code fa-lg"></i>&nbsp;&nbsp;Login sebagai admin
                </div>

                <!-- Login Form -->
                <form method="POST" action="" id="logInForm">
                    <input type="text" id="username" class="fadeIn second" name="username" placeholder="login">
                    <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
                    <input type="submit" name="logInBtn" id="logInBtn" class="fadeIn fourth" value="Log In">
                </form>

                <!-- Alert -->
                <div id="formFooter"></div>
            </div>
        </div>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script type="text/javascript">
            $(document).ready(function(){

                $('#logInBtn').click(function(e) {
                    if ($('#logInForm')[0].checkValidity()) {
                        e.preventDefault();

                        $('#logInBtn').val('Tunggu sebentar...');
                        $.ajax({
                            url: 'assets/php/admin-action.php',
                            method: 'POST',
                            data: $('#logInForm').serialize()+'&action=logIn',
                            success: function(response) {
                                console.log(response);
                                $('#logInBtn').val('Log In');
                                if (response = 'adminLogIn') {
                                    window.location = 'admin-dashboard.php';
                                } 
                                else {
                                    $('#formFooter').html(response);
                                }
                            }
                        });
                    }
                });


            });
        </script>
    </body>
</html>