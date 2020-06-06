<?php

include 'config.php';

class Auth extends Database
{
    // register akun baru
    public function register($name, $email, $password) {
        $sql = "INSERT INTO users(name, email, password) 
                VALUES ('$name', '$email', '$password')";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return true;
    }

    // check apakah user sudah ada
    public function user_exist($email) {
        $sql = "SELECT email FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // fungsi login untuk mengambil data dari table user
    public function login($email) {
        $sql = "SELECT email, password FROM users WHERE email = :email AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // curent user digunakan untuk mencek session
    public function curentUser($email) {
        $sql = "SELECT * FROM users WHERE email = :email AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // digunakan untuk mengupdate token dan token_expire pada tabel users
    public function forgot_password($token, $email) {
        $sql = "UPDATE users SET token = :token, token_expire = DATE_ADD(NOW(), INTERVAL 10 MINUTE)
                WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['token' => $token, 'email' => $email]);
        return true;
    }

    // cek apakah token dan token_expire sesuai
    public function reset_pass_auth($email, $token) {
        $sql = "SELECT id FROM users WHERE email = :email AND token = :token AND token != '' AND token_expire > NOW() 
                AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email, 'token' => $token]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // update password baru
    public function update_pass_auth($email, $password) {
        $sql = "UPDATE users SET token = '', password = :password WHERE email = :email AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email, 'password' => $password]);
        return true;
    }

    // memasukan note kedatabase
    public function add_note($uid, $title, $notes) {
        $sql = "INSERT INTO notes(uid, title, notes) VALUE(:uid, :title, :notes)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid' => $uid, 'title' => $title, 'notes' => $notes]);
        return true;
    }

    // mengambil data notes didatabase
    public function read_note($uid) {
        $sql = "SELECT * FROM notes WHERE uid = :uid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid' => $uid]);
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // load edit notes
    public function edit_note($id) {
        $sql = "SELECT * FROM notes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // update notes
    public function update_note($id, $title, $notes) {
        $sql = "UPDATE notes SET title = :title, notes = :notes, updated_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([ 'title' => $title, 'notes' => $notes, 'id' => $id]);
        return true;
    }

    // delete notes
    public function delete_note($id) {
        $sql = "DELETE FROM notes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }

    // update profile
    public function update_profile($name, $gender, $dob, $phone, $new_image, $id) {
        $sql = "UPDATE users SET name = :name, gender = :gender, dob = :dob, phone = :phone, photo = :photo 
                WHERE id = :id AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'gender' => $gender, 'dob' => $dob, 'phone' => $phone, 'photo' => $new_image,
                        'id' => $id]);
        return true;
    }

    // update pasword
    public function update_password($password, $id) {
        $sql = "UPDATE users SET password = :password WHERE id = :id AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['password' => $password, 'id' => $id]);
        return true;
    }

    // memverifikasi email
    public function verify_email($email) {
        $sql = "UPDATE users SET verified = 1 WHERE email = :email AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return true;
    }

    // mengirim feedback
    public function send_feedback($uid, $subject, $feedback) {
        $sql = "INSERT INTO feedback(uid, subject, feedback) 
                VALUES (:uid, :subject, :feedback)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid' => $uid, 'subject' => $subject, 'feedback' => $feedback]);
        return true;
    }

    // memasukan notification
    public function insert_notification($uid, $type, $message) {
        $sql = "INSERT INTO notification(uid, type, message) VALUES(:uid, :type, :message)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid' => $uid, 'type' => $type, 'message' => $message]);
        return true;
    }

    // mengambil semua notifikasi
    public function get_notification($uid) {
        $sql = "SELECT * FROM notification WHERE uid = :uid ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid' => $uid]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // delete notification
    public function delete_notification($id) {
        $sql = "DELETE FROM notification WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }
}


?>