<?php 

function hashFileName($originalName){
    $arr = explode('.', $originalName); //разбираем по точкам название файла
    $type = $arr[count($arr)-1]; //выбираем тип картинки
    $newName = md5(microtime().$originalName).".$type"; 
    return $newName;
}


function upload($file){
    $name = hashFileName($file['name']);
    $path = realpath(__DIR__)."/../../uploads/preview/";
    
    move_uploaded_file($file['tmp_name'],$path.$name);
    return $name;
    
    
    
    
}