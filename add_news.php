<?php 
require __DIR__ .'/app/api/user.php';
require __DIR__ .'/app/api/news.php';

$news = filter_input_array(INPUT_POST);

if(!empty($news)){
    $news['preview'] = $_FILES;
    addNews($news);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create news</title>
    <link href="./bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">

</head>

<body>
    <?php require(__DIR__.'/navbar.php');?>
    
    <div class="edit-news">
        <a href="/news_index.php" class="text-success"> Back to news</a><br>
        <h3 class="text-center text-uppercase">Create news</h3>


        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Title</label><br>
                <input class="form-control" type="text" name="title" placeholder="Title" >
            </div>

            <div class="form-group">
                <label>Preview</label><br>
                <input type="file" name="preview">
                
                
            </div>
            <div class="form-group">
                <label>User</label><br>
                <select class="form-control" name="user_id">
              <?php $users = getUser();
              
                foreach($users as $user):
              ?>
              
                  <option value="<?php echo $user['id'] ?>">
                      <?php echo $user['username'] ?>
                  </option>

              
              <?php endforeach; ?>
          </select>
            </div>
            
            <div class="form-group">
                <label>Description</label><br>
                <textarea class="form-control" name="description"></textarea>
            </div>
            <br>
            <div>
                <button class="btn btn-outline-success">Create</button>
            </div>

        </form>
    </div>

</body>

</html>