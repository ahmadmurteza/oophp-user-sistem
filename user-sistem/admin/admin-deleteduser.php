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
	    				<h1 class="m-0 text-dark"><i class="fas fa-user-slash fa-lg"></i>&nbsp;&nbsp;<?= $title; ?></h1>
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
	    					<div class="card-header bg-danger">
	    						<h3 class="card-title">Tabel semua pengguna yang telah dihapus</h3>
	    					</div>
	    					<div class="card-body" id="deletedUsersTable">
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

			// restore users
			$('body').on('click', '.restoreBtn', function(e) {
				e.preventDefault();
				restoreUserId = $(this).attr('id');
				Swal.fire({
				  	title: 'Yakin memulihkan?',
				  	text: "Data akan dipulihkan!",
				  	icon: 'warning',
				  	showCancelButton: true,
				  	confirmButtonColor: '#3085d6',
				  	cancelButtonColor: '#d33',
				  	confirmButtonText: 'Ya, pulihkan!',
				  	cancelButtonText: 'Batal'
				}).then((result) => {
				  	if (result.value) {
						$.ajax({
							url: 'assets/php/admin-action.php',
							method: 'POST',
							data: {restoreUserId: restoreUserId},
							success: function(response) {
								showAllDeletedUsers();
							}
						});
					    Swal.fire(
					      'Dipulihkan!',
					      'User berhasil dipulihkan!',
					      'success'
					    );
				  	}
				});
			});

			// delete permanen user
			$('body').on('click', '.delPrmntUserId', function(e) {
				e.preventDefault();
				delPrmntUserId = $(this).attr('id');
				Swal.fire({
				  	title: 'Yakin dihapus lagi?',
				  	text: "Data akan dihapus permanen!",
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
							data: {delPrmntUserId: delPrmntUserId},
							success: function(response) {
								showAllDeletedUsers();
							}
						});
					    Swal.fire(
					      'Dihapus permanen!',
					      'User berhasil dihapus permanen!',
					      'success'
					    );
				  	}
				});
			});

			// membaca semua user yang terhapus
			showAllDeletedUsers();
			function showAllDeletedUsers() {
				$.ajax({
					url: 'assets/php/admin-action.php', 
					method: 'POST',
					data: {action: 'readDeletedUsers'},
					success: function(response) {
						$('#deletedUsersTable').html(response);
						$('#deletedTableUsers').DataTable();
					}
				});
			}
		});
	</script>
</body>
</html>
