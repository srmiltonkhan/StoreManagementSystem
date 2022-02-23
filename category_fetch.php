<?php
//category_fetch.php
include('db_connection.php');
$query = '';
$output = array();
$query .= "SELECT * FROM category ";
if(isset($_POST["search"]["value"])){
	 $query .= 'WHERE category_name LIKE "%'.$_POST["search"]["value"].'%" ';
	 $query .= 'OR category_status LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST['order'])){
 	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}else{
 	$query .= 'ORDER BY category_id DESC ';
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
	 $status = '';
	 if($row['category_status'] == 'active'){
	  $status = '<span class="badge badge-success">Active</span>';
	 }
	 else{
	  $status = '<span class="badge badge-danger">Inactive</span>';
	 }
	 $sub_array = array();
	 $sub_array[] = '<div class="text-center">'.$row['category_id'].'</div>';
	 $sub_array[] = '<div class="ml-1">'.$row['category_name'].'</div>';
	 $sub_array[] = '<div class= "text-center">'.$status.'</div>';
	 $sub_array[] = '<div class="text-center"><button type="button" name="update" id="'.$row["category_id"].'" class="btn btn-primary btn-sm update mr-2"><i class="fas fa-edit"></i></button>'.'<button type="button" name="delete" id="'.$row["category_id"].'" class="btn btn-danger btn-sm delete" data-status="'.$row["category_status"].'"><i class="fas fa-trash"></i></button></div>';
	 $data[] = $sub_array;
}
$output = array(
 "draw"=> intval($_POST["draw"]),
 "recordsTotal"=>  $filtered_rows,
 "recordsFiltered"=>  get_total_all_records($pdo_conn),
 "data"=> $data
);
function get_total_all_records($pdo_conn){
 $statement = $pdo_conn->prepare("SELECT * FROM category");
 $statement->execute();
 return $statement->rowCount();
}
echo json_encode($output);
?>