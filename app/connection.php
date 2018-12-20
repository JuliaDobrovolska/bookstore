<?php 
    $config = parse_ini_file('configs/db.ini');
    if(empty($config)){
        throw new Exception('unloaded configs');
    }

    $link = mysqli_connect($config['host'],
                           $config['username'],
                           $config['password'],
                           $config['database']);
mysqli_set_charset($link, 'utf8');
if(mysqli_connect_errno()){
    throw new Exception('Connection to DB is not available');
}