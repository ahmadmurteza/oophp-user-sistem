<!-- header start -->
<?php
include 'assets/php/header.php';
?>
<!-- header end -->

        <div class="container">
            <div class="row">
                <!-- notif verifikasi start -->
                <div class="col-lg-12">
                    <?php if ($cverified == 'Belum diverifikasi!') { ?>
                        <div class="alert alert-danger alert-dismissable mt-2">
                            <button class="close" data-dismiss="alert" type="button">&times;</button>
                            <strong class="text-center">
                                User belum diverifikasi! silahkan cek email anda untuk melakukan verifikasi
                            </strong>
                        </div>
                    <?php } ?>
                </div>
                <!-- notif verifikasi end -->
                <!-- card table start -->
                <div class="col-lg-12">
                    <div class="card mt-2 border-info">
                        <div class="card-header bg-info d-flex justify-content-between">
                            <span class="lead text-light align-self-center">Semua catatan</span>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addNoteModal">
                                <i class="fas fa-pen-fancy"></i>&nbsp;&nbsp;Tambah Catatan
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="show-all-notes">
                            <!-- form di assets/php/process.php -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card table end -->
            </div>
        </div>


    <!-- Modal Add start-->
    <div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambahkan Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="form-add-note">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="title"  placeholder="Masukan Judul">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3"
                            placeholder="Masukan notes disini" name="notes"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary btn-block" name="addNote" id="addNoteBtn" value="Tambahkan">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Add end-->

     <!-- Modal Edit start-->
    <div class="modal fade" id="editNoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="form-edit-note">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" id="id">
                            <input type="text" class="form-control" name="title" id="title">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="notes" rows="3" name="notes"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success btn-block" name="editNote" id="editNoteBtn" value="Perbaharui">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edit end-->

 
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                
                $('#addNoteBtn').click(function (e) {
                    if ($('#form-add-note')[0].checkValidity()) {
                        e.preventDefault();
                        $('#addNoteBtn').val('Tunggu sebentar..');
                        $.ajax({
                            url: 'assets/php/process.php',
                            method: 'POST',
                            data: $('#form-add-note').serialize()+'&action=addNote',
                            success: function (response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Note telah ditambahkan',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#form-add-note')[0].reset();
                                $('#addNoteModal').modal('hide');
                                $('#addNoteBtn').val('Tambahkan');
                                showAllNotes();
                            }
                        });
                    }
                   
                });

                // load edit/ menapilkan data di edit form
                $('body').on('click', '.editBtn', function (e) {
                    e.preventDefault();
                    edit_id = $(this).attr('id');

                    $.ajax({
                        url: 'assets/php/process.php',
                        method: 'POST',
                        data: {edit_id:edit_id},
                        success: function (response) {
                            data = JSON.parse(response);
                            $('#id').val(data.id);
                            $('#title').val(data.title);
                            $('#notes').val(data.notes);
                        }
                    });
                });

                // update data notes
                $('#editNoteBtn').click(function (e) {
                    if($('#form-edit-note')[0].checkValidity()) {
                        e.preventDefault();
                        $('#editNoteBtn').val('Tunggu sebentar..');
                        $.ajax({
                            url: 'assets/php/process.php',
                            method: 'POST',
                            data: $("#form-edit-note").serialize()+'&action=updateNote',
                            success: function (response) {
                                // console.log(response);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Note telah diperbaharui',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#form-edit-note')[0].reset();
                                $('#editNoteModal').modal('hide');
                                $('#editNoteBtn').val('Perbaharui');
                                showAllNotes();
                            }
                        });
                    }
                });

                // delete data
                $('body').on('click', '.deleteBtn', function (e) {
                    e.preventDefault();
                    delete_id = $(this).attr('id');

                    Swal.fire({
                        title: 'Anda yakin?',
                        text: "Pastikan anda tidak salah!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: 'assets/php/process.php',
                                method: 'POST',
                                data: {delete_id:delete_id},
                                success: function (response) {
                                    Swal.fire(
                                        'Terhapus!',
                                        'Note telah dihapus!',
                                        'success'
                                    );
                                    showAllNotes();    
                                }
                            });
                        }
                    });
                });

                // menapilkan notes
                $('body').on('click', '.infoBtn', function (e) {
                    e.preventDefault();
                    info_id = $(this).attr('id');

                    $.ajax({
                        url: 'assets/php/process.php',
                        method: 'POST',
                        data: {info_id: info_id},
                        success: function (response) {
                            data = JSON.parse(response);
                            Swal.fire({
                                    icon: 'info',
                                    title: '<strong>Note = ID('+ data.id +')</strong>',
                                    html:'<b>Title = </b>'+ data.title +'<br><br><b>Note = </b>'+ data.notes +
                                    '<br><br><b>Written on = </b>'+ data.created_at +'<br><br><b>Updated on = </b>'+ data.updated_at,
                                    showCloseButton: true
                            });
                            
                        }
                    });
                });

                // menampilkan table
                showAllNotes();
                function showAllNotes() {
                    $.ajax({
                        url: 'assets/php/process.php',
                        method: 'POST',
                        data: {action: 'view_notes'},
                        success: function (response) {
                            $('#show-all-notes').html(response);
                            $('#notesTable').DataTable();
                        }
                    });
                }

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