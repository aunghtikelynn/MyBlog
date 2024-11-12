<?php
session_start();
if($_SESSION['user_id']){

    include "../../dbconnect.php";
    include "../layouts/navbar_side.php";

    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $user = $stmt->fetch();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user_id = $_POST['user_id'];

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role =$_POST['role'];
        $profile_array = $_FILES['profile'];
        // var_dump($name,$email,$password,$role,$profile);

        if(isset($profile_array) && $profile_array['size'] > 0){
            $dir = "../images/";
            $profile_dir = $dir.$profile_array['name'];
            $profile = 'images/'.$profile_array['name'];
            $tmp_name = $profile_array['tmp_name'];
            move_uploaded_file($tmp_name,$profile_dir);
        }else{
            $profile = $_POST['old_profile'];
        }

        $sql = "UPDATE users SET name=:name, email=:email, password=:password, role=:role, profile=:profile WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id',$user_id);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':password',$password);
        $stmt->bindParam(':role',$role);
        $stmt->bindParam(':profile',$profile);
        $stmt->execute();

        header("Location: users.php");
    }

?>

<div class="container my-5">
    <h3 class="d-inline">Edit Users</h3>
    <a href="users.php" class="btn btn-danger float-end">Cancel</a>
    <p><a href="">Dashboard</a> / <a href="users.php">Users</a> / Edit Users</p>
</div>
<div class="card m-3">
    <div class="card-header">
        Edit Users
    </div>
    <div class="card-body">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="user_id" id="" value="<?= $user['id'] ?>">
            <div class="mb-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="true">Profile</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="new_image-tab" data-bs-toggle="tab" data-bs-target="#new_image-tab-pane" type="button" role="tab" aria-controls="new_image-tab-pane" aria-selected="false">New Profile</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                        <img src="../<?= $user['profile'] ?>" alt="" class="w-50 h-50 py-5">
                        <input type="hidden" name="old_profile" value="<?= $user['profile'] ?>" >
                    </div>
                    <div class="tab-pane fade" id="new_image-tab-pane" role="tabpanel" aria-labelledby="new_image-tab" tabindex="0">
                        <input class="form-control my-5" type="file" id="profile" name="profile">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" id="password" name="password" value="<?= $user['password'] ?>">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-select">
                    <option selected><?= $user['role'] ?></option>
                    <!-- <option value=""><?= $user['role'] ?></option> -->
                    <option value="admin">Admin</option>
                    <option value="author">Author</option>
                </select>
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