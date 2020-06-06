<!-- header -->
<?php

include 'assets/php/admin-header.php';

?>
<!-- ./header -->
  <!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <div class="content-header">
	    	<div class="container-fluid">
	    		<div class="row mb-2">
	    			<div class="col-sm-6">
	    				<h1 class="m-0 text-dark"><i class="fas fa-tachometer-alt fa-lg"></i>&nbsp;&nbsp;<?= $title; ?></h1>
	    			</div><!-- /.col -->
	    		</div><!-- /.row -->
	    	</div><!-- /.container-fluid -->
	    </div>
	    <!-- /.content-header -->

	    <!-- Main content -->
	    <section class="content">
	    	<div class="container-fluid">
	    		<!-- Info boxes -->
	    		<div class="row">
	    			<div class="col-12 col-sm-6 col-md-3">
	    				<div class="info-box">
	    					<span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

	    					<div class="info-box-content">
	    						<span class="info-box-text">Total Pengguna</span>
	    						<span class="info-box-number">
	    						<?= $admin->totalCount('users'); ?>
	    						</span>
	    					</div>
	    					<!-- /.info-box-content -->
	    				</div>
	    				<!-- /.info-box -->
	    			</div>
	    			<!-- /.col -->
	    			<div class="col-12 col-sm-6 col-md-3">
	    				<div class="info-box mb-3">
	    					<span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

	    					<div class="info-box-content">
	    						<span class="info-box-text">Pengguna Terverifikasi</span>
	    						<span class="info-box-number"><?= $admin->verifiedUsers(1) ?></span>
	    					</div>
	    					<!-- /.info-box-content -->
	    				</div>
	    				<!-- /.info-box -->
	    			</div>
	    			<!-- /.col -->

	    			<!-- fix for small devices only -->
	    			<div class="clearfix hidden-md-up"></div>

	    			<div class="col-12 col-sm-6 col-md-3">
	    				<div class="info-box mb-3">
	    					<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

	    					<div class="info-box-content">
	    						<span class="info-box-text">Pengguna Belum Terverifikasi</span>
	    						<span class="info-box-number"><?= $admin->verifiedUsers(0) ?></span>
	    					</div>
	    					<!-- /.info-box-content -->
	    				</div>
	    				<!-- /.info-box -->
	    			</div>
	    			<!-- /.col -->
	    			<div class="col-12 col-sm-6 col-md-3">
	    				<div class="info-box mb-3">
	    					<span class="info-box-icon bg-info elevation-1"><i class="fas fa-heart"></i></span>

	    					<div class="info-box-content">
	    						<span class="info-box-text">Website Hits</span>
	    						<span class="info-box-number"><?= $admin->countVisitors(); ?></span>
	    					</div>
	    					<!-- /.info-box-content -->
	    				</div>
	    				<!-- /.info-box -->
	    			</div>
	    			<!-- /.col -->
	    		</div>
	    		<!-- /.row -->

	    		<div class="row">
	    			<div class="col-12 col-sm-6 col-md-4">
	    				<div class="info-box">
	    					<span class="info-box-icon bg-success elevation-1"><i class="fas fa-sticky-note"></i></span>

	    					<div class="info-box-content">
	    						<span class="info-box-text">Total Notes</span>
	    						<span class="info-box-number"><?= $admin->totalCount('notes'); ?></span>
	    					</div>
	    					<!-- /.info-box-content -->
	    				</div>
	    				<!-- /.info-box -->
	    			</div>
	    			<!-- /.col -->
	    			<div class="col-12 col-sm-6 col-md-4">
	    				<div class="info-box mb-3">
	    					<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-comments"></i></span>

	    					<div class="info-box-content">
	    						<span class="info-box-text">Total Feedback</span>
	    						<span class="info-box-number"><?= $admin->totalCount('feedback'); ?></span>
	    					</div>
	    					<!-- /.info-box-content -->
	    				</div>
	    				<!-- /.info-box -->
	    			</div>
	    			<!-- /.col -->

	    			<!-- fix for small devices only -->
	    			<div class="clearfix hidden-md-up"></div>

	    			<div class="col-12 col-sm-6 col-md-4">
	    				<div class="info-box mb-3">
	    					<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-bell"></i></span>

	    					<div class="info-box-content">
	    						<span class="info-box-text">Total Notifikasi</span>
	    						<span class="info-box-number"><?= $admin->totalCount('notification'); ?></span>
	    					</div>
	    					<!-- /.info-box-content -->
	    				</div>
	    				<!-- /.info-box -->
	    			</div>
	    		</div>
	    	</div><!--/. container-fluid -->
	    	<div class="row">
	    		<div class="col-12 col-sm-6 col-md-6">
    				<div class="info-box">
    					<div id="chartOne"></div>
    				</div>
    				<!-- /.info-box -->
    			</div>
    			<div class="col-12 col-sm-6 col-md-6">
    				<div class="info-box">
    					<div id="chartTwo"></div>
    				</div>
    				<!-- /.info-box -->
    			</div>
	    	</div>

	    </section>
	    <!-- /.content -->
	</div>
  	<!-- /.content-wrapper -->
	
	<!-- footer -->
	<?php include 'assets/php/admin-footer.php';?>
	<!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Gender');
        data.addColumn('number', 'Number');
        data.addRows([
          <?php 
          	foreach ($admin->genderPercentage() as $row) {
          		echo '["'. $row['gender'] .'", '. $row['number'] .'],';
          	}
          ?>
        ]);
        var options = {'title':'Persentase Jenis Kelamin',
                       'width':400,
                       'height':300};
        var chart = new google.visualization.PieChart(document.getElementById('chartOne'));
        chart.draw(data, options);
      }

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(twChart);
      function twChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Verified');
        data.addColumn('number', 'Number');
        data.addRows([
          <?php 
          	foreach ($admin->verifiedPercentage() as $row) {
          		if ($row['verified'] == 0) {
          			$row['verified'] = "Unverified";
          		} else {
          			$row['verified'] = "Verified";
          		}
          		echo '["'. $row['verified'] .'", '. $row['number'] .'],';
          	}
          ?>
        ]);
        var options = {'title':'Persentase Jenis Kelamin',
                       'width':400,
                       'height':300};
        var chart = new google.visualization.PieChart(document.getElementById('chartTwo'));
        chart.draw(data, options);
      }

    </script>
</body>
</html>
