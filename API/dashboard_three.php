<div class="row">
                            <div class="col-xl-6 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-right">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop p-0"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:void(0);" class="dropdown-item">Refresh Report</a>
                                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                            </div>
                                        </div>
                                        <h4 class="header-title"><center>Top 5 Dormant Balances</center></h4>

                                        <div id="views1-min" class="apex-charts mt-2" data-colors="#0acf97"></div>

                                        <div class="table-responsive mt-3">
                                            <table cellpadding="0" cellspacing="0" border="0" class="table table-nowrap" id="example21" aria-describedby="example_info">
                              
                                <thead>
                                <tr>
                                    
                                   
                                   
									<th>Account Name</th>
									
									<th>Balance</th>
									<th>Details</th>
                                    
                                    
									
									
                                </tr>
                                </thead>
                                <tbody>
                                <?php
           
		  
		  
          
		
			 
			$q = mysqli_query($dbc,"SELECT `ACCOUNT_TITLE`,`TOTAL_ACC_AMT`,`ACCTNO` FROM dormant_account_all where `INACTIV_MARKER`='Y' order by `TOTAL_ACC_AMT` desc limit 5");
								
								
                                while($data = mysqli_fetch_assoc($q)){
                   $ACCOUNT_TITLE=$data['ACCOUNT_TITLE'];
$TOTAL_ACC_AMT=$data['TOTAL_ACC_AMT'];
				   
$datavalue.="$TOTAL_ACC_AMT,";

$labels.="'$ACCOUNT_TITLE',";									
								 ?>
                                    <tr class="odd gradeX">
                                       
										<td><?php echo $data['ACCOUNT_TITLE'] ?></td>
										
										
										
										<td><?php echo number_format($data['TOTAL_ACC_AMT'],) ?></td>
										
										<td><a href='dormantsearch.php?id=<?php echo $data['ACCTNO'] ?>'><button class='btn-info'>View</button></a></td>
										                                       
                                        
                                        								
                                    </tr>
                                <?php
                                }   
//echo $labels;
                                ?>
                                </tbody>
                            </table>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-xl-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-right">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop p-0"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:void(0);" class="dropdown-item">Refresh Report</a>
                                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                            </div>
                                        </div>
                                        <h4 class="header-title"><center>Dormant Accounts By Gender </center></h4>

                                        <div id="simple-pie2" class="apex-charts mt-3" data-colors="#727cf5"></div>
										
										
										<?php      

$gendersumary = mysqli_query($dbc,"SELECT `GENDER`, COUNT(*),(SELECT COUNT(*) FROM  dormant_account_all where `INACTIV_MARKER`='Y' AND `GENDER`='MALE') as MALES,(SELECT SUM(TOTAL_ACC_AMT) FROM  dormant_account_all where `INACTIV_MARKER`='Y' AND `GENDER`='MALE') as MALETOTALS, (SELECT COUNT(*) FROM  dormant_account_all where `INACTIV_MARKER`='Y' AND `GENDER`='FEMALE') as FEMALES,(SELECT SUM(TOTAL_ACC_AMT) FROM  dormant_account_all where `INACTIV_MARKER`='Y' AND `GENDER`='FEMALE') as FEMALETOTAL,(SELECT SUM(TOTAL_ACC_AMT) FROM  dormant_account_all where `INACTIV_MARKER`='Y' AND `GENDER`='') as UNSPECIFIED from dormant_account_all  where `INACTIV_MARKER`='Y' group by GENDER");

$gendersumaryddata = mysqli_fetch_assoc($gendersumary);

$MALES=$gendersumaryddata['MALES'];
//echo "<br>";
$FEMALES=$gendersumaryddata['FEMALES'];
$MALETOTALS=$gendersumaryddata['MALETOTALS'];//
//echo "<br>";
$FEMALETOTAL=$gendersumaryddata['FEMALETOTAL'];

$UNSPECIFIED=$gendersumaryddata['UNSPECIFIED'];
			



										?>
										
										
										
										
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

<!-- end col-->
                        </div>
						
						
<script>

    var options = {
          series: [{
          name: 'Amount',
          data: [<?php echo $datavalue; ?>]
        }],
          annotations: {
          points: [{
            x: 'Amount',
            seriesIndex: 0,
            label: {
              borderColor: '#775DD0',
              offsetY: 0,
              style: {
                color: '#fff',
                background: '#775DD0',
              },
              text: 'Percentage of Deposit',
            }
          }]
        },
        chart: {
          height: 350,
		   width: 550,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            columnWidth: '40%',
            //endingShape: 'rounded'  
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: 2
        },
        
        grid: {
          row: {
            colors: ['#fff', '#f2f2f2']
          }
        },
        xaxis: {
          labels: {
            rotate: -20
          },
          categories: [<?php echo $labels  ?>],
          //tickPlacement: 'on'
        },
        yaxis: {
          title: {
            text: 'Amount',
          },
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'light',
            type: "horizontal",
            shadeIntensity: 0.25,
            gradientToColors: undefined,
            inverseColors: true,
            opacityFrom: 0.85,
            opacityTo: 0.85,
            stops: [50, 0, 100]
          },
        }
        };

        var chart = new ApexCharts(document.querySelector("#views1-min"), options);
        chart.render();
		
	
var colors = ["#2C3E50", "#3498DB", "#fa5c7c", "#e3eaef"], dataColors = $("#simple-pie").data("colors");
dataColors && (colors = dataColors.split(","));
var options = {
    chart: {
        height: 250,
		width: 550,
        type: "pie"
    },
    series: [<?php echo $MALES?>,<?php echo $FEMALES ?>],
    labels: ["Male", "Female"],
    colors: colors,
    legend: {
        show: !0,
        position: "bottom",
        horizontalAlign: "center",
        verticalAlign: "middle",
        floating: !1,
        fontSize: "14px",
        offsetX: 0,
        offsetY: 7
    },
    responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    show: !1
                }
            }
        }
    ]
}, chart = new ApexCharts(document.querySelector("#simple-pie2"), options);
chart.render();	
		
a = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"];
        (o = i("#sessions-os").data("colors")) && (a = o.split(","));
r = {
            chart: {
                height: 268,
                type: "radialBar"
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: "22px"
                        },
                        value: {
                            fontSize: "16px"
                        },
                        total: {
                            show: !0,
                            label: "OS",
                            formatter: function (e) {
                                return 8541
                            }
                        }
                    }
                }
            },
            colors: a,
            series: [44, 100, 67, 83],
            labels: ["Windows", "Macintosh", "Linux", "Android"]
        };
        new ApexCharts(document.querySelector("#sessions-os12"), r).render()
		
		
		
</script>
						
						
						
						