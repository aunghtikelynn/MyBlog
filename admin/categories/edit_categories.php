<?php
session_start();
if($_SESSION['user_id']){

    include "../../dbconnect.php";
    include "../layouts/navbar_side.php";

    $id = $_GET['id'];

    $sql = "SELECT * FROM categories WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $category = $stmt->fetch();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $category_id = $_POST['category_id'];
        $name = $_POST['name'];
        echo "$name";

        $sql = "UPDATE categories SET name=:name WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id',$category_id);
        $stmt->bindParam(':name',$name);
        $stmt->execute();

        header("Location: categories.php");
    }

?>

<div class="container my-5">
    <h3 class="d-inline">Edit Categories</h3>
    <a href="categories.php" class="btn btn-danger float-end">Cancel</a>
    <p><a href="">Dashboard</a> / <a href="categories.php">Categories</a> / Categories</p>
</div>
<div class="card m-3">
    <div class="card-header">
        Edit Categories
    </div>
    <div class="card-body">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="category_id" id="" value="<?= $category['id'] ?>" >
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $category['name'] ?>">
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
    </div>
    
</div>

<?php
    include "../layouts/footer.php";

}else{
    header("location:../login.php");
}
?>