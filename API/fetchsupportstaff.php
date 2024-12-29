<?php
error_reporting(0);
include("config/connection.php");

include("formfunction.php");
error_reporting(0);

$gid = $_POST['gid'];

//echo $sql = "SELECT users.username,users.user_id,users.`name`,heritagecompaintdetails.`Complaints` AS name_0,heritagecompaintdetails.id FROM users LEFT JOIN heritagecompaintdetails_users ON users.user_id=heritagecompaintdetails_users.user_id LEFT JOIN heritagecompaintdetails ON heritagecompaintdetails_users.group_id=heritagecompaintdetails.id ORDER BY users.user_id ASC";
$users_in_group = array();
$sql2 = "SELECT * FROM heritagecompaintdetails_users where group_id = '$gid'";
$query2 = mysqli_query($dbc, $sql2);
while($result2=mysqli_fetch_assoc($query2)){
    array_push($users_in_group, $result2['user_id']);
}
// print_r($users_in_group);



//$sql = "SELECT * from users where `user_type` = 'Agent'";

$sql = "SELECT * from users";

$query = mysqli_query($dbc, $sql);


    while($result=mysqli_fetch_assoc($query)){
        
        $selected = '';
        if(in_array($result['user_id'], $users_in_group)){
            $selected = 'checked';
        }
        ?>
       <div class='row'>
        
		<div class="col-md-8 col-xl-8">
                                <div class="card-box widget-user">
								
								<?php  
$log_by=$result['user_id'];
echo get_user_profile_pic($user_id="$log_by", $dbc);

								?>
								
                                    
                                    <div class="mt-3">
									
                                        <h5 class="mb-1"> 
										
<input type="checkbox" name="g_member[]" value="<?php echo $result['user_id'] ?>" <?php echo $selected ?> id='checkbox-success' class='checkbox checkbox-success mb-2'> <?php echo $result['name'] ?></h5>
										
                                        <p class="text-muted mb-0 font-13"><?php echo $result['email'] ?></p>
										
                                        <div class="user-position">
            <span class="text-info text-uppercase font-13 font-weight-bold"><?php echo $result['user_type'] ?></span>
                                        </div>
										
										

<?php  


echo get_user_user_assigned_tasks($user_id=$log_by, $dbc);

  ?>

									
										
										
                                    </div>
                                </div> <!-- end card -->
                            </div>
		
		
		
        </div> 
        <?php
    }
    echo '<input type="hidden" name="gid" value="'.$gid.'" />';

mysqli_close($dbc);
?>

