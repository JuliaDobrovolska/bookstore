
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration</title>
    
     <link href="./bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="css/main.css">
</head>
<body>
 <?php require($_SERVER[DOCUMENT_ROOT].'/navbar.php');?>
  <?php 
    $errors='';
    
    if(!empty($_POST['reg'])){
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $repassword = filter_input(INPUT_POST, 'repassword');
        
        if(empty($password) || empty($repassword) || empty($username)){
            $errors = 'empty field';
            
        }else {
            if($password == $repassword){
            $user = filter_input_array( INPUT_POST);
            
            register($user);
            }else{
                $errors='Confirm password failed';
            }
        }
         
    }
    
    ?>
        <div class="login-form">
<h3 class="text-center text-uppercase">Registration</h3>
   <form method="post">
     <div class="form-group">
      <lebel>Username:</lebel><br>
       <input class="form-control" type="text" name="username" placeholder="Username">
       </div>
       <div class="form-group">
        <lebel>Password:</lebel><br>
       <input class="form-control" type="password" name="password" placeholder="Password">
       </div>
       <div class="form-group">
       <lebel>Confirm your password:</lebel><br>
       <input class="form-control" type="password" name="repassword" placeholder="Confirm password">
       </div>
       <p style="color:red"><?php echo $errors ?></p>
       <input class="btn btn-outline-success" name="reg" value="Sign up" type="submit">
       
   </form>
    </div>
   
    
</body>
</html>