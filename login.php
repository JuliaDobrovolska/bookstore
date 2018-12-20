<?php
    require __DIR__ .'/app/api/account.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
     <link href="./bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="css/main.css">
</head>
<body>
   <?php require($_SERVER[DOCUMENT_ROOT].'/navbar.php');?>
    <?php 
        if(!empty($_POST['login'])){
            $user = filter_input_array( INPUT_POST);
            signin($user);
        }
    
    ?> 
    <div class="login-form">
  <h3 class="text-center text-uppercase">Login</h3> 
    
     <form method="post" action="">
     <div class="form-group">
      <lebel>Username:</lebel>
       <input class="form-control" type="text" name="username" placeholder="Enter username">
       </div>
       <div class="form-group">
        <lebel>Password:</lebel>
       <input  class="form-control" type="password" name="password" placeholder="Password">
         </div>
       <input name="login" value="Sign in" type="submit" class="btn btn-outline-success">
       
   </form>
      </div>
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="bootstrap-4.0.0/assets/js/vendor/jquery-slim.min.js"></script>

   <script src="bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
   
    
</body>
</html>