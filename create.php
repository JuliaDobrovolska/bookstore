<?php 

require __DIR__ .'/app/api/publishers.php';
require __DIR__ .'/app/api/langs.php';
require __DIR__ .'/app/api/authors.php';
require __DIR__ .'/app/api/products.php';

$product = filter_input_array(INPUT_POST);
if(!empty($product)){
    $product['preview'] = $_FILES;
    addNewProducts($product);
}
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create a new book</title>
     <link href="./bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="css/main.css">
     
</head>
<body>
  <?php require($_SERVER[DOCUMENT_ROOT].'/navbar.php');?>
  <div class="login-form">
 <a href="/" class="text-success"> Back to catalog</a><br>
 <h3 class="text-center text-uppercase">Create a new book</h3>
  
   <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
          <label>Name</label><br>
          <input class="form-control" type="text" name="name" placeholder="Name">
      </div>
      <div class="form-group">
          <label>Year</label><br>
          <input class="form-control" type="text" name="year" placeholder="Year">
      </div>

      <div class="form-group">
          <label>Preview</label><br>
          <input type="file" name="preview">
      </div>
      <div class="form-group">
          <label>Publisher</label><br>
          <select class="form-control" name="publisher_id">
              <?php $publishers = getPublishers();
              
                foreach($publishers as $publisher):
              ?>
              
                  <option value="<?php echo $publisher['id'] ?>">
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
              
                  <option value="<?php echo $lang['id'] ?>">
                      <?php echo $lang['lang'] ?>
                  </option>

              
              <?php endforeach; ?>
          </select>
      </div>
      <div class="form-group">
          <label>Authors</label><br>
          <select class="form-control" name="authors[]" multiple>
              <?php $authors = getAuthors();
              
                foreach($authors as $author):
              ?>
              
                  <option value="<?php echo $author['id']; ?>">
                      <?php echo $author['name']." ".$author['lastname']; ?>
                  </option>

              
              <?php endforeach; ?>
          </select>
      </div>
      <div class="form-group">
          <label>Description</label><br>
          <textarea class="form-control" name="description"></textarea>
      </div>
       <div>
          <button class="btn btn-outline-success">Create</button>
      </div>
       
   </form>
    </div>
</body>
</html>