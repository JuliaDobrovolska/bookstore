<?php 
require realpath(__DIR__)."/../connection.php";
require realpath(__DIR__)."/upload.php";

function getProducts(){
    $sql = 'SELECT * FROM books';
    global $link;
    
    $q = mysqli_query($link, $sql);
    $products = [];
    while($row = mysqli_fetch_assoc($q)){
        $products[]=$row;
    }
    return $products;
}
function getProductById($id){
    global $link;
    $productId=mysqli_real_escape_string($link,$id);
    $sql = "SELECT * FROM books WHERE id='$productId'";
    $q = mysqli_query($link, $sql);
    $result = mysqli_fetch_assoc($q);
    return $result;
    
    
    
}
function searchProducts($name){
   
    global $link;
    $search=mysqli_real_escape_string($link,$name);   //обезопасим поиск от спец символов и запросов sql
    $sql = "SELECT * FROM books WHERE name LIKE '%$search%' OR description LIKE '%$search%'";
    $q = mysqli_query($link, $sql);
    $products = [];
    while($row = mysqli_fetch_assoc($q)){
        $products[]=$row;
    }
    return $products;
}
function addProductAuthors($bookID,$authors){
    global $link;
    if(is_array($authors)){
        foreach($authors as $v){
            $sql = "INSERT INTO books_authors (`book_id`,`authors_id`) VALUES('".$bookID."', '".$v."')";
            mysqli_query($link, $sql);
        }
        
    }
}
function getProductAuthors($book_id){
    global $link;
    $bookId = mysqli_real_escape_string($link,$book_id);
    $sql = "SELECT * FROM books_authors WHERE book_id ='$bookId'";
    $q = mysqli_query($link, $sql);
    $booksAuthors = [];
    while($row = mysqli_fetch_assoc($q)){
        $booksAuthors[]=$row;
    }
    return $booksAuthors;
    
    
    
}
function addNewProducts($products){
    $file = $products['preview'];
    $preview = upload($file['preview']);
    global $link;
    $sql = "INSERT INTO books (`name`,`description`,`preview`,`year`,`publisher_id`,`lang_id`) VALUES('".$products['name']."', '".$products['description']."', '".$preview."', '".$products['year']."', '".$products['publisher_id']."', '".$products['lang_id']."')";
    
    if(!mysqli_query($link, $sql)){
        echo "Все плохо".mysqli_error($link);
        exit();
    }
    $lastId = mysqli_insert_id($link);
    addProductAuthors($lastId,$products['authors']);
}
function deleteProductAuthors($book_id){
    if(!empty($book_id)){
        global $link;
        $sql = "DELETE FROM books_authors WHERE book_id='$book_id'";
        mysqli_query($link,$sql);
    }
}
function  deleteProduct($book_id){
     if(!empty($book_id)){
        global $link;
        $sql = "DELETE FROM books WHERE id='$book_id'";
        mysqli_query($link,$sql);
}
}
function editProduct($id, $products){
   
    global $link;
    $preview = $products['preview'];
    $sql = "UPDATE books SET `name` = '".$products['name']."',`description` =  '".$products['description']."',`year`='".$products['year']."',`publisher_id`='".$products['publisher_id']."',`lang_id`='".$products['lang_id']."'";
    if(!empty($preview['preview']['name'])){
    $file = $products['preview'];
    $preview = upload($file['preview']);
    $sql.=", `preview`= '".$preview."'";
    }
    $sql .=" WHERE id='$id'";
    mysqli_query($link,$sql);
    deleteProductAuthors($id);
    addProductAuthors($id,$products['authors']);
    
    
}














