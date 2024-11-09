<?php
session_start();
if($_SESSION['user_id']){

    include "../../dbconnect.php";
    include "../layouts/navbar_side.php";

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
    <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
    </div>
</div>

<?php
    include "../layouts/footer.php";

}else{
    header("location:../login.php");
}
?>