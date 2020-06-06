<?php

include 'assets/php/admin-header.php'

?>

  <!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <div class="content-header">
	    	<div class="container-fluid">
	    		<div class="row mb-2">
	    			<div class="col-sm-6">
	    				<h1 class="m-0 text-dark"><i class="fas fa-comment fa-lg"></i>&nbsp;&nbsp;<?= $title; ?></h1>
	    			</div>
	    		</div>
	    	</div>
	    </div>
	    <!-- /.content-header -->

	    <!-- Main content -->
	    <section class="content">
	    	<div class="container-fluid">
	    		<div class="row">
	    			<div class="col-12">
	    				<div class="card">
	    					<div class="card-header bg-warning">
	    						<h3 class="card-title">Tabel semua umpan balik</h3>
	    					</div>
	    					<div class="card-body" id="showAllFeedback">
	    						<!-- table di assets/php/admin-action.php -->
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    </section>
	    <!-- /.content -->
	</div>
  <!-- /.content-wrapper -->
	<div class="modal fade" id="replyForm" tabindex="-1" role="dialog" aria-labelledby="replyFormLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered">
	  		<div class="modal-content">
	  			<div class="modal-header bg-danger">
	  				<h5 class="modal-title">Form Feedback</h5>
	  				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  					<span aria-hidden="true">&times;</span>
	  				</button>
	  			</div>
	  			<form action="" method="POST" id="form-reply-feedback">
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea class="form-control" id="message" rows="3" name="message"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-danger btn-block" name="feedbackReply" id="feedbackReplyBtn" value="Kirim balasan">
                    </div>
                </form>
	  		</div>
	  	</div>
	</div>
  <!-- footer -->
	<?php include 'assets/php/admin-footer.php';?>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script type="text/javascript">
		$(document).ready(function() {

			// set uid dan fid
			var fid;
			var uid;
			$('body').on('click', '.replyFeedback', function(){
				fid = $(this).attr('fid');
				uid = $(this).attr('uid');
			}); 

			// mengirim balasan feedback dari users
			$('#feedbackReplyBtn').click(function(e){
				if ($('#form-reply-feedback')[0].checkValidity()) {
					e.preventDefault();
					let messageReply = $('#message').val();
					$('#feedbackReplyBtn').val('Tunggu sebentar..');
                    $.ajax({
                        url: 'assets/php/admin-action.php',
                        method: 'POST',
                        data: {fid: fid, uid: uid, messageReply: messageReply},
                        success: function (response) {
                            console.log(response);
                            Swal.fire({
                                icon: 'success',
                                title: 'Feedback telah dikirim',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#form-reply-feedback')[0].reset();
                            $('#replyForm').modal('hide');
                            $('#feedbackReplyBtn').val('Kirim balasan');
                            showAllFeedback();
                        }
                    });
				}
			});

			// membaca semua feedback
			showAllFeedback();
			function showAllFeedback() {
				$.ajax({
					url: 'assets/php/admin-action.php', 
					method: 'POST',
					data: {action: 'readAllFeedback'},
					success: function(response) {
						$('#showAllFeedback').html(response);
						$('#allFeedbackTable').DataTable();
					}
				});
			}
		});
	</script>
</body>
</html>
