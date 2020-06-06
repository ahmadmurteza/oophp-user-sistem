<?php
session_start();
include 'admin-db.php'; 
$admin = new Admin();

// handle login admin
if (isset($_POST['action']) && $_POST['action'] == 'logIn') {
    $username = $admin->test_input($_POST['username']);
    $password = $admin->test_input($_POST['password']);

    $hashPassword = sha1($password);
    $checkedLogInAdmin = $admin->logInAdmin($username, $hashPassword);

    if ($checkedLogInAdmin != null) {
        echo 'adminLogIn';
        $_SESSION['username'] = $username;
    } else {
        echo $admin->showMessage('danger', 'Username/Password yang anda masukan salah, silakan coba lagi!');
    }
}

// handle read users
if (isset($_POST['action']) && $_POST['action'] == 'readUsers') {
    $output = '';
    $data = $admin->readAllUsers(1);
    if (!$data) {
        echo '<h4 class="m-2 text-center">Users masih kosong!</h4>';
    } else {
        $output .= '<table class="table table-hover table-boredered" id="tableUsers">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Photo</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nomer Hp</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Verifikasi</th>
                                <th>Tanggal Register</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    <tbody>';

        foreach ($data as $row) {
            $row['created_at'] = date('d M Y', strtotime($row['created_at']));

            if (isset($row['dob'])) {
                $row['dob'] = date('d M Y', strtotime($row['dob']));
            }

            if ($row['verified'] == 0) {
                $row['verified'] = "<span class='badge badge-danger'>Belum</span>";
            } else {
                $row['verified'] = "<span class='badge badge-success'>Sudah</span>";
            }

            if ($row['photo'] == '') {
                $row['photo'] = "default.png";
            }

            $output .= '<tr>
                            <th>'. $row['id'] .'</th>
                            <td><img src="../assets/img/'. $row['photo'] .'" class="img-fluid img-thumbnail" ></td>
                            <td>'. $row['name'] .'</td>
                            <td>'. $row['email'] .'</td>
                            <td>'. $row['phone'] .'</td>
                            <td>'. $row['gender'] .'</td>
                            <td>'. $row['dob'] .'</td>
                            <td>'. $row['verified'] .'</td>
                            <td>'. $row['created_at'] .'</td>
                            <td>
                                <a href="#" title="Lihat Pengguna" class="text-primary infoBtn" id="'. $row['id'] .'" data-toggle="modal" data-target="#showDetail">
                                    <i class="fas fa-info-circle fa-lg"></i>&nbsp;
                                </a>
                                <a href="#" title="Hapus Pengguna" class="text-danger deleteBtn" id="'. $row['id'] .'">
                                    <i class="fas fa-trash fa-lg"></i>&nbsp;
                                </a>
                            </td>
                        </tr>';
        }
        $output .= '</tbody>
                </table>';
        echo $output;
    }
}

// handle menampilkan detail
if (isset($_POST['infoUsersId'])) {
    $id = $admin->test_input($_POST['infoUsersId']);

    $data = $admin->getUsersById($id);

    if ($data['dob'] != null) {
        $data['dob'] = date('d M Y', strtotime($data['dob']));
    } else {
        $data['dob'] = '';
    }
    
    if ($data['verified'] == 0) {
        $data['verified'] = "Belum";
    } else {
        $data['verified'] = "Sudah";
    }

    $data['created_at'] = date('d M Y', strtotime($data['created_at']));
    echo json_encode($data);
}

// handle menghapus user (mengubah column deleted menjadi 0)
if (isset($_POST['deleteUserId'])) {
    $id = $admin->test_input($_POST['deleteUserId']);
    $admin->userAction($id, 0);
}

// handle read semua data user yang dihapus
if (isset($_POST['action']) && $_POST['action'] == 'readDeletedUsers') {
    $output = '';
    $data = $admin->readAllUsers(0);
    if (!$data) {
        echo '<h4 class="m-2 text-center">User yang terhapus kosong!</h4>';
    } else {
        $output .= '<table class="table table-hover table-boredered" id="deletedTableUsers">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Photo</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nomer Hp</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Verifikasi</th>
                                <th>Tanggal Register</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    <tbody>';

        foreach ($data as $row) {
            $row['created_at'] = date('d M Y', strtotime($row['created_at']));

            if (isset($row['dob'])) {
                $row['dob'] = date('d M Y', strtotime($row['dob']));
            }

            if ($row['verified'] == 0) {
                $row['verified'] = "<span class='badge badge-danger'>Belum</span>";
            } else {
                $row['verified'] = "<span class='badge badge-success'>Sudah</span>";
            }

            if ($row['photo'] == '') {
                $row['photo'] = "default.png";
            }

            $output .= '<tr>
                            <th>'. $row['id'] .'</th>
                            <td><img src="../assets/img/'. $row['photo'] .'" class="img-fluid img-thumbnail" ></td>
                            <td>'. $row['name'] .'</td>
                            <td>'. $row['email'] .'</td>
                            <td>'. $row['phone'] .'</td>
                            <td>'. $row['gender'] .'</td>
                            <td>'. $row['dob'] .'</td>
                            <td>'. $row['verified'] .'</td>
                            <td>'. $row['created_at'] .'</td>
                            <td>
                                <a href="#" title="Pulihkan Pengguna" class="text-secondary restoreBtn" id="'. $row['id'] .'">
                                    <i class="fas fa-trash-restore fa-lg"></i>&nbsp;&nbsp;
                                </a>
                                <a href="#" title="Hapus Pengguna Permanen" class="text-danger delPrmntUserId" id="'. $row['id'] .'">
                                    <i class="fas fa-trash fa-lg"></i>
                                </a>
                            </td>
                        </tr>';
        }
        $output .= '</tbody>
                </table>';
        echo $output;
    }
}

