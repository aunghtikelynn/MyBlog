<?php
    include "../../dbconnect.php";
    include "../layouts/navbar_side.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $title = $_POST['title'];
        $category_id = $_POST['category_id'];
        $description = $_POST['description'];
        $user_id = 1;
        $image = "eg.jpg";
        // echo "$title <br> $category_id <br> $description";
        $sql = "INSERT INTO posts (title,image,description,category_id,user_id) VALUES (:title,:image,:description,:category_id,:user_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':title',$title);
        $stmt->bindParam(':image',$image);
        $stmt->bindParam(':description',$description);
        $stmt->bindParam(':category_id',$category_id);
        $stmt->bindParam(':user_id',$user_id);
        $stmt->execute();

        header("Location: posts.php");
    }

    $sql = "SELECT * FROM categories ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $category_name = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container my-5">
        <h3 class="d-inline">Posts</h3>
        <a href="" class="btn btn-danger float-end">Cancel</a>
        <p><a href="">Dashboard</a> / <a href="posts.php">Posts</a> / Posts</p>
    </div>
    <div class="card m-3">
        <div class="card-header">
            Create Posts
        </div>
        <div class="card-body">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post"> 
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Categories</label>
                    <select class="form-select" id="category_id" name="category_id">
                        <option selected>Choose ...</option>
                        <?php
                            foreach ($category_name as $category){
                        ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" type="file" id="image" name="image">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
    include "../layouts/footer.php"
?>