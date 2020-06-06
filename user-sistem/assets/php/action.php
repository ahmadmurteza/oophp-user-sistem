<?php

session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
include 'auth.php';
$auth = new Auth();

// menghandle register
if (isset($_POST['action']) && $_POST['action'] == 'register') {
    $name = $auth->test_input($_POST['name']);
    $email = $auth->test_input($_POST['email']);
    $password = $auth->test_input($_POST['password']);

    $hpassword = password_hash($password, PASSWORD_DEFAULT);

    if($auth->user_exist($email)) {
        echo $auth->showMessage('warning', 'Data user sudah terdaftar, gunakan email yang lain!');
    } else {
        if ($auth->register($name, $email, $hpassword)) {
            $register = 'register';
            echo $register;
            $_SESSION['user'] = $email;
        } else {
            echo $auth->showMessage('Danger', 'Ada yang salah di program register, tolong infokan kepada kami!');
        }
    }
}

// menghandle login
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $email = $auth->test_input($_POST['email']);
    $password = $auth->test_input($_POST['password']);

    // di cek apakah user ada pada database
    $checkedLogin = $auth->login($email);

    if ($checkedLogin != null) {
        if (password_verify($password, $checkedLogin['password'])) {
            if (!empty($_POST['rem'])) {
                setcookie("email", $email, time()+(30*24*60*60), '/');
                setcookie("password", $password, time()+(30*24*60*60), '/');
            } else {
                setcookie("email", '', 1, '/');
                setcookie("password", '', 1, '/');
            }
            $_SESSION['user'] = $email;
            return true;
        } else {
            echo $auth->showMessage('danger', 'Password yang anda masukan salah, silakan coba lagi!');
        }
    } else {
        echo $auth->showMessage('danger', 'Email yang anda masukan tidak ada di database, silakan coba lagi!');
    }
}

// menghandle reset password
if (isset($_POST['action']) && $_POST['action'] == 'forgot' ) {
    $email = $auth->test_input($_POST['email']);
    
    $user_found = $auth->curentUser($email);

    if ($user_found != null) {
        $token = uniqid();
        $token = str_shuffle($token);

        $auth->forgot_password($token, $email);
        
        try {
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'yourEmail@gmail.com';                     // SMTP username
            $mail->Password   = 'yourPassword';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('yourEmail@gmail.com', 'Usis');
            $mail->addAddress($email);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = '(USIS) Reset password di USIS';
            $mail->Body    = '<h3>Klik link dibawah ini untuk mereset password anda<br/>
            <a href="http://localhost/user-sistem/reset-pass.php?email='. $email .' &token='. $token .'">
            http://localhost/user-sistem/reset-pass.php?email='. $email .'&token='. $token .'</a></h3>';

            $mail->send();
            echo $auth->showMessage('success', 'Pesan link reset password telah dikirim ke email anda!');
        } catch (Exception $e) {
            echo $auth->showMessage('danger', 'Pesan ke emai tidak dapat dikirim, Mailer error: '. $mail->ErrorInfo);
        }
    } else {
        echo $auth->showMessage('danger', 'Email yang anda masukan tidak ada di database, silakan coba lagi!');
    }
} 
?>

