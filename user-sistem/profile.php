<!-- header start -->
<?php
include 'assets/php/header.php';
?>
<!-- header end -->

        <div class="container">
            <div class="card-group mt-4">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profil</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="editProfile-tab" data-toggle="tab" href="#editProfile" role="tab" aria-controls="editProfile" aria-selected="false">Edit profil</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="cpassword-tab" data-toggle="tab" href="#cpassword" role="tab" aria-controls="cpassword" aria-selected="false">Ganti Password</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <!-- Tab pane profile start -->
                            <div id="profileAlert"></div>
                            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body align-middle">
                                                <?php if(!$cphoto) :?>
                                                    <img src="assets/img/default.png" class="card-img img-fluid align-middle">
                                                <?php else : ?>
                                                    <img src="assets/php/uploads/<?= $cphoto; ?>" class="card-img img-fluid align-middle">
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item active text-center"> <b>ID User</b> (<?= $cid; ?>)  </li>
                                                    <li class="list-group-item"> 
                                                        <p>Nama: <b class="float-right"><?= $cname; ?></b></p>
                                                    </li>
                                                    <li class="list-group-item"> 
                                                        <p>Email: <b class="float-right"><?= $cemail; ?></b></p>
                                                    </li>
                                                    <li class="list-group-item"> 
                                                        <p>Jenis Kelamin: <b class="float-right"><?= $cgender; ?></b></p>
                                                    </li>
                                                    <li class="list-group-item"> 
                                                        <p>Tanggal lahir: <b class="float-right"><?= $scdob; ?></b></p>
                                                    </li>
                                                    <li class="list-group-item"> 
                                                        <p>Nomer HP: <b class="float-right"><?= $cphone; ?></b></p>
                                                    </li>
                                                    <li class="list-group-item"> 
                                                        <p>Terdaftar Pada: <b class="float-right"><?= $reg_on; ?></b></p>
                                                    </li>
                                                    <li class="list-group-item"> 
                                                        <p>Verifikasi:
                                                            <?php if($cverified == 'Belum diverifikasi!') :?>
                                                                <a href="#" class="float-right" id="verify">
                                                                    Verifikasi sekarang!
                                                                </a>
                                                            <?php else : ?>
                                                                <b class="float-right"><?= $cverified; ?></b>
                                                            <?php endif;?>
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tab pane profile end -->
                            <!-- Tab pane edit start -->
                            <div class="tab-pane fade" id="editProfile" role="tabpanel" aria-labelledby="editProfile-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <form method="POST" action="" id="edit-profile-form" enctype="multipart/form-data">
                                                    <input type="hidden" name="oldPhoto" value="<?= $cphoto; ?>">
                                                    <div class="form-group">
                                                        <label for="photo">Masukan foto profil anda</label>
                                                        <input type="file" class="form-control-file" name="photo" id="photo">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Nama</label>
                                                        <input type="text" class="form-control" name="name" id="name"
                                                        placeholder="Nama" value="<?= $cname; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gender">Jenis Kelamin</label>
                                                        <select class="form-control" name="gender" id="gender">
                                                            <option value="" <?php if($cgender == null) {echo "selected";}?> >
                                                                Pilih..
                                                            </option>
                                                            <option value="male" <?php if($cgender == 'male') {echo "selected";}?> >
                                                                Pria
                                                            </option>
                                                            <option value="female" <?php if($cgender == 'female') {echo "selected";}?> >
                                                                Wanita
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dob">Tanggal Lahir</label>
                                                        <input type="date" class="form-control" name="dob" id="dob"
                                                        value="<?= $cdob; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">Phone Number</label>
                                                        <input type="text" class="form-control" name="phone" id="phone"
                                                        placeholder="Phone Number" value="<?= $cphone; ?>">
                                                    </div>
                                                    <input type="submit" class="btn btn-primary btn-block" name="editProfile" id="editProfileBtn" 
                                                    value="Update">
                                                </form>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-body align-middle">
                                                        <?php if(!$cphoto) :?>
                                                            <img src="assets/img/default.png" class="card-img img-fluid align-middle">
                                                        <?php else : ?>
                                                            <img src="assets/php/uploads/<?= $cphoto; ?>" class="card-img img-fluid align-middle">
                                                        <?php endif;?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tab pane edit start -->
                            <!-- Tab pane change password start -->
                            <div class="tab-pane fade" id="cpassword" role="tabpanel" aria-labelledby="cpassword-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="changePassAlert"></div>
                                        <form action="" id="edit-password-form">
                                            <div class="form-group">
                                                <label for="curpass">Password sebelumnya</label>
                                                <input type="password" class="form-control" id="curpass" name="curpass"
                                                required>
                                            </div>
                                            <div class="form-group">
                                                <label for="newpass">Password baru</label>
                                                <input type="password" class="form-control" id="newpass" name="newpass"
                                                required minlength=5>
                                            </div>
                                            <div class="form-group">
                                                <label for="cnewpass">Konfimasi Password Baru</label>
                                                <input type="password" class="form-control" id="cnewpass" name="cnewpass"
                                                required>
                                            </div>
                                            <input type="submit" class="btn btn-warning btn-block" name="editPassword" 
                                            id="editPasswordBtn" value="Reset Password">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Tab pane change password end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                // form edit data
               $('#edit-profile-form').submit(function (e) {
                   e.preventDefault();
            
                    $.ajax({
                        url: 'assets/php/process.php',
                        method: 'POST',
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: new FormData(this),
                        success: function (response) {
                            document.location.reload();
                        }
                    });
               });

                // form change password
                $('#editPasswordBtn').click(function(e){
                    if($('#edit-password-form')[0].checkValidity()) {
                        e.preventDefault();

                        $('#editPasswordBtn').val('Tunggu sebentar...');
                        $.ajax({
                            url: 'assets/php/process.php',
                            method: 'POST',
                            data: $('#edit-password-form').serialize()+'&action=editPassword',
                            success: function (response) {
                                // console.log(response);
                                $('#changePassAlert').html(response);
                                $('#editPasswordBtn').val('Reset Password');
                                $('#edit-password-form')[0].reset();
                            }
                        });
                    }
                });

                $('#verify').click(function (e) {
                    e.preventDefault();
                    
                    $.ajax({
                        url: 'assets/php/process.php',
                        method: 'POST',
                        data: {action:'verify'},
                        success: function (response) {
                            $('#profileAlert').html(response);
                        }
                    });
                });

                checkNotification();
                // menampilkan simbol merah di navbar list notofication
                function checkNotification() {
                    $.ajax({
                        url: 'assets/php/process.php',
                        method: 'POST',
                        data: {action: 'checkNotification'},
                        success: function (response) {
                            $('#checkNotificationSimbol').html(response);
                        }
                    });
                }
            });
        </script>
    </body>
</html>