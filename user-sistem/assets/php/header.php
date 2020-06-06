<?php
include 'session.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
        <style type="text/css">
            @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap');
            *{
                    font-family: 'Maven Pro', sans-serif;
            }
        </style>

        <title><?= ucfirst(basename($_SERVER['PHP_SELF'], '.php')) ?> | USIS</title>
    </head>
    <body>
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <!-- Brand -->
            <a class="navbar-brand" href="#"><i class="fas fa-code"></i>&nbsp;&nbsp;User-Sistem</a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == "home.php" ? "active" : ""; ?>" href="home.php">
                            <i class="fas fa-home"></i>&nbsp;Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == "profile.php" ? "active" : ""; ?>" href="profile.php">
                            <i class="fas fa-user-circle"></i>&nbsp;Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == "feedback.php" ? "active" : ""; ?>" href="feedback.php">
                            <i class="fas fa-comments"></i>&nbsp;Feedback
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == "notification.php" ? "active" : ""; ?>" href="notification.php">
                            <i class="fas fa-bell"></i>&nbsp;Notification&nbsp; <span id="checkNotificationSimbol"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-user-cog"></i>&nbsp;Hi <?= $fname; ?>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs"></i>&nbsp;Settings
                                </a>
                                <a class="dropdown-item" href="assets/php/logout.php">
                                    <i class="fas fa-sign-out-alt"></i>&nbsp;Log-out
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Navbar End -->