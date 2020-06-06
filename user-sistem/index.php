<?php
session_start();
if (isset($_SESSION['user'])) {
    header('location: home.php');
}

include "assets/php/config.php";
$db = new Database();
$sql = "UPDATE visitors SET hits = hits+1 WHERE id = 1";
$stmt = $db->conn->prepare($sql);
$stmt->execute();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets\css\style.css">

        <title>USIS</title>
    </head>
    <body>
        
        <div class="container">
            <!-- Login Form Start -->
            <div class="row justify-content-center wrapper" id="login-box">
                <div class="col-lg-10 my-auto">
                    <div class="card-group myShadow">
                        <div class="card rounded-left p-4" style="flex-grow:1.4;">
                            <h1 class="text-center font-weight-bold text-primary">Masuk dengan akun</h1>
                            <hr class="my-3">
                            <form action="#" method="POST" class="px-3" id="login-form">
                                <div id="loginAlert"></div>
                                <div class="input-group input-group-lg form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0">
                                            <i class="far fa-envelope fa-lg"></i>
                                        </span>
                                    </div>
                                    <input type="email" name="email" id="email" class="form-control rounded-0" 
                                    placeholder="E-mail" required value="<?php if(isset($_COOKIE['email'])) {
                                        echo $_COOKIE['email']; }?>">
                                </div>
                                <div class="input-group input-group-lg form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0">
                                            <i class="fas fa-key fa-lg"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="password" id="password" class="form-control rounded-0" 
                                    placeholder="Password" required value="<?php if(isset($_COOKIE['password'])) {
                                    echo $_COOKIE['password']; }?>">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox float-left">
                                        <input type="checkbox" name="rem" class="custom-control-input" id="customCheck"
                                        <?php if(isset($_COOKIE['email'])) { ?> checked <?php } ?> >
                                        <label for="customCheck" class="custom-control-label">Ingat saya</label>
                                    </div>
                                    <div class="forgot float-right">
                                        <a href="#" id="forgot-link">Lupa Password?</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="login-btn" value="Sign-in" class="btn btn-primary btn-lg btn-block
                                    myBtn">
                                </div>
                            </form>
                        </div>
                        <div class="card justify-content-center rounded-right myColor p-4">
                            <h1 class="text-center text-white font-weight-bold">Hai Teman!</h1>
                            <hr class="my-3 bg-light myHr">
                            <p class="text-center text-light font-weight-bolder lead">Masukan data pribadi anda untuk
                            memulai perjalanan bersama kami!</p>
                            <button class="btn btn-lg btn-outline-light align-self-center font-weight-bolder
                            mt-4 myLinkBtn" id="register-link">Sign-up</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Login Form End -->

            <!-- Register Form Start -->
            <div class="row justify-content-center wrapper" id="register-box" style="display: none;">
                <div class="col-lg-10 my-auto">
                    <div class="card-group myShadow">
                        <div class="card justify-content-center rounded-right myColor p-4">
                            <h1 class="text-center text-white font-weight-bold">Daftar disini!</h1>
                            <hr class="my-3 bg-light myHr">
                            <p class="text-center text-light font-weight-bolder lead">Untuk selalu terhubung dengan kami
                                silakan masuk dengan info pribadi anda!</p>
                            <button class="btn btn-lg btn-outline-light align-self-center font-weight-bolder
                            mt-4 myLinkBtn" id="login-link">Sign-In</button>
                        </div>
                        <div class="card rounded-left p-4" style="flex-grow:1.4;">
                            <h1 class="text-center font-weight-bold text-primary">Buat Akun</h1>
                            <hr class="my-3">
                            <form action="#" method="POST" class="px-3" id="register-form">
                                <div id="regAlert"></div>
                                <div class="input-group input-group-lg form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0">
                                            <i class="far fa-user fa-lg"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="name" id="name" class="form-control rounded-0" 
                                    placeholder="Nama Lengkap" required>
                                </div>

                                <div class="input-group input-group-lg form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0">
                                            <i class="far fa-envelope fa-lg"></i>
                                        </span>
                                    </div>
                                    <input type="email" name="email" id="remail" class="form-control rounded-0" 
                                    placeholder="E-mail" required>
                                </div>

                                <div class="input-group input-group-lg form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0">
                                            <i class="fas fa-key fa-lg"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="password" id="rpassword" class="form-control rounded-0" 
                                    placeholder="Password" required minlength="5">
                                </div>

                                <div class="input-group input-group-lg form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0">
                                            <i class="fas fa-key fa-lg"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="cpassword" id="crpassword" class="form-control rounded-0" 
                                    placeholder="Konfirmasi Password" required minlength="5">
                                </div>

                                <div class="form-group">
                                    <input type="submit" id="register-btn" value="Sign-up" class="btn btn-primary btn-lg btn-block
                                    myBtn">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Register Form End -->

            <!-- Forgot form start -->
            <div class="row justify-content-center wrapper" id="forgot-box" style="display: none;">
                <div class="col-lg-10 my-auto">
                    <div class="card-group myShadow">
                        <div class="card justify-content-center rounded-right myColor p-4">
                            <h1 class="text-center text-white font-weight-bold">Reset Password!</h1>
                            <hr class="my-3 bg-light myHr">
                            <button class="btn btn-lg btn-outline-light align-self-center font-weight-bolder
                            mt-4 myLinkBtn" id="back-link">Back</button>
                        </div>
                        <div class="card rounded-left p-4" style="flex-grow:1.4;">
                            <h1 class="text-center font-weight-bold text-primary">Lupa Password Anda</h1>
                            <hr class="my-3">
                            <p class="lead text-center text-secondary"> 
                                Untuk mereset password anda, masukan alamat email anda yang terdaftar dan kami akan mengirim intruksi
                                ke email anda!
                            </p>
                            <form action="#" method="POST" class="px-3" id="forgot-form">
                                <div id="forgotAlert"></div>
                                <div class="input-group input-group-lg form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0">
                                            <i class="far fa-envelope fa-lg"></i>
                                        </span>
                                    </div>
                                    <input type="email" name="email" id="femail" class="form-control rounded-0" 
                                    placeholder="E-mail" required>
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="forgot-btn" value="Reset Password" 
                                    class="btn btn-primary btn-lg btn-block myBtn">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Forgot form end -->
        </div>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script type="text/javascript">
            $(document).ready(() => {
                // ajax box
                $('#register-link').click(function () {
                    $('#login-box').hide();
                    $('#register-box').show();
                });
                $('#login-link').click(function () {
                    $('#register-box').hide();
                    $('#login-box').show();
                });
                $('#forgot-link').click(function () {
                    $('#login-box').hide();
                    $('#forgot-box').show();
                });
                $('#back-link').click(function () {
                    $('#forgot-box').hide();
                    $('#login-box').show();
                });

                // form register
                $('#register-btn').click(function (e) {
                    if ($('#register-form')[0].checkValidity()) {
                        e.preventDefault();
                        $('#register-btn').val('Tunggu sebentar ..');
                        if ($('#rpassword').val() != $('#crpassword').val()) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Konfirmasi password tidak sama!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#register-btn').val('Sign Up');
                        } else {
                            $.ajax({
                                url: 'assets/php/action.php',
                                method: 'POST',
                                data: $('#register-form').serialize()+'&action=register',
                                success: function(response) {
                                    $('#register-btn').val('Sign Up');
                                    // console.log(response);
                                    if (response == 'register') {
                                        window.location.href = 'home.php';
                                    }
                                    else {
                                        $('#regAlert').html(response);
                                    }
                                    
                                }
                            });
                        }
                    }
                });

                // form login
                $('#login-btn').click(function (e) {
                    if ($('#login-form')[0].checkValidity()) {
                        e.preventDefault();

                        $('#login-btn').val('Tunggu sebentar ..');
                        $.ajax({
                            url: 'assets/php/action.php',
                            method: 'POST',
                            data: $('#login-form').serialize()+'&action=login',
                            success: function (response) {
                                // console.log(response);
                                $('#login-btn').val('Sign In');
                                if (response = true) {
                                    window.location.href = 'home.php';
                                }
                                else {
                                    $('#loginAlert').html(response);
                                }
                            }
                        });
                    }
                });

                // ajax forgot password
                $('#forgot-btn').click(function (e) {
                    if ($('#forgot-form')[0].checkValidity()) {
                        e.preventDefault();
                        $('#forgot-btn').val('Tunggu sebentar ..');
                        $.ajax({
                            url: 'assets/php/action.php',
                            method: 'POST',
                            data: $('#forgot-form').serialize()+'&action=forgot',
                            success: function (response) {
                                $('#forgot-btn').val('Reset Password');
                                $('#forgot-form')[0].reset();
                                $('#forgotAlert').html(response);
                            }
                        });
                    }
                })
            });
        </script>
    </body>
</html>