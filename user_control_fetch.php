<?php
//user_control_fetch.php
include('db_connection.php');
function get_total_all_records($pdo_conn){
 $statement = $pdo_conn->prepare("SELECT * FROM users_details");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT * FROM users_details ";
if(isset($_POST["search"]["value"])){
	 $query .= 'WHERE user_name LIKE "%'.$_POST["search"]["value"].'%" ';
	 $query .= 'OR user_email LIKE "%'.$_POST["search"]["value"].'%" ';
	 $query .= 'OR user_mobile LIKE "%'.$_POST["search"]["value"].'%" ';
	 $query .= 'OR user_department LIKE "%'.$_POST["search"]["value"].'%" ';
	 $query .= 'OR user_status LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST['order'])){
 	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}else{
 	$query .= 'ORDER BY user_id DESC ';
}
if($_POST['length'] != -1){
 	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $pdo_conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row){
	 $user_image = '';
	 if ($row['user_image'] !='') {
	 	$user_image = '<img src="img/upload_image/'.$row["user_image"].'" class="rounded-circle" width="50" height="50" />';
	 }else{
	 	$user_image = '';
	 }
	$status = '';
	 if($row['user_status'] == 'active'){
	  $status = '<span class="badge badge-success">Active</span>';
	 }else{
	  $status = '<span class="badge badge-danger">Inactive</span>';
	 }
	$sub_array = array();
	$sub_array[] = '<div class="text-center">'.$row["user_id"].'</div>';
	$sub_array[] = '<div class="text-center">'.$user_image.'</div>';
	$sub_array[] = $row["user_name"];
	$sub_array[] = $row["user_email"];
	$sub_array[] = $row["user_mobile"];
	$sub_array[] = $row["user_department"];
	$sub_array[] ='<div class="text-center">'.$status.'</div>';
	$sub_array[] = '<div class="text-center"><button type="button" name="view" id="'.$row["user_id"].'" class="btn btn-success btn-sm view mr-2 launch-modal"><i class="fas fa-eye"></i></button>'.'<button type="button" name="update" id="'.$row["user_id"].'" class="btn btn-primary btn-sm update mr-2"><i class="fas fa-edit"></i></button>'.'<button type="button" name="active_inactive_btn" id="'.$row["user_id"].'" class="btn btn-info btn-sm btn_active_inactive" data-status="'.$row["user_status"].'"><i class="fas fa-check-circle"></i></button></div>';
	$data[] = $sub_array;
}
$output = array(
 "draw"=> intval($_POST["draw"]),
 "recordsTotal"=>  $filtered_rows,
 "recordsFiltered"=>  get_total_all_records($pdo_conn),
 "data"=> $data
);

echo json_encode($output);
?>