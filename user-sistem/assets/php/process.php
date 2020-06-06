<?php

include 'session.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

// menghandle insert data
if (isset($_POST['action']) && $_POST['action'] == 'addNote') {
    $title = $cuser->test_input($_POST['title']);
    $notes = $cuser->test_input($_POST['notes']);

    $cuser->add_note($cid, $title, $notes);
    $cuser->insert_notification($cid, 'Aktivitas kamu', 'Menambahkan note');
}

// menghandle view data
if (isset($_POST['action']) && $_POST['action'] == 'view_notes') {
    $output = '';
    $no = 1;
    $notes = $cuser->read_note($cid);
    if ($notes) {
        $output .= '<table class="table text-center table-striped table-bordered table-hover" id="notesTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                    <tbody>';
        foreach ($notes as $row) {
            $output .= '<tr>
                            <th scope="row">'. $no++ .'</th>
                            <td>'. $row['title'] .'</td>
                            <td>'. substr($row['notes'], 0, 50) .'...</td>
                            <td>
                                <a href="" title="Lihat catatan" class="text-primary infoBtn" id="'. $row['id'] .'">
                                    <i class="fas fa-info-circle fa-lg"></i>&nbsp;
                                </a>
                                <a href="" title="Edit catatan" class="text-success editBtn" data-toggle="modal" 
                                data-target="#editNoteModal" id="'. $row['id'] .'">
                                    <i class="fas fa-edit fa-lg"></i>&nbsp;
                                </a>
                                <a href="" title="Hapus catatan" class="text-danger deleteBtn" id="'. $row['id'] .'">
                                    <i class="fas fa-trash fa-lg"></i>&nbsp;
                                </a>
                            </td>
                        </tr>';
        }
        $output .= '    </tbody>
                    </table>';
        echo $output;
    } else {
        echo '<h4 class="m-2 text-center">Note masih kosong!</h4>';
    }
    
}

// menghandle edit data
if (isset($_POST['edit_id'])) {
    $id = $cuser->test_input($_POST['edit_id']);

    $data = $cuser->edit_note($id);
    echo json_encode($data);
}

// handle update note 
if (isset($_POST['action']) && $_POST['action'] == 'updateNote' ) {
    print_r($_POST);
    $id = $cuser->test_input($_POST['id']);
    $title = $cuser->test_input($_POST['title']);
    $notes = $cuser->test_input($_POST['notes']);

    $cuser->update_note($id, $title, $notes);
    $cuser->insert_notification($cid, 'Aktivitas kamu', 'Memperbaharui note');
}

// handle delete note
if (isset($_POST['delete_id'])) {
    $id = $cuser->test_input($_POST['delete_id']);
    $cuser->delete_note($id);
    $cuser->insert_notification($cid, 'Aktivitas kamu', 'Menghapus note');
}

// handle view note
if (isset($_POST['info_id'])) {
    $id = $cuser->test_input($_POST['info_id']);
    $data = $cuser->edit_note($id);
    echo json_encode($data);
}

// handle edit profile
if (isset($_FILES['photo'])) {
    $name = $cuser->test_input($_POST['name']);
    $gender = $cuser->test_input($_POST['gender']);
    $dob = $cuser->test_input($_POST['dob']);
    $phone = $cuser->test_input($_POST['phone']);

    $file_tmp = $_FILES['photo']['tmp_name'];
    $old_image = $_POST['oldPhoto'];
    $new_image = $_FILES['photo']['name']; 
    if(isset($_FILES['photo']['name']) &&  $_FILES['photo']['name'] != '') {
        move_uploaded_file($file_tmp, 'uploads/'.$new_image);

        if ($old_image != null) {
            unlink($old_image);
        }
    } else {
        $new_image = $old_image;
    }
    $cuser->update_profile($name, $gender, $dob, $phone, $new_image, $cid);
    $cuser->insert_notification($cid, 'Aktivitas kamu', 'Memperbaharui profil');
}

// handle change password
if (isset($_POST['action']) && $_POST['action'] == 'editPassword' ) {
    $curpass = $cuser->test_input($_POST['curpass']);
    $newpass = $cuser->test_input($_POST['newpass']);
    $cnewpass = $cuser->test_input($_POST['cnewpass']);

    $hnewpass = password_hash($newpass, PASSWORD_DEFAULT);
    if (password_verify($curpass, $cpassword)) {
        if($newpass == $cnewpass) {
            $cuser->update_password($hnewpass, $cid);
            echo $cuser->showMessage('success', 'Password berhasil diperbaharui');
            $cuser->insert_notification($cid, 'Aktivitas kamu', 'Memperbaharui password');
        } else {
            echo $cuser->showMessage('danger', 'Konfirmasi password baru tidak sama, silakan coba lagi!');
        }
    } else {
        echo $cuser->showMessage('danger', 'Password sebelumnya salah, silakan coba lagi!');
    }
}

// handle verify email
if(isset($_POST['action']) && $_POST['action'] == 'verify') {
     try {
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'yourEmail@gmail.com';                     // SMTP username
            $mail->Password   = 'yourPassword';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('yourEmail@gmail.com', 'Usis');
            $mail->addAddress($cemail);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = '(USIS) Verifikasi di USIS';
            $mail->Body    = '<h3>Klik link dibawah ini untuk mereset password anda<br/>
            <a href="http://localhost/user-sistem/verify-email.php?email='. $cemail .'">
            http://localhost/user-sistem/verify-email.php?email='. $cemail .'</a></h3>';

            $mail->send();
            echo $cuser->showMessage('success', 'Pesan link verifikasi email telah dikirim ke email anda!');
        } catch (Exception $e) {
            echo $cuser->showMessage('danger', 'Pesan ke email tidak dapat dikirim, Mailer error: '. $mail->ErrorInfo);
        }
}

// menghandle insert feedback
if (isset($_POST['action']) && $_POST['action'] == 'addFeedback') {
    $subject = $cuser->test_input($_POST['subject']);
    $feedback = $cuser->test_input($_POST['feedback']);

    $cuser->send_feedback($cid, $subject, $feedback);
    echo $cuser->showMessage('success', 'feedback berhasil dikirim');
    $cuser->insert_notification($cid, 'Aktivitas kamu', 'Mengirim feedback');
}

// handle menampilkan semua notif
if(isset($_POST['action']) && $_POST['action'] == 'showNotification'){
    $output = '';
    
    $checkNotification = $cuser->get_notification($cid);
    if ($checkNotification) {
        foreach ($checkNotification as $row) {
            if ($row['type'] == 'Aktivitas kamu') {
                $alert = 'danger';
            } else {
                $alert = 'warning';
            }
            
            $output .= '
                    <div class="alert alert-'. $alert .' mt-5 mr-5 ml-5" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="'. $row['id'] .'">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="alert-heading">'. $row['type'] .'!</h4>
                        <p>'. $row['message'] .'</p>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p class="mb-0">created at</p>
                            <p>'. $cuser->elapsedTime($row['created_at']) .'</p>
                        </div>
                    </div>';
        }
        echo $output;
    } else {
        echo '<h1 class="text-center text-secondary mt-5">Notifikasi masih kosong</h1>';
    }
}

// handle untuk header notification
if(isset($_POST['action']) && $_POST['action'] == 'checkNotification'){
    $checkNotification = $cuser->get_notification($cid);
    if ($checkNotification) {
        echo '<i class="fas fa-circle fa-sm text-danger"><i>';
    } else {
        echo '';
    }
}

// handle untuk delete notification
if (isset($_POST['del_notif'])) {
    $id = $cuser->test_input($_POST['del_notif']);

    $cuser->delete_notification($id);
}
?>