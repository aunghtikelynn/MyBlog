<?php
session_start();
if($_SESSION['user_id']){
    include "../layouts/navbar_side.php";

    include "../../dbconnect.php";

    $sql = "SELECT * FROM categories ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $sql = "DELETE FROM categories WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        header("Location: categories.php");
    }

?> 

<div class="container my-5">
    <div class="mb-5">
        <h3 class="d-inline">Categories Lists</h3>
        <a href="create_categories.php" class="btn btn-primary float-end">Create Categories</a>
    </div>
    <div class="card">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($categories as $category){
                ?>
                    <tr>
                        <td><?= $category['id'] ?></td>
                        <td><?= $category['name'] ?></td>
                        <td>
                            <a href="edit_categories.php?id=<?= $category['id'] ?>"><button class="btn btn-sm btn-warning">Edit</button></a>
                            <button class="btn btn-sm btn-danger delete" data-id="<?= $category['id'] ?>">Delete</button>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
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