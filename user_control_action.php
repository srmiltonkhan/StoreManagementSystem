<?php 
	include("db_connection.php");
	//Change Status Data from DB
 		if ($_POST['btn_action']=='active_inactive') {
 			$status = 'active';
 			if ($_POST['status']=='active') {
 				$status = 'inactive';
 			}
 			$query = "UPDATE users_details SET user_status = :user_status WHERE user_id = :user_id";
 			$statement = $pdo_conn->prepare($query);
 			$statement->execute(
			   array(
			    ':user_status' => $status,
			    ':user_id'  => $_POST['user_id']
			   )
			  );
 			$result = $statement->fetchAll();
 			if(isset($result)){
 				echo 'User Account has been '.$status;
 			}
 		}

 		 if($_POST['btn_action'] == 'btn_user_details'){
      $query = "SELECT * FROM users_details WHERE user_id  = '".$_POST["user_id"]."'";
      $statement = $pdo_conn->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
      $output = '<div class="table-responsive"><table class="table table-boredered table-sm">';
      foreach($result as $row){
       $status = '';
       if($row['user_status'] == 'active'){
        $status = '<h2><span class="badge badge-success">Active</span></h2>';
       }
       else{
        $status = '<h2><span class="badge badge-danger">Inactive</span</h2>';
       }
	   	$user_image = '';
		if ($row['user_image'] !='') {
		 	$user_image = '<img src="img/upload_image/'.$row["user_image"].'" class="thumbnail" width="150" height="160" />';
		}else{
		 	$user_image = '';
		}
       $output .= '
       <tr>
       	<td>Profile Image</td>
       	<td>'.$user_image.'</td>
       </tr>
       <tr>
        <td>Name</td>
        <td>'.$row["user_name"].'</td>
       </tr>
        <tr>
        <td>E-mail</td>
        <td>'.$row["user_email"].'</td>
       </tr>
        <tr>
        <td>Mobile</td>
        <td>'.$row["user_mobile"].'</td>
       </tr>
        <tr>
        <td>Department</td>
        <td>'.$row["user_department"].'</td>
       </tr>
       <tr>
        <td>Designation</td>
        <td>'.$row["user_designation"].'</td>
       </tr>
       <tr>
        <tr>
        <td>Password</td>
        <td>'.$row["user_password"].'</td>
       </tr>
        <tr>
        <td>Type</td>
        <td>'.$row["user_type"].'</td>
       </tr>
        <tr>
        <td>Registration Date</td>
        <td>'.$row["user_create_date"].'</td>
       </tr>
       <tr>
        <td>Account Status</td>
        <td>'.$status.'</td>
       </tr>
       ';
      }
      $output .= '
       </table>
      </div>
      ';
      echo $output;
 }	
?>