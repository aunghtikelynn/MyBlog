<?php
session_start();
if($_SESSION['user_id']){

    include "../../dbconnect.php";
    include "../layouts/navbar_side.php";

?>

<div class="container my-5">
    <h3 class="d-inline">Create Users</h3>
    <a href="users.php" class="btn btn-danger float-end">Cancel</a>
    <p><a href="">Dashboard</a> / <a href="users.php">Users</a> / Users</p>
</div>
<div class="card m-3">
    <div class="card-header">
        Create Users
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="profile" class="form-label">Profile</label>
            <input type="file" class="form-control" id="profile" name="profile">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="" id="" class="form-select">
                <option selected>Choose ...</option>
                <option value="admin">Admin</option>
                <option value="author">Author</option>
            </select>
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Create</button>
        </div>
    </div>

</div>

<?php
    include "../layouts/footer.php";

}else{
    header("location:../login.php");
}
?>