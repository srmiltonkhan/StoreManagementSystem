<?php
	require_once("db_connection.php");
	function upload_image(){
		if(isset($_FILES["user_image"])){
			$extension = explode('.', $_FILES['user_image']['name']);
			$new_name = rand() . '.' . $extension[1];
			$destination = './img/upload_image/' . $new_name;
			move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
			return $new_name;
		}
	}
	if (isset($_POST['action_hidden'])) {
		if ($_POST['action_hidden'] == 'Add') {
				$user_email = $_POST['user_email'];
				$user_mobile = $_POST['user_mobile'];
				$finder_query = "SELECT * FROM users_details WHERE user_email = '$user_email' OR user_mobile ='$user_mobile'";
				$statement = $pdo_conn->prepare($finder_query);
				$statement->execute();
				$row_count = $statement->fetch();
				if ($row_count > 0) {
				echo "Your Email: "."<span class = 'badge badge-warning'>".$_POST['user_email']."</span>"." and Mobile Number: "."<span class='badge badge-warning'>".$_POST['user_mobile']."</span>"." already exist.";	
				}else{
				$user_type = 'normal_user';
				date_default_timezone_set('Asia/Dhaka');
				$currentDateTime=date('m/d/Y H:i:s');
				$user_create_date = date("h:i A. d-M-y", strtotime($currentDateTime));
				$image = '';
				if($_FILES["user_image"]["name"] != ''){
					$image = upload_image();
				}
				$statement = $pdo_conn->prepare("INSERT INTO `users_details`(`user_name`, `user_email`, `user_mobile`, `user_department`, `user_designation`, `user_password`, `user_type`,`user_create_date`, `user_image`) VALUES (:user_name,:user_email,:user_mobile,:user_department,:user_designation,:user_password,:user_type,:user_create_date,:user_image)");
				$result = $statement->execute(
					array(
						':user_name'	=>	$_POST["user_name"],
						':user_email'	=>	$_POST["user_email"],
						':user_mobile'	=>	$_POST["user_mobile"],
						':user_department'	=>	$_POST["user_department"],
						':user_designation'	=>	$_POST["user_designation"],
						':user_password'	=>	$_POST["user_password"],
						':user_type'	=>	$user_type,
						':user_create_date'	=>	$user_create_date,
						':user_image'		=>	$image
					)
				);
				$result = $statement->fetchAll();
				if (isset($result)) {
					echo "Your Account has been registered successfully. Please verify your query with IT Department.";
				}
			}

		}
	}
	
	//fetch data from db and show in modal
	if(isset($_POST["user_id"])){
		$output = array();
		$statement = $pdo_conn->prepare("SELECT * FROM users_details WHERE user_id = '".$_POST["user_id"]."' LIMIT 1");
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row){
			$output["user_name"] = $row["user_name"];
			$output["user_email"] = $row["user_email"];
			$output["user_mobile"] = $row["user_mobile"];
			$output["user_department"] = $row["user_department"];
			$output["user_designation"] = $row["user_designation"];
			$output["user_password"] = $row["user_password"];
			if($row["user_image"] != '')
			{
				$output['user_image'] = '<img src="img/upload_image/'.$row["user_image"].'" class="img-thumbnail" width="150" height="60" /><input type="hidden" name="hidden_user_image" value="'.$row["user_image"].'" />';
			}
			else
			{
				$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
			}
		}
		echo json_encode($output);
      }
      // Edit Data
      	if (isset($_POST['action_hidden'])) {
      		if ($_POST['action_hidden']=="Edit") {
      				$image = '';
					if($_FILES["user_image"]["name"] != ''){
					$image = upload_image();
					}else{
					$image = $_POST["hidden_user_image"];
			        }
			        $query = "UPDATE `users_details` SET `user_name`=:user_name,`user_email`=:user_email,`user_mobile`=:user_mobile,`user_department`=:user_department,`user_designation`=:user_designation,`user_password`=:user_password,`user_image`=:user_image WHERE user_id =:user_id";
			        $statement = $pdo_conn->prepare($query);
			        $statement->execute(
				    array(
					':user_name'	=>	$_POST["user_name"],
					':user_email'	=>	$_POST["user_email"],
					':user_mobile'	=>	$_POST["user_mobile"],
					':user_department'	=>	$_POST["user_department"],
					':user_designation'	=>	$_POST["user_designation"],
					':user_password'	=>	$_POST["user_password"],
					':user_image'		=>	$image,
					':user_id'			=>	$_POST["user_id"]
				    )
			       );
	      			$result = $statement->fetchAll();
	      			if (isset($result)) {
	               		echo "User Information has been edited.";
	              }
	        }
	     }

?>