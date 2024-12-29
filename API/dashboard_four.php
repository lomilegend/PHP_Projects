<div class="row">
                            <div class="col-xl-4 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="#" class="p-0 float-right mb-3">Export <i class="mdi mdi-download ml-1"></i></a>
                                        <h4 class="header-title mt-1">Dormant Per Branch</h4>

                                        <div class="table-responsive">
                                            <table class="table table-sm table-centered mb-0 font-14">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th style="width: 60%;">Branch Name</th>
                                                        <th>No. of Accounts</th>
                                                        <th style="width: 40%;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												
												<?php 


$q = mysqli_query($dbc,"SELECT CO_CODE, count(*) as countall from dormant_account_all group by CO_CODE");

							while($data = mysqli_fetch_assoc($q)){
												
								$CO_CODE=$data['CO_CODE'];
								
								$countall=$data['countall'];
								$addallcount +=$countall;	
								
							}
												
												
							$q = mysqli_query($dbc,"SELECT CO_CODE, count(*) as countall from dormant_account_all group by CO_CODE");

							while($data = mysqli_fetch_assoc($q)){
												
								$CO_CODE=$data['CO_CODE'];
								
								$countall=$data['countall'];
								
											
												?>
												
                                                    <tr>
                                                        <td><?php 
														
		$q1 = mysqli_query($dbc,"SELECT * from heritagecompany where `@ID`='$CO_CODE'");
		$data1 = mysqli_fetch_assoc($q1);
											echo $data1['COMPANY_NAME'];	


														?></td>
                                                        <td>
														<?php 
														//$countall2 +=$countall;
														
														echo $countall;     
														
														
													  ?></td>
														
														
                                                        <td>
														<?php echo round(($countall/$addallcount)*100,2);   ?>%
                                  <div class="progress" style="height: 20px;">
								  
<div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo ($countall/$addallcount)*100;   ?>%; height: 20px;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>

                                                            
								  </div>
                                                        </td>
														
														
														
                                                    </tr>
													
													
													
													<?php  
													
								}
													
										echo $countall2;
										?>
													
													
													
                                                    
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-xl-4 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="#" class="p-0 float-right mb-3">Export <i class="mdi mdi-download ml-1"></i></a>
                                        <h4 class="header-title mt-1">Reactivated Dormant Per Branch</h4>

                                        <div class="table-responsive">
                                            <table class="table table-sm table-centered mb-0 font-14">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th style="width: 60%;">Branch Name</th>
                                                        <th>No. of Accounts</th>
                                                        <th style="width: 40%;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												
												<?php 


$q4 = mysqli_query($dbc,"SELECT CO_CODE, count(*) as countall from dormant_account_all where RESTORE_STATUS!='' group by CO_CODE");

							while($data4 = mysqli_fetch_assoc($q4)){
												
								$CO_CODE=$data4['CO_CODE'];
								
								$countall=$data4['countall'];
								$addallcount +=$countall;	
								
							}
												
												
	$q = mysqli_query($dbc,"SELECT CO_CODE, count(*) as countall from dormant_account_all where RESTORE_STATUS!='' group by CO_CODE");

							while($data = mysqli_fetch_assoc($q)){
												
								$CO_CODE=$data['CO_CODE'];
								
								$countall=$data['countall'];
								
											
												?>
												
                                                    <tr>
                                                        <td><?php 
														
		$q1 = mysqli_query($dbc,"SELECT * from heritagecompany where `@ID`='$CO_CODE'");
		$data1 = mysqli_fetch_assoc($q1);
											echo $data1['COMPANY_NAME'];	


														?></td>
                                                        <td>
														<?php 
														//$countall2 +=$countall;
														
														echo $countall;     
														
														
													  ?></td>
														
														
                                                        <td>
														<?php echo round(($countall/$addallcount)*100,2);   ?>%
                                  <div class="progress" style="height: 20px;">
								  
<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $countall;   ?>%; height: 20px;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>

                                                            
								  </div>
                                                        </td>
														
														
														
                                                    </tr>
													
													
													
													<?php  
													
								}
													
										echo $countall2;
										?>
													
													
													
                                                    
                                                </tbody>
                                            </table>
                                        </div>




										<!-- end table-responsive-->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-xl-4 col-lg-6 order-lg-1">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-right">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <!-- item-->
                                               
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                                <!-- item-->
                                                
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                            </div>
                                        </div>
                                        <h4 class="header-title">Dormant per Account Category</h4>

                                        <div id="average-sales" class="apex-charts mb-4 mt-4"
                                            data-colors="#727cf5,#0acf97,#fa5c7c,#ffbc00"></div>
                                       

                                        <div class="chart-widget-list">
										
										<?php 


