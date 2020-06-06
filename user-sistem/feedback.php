<!-- header start -->
<?php
include 'assets/php/header.php';
?>
<!-- header end -->

        <div class="container">
            <?php if($cverified == 'Telah diverifikasi!') : ?>
                <div class="card mt-4">
                    <div class="card-header bg-primary">
                        <h4 class="text-light">Kirim feedback kepada kami</h4>
                    </div>
                    <form action="" method="POST" id="form-add-feedback">
                        <div class="modal-body">
                            <div id="feedbackAlert"></div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject"  placeholder="Masukan Subject" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" required
                                placeholder="Masukan feedback disini" name="feedback"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary btn-block" name="addFeed" id="addFeedBtn" value="Kirim">
                        </div>
                    </form>
                </div>
            <?php else : ?>
                <h1 class="text-center font-weight-bold align-middle mt-4">Anda belum melakukan verifikasi</h1>
            <?php endif; ?>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                $('#addFeedBtn').click(function (e) {
                    if($('#form-add-feedback')[0].checkValidity()) {
                        e.preventDefault();
                        $('#addFeedBtn').val('Tunggu sebentar...');
                        $.ajax({
                            url: 'assets/php/process.php',
                            method: 'POST',
                            data: $('#form-add-feedback').serialize()+'&action=addFeedback',
                            success: function (response) {
                                $('#feedbackAlert').html(response);
                                $('#form-add-feedback')[0].reset();
                                $('#addFeedBtn').val('Kirim');
                            }
                        });
                    }
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