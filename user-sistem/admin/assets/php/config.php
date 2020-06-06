<?php

class Database  {

    private $dsn = 'mysql:host=localhost;dbname=user-sistem';
    private $user = 'root';
    private $pass = '';
    
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn, $this->user, $this->pass);
            // echo "Koneksi ke database berhasil<br/>";
        } catch (\PDOException $e) {
            echo "Eror: ". $e->getMessage();
        }
        return $this->conn;
    }

    // mengamankan data
    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    // menampilkan pesan error/info di div
    public function showMessage($type, $message) {
        return '<div class="alert alert-'. $type .' alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong class="text-center">'. $message .'</strong>
                </div>';
    }

    // menampilkan waktu 
    public function elapsedTime($timestamp) {
        date_default_timezone_set('Asia/Jakarta');
        
        $timestamp = strtotime($timestamp) ? strtotime($timestamp) : $timestamp;
        $time = $timestamp - time();
        switch ($time) {
            // baru saja
            case $time <= 60:
                return 'Baru saja';
            // menit
            case $time >= 60 && $time < 3600:
                return (round($time/60) == 1)? 'Semenit yang lalu' : round($time/60).' menit yang lalu';
            // jam
            case $time >= 3600 && $time < 86400:
                return (round($time/3600) == 1)? 'Sejam yang lalu' : round($time/3600).' jam yang lalu';
            // hari
            case $time >= 86400 && $time < 604800:
                return (round($time/86400) == 1)? 'Sehari yang lalu' : round($time/86400).' hari yang lalu';
            // minggu
            case $time >= 604800 && $time < 2600640:
                return (round($time/604800) == 1)? 'Seminggu yang lalu' : round($time/604800).' minggu yang lalu';
            // bulan
            case $time >= 2600640 && $time < 31207680:
                return (round($time/2600640) == 1)? 'Sebulan yang lalu' : round($time/2600640).' bulan yang lalu';
            // bulan
            case $time >= 31207680:
                return (round($time/2600640) == 1)? 'Setahun' : round($time/2600640).' tahun yang lalu';
        }
    }
}

// $db = new Database();


?>

