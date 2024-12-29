<!DOCTYPE html>
<html lang="en">


<?php include("config/header.php");  ?>


<body>
	
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<div class="preloader">
			<div class="preloader-blk">
				<div class="preloader__image"></div>
			</div>
		</div>

		<!-- Header -->
		
		<?php include("config/topmenubar.php");  ?>
		<!-- /Header -->

		<!-- Sidebar  sidebarmenus.php -->
		<?php include("config/sidebarmenus.php");  ?>
		<!-- /Sidebar -->

		<!-- Page Wrapper -->
		<div class="page-wrapper card">
			<div class="content">

				<div class="row">
					
					<div class="col-md-12">
					
					
						<div class="page-header">
							<div class="row align-items-center ">
								<div class="col-md-4">
									<h3 class="page-title">Create Tickets</h3>
								</div>
								<div class="col-md-8 float-end ms-auto">
									<div class="d-flex title-head">
										<div class="daterange-picker d-flex align-items-center justify-content-center">
											<div class="form-sort me-2">
												<i class="ti ti-calendar"></i>
												<input type="text" class="form-control  date-range bookingrange">
											</div>	
											<div class="head-icons mb-0">
												<a href="index.php" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Refresh"><i class="ti ti-refresh-dot"></i></a>
												<a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header"><i class="ti ti-chevrons-up"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


					</div>
					 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

					 
					 
					 <?php 
					 
					 
					 
					 $sql = "SELECT * FROM helpdeskissuelogged";
$result = mysqli_query($dbc, $sql);

if (mysqli_num_rows($result) > 0) {
    // Fetch data into an associative array
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "0 results";
}

					 
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Issue ID</th><th>Primary Location</th><th>Issue Log Date</th><th>Request Category</th><th>Request Type</th><th>Status</th></tr>";
foreach ($data as $row) {
    echo "<tr>";
    echo "<td>".$row['ids']."</td>";
    echo "<td>".$row['issue_id']."</td>";
    echo "<td>".$row['Primary_Location']."</td>";
    echo "<td>".$row['issue_log_date']."</td>";
    echo "<td>".$row['Request_Category']."</td>";
    echo "<td>".$row['Request_Type']."</td>";
    echo "<td>".$row['status']."</td>";
    echo "</tr>";
}
echo "</table>";
					 
					 
					 
					 
					 
					 
					 
					 ?>
					 
					 
	<canvas id="statusChart"></canvas>
				 
	<?php 				 
					
	// Prepare data for chart
$status_data = [];
$status_labels = [];
foreach ($data as $row) {
    $status = $row['status'];
    if (isset($status_data[$status])) {
        $status_data[$status]++;
    } else {
        $status_data[$status] = 1;
    }
}
$status_labels = array_keys($status_data);
$status_values = array_values($status_data);

// Convert PHP arrays to JavaScript arrays
$status_labels_js = json_encode($status_labels);
$status_values_js = json_encode($status_values);
?>

<script>
var ctx = document.getElementById('statusChart').getContext('2d');
var statusChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: <?php echo $status_labels_js; ?>,
        datasets: [{
            label: 'Issue Status Distribution',
            data: <?php echo $status_values_js; ?>,
            backgroundColor: ['red', 'blue', 'green', 'orange', 'purple']
        }]
    }
});
</script>
				 
					 
					 
					 
					 
					 
					
				</div>

			</div>
		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->
	

	
	<?php include("config/jsfiles.php");  ?>

	

</body>
</html>