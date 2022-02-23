<?php 
include('db_connection.php');
// Insert Data Into Database
if (isset($_POST['btn_action_hidden'])) {
    if ($_POST['btn_action_hidden']=='Add') {
      $brand_name = $_POST['brand_name'];
      $finder_query = "SELECT * FROM brand WHERE brand_name = '$brand_name'";
      $statement = $pdo_conn->prepare($finder_query);
      $statement->execute();
      $row_count = $statement->fetch();
      if ($row_count > 0) {
        echo "Brand Name "."<span class = 'badge badge-warning'>".$_POST['brand_name']."</span>"." already exist."; 
      }else{
        $query = "INSERT INTO brand(category_id,brand_name) VALUES (:category_id, :brand_name)";
        $statement = $pdo_conn->prepare($query);
        $statement->execute(array(
            ':category_id'=> $_POST['category_id'],
            ':brand_name' => $_POST['brand_name']
        ));
        $result = $statement->fetchAll();
        if (isset($result)) {
          echo "Brand Name has been Saved.";
        }
      }
    }
      //Fetch Data from DB in Modal
      if ($_POST['btn_action_hidden']=='fetch_single') {
        $query = "SELECT * FROM brand WHERE brand_id = :brand_id";
        $statement = $pdo_conn->prepare($query);
        $statement->execute(array(
          ':brand_id'=> $_POST['brand_id']
        ));
        $result = $statement->fetchAll();
        foreach ($result as $row) {
          $output['category_id'] = $row['category_id'];
          $output['brand_name']= $row['brand_name'];
        }
        echo json_encode($output);
      }
      //Update Data from Database
      if ($_POST['btn_action_hidden'] == 'Edit') {
      $query = "UPDATE brand SET category_id = :category_id, brand_name = :brand_name WHERE brand_id = :brand_id";
      $statement = $pdo_conn->prepare($query);
      $statement->execute(
         array(
          ':brand_id' => $_POST['brand_id'],
          ':category_id' => $_POST['category_id'],
          ':brand_name'=>$_POST['brand_name']  
       ));
      $result = $statement->fetchAll();
      if (isset($result)) {
        echo "Brand Name has been edited.";
      }
    }
    //Inactive Data from Database
  if($_POST['btn_action_hidden'] == 'delete'){
    $status = 'active';
    if($_POST['status'] == 'active'){
     $status = 'inactive';
    }
    $query = "UPDATE brand SET brand_status = :brand_status WHERE brand_id = :brand_id";
    $statement = $pdo_conn->prepare($query);
    $statement->execute(
     array(
      ':brand_status' => $status,
      ':brand_id'  => $_POST["brand_id"]
     )
    );
    $result = $statement->fetchAll();
    if(isset($result)){
     echo 'Brand status change to ' . $status;
    }
   }
  }
?>