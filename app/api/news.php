<?php 
require realpath(__DIR__)."/../connection.php";
require realpath(__DIR__)."/upload.php"; 

function getNews(){
    $sql = 'SELECT * FROM news';
    global $link;
    
    $q = mysqli_query($link, $sql);
    $news = [];
    while($row = mysqli_fetch_assoc($q)){
        $news[]=$row;
    }
    return $news;
}
function getNewsById($id){
    global $link;
    $newsId=mysqli_real_escape_string($link,$id);
    $sql = "SELECT * FROM news WHERE id='$newsId'";
    $q = mysqli_query($link, $sql);
    $result = mysqli_fetch_assoc($q);
    return $result;
    
    
    
}
function searchNews($title){
   
    global $link;
    $search=mysqli_real_escape_string($link,$title);   //обезопасим поиск от спец символов и запросов sql
    $sql = "SELECT * FROM news WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
    $q = mysqli_query($link, $sql);
    $news = [];
    while($row = mysqli_fetch_assoc($q)){
        $news[]=$row;
    }
    return $news;
}
function addNews($news){
    $file = $news['preview'];
    $preview = upload($file['preview']);
    global $link;
    $sql = "INSERT INTO news (`title`,`description`,`preview`,`user_id`) VALUES('".$news['title']."', '".$news['description']."', '".$preview."',  '".$news['user_id']."')";
    
    if(!mysqli_query($link, $sql)){
        echo "Все плохо".mysqli_error($link);
        exit();
    }
//    $lastId = mysqli_insert_id($link);
//    addProductAuthors($lastId,$products['authors']);
}
function  deleteNews($news_id){
     if(!empty($news_id)){
        global $link;
        $sql = "DELETE FROM news WHERE id='$news_id'";
        mysqli_query($link,$sql);
}
}
function editNews($id, $news){
   
    global $link;
    $preview = $news['preview'];
    $sql = "UPDATE news SET `title` = '".$news['title']."',`description` = '".$news['description']."',`user_id` = '".$news['user_id']."'";
//    var_dump($news);
    

    if(!empty($preview['preview']['name'])){
    $file = $news['preview'];
    $preview = upload($file['preview']);
    $sql.=", `preview`= '".$preview."'";
    }
    $sql .=" WHERE id='$id'";
    mysqli_query($link,$sql);
//    deleteProductAuthors($id);
//    addProductAuthors($id,$products['authors']);
    
    
}
