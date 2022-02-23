<?php 
function fill_category_list($pdo_conn){
	 $query = "SELECT * FROM category WHERE category_status = 'active' ORDER BY category_name ASC";
	 $statement = $pdo_conn->prepare($query);
	 $statement->execute();
	 $result = $statement->fetchAll();
	 $output = '';
	 foreach($result as $row){
	  $output .= '<option value="'.$row["category_id"].'">'.$row["category_name"].'</option>';
	 }
	 return $output;
}

//Retrive Data in Brand Dropdown 
function fill_brand_list($pdo_conn,$category_id){
	$query = "SELECT * FROM brand WHERE brand_status = 'active' AND category_id = '".$category_id."' ORDER BY brand_name ASC";
	$statement = $pdo_conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = "<option value = '' data-size='2'>Select Brand</option>";
	foreach ($result as $row ) {
		$output.="<option value ='".$row["brand_id"]."'>".$row["brand_name"]."</option>";
	}
	return $output;
}
?>