// handle memulihkan user (mengubah column deleted menjadi 1)
if (isset($_POST['restoreUserId'])) {
    $id = $admin->test_input($_POST['restoreUserId']);
    $admin->userAction($id, 1);

}

// handle menghapus user secara permanen
if (isset($_POST['delPrmntUserId'])) {
    $id = $admin->test_input($_POST['delPrmntUserId']);
    $admin->userDelete($id, 1);

}

// handle read notes
if (isset($_POST['action']) && $_POST['action'] == 'readAllNotes') {
    $output = '';
    $data = $admin->readAllNotes();
    if (!$data) {
        echo '<h4 class="m-2 text-center">User belum menulis note</h4>';
    } else {
        $output .= '<table class="table table-hover table-boredered text-center" id="allNotesTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Judul</th>
                                <th>Catatan</th>
                                <th>Ditulis pada</th>
                                <th>Diperbaharui pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    <tbody>';

        foreach ($data as $row) {
            $row['created_at'] = date('d M Y', strtotime($row['created_at']));
            $row['updated_at'] = date('d M Y', strtotime($row['updated_at']));

            $output .= '<tr>
                            <th>'. $row['id'] .'</th>
                            <td>'. $row['name'] .'</td>
                            <td>'. $row['email'] .'</td>
                            <td>'. $row['title'] .'</td>
                            <td>'. $row['notes'] .'</td>
                            <td>'. $row['created_at'] .'</td>
                            <td>'. $row['updated_at'] .'</td>
                            <td>
                                <a href="#" title="Hapus Catatan permanen" class="text-danger delPrmntUserId" id="'. $row['id'] .'">
                                    <i class="fas fa-trash fa-lg"></i>
                                </a>
                            </td>
                        </tr>';
        }
        $output .= '</tbody>
                </table>';
        echo $output;
    }
}

// handle menghapus notes secara permanen
if (isset($_POST['delPrmntNotesId'])) {
    $id = $admin->test_input($_POST['delPrmntNotesId']);
    $admin->notesDelete($id);
}

// handle read all feedback
if (isset($_POST['action']) && $_POST['action'] == 'readAllFeedback') {
    $output = '';
    $data = $admin->readAllFeedback();
    if (!$data) {
        echo '<h4 class="m-2 text-center">User belum menulis note</h4>';
    } else {
        $output .= '<table class="table table-hover table-boredered" id="allFeedbackTable">
                        <thead>
                            <tr>
                                <th>FID</th>
                                <th>UID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Feedback</th>
                                <th>Dikirim pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    <tbody>';

        foreach ($data as $row) {
            $row['created_at'] = date('d M Y', strtotime($row['created_at']));

            $output .= '<tr>
                            <th>'. $row['id'] .'</th>
                            <th>'. $row['uid'] .'</th>
                            <td>'. $row['name'] .'</td>
                            <td>'. $row['email'] .'</td>
                            <td>'. $row['subject'] .'</td>
                            <td>'. $row['feedback'] .'</td>
                            <td>'. $row['created_at'] .'</td>
                            <td>
                                <a href="#" title="Balas Feedback" class="text-primary replyFeedback" uid="'. $row['uid'] .'" fid="'. $row['id'] .'" data-toggle="modal" data-target="#replyForm">
                                    <i class="fas fa-reply fa-lg"></i>
                                </a>
                            </td>
                        </tr>';
        }
        $output .= '</tbody>
                </table>';
        echo $output;
    }
}

// handle reply form
if (isset($_POST['messageReply'])) {
    $uid = $admin->test_input($_POST['uid']);
    $fid = $admin->test_input($_POST['fid']);
    $messageReply = $admin->test_input($_POST['messageReply']);

    $admin->insertNotification($uid, 'Dari Admin', $messageReply);
    $admin->repliedFeedback($fid);
}

// handle export excel
if (isset($_GET['export']) && $_GET['export'] == 'excel') {
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=users.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    $output = '';
    $data = $admin->exportAllUsers();
    $output .= '<table border="1" align="center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nomer Hp</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Verifikasi</th>
                            <th>Tanggal Register</th>
                        </tr>
                    </thead>
                <tbody>';

    foreach ($data as $row) {
        $row['created_at'] = date('d M Y', strtotime($row['created_at']));

        if (isset($row['dob'])) {
            $row['dob'] = date('d M Y', strtotime($row['dob']));
        }

        if ($row['verified'] == 0) {
            $row['verified'] = "Belum";
        } else {
            $row['verified'] = "Sudah";
        }

        $output .= '<tr>
                        <th>'. $row['id'] .'</th>
                        <td>'. $row['name'] .'</td>
                        <td>'. $row['email'] .'</td>
                        <td>'. $row['phone'] .'</td>
                        <td>'. $row['gender'] .'</td>
                        <td>'. $row['dob'] .'</td>
                        <td>'. $row['verified'] .'</td>
                        <td>'. $row['created_at'] .'</td>
                    </tr>';
    }
    $output .= '</tbody>
            </table>';
    echo $output;
}
?>
