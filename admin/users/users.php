<?php
session_start();
if($_SESSION['user_id'] && $_SESSION['user_role'] == 'admin'){
    include "../layouts/navbar_side.php";

    include "../../dbconnect.php";

    $sql = "SELECT * FROM users ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        // echo $id;

        $sql = "DELETE FROM users WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        header("location:users.php");

    }
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
                        <td><img src="../<?= $user['profile'] ?>" alt="" width="100px"></td>
                        <td><?= $user['role'] ?></td>
                        <td>
                            <a href="edit_user.php?id=<?= $user['id'] ?>"><button class="btn btn-sm btn-warning">Edit</button></a>
                            <button class="btn btn-sm btn-danger delete" data-id="<?= $user['id'] ?>">Delete</button>
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

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4>Are you sure delete?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <form action="" method="post">
            <input type="hidden" name="id" id="delete_id">
            <button type="submit" class="btn btn-danger">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
    include "../layouts/footer.php";
}else{
    header("location:../login.php");
}
?>