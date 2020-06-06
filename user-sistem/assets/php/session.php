<?php 

session_start();
include 'auth.php';
$cuser = new Auth();

if (!isset($_SESSION['user'])) {
    header('location: index.php');
    die;
}

$cemail = $_SESSION['user'];

$data = $cuser->curentUser($cemail);

$cid = $data['id'];
$cname = $data['name'];
$cemail = $data['email'];
$cpassword = $data['password'];
$cphone = $data['phone'];
$cgender = $data['gender'];
$cdob = $data['dob'];
$cphoto = $data['photo'];
$created_at = $data['created_at'];
$cverified = $data['verified'];

$fname = strtok($cname, " ");

$reg_on = date('d M Y', strtotime($created_at));
if ($cdob != null) {	
	$scdob = date('d M Y', strtotime($cdob));
} else {
	$scdob = '';
}

if ($cverified == 0) {
    $cverified = 'Belum diverifikasi!';
} else {
    $cverified = 'Telah diverifikasi!';
}
?>