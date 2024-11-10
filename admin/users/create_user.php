<?php
session_start();
if($_SESSION['user_id']){

    include "../../dbconnect.php";
    include "../layouts/navbar_side.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
        }

        $sql = "INSERT INTO users (name,email,password,role,profile) VALUES (:name,:email,:password,:role,:profile)";
        $stmt = $conn->prepare($sql);
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
    <h3 class="d-inline">Create Users</h3>
    <a href="users.php" class="btn btn-danger float-end">Cancel</a>
    <p><a href="">Dashboard</a> / <a href="users.php">Users</a> / Users</p>
</div>
<div class="card m-3">
    <div class="card-header">
        Create Users
    </div>
    <div class="card-body">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
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
                <select name="role" id="role" class="form-select">
                    <option selected>Choose ...</option>
                    <option value="admin">Admin</option>
                    <option value="author">Author</option>
                </select>
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