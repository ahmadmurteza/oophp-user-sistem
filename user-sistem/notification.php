<!-- header start -->
<?php
include 'assets/php/header.php';
?>
<!-- header end -->

        <div class="container">
            <div id="notification">
                <!-- notifikasi di assets/php/process.php -->
            </div>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                showAllNotification();
                // menampilkan semua alert notification
                function showAllNotification() {
                    $.ajax({
                        url: 'assets/php/process.php',
                        method: 'POST',
                        data: {action: 'showNotification'},
                        success: function (response) {
                            $('#notification').html(response);
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

                // remove notification
                $('body').on('click', '.close', function (e) {
                   e.preventDefault();
                   del_notif = $(this).attr('id');
                   $.ajax({
                       url: 'assets/php/process.php',
                       method: 'POST',
                       data: {del_notif: del_notif},
                       success: function (response) {
                           showAllNotification();
                           checkNotification();
                       }
                   }); 
                });
            });
        </script>
    </body>
</html>