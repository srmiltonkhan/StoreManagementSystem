<?php 
	require_once("db_connection.php");

	if (isset($_POST['btn_action'])) {
		//Insert Data in DB
		if ($_POST['btn_action'] == 'Add') {
			$category_name = $_POST['category_name'];
			$finder_query = "SELECT * FROM category WHERE category_name = '$category_name'";
			$statement = $pdo_conn->prepare($finder_query);
			$statement->execute();
			$row_count = $statement->fetch();
			if ($row_count > 0) {
				echo "Category Name "."<span class = 'badge badge-warning'>".$_POST['category_name']."</span>"." already exist.";	
			}else{
				$query = "INSERT INTO category(category_name) VALUES (:category_name)";
				$statement = $pdo_conn->prepare($query);
				$statement->execute(array(':category_name'=>$_POST['category_name']));
				$result = $statement->fetchAll();

				if (isset($result)) {
					echo "Category Name has been saved.";
				}
			}

		}
		//Fetch Data from DB in Modal
		if ($_POST['btn_action']=='fetch_single') {
			$query = "SELECT * FROM category WHERE category_id = :category_id";
			$statement = $pdo_conn->prepare($query);
			$statement->execute(
				array(':category_id' => $_POST['category_id'])
			);
			$result = $statement->fetchAll();
			foreach ($result as $row) {
				$output['category_name'] = $row['category_name'];
			}
			echo json_encode($output);
		}
		//Edit data from DB
		if ($_POST['btn_action'] == 'Edit') {
			$query = "UPDATE category SET category_name = :category_name WHERE category_id = :category_id";
			$statement = $pdo_conn->prepare($query);
			$statement->execute(
				 array(
				 	':category_name' => $_POST['category_name'],
				 	':category_id'=>$_POST['category_id']
			 ));
			$result = $statement->fetchAll();
			if (isset($result)) {
				echo "Category Name has been edited.";
			}
		}
		//Change Status Data from DB
 		if ($_POST['btn_action']=='delete') {
 			$status = 'active';
 			if ($_POST['status']=='active') {
 				$status = 'inactive';
 			}
 			$query = "UPDATE category SET category_status = :category_status WHERE category_id = :category_id";
 			$statement = $pdo_conn->prepare($query);
 			$statement->execute(
			   array(
			    ':category_status' => $status,
			    ':category_id'  => $_POST['category_id']
			   )
			  );
 			$result = $statement->fetchAll();
 			if(isset($result)){
 				echo 'Category status has been changed to '.$status;
 			}
 		}
	}
?>