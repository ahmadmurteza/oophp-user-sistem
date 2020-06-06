<?php

include 'assets/php/auth.php';
$auth = new Auth();

$message = '';
if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $auth->test_input($_GET['email']);
    $token = $auth->test_input($_GET['token']);

    $user_auth = $auth->reset_pass_auth($email, $token);
    if ($user_auth != null) {
        if (isset($_POST['reset'])) {
            $newPass = $_POST['pass'];
            $cnewPass = $_POST['cpass'];

            $hashedPassword = password_hash($newPass, PASSWORD_DEFAULT);
            if ($newPass == $cnewPass) {
                $auth->update_pass_auth($email, $hashedPassword);
                $message = 'Reset password berhasil<br/><a href="index.php">Login disini</a>';
            } else {
                $message = 'Password tidak sama!';
            }
        }
    } else {
        header('location: index.php');
        exit();
    }
} else {
    header('location: index.php');
    exit();
}


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
            <!-- reset Form Start -->
            <div class="row justify-content-center wrapper" id="Reset-box">
                <div class="col-lg-10 my-auto">
                    <div class="card-group myShadow">
                        <div class="card justify-content-center rounded-left myColor p-4">
                            <h1 class="text-center text-white font-weight-bold">Reset password anda disini!</h1>
                        </div>
                        <div class="card rounded-right p-4" style="flex-grow:2;">
                            <h1 class="text-center font-weight-bold text-primary">Reset Password</h1>
                            <hr class="my-3">
                            <form action="" method="POST" class="px-3" id="reset-form">
                                <div class="form-group">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong class="text-center"><?= $message ?></strong>
                                </div>
                                <div class="input-group input-group-lg form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0">
                                            <i class="fas fa-key fa-lg"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="pass" class="form-control rounded-0" 
                                    placeholder="Password Baru" required>
                                </div>
                                <div class="input-group input-group-lg form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0">
                                            <i class="fas fa-key fa-lg"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="cpass" class="form-control rounded-0" 
                                    placeholder="Konfirmasi Password Baru" required>
                                </div>
                                    <div class="clearfix"></div>
                                <div class="form-group">
                                    <input type="submit" name="reset" value="Reset Password" class="btn btn-primary btn-lg btn-block
                                    myBtn">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- reset Form End -->
        </div>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    </body>
</html>