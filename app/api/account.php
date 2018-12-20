<?php
require realpath(__DIR__). "/../connection.php";

function register($user){
    global $link;
    $password = md5($user['password'].'4c3t32t55vy5c454');
    $sql ="INSERT INTO user (username, password) VALUES ('".$user['username']."','".$password."')";
    
    mysqli_query($link,$sql);
}
function signin($user){ 
    global $link;
    $username = mysqli_real_escape_string($link,$user['username']);
    $password = mysqli_real_escape_string($link,$user['password']);
    $password = md5($password.'4c3t32t55vy5c454');
    
    $sql ="SELECT id, username, role FROM user WHERE username = '$username' AND password ='$password'";
    $q = mysqli_query($link, $sql);
    $result = mysqli_fetch_assoc($q);
    
    if(!empty($result)){
        session_start();
        $_SESSION['auth'] = true; 

        $_SESSION['id'] = $result['id'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['role'] = $result['role'];
        
//        var_dump($result);
//        if($result['role'] == admin){
//            echo "Hello, Admin";
//        } else {
//            echo "Hello, Guest";
//        }
        if ( $_SESSION['auth'] == true and $_SESSION['role'] == 'admin') {

	}
        
        
        
        
    }else{
        //exit
    }
    
   
}