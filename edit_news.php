<?php 

//require __DIR__ .'/app/api/publishers.php';
require __DIR__ .'/app/api/user.php';
//require __DIR__ .'/app/api/authors.php';
require __DIR__ .'/app/api/news.php';

$news = filter_input_array(INPUT_POST);
$news_id = filter_input(INPUT_GET, 'id');
if(!empty($news)){
    $news['preview'] = $_FILES;
    editNews($news_id, $news);
}
if(!empty($news_id)){
    $oldNews = getNewsById($news_id);
    //var_dump($oldProduct);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit news</title>
    <link href="./bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">

</head>

<body>
    <?php require(__DIR__.'/navbar.php');?>
    
    <div class="edit-news">
        <a href="/news_index.php" class="text-success"> Back to news</a><br>
        <h3 class="text-center text-uppercase">Edit news</h3>


        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Title</label><br>
                <input class="form-control" type="text" name="title" placeholder="Title" value="<?php echo $oldNews['title']; ?>">
            </div>

            <div class="form-group">
                <label>Preview</label><br>
                <input type="file" name="preview" value="<?php echo $oldNews['preview']; ?>">
                <br>
                <img src="/uploads/preview/<?php echo $oldProduct['preview']; ?>" alt="">
            </div>
            <div class="form-group">
                <label>User</label><br>
                <select class="form-control" name="user_id">
              <?php $users = getUser();
              
                foreach($users as $user):
              ?>
              
                  <option <?php echo ($user['id'] ==$oldNews['user_id'])?'selected':'' ?> value="<?php echo $user['id'] ?>">
                      <?php echo $user['username'] ?>
                  </option>

              
              <?php endforeach; ?>
          </select>
            </div>
            
            <div class="form-group">
                <label>Description</label><br>
                <textarea class="form-control" name="description"><?php echo $oldNews['description']; ?></textarea>
            </div>
            <br>
            <div>
                <button class="btn btn-outline-success">Update</button>
            </div>

        </form>
    </div>

</body>

</html>