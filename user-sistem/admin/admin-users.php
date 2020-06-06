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
	    				<h1 class="m-0 text-dark"><i class="fas fa-users fa-lg"></i>&nbsp;&nbsp;<?= $title; ?></h1>
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
	    					<div class="card-header">
	    						<h3 class="card-title">Tabel Semua Pengguna</h3>
	    					</div>
	    					<div class="card-body" id="usersTable">
	    						<!-- table di assets/php/admin-action.php -->
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    </section>
	    <!-- /.content -->
	</div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="showDetail" tabindex="-1" role="dialog" aria-labelledby="showDetailLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg">
  		<div class="modal-content">
  			<div class="modal-header bg-info">
  				<h5 class="modal-title"><strong class="text-uppercase" id="getIdName"></strong></h5>
  				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  					<span aria-hidden="true">&times;</span>
  				</button>
  			</div>
  			<div class="modal-body">
			 	<div class="card-deck">
			 		<div class="card align-self-center" id="getImage"></div>
			 		<div class="card border-info">
			 			<div class="card-body">
			 				<p class="text-justify" id="getEmail"></p>
			 				<p class="text-justify" id="getPhone"></p>
			 				<p class="text-justify" id="getGender"></p>
			 				<p class="text-justify" id="getDOB"></p>
			 				<p class="text-justify" id="getVerified"></p>
			 				<p class="text-justify" id="getCreated_at"></p>
			 			</div>
			 		</div>
			 	</div>
  			</div>
  			<div class="modal-footer">
  				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  			</div>
  		</div>
  	</div>
  </div>

  <!-- footer -->
	<?php include 'assets/php/admin-footer.php';?>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			// menampilkan info users
			$('body').on('click', '.infoBtn', function(e) {
				e.preventDefault();
				infoUsersId = $(this).attr('id');
				$.ajax({
					url: 'assets/php/admin-action.php',
					method: 'POST',
					data: {infoUsersId: infoUsersId},
					success: function(response) {
						data = JSON.parse(response);
						$('#getIdName').text(data.name +' (ID: '+ data.id +')');
						$('#getEmail').text('Email : '+ data.email);
						$('#getPhone').text('Nomer Hp : '+ data.phone);
						$('#getGender').text('Jenis Kelamin : '+ data.gender);
						$('#getDOB').text('Tanggal Lahir : '+ data.dob);
						$('#getVerified').text('Verifikasi : '+ data.verified);
						$('#getCreated_at').text('Tanggal Register : '+ data.created_at);

						if (data.photo != '') {
							$('#getImage').html('<img src="../assets/img/'+ data.photo +'" class="img-fluid img-thumbnail" >');
						} else {
							$('#getImage').html('<img src="../assets/img/default.png" class="img-fluid img-thumbnail">');
						}
					}
				});
			});

			// delete user
			$('body').on('click', '.deleteBtn', function(e) {
				e.preventDefault();
				deleteUserId = $(this).attr('id');
				Swal.fire({
				  	title: 'Yakin menghapus?',
				  	text: "Data masih bisa di restore!",
				  	icon: 'warning',
				  	showCancelButton: true,
				  	confirmButtonColor: '#3085d6',
				  	cancelButtonColor: '#d33',
				  	confirmButtonText: 'Ya, hapus!',
				  	cancelButtonText: 'Batal'
				}).then((result) => {
				  	if (result.value) {
						$.ajax({
							url: 'assets/php/admin-action.php',
							method: 'POST',
							data: {deleteUserId: deleteUserId},
							success: function(response) {
								showAllUsers();
							}
						});
					    Swal.fire(
					      'Terhapus!',
					      'User berhasil terhapus!',
					      'success'
					    );
				  	}
				});
			});

			// membaca semua pengguna
			showAllUsers();
			function showAllUsers() {
				$.ajax({
					url: 'assets/php/admin-action.php', 
					method: 'POST',
					data: {action: 'readUsers'},
					success: function(response) {
						$('#usersTable').html(response);
						$('#tableUsers').DataTable();
					}
				});
			}
		});
	</script>
</body>
</html>
