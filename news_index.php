<?php 

require __DIR__ .'/app/api/news.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Store</title>
    <link href="bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/navbar.css">


</head>

<body>
    <?php require(__DIR__ .'/navbar.php');?>

    <a class="btn btn-outline-success button-add float-right d-block" role="button" href="/add_news.php">Add news</a>
    <div class="card-columns card-for-news">
        <?php
     $search = filter_input(INPUT_GET, 'search');
     $delete = filter_input(INPUT_GET, 'action');
     $id = filter_input(INPUT_GET, 'id');
     
     if(!empty($delete)&& $delete == 'delete' && !empty($id)){
         deleteNews($id);
     }
     
     if(!empty($search)){
         $news = searchNews($search);
     } else {
    $news = getNews();
     }
     
    foreach($news as $value):
    
    
    ?>

            <div class="card text-white bg-dark mb-5" style="width: 25rem;">
                <img class="card-img-top" src="/uploads/preview/<?php echo $value['preview']; ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $value['title']; ?>
                    </h5>
                    <p class="card-text">
                        <?php echo $value['description']; ?>
                    </p>
                    <p class="card-text"><small class="text-warning">Last updated <?php echo $value['date']; ?></small></p>
                    <a href="edit_news.php?id=<?php echo $value['id']; ?>" class="btn btn-outline-success">Edit</a>
                    <a href="/news_index.php?action=delete&id=<?php echo $value['id']; ?>" class="btn btn-outline-success">Delete</a>
                </div>
            </div>
            <?php endforeach; ?>

    </div>






    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="bootstrap-4.0.0/assets/js/vendor/jquery-slim.min.js"></script>
    <script src="bootstrap-4.0.0/assets/js/vendor/popper.min.js"></script>
    <script src="bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>

</body>

</html>