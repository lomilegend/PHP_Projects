<div class="row">
							<div class="col-md-8 d-flex">		
								<div class="card flex-fill">
									<div class="card-body">
										<div class="statistic-header">
											<h4><i class="ti ti-grip-vertical me-1"></i>Recently Created Tickets</h4>
											<div class="dropdown statistic-dropdown">
												<div class="card-select">
													<ul>
														<li>
															<a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
																<i class="ti ti-calendar-check me-2"></i>Last 30 days
															</a>
															<div class="dropdown-menu dropdown-menu-end">
																<a href="javascript:void(0);" class="dropdown-item">
																	Last 15 days
																</a>
																<a href="javascript:void(0);" class="dropdown-item">
																	Last 30 days
																</a>
															</div>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="table-responsive custom-table">
											<table class="table dataTable" id="listoftickets"> 
												<thead class="thead-light">
													<tr>
														<th>Ticket ID</th>
														
														<th>Request Category</th>
														<th>Request Type</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4 d-flex">		
								<div class="card flex-fill">
									<div class="card-body">
									
									<div class="statistic-header">
											<h4><i class="ti ti-grip-vertical me-1"></i>Tickets Status Distribution</h4>
											<div class="dropdown statistic-dropdown">
												<div class="card-select">
													<ul>
														<li>
															<a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
																<i class="ti ti-calendar-check me-2"></i>Last 30 days
															</a>
															<div class="dropdown-menu dropdown-menu-end">
																<a href="javascript:void(0);" class="dropdown-item">
																	Last 15 days
																</a>
																<a href="javascript:void(0);" class="dropdown-item">
																	Last 30 days
																</a>
															</div>
														</li>
													</ul>
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
						</div>
						<div class="row">
							
							<div class="col-md-6 d-flex">		
								<div class="card flex-fill">
									<div class="card-body">
										<div class="statistic-header">
											<h4><i class="ti ti-grip-vertical me-1"></i>Issue Count by Location</h4>
											<div class="dropdown statistic-dropdown">
												
												
											</div>
										</div>
										
<?php										
										// Prepare data for Issue Count by Location
$location_data = [];
foreach ($data as $row) {
    $location = $row['Primary_Location'];
    if (isset($location_data[$location])) {
        $location_data[$location]++;
    } else {
        $location_data[$location] = 1;
    }
}
$location_labels = json_encode(array_keys($location_data));
$location_values = json_encode(array_values($location_data));
?>

<canvas id="locationChart"></canvas>
<script>
var ctx = document.getElementById('locationChart').getContext('2d');
var locationChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo $location_labels; ?>,
        datasets: [{
            label: 'Issue Count by Location',
            data: <?php echo $location_values; ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
									
										
										
									</div>
								</div>
							</div>
							<div class="col-md-6 d-flex">	
								<div class="card flex-fill">
									<div class="card-body ">
										<div class="statistic-header">
											<h4><i class="ti ti-grip-vertical me-1"></i>Trend of Issues Over Time</h4>
											<div class="dropdown statistic-dropdown">
												<div class="card-select">
													
												</div>
											</div>
										</div>
<?php 
										
								// Prepare data for Issues Over Time
$time_data = [];
foreach ($data as $row) {
    $date = date('Y-m-d', strtotime($row['issue_log_date'])); // Format to Y-m-d
    if (isset($time_data[$date])) {
        $time_data[$date]++;
    } else {
        $time_data[$date] = 1;
    }
}
$time_labels = json_encode(array_keys($time_data));
$time_values = json_encode(array_values($time_data));
?>

<canvas id="timeChart"></canvas>
<script>
var ctx = document.getElementById('timeChart').getContext('2d');
var timeChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo $time_labels; ?>,
        datasets: [{
            label: 'Issues Logged Over Time',
            data: <?php echo $time_values; ?>,
            fill: false,
            borderColor: 'rgba(54, 162, 235, 1)',
            tension: 0.1
        }]
    },
    options: {
        scales: {
            x: {
                type: 'time',
                time: {
                    unit: 'day'
                }
            }
        }
    }
});
</script>
		
										
										
										
										
										
										
									</div>
								</div>
							</div>











<div class="col-md-4 d-flex">		
								<div class="card flex-fill">
									<div class="card-body">
										<div class="statistic-header">
											<h4><i class="ti ti-grip-vertical me-1"></i>Issues by Request Category</h4>
											<div class="dropdown statistic-dropdown">
												
												
											</div>
										</div>
										
<?php										
										// Prepare data for Issue Count by Location
// Prepare data for Issues by Request Category
$category_data = [];
foreach ($data as $row) {
    $category = $row['Request_Category'];
    if (isset($category_data[$category])) {
        $category_data[$category]++;
    } else {
        $category_data[$category] = 1;
    }
}
$category_labels = json_encode(array_keys($category_data));
$category_values = json_encode(array_values($category_data));
?>

<canvas id="categoryChart"></canvas>
<script>
var ctx = document.getElementById('categoryChart').getContext('2d');
var categoryChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: <?php echo $category_labels; ?>,
        datasets: [{
            label: 'Issues by Request Category',
            data: <?php echo $category_values; ?>,
            backgroundColor: ['red', 'orange', 'yellow', 'green', 'blue', 'purple']
        }]
    }
});
</script>
									
										
										
									</div>
								</div>
							</div>
							<div class="col-md-8 d-flex">	
								<div class="card flex-fill">
									<div class="card-body ">
										<div class="statistic-header">
											<h4><i class="ti ti-grip-vertical me-1"></i>Issues by Request Type</h4>
											<div class="dropdown statistic-dropdown">
												<div class="card-select">
													
												</div>
											</div>
										</div>
<?php 
										
// Prepare data for Issues by Request Type
$type_data = [];
foreach ($data as $row) {
    $type = $row['Request_Type'];
    if (isset($type_data[$type])) {
        $type_data[$type]++;
    } else {
        $type_data[$type] = 1;
    }
}
$type_labels = json_encode(array_keys($type_data));
$type_values = json_encode(array_values($type_data));
?>

<canvas id="typeChart"></canvas>
<script>
var ctx = document.getElementById('typeChart').getContext('2d');
var typeChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: <?php echo $type_labels; ?>,
        datasets: [{
            label: 'Issues by Request Type',
            data: <?php echo $type_values; ?>,
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            x: {
                beginAtZero: true
            }
        }
    }
});
</script>
							
										
										
										
									</div>
								</div>
							</div>



















							<div class="col-md-12 d-flex">		
								<div class="card w-100">
									<div class="card-body">
										<div class="statistic-header">
											<h4><i class="ti ti-grip-vertical me-1"></i>Deals by Year</h4>
											<div class="dropdown statistic-dropdown">
												<div class="card-select">
													<ul>
														<li>
															<a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
																Sales Pipeline
															</a>
															<div class="dropdown-menu dropdown-menu-end">
																
																<a href="javascript:void(0);" class="dropdown-item">
																	Marketing Pipeline
																</a>
																<a href="javascript:void(0);" class="dropdown-item">
																	Sales Pipeline
																</a>
															</div>
														</li>
														<li>
															<a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
																Last 3 months
															</a>
															<div class="dropdown-menu dropdown-menu-end">
																
																<a href="javascript:void(0);" class="dropdown-item">
																	Last 3 months
																</a>
																<a href="javascript:void(0);" class="dropdown-item">
																	Last 6 months
																</a>
																<a href="javascript:void(0);" class="dropdown-item">
																	Last 12 months
																</a>
															</div>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div id="deals-year"></div>
									</div>
								</div>
							</div>
						</div>