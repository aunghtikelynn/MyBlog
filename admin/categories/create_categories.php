<?php
session_start();
if($_SESSION['user_id']){

    include "../../dbconnect.php";
    include "../layouts/navbar_side.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];

        $sql = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name',$name);
        $stmt->execute();

        header("Location: categories.php");
    }

?>

<div class="container my-5">
    <h3 class="d-inline">Create Categories</h3>
    <a href="categories.php" class="btn btn-danger float-end">Cancel</a>
    <p><a href="">Dashboard</a> / <a href="categories.php">Categories</a> / Categories</p>
</div>
<div class="card m-3">
    <div class="card-header">
        Create Categories
    </div>
    <div class="card-body">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">Create</button>
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