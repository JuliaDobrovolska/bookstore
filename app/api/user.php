<?php 
require realpath(__DIR__)."/../connection.php";

function getUser(){
    $sql = 'SELECT * FROM user';
    global $link;
    
    $q = mysqli_query($link, $sql);
    $users = [];
    while($row = mysqli_fetch_assoc($q)){
        $users[]=$row;
    }
    return $users;
}