$q4 = mysqli_query($dbc,"SELECT CATEGORY, count(*) as countall from dormant_account_all group by CATEGORY order by count(*) desc limit 10");

							while($data4 = mysqli_fetch_assoc($q4)){
												
								$CATEGORY1=$data4['CATEGORY'];
								
								$countall1=$data4['countall'];

	
								if($countall<200){
									//continue;
									
								}
								
						 $datavalue1.="$countall1,";	
								
	$q1 = mysqli_query($dbc,"SELECT * from t24categories where `@ID`='$CATEGORY1'");
		$data1 = mysqli_fetch_assoc($q1);
											$DESCRIPTION3=$data1['DESCRIPTION'];								
								
											
				if($DESCRIPTION3==''){
									continue;
									
								}							
						

$labels12.="'$DESCRIPTION3',";	
								
								
							}//endwhile
												
												
	$q = mysqli_query($dbc,"SELECT CATEGORY, count(*) as countall from dormant_account_all group by CATEGORY order by count(*) desc limit 10");

							while($data = mysqli_fetch_assoc($q)){
												
								$CATEGORY=$data['CATEGORY'];
								
								$countall=$data['countall'];
								
								if($countall<200){
									//continue;
									
								}
								
								
								
								
								
	$q1 = mysqli_query($dbc,"SELECT * from t24categories where `@ID`='$CATEGORY'");
		$data1 = mysqli_fetch_assoc($q1);
											$DESCRIPTION=$data1['DESCRIPTION'];								
								
								if($DESCRIPTION==''){
									continue;
									
								}
											
											
						//$datavalue.="$countall,";

//$labels.="'$DESCRIPTION',";					
												?>
                                            <p>
                                                <i class="mdi mdi-square text-<?php

												if($DESCRIPTION=='Credit Cards'){
													echo "primary";
												}elseif($DESCRIPTION=='Mortgage Savings Account'){
													echo "success";

												}elseif($DESCRIPTION=='*** Inter-Branch'){
													echo "warning";
													
												}elseif($DESCRIPTION=='AL Position Account Category'){
													echo "danger";

												}else{

												}													
												
												
												
												?>"></i> <?php echo $DESCRIPTION  ?>
                                                <span class="float-right"><?php echo $countall  ?></span>
                                            </p>
											
											
											<?php 
											
											
											
							}
							
							//echo $labels12;
							
							?>
											
											
                                            
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                        </div>
						
						
						
						<script>

    !function (o) {
    "use strict";
    function e() {
        this.$body = o("body"),
        this.charts = []
    }
    e.prototype.initCharts = function () {
        window.Apex = {
            chart: {
                parentHeightOffset: 0,
                toolbar: {
                    show: !1
                }
            },
            grid: {
                padding: {
                    left: 0,
                    right: 0
                }
            },
            colors: ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"]
        };
        var e = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"],
        t = o("#revenue12-chart").data("colors");
        t && (e = t.split(","));
        var r = {
            chart: {
                height: 364,
                type: "line",
                dropShadow: {
                    enabled: !0,
                    opacity: .2,
                    blur: 7,
                    left: -7,
                    top: 7
                }
            },
            dataLabels: {
                enabled: !1
            },
            stroke: {
                curve: "smooth",
                width: 4
            },
            series: [{
                    name: "Dormant",
                    data: [10, 20, 15, 25, 20, 30, 20]
                }, {
                    name: "Active",
                    data: [0, 15, 10, 40, 15, 35, 25]
                }
            ],
            colors: e,
            zoom: {
                enabled: !1
            },
            legend: {
                show: !1
            },
            xaxis: {
                type: "string",
                categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                tooltip: {
                    enabled: !1
                },
                axisBorder: {
                    show: !1
                }
            },
            yaxis: {
                labels: {
                    formatter: function (e) {
                        return e + "k"
                    },
                    offsetX: -15
                }
            }
        };
        new ApexCharts(document.querySelector("#revenue12-chart"), r).render();
        e = ["#727cf5", "#e3eaef"];
        (t = o("#high-performing-product").data("colors")) && (e = t.split(","));
        r = {
            chart: {
                height: 257,
                type: "bar",
                stacked: !0
            },
            plotOptions: {
                bar: {
                    horizontal: !1,
                    columnWidth: "20%"
                }
            },
            dataLabels: {
                enabled: !1
            },
            stroke: {
                show: !0,
                width: 2,
                colors: ["transparent"]
            },
            series: [{
                    name: "Actual",
                    data: [65, 59, 80, 81, 56, 89, 40, 32, 65, 59, 80, 81]
                }, {
                    name: "Projection",
                    data: [89, 40, 32, 65, 59, 80, 81, 56, 89, 40, 65, 59]
                }
            ],
            zoom: {
                enabled: !1
            },
            legend: {
                show: !1
            },
            colors: e,
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                axisBorder: {
                    show: !1
                }
            },
            yaxis: {
                labels: {
                    formatter: function (e) {
                        return e + "k"
                    },
                    offsetX: -15
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (e) {
                        return "$" + e + "k"
                    }
                }
            }
        };
        new ApexCharts(document.querySelector("#high-performing-product"), r).render();
        e = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"];
        (t = o("#average-sales").data("colors")) && (e = t.split(","));
        r = {
            chart: {
                height: 213,
                type: "donut"
            },
            legend: {
                show: !1
            },
            stroke: {
                colors: ["transparent"]
            },
            series: [<?php echo $datavalue1 ?>],
            labels: [<?php echo $labels12 ?>],
            colors: e,
            responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: "bottom"
                        }
                    }
                }
            ]
        };
        new ApexCharts(document.querySelector("#average-sales"), r).render()
    },
    e.prototype.initMaps = function () {
        0 < o("#world-map-markers").length && o("#world-map-markers").vectorMap({
            map: "world_mill_en",
            normalizeFunction: "polynomial",
            hoverOpacity: .7,
            hoverColor: !1,
            regionStyle: {
                initial: {
                    fill: "#e3eaef"
                }
            },
            markerStyle: {
                initial: {
                    r: 9,
                    fill: "#727cf5",
                    "fill-opacity": .9,
                    stroke: "#fff",
                    "stroke-width": 7,
                    "stroke-opacity": .4
                },
                hover: {
                    stroke: "#fff",
                    "fill-opacity": 1,
                    "stroke-width": 1.5
                }
            },
            backgroundColor: "transparent",
            markers: [{
                    latLng: [40.71, -74],
                    name: "New York"
                }, {
                    latLng: [37.77, -122.41],
                    name: "San Francisco"
                }, {
                    latLng: [-33.86, 151.2],
                    name: "Sydney"
                }, {
                    latLng: [1.3, 103.8],
                    name: "Singapore"
                }
            ],
            zoomOnScroll: !1
        })
    },
    e.prototype.init = function () {
        o("#dash-daterange").daterangepicker({
            singleDatePicker: !0
        }),
        this.initCharts(),
        this.initMaps()
    },
    o.Dashboard = new e,
    o.Dashboard.Constructor = e
}
(window.jQuery), function (t) {
    "use strict";
    t(document).ready(function (e) {
        t.Dashboard.init()
    })
}
(window.jQuery);

		
</script>