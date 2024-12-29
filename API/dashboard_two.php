<?php
//($r = mysqli_fetch_assoc($sqldata))

//$db=mysqli_connect ("localhost", 'root', '','demo');






$locations=array();
    $query =  mysqli_query($dbc,"SELECT * FROM superagency_outlets");
        while( $row =mysqli_fetch_assoc($query)){

            $nama_kabkot = $row['outletName'];
            $longitude = $row['longitude'];                              
            $latitude = $row['latitude'];
			$outletTotalTransactionVolume = $row['outletTotalTransactionVolume'];
			
			$outletAddress = $row['outletAddress'];
			$outletDailyTransactionVolume= $row['outletDailyTransactionVolume'];
			
			$outletPhoneNumber= $row['outletPhoneNumber'];
			
			$outletCode= $row['outletCode'];

            /* Each row is added as a new array */ 
            $locations[]=array( 'name'=>$nama_kabkot, 'lat'=>$latitude, 'lng'=>$longitude, 'transactionvolume'=>$outletTotalTransactionVolume,'outletAddress'=>$outletAddress,'outletDailyTransactionVolume'=>$outletDailyTransactionVolume,'outletPhoneNumber'=>$outletPhoneNumber,'outletCode'=>$outletCode );
        }
        /* Convert data to json */
        $markers = json_encode($locations);
		//echo $markers;
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type='text/javascript' src='assets/gmaps.js'></script>
<!-- <script async defer
  src="https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyA-AB-9XZd-iQby-bNLYPFyb0pR2Qw3orw&callback=initMap">

		</script> -->
		
		<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5GwxLXOqZVHDm9ARSthcrihvgUNmePgE&callback=initMap"
        async defer></script> -->
		
		 <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1r347mAdIGByN9ISDfmGZFS56KU1f8Hw&callback=initMap"
  type="text/javascript"></script>

		
<script type='text/javascript'>
   
       // var markers=<?php echo $markers ?>;

	   <?php
        echo "var markers=$markers;\n";

    ?>
	   
	   
	   
		//console.log(markers);
  

    function initMap() {

        var latlng = new google.maps.LatLng(7.9465,-1.0232);
        var myOptions = {
            zoom:7,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: true
        };

        var map = new google.maps.Map(document.getElementById("map"),myOptions);
        var infowindow = new google.maps.InfoWindow(), marker, lat, lng;
		var newData = JSON.stringify(markers)
        var json=JSON.parse(newData);
//JSON.parse("[object Object]")
		console.log(json);
        for( var o in json ){

            lat = json[o].lat;
            lng=json[o].lng;
            name=json[o].name;
			outletAddress=json[o].outletAddress;
			transactionvolume=json[o].transactionvolume;
			outletDailyTransactionVolume=json[o].outletDailyTransactionVolume;
			outletPhoneNumber=json[o].outletPhoneNumber;
			outletCode=json[o].outletCode;

			
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat,lng),
                name:name,
				lat:lat,
				outletAddress:outletAddress,
				transactionvolume:transactionvolume,
				outletDailyTransactionVolume:outletDailyTransactionVolume,
				outletPhoneNumber:outletPhoneNumber,
				outletCode:outletCode,
                map: map
            }); 
            google.maps.event.addListener(marker,'click', function(e){
                //infowindow.setContent(this.name);
				infowindow.setContent("Branch Name <a href='dormantbybranches.php?id="+this.outletCode+" '>"+this.name+" </a><br>Number of Dormant AC <b>"+this.outletAddress+"</b><br> Dormant Balance <b>"+this.transactionvolume+"</b> <br> Debit Balance <b>"+this.outletDailyTransactionVolume+" ");
                infowindow.open(map, this );
            }.bind( marker ) );
        }
		
		//google.maps.event.trigger( map, 'resize' );
    }
    </script>

<script type='text/javascript' src='assets/gmaps.js'></script>

<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-right">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Refresh Report</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                            </div>
                                        </div>
                                        <h4 class="header-title">Accounts by Branches</h4>

                                        <div class="row">
                                            <div class="col-lg-8">
											
											<div id="map"  class="col-12 map" style="height:700px"></div>	
											
											
                                               <div id="world-map-markers121" class="mt-3 mb-3" style="height: 300px">
                                                
											
												
												
												</div>
												
												
												
												
                                            </div>
                                            <div class="col-lg-4">
                                                <h4 class="header-title">Accounts by Cities/Town</h4>
													
												
												
												<div id="newcountry-chart" class="apex-charts" data-colors="#727cf5"></div>  
                                            </div>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
						
						
	           <?php
           
		 
			$q = mysqli_query($dbc,"SELECT `TOWN_COUNTRY`,`TOTAL_ACC_AMT`,count(`TOWN_COUNTRY`) as townnumber FROM dormant_account_all where `INACTIV_MARKER`='Y' group by `TOWN_COUNTRY` asc");
								
								
                                while($data = mysqli_fetch_assoc($q)){
                   $townnumber=$data['townnumber'];
$TOWN_COUNTRY=$data['TOWN_COUNTRY'];
				   
$datavaluetown.="$townnumber,";

$labelsname.="'$TOWN_COUNTRY',";
	}
	
	
	//echo $datavaluetown;
?>
						
						
						
<script type='text/javascript'>
//a = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"];
        //(o = i("#newcountry-chart").data("colors")) && (a = o.split(","));
        r = {
            chart: {
                height: 520,
				 //width: 100,
                type: "bar"
            },
            plotOptions: {
                bar: {
                    horizontal: !0
                }
            },
            colors: a,
            dataLabels: {
                enabled: !1
            },
            series: [{
                    name: "Number of Accounts",
                    data: [<?php echo $datavaluetown; ?>]
                }
            ],
            xaxis: {
                categories: [<?php echo $labelsname; ?>],
                axisBorder: {
                    show: !1
                },
                labels: {
                    formatter: function (e) {
                        //return e + "%"
						return e
                    }
                }
            },
            grid: {
                strokeDashArray: [5]
            }
        };
        new ApexCharts(document.querySelector("#newcountry-chart"), r).render();


       
</script>