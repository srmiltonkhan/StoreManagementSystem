<?php include("db_connection.php");
      include 'function.php';
if(isset($_POST['btn_action_hidden'])){
   if($_POST['btn_action_hidden'] == 'load_brand'){
    echo fill_brand_list($pdo_conn, $_POST['category_id']);
   }
   //Insert Data in DB
   if($_POST['btn_action_hidden'] == 'Add'){
    $query = "INSERT INTO products (category_id, brand_id, product_name) VALUES (:category_id, :brand_id, :product_name)";
    $statement = $pdo_conn->prepare($query);
    $statement->execute(
     array(
      ':category_id'   => $_POST['category_id'],
      ':brand_id'    => $_POST['brand_id'],
      ':product_name'   => $_POST['product_name']
     )
    );
    $result = $statement->fetchAll();
    if(isset($result)){
     echo 'Product Name has been saved.';
    }
   }
   //Fetch in Modal for Update data
 if($_POST['btn_action_hidden'] == 'fetch_single'){
  $query = "SELECT * FROM products WHERE product_id = :product_id";
  $statement = $pdo_conn->prepare($query);
  $statement->execute(
   array(
    ':product_id' => $_POST["product_id"]
   )
  );
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
   $output['category_id'] = $row['category_id'];
   $output['brand_id'] = $row['brand_id'];
   $output['product_name'] = $row['product_name'];
  }
  echo json_encode($output);
 }

 if($_POST['btn_action_hidden'] == 'Edit')
 {
  $query = "
  UPDATE product 
  set category_id = :category_id, 
  brand_id = :brand_id,
  product_name = :product_name,
  WHERE product_id = :product_id
  ";
  $statement = $pdo_conn->prepare($query);
  $statement->execute(
   array(
    ':category_id'   => $_POST['category_id'],
    ':brand_id'    => $_POST['brand_id'],
    ':product_name'   => $_POST['product_name'],
       ':product_id'   => $_POST['product_id']
   )
  );
  $result = $statement->fetchAll();
  if(isset($result))
  {
   echo 'Product Details Edited';
  }
 }
 //Delete Section
  if($_POST['btn_action_hidden'] == 'delete'){
    $status = 'active';
    if($_POST['status'] == 'active'){
     $status = 'inactive';
    }
    $query = "UPDATE products SET product_status = :product_status WHERE product_id = :product_id";
    $statement = $pdo_conn->prepare($query);
    $statement->execute(
     array(
      ':product_status' => $status,
      ':product_id'  => $_POST["product_id"]
     )
    );
    $result = $statement->fetchAll();
    if(isset($result))
    {
     echo 'Product status change to ' . $status;
    }
 }
}
?>
