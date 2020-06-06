<?php

include 'config.php';

class Admin extends Database
{
	// fungsi login admin
    public function logInAdmin($username, $password) {
        $sql = "SELECT username, password FROM admin 
                WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $password]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // fungsi menghitung baris table pada database
   	public function totalCount($table) {
   		$sql = "SELECT * FROM $table";
   		$stmt = $this->conn->prepare($sql);
   		$stmt->execute();
   		$count = $stmt->rowCount();
   		return $count;
   	}

   	// pengguna terverifikasi dan belum terverifikasi
   	public function verifiedUsers($status) {
   		$sql = "SELECT verified FROM users WHERE verified = :status";
   		$stmt = $this->conn->prepare($sql);
   		$stmt->execute(['status' => $status]);
   		$count = $stmt->rowCount();
   		return $count;
   	}

   	// gender percentage
   	public function genderPercentage() {
   		$sql = "SELECT gender, COUNT(*) AS number FROM users WHERE gender != '' GROUP BY gender";
   		$stmt = $this->conn->prepare($sql);
   		$stmt->execute();
   		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
   		return $result;
   	}

   	// verified persentasi 
   	public function verifiedPercentage() {
   		$sql = "SELECT verified, COUNT(*) AS number FROM users GROUP BY verified";
   		$stmt = $this->conn->prepare($sql);
   		$stmt->execute();
   		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
   		return $result;
   	}

   	// menampilkan jumlah pengunjung
   	public function countVisitors() {
   		$sql = "SELECT hits FROM visitors";
   		$stmt = $this->conn->prepare($sql);
   		$stmt->execute();
   		$result = $stmt->fetch(PDO::FETCH_ASSOC);
   		$result = $result['hits'];
   		return $result;
   	}

   	// mengambil semua data users yang terhapus ataupun belum dihapus tergantung parameter $val
   	public function readAllUsers($val){
   		$sql = "SELECT id, name, email, phone, gender, dob, photo, verified, created_at FROM users WHERE deleted = :val";
   		$stmt = $this->conn->prepare($sql);
   		$stmt->execute(['val' => $val]);
   		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
   		return $result;
   	}

   	// mengambil data sesuai id
   	public function getUsersById($id) {
   		$sql = "SELECT id, name, email, phone, gender, dob, photo, verified, created_at FROM users WHERE id = :id AND deleted != 0";
   		$stmt = $this->conn->prepare($sql);
   		$stmt->execute(['id' => $id]);
   		$data = $stmt->fetch(PDO::FETCH_ASSOC);
   		return $data;
   	}

   	//menghapus atau merestore user
   	public function userAction($id, $val) {
   		$sql = "UPDATE users SET deleted = $val WHERE id = :id";
   		$stmt = $this->conn->prepare($sql);
   		$stmt->execute(['id' => $id]);
   		return true;
   	}

    //menghapus permanen user
    public function userDelete($id) {
      $sql = "DELETE FROM users WHERE id = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id' => $id]);
      return true;
    }

    // mengambil data notes dan user
    public function readAllNotes() {
      $sql = "SELECT notes.id, notes.title, notes.notes, notes.created_at, notes.updated_at,
              users.name, users.email
              FROM notes
              INNER JOIN users
              ON notes.uid = users.id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    //menghapus permanen user
    public function notesDelete($id) {
      $sql = "DELETE FROM notes WHERE id = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id' => $id]);
      return true;
    }

    // mengambil data feedback dan user
    public function readAllFeedback() {
      $sql = "SELECT feedback.id, feedback.uid, feedback.subject, feedback.feedback, feedback.created_at,
              users.name, users.email
              FROM feedback
              INNER JOIN users
              ON feedback.uid = users.id
              WHERE replied != 1
              ORDER BY feedback.id DESC";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    // membuat reply ke notifikasi privilage users
    public function insertNotification($uid, $type, $message) {
        $sql = "INSERT INTO notification(uid, type, message) VALUES(:uid, :type, :message)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid' => $uid, 'type' => $type, 'message' => $message]);
        return true;
    }

    // membuat feedback setelah di reply hilang dengan cara mengubah kolum replied di table notification menjadi 1
    public function repliedFeedback($fid) {
      $sql = "UPDATE feedback SET replied = 1 WHERE id = :fid";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['fid' => $fid]);
      return true;
    }

    // mengexport semua users
    public function exportAllUsers(){
      $sql = "SELECT id, name, email, phone, gender, dob, photo, verified, created_at FROM users WHERE deleted = 1";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
}

?>