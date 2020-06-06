<?php

include 'assets/php/session.php';

// jika ada langsung login ke halaman profil
if(isset($_GET['email'])) {
    $email = $_GET['email'];
    $cuser->verify_email($email);
    header('location:profile.php');
    exit();
} else {                //jika tidak ada kembalikan ke index
    header('location:index.php');
    exit();
}
?>