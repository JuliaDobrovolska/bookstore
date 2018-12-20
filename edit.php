<?php 

require __DIR__ .'/app/api/publishers.php';
require __DIR__ .'/app/api/langs.php';
require __DIR__ .'/app/api/authors.php';
require __DIR__ .'/app/api/products.php';

$product = filter_input_array(INPUT_POST);
$book_id = filter_input(INPUT_GET, 'id');
if(!empty($product)){
    $product['preview'] = $_FILES;
    editProduct($book_id, $product);
}
if(!empty($book_id)){
    $oldProduct = getProductById($book_id);
    //var_dump($oldProduct);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit book</title>
     <link href="./bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="css/main.css">
     
</head>
<body>
 <?php require($_SERVER[DOCUMENT_ROOT].'/navbar.php');?>
 <div class="login-form">
 <a href="/" class="text-success"> Back to catalog</a><br>
  <h3 class="text-center text-uppercase">Edit book</h3>
   
   
   <form action="" method="post" enctype="multipart/form-data">
       <div class="form-group">
          <label>Name</label><br>
          <input class="form-control" type="text" name="name" placeholder="Name" value="<?php echo $oldProduct['name']; ?>">
      </div>
       <div class="form-group">
          <label>Year</label><br>
          <input class="form-control" type="text" name="year" placeholder="Year" value="<?php echo $oldProduct['year']; ?>">
      </div>

       <div class="form-group">
          <label>Preview</label><br>
          <input type="file"  name="preview" value="<?php echo $oldProduct['preview']; ?>">
          <br>
          <img src="/uploads/preview/<?php echo $oldProduct['preview']; ?>" alt="">
      </div>
     <div class="form-group">
          <label>Publisher</label><br>
          <select class="form-control" name="publisher_id">
              <?php $publishers = getPublishers();
              
                foreach($publishers as $publisher):
              ?>
              
                  <option <?php echo ($publisher['id'] ==$oldProduct['publisher_id'])?'selected':'' ?> value="<?php echo $publisher['id'] ?>">
                      <?php echo $publisher['publisher'] ?>
                  </option>

              
              <?php endforeach; ?>
          </select>
      </div>
      <div class="form-group">
          <label>Language</label><br>
          <select class="form-control" name="lang_id">
              <?php $langs = getLangs();
              
                foreach($langs as $lang):
              ?>
              
                  <option <?php echo ($lang['id'] ==$oldProduct['lang_id'])?'selected':'' ?> value="<?php echo $lang['id'] ?>">
                      <?php echo $lang['lang'] ?>
                  </option>

              
              <?php endforeach; ?>
          </select>
      </div>
      <div class="form-group">
          <label>Authors</label><br>
          <select class="form-control" name="authors[]" multiple>
              <?php 
              $bookAuthors = getProductAuthors($oldProduct['id']);
              var_dump($bookAuthors);
              $authors = getAuthors();
              
                foreach($authors as $author):
              ?>
              
                  <option <?php 
                          foreach($bookAuthors as $ba){
                              if($author['id'] == $ba['authors_id']){
                                  echo 'selected';
                              }
                          }
                          ?>
                     value="<?php echo $author['id']; ?>">
                      <?php echo $author['name']." ".$author['lastname']; ?>
                  </option>

              
              <?php endforeach; ?>
          </select>
      </div>
      <div class="form-group">
          <label>Description</label><br>
          <textarea class="form-control" name="description"><?php echo $oldProduct['description']; ?></textarea>
      </div>
      <br>
       <div>
          <button class="btn btn-outline-success">Update</button>
      </div>
       
   </form>
    </div>
    
</body>
</html>