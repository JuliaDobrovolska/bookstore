<?php 

require __DIR__ .'/app/api/products.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Store</title>
     <link href="./bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="css/main.css">
     <link rel="stylesheet" href="css/navbar.css">
     
</head>
<body>
   <?php require($_SERVER[DOCUMENT_ROOT].'/navbar.php');?>
  <section class="main-content">
   <a class="btn btn-outline-success button-add float-right" role="button" href="/create.php">Add new book</a>
 <table class="table table-dark">
  <thead>
  <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Description</th>
      <th>Year</th>
      <th>Edit</th> 
      <th>Delete</th>
  </tr>
     </thead>
   <?php
     $search = filter_input(INPUT_GET, 'search');
     $delete = filter_input(INPUT_GET, 'action');
     $id = filter_input(INPUT_GET, 'id');
     
     if(!empty($delete)&& $delete == 'delete' && !empty($id)){
         deleteProduct($id);
     }
     
     if(!empty($search)){
         $products = searchProducts($search);
     } else {
    $products = getProducts();
     }
     
    foreach($products as $value):
    
    
    ?>
    <tr>
        <td><?php echo $value['id']; ?></td>
        <td><?php echo $value['name']; ?></td>
        <td><?php echo $value['description']; ?></td>
        <td><?php echo $value['year']; ?></td>
        <td><a class="text-success" href="edit.php?id=<?php echo $value['id']; ?>">Edit</a></td>
        <td><a class="text-success" href="/?action=delete&id=<?php echo $value['id']; ?>">Delete</a></td> 
<!--        плохой вариант, нужно отправлять через post-->
 
    </tr>
    <?php endforeach; ?>
   </table>
    </section>
   
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="bootstrap-4.0.0/assets/js/vendor/jquery-slim.min.js"></script>
   <script src="bootstrap-4.0.0/assets/js/vendor/popper.min.js"></script>
   <script src="bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>