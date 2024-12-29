<div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="#" class="p-0 float-right mb-3">Export <i class="mdi mdi-download ml-1"></i></a>
                                        <h4 class="header-title mt-1">USSD Request</h4>

                                        <div class="table-responsive">
                                            <table class="table table-sm table-centered mb-0 font-14">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th style="">Mobile Number</th>
														<th style="">Number of Attempts</th>
                                                        <th>No. of Accounts</th>
														<th>Account Name</th>
														<th>Date/Time </th>
                                                        <th style="">Network</th>
														<th style="">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												
												<tr>
												<?php 										
												
$q = mysqli_query($dbc,"SELECT `msisdn`, `userData`, `account_number`, `date_of_input`, `account_name`, `network`, count(*) as alln FROM `ussd_table` group by `msisdn`");
//SELECT `ids`, `sessionID`, `userID`, `newSession`, `msisdn`, `userData`, `account_number`, `date_of_input`, `account_name`, `network` FROM `ussd_table` WHERE 1							

							while($data = mysqli_fetch_assoc($q)){
												
								//$CO_CODE=$data['CO_CODE'];
								
								$countall=$data['alln'];
								
											
												?>
												
                                                    <tr>
								<td><?php echo $data['msisdn'];	?></td>
								
								<td><?php echo $data['alln'];	?></td>
								<td><?php echo $data['account_number'];	?></td>
													  
								<td><?php 	echo $data['account_name'];	 ?></td>
								<td><?php echo $data['date_of_input'];	 ?></td>
								<td><?php echo $data['network']; ?></td>
								
								<td><a href='tel:<?php echo $data['msisdn']; ?>'><button class="btn btn-sm  bg-success">Call</button></a></td>
														
														
                                                    </tr>
									<?php  }?>
													
													
													
                                                    
                                                </tbody>
                                            </table>
                                        </div>





















										<!-- end table-responsive-->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                             <!-- end col-->

                             <!-- end col-->

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