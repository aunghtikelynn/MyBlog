<?php
session_start();
if($_SESSION['user_id'] && $_SESSION['user_role'] == 'admin'){
    include "../layouts/navbar_side.php";

    include "../../dbconnect.php";

    $sql = "SELECT * FROM users ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();
?> 

<div class="container my-5">
    <div class="mb-5">
        <h3 class="d-inline">Users Lists</h3>
        <a href="create_user.php" class="btn btn-primary float-end">Create Users</a>
    </div>
    <div class="card">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Profile</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($users as $user){
                ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><img src="<?= $user['profile'] ?>" alt="" width="100px"></td>
                        <td><?= $user['role'] ?></td>
                        <td>
                            <a href="edit_user.php"><button class="btn btn-sm btn-warning">Edit</button></a>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Profile</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php
    include "../layouts/footer.php";
}else{
    header("location:../login.php");
}
?>