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
	    				<h1 class="m-0 text-dark"><i class="fas fa-sticky-note fa-lg"></i>&nbsp;&nbsp;<?= $title; ?></h1>
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
	    					<div class="card-header bg-success">
	    						<h3 class="card-title">Tabel semua notes</h3>
	    					</div>
	    					<div class="card-body" id="showAllNotes">
	    						<!-- table di assets/php/admin-action.php -->
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    </section>
	    <!-- /.content -->
	</div>
  <!-- /.content-wrapper -->

  <!-- footer -->
	<?php include 'assets/php/admin-footer.php';?>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			// delete permanen user
			$('body').on('click', '.delPrmntUserId', function(e) {
				e.preventDefault();
				delPrmntNotesId = $(this).attr('id');
				Swal.fire({
				  	title: 'Yakin ?',
				  	text: "Notes akan dihapus permanen!",
				  	icon: 'error',
				  	showCancelButton: true,
				  	confirmButtonColor: '#3085d6',
				  	cancelButtonColor: '#d33',
				  	confirmButtonText: 'Ya, hapus permanen!',
				  	cancelButtonText: 'Batal'
				}).then((result) => {
				  	if (result.value) {
						$.ajax({
							url: 'assets/php/admin-action.php',
							method: 'POST',
							data: {delPrmntNotesId: delPrmntNotesId},
							success: function(response) {
								showAllNotes();
							}
						});
					    Swal.fire(
					      'Dihapus permanen!',
					      'Notes berhasil dihapus permanen!',
					      'success'
					    );
				  	}
				});
			});

			// membaca semua notes
			showAllNotes();
			function showAllNotes() {
				$.ajax({
					url: 'assets/php/admin-action.php', 
					method: 'POST',
					data: {action: 'readAllNotes'},
					success: function(response) {
						$('#showAllNotes').html(response);
						$('#allNotesTable').DataTable();
					}
				});
			}
		});
	</script>
</body>
</html>
