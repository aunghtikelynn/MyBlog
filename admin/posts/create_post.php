<?php
    include "../../dbconnect.php";
    include "../layouts/navbar_side.php";

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
        <p><a href="">Dashboard</a> / <a href="">Posts</a> / Posts</p>
    </div>
    <div class="card m-3">
        <div class="card-header">
            Create Posts
        </div>
        <div class="card-body">
            <form action="">
                <div class="mb-3">
                    <label for="" class="form-label">Title</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Categories</label>
                    <select class="form-select">
                        <option selected>Choose ...</option>
                        <?php
                            foreach ($category_name as $category){
                        ?>
                            <option value="1"><?= $category['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Image</label>
                    <input class="form-control" type="file" id="formFile">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="button">Create</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
    include "../layouts/footer.php"
?>